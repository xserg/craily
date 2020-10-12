/**
 * Created by hp on 2/8/2017.
 */
(function () {
  'use strict';
  var express = require('express');
  var cors = require('cors')
  var app = express();
  app.use(cors());
  var https = require('https');
  var fs = require('fs');
  var path = require('path');
  var multer = require('multer');
  var mysql = require('mysql2');
  var request = require('request');
  app.use(express.static(__dirname + '/public'));
  app.get('/', function(req, res) {
    res.send('Hello world!');
});
var connection = mysql.createConnection({host:'localhost', user: 'ljsqlsmy_herosol', database: 'ljsqlsmy_crainly_live', password: '0.3%Ar1GPeD@'});
  var threadId = makeThreadId(8);
  var server = app.listen(3400);
  var storage = multer.diskStorage({
    destination: function (req, file, cb) {
      cb(null, path.join(__dirname, 'public/uploads/'))
    },
    filename: function (req, file, cb) {
      cb(null, file.fieldname + '-' + Date.now() + path.extname(file.originalname))
    }
  });
  var upload = multer({storage: storage});
  app.use(function (req, res, next) {
     res.header("Access-Control-Allow-Origin", "*");
     res.header("Access-Control-Allow-Headers", "Origin, X-Requested-With, Content-Type, Accept");
    next();
  });
  app.post('/upload', upload.single('file'), function (req, res, next) {
    res.json({success: true, filename: req.file.filename, filePath: 'uploads/' + req.file.filename});
  });

  app.use(function (err, req, res, next) {
    res.status(err.status || 500);
    res.json({
      success: false,
      message: err.message,
      error: err
    });
  });
  var io = require('socket.io')(server);
  
      var rooms = {};
      var noOfCoursesRoom = {};
      var connectedUsers = {};
      io.sockets.on('connection', function(socket) {
        /** updated start 23-09-2019 */
          socket.on('register', function (data) {
            var userJID = data.userId;
            var dataRes = {};
            var updateSql ='';
            var msg ='';
           if (connectedUsers.hasOwnProperty(userJID)) {
                connectedUsers[userJID].removeAllListeners();
                connectedUsers[userJID].disconnect();
                delete connectedUsers[userJID];               
            };
           
            if (!connectedUsers.hasOwnProperty(userJID)) { 
                socket.userId = userJID; 
                connectedUsers[userJID] = socket; 
            };
           
            if(data.member_type == 'tutor')
            {
                 updateSql = "update `tbl_lessons` set `tutor_connected`='1' WHERE `id`='"+data.sessionID+"'";
                 msg ='Student not connected yet.';

            }else 
            if(data.member_type == 'student')
            {
                 updateSql = "update `tbl_lessons` set `student_connected`='1' WHERE `id`='"+data.sessionID+"'";
                 msg ='tutor not connected yet.';
             }
             connection.query(updateSql, function (err, result){
                let sessionSql ="SELECT * FROM `tbl_lessons` WHERE `id`='"+ data.sessionID+"'";
                connection.query(sessionSql, function (err, result) {
                if(!err){
                       let id= result[0].id;
                       let student_connected= result[0].student_connected;
                       let tutor_connected= result[0].tutor_connected;
                       if(student_connected==1 && tutor_connected==1)
                        {
                          /*let sessionSql ="update `tbl_lessons` set video_start_time='',video_end_time='' WHERE `id`='"+ data.sessionID+"'";
                          connection.query(sessionSql, function (err, result) {
                          }*/
                            dataRes.connect_status='connected';
                            connectedUsers[userJID].emit('session_started', dataRes);
                            connectedUsers[data.frndId].emit('session_started', dataRes);
                        }else{
                            dataRes.msg=msg;
                            connectedUsers[userJID].emit('not_connected', dataRes);
                        }
                    }
                });
             });
        });
          /** updated end 23-09-2019 */
        socket.on('send_message', function (data) {
            var datachat={};
            var message = data.message.replace(/\\/g, "\\\\");
            var times = Math.round(+new Date()/1000);
                if (connectedUsers.hasOwnProperty(data.toUser)) {
                  
                   
                     var sql = "INSERT INTO `tbl_chat` SET `mem_one`='"+data.fromUser+"', `mem_two`='"+data.toUser+"',`time`="+times+"";
                 
                    connection.query(sql, function (err, result) {
                        if(!err){
                            datachat.sender_id = data.fromUser;
                            datachat.msg = message;
                            datachat.chat_id = result.insertId;
                            datachat.msg_type=data.msg_type;
                            datachat.time=times;
                            datachat.status='new';
                            datachat.no_deleted=data.fromUser+","+data.toUser;
                            let sqlmsg = "INSERT INTO `tbl_chat_msgs` SET `sender_id`='"+datachat.sender_id+"', `chat_id`='"+datachat.chat_id+"', `msg`='"+datachat.msg+"',`time`='"+datachat.time+"',`msg_type`='"+datachat.msg_type+"',`no_deleted`='"+datachat.no_deleted+"'";
                           connection.query(sqlmsg, function (err, result) {
                                connectedUsers[data.toUser].emit('new_msg_recieve', datachat);
                                 connectedUsers[data.fromUser].emit('new_msg_recieve', datachat);
                            });
                            
                        }else{
                            connectedUsers[data.fromUser].emit('not_delivered', {});
                        }
                    });
                }else{
                  var sql = "INSERT INTO `tbl_chat` SET `mem_one`='"+data.fromUser+"', `mem_two`='"+data.toUser+"',`time`="+times+"";
                  connection.query(sql, function (err, result) {
                        if(!err){
                            datachat.sender_id = data.fromUser;
                            datachat.msg = message;
                            datachat.chat_id = result.insertId;
                            datachat.msg_type=data.msg_type;
                            datachat.time=times;
                            datachat.status='new';
                            datachat.no_deleted=data.fromUser+","+data.toUser;
                            let sqlmsg = "INSERT INTO `tbl_chat_msgs` SET `sender_id`='"+datachat.sender_id+"', `chat_id`='"+datachat.chat_id+"', `msg`='"+datachat.msg+"',`time`='"+datachat.time+"',`msg_type`='"+datachat.msg_type+"',`no_deleted`='"+datachat.no_deleted+"'";
                           connection.query(sqlmsg, function (err, result) {
                              connectedUsers[data.fromUser].emit('user-offline', datachat);
                            });
                            
                        }
                    });
                }  
                             
        });
        socket.on('typing', function (data) {
            if (connectedUsers.hasOwnProperty(data.toUser)) {
                connectedUsers[data.toUser].emit('typing', data);
            }
        });
        socket.on('browser-closed', function (data) {
           if (connectedUsers.hasOwnProperty(data.toUser)) {
                connectedUsers[data.toUser].emit('browser-closed', data);
            }
        });

        // WhiteBoard Events
        socket.on('object-added', function(data)
        {
           if (connectedUsers.hasOwnProperty(data.toUser)) {
             connectedUsers[data.toUser].emit('object-added', data);
             }
        });
       
        socket.on('object-modified', function(data)
        {
             if (connectedUsers.hasOwnProperty(data.toUser)) {
                connectedUsers[data.toUser].emit('object-modified', data);
              }
        });
        socket.on('object-scaling', function(data)
        {
             if (connectedUsers.hasOwnProperty(data.toUser)) {
                connectedUsers[data.toUser].emit('object-scaling', data);
              }
        });
        socket.on('object-created', function(data)
        {
            if (connectedUsers.hasOwnProperty(data.toUser)) {
                connectedUsers[data.toUser].emit('object-created', data);
              }
        });
        socket.on('object:removed', function(data)
        {
            if (connectedUsers.hasOwnProperty(data.toUser)) {
                connectedUsers[data.toUser].emit('object:removed', data.target);
              }
        });
        socket.on('object-clear', function(data)
        {   
            if (connectedUsers.hasOwnProperty(data.toUser)) {
                connectedUsers[data.toUser].emit('object-clear', []);
              }
        });
        socket.on('object-undo', function(data)
        {   
            if (connectedUsers.hasOwnProperty(data.toUser)) {
                connectedUsers[data.toUser].emit('object-undo', data.target);
              }
        });
        socket.on('object-redo', function(data)
        {   
             if (connectedUsers.hasOwnProperty(data.toUser)) {
                connectedUsers[data.toUser].emit('object-redo', data.target);
              }
        });
        socket.on('resizewindowWidth', function(data)
        {   
             if (connectedUsers.hasOwnProperty(data.toUser)) {
                connectedUsers[data.toUser].emit('resizewindowWidth', data);
              }
        });
        socket.on('resizewindowHeight', function(data)
        {   
             if (connectedUsers.hasOwnProperty(data.toUser)) {
                connectedUsers[data.toUser].emit('resizewindowHeight', data);
              }
        });
        //Change whiteboard tab
        socket.on('change-whiteBoard', function(data)
        {   
            
            if (connectedUsers.hasOwnProperty(data.toUser)) {
                connectedUsers[data.toUser].emit('change-whiteBoard', data.target);
              }
        });
        socket.on('add_text', function(data) {
          if (connectedUsers.hasOwnProperty(data.toUser)) {
                connectedUsers[data.toUser].emit('draw_text', data.target);
             }
        });
        
        socket.on('videocallevent', function(data) {
            
            if (connectedUsers.hasOwnProperty(data.toUser)) {
                connectedUsers[data.toUser].emit('videocallevent', data);
                }
           });
           socket.on('videocallend', function(data) {
            if (connectedUsers.hasOwnProperty(data.toUser)) {
                    connectedUsers[data.toUser].emit('videocallend', data);
                }
           });
          
           socket.on('object-ArtBoard',function(data)
           {
            if (connectedUsers.hasOwnProperty(data.toUser)) {
                connectedUsers[data.toUser].emit('object-ArtBoard', data);
            }
           });
           socket.on('object-editorArea',function(data)
           {
            if (connectedUsers.hasOwnProperty(data.toUser)) {
                connectedUsers[data.toUser].emit('object-editorArea', data);
            }
           });
           socket.on('text-editor',function(data)
           {
             if (connectedUsers.hasOwnProperty(data.toUser)) {
                connectedUsers[data.toUser].emit('text-editor', data);
            }
           });
           socket.on('video-whiteboard-add',function(data)
           {
             if (connectedUsers.hasOwnProperty(data.toUser)) {
                connectedUsers[data.toUser].emit('video-whiteboard-add', []);
            }
           });
           socket.on('video-whiteboard-remove',function(data)
           {
            if (connectedUsers.hasOwnProperty(data.toUser)) {
                connectedUsers[data.toUser].emit('video-whiteboard-remove', []);
            }
           });
           socket.on('chat-hide',function(data)
            {
                if (connectedUsers.hasOwnProperty(data.toUser)) {
                    connectedUsers[data.toUser].emit('chat-hide', []);
                }
            })
            socket.on('ckeditorOnOff',function(data)
            {
                if (connectedUsers.hasOwnProperty(data.toUser)) {
                    connectedUsers[data.toUser].emit('ckeditorOnOff', data);
                }
            })
        socket.on('disconnectedsession', function(data) {
           if (connectedUsers.hasOwnProperty(data.toUser)) {
                connectedUsers[data.toUser].emit('disconnectedsession', data.toUser);
               
               
              }
        });
         
        // video call opentok 
        socket.on('media-permission', function(data) {
            if (connectedUsers.hasOwnProperty(data.toUser)) {
                 connectedUsers[data.toUser].emit('media-permission', data);
                }
           });
           socket.on('no-device-media', function(data) {
            if (connectedUsers.hasOwnProperty(data.toUser)) {
                 connectedUsers[data.toUser].emit('no-device-media', data);
                }
           });
        
           
           socket.on('join_room', function(message) {
              var room = message.room || '';
              var connections = rooms[room] = rooms[room] || [];
              if (connections.length < 2) {
                  socket.join(room);
                  socket.broadcast.to(room).emit('new_peer', {
                      socketId: socket.id,
                      noOfCourses: (message.noOfCourses ? message.noOfCourses : 1)
                  });
  
                  connections.push(socket);
  
                  var connectionsId = [];
                  for (var i = 0, len = connections.length; i < len; i++) {
                      var id = connections[i].id;
  
                      if (id !== socket.id) {
                          connectionsId.push(id);
                      }
                  }
  
                  socket.on('update_time', function(data) {
                      console.log(data);
                      socket.broadcast.to(room).emit('new_updated_time', {
                          socketId: socket.id,
                          noOfCourses: data.noOfCourses,
                          secondsLeft: data.secondsLeft
                      });
                  });
  
                  socket.on('start_timer', function(data) {                   
                      socket.broadcast.to(room).emit('start_timer');
                });
                
                socket.on('end_updated_time', function (data) {       
                  console.log('end_updated_time');
                  socket.broadcast.to(room).emit('end_updated_time', {
                      socketId: socket.id
                  });
              });

  
                  socket.on('no_of_courses', function(data) {
                      noOfCoursesRoom[room] = data.noOfCourses;
                  });
  
                  socket.emit('get_peers', {
                      connections: connectionsId,
                      socketId: socket.id,
                      noOfCourses: (noOfCoursesRoom[room] ? noOfCoursesRoom[room] : 1)
                  });
  
                //   socket.on('disconnect', function() {
                //       setTimeout(function() {
                //           console.log('socket disconnected');
                //           endCall(room, socket, false);
                //       }, 2000);
                //   });
  
  
                  function endCall(room, socket, isEndCall) {
                      var connections = rooms[room];
                      for (var i = 0; i < connections.length; i++) {
                          var id = connections[i].id;
                          if (id === socket.id) {
                              connections.splice(i, 1);
                              i--;
                              if (isEndCall) {
                                  socket.broadcast.to(room).emit('end_call', {
                                      socketId: socket.id
                                  });
                              } else {
                                  socket.broadcast.to(room).emit('remove_peer', {
                                      socketId: socket.id
                                  });
                              }
                              socket.leave(room);
                          }
                      }
                      if (connections.length === 0) {
                          noOfCoursesRoom = {};
                      }
                  }
  
                  socket.on('end_call', function() {
                      console.log('end call');
                      endCall(room, socket, true);
                  });
  
                  socket.on('ice_candidate', function(data) {
                      var client = getSocket(room, data.socketId);
                      if (client) {
                          client.emit('ice_candidate', {
                              label: data.label,
                              candidate: data.candidate,
                              socketId: socket.id
                          });
                      }
                  });
  
                  socket.on('send_offer', function(data) {
                      var client = getSocket(room, data.socketId);
                      if (client) {
                          client.emit('receive_offer', {
                              sdp: data.sdp,
                              socketId: socket.id
                          });
                      }
                  });
  
                  socket.on('send_answer', function(data) {
                      var client = getSocket(room, data.socketId);
                      if (client) {
                          client.emit('receive_answer', {
                              sdp: data.sdp,
                              socketId: socket.id
                          });
                      }
  
                  });
                  socket.on('whiteboard', function(data) {
                      var client = getSocket(room, data.socketId);
  
                      if (client) {
                          client.emit('whiteboard', {
                              canvasData: data.canvasJson,
                              socketId: socket.id
                          });
                      }
                  });
  
                  socket.on('message', function(data) {
                      var client = getSocket(room, data.socketId);
                      console.log('message', data);
                      if (client) {
                          client.emit('message', {
                              message: data,
                              socketId: socket.id
                          });
                      }
                  });
                  socket.on('group_message', function(data) {
                      socket.broadcast.to(room).emit('group_message', {
                          socketId: socket.id,
                          message: data
                      });
                  });
  
                  socket.on('extend_time', function(data) {
                      socket.broadcast.to(room).emit('extend_time', {
                          socketId: socket.id,
                          message: data
                      });
                  });
                  socket.on('sync_time', function(data) {
                      socket.broadcast.to(room).emit('sync_time', {
                          socketId: socket.id,
                          message: data
                      });
                  });
  
                  socket.on('extend_time_accepted', function(data) {
                      socket.broadcast.to(room).emit('extend_time_accepted', {
                          socketId: socket.id,
                          message: data
                      });
                  });
  
                  socket.on('allow_student', function(data) {
                      socket.broadcast.to(room).emit('allow_student', data);
                  });
              } else {
                  socket.emit('room_full', {
                      socketId: socket.id
                  });
              }
          });
      });
  
  
      function getSocket(room, id) {
          var connections = rooms[room];
          if (!connections) {
              return;
          }
  
          for (var i = 0; i < connections.length; i++) {
              var socket = connections[i];
              if (id === socket.id) {
                  return socket;
              }
          }
      }
  })();
  function getCurrentTime(){
    var d = new Date();
     
     return   "'"+d.getUTCFullYear() + "-" + 
        ("00" + (d.getUTCMonth() + 1)).slice(-2) + "-" + 
        ("00" + d.getUTCDate()).slice(-2) + " " + 
        ("00" + d.getUTCHours()).slice(-2) + ":" + 
        ("00" + d.getUTCMinutes()).slice(-2) + ":" + 
        ("00" + d.getUTCSeconds()).slice(-2)+"'";
    }
    
  function makeThreadId(length) {
    var result           = '';
    var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    var charactersLength = characters.length;
    for ( var i = 0; i < length; i++ ) {
       result += characters.charAt(Math.floor(Math.random() * charactersLength));
    }
    return result;
 }