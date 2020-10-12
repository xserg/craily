/**
 * Created by hp on 2/8/2017.
 */
(function () {
  'use strict'

  angular.module('suli', ['ui.router', 'suli.main', 'suli.webrtc', 'suli.chat', 'suli.whiteboard']);
})();
/**
 * Created by hp on 2/8/2017.
 */

!(function() {
  "use strict";

  angular
    .module("suli")
    .config([
      "$stateProvider",
      "$urlRouterProvider",
      "$locationProvider",
      config
    ]);

  function config($stateProvider, $urlRouterProvider, $locationProvider) {
    $locationProvider.html5Mode({
      enabled: true,
      requireBase: false
    });
    // $urlRouterProvider.otherwise('/online/osztalyterem/');
    $urlRouterProvider.otherwise("/");
    $stateProvider
      .state("layout", {
        templateUrl: "app/modules/main/views/main.html",
        controller: "MainController"
      })
      .state("layout.main", {
        url: "/",
        views: {
          webrtc: {
            templateUrl: "app/modules/webrtc/views/video.html",
            controller: "WebrtcController"
          },
          chat: {
            templateUrl: "app/modules/chat/views/chat.html",
            controller: "ChatController"
          },
          whiteboard: {
            templateUrl: "app/modules/whiteboard/views/whiteboard.html",
            controller: "WhiteBoardController"
          }
        }
      });
  }
})();

!(function () {
    'use strict';
    angular.module('suli.chat', ['ui.router','angularMoment']);
})();
!(function() {
    'use strict';
    angular.module('suli.chat').controller('ChatController', ['$scope', '$state', 'moment', '$http', function($scope, $state, moment, $http) {
        $scope.messages = [];
        $scope.message = '';
        $scope.socketId = prortc.selfSocketId;
        setTimeout(function() {
            $scope.socketId = prortc.selfSocketId;
        }, 2000);

        prortc.on('message', function(data) {
            $scope.socketId = prortc.selfSocketId;
            $scope.$apply(function() {
                $scope.messages.push(data.message);
                chatWindowScroll();
            });
        });


        $scope.send = function() {
            if ($scope.message !== '') {
                var content = { content: $scope.message, created_at: new Date(), type: 'text', socketId: prortc.otherSocketId };
                $scope.messages.push(content);
                prortc.socket.emit('message', content);
                prortc.sendMessage(content);
                $scope.message = '';
                chatWindowScroll();
            }
        }

        $scope.keyPressSend = function(event) {
            if (event.keyCode == 13) {
                $scope.send();
            }
        };


        $scope.selectFile = function selectFile() {
            var element = angular.element("#file");
            element.click();
        }
        $scope.shareFile = function addImage(e) {
            var formData = new FormData();
            formData.append('file', e.files[0]);

            $http.post('https://suli.prortc.com/upload', formData, {
                transformRequest: angular.identity,
                headers: { 'Content-Type': undefined }
            }).then(function(data) {
                if (data.data.success) {
                    var content = {
                        filePath: 'https://suli.prortc.com/' + data.data.filePath,
                        fileName: data.data.filename,
                        type: 'file',
                        created_at: new Date(),
                        socketId: prortc.otherSocketId
                    };
                    $scope.messages.push(content);
                    prortc.socket.emit('message', content)
                }
            }, function(error) {
                console.log('File upload error->', error);
            });
        }

        function chatWindowScroll() {
            $("#MessageList").animate({
                scrollTop: $('#MessageList')[0].scrollHeight
            }, 500);
        }
    }]);
})();
/**
 * Created by hp on 2/8/2017.
 */
(function () {
  'use strict'

  angular.module('suli.webrtc', ['ui.router']);
})();

/**
 * Created by hp on 2/11/2017.
 */
(function() {
  "use strict";

  function WebrtcService() {
    var prortc = window.prortc;
    var roomData;

    return {
      connect: function(socketUrl, data) {
        if (data.room) {
          prortc.init(socketUrl);
          roomData = data;
          prortc.joinRoom(roomData);
        }
      },
      startCall: function(callback) {
        prortc.startCall(
          {
            video: true,
            audio: true
          },
          function(stream) {
            //prortc.joinRoom(roomData);
            callback(stream);
          },
          function(error) {            
            callback(false);
          }
        );
      },
      getSocket: function() {
        return prortc.socket;
      },
      getSocketIds: function() {
        return prortc.sockets;
      }
    };
  }

  angular.module("suli.webrtc").factory("WebrtcService", [WebrtcService]);
})();


/**
 * Created by hp on 2/11/2017.
 */
