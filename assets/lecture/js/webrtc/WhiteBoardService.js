 function WhiteBoardService() {
         // alert("in");
        var canvas;
        var currentHistoryState = 1;
        var historyStates = [];
        var self = this;
        var userRole = 'tutor';
        var isWritable = true;
        var isMinimize = false;
        /**
         * Initialize canvas and events
         */
        self.init = function init(id) {
            // alert(id);
            canvas = new fabric.Canvas(id, {
                          width: 500,
                          height: 500,
                          isDrawingMode: true,
                          opacity: 0.6,
                          backgroundColor: '#fff'
                        });
            //alert(canvas);
            canvas.renderOnAddRemove = true;
            canvas.setBackgroundColor('rgba(255, 255, 255, 1)', canvas.renderAll.bind(canvas));
            canvas.on('object:modified', function(event) {
                //  console.log('object:modified');
                var data = (event.target).toJSON(['id']);
                console.log('object:modified id before ', data.id);
                // data.id = data.id.replace(/(NaN)/, '');
                //console.log('object:modified id after ', data.id);
               // WebrtcService.getSocket().emit('object:modified', data);
                // console.log('object:modified  ', data);
                //saveAndSendState();
                //saveHistoryState();
            });
            canvas.on('object:added', function(event) {
                //console.log('object:added', (event.target).toJSON(['id']));
                //saveHistoryState();
            });
            canvas.on('object:removed', function(event) {
                console.log('object:removed', event.target);
               // WebrtcService.getSocket().emit('object:removed', (event.target).toJSON(['id']));
               // saveHistoryState();
                //saveAndSendState();
            });
            canvas.on('path:created', function(event) {
                event.path.id = self.generateId();
              // WebrtcService.getSocket().emit('path:created', (event.path).toJSON(['id']));
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
            canvas.isDrawingMode = true;
            canvas.on('mouse:down');
            canvas.on('mouse:move');
            canvas.on('mouse:up');
            canvas.on('object:selected');
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
            //alert(width);
          // alert( self.generateId());
            clearHandlers();
             
            canvas.isDrawingMode = true;
            canvas.freeDrawingBrush = "Pencil Brush";
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
