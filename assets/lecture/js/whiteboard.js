/**

 * Initialize canvas and events

 */

var canvas,line,isDown,isKeyDown;

var strock          =  3;

var drawingstrock   =  3.5;

var font_Size       =  24;

var imageWidth      =  200;

var imageHeight     =  200;

var eraseObject     =  0;

var videoDisableflag=  false;

var muteStatus      =  false;

var ckeditorMode    =   "tutor";

var memberType      =   $("#member_type").val();

var enableOnChange  = true;

var ckeditorFlag    = false;

var artboardId      =  1; 

var getHeight       = $("#artBoard"+artboardId).outerHeight(true);

var getWidth        = $("#artBoard"+artboardId).outerWidth(true);

var eraseHover      = false;



var canvasBoard1,canvasBoard2,canvasBoard3,canvasBoard4,canvasBoard5;

var isWritable = true;

var isMinimize = false;

canvasBoard1 = new fabric.Canvas('whiteboardCanvas1', {

    selection: false,

    isDrawingMode: false,

    preserveObjectStacking: true,

});

canvasBoard2 = new fabric.Canvas('whiteboardCanvas2', {

    selection: false,

    isDrawingMode: false,

    preserveObjectStacking: true,

});

canvasBoard3 = new fabric.Canvas('whiteboardCanvas3', {

        selection: false,

        isDrawingMode: false,

        preserveObjectStacking: true,

});

canvasBoard4 = new fabric.Canvas('whiteboardCanvas4', {

        selection: false,

        isDrawingMode: false,

        preserveObjectStacking: true,

});

canvasBoard5 = new fabric.Canvas('whiteboardCanvas5', {

        selection: false,

        isDrawingMode: false,

        preserveObjectStacking: true,

});

canvas = canvasBoard1;





function changeWhiteboard(id,val)

{

    $('.art-board').css('display','none');

    $("#artBoard"+id).css('display','block');

    $("#artboardId").val(id);

    $("#editArtBoardBtn").click();

    if(id==1)

    {

        canvas     = canvasBoard1;                

        artboardId = id;

        getHeight  = $("#artBoard"+artboardId).outerHeight(true);

        getWidth   = $("#artBoard"+artboardId).outerWidth(true);

        canvas.setWidth(getWidth); 

        canvas.setHeight(getHeight);

        if(val==0)

        {

            socket.emit('change-whiteBoard', {target: id ,'fromUser':userId,'toUser':frndId}); 

            val++;

        }

       

    } else if(id==2)

    {

        canvas     = canvasBoard2;                

        artboardId = id;

        getHeight  = $("#artBoard"+artboardId).outerHeight(true);

        getWidth   = $("#artBoard"+artboardId).outerWidth(true);

        canvas.setWidth(getWidth); 

        canvas.setHeight(getHeight);

        if(val==0)

        {

            socket.emit('change-whiteBoard', {target: id ,'fromUser':userId,'toUser':frndId}); 

            val++;

        }

    }else if(id==3)

    {

       canvas      = canvasBoard3;                

       artboardId  = id;

       getHeight   = $("#artBoard"+artboardId).outerHeight(true);

       getWidth    = $("#artBoard"+artboardId).outerWidth(true);

        canvas.setWidth(getWidth); 

        canvas.setHeight(getHeight);

        if(val==0)

        {

            socket.emit('change-whiteBoard', {target: id ,'fromUser':userId,'toUser':frndId}); 

            val++;

        }

    }

    else if(id==4)

    {

       canvas      = canvasBoard4;                

       artboardId  = id;

       getHeight   = $("#artBoard"+artboardId).outerHeight(true);

       getWidth    = $("#artBoard"+artboardId).outerWidth(true);

        canvas.setWidth(getWidth); 

        canvas.setHeight(getHeight);

        if(val==0)

        {

            socket.emit('change-whiteBoard', {target: id ,'fromUser':userId,'toUser':frndId}); 

            val++;

        }

    }

    else if(id==5)

    {

       canvas      = canvasBoard5;                

       artboardId  = id;

       getHeight   = $("#artBoard"+artboardId).outerHeight(true);

       getWidth    = $("#artBoard"+artboardId).outerWidth(true);

       canvas.setWidth(getWidth); 

       canvas.setHeight(getHeight);

        if(val==0)

        {

            socket.emit('change-whiteBoard', {target: id ,'fromUser':userId,'toUser':frndId}); 

            val++;

        }

    }

    $("#draw_pencil").click();

    var newCanvasHeight=$(".canvas-container").height();

    socket.emit('videocallend', {"fromUser":userId,"toUser":frndId,'getHeight':newCanvasHeight,'getWidth':getWidth});

}







$(document).ready(function() {

   var getHeight = $("#artBoard"+artboardId).outerHeight(true);

   var getWidth = $("#artBoard"+artboardId).outerWidth(true);

  

   canvas.setWidth(getWidth);

   canvas.setHeight(getHeight);

   

});







$(window).resize(function() { 

   var getHeight = $("#artBoard"+artboardId).outerHeight(true);

   var getWidth = $("#artBoard"+artboardId).outerWidth(true);

 

   canvas.setWidth(getWidth);

   canvas.setHeight(getHeight);



});





function generateId() {

    return Math.floor((1 + Math.random()) * 0x10000)

        .toString(16)

        .substring(1);

}

/**

 * tools active link

 */

