<!doctype html>
<html lang="en" ng-app="kitchensink">

<head>
    <!-- Required meta tags -->
     <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <!-- for favicon end -->
    <title>Home</title>
    <link rel="stylesheet" href="<?= base_url('assets/lecture/css/bootstrap.min.css')?>" type="text/css">
    <link rel="stylesheet" href="<?= base_url('assets/lecture/css/icomoon.css')?>" type="text/css">
    <link rel="stylesheet" href="<?= base_url('assets/lecture/css/bootstrap-select.min.css')?>" type="text/css">
    <link rel="stylesheet" href="<?= base_url('assets/lecture/css/jquery.mCustomScrollbar.css')?>" type="text/css">
    <link rel="stylesheet" href="<?= base_url('assets/lecture/css/custom.min.css')?>" type="text/css">
    <script src="<?= base_url('assets/lecture/js/socket.io.js') ?>"></script>
    <script src="<?= base_url('assets/lecture/js/jquery.min.js') ?>"></script>
    <script src="<?= base_url('assets/lecture/js/html2canvas.js') ?>"></script>
    <script src="<?= base_url('assets/lecture/js/jquery.countdownTimer.min.js') ?>"></script>
    <link rel="stylesheet" href="<?= base_url('assets/css/toaster.css')?>" type="text/css">
    <script src="<?= base_url('assets/lecture/js/toaster.js') ?>"></script>
    <script src="<?= base_url('assets/lecture/js/toaster1.js') ?>"></script>
    <script src="<?= base_url('assets/lecture/js/ajaxupload.3.5.js') ?>"></script>
    <!-- <script src="<?= base_url('assets/lecture/js/jspdf.min.js') ?>"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
    
  <?php $eraseImg = base_url('assets/lecture/images/eraser-ic.png');
        $default  = base_url('assets/lecture/images/default.png');  ?>
    <style>
        .eraser-cursor{ cursor: url(<?php echo $eraseImg; ?>), auto !important; }
    </style>
 
</head>

<body >
     <input type="hidden" id="publisher_id" value="">
     <input type="hidden" id="artboardId" value="1">
     <input type="hidden" id="session_id" value="">
     <input type="hidden" id="canvas_height" value="">
     <input type="hidden" id="member_type" value="<?php echo $member_type; ?>">
    
     <?php 
      // updated start 09-10-2019 //
        $dataTime['hours']= isset($hours)?$hours:0;
        $dataTime['minutes']= isset($minutes)?$minutes:0;
        $this->load->view('includes/lecture/main-header',$dataTime);
        $this->load->view('includes/lecture/sub-header'); 
     // updated end 09-10-2019 //
        $openTok_key       = isset($openTok_apiKey)?$openTok_apiKey:'';
        $openTok_sessionId = isset($openTok_sessionId)?$openTok_sessionId:'';  
        $openTok_token     = isset($openTok_token)?$openTok_token:'';
        $socket_url        = isset($socket_url)?$socket_url:'';
        $memname           = isset($member_name)?$member_name:'';
     
     if($member_type=='student' && isset($member_type))
     {
         $memone = isset($member_id)?$member_id:'';
         $memtwo = isset($tutor_id)?$tutor_id:'';
      }else if($member_type=='tutor' && isset($member_type))
     {
         // updated start 01-31-2019 //
         $memone = isset($member_id)?$member_id:'';
         $memtwo = isset($student_id)?$student_id:'';
            // updated start 01-31-2019 //
     }
   ?>

<main class="main-content home-page"> 
 
        <div class="art-board" id="artBoard1">
          <canvas id="whiteboardCanvas1"></canvas>
        </div>  
        <div class="art-board" id="artBoard2" style="display:none"> 
            <canvas id="whiteboardCanvas2"></canvas>
        </div>
        <div class="art-board" id="artBoard3" style="display:none"> 
            <canvas id="whiteboardCanvas3"></canvas>
        </div>
        <div class="art-board" id="artBoard4" style="display:none"> 
            <canvas id="whiteboardCanvas4"></canvas>
        </div>
        <div class="art-board" id="artBoard5" style="display:none"> 
            <canvas id="whiteboardCanvas5"></canvas>
        </div>
 <!-- text editor html -->
        <div class="editor-box" id="editorBox">
            <div class="h-100">
                <textarea name="editor<?php echo $memone; ?>" id="editor<?php echo $memone; ?>" >
                You can begin typing or copy and paste your text here
            </textarea>
            </div>
        </div>
<!-- chat and video html -->
 <div class="right-content whiteboardcontent" id="right-content" >
            <div class="video-chat-wrap">
                <div class="video-chat-inner-wrap">
                    <div class="main-video">
                       <div class="video01" id="subscriber">
                            <div class="user-img-wrap" id="subscriber_video" style="display:block">
                                <img src="<?php echo $default; ?>" alt="default-user" class="default-user-img">
                            </div>
                        </div>
                        <div class="size-toggle d-flex">
                            <button class="resize-btn d-none" id="resizeBtn">
                                <i class="icomoon-auto-adjust-arrow"></i>
                            </button>
                            
                            <button class="ml-2 mic-btn" onclick="muteAudio()">
                                <i class="icomoon-mic"></i> 
                            </button>

                            <button class="ml-2 video-btn" onclick="videoDisable()">
                                <i class="icomoon-videocam"></i>
                            </button>
                        </div>
                    </div>
                    <div class="sub-video">
                        <div class="video02" id="publisher">
                            <div class="user-img-wrap" id="publisher_video" style="display:block">
                                <img src="<?php echo $default; ?>" alt="default-user" class="default-user-img">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="chat-wrap clearfix collapse">
                <div class="chat-header d-flex justify-content-between">
                    <p class="mb-0 font-md">CHAT</p>
                    <span id="typing"></span>
                    <div>
                        <i class="chat-slideup  icomoon-keyboard_arrow_up collapse-icon"></i>
                    </div>
                </div>
                <!-- xxxx -->
                <div class="chat-lower-wrap">
                    <div class="chat-body mCustomScrollbar" id="chatBodyScroll" data-mcs-theme="dark" id="msg">
                     </div>
                    <!-- xxxx -->
                    <div class="chat-footer">
                        <form action="" onsubmit="return false;" enctype="multipart/form-data"  id="submit">
                            <div class="d-flex align-items-center">
                                <textarea  rows="2" cols="20"   placeholder="Your Message Here" id="m" 
                                style="white-space: pre-wrap;white-space: -moz-pre-wrap;white-space: -pre-wrap;white-space: -o-pre-wrap;word-wrap: break-word;" 
                                wrap="hard"></textarea>
                                <label class="attach-file mb-0">
                                    <input type="file" name="uploadFile" id="uploadFile" accept="image/gif, image/jpeg, image/png, image/jpg,.xls,.xlsx,.docx,.PDF,.pdf,.txt">
                                    <i class="icomoon-clip"></i>
                                </label>
                                <button type="button" class="send-btn" id="sendMsg">
                                    <i class="icomoon-sent-mail"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>       
