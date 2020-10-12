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