!(function() {
    'use strict';
    angular.module('suli.webrtc').controller('WebrtcController', ['$scope', '$rootScope', '$state', 'moment', 'WebrtcService', function($scope, $rootScope, $state, moment, WebrtcService) {

        angular.element('[data-toggle="tooltip"]').tooltip();

        $scope.videoClass = 'glyph-icon flaticon-video-1';
        $scope.audioClass = 'glyph-icon flaticon-microphone';
        $scope.isSwitch = 1;
        $scope.audioToggle = function() {
            if ($scope.audioClass === 'glyph-icon flaticon-microphone') {
                $scope.audioClass = 'glyph-icon flaticon-muted';
            } else {
                $scope.audioClass = 'glyph-icon flaticon-microphone';
            }
            prortc.muteAudioToggle();
        }

        $scope.changeSwitch = function(switchUser) {
            prortc.emit('tutor_switch_whiteboard', { allowStudent: switchUser });
            prortc.socket.emit('allow_student', { allowStudent: switchUser });
        }

        $scope.videoToggle = function() {
            if ($scope.videoClass === 'glyph-icon flaticon-video-1') {
                $scope.videoClass = 'glyph-icon flaticon-no-video';
            } else {
                $scope.videoClass = 'glyph-icon flaticon-video-1';
            }
            prortc.muteVideoToggle();
        }
        $scope.courseTimer, $scope.secondsFromStart = 0;
        $scope.secondsLeft = 3600;
        $scope.isStopped = false;
        $scope.isPeerDisconnected = false;
        $scope.isCallRunning = false;
        $scope.isOtherConnected = false;
        $scope.intervalObjects=[];

        prortc.on('start_call', function(data) {
            WebrtcService.connect('https://suli.prortc.com/', data);
            //WebrtcService.connect('http://localhost:3400/', data);
            if (data.role === 'tutor') {
                $scope.secondsLeft = data.noOfCourses * 3600;
                prortc.noOfCourses = data.noOfCourses;
                prortc.socket.emit('no_of_courses', { noOfCourses: data.noOfCourses });
            }
            prortc.userRole = data.role;
            WebrtcService.startCall(function(stream) {
               
                if (prortc.userRole === 'student') {
                    $scope.$apply(function() {
                        $scope.secondsLeft = prortc.noOfCourses * 3600;                        
                    });
                }
               
                if (stream) {
                    prortc.attachStream(stream, 'local');
                }
                
            });
        });

        prortc.on('start_timer',function(){
            startTimer();
        });

        prortc.on('new_updated_time', function(data) {
            console.log('new_updated_time', data);
            prortc.socket.emit('end_updated_time');
            $scope.$apply(function() {
                $scope.secondsLeft = data.secondsLeft;
            });
        });

        prortc.on('end_updated_time', function (data) {
            console.log('end_updated_time', data);
            var length = $scope.intervalObjects.length;
            console.log('end_updated_time', $scope.intervalObject);
            
            setTimeout(function () {
                if(length>0){
                    for (var i = 0; i < length; i++){
                        clearInterval($scope.intervalObjects[i]);
                    }                
                }
            }, 2000);

            if ($scope.courseTimer) {
                $scope.courseTimer.start();
            }
            
        });

        prortc.on('update_course', function(data) {
            console.log('update_course', data);
            if (!$scope.isPeerDisconnected) {
                $scope.$apply(function() {
                    prortc.noOfCourses = data.noOfCourses;
                    $scope.secondsLeft = data.noOfCourses * 3600;
                });
            }
        });


        function startTimer() {
            if (!$scope.courseTimer) {
                $scope.courseTimer = moment.duration(1, "seconds").timer({
                    loop: true,
                }, function() {
                    $scope.$apply(function() {
                        $scope.secondsFromStart++;
                        $scope.secondsLeft--;
                        prortc.socket.emit('sync_time', { secondsLeft: $scope.secondsLeft, secondsFromStart: $scope.secondsFromStart });
                        if ($scope.secondsLeft < 0) {
                            endCourse();
                        }
                    });
                });
            }
        }



        function endCourse() {
            prortc.endCall();
            if ($scope.courseTimer) {
                $scope.courseTimer.stop();
            }
            $scope.isStopped = true;
            prortc.emit('course_ended');
        }

        prortc.on('course_ended', function() {
            console.log('course ended');
            setTimeout(function() {
                $scope.secondsLeft = 0;
                if ($scope.courseTimer) {
                    $scope.courseTimer.stop();
                }
            }, 1000);
        });

        $scope.secondsToHHMMSS = function secondsToHHMMSS(secondsNumber) {

            var hours = Math.floor(secondsNumber / 3600);
            var minutes = Math.floor((secondsNumber - (hours * 3600)) / 60);
            var seconds = secondsNumber - (hours * 3600) - (minutes * 60);

            if (hours < 10) {
                hours = "0" + hours;
            }
            if (minutes < 10) {
                minutes = "0" + minutes;
            }
            if (seconds < 10) {
                seconds = "0" + seconds;
            }
            var time = hours + ':' + minutes + ':' + seconds;
            if ($scope.isStopped) {
                time = '00:00:00';
            }
            angular.element('#time').html(time);
            return time;
        }


        prortc.on('remote_stream', function(stream, id) {
            prortc.attachStream(stream, 'remote');
            $scope.isStopped = false;
            $scope.isCallRunning = true;
            $scope.isOtherConnected = true;
            $scope.isPeerDisconnected = false;
            if ($scope.courseTimer) {
                $scope.courseTimer.start();
            } else {
                //startTimer();
            }

        });

        prortc.on('disconnected_peer', function(data) {
            console.log('disconnected dddd');
            prortc.detachStream('remote');
            if ($scope.courseTimer) {
                $scope.isPeerDisconnected = true;
                $scope.courseTimer.stop();
            }

            var intervalObject =  setInterval(function() {
                prortc.socket.emit('update_time', { secondsLeft: $scope.secondsLeft, noOfCourses: prortc.noOfCourses });
            }, 1000);

            $scope.intervalObjects.push(intervalObject);
            // }
            // $scope.isStopped = true;
            // $scope.courseTimer = null;
            // $scope.secondsLeft = prortc.noOfCourses * 3600;
            //endCourse();
            $scope.$emit('user_left');
        });

        prortc.on('disconnected_peer_wihtout_media', function(data) {
            console.log('disconnected without media');           
            if ($scope.courseTimer) {
                $scope.isPeerDisconnected = true;
                $scope.courseTimer.stop();
            }

            var intervalObject =   setInterval(function() {
                prortc.socket.emit('update_time', { secondsLeft: $scope.secondsLeft, noOfCourses: prortc.noOfCourses });
            }, 1000);
           
            $scope.intervalObjects.push(intervalObject);
            $scope.$emit('user_left');
        });

        prortc.on('extend_my_time', function(data) {
            $scope.secondsLeft = parseInt($scope.secondsLeft, 10) + parseInt(data.time, 10);
        });

        prortc.on('extend_time_accepted', function(data) {
            $scope.secondsLeft = parseInt($scope.secondsLeft, 10) + parseInt(data.message.time, 10);
        });

    }]);

})
();
/**
 * Created by hp on 2/8/2017.
 */
(function () {
  'use strict'

  angular.module('suli.whiteboard', ['ui.router','suli.webrtc']);
})();

/**
 * Created by hp on 2/14/2017.
 */