</main>

    <!-- confirmation modal -->
    <div class="modal delete-modal modal-effect " data-backdrop="static" data-keyboard="false"  tabindex="-1" role="dialog" id="ConfirmModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xs">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <img src="<?php echo base_url('assets/images/cross-gray.svg');?>" alt="cross-icon">
                    </button>
                </div>
                <div class="modal-body text-center">
                     <div class="modal-heading">
                        <h2>Are you sure you want to end lesson ?</h2>
                    </div>
                     <ul class="list-inline mb-0">
                        <li class="list-inline-item">
                            <a href="javascript:void(0);"  class="btn btn-success  ml-auto  ripple-effect" onclick="endSession()">Yes</a>
                        </li>

                        <li class="list-inline-item">
                            <a href="javascript:void(0);" data-dismiss="modal" aria-label="Close" class="btn btn-danger  ml-auto  ripple-effect">No</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>


    <!-- confirmation modal 02-->
    <div class="modal delete-modal modal-effect " data-backdrop="static" data-keyboard="false"  tabindex="-1" role="dialog" id="ConfirmModal02" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xs">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <img src="<?php echo base_url('assets/images/cross-gray.svg');?>" alt="cross-icon">
                    </button>
                </div>
                <div class="modal-body text-center">
                     <div class="modal-heading">
                        <h2>Are you sure you want to clear whiteboard ?</h2>
                    </div>
                     <ul class="list-inline mb-0">
                        <li class="list-inline-item">
                            <a href="javascript:void(0);" class="btn btn-success  ml-auto  ripple-effect" onclick="clearCanvasBoard()">Yes</a>
                        </li>

                        <li class="list-inline-item">
                            <a href="javascript:void(0);" data-dismiss="modal" aria-label="Close" class="btn btn-danger  ml-auto  ripple-effect">No</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
 

<script>
  
    // chat box height toggle$
    if ($(window).width() > 767){
        $(".chat-lower-wrap").addClass('collapse');
        $(".chat-header , .chat-slideup").click(function(){
            $(".chat-lower-wrap").slideToggle();
            $('.chat-slideup').toggleClass('icomoon-keyboard_arrow_up').toggleClass('icomoon-keyboard_arrow_down');
        });
    }


    $(window).resize(function() {
        //Fix white space issue in full screen video
        var chk_height = $('.main-header').outerHeight(true) + $('.subheader').outerHeight(true);
        var window_height = $(window).height();
        var final_height = window_height - chk_height;

        $(".main-content" ).css('min-height', final_height);
        $("#"+artboardId ).css('min-height', final_height);
        $( ".art-board .canvas-container" ).css('min-height', final_height);
        $("#canvas_height").val(final_height);
    })
    $(document).ready(function() {

        let chat ='<?php echo $chatMsg; ?>';
        let artboardId =  $("#artboardId").val(); 

        let url ="<?php echo base_url('Lecture/getchatmessage/'.$memone.'/'.$memtwo.'/') ?>"+sessionID;
        $.ajax({
            type: "GET",
            url: url,
            crossDomain: true,
            dataType : 'html',
            success: function (data) {
                console.log(data);
                $("#mCSB_1_container").append(data);
            },
            error: function (xhr, ajaxOptions, thrownError) {
            }
           });

           canvas.on('object:create', function (e) {
            var obj = e.target;
            // if object is too big ignore
            if(obj.currentHeight > obj.canvas.height || obj.currentWidth > obj.canvas.width){
                return;
            }        
            obj.setCoords();        
            // top-left  corner
            if(obj.getBoundingRect().top < 0 || obj.getBoundingRect().left < 0){
                obj.top = Math.max(obj.top, obj.top-obj.getBoundingRect().top);
                obj.left = Math.max(obj.left, obj.left-obj.getBoundingRect().left);
            }
            // bot-right corner
            if(obj.getBoundingRect().top+obj.getBoundingRect().height  > obj.canvas.height || obj.getBoundingRect().left+obj.getBoundingRect().width  > obj.canvas.width){
                obj.top = Math.min(obj.top, obj.canvas.height-obj.getBoundingRect().height+obj.top-obj.getBoundingRect().top);
                obj.left = Math.min(obj.left, obj.canvas.width-obj.getBoundingRect().width+obj.left-obj.getBoundingRect().left);
            }
            
        });
       
      
    });

          
    function isJson(obj) 
    {
        try {
            return (obj).toJSON(['id']);
        } catch (e) {
            return false;
        }
    }   
// Press Enter Chat message send to user  -- START 
$('#m').keyup(function (event) {
    if (event.keyCode == 13) {
        var content = this.value;  
        var caret = getCaret(this);          
        if(event.shiftKey){
            this.value = content.substring(0, caret - 1) + "\n" + content.substring(caret, content.length);
            event.stopPropagation();
        } else {
            this.value = content.substring(0, caret - 1) + content.substring(caret, content.length);
            $("#sendMsg").click();
        }
    }
});
function getCaret(el) 
{ 
    if (el.selectionStart) { 
        return el.selectionStart; 
    } else if (document.selection) { 
        el.focus();
        var r = document.selection.createRange(); 
        if (r == null) { 
            return 0;
        }
        var re = el.createTextRange(), rc = re.duplicate();
        re.moveToBookmark(r.getBookmark());
        rc.setEndPoint('EndToStart', re);
        return rc.text.length;
    }  
    return 0; 
}
// Press Enter Chat message send to user   -- END

    setTimeout(function () {
        $(window).resize(function () {
            let artboardId =  $("#artboardId").val(); 
            var chk_height = $('.main-header').outerHeight(true) + $('.subheader').outerHeight(true);
            var window_height = $(window).height();
            var final_height = window_height - chk_height;
            $(".main-content" ).css('min-height', final_height);
            $("#"+artboardId ).css('min-height', final_height); 
            $( ".art-board .canvas-container" ).css('min-height', final_height); 
            $( ".art-board .canvas-container" ).css('height', final_height); 
            $("#canvas_height").val(final_height);
        }).resize();
    }, 100); 

    var socket          =   io.connect('<?php echo $socket_url; ?>', {
                            reconnection: true,
                            reconnectionDelay: 1000,
                            reconnectionDelayMax : 5000,
                            reconnectionAttempts: Infinity
                        } );
    let userId          =   ('<?php echo $memone; ?>')?'<?php echo $memone; ?>':'';
    let frndId          =   ('<?php echo $memtwo; ?>')?'<?php echo $memtwo; ?>':'';
    let username        =   ('<?php echo $memname; ?>')?'<?php echo $memname; ?>':'';
    let opentokToken    =   '<?php echo $openTok_token; ?>';
    let openTok_key     =   '<?php echo $openTok_key; ?>';
    let openToksession  =   '<?php echo $openTok_sessionId; ?>';
    /** updated start 09-10-2019 */
    let sessionID       =   ('<?php echo $sessionID; ?>')?'<?php echo $sessionID; ?>':'';
    let member_type     =   ('<?php echo $member_type; ?>')?'<?php echo $member_type; ?>':'';
    let startTime       =   ('<?php echo $startTime; ?>')?'<?php echo $startTime; ?>':'';
    let earlyTime      =   ('<?php echo $earlyTime; ?>')?'<?php echo $earlyTime; ?>':'';
    let endTime         =   ('<?php echo $endTime; ?>')?'<?php echo $endTime; ?>':'';
    let subjectID       =   ('<?php echo $subject_id; ?>')?'<?php echo $subject_id; ?>':'';
       /** updated end  09-10-2019 */