function ActiveItem(id) {

    canvas.isDrawingMode = false;

    $(".nav-link").each(function() {

        $(this).removeClass('active');

    });

    

    $("#shapes,#dropdownMenuanchor").removeClass('show');

    $("#dropdownMenu2").removeClass('active');

    if(id=='draw_circle' || id=='draw_rectangle' ||id=='draw_triangle' || id=='draw_line')

    {

        $("#shapes,#dropdownMenuanchor").addClass('show');

        $("#dropdownMenu2").addClass('active');

        let src=$('#'+id+'-icon').prop('src');

        $("#showShape").attr("src",src);

    }

    $("#" + id).addClass('active');

    

    if($('.chat-wrap').css('display') == 'block')

    {

        $(".chat-btn").addClass("active");

    }else{

        $(".chat-btn").removeClass("active");

    }

   if(id=='draw_erase')

    {



        $(".upper-canvas").addClass('eraser-cursor');

    }else{

        $(".upper-canvas").removeClass('eraser-cursor');

    }

    if(id=='draw_select' || id=='draw_erase')

    {

        canvas.discardActiveObject();

        canvas.renderAll(); 

        canvas.selection = true;

        canvas.forEachObject(function(o) 

        {

            o.selectable = true;

        });

        

    }

    else{

        canvas.selection = false;

        canvas.forEachObject(function(o) 

        {

            o.selectable = false;

        });

    }

    eraseHover      = false;

    canvas.off('mouse:over');

    //canvas.off('mouse:out');

   

}



/**

 * Clear fabric events

 */

function removeEvents() 

{

    canvas.isDrawingMode = false;

    canvas.off('mouse:down');

    canvas.off('mouse:move');

    canvas.off('mouse:up');

    canvas.off('object:selected');

    canvas.off('path:created');

}