(function() {
    'use strict';

    function WhiteBoardService(WebrtcService) {
        var canvas;
        var currentHistoryState = -1;
        var historyStates = [];
        var self = this;
        var userRole = '';
        var isWritable = true;
        var isMinimize = false;
        /**
         * Initialize canvas and events
         */
        self.init = function init(id) {
            canvas = new fabric.Canvas(id);
            canvas.renderOnAddRemove = false;
            canvas.setBackgroundColor('rgba(255, 255, 255, 1)', canvas.renderAll.bind(canvas));
            canvas.on('object:modified', function(event) {
                //  console.log('object:modified');
                var data = (event.target).toJSON(['id']);
                console.log('object:modified id before ', data.id);
                // data.id = data.id.replace(/(NaN)/, '');
                //console.log('object:modified id after ', data.id);
                WebrtcService.getSocket().emit('object:modified', data);
                // console.log('object:modified  ', data);
                //saveAndSendState();
                saveHistoryState();
            });
            canvas.on('object:added', function(event) {
                //console.log('object:added', (event.target).toJSON(['id']));
                //saveHistoryState();
            });
            canvas.on('object:removed', function(event) {
                console.log('object:removed', event.target);
                WebrtcService.getSocket().emit('object:removed', (event.target).toJSON(['id']));
                saveHistoryState();
                //saveAndSendState();
            });
            canvas.on('path:created', function(event) {
                event.path.id = self.generateId();
                WebrtcService.getSocket().emit('path:created', (event.path).toJSON(['id']));
                saveHistoryState();
                // saveAndSendState();
            });

        }

        /**
         * Set user role
         */
        self.setUserRole = function(role) {
            userRole = role;
        }

        /**
         * Set whiteboard minimize
         */
        self.setMinimize = function(minimize) {
            isMinimize = minimize;
        }

        /**
         * Set whiteboard writable
         */
        self.setWritable = function(isWrite) {
            isWritable = isWrite;
        }

        /**
         * check whiteboard minimize
         */
        self.getMinimize = function() {
            return isMinimize;
        }

        /**
         * get whiteboard writable
         */
        self.getWritable = function() {
            return isWritable;
        }

        /**
         * Get canvas object
         */
        self.getCanvas = function getCanvas() {
            return canvas;
        }

        /**
         * Generate random id for fabric object
         */
        self.generateId = function() {
            function s4() {
                return Math.floor((1 + Math.random()) * 0x10000)
                    .toString(16)
                    .substring(1);
            }

            return s4();
        }

        /**
         * Canvas set selectable false/true
         */
        self.setSelectable = function setSelectable(isSelectable) {
            if (!isSelectable) {
                clearHandlers();
            }
            canvas.selectable = isSelectable;
            canvas.forEachObject(function(o) {
                o.selectable = isSelectable;
            });
        }


        /**
         * Clear fabric events
         */
        function clearHandlers() {
            canvas.isDrawingMode = false;
            canvas.off('mouse:down');
            canvas.off('mouse:move');
            canvas.off('mouse:up');
            canvas.off('object:selected');
        }


        /**
         * Loads history state by index
         */
        function loadHistoryStateByIndex(index) {
            try {
                if (canvas) {
                    console.log(historyStates[index]);
                    canvas.loadFromJSON(historyStates[index], canvas.renderAll.bind(canvas), function(jsonObject, fabricObject) {
                        fabricObject.id = jsonObject.id;
                    });
                    if (isWritable) {
                        self.setSelectable(true);
                    } else {
                        self.setSelectable(false);
                    }
                    canvas.forEachObject(function(o) {
                        o.selectable = isWritable;
                    });
                    canvas.selectable = isWritable;
                    canvas.renderAll.bind(canvas);
                    console.log('isWritable', isWritable, canvas.selectable);

                }
            } catch (error) {
                console.log('error on loadHistoryStateByIndex =>', error);
            }
        }

        /**
         * Saves canvas history of changes.
         */
        function saveHistoryState() {
            if (currentHistoryState != -1) {
                historyStates = historyStates.slice(0, currentHistoryState + 1);
            }
            historyStates.push(canvas.toJSON(['id']));
            currentHistoryState = historyStates.length - 1;
        }

        /**
         * Sends history states and current history state index to the other user
         */
        function sendHistoryState() {
            var socketIds = WebrtcService.getSocketIds();
            var socketsLength = socketIds.length;
            for (var i = 0, len = socketsLength; i < len; i++) {
                var socketId = socketIds[i];
                prortc.sendMessage({
                    type: 'whiteboard',
                    socketId: socketId,
                    canvasJson: {
                        historyStates: historyStates,
                        currentHistoryState: currentHistoryState
                    }
                });
                /* WebrtcService.getSocket().emit('whiteboard', {
                 socketId: socketId,
                 canvasJson: {
                 historyStates: historyStates,
                 currentHistoryState: currentHistoryState
                 }
                 });*/
            }
        }

        /**
         * Save and send states to other user
         */
        function saveAndSendState() {
            saveHistoryState();
            sendHistoryState();
        }

        /**
         *  Set remote user states
         */
        self.setRemoteStates = function setRemoteStates(data) {
            try {
                historyStates = data.canvasData.historyStates;
                currentHistoryState = data.canvasData.currentHistoryState;
                loadHistoryStateByIndex(currentHistoryState);
            } catch (error) {
                console.log('remote states error =>', error);
            }
        }

        /**
         * Changes canvas width and height
         */
        self.setSize = function setSize(width, height, factor) {
            var factor = width / canvas.getWidth();
            var hFactor = height / canvas.getHeight();
            canvas.setWidth(canvas.getWidth() * factor);
            canvas.setHeight(canvas.getHeight() * hFactor);
            var objects = canvas.getObjects();
            for (var i in objects) {
                var scaleX = objects[i].scaleX;
                var scaleY = objects[i].scaleY;
                var left = objects[i].left;
                var top = objects[i].top;

                var tempScaleX = scaleX * factor;
                var tempScaleY = scaleY * hFactor;
                var tempLeft = left * factor;
                var tempTop = top * hFactor;

                objects[i].scaleX = tempScaleX;
                objects[i].scaleY = tempScaleY;
                objects[i].left = tempLeft;
                objects[i].top = tempTop;

                objects[i].setCoords();
            }
            canvas.renderAll();
            canvas.calcOffset();
        }

        /**
         * Add text on canvas
         */
        self.addText = function addText(textContent) {
            var x1, y1, x2, y2;
            clearHandlers();

            canvas.on('mouse:down', function(o) {
                var pointer = canvas.getPointer(o.e);
                x1 = pointer.x;
                y1 = pointer.y;
            });

            canvas.on('mouse:up', function(o) {
                var pointer = canvas.getPointer(o.e);
                x2 = pointer.x;
                y2 = pointer.y;

                var text = new fabric.Textbox(textContent, {
                    left: x1,
                    top: y1,
                    width: x2 - x1,
                    height: y2 - y1,
                    fill: canvas.freeDrawingBrush.color
                });
                text.id = self.generateId();
                canvas.add(text);
                WebrtcService.getSocket().emit('object:added', (text).toJSON(['id']));
                //saveAndSendState();
                clearHandlers();
            });
        }

        /**
         * Canvas undo actions
         */
        self.undo = function undo() {
            clearHandlers();
            if (currentHistoryState == -1) {
                currentHistoryState = historyStates.length - 2;
            } else {
                currentHistoryState--;
            }

            if (currentHistoryState < 0) {
                currentHistoryState = 0;
            }
            loadHistoryStateByIndex(currentHistoryState);
            sendHistoryState();
        }

        /**
         * Canvas redo actions
         */
        self.redo = function redo() {
            clearHandlers();
            if (currentHistoryState == -1) {
                currentHistoryState = historyStates.length - 1;
            } else {
                currentHistoryState++;
            }
            if (currentHistoryState >= historyStates.length) {
                currentHistoryState = historyStates.length - 1;
            }
            loadHistoryStateByIndex(currentHistoryState);
            sendHistoryState();
        }

        /**
         * Canvas set color
         */
        self.changeColor = function changeColor(value) {
            clearHandlers();
            canvas.freeDrawingBrush.color = value;
        }

        /**
         * Canvas enable drawing mode with width
         */
        self.enableDrawing = function enableDrawing(width) {
            clearHandlers();
            canvas.isDrawingMode = true;
            canvas.freeDrawingBrush.width = width;
            canvas.freeDrawingBrush.id = self.generateId();
        }

        /**
         * Canvas enable select tool
         */
        self.selectTool = function selectTool() {
            clearHandlers();
        }

        /**
         * Canvas add line
         */
        self.addLine = function addLine() {
            var isDown, line;
            clearHandlers();

            canvas.on('mouse:down', function(o) {
                canvas.selection = false;
                isDown = true;
                var pointer = canvas.getPointer(o.e);
                var points = [pointer.x, pointer.y, pointer.x, pointer.y];
                line = new fabric.Line(points, {
                    strokeWidth: 5,
                    stroke: canvas.freeDrawingBrush.color,
                    originX: 'center',
                    originY: 'center',
                    id: self.generateId()
                });
                canvas.add(line);
                //  WebrtcService.getSocket().emit('object:added', (line).toJSON(['id']));
                // saveAndSendState();
                // sendHistoryState();
            });

            canvas.on('mouse:move', function(o) {
                if (!isDown)
                    return;
                var pointer = canvas.getPointer(o.e);
                line.set({ x2: pointer.x, y2: pointer.y });
                canvas.renderAll();
            });

            canvas.on('mouse:up', function(o) {
                isDown = false;
                line.setCoords();
                clearHandlers();
                canvas.trigger('object:added', { target: line });
                WebrtcService.getSocket().emit('object:added', (line).toJSON(['id']));
                // saveAndSendState();
            });
        }

        /**
         * Canvas add square
         */
        self.addSquare = function addSquare() {
            var rect, isDown, origX, origY;
            clearHandlers();

            canvas.on('mouse:down', function(o) {
                canvas.selection = false;
                isDown = true;
                var pointer = canvas.getPointer(o.e);
                origX = pointer.x;
                origY = pointer.y;
                pointer = canvas.getPointer(o.e);
                rect = new fabric.Rect({
                    left: origX,
                    top: origY,
                    originX: 'left',
                    originY: 'top',
                    width: pointer.x - origX,
                    height: pointer.y - origY,
                    angle: 0,
                    fill: 'rgba(0,0,0,0)',
                    stroke: canvas.freeDrawingBrush.color,
                    strokeWidth: 2,
                    transparentCorners: false,
                    id: self.generateId()
                });
                rect.id = self.generateId();
                // WebrtcService.getSocket().emit('object:added', (rect).toJSON(['id']));
                canvas.add(rect);
                //  saveAndSendState();
            });

            canvas.on('mouse:move', function(o) {
                if (!isDown)
                    return;
                var pointer = canvas.getPointer(o.e);

                if (origX > pointer.x) {
                    rect.set({ left: Math.abs(pointer.x) });
                }
                if (origY > pointer.y) {
                    rect.set({ top: Math.abs(pointer.y) });
                }

                rect.set({ width: Math.abs(origX - pointer.x) });
                rect.set({ height: Math.abs(origY - pointer.y) });
                canvas.renderAll();
            });

            canvas.on('mouse:up', function(o) {
                isDown = false;
                rect.setCoords();
                clearHandlers();
                canvas.trigger('object:added', { target: rect });
                WebrtcService.getSocket().emit('object:added', (rect).toJSON(['id']));
                // saveAndSendState();
            });
        }

        /**
         * Canvas add triangle
         */
        self.addTriangle = function addTriangle() {
            var tri, isDown, origX, origY;
            clearHandlers();
            canvas.on('mouse:down', function(o) {
                canvas.selection = false;
                isDown = true;
                var pointer = canvas.getPointer(o.e);
                origX = pointer.x;
                origY = pointer.y;
                tri = new fabric.Triangle({
                    left: pointer.x,
                    top: pointer.y,
                    strokeWidth: 2,
                    width: 2,
                    height: 2,
                    stroke: canvas.freeDrawingBrush.color,
                    fill: 'rgba(0,0,0,0)',
                    selectable: true,
                    originX: 'center',
                    id: self.generateId()
                });
                canvas.add(tri);
                //   WebrtcService.getSocket().emit('object:added', (tri).toJSON(['id']));
                //saveAndSendState();
            });

            canvas.on('mouse:move', function(o) {
                if (!isDown)
                    return;
                var pointer = canvas.getPointer(o.e);
                tri.set({ width: Math.abs(origX - pointer.x), height: Math.abs(origY - pointer.y) });
                canvas.renderAll();
            });

            canvas.on('mouse:up', function(o) {
                isDown = false;
                tri.setCoords();
                clearHandlers();
                canvas.trigger('object:added', { target: tri });
                WebrtcService.getSocket().emit('object:added', (tri).toJSON(['id']));
                //saveAndSendState();
            });
        }

        /**
         * Canvas add circle
         */
        self.addCircle = function addCircle() {
            var circle, isDown, origX, origY;
            clearHandlers();

            canvas.on('mouse:down', function(o) {
                canvas.selection = false;
                isDown = true;
                var pointer = canvas.getPointer(o.e);
                origX = pointer.x;
                origY = pointer.y;
                circle = new fabric.Circle({
                    left: pointer.x,
                    top: pointer.y,
                    radius: 1,
                    fill: 'rgba(0,0,0,0)',
                    stroke: canvas.freeDrawingBrush.color,
                    strokeWidth: 2,
                    originX: 'center',
                    originY: 'center',
                    id: self.generateId()
                });
                canvas.add(circle);
                // WebrtcService.getSocket().emit('object:added', (circle).toJSON(['id']));
                // saveAndSendState();
            });

            canvas.on('mouse:move', function(o) {
                if (!isDown)
                    return;
                var pointer = canvas.getPointer(o.e);
                circle.set({ radius: Math.abs(origX - pointer.x) });
                canvas.renderAll();
            });

            canvas.on('mouse:up', function(o) {
                isDown = false;
                circle.setCoords();
                clearHandlers();
                canvas.trigger('object:added', { target: circle });
                WebrtcService.getSocket().emit('object:added', (circle).toJSON(['id']));
                //saveAndSendState();
            });
        }

        /**
         * Canvas clear canvas
         */
        self.clearCanvas = function clearCanvas() {
            canvas.clear().renderAll();
            saveAndSendState();
        }

        /**
         * Canvas enable eraser tool
         */
        self.eraser = function eraser() {
            clearHandlers();
            canvas.on('object:selected', function() {
                if (canvas.getActiveGroup()) {
                    canvas.getActiveGroup().forEachObject(function(object) {
                        canvas.remove(object)
                    });
                    canvas.discardActiveGroup().renderAll();
                } else {
                    canvas.remove(canvas.getActiveObject());
                }
            });
        }

        /**
         * Canvas add image
         */
        self.addImage = function addImage(imageSrc) {
            clearHandlers();
            var image = new fabric.Image.fromURL(imageSrc, function(image) {
                console.log("Image loaded.  Adding to canvas.");
                var imgObj = new fabric.Image(image);
                imgObj.set({
                    left: 100,
                    top: 100,
                    padding: 10,
                    cornersize: 10,
                    selectable: true,
                });
                image.scaleToWidth(200);
                image.scaleToHeight(200);
                image.id = self.generateId();
                canvas.add(image);
                WebrtcService.getSocket().emit('object:added', (image).toJSON(['id']));
                canvas.renderAll();
                // saveAndSendState();
            }, { crossOrigin: 'Anonymous' });
        }

        prortc.on('add_text', function(data) {
            var text = new fabric.Textbox(data.text, {
                left: data.left,
                top: data.top,
                width: data.width,
                height: data.height,
                fill: data.fill,
            });
            text.id = data.id;
            console.log(text);
            canvas.add(text);
            canvas.renderAll();
        });

        /**
         * Get FabricJs Object by Id
         */
        function getObjectById(id) {
            var objects = canvas.getObjects();
            var length = canvas.getObjects().length;
            for (var i = 0; i < length; i++) {
                if ((objects[i].id == id) || (objects[i].id == ("NaN" + id)))
                    return objects[i];
            }
        };

        prortc.on('object:added', function(data) {
            console.log('object added', data);
            switch (data.type) {
                case 'textbox':
                    var text = new fabric.Textbox(data.text, data);
                    canvas.add(text);
                    break;
                case 'circle':
                    var circle = new fabric.Circle(data);
                    canvas.add(circle);
                    break;
                case 'line':
                    var line = new fabric.Line([data.x1, data.y1, data.x2, data.y2], data);
                    canvas.add(line);
                    break;
                case 'triangle':
                    var triangle = new fabric.Triangle(data);
                    canvas.add(triangle);
                    break;
                case 'rect':
                    var rect = new fabric.Rect(data);
                    canvas.add(rect);
                    break;
                case 'image':
                    var image = new fabric.Image.fromURL(data.src, function(image) {
                        console.log("Image loaded.  Adding to canvas.");
                        var imgObj = new fabric.Image(image);
                        imgObj.set(data);
                        image.id = data.id;
                        image.scaleToWidth(200);
                        image.scaleToHeight(200);
                        canvas.add(image);
                        canvas.renderAll();
                    }, { crossOrigin: 'Anonymous' });
                    break;
            }

            canvas.renderAll();
            if (isWritable) {
                self.setSelectable(true);
            } else {
                self.setSelectable(false);
            }
            canvas.forEachObject(function(o) {
                o.selectable = isWritable;
            });
            canvas.selectable = isWritable;
            canvas.renderAll();
        });

        prortc.on('object:modified', function(data) {
            var object = getObjectById(data.id);
            if (object) {
                console.log('object:modified data ', data);
                object.animate({
                    left: data.left,
                    top: data.top,
                    scaleX: data.scaleX,
                    scaleY: data.scaleY,
                    angle: data.angle
                }, {
                    duration: 500,
                    onChange: function() {
                        if (data.type === 'textbox') {
                            object.text = data.text;
                        }
                        object.id = data.id;
                        object.setCoords();
                        canvas.renderAll();
                        if (isWritable) {
                            self.setSelectable(true);
                        } else {
                            self.setSelectable(false);
                        }
                        canvas.forEachObject(function(o) {
                            o.selectable = isWritable;
                        });
                        canvas.selectable = isWritable;
                        canvas.renderAll();
                    },
                    onComplete: function() {}
                });
            }
        });

        prortc.on('object:removed', function(data) {
            var object = getObjectById(data.id);
            if (object) {
                console.log('object:removed data ', data);
                canvas.remove(object);
                canvas.renderAll();
            }
        });

        prortc.on('path:created', function(data) {
            console.log('path:created ', data);
            var pathLength = data.path.length;
            var pathArray = [];
            for (var i = 0; i < pathLength; i++) {
                var subPath = data.path[i];
                var subPathLength = subPath.length;
                for (var j = 0; j < subPathLength; j++) {
                    pathArray.push(subPath[j]);
                }
            }
            var path = new fabric.Path(pathArray.join(' '), data);
            canvas.add(path);

            if (isWritable) {
                self.setSelectable(true);
            } else {
                self.setSelectable(false);
            }
            canvas.forEachObject(function(o) {
                o.selectable = isWritable;
            });
            canvas.selectable = isWritable;
            canvas.renderAll();
        });


    }

    angular.module('suli.whiteboard').service('WhiteBoardService', ['WebrtcService', WhiteBoardService]);
})();
/**
 * Created by hp on 2/8/2017.
 */