</script>

<script src="<?= base_url('assets/lecture/js/fabric.min.js') ?>"></script>
<script src="<?= base_url('assets/lecture/js/jquery.mCustomScrollbar.concat.min.js') ?>"></script>
<script src="<?= base_url('assets/lecture/js/bootstrap-select.min.js') ?>"></script>
<script src="<?= base_url('assets/lecture/js/popper.min.js') ?>"></script>
<script src="<?= base_url('assets/lecture/js/ckeditor.js') ?>"></script>
<script src="<?= base_url('assets/lecture/js/bootstrap.min.js') ?>"></script>
<script src="<?= base_url('assets/lecture/js/whiteboard.js') ?>"></script>
<script src="https://static.opentok.com/v2/js/opentok.min.js"></script>
<script type="text/javascript" src="<?= base_url('assets/lecture/js/lecture-video.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/lecture/js/easytimer.min.js') ?>"></script>

<script>
  window.onload = function () {  
        document.onkeydown = function (e) {  
            return (e.which || e.keyCode) != 116;  
        };  
    } 
$(function () {
    var initClock = 0
     /** updated start 10-10-2019 */
     var sessionTimeup=0;
     var wait_10min;
    //  socket.emit('register', {"userId":userId,"frndId":frndId,'sessionID':sessionID,'member_type':member_type,'startTime':startTime,'endTime':endTime,'subjectID':subjectID}); 
    socket.emit('register', {"userId":userId,"frndId":frndId,'sessionID':sessionID,'member_type':member_type,'startTime':startTime,'endTime':endTime,'subjectID':subjectID,'hours':'<?php echo $hours; ?>','minutes':'<?php echo ($minutes>0)?$minutes:'00'; ?>','seconds':'<?php echo ($seconds>0)?$seconds:'00'; ?>'}); 
     socket.on('session_started',function(data){
        var sessionHours   = data.hours;
        var sessionMin     = data.minutes;
        var sessionSeconds = data.seconds;
        clearTimeout(wait_10min);
        toastr1.clear();
        toastr.clear();
        toastr["success"]("Both users connected.", "success");
        if(initClock > 0){
          jQuery("#clock"+(initClock-1)).remove();
        }

        jQuery("#clockContainer").html("<span id='clock"+initClock+"'>"+sessionHours+":"+sessionMin+":"+sessionSeconds+"</span> /<?php echo $lecture_time;?> <span style='display:none' id='clock"+(initClock+1)+"'></span>");
        jQuery("#clock"+initClock).countdowntimer({
            hours: sessionHours,
            minutes: sessionMin,
            seconds:sessionSeconds,
            size: "lg",
            timeUp: timeisUp,
            tickInterval : 1
        });
        initClock++;
         // 5 minute left reminder | 1 minute left reminder | Expire session
         setInterval(function() {
             var remainingTime = $('#clock0').html();
             if(remainingTime === '00:05:00') {
                 toastr["success"]("Your lesson ends in 5 minutes.", "Reminder");
             }
             if(remainingTime === '00:01:00') {
                 toastr["success"]("Your lesson ends in 1 minute.", "Reminder");
             }
             if(remainingTime === '00:00:05') {
                 toastr["success"]("Your lesson has ended.", "success");
             }
         },1000);

    //    let sessionHours   = '<?php echo $hours; ?>';
    //    let sessionMin     = '<?php echo ($minutes>0)?$minutes:'00'; ?>';
    //    let sessionSeconds ='<?php echo ($seconds>0)?$seconds:'00'; ?>';

        var minutes = parseInt(sessionHours)*60 + parseInt(sessionMin);
        if(minutes >= 2) {
            minutes-= 2;
            var hours = parseInt(minutes/60);
            minutes = minutes%60; 
            $("#clock"+initClock).countdowntimer({
                hours: hours,
                minutes: minutes,
                seconds:sessionSeconds,
                size: "lg",
                timeUp: timeisEnding
            });
            initClock++;
        }
     });

     function timeisEnding() 
     {
        toastr.clear();
        // toastr["success"]("This lesson will end in 2 minutes.", "Note");
     }

    socket.on('not_connected',function(res)
    {
        toastr1.clear();
        toastr1["error"](res.msg, "Error");
        wait_10min = setTimeout(function(){
                wait10EndSession();
            }
            , (600 + parseInt(earlyTime))*1000
        );
    });
   /** updated end  10-10-2019 */
    clearCanvas();
    videoSession();
     $(".subheader .draw-icon").click();
     $('.subheader .chat-btn').click();
    // update code 31-10-2019 
     $("#sendMsg").on("click",function(){
         
        var appendMsg = $('#m').val().split('\n'); 
        if($("#m").val()!='')
        {
            $('#m').val("");
            if(sessionTimeup==0)
            {
                let baseURL = '<?php echo base_url('ajax'); ?>';
                socket.emit('send_message', {'base_url':baseURL,'msg_type':"msg",'toUser':frndId,'message':appendMsg.join('<br />'),'fromUser':userId,'mediaURL':"",datetime:'<?php echo time(); ?>','sessionID':sessionID});
                socket.emit('typing', {'toUser':frndId,'d':''});
            }
        }
    });
    // Put from top to this place
       $('#uploadFile').change(function () {
          if(sessionTimeup==0)
            {
                var fd = new FormData(); 
                var times = Math.round(+new Date()/1000);
                var files = $('#uploadFile')[0].files[0]; 
                fd.append('file', files); 
                fd.append('times', times); 
                $("#mCSB_1_container").append('<div class="sent-msg clearfix loaderspan"><div class="loader"></div></div>');
                $.ajax({ 
                    url: '<?php echo base_url('Lecture/fileUpload'); ?>', 
                    type: 'post', 
                    data: fd, 
                    contentType: false, 
                    processData: false, 
                    success: function(response){
                      var json = $.parseJSON(response);
                       if(json.status==1)
                       {
                           let path         =   json.path;
                           let extension    =   json.extension;
                           let baseURL = '<?php echo base_url('ajax'); ?>'
                          socket.emit('send_message', {'base_url':baseURL,'msg_type':"attachment",'toUser':frndId,'message':path,'fromUser':userId,'mediaURL':"",datetime:'<?php echo time(); ?>','sessionID':sessionID});
                          socket.emit('typing', {'toUser':frndId,'d':''});
                       }else{
                        toastr.clear();
                        toastr["success"]("Error in send attachment file. Please try again.", "error");
                       }
                       $(".loaderspan").remove();
                    }, 
                });
            }
        });

         // Put from top to this place
    function timeisUp() 
     {
        sessionTimeup=1;
        socket.emit('clearChat', {'sessionID':sessionID,'toUser':frndId,'fromUser':userId});
        endSession();
     }
    socket.on('completedSession', function(data)
    {
        if(data.sessionID!='')
        {
            sessionTimeup=1;
            endSession();
        }
    });
    $(window).on("beforeunload", function() { 
       // socket.emit('browser-closed', {'sessionID':sessionID,'toUser':frndId,'fromUser':userId});
    //    if(sessionTimeup==0)
    //    {
    //     localStorage.setItem("sessionTimer", $("#clock").text());
    //    }else{
    //     window.localStorage.removeItem("sessionTimer");
    //    }
     });
    
     socket.on('browser-closed', function(data)
    {
        toastr.clear();
        toastr["error"]("Another user is disconnected", "Error");
        $("#ConfirmModal").modal('hide');
        setTimeout(function() {
        window.location.href = '<?php echo base_url('my-lessons'); ?>'
       }, 1000);
    });
    // update code 31-10-2019 
    socket.on("user-offline",function(msg)
    {
        var txthtml2='';
        let time =timeStampToTime(msg.time); 
          let chat_id = msg.chat_id;
           fileExtension = msg.msg.substr((msg.msg.lastIndexOf('.') + 1));
           if(msg.msg_type=='attachment')
           {
            let downloadIcon = '<?php echo base_url('assets/lecture/images/download-ic.png'); ?>';
            if(msg.sender_id==userId)
            {
                if(fileExtension=='docx' || fileExtension=='PDF' || fileExtension=='pdf'|| fileExtension=='txt')
               {
                  
                   let pdfIcon  = '<?php echo base_url('assets/lecture/images/pdf-ic.png'); ?>';
                   txthtml2 = "<div class='attachment text-right w-100'><div class='file d-inline-block mr-3'><img src='"+pdfIcon+"' alt='download' class='mCS_img_loaded'></div><a download href='"+msg.msg+"' class='download d-inline-block'><img src='"+downloadIcon+"' alt='download' class='mCS_img_loaded'></a><div class='time'>"+time+"</div></div>";
                }else{
                   txthtml2 = "<div class='attachment text-right w-100'><div class='file d-inline-block mr-3'><img  width='180' src='"+msg.msg+"' alt='download' class='mCS_img_loaded'><a download href='"+msg.msg+"' class='download d-inline-block'><img src='"+downloadIcon+"' alt='download' class='mCS_img_loaded'></a></div><div class='time'>"+time+"</div></div>";
                }           
            }
            if(msg.sender_id==frndId)
            {
                if(fileExtension=='docx' || fileExtension=='PDF' || fileExtension=='pdf'|| fileExtension=='txt')
               {
                  
                   let pdfIcon  = '<?php echo base_url('assets/lecture/images/pdf-ic.png'); ?>';
                   txthtml2 = "<div class='attachment text-left w-100'><div class='file d-inline-block ml-3'><img src='"+pdfIcon+"' alt='download' class='mCS_img_loaded'></div><a download href='"+msg.msg+"'  class='download d-inline-block'><img src='"+downloadIcon+"' alt='download' class='mCS_img_loaded'></a><div class='time'>"+time+"</div></div>";
                }else{
                    txthtml2 = "<div class='attachment text-left w-100'><a download href='"+msg.msg+"' class='download d-inline-block'><img src='"+downloadIcon+"' alt='download' class='mCS_img_loaded'></a><div class='file d-inline-block ml-3'><img width='180' src='"+msg.msg+"' alt='download' class='mCS_img_loaded'></div><div class='time'>"+time+"</div></div>";
               }
            }
        }else
        {
           if(msg.sender_id==userId)
            {
                txthtml2 = '<div class="sent-msg clearfix"><div class="msg" id="sentMsg">'+msg.msg+'</div><div class="time">'+time+'</div></div>';
            }
            if(msg.sender_id==frndId)
            {
                txthtml2 = '<div class="rcv-msg clearfix"><div class="msg">'+msg.msg+'</div><div class="time">'+time+'</div></div>';
            }
        }
        $("#mCSB_1_container").append(txthtml2);
    })

    $("#m").on("keyup",function(){
        let d = $("#m").val();
       socket.emit('typing', {'toUser':frndId,'d':d});
    });
    socket.on('typing', function(data)
    {
        if(data.d=='')
        { 
            $("#typing").text("");
        }else
        {
            $("#typing").text("Typing...");
        }
    });
     socket.on('new_msg_recieve', function(msg){
       
       if($('.chat-lower-wrap').css('display') == 'none')
        {
            $('.nav-link').removeClass('active');
            $(".chat-btn").addClass('active');
            $(".icomoon-keyboard_arrow_up").css("display","inline");
            $(".icomoon-keyboard_arrow_down").css("display","none");
            $('.chat-lower-wrap').css('display','block');
        }
          let time =timeStampToTime(msg.time); 
          let chat_id = msg.chat_id;
           var txthtml='';
           fileExtension = msg.msg.substr((msg.msg.lastIndexOf('.') + 1));
           if(msg.msg_type=='attachment')
           {
            let downloadIcon = '<?php echo base_url('assets/lecture/images/download-ic.png'); ?>';
            if(msg.sender_id==userId)
            {
                if(fileExtension=='docx' || fileExtension=='PDF' || fileExtension=='pdf' || fileExtension=='txt')
               {
                  
                   let pdfIcon  = '<?php echo base_url('assets/lecture/images/pdf-ic.png'); ?>';
                   txthtml = "<div class='attachment text-right w-100'><div class='file d-inline-block mr-3'><img src='"+pdfIcon+"' alt='download' class='mCS_img_loaded'></div><a download href='"+msg.msg+"' class='download d-inline-block'><img src='"+downloadIcon+"' alt='download' class='mCS_img_loaded'></a><div class='time'>"+time+"</div></div>";
                }else{
                   txthtml = "<div class='attachment text-right w-100'><div class='file d-inline-block mr-3'><a download href='"+msg.msg+"' class='download d-inline-block'><img src='"+downloadIcon+"' alt='download' class='mCS_img_loaded'></a><img  width='180' src='"+msg.msg+"' alt='download' class='mCS_img_loaded'></div><div class='time'>"+time+"</div></div>";
               }           
            }
            if(msg.sender_id==frndId)
            {
                if(fileExtension=='docx' || fileExtension=='PDF' || fileExtension=='pdf' || fileExtension=='txt')
               {
                  
                   let pdfIcon  = '<?php echo base_url('assets/lecture/images/pdf-ic.png'); ?>';
                   txthtml = "<div class='attachment text-left w-100'><div class='file d-inline-block ml-3'><img src='"+pdfIcon+"' alt='download' class='mCS_img_loaded'></div><a download href='"+msg.msg+"'  class='download d-inline-block'><img src='"+downloadIcon+"' alt='download' class='mCS_img_loaded'></a><div class='time'>"+time+"</div></div>";
                }else{
                   txthtml = "<div class='attachment text-left w-100'><div class='file d-inline-block ml-3'><img width='180' src='"+msg.msg+"' alt='download' class='mCS_img_loaded'><a download href='"+msg.msg+"' class='download d-inline-block'><img src='"+downloadIcon+"' alt='download' class='mCS_img_loaded'></a></div><div class='time'>"+time+"</div></div>";
               }
            }
         }else
        {
           if(msg.sender_id==userId)
            {
                txthtml = '<div class="sent-msg clearfix"><div class="msg" id="sentMsg">'+msg.msg+'</div><div class="time">'+time+'</div></div>';
            }
            if(msg.sender_id==frndId)
            {
                txthtml = '<div class="rcv-msg clearfix"><div class="msg">'+msg.msg+'</div><div class="time">'+time+'</div></div>';
            }
        }
        $("#mCSB_1_container").append(txthtml);
        $('.subheader .chat-btn').click();
       });
    var newCanvasHeight=$(".canvas-container").height();
    var videoheight = $(".video-chat-wrap").height();
    var chatHeader  = $(".chat-header").outerHeight();
    var videoOffset = $('.video-chat-wrap').offset().top  - $('.main-content').offset().top;
    finalExtraHeight = newCanvasHeight - videoheight-chatHeader - 70 - videoOffset ;
    $(".chat-body").css('max-height', finalExtraHeight);
    $(".chat-body").css('min-height', finalExtraHeight);
          
    });
  
 function endSession()
{
   socket.emit('disconnectedsession', {"fromUser":userId,"toUser":frndId, "member_type":member_type, "session_id":sessionID});
   toastr.clear();
    toastr["success"]("Your session has been expired", "Success");
    $("#ConfirmModal").modal('hide');

    $.ajax({
        url: '<?php echo base_url(); ?>video-lecture-completed',
        data : {'lesson':sessionID},
        dataType: 'JSON',
        method: 'POST',
        success: function (rs) {
            if(rs.status==1){
                window.location.href = '<?php echo base_url('my-lessons'); ?>';
            } else {
                alert('Something went wrong!')
                window.location.href = '<?php echo base_url('my-lessons'); ?>';
            }
        },
        complete: function (rs) {
            //setTimeout(function() {
            //    window.location.href = '<?php //echo base_url('my-lessons'); ?>//';
            //}, 2000);
        }
    })
    //setTimeout(function() {
    //    window.location.href = '<?php //echo base_url('my-lessons'); ?>//'
    //   }, 2000);
 }

 function wait10EndSession()
{
   
   toastr.clear();
    toastr["error"](member_type.charAt(0).toUpperCase() + member_type.slice(1) + " has <?php echo $hours; ?>:<?php echo ($minutes>0)?$minutes:'00'; ?> to join this lesson", "Note");
    $("#ConfirmModal").modal('hide');
    setTimeout(function() {
        socket.emit('disconnectedsession', {"fromUser":userId,"toUser":frndId, "member_type":member_type, "session_id":sessionID});
       }, 5000);
 }

