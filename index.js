const express = require('express');
const app = express();
const http = require('http').Server(app);
const io = require('socket.io')(http);
var request = require('request');
var mysql = require('mysql2');
var connection = mysql.createConnection({host:'localhost', user: 'ljsqlsmy_herosol', database: 'ljsqlsmy_crainly_live', password: '0.3%Ar1GPeD@'});
app.get('/', function(req, res) {
    res.send('Hello world!');
});
var server = app.listen(4000);
var connectedUsers = {};
io.sockets.on('connection', function (socket) {

    socket.on('register', function (data) {
        console.log(data);
        var userJID = data.userId;
        
        if (connectedUsers.hasOwnProperty(userJID)) {
            connectedUsers[userJID].removeAllListeners();
            connectedUsers[userJID].disconnect();
            delete connectedUsers[userJID];               
        };
        
        if (!connectedUsers.hasOwnProperty(userJID)) {   
            socket.userId = userJID;
            connectedUsers[userJID] = socket;                
        };
    });
    
    socket.on('send_message', function (data) {
        function test(){
            var sql = "UPDATE `deleted_threads` SET `deleted`= 0 WHERE (`user_id` = "+data.toUser+" OR `user_id` = "+data.fromUser+") AND master_thread_id = "+threadId;
            connection.query(sql, function (err, result) {
                if(!err){
   
                }
            });
            if (connectedUsers.hasOwnProperty(data.toUser)) {
                var message = data.message.replace(/\\/g, "\\\\");
                var sql = "INSERT INTO `messages` SET `thread_id`='"+threadId+"', `type`='"+data.type+"', `to_user`="+data.toUser+",`from_user`="+data.fromUser+",`message`='"+message+"',`media`='"+data.media+"',`created_at`="+getCurrentTime()+",`updated_at`="+getCurrentTime()+"";
                connection.query(sql, function (err, result) {
                    if(!err){
                        data.threadId = threadId;
                        data.messageId = result.insertId;
                        connectedUsers[data.toUser].emit('new_msg_recieve', data);
                        connectedUsers[data.fromUser].emit('new_msg_recieve', data);
                    }else{
                        connectedUsers[data.fromUser].emit('not_delivered', {});
                    }
                });
            }else{
                if(data.threadId){
                    threadId = data.threadId;
                }
                var options = {
                    url: data.base_url+'/save-message',
                    method: 'POST',
                    body: JSON.stringify({
                        "type": data.type,
                        "thread_id": threadId,
                        "from_user": data.fromUser,
                        "to_user": data.toUser,
                        "message": data.message,
                        "media": data.media
                    }),
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                        'access-token': data.accessToken
                    }
                };
                
                request(options, function (error, response, body) {
                    if(response.statusCode == 200){
                        var returnData = JSON.parse(body);
                        data.threadId = threadId;
                        data.messageId = returnData.data.id;
                        connectedUsers[data.fromUser].emit('new_msg_recieve', data);
                    }else{
                        console.log(error);
                    }
                });  
            }  
        }
        var threadId = makeThreadId(8);
        var sql = "SELECT thread_id FROM `messages` WHERE (`to_user`="+data.toUser+" AND `from_user`="+data.fromUser+" ) OR (`to_user`="+data.fromUser+" AND `from_user`="+data.toUser+" )";
        connection.query(sql, function (err, result, fields) {
            if(err){
                //console.log(err);
            }else{
                if(result.length > 0){
                    threadId = result[0].thread_id;
                    test();
                }else{
                    var sql = "INSERT INTO `message_threads` SET `thread_id`="+threadId+", `user_id`='"+data.fromUser+"',`created_at`="+getCurrentTime()+",`updated_at`="+getCurrentTime()+"";
                    connection.query(sql, function (err, result) {
                        if(!err){
                            threadId = result.insertId;
                            test();
                        }
                    });
                }
              
            }
        });                 
    });
        
    socket.on('typing', function (data) { 
        var toUser = data.toUser;
        if (connectedUsers.hasOwnProperty(toUser)) {
            connectedUsers[toUser].emit('typing', data);
        };
    });

    socket.on('not_typing', function (data) { 
        var toUser = data.toUser;
        if (connectedUsers.hasOwnProperty(toUser)) {
            connectedUsers[toUser].emit('not_typing', data);
        };
    });
    
    socket.on('seen', function (data) { 
        var toUser = data.toUser;
        var messageIds = data.messageIds;
        if (messageIds && messageIds.length > 0) {
            
            var sql = "UPDATE `messages` SET `seen`= 1 WHERE `id` IN ("+messageIds+")";
            connection.query(sql, function (err, result) {
                if(!err){
                    if (connectedUsers.hasOwnProperty(toUser)) {
                        connectedUsers[toUser].emit('messages_read', messageIds);
                    };    
                }
            });
        };    
    });

    socket.on('edit_message', function (data) { 
        var toUser = data.toUser;
        var messageId = data.messageId;
        if (messageId) {
            var message = data.message.replace(/\\/g, "\\\\")
            var sql = "UPDATE `messages` SET `message`= '"+message+"', `edited` = 1 WHERE `id` IN ("+messageId+")";
            connection.query(sql, function (err, result) {
                if(!err){
                    if (connectedUsers.hasOwnProperty(toUser)) {
                        connectedUsers[toUser].emit('message_updated', data);
                    };    
                }
            });
        };    
    });

    socket.on('delete_message', function (data) { 
        var fromUser = data.fromUser;
        var toUser = data.toUser;
        var messageId = data.messageId;
        if (messageId) {
            var sql = "UPDATE `messages` SET `from_delete` = CASE WHEN `from_user` = "+fromUser+" then 1 ELSE 0 END, `to_delete` = CASE WHEN `to_user` = "+fromUser+" then 1 ELSE 0 END WHERE `id` = "+messageId;
            connection.query(sql, function (err, result) {
                if(!err){
                    if (connectedUsers.hasOwnProperty(toUser)) {
                        connectedUsers[toUser].emit('delete_message_by_user', data);
                    };    
                }
            });
        };  
    });

    socket.on('video_seen', function (data) { 
        var fromUser = data.fromUser;
        var toUser = data.toUser;
        var messageId = data.messageId;
        if (messageId) {
            var sql = "UPDATE `messages` SET `from_delete` = 0, `to_delete` = 1 WHERE `id` = "+messageId;
            connection.query(sql, function (err, result) {
                if(!err){
                    if (connectedUsers.hasOwnProperty(toUser)) {
                        connectedUsers[toUser].emit('video_seen', data);
                    };    
                }
            });
        };    
    });
            
    socket.on('disconnect', function (data) {
        console.log("disconnect");
        var sql = "UPDATE `users` SET `is_online`= 0 WHERE `id` = "+data.toUser;
            connection.query(sql, function (err, result) {
                if(!err){
                    for (var key in connectedUsers) {
                        connectedUsers[key].emit('disconnected', data);
                    }  
                }
            });
    });
        
});