!(function() {
    'use strict';
    angular.module('suli.whiteboard').controller('WhiteBoardController', ['$scope', '$rootScope', 'WhiteBoardService', '$http', function($scope, $rootScope, WhiteBoardService, $http) {
        WhiteBoardService.init('whiteboard');

        prortc.on('tutor_switch_whiteboard', function(data) {
            if (data.allowStudent) {
                angular.element('#canvasTool').hide();
                angular.element('#minTool').hide();
                WhiteBoardService.setWritable(false);
            } else {
                angular.element('#canvasTool').show();
                if (WhiteBoardService.getMinimize()) {
                    angular.element('#minTool').show();
                } else {
                    angular.element('#minTool').hide();
                }
                WhiteBoardService.setWritable(true);
            }
            WhiteBoardService.setSelectable(!data.allowStudent);
        })

        $scope.getChat = function() {
            angular.element(window).resize(function() {
                var chk_height = angular.element('#VideoStreaming').outerHeight(true) + angular.element('#SidebarTool').outerHeight(true) + angular.element('#panel-heading').outerHeight(true) + angular.element('#panel-footer').outerHeight(true);
                var window_height = angular.element(window).height();
                angular.element("#MessageList").css('height', window_height - chk_height);
            }).resize();
        }
        $scope.getChat();

        $scope.showTools = function() {
            angular.element('#canvasTool').toggle();
        };

        if (!WhiteBoardService.getCanvas()) {
            WhiteBoardService.init();
        }

        $scope.getCanvas = function() {
            angular.element(window).resize(function() {
                var window_height = angular.element(window).height();
                var logo_height = angular.element('#LogoDiv').outerHeight(true);
                var chk_height = (window_height - logo_height - 10);
                var window_width = angular.element(window).width();
                if (screen.width > 767) {
                    var div_width = angular.element('#sidebar').width() + angular.element('#canvasTool').width();
                    var chk_width = (window_width - div_width);
                    WhiteBoardService.setSize(chk_width, chk_height, chk_width / chk_height);
                } else {
                    var chk_width = (window_width);
                    WhiteBoardService.setSize(chk_width, chk_height);
                }
            }).resize();
        };
        $scope.getCanvas();

        prortc.on('allow_student', function(data) {
            console.log('allow student', WhiteBoardService.getMinimize());
            if (data.allowStudent) {
                WhiteBoardService.setSelectable(true);
                WhiteBoardService.setWritable(true);
                angular.element('#canvasTool').show();
                if (WhiteBoardService.getMinimize()) {
                    angular.element('#minTool').show();
                } else {
                    angular.element('#minTool').hide();
                }

            } else {
                WhiteBoardService.setSelectable(false);
                WhiteBoardService.setWritable(false);
                angular.element('#canvasTool').hide();
                angular.element('#minTool').hide();
            }
        });

        prortc.on('whiteboard', function(data) {
            WhiteBoardService.setRemoteStates(data);
        });

        $scope.hideTools = function hideTools() {
            angular.element('#whiteboardScreen.full-screen #canvasTool, #whiteboardCanvas.explore #canvasTool').hide();
            if (screen.width < 767) {
                angular.element('#canvasTool').hide();
            }
        }

        $scope.addText = function addText() {
            WhiteBoardService.addText('Text...');
            $scope.hideTools();
        }

        $scope.undo = function undo() {
            WhiteBoardService.undo();
            $scope.hideTools();
        }

        $scope.redo = function redo(value) {
            WhiteBoardService.redo();
            $scope.hideTools();
        }

        $scope.changeColor = function changeColor(value) {
            WhiteBoardService.changeColor(value);
            $scope.hideTools();
        }
        $scope.addPen = function addPen() {
            WhiteBoardService.enableDrawing(1);
            $scope.hideTools();
        }

        $scope.addPencil = function addPencil() {
            WhiteBoardService.enableDrawing(3);
            $scope.hideTools();
        }

        $scope.addHeighlighter = function addHeighlighter() {
            WhiteBoardService.enableDrawing(20);
            $scope.hideTools();
        }

        $scope.selectTool = function selectTool() {
            WhiteBoardService.selectTool();
            $scope.hideTools();
        }
        $scope.addLine = function addLine() {
            WhiteBoardService.addLine();
            $scope.hideTools();
        }

        $scope.addSquare = function addSquare() {
            WhiteBoardService.addSquare();
            $scope.hideTools();
        }

        $scope.addTriangle = function addTriangle() {
            WhiteBoardService.addTriangle();
            $scope.hideTools();
        }

        $scope.addCircle = function addCircle() {
            WhiteBoardService.addCircle();
            $scope.hideTools();
        }

        $scope.clearCanvas = function clearCanvas() {
            if (confirm('Are you sure want to clear canvas?')) {
                WhiteBoardService.clearCanvas();
            }
        }

        $scope.eraser = function eraser() {
            WhiteBoardService.eraser();
            $scope.hideTools();
        }

        $scope.selectImage = function selectImage(e) {
            var element = angular.element("#image");
            element.click();
            $scope.hideTools();
        }

        $scope.addImage = function addImage(e) {
            var fileName = document.getElementById("image").value;
            var idxDot = fileName.lastIndexOf(".") + 1;
            var extFile = fileName.substr(idxDot, fileName.length).toLowerCase();
            if (extFile == "jpg" || extFile == "jpeg" || extFile == "png") {
                var formData = new FormData();
                formData.append('file', e.files[0]);

                $http.post('https://suli.prortc.com/upload', formData, {
                    transformRequest: angular.identity,
                    headers: { 'Content-Type': undefined }
                }).then(function(data) {
                    if (data.data.success) {
                        var imagePath = 'https://suli.prortc.com/' + data.data.filePath;
                        WhiteBoardService.addImage(imagePath);
                    }
                }, function(error) {
                    console.log('File upload error->', error);
                });
            } else {
                alert("Only jpg/jpeg and png files are allowed!");
            }

        }


    }]);

})
();
!(function () { 
    'use strict';
    angular.module('suli.main', ['ui.router','suli.whiteboard']);
})();
!(function() {
  "use strict";

  angular.module("suli.main").service("ApiService", ["$http", ApiService]);

  function ApiService($http) {
    this.saveLog = function(data) {
      return $http.post("https://suli.prortc.com/log", data);
    };
  }
})();