socket.on('disconnectedsession', function(data)
{
    toastr.clear();
    toastr["success"]("Your session has been expired", "Success");
    //setTimeout(function() {
    //    window.location.href = '<?php //echo base_url('my-lessons'); ?>//'
    //   }, 2000);

    $.ajax({
        url: '<?php echo base_url(); ?>video-lecture-completed',
        data : {'lesson':sessionID},
        dataType: 'JSON',
        method: 'POST',
        success: function (rs) {
            if(rs.status==1){
                window.location.href = '<?php echo base_url('my-lessons'); ?>';
            } else {
                alert('Something went wrong!')
                window.location.href = '<?php echo base_url('my-lessons'); ?>';
            }
        },
        complete: function (rs) {
            //setTimeout(function() {
            //    window.location.href = '<?php //echo base_url('my-lessons'); ?>//';
            //}, 2000);
        }
    })
});
function videoSession()
{
    $("#right-content").removeClass("whiteboardcontent");
    if($("#publisher_id").val()=='')
    {
        initializeSession();
    }
    socket.emit('videocallevent', {"fromUser":userId,"toUser":frndId});
    if (!$(".right-content").hasClass("video-size")) 
    {
       $('#commands').addClass('disabled')
    }
    $('.nav-link').removeClass('active');
    $(".video-btn").addClass('active');
    $(".video-chat-wrap , #right-content").css("display",'block');
    $(".chat-wrap").css("display",'none');
 }
