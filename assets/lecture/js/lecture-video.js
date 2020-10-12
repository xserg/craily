var apiKey     = openTok_key;

var sessionId = openToksession; 

var token     = opentokToken;

var videoOn = true;

var session = OT.initSession(apiKey, sessionId);

$("#session_id").val(session.id);

// Handling all of our errors here by alerting them

function handleError(error) {

  if (error) {

    toastr.error(error.message);

  }

}

var subscriber;

var publisher = {};

function initializeSession() {

  

  OT.getDevices(function(error, devices) {

   

    audioInputDevices = devices.filter(function(element) {

      return element.kind == "audioInput";

    });

    videoInputDevices = devices.filter(function(element) {

      return element.kind == "videoInput";

    });

    if(audioInputDevices.length == 0 || videoInputDevices.length == 0 ){

      socket.emit('no-device-media', {'audioInputDevices': audioInputDevices.length,'videoInputDevices':videoInputDevices.length,'fromUser':userId,'toUser':frndId}); 

      toastr.error("No media device found!");

    }

    

  });

  session.on({sessionDisconnected: function(event) {

    window.history.go(-1);

  }

  });

  function sendSignal() {

    session.signal({retryAfterReconnect: retrySignalOnReconnect});

  }

  // Subscribe to a newly created stream

  session.on('streamCreated', function(event) {

     subscriber =session.subscribe(event.stream, 'subscriber',

    {

      insertMode: 'append',

      width: '100%',

      height: '100%',

      frameRate:30,

      resolution: '1280x960',

      style: {videoDisabledDisplayMode:'off'}

    }, function(error)

    {

      if (error) {

        toastr.error('There was an error publishing: ', error.name, error.message);

      }

    });

    subscriber.on("videoDisable", function(event) 

    {

      subscriber.subscribeToVideo(false);

    });



   subscriber.on({

      disconnected: function(event) {

        toastr.error('Stream has been disconnected unexpectedly. Attempting to automatically reconnect...');

        subscriber.subscribeToVideo(false);

      },

      connected: function(event) {

        $("#subscriber_video").css("display","none");

        // $("#disablevideo").css("display","block")

        subscriber.subscribeToVideo(true);

      }

    }); 

  });

  

  session.on('connectionCreated', function (event) {

  

   // alert("event"+event.connection.connectionId+"session"+session.connection.connectionId);

  var yourMessage = {user_id: userId, user_name: username};

   session.signal({

       type: "userjoined",

       to: event.connection, // a Connection object

       data: JSON.stringify(yourMessage)

   });

  

});



session.on('connectionDestroyed', function (event) {

   session.signal({

       type: "userleaved", // a Connection object

       data: {user_id: userId, user_name: username}

   });

});





session.on("streamDestroyed", function (event) {

   session.signal({

       type: "userleaved",

       to: event.connection, // a Connection object

       data: {user_id: userId, user_name: username}

   });

   if (event.reason === 'networkDisconnected') {

       toastr.warning("Trainer is disconnected we will connect you once trainer is back!");

   }

   

   

});

// Connect to the session

  session.connect(token, function (error) {

    

    if (error) {

      if (error.name === "OT_NOT_CONNECTED") {

        toastr.warning("You are not connected to the internet. Check your network connection.");

      }else if(error.name === "OT_CREATE_PEER_CONNECTION_FAILED")

      {

        toastr.warning("Publishing your video failed. This could be due to a restrictive firewall.");

      }

    } else {

       publisher = OT.initPublisher('publisher', {

        insertMode: 'append',

        width: '100%',

        height: '100%',

        mirror: false,

        frameRate: 30,

        resolution: '1280x960',

        style: {buttonDisplayMode: 'off'}

    });

    

   

    publisher =  session.publish(publisher, function(error) {

      if (error) {

        if(error.name=='OT_HARDWARE_UNAVAILABLE')

        {

          toastr.error('The selected voice or video devices are unavailable. Verify that the chosen devices are not in use by another application');

        }else 

        if (error.name === 'OT_USER_MEDIA_ACCESS_DENIED') {

          toastr.error('Please allow access to the Camera and Microphone and try publishing again.');

        } else {

          toastr.error('Failed to get access to your camera or microphone. Please check that your webcam'

            + ' is connected and not being used by another application and try again.');

        }

       

      }

    });



    $("#publisher_id").val(publisher.id);

    publisher.on({

      accessAllowed: function (event) {

      },

      accessDenied: function accessDeniedHandler(event) {

        socket.emit('media-permission', {target: 'denied','fromUser':userId,'toUser':frndId}); 

       },

      accessDialogOpened: function (event) {

      }

    });

    

    publisher.on("streamDestroyed", function (event) 

    {

      if (event.reason === 'networkDisconnected') {

        toastr.error('Your publisher lost its connection. Please check your internet connection and try publishing again.');

      }

    });

    publisher.on("audioDisable", function(event) 

    {

      publisher.publishAudio(false);

    });

    publisher.on("videoDisable", function(event) 

    {

      publisher.publishVideo(false);

    });

    publisher.on({

        disconnected: function(event) {

          toastr.warning('Stream has been disconnected unexpectedly. Attempting to automatically reconnect...');

        },

        connected: function(event) {

          $("#publisher_video").css("display","none");

        }

      }); 

     

  }

  });

  session.on('signal:endSession', function (event) {

    sessionEnded();

});

  function disconnect() {

      session.disconnected();

  }

}