function eraser() {

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

$('html').keyup(function(e){

    if(e.keyCode == 46) {

        canvas.isDrawingMode = false;

        if(canvas.getActiveObject())

        {

            socket.emit('object:removed', {target: canvas.getActiveObject().toJSON(['id']),'fromUser':userId,'toUser':frndId});

            canvas.remove(canvas.getActiveObject());

        }

    }

});

/**

 * Clear canvas

 */

function clearCanvasBoard() 

{

    

    canvas.clear().renderAll();

    socket.emit('object-clear', {'fromUser':userId,'toUser':frndId}); 

    $("#ConfirmModal02").modal('hide');

    eraseObject=0;

}



socket.on('object-clear', function(data) {

    canvas.clear().renderAll();

   

});

/**

 * Erase canvas

 */

function eraserCanvas() 

{

   canvas.isDrawingMode = false;

    canvas.on('object:selected', function() {

        if(canvas.getActiveObject())

        {

            let obj = canvas.getActiveObject();

            var jsonResponse = isJson(obj); 

            let artboardId =  $("#artboardId").val(); 

            if(artboardId==1)

                {

                    h=h1;

                }else

                if(artboardId==2)

                {

                    h=h2;

                }else

                if(artboardId==3)

                {

                    h=h3;

                }

                else

                if(artboardId==4)

                {

                    h=h4;

                }

                else

                if(artboardId==5)

                {

                    h=h5;

                }

            for (var i=0; i<canvas._objects.length; i++)

            {

               if(canvas._objects[i].id==jsonResponse.id)

                {

                    canvas._objects[i].action='erase';

                    h.push(canvas._objects[i]);

                    eraseObject++;

                }

            }

            socket.emit('object:removed', {target: canvas.getActiveObject().toJSON(['id']),'fromUser':userId,'toUser':frndId});

            canvas.remove(canvas.getActiveObject());

        }

    });

    canvas.on('mouse:down', function(o) {

  

        let idEvents= $(".nav-item").find(".active").attr('id');

       if(idEvents==='draw_erase')

        {

            isDown = true;

            if(eraseHover==false)

            {

                eraseHover=true;

            }else{

                eraseHover=false;

            }

           removeObject();

        }

    });

    canvas.on('mouse:up', function(o) {

        let idEvents= $(".nav-item").find(".active").attr('id');

        if(idEvents==='draw_erase')

        {

            eraseHover=false;

            canvas.off('mouse:move');

        }

      

    });

}

function removeObject()

{

    let idEvents= $(".nav-item").find(".active").attr('id');

    if(eraseHover==true && idEvents==='draw_erase')

    {

            canvas.on('mouse:move', function(e) {

            if(e.target)

            {

                let obj = e.target;

                var jsonResponse = isJson(obj); 

                let artboardId =  $("#artboardId").val(); 

                if(artboardId==1)

                    {

                        h=h1;

                    }else

                    if(artboardId==2)

                    {

                        h=h2;

                    }else

                    if(artboardId==3)

                    {

                        h=h3;

                    }

                    else

                    if(artboardId==4)

                    {

                        h=h4;

                    }

                    else

                    if(artboardId==5)

                    {

                        h=h5;

                    }

                for (var i=0; i<canvas._objects.length; i++)

                {

                if(canvas._objects[i].id==jsonResponse.id)

                    {

                        canvas._objects[i].action='erase';

                        h.push(canvas._objects[i]);

                        eraseObject++;

                    }

                }

                socket.emit('object:removed', {target: e.target.toJSON(['id']),'fromUser':userId,'toUser':frndId});

                canvas.remove(e.target);

            }

        });

    }else{

        eraseHover=false;

        canvas.off('mouse:over');

    }

}

/**

 * Canvas enable select tool

 */

function selectTool() 

{

    canvas.discardActiveObject();

    canvas.renderAll(); 

    canvas.on('before:selection:cleared', function() {

        

        if(typeof(canvas.getActiveObject()) !== 'undefined') {

            clearedObject = canvas.getActiveObject();

        }

        else {

            clearedObject = canvas.getActiveGroup();

        }

     });

     var newCanvasHeight=$(".canvas-container").height();

     let obj = canvas.getActiveObject();

     var jsonResponse = isJson(obj); 

     if(jsonResponse!=false){

         socket.emit('object-modified', {target: jsonResponse,'fromUser':userId,'toUser':frndId,'getHeight':newCanvasHeight,'getWidth':getWidth});

     }

    removeEvents();

    $(".fullboard-btn").addClass('active');

}



/**

 * Canvas add Circle

 */

function draw_circle() {

   

    var newCanvasHeight=$(".canvas-container").height();

    var circle, isDown, origX, origY

    removeEvents();

    canvas.on('before:selection:cleared', function() {

        var clearedObject;

        if(typeof(canvas.getActiveObject()) !== 'undefined') {

            clearedObject = canvas.getActiveObject();

        }

        else {

            clearedObject = canvas.getActiveGroup();

        }

     });

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

            strokeWidth: strock,

            stroke: jQuery("#drawing-color").val(),

            fill: 'transparent',

            originX: 'center',

            originY: 'center',

            id:generateId(),

            _origStrokeWidth:3,

            noScaleCache: false,

            strokeUniform: true,

            perPixelTargetFind:true

           

        });

        circle.hasRotatingPoint = true;

        canvas.add(circle);

       

    });

    canvas.on('mouse:move', function(o) {

        

       if (!isDown)

            return;

        var pointer = canvas.getPointer(o.e);

         circle.set({ radius: Math.abs(origX - pointer.x) });

         canvas.renderAll();

         var jsonResponse = isJson(circle); 

        if(jsonResponse!=false){

            saveCanvasHistory(jsonResponse);

            socket.emit('object-modified', {target: jsonResponse,'fromUser':userId,'toUser':frndId,'getHeight':newCanvasHeight,'getWidth':getWidth});

        }

        });



    canvas.on('mouse:up', function(o) {

        isDown = false;

        circle.setCoords();

        removeEvents();

        canvas.trigger('object:added', { target: circle });

        var jsonResponse = isJson(circle); 

        if(jsonResponse!=false)

        {

            saveCanvasHistory(jsonResponse);

            socket.emit('object-added', {target:  jsonResponse,'fromUser':userId,'toUser':frndId,'getHeight':newCanvasHeight,'getWidth':getWidth}); 

        }

     });

    canvas.on('object:moving', function (e) {

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



    canvas.on('object:modified', function(event) {

        var jsonResponse = isJson(circle); 

            if(jsonResponse!=false){

                saveCanvasHistory(jsonResponse);

                socket.emit('object-modified', {target: jsonResponse,'fromUser':userId,'toUser':frndId,'getHeight':newCanvasHeight,'getWidth':getWidth});

            }

        removeEvents();

    });

    canvas.on('object:removed', function(event) {

        

        var jsonResponse = isJson(circle); 

        if(jsonResponse!=false)

        {

            saveCanvasHistory(jsonResponse);

            socket.emit('object-removed', {target: jsonResponse,'fromUser':userId,'toUser':frndId,'getHeight':newCanvasHeight,'getWidth':getWidth});

        }

     });

     canvas.on('object:scaling', function(event) 

     {

       var jsonResponse = isJson(circle); 

        if(jsonResponse!=false)

        {

            saveCanvasHistory(jsonResponse);

            socket.emit('object-scaling', {target: jsonResponse,'fromUser':userId,'toUser':frndId,'getHeight':newCanvasHeight,'getWidth':getWidth});

        }

     });

}

/**

 * Canvas add rectangle

 */

function draw_rect() {

    var newCanvasHeight=$(".canvas-container").height();

    canvas.on('before:selection:cleared', function() {

        var clearedObject;

        if(typeof(canvas.getActiveObject()) !== 'undefined') {

            clearedObject = canvas.getActiveObject();

        }

        else {

            clearedObject = canvas.getActiveGroup();

        }

     });

    var rect, isDown, origX, origY;

    removeEvents();

    

    canvas.on('mouse:down', function(o) {

        isDown = true;

        var pointer = canvas.getPointer(o.e);

        origX = pointer.x;

        origY = pointer.y;

        var pointer = canvas.getPointer(o.e);

        rect = new fabric.Rect({

            left: origX,

            top: origY,

            originX: 'left',

            originY: 'top',

            width: pointer.x - origX,

            height: pointer.y - origY,

            fill: 'transparent',

            strokeWidth: strock,

            stroke: jQuery("#drawing-color").val(),

            selectable: true,

            id:generateId(),

            _origStrokeWidth:strock,

            noScaleCache: false,

            strokeUniform: true,

            perPixelTargetFind:true

            

        });

        rect.hasRotatingPoint = true;

        canvas.add(rect);

        canvas.isDrawingMode = false;

    });

    canvas.on('mouse:move', function(o) {

        if (!isDown) return;

        var pointer = canvas.getPointer(o.e);

        if (origX > pointer.x) {

            rect.set({

                left: Math.abs(pointer.x)

            });

        }

        if (origY > pointer.y) {

            rect.set({

                top: Math.abs(pointer.y)

            });

        }



        rect.set({

            width: Math.abs(origX - pointer.x)

        });

        rect.set({

            height: Math.abs(origY - pointer.y)

        });

        canvas.renderAll();

       var jsonResponse = isJson(rect); 

        if(jsonResponse!=false){

            saveCanvasHistory(jsonResponse);

            socket.emit('object-modified', {target: jsonResponse,'fromUser':userId,'toUser':frndId,'getHeight':newCanvasHeight,'getWidth':getWidth});

        }

    });

    canvas.on('mouse:up', function(o) {

        isDown = false;

        rect.setCoords();

        removeEvents();

        canvas.trigger('object:added', { target: rect });

        var jsonResponse = isJson(rect); 

        if(jsonResponse!=false)

        {

            saveCanvasHistory(jsonResponse);

            socket.emit('object-added', {target: jsonResponse,'fromUser':userId,'toUser':frndId,'getHeight':newCanvasHeight,'getWidth':getWidth}); 

        }

    });

    canvas.on('object:modified', function(event) {

        var jsonResponse = isJson(rect); 

        if(jsonResponse!=false){

            saveCanvasHistory(jsonResponse);

            socket.emit('object-modified', {target: jsonResponse,'fromUser':userId,'toUser':frndId,'getHeight':newCanvasHeight,'getWidth':getWidth});

        }

       removeEvents();

     });

     canvas.on('object:scaling', function(event) 

     {

       var jsonResponse = isJson(rect); 

       if(jsonResponse!=false)

       {

        saveCanvasHistory(jsonResponse);

        socket.emit('object-scaling', {target:jsonResponse,'fromUser':userId,'toUser':frndId,'getHeight':newCanvasHeight,'getWidth':getWidth});

       }

       removeEvents();

     });

}



/**

 * Canvas add triangle

 */

function draw_triangle() {

   

    var newCanvasHeight=$(".canvas-container").height();

    var rect, isDown, origX, origY;

    var brushColor = jQuery("#drawing-color").val();

   canvas.on('before:selection:cleared', function() {

        var clearedObject;

        if(typeof(canvas.getActiveObject()) !== 'undefined') {

            clearedObject = canvas.getActiveObject();

        }

        else {

            clearedObject = canvas.getActiveGroup();

        }

     });

    removeEvents();

    canvas.on('mouse:down', function(o) {

        isDown = true;

        var pointer = canvas.getPointer(o.e);

        origX = pointer.x;

        origY = pointer.y;

        var pointer = canvas.getPointer(o.e);

        trian = new fabric.Triangle({

            left: origX,

            top: origY,

            originX: 'left',

            originY: 'top',

            width: pointer.x - origX,

            height: pointer.y - origY,

            fill: 'transparent',

            strokeWidth: strock,

            _origStrokeWidth:3,

            noScaleCache: false,

            strokeUniform: true,

            stroke: jQuery("#drawing-color").val(),

            id:generateId(),

            perPixelTargetFind:true

           

        });

        trian.hasRotatingPoint = true;

        canvas.add(trian);

        canvas.isDrawingMode = false;

    });



    canvas.on('mouse:move', function(o) {

        if (!isDown) return;

        var pointer = canvas.getPointer(o.e);



        if (origX > pointer.x) {

            trian.set({

                left: Math.abs(pointer.x)

            });

        }

        if (origY > pointer.y) {

            trian.set({

                top: Math.abs(pointer.y)

            });

        }



        trian.set({

            width: Math.abs(origX - pointer.x)

        });

        trian.set({

            height: Math.abs(origY - pointer.y)

        });

        canvas.renderAll();

       

        saveCanvasHistory((trian).toJSON(['id']));

        socket.emit('object-modified', {target: (trian).toJSON(['id']),'fromUser':userId,'toUser':frndId,'getHeight':newCanvasHeight,'getWidth':getWidth});

    });



    canvas.on('mouse:up', function(o) {

        isDown = false;

        trian.setCoords();

        removeEvents();

        canvas.trigger('object:added', { target: trian });

        var jsonResponse = isJson(trian); 

        if(jsonResponse!=false)

        {

            saveCanvasHistory(jsonResponse);

            socket.emit('object-added', {target:jsonResponse,'fromUser':userId,'toUser':frndId,'getHeight':newCanvasHeight,'getWidth':getWidth}); 

        }

    });

    canvas.on('object:modified', function(event) {

        var jsonResponse = isJson(trian); 

        if(jsonResponse!=false){

            saveCanvasHistory(jsonResponse);

            socket.emit('object-modified', {target: jsonResponse,'fromUser':userId,'toUser':frndId,'getHeight':newCanvasHeight,'getWidth':getWidth});

        }

       removeEvents();

     });

     canvas.on('object:scaling', function(event) 

     {

      var jsonResponse = isJson(trian); 

      if(jsonResponse!=false)

      {

        saveCanvasHistory(jsonResponse);

       socket.emit('object-scaling', {target: jsonResponse,'fromUser':userId,'toUser':frndId,'getHeight':newCanvasHeight,'getWidth':getWidth});

      }

     });

}



canvas.on('object:modified', function(e) { 

    var newCanvasHeight=$(".canvas-container").height();

    if(canvas.getActiveObject()) 

     {

        var jsonResponse = isJson(canvas.getActiveObject());

      

        if(jsonResponse!=false)

        {

            saveCanvasHistory(jsonResponse);

          socket.emit('object-modified', {target: jsonResponse,'fromUser':userId,'toUser':frndId,'getHeight':newCanvasHeight,'getWidth':getWidth});

        }

     }

     canvas.renderAll();

});

canvas.on('object:scaling', function(e) { 

    

    var newCanvasHeight=$(".canvas-container").height();

    if(canvas.getActiveObject()) 

     {

        

        var jsonResponse = isJson(canvas.getActiveObject());

       if(jsonResponse.type=='line')

        {

            e.target.lockScalingY = true;

            e.target.lockScalingX = false;

        }

         if(jsonResponse!=false)

        {

            saveCanvasHistory(jsonResponse);

          socket.emit('object-scaling', {target: jsonResponse,'fromUser':userId,'toUser':frndId,'getHeight':newCanvasHeight,'getWidth':getWidth});

        }

     }

     canvas.renderAll();

});









/**

 * Canvas add line

 */

function draw_line() {

    removeEvents();

    var newCanvasHeight=$(".canvas-container").height();

    var brushColor = jQuery("#drawing-color").val();

    canvas.on('mouse:down', function(o) {

        isDown = true;

        var pointer = canvas.getPointer(o.e);

        var points = [pointer.x, pointer.y, pointer.x, pointer.y];

        line = new fabric.Line(points, {

            strokeWidth: strock,

            _origStrokeWidth:3,

            fill: 'transparent',

            stroke: jQuery("#drawing-color").val(),

            originX: 'center',

            originY: 'center',

            id:generateId(),

            lockScalingY: true,

            perPixelTargetFind:true

        });

        canvas.add(line);

        canvas.isDrawingMode = false;

    });

    canvas.on('mouse:move', function(o) {

        if (!isDown) return;

        var pointer = canvas.getPointer(o.e);

        line.set({

            x2: pointer.x,

            y2: pointer.y

        });

        canvas.renderAll();

        var jsonResponse = isJson(line); 

        if(jsonResponse!=false){

            saveCanvasHistory(jsonResponse);

            socket.emit('object-modified', {target: jsonResponse,'fromUser':userId,'toUser':frndId,'getHeight':newCanvasHeight,'getWidth':getWidth});

        }

    });

    canvas.on('mouse:up', function(o) {

        isDown = false;

        line.setCoords();

        removeEvents();

        canvas.trigger('object:added', { target: line });

        var jsonResponse = isJson(line); 

        if(jsonResponse!=false)

        {

            saveCanvasHistory(jsonResponse);

        socket.emit('object-added', {target: jsonResponse,'fromUser':userId,'toUser':frndId,'getHeight':newCanvasHeight,'getWidth':getWidth}); 

        }

    });

    canvas.on('object:modified', function(event) {

        var jsonResponse = isJson(line); 

        if(jsonResponse!=false){

            saveCanvasHistory(jsonResponse);

            socket.emit('object-modified', {target: jsonResponse,'fromUser':userId,'toUser':frndId,'getHeight':newCanvasHeight,'getWidth':getWidth});

        }

       removeEvents();

     });

     canvas.on('object:scaling', function(event) 

     {

        line.lockScalingY = line._origStrokeWidth / Math.max(line.scaleX, line.scaleY);

        var jsonResponse = isJson(line); 

        if(jsonResponse!=false)

        {

            saveCanvasHistory(jsonResponse);

            socket.emit('object-scaling', {target: jsonResponse,'fromUser':userId,'toUser':frndId,'getHeight':newCanvasHeight,'getWidth':getWidth});

        }

     });

    

}



/**

 * Add text on canvas

 */

function draw_text() {

    var newCanvasHeight=$(".canvas-container").height();

    var obj = canvas.getObjects();

    var oText;

    removeEvents();

   canvas.on('before:selection:cleared', function() {

        var clearedObject;

        if(typeof(canvas.getActiveObject()) !== 'undefined') {

            clearedObject = canvas.getActiveObject();

        }

        else {

            clearedObject = canvas.getActiveGroup();

        }

     });

  canvas.on('mouse:down', function(o) {

        var pointer = canvas.getPointer(o.e);

       var posX = pointer.x;

        var posY = pointer.y;

        isDown = true;

        oText = new fabric.IText('Text...', {

            width: 150,

            left: posX,

            top: posY,

            padding: 10,

            fontFamily: 'Times New Roman',

            fill: jQuery("#drawing-color").val(),

            fontSize: font_Size,

            cornerSize: 5,

            lockScalingY: false,

            lockUniScaling :false,

            id:generateId(),

            perPixelTargetFind:true,

           

        });

        oText.id = generateId();

        canvas.add(oText);

        canvas.setActiveObject(oText);

        oText.selectAll();

        oText.enterEditing();

        oText.hiddenTextarea.focus();

        canvas.renderAll();

    });

    canvas.on('text:changed', function(e) {

       

      });

    canvas.on('mouse:up', function(o) {

        isDown = false;

        oText.setCoords();

        

        canvas.trigger('object:added', { target: oText });

        var jsonResponse = isJson(oText); 

        if(jsonResponse!=false)

        {

            saveCanvasHistory(jsonResponse);

            socket.emit('object-added', {target: jsonResponse,'fromUser':userId,'toUser':frndId,'getHeight':newCanvasHeight,'getWidth':getWidth}); 

        }

        removeEvents();

    });

   

    canvas.on('object:scaling', function(event) 

    {

        canvas.discardActiveObject();

        canvas.renderAll();

        var jsonResponse = isJson(oText); 

        if(jsonResponse!=false)

        {

            saveCanvasHistory(jsonResponse);

            socket.emit('object-scaling', {target: jsonResponse,'fromUser':userId,'toUser':frndId,'getHeight':newCanvasHeight,'getWidth':getWidth});

        }

        removeEvents();

    });

    canvas.on('object:modified', function(event) 

    {

        event.target.fontSize *= event.target.scaleX;

        event.target.fontSize = event.target.fontSize.toFixed(0);

        event.target.scaleX = 1;

        event.target.scaleY = 1;

        canvas.renderAll();

        var jsonResponse = isJson(oText); 

        if(jsonResponse!=false){

            saveCanvasHistory(jsonResponse);

            socket.emit('object-modified', {target: jsonResponse,'fromUser':userId,'toUser':frndId,'getHeight':newCanvasHeight,'getWidth':getWidth});

        }

       removeEvents();

    });

}



//Fill color / set color style of Text

function setColor(color)

{

    var newCanvasHeight=$(".canvas-container").height();

    let obj = canvas.getActiveObject();

    obj.setSelectionStyles({fill:color});

   

    var jsonResponse = isJson(obj); 

    if(jsonResponse!=false){

        saveCanvasHistory(jsonResponse);

        socket.emit('object-modified', {target: jsonResponse,'fromUser':userId,'toUser':frndId,'getHeight':newCanvasHeight,'getWidth':getWidth});

    }

    canvas.renderAll();

}    





/**

 * Canvas enable drawing mode with width

 */

function enableDrawing() {

    removeEvents();

    canvas.isDrawingMode = true;

    var newCanvasHeight=$(".canvas-container").height();

    canvas.freeDrawingBrush.color = jQuery("#drawing-color").val();

    canvas.freeDrawingBrush.width=drawingstrock-1;

    canvas.on('path:created', function(event) 

    {

        event.path.id = generateId();

        var jsonResponse = isJson(event.path); 

        if(jsonResponse!=false)

        {

            saveCanvasHistory(jsonResponse);

        socket.emit('object-added',{target:jsonResponse,'fromUser':userId,'toUser':frndId,'getHeight':newCanvasHeight,'getWidth':getWidth});

        }

    });

    canvas.on('object:modified', function(event)

     {

       var data = (event.target).toJSON(['id']);

       saveCanvasHistory(data);

       socket.emit('object-modified', {target:data,'fromUser':userId,'toUser':frndId,'getHeight':newCanvasHeight,'getWidth':getWidth});

       removeEvents();

      });

      canvas.on('object:scaling', function(event) 

     {

        var jsonResponse = isJson(event.target); 

        if(jsonResponse!=false)

        {

            saveCanvasHistory(jsonResponse);

            socket.emit('object-scaling', {target: jsonResponse,'fromUser':userId,'toUser':frndId,'getHeight':newCanvasHeight,'getWidth':getWidth});

        }

        removeEvents();

    });

    canvas.on('object:removed', function(event) {

        var jsonResponse = isJson(event.path); 

        if(jsonResponse!=false)

        {

            saveCanvasHistory(jsonResponse);

            socket.emit('object-removed', {target: jsonResponse,'fromUser':userId,'toUser':frndId,'getHeight':newCanvasHeight,'getWidth':getWidth});

         }

     });

    $('.fullboard-btn').addClass('active');

    

}



/**

 * Canvas add image

 */

function addImage(e) {

    var newCanvasHeight=$(".canvas-container").height();

    var reader = new FileReader();

    reader.onload = function(event) {

        var imgObj = new Image();

        imgObj.src = event.target.result;

        imgObj.onload = function() {

            var image = new fabric.Image(imgObj);

            image.set({

                left: 50,

                top: 50,

                angle: 0,

                padding: 0,

                cornersize: 5,

                id:generateId(),

             //   perPixelTargetFind:true

            });

             image.scaleToHeight(150);

             image.scaleToWidth(150);

            canvas.add(image);

            socket.emit('object-added', {target: (image).toJSON(['id']),'fromUser':userId,'toUser':frndId,'getHeight':newCanvasHeight,'getWidth':getWidth}); 

            canvas.on('object:modified', function(event) {

                var jsonResponse = isJson(image); 

                if(jsonResponse!=false)

                {

                    saveCanvasHistory(jsonResponse);

                    socket.emit('object-modified', {target:jsonResponse,'fromUser':userId,'toUser':frndId,'getHeight':newCanvasHeight,'getWidth':getWidth});

                }

                removeEvents();

             });

             canvas.on('object:removed', function(event) {

                var jsonResponse = isJson(image); 

                if(jsonResponse!=false)

                {

                    saveCanvasHistory(jsonResponse);

                    socket.emit('object:removed', jsonResponse);

                 }

             });

             canvas.on('object:scaling', function(event) 

             {

                var jsonResponse = isJson(event.target); 

                if(jsonResponse!=false)

                {

                    saveCanvasHistory(jsonResponse);

                    socket.emit('object-scaling', {target: jsonResponse,'fromUser':userId,'toUser':frndId,'getHeight':newCanvasHeight,'getWidth':getWidth});

                }

                removeEvents();

            });

           

        }

    }

    reader.readAsDataURL(e.target.files[0]);

}





/**

 * Canvas history actions

 */

canvas.on('object:added', function() {

    let artboardId =  $("#artboardId").val(); 

    if (!isRedoing) {

        if(artboardId==1)

        {

            h1 = [];

        }else

        if(artboardId==2)

        {

            h2 = [];

        }else

        if(artboardId==3)

        {

            h3 = [];

        }else

        if(artboardId==4)

        {

            h4 = [];

        }else

        if(artboardId==5)

        {

            h5 = [];

        }

       

    }

    isRedoing = false;

});



var isRedoing = false;

var h1 = [];

var h2 = [];

var h3 = [];

var h4 = [];

var h5 = [];

/**

 * Canvas undo actions

 */

function undoAction() {

    removeEvents();

    let artboardId =  $("#artboardId").val(); 

    if(artboardId==1)

         {

             h=h1;

         }else

         if(artboardId==2)

         {

            h=h2;

         }else

         if(artboardId==3)

         {

            h=h3;

         }

        else

         if(artboardId==4)

         {

            h=h4;

         }

        else

         if(artboardId==5)

         {

            h=h5;

         }

         

    if (h.length > 0 && eraseObject>0) {

        for (var i=0; i<h.length; i++)

        {

            if(h[i].action=='erase')

            {



                isRedoing = true;

                canvas.add(h.pop());

                socket.emit('object-redo', {target: [],'fromUser':userId,'toUser':frndId}); 

                eraseObject--;

            }

        }

       

    }else

    if (canvas._objects.length > 0) {

        canvas._objects[0].action='undo';

        socket.emit('object-undo', {target: canvas._objects,'fromUser':userId,'toUser':frndId}); 

         if(artboardId==1)

         {

             h1.push(canvas._objects.pop());

         }else

         if(artboardId==2)

         {

            h2.push(canvas._objects.pop());

         }else

         if(artboardId==3)

         {

             h3.push(canvas._objects.pop());

         }

        else

         if(artboardId==4)

         {

             h4.push(canvas._objects.pop());

         }

        else

         if(artboardId==5)

         {

            h5.push(canvas._objects.pop());

         }

         canvas.discardActiveObject();

         canvas.renderAll();

     }

}

socket.on('object-undo', function(data) {

        removeEvents();

        let artboardId =  $("#artboardId").val(); 

    

        if (canvas._objects.length > 0) {

            if(artboardId==1)

            {

                h1.push(canvas._objects.pop());

            }else

            if(artboardId==2)

            {

                h2.push(canvas._objects.pop());

            }else

            if(artboardId==3)

            {

                h3.push(canvas._objects.pop());

            }

            else

            if(artboardId==4)

            {

                h4.push(canvas._objects.pop());

            }else

            if(artboardId==5)

            {

                h5.push(canvas._objects.pop());

            }

            canvas.discardActiveObject();

            canvas.renderAll();

        }

});

/**

 * Canvas redo actions

 */

function redoAction() {

    let artboardId =  $("#artboardId").val(); 

    removeEvents();

    if (artboardId==1 && h1.length > 0) {

        isRedoing = true;

        socket.emit('object-redo', {target: [],'fromUser':userId,'toUser':frndId}); 

        canvas.add(h1.pop());

    }else 

    if (artboardId==2 && h2.length > 0) {

        isRedoing = true;

        socket.emit('object-redo', {target: [],'fromUser':userId,'toUser':frndId}); 

        canvas.add(h2.pop());

    }else

    if (artboardId==3 && h3.length > 0) {

        isRedoing = true;

        socket.emit('object-redo', {target: [],'fromUser':userId,'toUser':frndId}); 

        canvas.add(h3.pop());

    }else 

    if (artboardId==4 && h4.length > 0) {

        isRedoing = true;

        socket.emit('object-redo', {target: [],'fromUser':userId,'toUser':frndId}); 

        canvas.add(h4.pop());

    }else

    if (artboardId==5 && h5.length > 0) {

        isRedoing = true;

        socket.emit('object-redo', {target: [],'fromUser':userId,'toUser':frndId}); 

        canvas.add(h5.pop());

    }

}



function reSizeCanvasObject(data)

{

    

    var innerHeight=$(".canvas-container").height();

    

    var userWidth = data.getWidth;

    var userHeight = data.getHeight;

    var myWidth = getWidth;

    var myHeight = innerHeight;

    // top calculation

    if(data.target.top)

    {

        var top = data.target.top;

        var newTop = (top*myWidth)/userWidth;

        data.target.top = newTop;

    }

 

    // left calculation

    if(data.target.left)

    {

        var left = data.target.left;

        var newLeft = (left*myWidth)/userWidth;

        data.target.left = newLeft;

    }

    // width calculation

    if(data.target.width)

    {

        var width = data.target.width;

        var newWidth = (width*myWidth)/userWidth;

        data.target.width = newWidth;

    }

    // height calculation

    if(data.target.height)

    {

        var height = data.target.height;

        var newHeight = (height*myWidth)/userWidth;

        data.target.height = newHeight;

    }

    if(data.target.strokeWidth)

    {

        var strokeWidth = data.target.strokeWidth;

        var newstrokeWidth = (strokeWidth*myWidth)/userWidth;

        data.target.strokeWidth = newstrokeWidth;

    }

    

    if(data.target.type=='path'){

        // scaleX calculation

        var newscaleX = (data.target.scaleX*myWidth)/userWidth;

        data.target.scaleX = newscaleX;



        // scaleY calculation

        var newscaleY = (data.target.scaleY*myWidth)/userWidth;

        data.target.scaleY = newscaleY;

    }

    

    if(data.target.type=='circle'){

        var radius    = data.target.radius;

        var newRadius = (radius*myWidth)/userWidth;

        data.target.radius = newRadius;

    }else if(data.target.type=='line')

    {

        data.target.x1 = (data.target.x1*myWidth)/userWidth;

        data.target.y1 = (data.target.y1*myWidth)/userWidth;

        data.target.x2 = (data.target.x2*myWidth)/userWidth;

        data.target.y2 = (data.target.y2*myWidth)/userWidth;

     }

     

     else if(data.target.type=='i-text')

     {

        var newfontSize = (data.target.fontSize*myWidth)/userWidth;

        data.target.fontSize = newfontSize;

     }

  

     return data;

}

socket.on('object-redo', function(data) {

    

     let artboardId =  $("#artboardId").val(); 

    removeEvents();

    if (artboardId==1 && h1.length > 0) {

        isRedoing = true;

        canvas.add(h1.pop());

    }else 

    if (artboardId==2 && h2.length > 0) {

        isRedoing = true;

        canvas.add(h2.pop());

    }else

    if (artboardId==3 && h3.length > 0) {

        isRedoing = true;

        canvas.add(h3.pop());

    }

    else 

    if (artboardId==4 && h2.length > 0) {

        isRedoing = true;

        canvas.add(h4.pop());

    }else

    if (artboardId==5 && h3.length > 0) {

        isRedoing = true;

        canvas.add(h5.pop());

    }

});



socket.on('object-added', function(data) {

     

      canvas.isDrawingMode = false;

      data = reSizeCanvasObject(data);

       data = data.target;

   

    switch (data.type) {

        case 'i-text':

            var text = new fabric.IText(data.text, data);

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

        case 'path':

            var path = new fabric.Path(data.path.join(' '), data);

            canvas.freeDrawingBrush.width=drawingstrock-.5;

            canvas.add(path);

        break;

        case 'image':

         var image = new fabric.Image.fromURL(data.src, function(image) {

                var imgObj = new fabric.Image(image);

                imgObj.set(data);

                image.id = data.id;

                image.scaleToHeight(150);

                image.scaleToWidth(150);

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

socket.on('object-scaling', function(data) {

    

   

    canvas.isDrawingMode = false;

    data = reSizeCanvasObject(data);

    data = data.target;

   var objectnew = getObjectById(data.id);

    if (objectnew) {

            if (data.type === 'i-text') {

               objectnew.width = data.width;

               objectnew.fontSize = data.fontSize;

               }

               if (data.type === 'circle'  || data.type==='rect' || data.type  =='triangle' || data.type  =='line') {

                   objectnew.noScaleCache= false;

                   objectnew.strokeUniform= true;

                }else if(data.type==='line')

                {

                    objectnew.strokeWidth=data.strokeWidth;  

                }

               

                objectnew.setCoords();

               canvas.renderAll();

        }

    });



socket.on('object-modified', function(data) {

    canvas.discardActiveObject();

    canvas.renderAll(); 

    canvas.isDrawingMode = false;

    data = reSizeCanvasObject(data);

    data = data.target;



    var object = getObjectById(data.id);

    if (object) {

           object.animate({

               left: data.left,

               top: data.top,

               scaleX: data.scaleX,

               scaleY: data.scaleY,

               angle: data.angle,

           }, {

               duration: 500,

               onChange: function() {

                   if (data.type === 'i-text') 

                   {

                    object.text = data.text;

                    object.styles[0] = data.styles[0];

                    object.fontSize = data.fontSize;

                   }

                    object.id = data.id;

                   object.setCoords();

                   canvas.renderAll();

                   if (isWritable) {

                       setSelectable(true);

                   } else {

                       setSelectable(false);

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

socket.on('object:removed', function(data) 

{

   

    var object = getObjectById(data.id);

    if (object) {

        let artboardId =  $("#artboardId").val(); 

        if(artboardId==1)

         {

             h=h1;

         }else

         if(artboardId==2)

         {

            h=h2;

         }else

         if(artboardId==3)

         {

            h=h3;

         }

        else

         if(artboardId==4)

         {

            h=h4;

         }

        else

         if(artboardId==5)

         {

            h=h5;

         }

        for (var i=0; i<canvas._objects.length; i++)

        {

            if(canvas._objects[i].id==object.id)

            {

                canvas._objects[i].action='erase';

                h.push(canvas._objects[i]);

            }

        }

        canvas.remove(object);

        canvas.renderAll();

    }

});

function getObjectById(id) {

    var objects = canvas.getObjects();

    var length = canvas.getObjects().length;

    for (var i = 0; i < length; i++) {

        if ((objects[i].id == id) || (objects[i].id == ("NaN" + id)))

            return objects[i];

    }

};

function setSelectable(isSelectable) {

     if (!isSelectable) {

        clearHandlers();

    }

    

    canvas.selectable = isSelectable;

    canvas.forEachObject(function(o) {

        o.selectable = isSelectable;

    });

    



}
function saveCanvasHistory(objects)
{
    let artboardId =  $("#artboardId").val(); 
    var json = canvas.toJSON(objects);
    localStorage.setItem('canvasData'+artboardId, JSON.stringify(json));
}