socket.on('videocallevent', function(data)
{  
    $("#right-content").removeClass("whiteboardcontent");
    $("#right-content").removeClass("video-size");
    $(".video-chat-wrap,#right-content").css("display",'block');
    $('.nav-link').removeClass('active');
    $(".video-btn").addClass('active')
    if(!$("#publisher_id").val())
    {  
        initializeSession();
    }
    $('#commands').addClass('disabled');
    $(".chat-wrap").css("display",'none');
    $("#resizeBtn").removeClass('d-none');
 });

socket.on('videocallend', function(data)
{
     if(data.getWidth){
        var newCanvasHeight=$(".canvas-container").height();
        if(getWidth<=data.getWidth){
          $("#artBoard"+$("#artboardId").val()).css('height',(data.getHeight*getWidth)/data.getWidth);
           canvas.setHeight((data.getHeight*getWidth)/data.getWidth);
           strock           = (3*getWidth)/data.getWidth;
           drawingstrock    = (3.5*getWidth)/data.getWidth;
           font_Size        = (24*getWidth)/data.getWidth;
        }else{
           socket.emit('resizewindowHeight', {"fromUser":userId,"toUser":frndId,'getHeight':newCanvasHeight,'getWidth':getWidth});
       } 
    }
    $("#right-content").addClass("whiteboardcontent");
    $('.video-chat-wrap , .chat-wrap').hide();
    $('.subheader .chat-btn , .subheader .video-btn').removeClass('active');
    $(".fullboard-btn").addClass('active');
    $("#editorBox").hide();
    $("#editorBtn").removeClass("active");
    $('#editArtBoardBtn').addClass("active");
    let artboardId =  $("#artboardId").val(); 
    $("#artBoard"+artboardId).show();
    $('#commands').removeClass('disabled');
});
    socket.on('resizewindowWidth',function(data)
    {
           $("#artBoard"+$("#artboardId").val()).css('width',data.getWidth);
           $("#artBoard"+$("#artboardId").val()).css('margin','0 auto');
           $(".canvas-container").addClass('canvas-border');
           $("#whiteboardCanvas"+$("#artboardId").val()).css('width',data.getWidth);
           $(".upper-canvas").css('width',data.getWidth);
           canvas.setWidth(data.getWidth);
    });
     socket.on('resizewindowHeight',function(data)
    {
        
           $("#artBoard"+$("#artboardId").val()).css('height',data.getHeight);
           $("#artBoard"+$("#artboardId").val()).css('margin','0 auto');
           strock           = (3*getWidth)/data.getWidth;
           font_Size        = (24*getWidth)/data.getWidth;
           drawingstrock    = (3.5*getWidth)/data.getWidth;
           canvas.setHeight(data.getHeight);
       
    });