!(function() {
    'use strict';
    angular.module('suli.main').controller('MainController', ['$scope', '$rootScope', '$location', 'WhiteBoardService', 'ApiService', function($scope, $rootScope, $location, WhiteBoardService, ApiService) {
        var urlObject = $location.search();
        angular.element('#readyPopup').modal('hide');
        $scope.expandVideo = function expandVideo() {
            angular.element('#sidebar').addClass('siderbar-explore');
            angular.element('#SideChat').hide();
            angular.element(window).resize(function() {
                var chk_height = angular.element('#heading').outerHeight(true) + angular.element('#timeDiv').outerHeight(true) + angular.element('#SidebarTool').outerHeight(true);
                var window_height = angular.element(window).height();
                angular.element('#local , #remote').css('height', window_height - chk_height);
            }).resize();
        };
        $scope.minVideo = function minVideo() {
            angular.element('#sidebar').removeClass('siderbar-explore');
            angular.element('#SideChat').show();
            angular.element(window).resize(function() {
                var window_height = angular.element(window).height();
                angular.element('#local , #remote').removeAttr('style');
                var chk_height = angular.element('#VideoStreaming').outerHeight(true) + angular.element('#SidebarTool').outerHeight(true) + angular.element('#panel-heading').outerHeight(true) + angular.element('#panel-footer').outerHeight(true);
                angular.element("#MessageList").css('height', window_height - chk_height);
            }).resize();
        };

        function checkCanvasTool() {
            if (WhiteBoardService.getWritable()) {
                if (WhiteBoardService.getMinimize()) {
                    angular.element('#minTool').show();
                } else {
                    angular.element('#minTool').hide();
                }
                angular.element('#canvasTool').show();
            } else {
                angular.element('#canvasTool').hide();
            }
        }

        $scope.expandChating = function expandChating() {
            angular.element(window).resize(function() {
                var window_height = angular.element(window).height();
                var window_width = angular.element(window).width();
                var chk_width = angular.element(".whiteboard-screen").find('#sidebar').width();
                var logo_height = angular.element('#panel-heading').outerHeight(true) + angular.element('#panel-footer').outerHeight(true);
                angular.element('#sidebar').addClass('explore-sidebar');
                checkCanvasTool();
                angular.element("#MessageList").css('height', window_height - logo_height);
                angular.element('#SideChat').addClass('explore-chat').css('width', window_width - chk_width);
                angular.element('#whiteboardCanvas').addClass('explore');
            }).resize();
        };
        $scope.expandWhiteboard = function expandWhiteboard() {
            angular.element('#whiteboardCanvas').removeClass('explore');
            angular.element(window).resize(function() {
                var window_height = angular.element(window).height();
                var logo_height = angular.element('#LogoDiv').outerHeight(true);
                var chk_height = (window_height - logo_height - 10);
                var window_width = angular.element(window).width();
                var div_width = angular.element('#sidebar').width() + angular.element('#canvasTool').width();
                angular.element('#CanvasMain').removeAttr('style');
                var chk_width = (window_width - div_width);
                WhiteBoardService.setSize(chk_width, chk_height);
            }).resize();

        };
        $scope.miniWhiteboard = function miniWhiteboard() {
            angular.element(window).resize(function() {
                var window_width = angular.element(window).width();
                var window_height = angular.element(window).height();
                var chk_videowidth = $("#whiteboardScreen").find('#local').width();
                var chk_heightcanvas = angular.element('#VideoStreaming').outerHeight(true) + angular.element('#SidebarTool').outerHeight(true) + 30;
                var chk_heightcanvas01 = angular.element('#VideoStreaming').outerHeight(true) + angular.element('#SidebarTool').outerHeight(true) + angular.element('#canvas-heading').outerHeight(true);
                var setHeight = (window_height - chk_heightcanvas01 - 30);
                angular.element('#CanvasMain').css('height', window_height - chk_heightcanvas);
                angular.element('#CanvasMain').css('width', chk_videowidth);
                WhiteBoardService.setSize(chk_videowidth, setHeight);
            }).resize();

        };
        $scope.resizeWhiteboard = function resizeWhiteboard() {
            angular.element(window).resize(function() {
                var window_width = angular.element(window).width();
                var window_height = angular.element(window).height();
                var chk_videowidth = $("#whiteboardScreen").find('#local').width();
                var chk_heightcanvas = angular.element('#local').outerHeight(true) + 60;
                var chk_heightcanvas01 = angular.element('#local').outerHeight(true);
                var setHeight = (window_height - chk_heightcanvas01 - 120);
                angular.element('#CanvasMain').css('height', window_height - chk_heightcanvas);
                angular.element('#CanvasMain').css('width', chk_videowidth);
                WhiteBoardService.setSize(chk_videowidth, setHeight);
            }).resize();
        };
        $scope.minChating = function minChating() {
            angular.element(window).resize(function() {
                var window_height = angular.element(window).height();
                var chk_height = angular.element('#VideoStreaming').outerHeight(true) + angular.element('#SidebarTool').outerHeight(true) + angular.element('#panel-heading').outerHeight(true) + angular.element('#panel-footer').outerHeight(true);
                angular.element('#SideChat').removeClass('explore-chat').css('width', '');
                angular.element('#whiteboardCanvas').removeClass('explore');
                angular.element("#MessageList").css('height', window_height - chk_height);
            }).resize();
        };

        $scope.fullScreenVideo = function fullScreenVideo() {
            angular.element('#whiteboardScreen').addClass('full-screen');
            angular.element('#whiteboardCanvas').addClass('explore');
            angular.element('#SideChat').hide();
            angular.element(window).resize(function() {
                var chk_height = angular.element('#SidebarTool').outerHeight(true);
                var window_height = angular.element(window).height();
                angular.element('#remote').css('height', window_height - chk_height - 50);
            }).resize();

        };
        $scope.closefullScreenVideo = function closefullScreenVideo() {
            angular.element('#whiteboardScreen').removeClass('full-screen');
            angular.element('#SideChat').show();
            angular.element(window).resize(function() {
                angular.element('#remote').removeAttr('style');
            }).resize();
        };

        $scope.fullScreen = function fullScreen() {
            $scope.fullScreenVideo();
            $scope.resizeWhiteboard();
            WhiteBoardService.setMinimize(true);
            checkCanvasTool();
        };
        $scope.closefullScreen = function closefullScreen() {
            $scope.closefullScreenVideo();
            $scope.expandWhiteboard();
            $scope.minChating();
            WhiteBoardService.setMinimize(false);
            checkCanvasTool();
        };

        $scope.exploreChat = function exploreChat() {
            $scope.expandChating();
            $scope.miniWhiteboard();
            WhiteBoardService.setMinimize(true);
            checkCanvasTool();
        };

        $scope.closeChat = function closeChat() {
            $scope.minChating();
            $scope.expandWhiteboard();
            WhiteBoardService.setMinimize(false);
            checkCanvasTool();
        };


        $scope.exploreVideo = function exploreVideo() {
            $scope.expandVideo();
        };

        $scope.closeVideo = function closeVideo() {
            $scope.minVideo();
            $scope.minChating();
            $scope.expandWhiteboard();
            WhiteBoardService.setMinimize(false);
            checkCanvasTool();
        };


        $scope.saveWhiteboard = function saveWhiteboard() {
            var link = document.createElement('a');
            link.href = WhiteBoardService.getCanvas().toDataURL('png');
            link.download = 'image.png';
            document.body.appendChild(link);
            link.click();
            link.remove();
        }


        $scope.extendedTime = 0;
        $scope.noOfCourses = 1;
        $scope.extendTimeList = [{ value: 300, text: '5 minutes' }, { value: 600, text: '10 minutes' }, {
            value: 900,
            text: '15 minutes'
        }]

        $scope.exploreChat = function exploreChat() {
            $scope.expandChating();
            $scope.miniWhiteboard();
            WhiteBoardService.setMinimize(true);
            checkCanvasTool();
        };
        $scope.closeChat = function closeChat() {
            $scope.minChating();
            $scope.expandWhiteboard();
            WhiteBoardService.setMinimize(false);
        };
        $scope.exploreWhiteboard = function exploreWhiteboard() {
            $scope.minChating();
            $scope.expandWhiteboard();
            WhiteBoardService.setMinimize(false);
            checkCanvasTool();
        };

        function saveLog(data) {
            ApiService.saveLog(data);
        }
        if ((!urlObject.room) || (!urlObject.role)) {
            angular.element('#invalidUrl').modal('show');
        } else {
            if (urlObject.role === 'tutor' || urlObject.role === 'student') {
                if (urlObject.role === 'tutor') {
                    var body = {
                        role: 'Tutor',
                        event: 'Entered Classroom',
                        class_room_id: urlObject.room
                    };
                    saveLog(body);
                    angular.element('#readyCoursePopup').modal('show');
                }
                if (urlObject.role === 'student') {
                    var body = {
                        role: 'Student',
                        event: 'Entered Classroom',
                        class_room_id: urlObject.room
                    };
                    saveLog(body);
                    angular.element('#readyPopup').modal('show');
                }
            } else {
                angular.element('#invalidRole').modal('show');
            }
        }

        if (!getUserMedia) {
            angular.element('#readyCoursePopup').modal('hide');
            angular.element('#readyPopup').modal('hide');
            angular.element('#webrtcNotSupport').modal('show');
        }

        $scope.incrementCourse = function incrementCourse() {
            if ($scope.noOfCourses > 0 && $scope.noOfCourses < 6) {
                $scope.noOfCourses++;
            }
        };

        $scope.decrementCourse = function decrementCourse() {
            if ($scope.noOfCourses > 1) {
                $scope.noOfCourses--;
            }
        };

        $scope.startCall = function startCall() {
            if (urlObject.room && urlObject.role) {
                if (urlObject.role === 'tutor' && ($scope.noOfCourses > 0)) {
                    prortc.emit('start_call', { role: urlObject.role, room: urlObject.room, noOfCourses: $scope.noOfCourses });
                    angular.element('#readyCoursePopup').modal('hide');
                    var body = {
                        role: 'Tutor',
                        event: 'Approved to start the course',
                        class_room_id: urlObject.room
                    };
                    saveLog(body);
                }
                if (urlObject.role === 'student') {
                    prortc.emit('start_call', urlObject);
                    angular.element('#readyPopup').modal('hide');
                    angular.element('#mini_toolsDiv').hide();
                    angular.element('#allowTools').hide();
                    angular.element('#canvasTool').hide();
                    angular.element('#minTool').hide();
                    WhiteBoardService.setWritable(false);
                    var body = {
                        role: 'Student',
                        event: 'Approved to start the course',
                        class_room_id: urlObject.room
                    };
                    saveLog(body);
                }
            }
        };

        prortc.on('connections', function(data) {
            if (data.length === 0) {
                if (prortc.userRole === 'tutor') {
                    angular.element('#waitingStudent').modal('show');
                }
                if (prortc.userRole === 'student') {
                    angular.element('#waitingTutor').modal('show');
                }
            }
        });


        prortc.on('webrtc_not_support', function() {
            angular.element('#readyCoursePopup').modal('hide');
            angular.element('#readyPopup').modal('hide');
            angular.element('#webrtcNotSupport').modal('show');
        });

        prortc.on('media_device_error', function(error) {
            angular.element('#readyCoursePopup').modal('hide');
            angular.element('#readyPopup').modal('hide');
            /*angular.element('#mediaError').modal('show');
            var errorMessage = '';
            switch (error.name) {
                case "NotFoundError":
                    errorMessage = 'This website requires Camera to be connected to your peer. Please connect the camera to establish the connection.';
                    break;
                case "NotAllowedError":
                    errorMessage = "You have rejected camera access to this website.";
                    break;
                default:
                    errorMessage = "Camera not found or camera is using by other website.";
            }
            angular.element('#mediaErrorText').html(errorMessage);*/
        });

        prortc.on('new_peer', function(data) {
            if (prortc.userRole === 'tutor') {
                angular.element('#waitingStudent').modal('hide');
            }
            if (prortc.userRole === 'student') {
                prortc.emit('update_course', data);
                angular.element('#waitingTutor').modal('hide');
            }
            prortc.socket.emit('start_timer');
            prortc.emit('start_timer');
            var body = {
                role: 'Software',
                event: 'Lession started',
                class_room_id: urlObject.room
            };
            saveLog(body);
        });

        $scope.saveWhiteboard = function saveWhiteboard() {
            var link = document.createElement('a');
            link.href = WhiteBoardService.getCanvas().toDataURL({
                format: 'jpeg',
            });
            link.download = 'image.jpeg';
            document.body.appendChild(link);
            link.click();
            link.remove();
        }

        prortc.on('course_ended', function() {
            angular.element('#endedSession').modal('show');
            angular.element('#endSession').modal('hide');
            WhiteBoardService.clearCanvas();
        });

        $scope.$on('user_left', function() {
            var body = {
                event: 'Left classroom',
                class_room_id: urlObject.room
            };
            if (urlObject.role === 'tutor') {
                body.role = 'Student';
                saveLog(body);
            }
            if (urlObject.role === 'student') {
                body.role = 'Tutor';
                saveLog(body);
            }
        });


        prortc.on('room_full', function() {
            angular.element('#roomFull').modal('show');
        });


        $scope.endCourse = function endCourse() {
            angular.element('#endSession').modal('show');
        }

        $scope.endSession = function endSession() {
            prortc.endCall();
            WhiteBoardService.clearCanvas();
            angular.element('#endSession').modal('hide');
            angular.element('#endedSession').modal('show');
            var body = {
                role: 'Software',
                event: 'Lession ended',
                class_room_id: urlObject.room
            };
            saveLog(body);
        }

        $scope.cancelEndSession = function endSession() {
            angular.element('#endSession').modal('hide');
        }

        $scope.extendTime = function extendTime() {
            if ($scope.extendedTime > 0) {
                prortc.socket.emit('extend_time', { time: $scope.extendedTime });
                angular.element('#extendTimePopup').modal('hide');
                $scope.extendedTime = 0;
            }
        }

        prortc.on('extend_time', function(data) {
            angular.element('#confirmExtendSession').modal('show');
            $scope.extendedTime = parseInt(data.message.time, 10);
        });

        $scope.confirmExtendSession = function confirmExtendSession() {
            angular.element('#confirmExtendSession').modal('hide');
            prortc.socket.emit('extend_time_accepted', { time: $scope.extendedTime });
            prortc.emit('extend_my_time', { time: $scope.extendedTime });
            $scope.extendedTime = 0;
        }

        $scope.rejectExtendSession = function rejectExtendSession() {
            angular.element('#confirmExtendSession').modal('hide');
        }

        $scope.clearWhiteboard = function clearWhiteboard() {
            WhiteBoardService.clearCanvas();
            angular.element('#clearWhiteboard').modal('hide');
        }

        $scope.cancelClearWhiteboard = function cancelClearWhiteboard() {
            angular.element('#clearWhiteboard').modal('hide');
        }

    }]);
})();