socket.on('change-whiteBoard', function(data)
{
    changeWhiteboard(data);
    $('#whiteboards').val(data);
    $("#whiteboards option[value='"+data+"']").attr("selected", "selected");
    $('#whiteboards').selectpicker('refresh');
 });
socket.on('video-whiteboard-add', function(data)
{
       $(".right-content").addClass('video-size');
       $("#right-content").removeClass("whiteboardcontent");
       $('#right-content').css('display', 'block');
       $(".video-chat-wrap,.chat-wrap").css("display","block");
       $('#commands').removeClass('disabled');
       $('.subheader .fullboard-btn').removeClass('active');
       $('.subheader .video-btn').removeClass('active');
       $('.subheader .chat-btn').addClass('active');
       $('#resizeBtn').addClass('d-none');
});
socket.on('video-whiteboard-remove', function(data)
{
    if ($(".right-content").hasClass("video-size")) 
    {
       $(".right-content").removeClass('whiteboardcontent');
       $(".right-content").removeClass('video-size');
       $('#commands').addClass('disabled')
    }

});
socket.on('object-ArtBoard', function(data)
{
                let artboardId =  $("#artboardId").val(); 
                $("#artBoard"+artboardId).show();
                $("#editorBox").hide();
                $("#artBoardOption").show();
                $("#editorOption").hide();
                $("#editorBtn").removeClass("active");
                $("#editArtBoardBtn").addClass("active");
                $('.subheader .fullboard-btn').addClass('active');
                $('.video-chat-wrap').hide();
                $('.chat-wrap').hide();
                $("#artBoard"+artboardId).show();
                $('.subheader .chat-btn , .subheader .video-btn').removeClass('active');
                $('#commands').removeClass('disabled');
});
socket.on('object-editorArea', function(data)
{
                let artboardId =  $("#artboardId").val(); 
                $("#artBoard"+artboardId).hide();
                $("#editorBox").show();
                $("#artBoardOption").hide();
                $("#editorOption").show();
                $("#editArtBoardBtn").removeClass("active");
                $("#editorBtn").addClass("active");
                $(".fullboard-btn").removeClass("active"); 
                $('.size-toggle .resize-btn i').removeClass('icomoon-auto-adjust-arrow').addClass('icomoon-full-page-arrow');
                $('.right-content').addClass('video-size');
                $('#commands').addClass('disabled');
                $(".video-chat-wrap").css("display","none");
                $(".nav-link ").removeClass('active');
                $(".right-content").css("display","none");
                setEditorHeight();
});

// Video call Media permission
socket.on('media-permission', function(data){
    toastr.error("User has denied access to the camera and mic");
});
socket.on('no-device-media', function(data){
    if(data.audioInputDevices==0 && data.videoInputDevices!=0)
    {
        toastr.error("User has not started to mic or not attached");
    }else  if(data.videoInputDevices==0 && data.audioInputDevices!=0)
    {
        toastr.error("User has not started to camera or not attached");
    }else{
        toastr.error("User has not started to the camera and mic");
    }
    var newCanvasHeight=$(".canvas-container").height();
 });

$(".color-code").click(function()
{
    let colorcode = this.getAttribute("data-color");
    let colorname = this.getAttribute("data-classname");
    
    $("#drawing-color").val(colorcode);
   
    var className=$('.color-box').attr('class').split(' ')[1];
    $( ".color-box" ).removeClass( className ).addClass(colorname);
    let idEvents= $(".nav-item").find(".active").attr('id');
    if(idEvents=='draw_pencil')
    {
        enableDrawing();
    }
    if(idEvents=='draw_text' || idEvents=='draw_select')
    {
        setColor(colorcode);
    }
})
// function CKEDITOR Function
function timeStampToTime(unixTimeStamp)
{
 var timestampInMilliSeconds = unixTimeStamp*1000;
 var date = new Date(timestampInMilliSeconds);
 var day = (date.getDate() < 10 ? '0' : '') + date.getDate();
 var month = (date.getMonth() < 9 ? '0' : '') + (date.getMonth() + 1);
 var year = date.getFullYear();
 var hours = ((date.getHours() % 12 || 12) < 10 ? '0' : '') + (date.getHours() % 12 || 12);
 var minutes = (date.getMinutes() < 10 ? '0' : '') + date.getMinutes();
 var meridiem = (date.getHours() >= 12) ? 'pm' : 'am';
 var formattedDate = day + '-' + month + '-' + year + ' at ' + hours + ':' + minutes + ' ' + meridiem;
 return  hours + ':' + minutes + ' ' + meridiem;
}
 // Chat End using Socket : BL
function selectObject(id) {
    ActiveItem(id);
    selectTool();
}

function clearCanvas(id) {
    ActiveItem(id);
    clearCanvasBoard();
}
function eraseCanvas(id) {
    ActiveItem(id);
    eraserCanvas();
   }

document.getElementById('addPicture').onchange = function handleImage(e) {
    addImage(e);
}

function addPencil(id) {
    ActiveItem(id);
    enableDrawing();
}

function addCricle(id) {
    $("#selectedIcon").removeAttr('class').addClass('icon-circle-thin');
    ActiveItem(id);
    draw_circle();
}

function addRectangle(id) {
    $("#selectedIcon").removeAttr('class').addClass('icon-square1');
    ActiveItem(id);
    draw_rect(id);
}

function addtriangle(id) {
    $("#selectedIcon").removeAttr('class').addClass('icon-triangle1');
    ActiveItem(id);
    draw_triangle();
}

function addLine(id) {
    $("#selectedIcon").removeAttr('class').addClass('icon-straight-horizontal-line');
    ActiveItem(id);
    draw_line();
}

function addText(id) {
    ActiveItem(id);
    draw_text();
}

function undo(id) {
    ActiveItem(id);
    undoAction();
}

function redo(id) {
    ActiveItem(id);
    redoAction();
}

/**
 * Save Canvas Picture
 */
    document.getElementById('downloadCanvas').addEventListener('click', function saveImage(e) {
        let artboardId =  $("#artboardId").val(); 
     
        if($('#editorBtn').hasClass('active'))
        {
          var value = CKEDITOR.instances['editor<?php echo $memone; ?>'].getData();
          var doc = new jsPDF();          
          var source = window.document.getElementsByTagName("body")[0];
            doc.fromHTML(value,10,10,{'width': 170});
            doc.output('save', 'canvas.pdf');
                
        }else{
            canvas.backgroundColor = '#fff';
            canvas.renderAll();
            this.href = canvas.toDataURL({
                format: 'png',
                quality: 0.8
            });
            this.download = 'canvas.png';
            canvas.backgroundColor = '';
            canvas.renderAll();
        }
       
    });

      (function(){
        var mainScriptEl = document.getElementById('main');
        if (!mainScriptEl) return;
        var preEl = document.createElement('pre');
        var codeEl = document.createElement('code');
        codeEl.innerHTML = mainScriptEl.innerHTML;
        codeEl.className = 'language-javascript';
        preEl.appendChild(codeEl);
        document.getElementById('bd-wrapper').appendChild(preEl);
      })();
     
        //modal open
        function confirmationModal(){
          $('#ConfirmModal').modal('show');
        }
        function confirmationModal02(){
          $('#ConfirmModal02').modal('show');
        }


        // on video call size button click
        $('.size-toggle .resize-btn').on('click', function(){
          
            $(this).find('i').toggleClass('icomoon-auto-adjust-arrow').toggleClass('icomoon-full-page-arrow');
             $('.right-content').toggleClass('video-size');
            if ($(".right-content").hasClass("video-size")) {
              $(".right-content").addClass('whiteboardcontent');
              $(".video-chat-wrap").css("display","block");
              socket.emit('video-whiteboard-add', {"fromUser":userId,"toUser":frndId});
              $('#commands').removeClass('disabled')
            }else{
                $(".right-content").removeClass('whiteboardcontent');
                socket.emit('video-whiteboard-remove', {"fromUser":userId,"toUser":frndId});
                $('#commands').addClass('disabled')
            }
        });

        socket.on('chat-hide', function(data)
            {
                $('.subheader .chat-btn').removeClass('active');
                $(".main-video .size-toggle .resize-btn").find('i').addClass('icomoon-auto-adjust-arrow').removeClass('icomoon-full-page-arrow');
                $(".chat-wrap").hide();
            });
        // on video button and chat button event in desktop to tab view
        if ($(window).width() >= 767){
           // on chat open button click form subheader
            $('.subheader .chat-btn').on('click', function(){
                $(this).addClass('active');
				
                $('.subheader .fullboard-btn').removeClass('active');
                $('.subheader .video-btn').removeClass('active');
				$('.subheader .fullboard-btn').removeClass('active');
                $('.chat-wrap').show();
                $("#resizeBtn").addClass('d-none')
                $('.right-content').addClass('video-size');
                $('#commands').removeClass('disabled');
                $('.video-chat-wrap').show();
                $("#right-content").removeClass("whiteboardcontent");
                $('#right-content').css('display', 'block');
                socket.emit('video-whiteboard-add', {"fromUser":userId,"toUser":frndId});
            });
               // on video button click form subheader
            $('.subheader .video-btn').on('click', function(){
                $(this).addClass('active');
                $('.subheader .fullboard-btn').removeClass('active');
                $('.video-chat-wrap').show();
                $('.right-content').removeClass('video-size');
                $('.chat-wrap').hide();
                $('#editArtBoardBtn').removeClass("active");
                $("#resizeBtn").removeClass('d-none')
                videoSession();
            });
        }
            $("#resizeBtn").on('click',function()
            {
                $('.subheader .chat-btn').click();
                $("#resizeBtn").addClass('d-none')
            })

        // on full board button click form subheader
        $('.subheader .fullboard-btn').on('click', function(){
             var newCanvasHeight=$(".canvas-container").height();
            let artboardId =  $("#artboardId").val(); 
            $(this).addClass('active');
            $('.subheader .chat-btn , .subheader .video-btn').removeClass('active');
            $('.video-chat-wrap').hide();
            $('.chat-wrap').hide();

            $("#artBoard"+artboardId).show();
            $("#editorBox").hide();
            $("#editorBtn").removeClass("active");
            $('#editArtBoardBtn').addClass("active");
            $('#commands').removeClass('disabled');
            socket.emit('videocallend', {"fromUser":userId,"toUser":frndId,'getHeight':newCanvasHeight,'getWidth':getWidth});
            $("#right-content").addClass("whiteboardcontent");
            $('.video-chat-wrap , .chat-wrap').hide();
            $('.fullboard-btn').addClass('active');
        });

       
        // on video button and chat button event in mobile view
        if ($(window).width() <= 767){ 
            $('.subheader .video-btn').on('click', function(){
                $(this).addClass('active');
                $('.video-chat-wrap').show();
                $('.chat-wrap').hide();
                $('.subheader .fullboard-btn').removeClass('active');
                $('.subheader .chat-btn').removeClass('active');
                $("#right-content").removeClass("whiteboardcontent");
            });
         
            // on mobile view set chat body dynamic height function
            function setHeight(){
                var header_height = $('.main-header').height();
                var window_height = $(window).height();
                var chat_extra_height = $('.chat-footer').outerHeight() + $('.chat-header').outerHeight();
                var final_height =  window_height - (header_height + chat_extra_height + 30);
                $(".chat-body").css('max-height', final_height);
                $(".chat-body").css('min-height', final_height);
                
            }

            // on chat button
            $('.subheader .chat-btn').on('click', function(){
                $(this).addClass('active');
                $('.chat-wrap').show();
                $('.video-chat-wrap').hide();
                $('.subheader .fullboard-btn').removeClass('active');
                $('.subheader .video-btn').removeClass('active');
                $('.right-content').removeClass('video-size');
                $('#resizeBtn').addClass('d-none');
                // at mobile view height function
                if($(window).width() <= 767){
                    setHeight();  
                        setTimeout(function(){
                        $(window).on(' resize', function(){
                            setHeight();
                        });
                    }, 1500);
                }
            });
        }

        function setEditorHeight()
        {
            if ($(window).width() <= 991){
                var subheader_height_ckeditor = 0;
            }else{
                var subheader_height_ckeditor = $('.subheader').height();
            }
           
            var header_height_ckeditor    = $('.main-header').height();
            var window_height_ckeditor    = $(window).height();
            var final_height_ckeditor     =  window_height_ckeditor - header_height_ckeditor - subheader_height_ckeditor - 42;
            $('#cke_1_contents').css('height', final_height_ckeditor);
            var editor =  CKEDITOR.replace( 'editor<?php echo $memone; ?>', {
				on: {
				instanceReady: function() {
					// Autosave but no more frequent than 1 sec.
					var buffer = CKEDITOR.tools.eventsBuffer( 5000, function() {
						if(window.enableOnChange == true){
							if(memberType == window.ckeditorMode)
							{
								socket.emit('text-editor', {target:editor.getData(),"fromUser":userId,"toUser":frndId, 'ckeditorMode': memberType});
							}
							else{
								
								window.ckeditorMode = memberType;
							}
						}
					} );         
					
					this.on( 'change', buffer.input );
					}
				}
			});
            let memberType = '<?php echo $member_type; ?>';
            
            editor.on("change", function()
             {
                /*if(window.enableOnChange == true){
                    if(memberType == window.ckeditorMode)
                    {
                        socket.emit('text-editor', {target:editor.getData(),"fromUser":userId,"toUser":frndId, 'ckeditorMode': memberType});
                    }
                    else{
                        
                        window.ckeditorMode = memberType;
                    }
                }*/
              });
              
            socket.on('text-editor', function(data)
            {
                window.enableOnChange   = false;
                window.ckeditorMode     = data.ckeditorMode;
                editor.setData(data.target);
                window.enableOnChange   = true;
            });
        }


        $(window).resize(function () {
           setEditorHeight();
        }).resize();


        // initialize selectpicker
        $('.selectpicker').selectpicker();


        // on click whiteboard and text editor hide show
        $(document).ready(function(){
            $("#editArtBoardBtn").click(function(){
                let artboardId =  $("#artboardId").val(); 
                $("#artBoard"+artboardId).show();
                $("#editorBox").hide();
                $("#artBoardOption").show();
                $("#editorOption").hide();
                $("#editorBtn").removeClass("active");
                $(this).addClass("active");
                $('.subheader .fullboard-btn').addClass('active');
                $('.video-chat-wrap').hide();
                $('.chat-wrap').hide();
                $("#artBoard"+artboardId).show();
                $('.subheader .chat-btn , .subheader .video-btn').removeClass('active');
                socket.emit('object-ArtBoard', {"fromUser":userId,"toUser":frndId});
                $('.subheader .fullboard-btn').click();
                $('#commands').removeClass('disabled');
            });
            
            $("#editorBtn").click(function(){
                let artboardId =  $("#artboardId").val(); 
                $("#artBoard"+artboardId).hide();
                $("#editorBox").show();
                $("#artBoardOption").hide();
                $("#editorOption").show();
                $("#editArtBoardBtn").removeClass("active");
                $(this).addClass("active");
                $(".fullboard-btn").removeClass("active"); 
                // $('.right-content').addClass('video-size');
                $('#commands').addClass('disabled');
                $(".right-content").css("display","none");
                $(".nav-link ").removeClass('active');
                socket.emit('object-editorArea', {"fromUser":userId,"toUser":frndId});
            });

            // in mobile click on text editor button
            if($(window).width() <= 767){
                $("#editorBtn").click(function(){
                    $('.video-chat-wrap , .chat-wrap').hide();
                    $('.subheader .chat-btn , .subheader .video-btn').removeClass('active');
                    $('.right-content').removeClass('video-size');
                });
            }
        });

       $('.ripple-effect, .ripple-effect-dark').on('click', function(e) {
            var rippleDiv = $('<span class="ripple-overlay">'),
                rippleOffset = $(this).offset(),
                rippleY = e.pageY - rippleOffset.top,
                rippleX = e.pageX - rippleOffset.left;

            rippleDiv.css({
                top: rippleY - (rippleDiv.height() / 2),
                left: rippleX - (rippleDiv.width() / 2),
            }).appendTo($(this));

            window.setTimeout(function() {
                rippleDiv.remove();
            }, 800);
        });
 
        //initialize scroll
        $("#chatBodyScroll").mCustomScrollbar({
            callbacks:{
                onUpdate:function(){
                     $(this).mCustomScrollbar('scrollTo','bottom');
                }
            }
        });

        // close menu in mobile devices
        $('.navbar-nav>li>a , .dropdown-menu .dropdown-item, .dropdown-menu .color-code, #editorBtn').not($('.dropdown-toggle , .undo-icon')).on('click', function(){
            $('.navbar-collapse').collapse('hide');
        });

        function muteAudio()
        {
          if(muteStatus==false)
            {   
                 publisher.publishAudio(false);
                 muteStatus=true;
                 $(".icomoon-mic").addClass('icomoon-mic_off');
               
            }else{
                publisher.publishAudio(true);
                muteStatus=false;
                $(".icomoon-mic").removeClass('icomoon-mic_off');
             }
        }
        function videoDisable()
        {
            if(videoDisableflag==false)
            {   
                 publisher.publishVideo(false);
                 videoDisableflag=true;
                 $(".icomoon-videocam").addClass('icomoon-videocam_off');
               
            }else{
                publisher.publishVideo(true);
                videoDisableflag=false;
                $(".icomoon-videocam").removeClass('icomoon-videocam_off');
             }
        }
	   function screenShare() {
            OT.checkScreenSharingCapability(function(response) {
                console.log(response)
                if(!response.supported || response.extensionRegistered === false) {
                    // This browser does not support screen sharing
                    alert("not supported");
                } else{
                    var screenSharingPublisher = OT.initPublisher(
                        'screen-publisher1',
                        { videoSource : 'screen' },
                        function(error) {
                        if (error) {
                            alert('Something went wrong: ' + error.message);
                        } else {
                            session.publish(
                            screenSharingPublisher,
                            function(error) {
                                if (error) {
                                    alert('Something went wrong: ' + error.message);
                                }
                            });
                        }
                    });
                }
            });
        }
    </script>
</body>
</html>