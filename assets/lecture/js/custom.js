$(document).ready(function() {
    //Play video on load
    var localVideo = document.getElementById("localVideo");
    localVideo.autoplay = true;
    localVideo.load();
    var remoteVideo = document.getElementById("remoteVideo");
    remoteVideo.autoplay = true;
    remoteVideo.load();

    // Get maincontent height
    if (screen.width > 600) {
        var mainContentHeight = document.getElementById('mainContent').clientHeight - 45;
    } else {
        var mainContentHeight = document.getElementById('mainContent').clientHeight - 120;
    }

    //chatbox
    $('#chatInput').keypress(function(event) {

        if (event.which == 13) {
            if ($('#chatInput').val().trim().length) {
                var msg = document.getElementById("chatInput").value;
                $("#chatBody ul").append('<li class="sent"><div class="common">' + msg +
                    '</div></li>');
                setTimeout(function() {
                    $("#chatBody ul").append('<li class="received"><div class="common">Hi</div></li>');
                }, 500);
                $('#chatBody').animate({
                    scrollTop: document.getElementById("chatBody").scrollHeight
                }, 1500);
                document.getElementById("chatInput").value = '';
                $('#sendMessage').click();
            }
        }
    });
    $('#sendMessage').click(function(e) {
        if ($('#chatInput').val().trim().length) {
            var msg = document.getElementById("chatInput").value;
            $("#chatBody ul").append('<li class="sent"><div class="common">' + msg + '</div></li>');
            setTimeout(function() {
                $("#chatBody ul").append('<li class="received"><div class="common">Hi</div></li>');
            }, 500);
            $('#chatBody').animate({
                scrollTop: document.getElementById("chatBody").scrollHeight
            }, 1500);
            document.getElementById("chatInput").value = '';
        } else {

        }
    });

    $(function() {
        $("#remoteVideo").draggable({
            containment: "parent"
        });
    });
    if ($('#videoSection').hasClass('videosection__maximize')) {
        $("#drawingTool").addClass('disabled');
    }
    var resizeVideo = document.getElementById('resizeVideoBtn');
    resizeVideo.addEventListener('click', function() {
        document.getElementById('videoSection').classList.toggle("videosection__minimize");
        document.getElementById('videoSection').classList.toggle('videosection__maximize');
        document.getElementById('remoteVideo').removeAttribute("style");
        if ($('#videoSection').hasClass('videosection__maximize')) {
            $("#drawingTool").addClass('disabled');
            document.getElementById("fullBoard").style.pointerEvents = "inherit";
            document.getElementById("fullBoard").classList.remove('active');
        }
    });
    var $editor = document.getElementById('editor-tab');
    $editor.addEventListener('click', function(e) {
        e.preventDefault();
        $("#drawingTool").addClass('disabled');
        document.getElementById("fullBoard").style.pointerEvents = "inherit";
        $("#navigation").find('a').removeClass('active');
        if ($('#videoSection').hasClass('videosection__maximize')) {
            document.getElementById("videoSection").classList.add('videosection__minimize');
            document.getElementById("videoSection").classList.remove('videosection__maximize');
        }
        if ($('#videoSection').hasClass('videosection__minimize')) {
            document.getElementById("openVideo").classList.add('active');
        }
        if ($('#chatBox').hasClass('active')) {
            document.getElementById("chatBox").classList.add('active');
            document.getElementById("openChat").classList.add('active');
        } else {
            document.getElementById("chatBox").classList.remove('active');
        }
    });

    var $whiteboard = document.getElementById('whiteboard-tab');
    $whiteboard.addEventListener('click', function() {
        //document.getElementById("whiteBoardSection").style.display = 'block';
        $("#drawingTool").removeClass('disabled');
        document.getElementById("fullBoard").classList.add('active');
        if ($('#fullBoard').hasClass('active')) {
            document.getElementById("fullBoard").style.pointerEvents = "none";
        }

    });
    //console.log(mainContentHeight);
    CKEDITOR.replace('textEditor', {
        height: mainContentHeight,
        removePlugins: 'elementspath',
        toolbarGroups: [{
                "name": "styles",
                "groups": ["styles"]
            },
            {
                "name": 'colors',
                "groups": ['TextColor']
            },
            {
                "name": "basicstyles",
                "groups": ["basicstyles"]
            },

            {
                "name": "paragraph",
                "groups": ["list", 'align']
            },
        ],
        // Remove the redundant buttons from toolbar groups defined above.
        removeButtons: 'Format,BGColor,Blockquotes,Strike,Subscript,Superscript,Anchor,Styles,Specialchar',
    });
});
/*
 * Fabric js tools options     
 */
function selectObject(id) {
    ActiveItem(id);
    selectTool();
}

function eraseCanvas(id) {
    ActiveItem(id);
    //eraserCanvas();
    clearCanvas();
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
    this.href = canvas.toDataURL({
        format: 'png',
        quality: 0.8
    });
    this.download = 'canvas.png'
});

/**
 * open Video
 */
function openVideo() {
    document.getElementById("videoSection").style.display = 'block';
    document.getElementById("openVideo").classList.add('active');
    document.getElementById("videoSection").classList.add('videosection__minimize');
}
/**
 * Close Video
 */
function closeVideo() {
    document.getElementById("videoSection").style.display = 'none';
    document.getElementById("openVideo").classList.remove('active');
    document.getElementById("videoSection").classList.remove('videosection__minimize');
}

/**
 * Close Chatbox
 */
function closeChat() {

    document.getElementById("openChat").classList.remove('active');
    document.getElementById("chatBox").classList.remove('active');

}

/**
 * Open Chat
 */
function openChat(id) {
    document.getElementById("openChat").classList.add('active');
    document.getElementById("chatBox").classList.add('active');
    setTimeout(function() {
        // document.getElementById("chatBody").scrollTop;
        $("#chatBody").animate({
            scrollTop: document.body.scrollHeight
        }, "slow");
    }, 500);
}
/**
 * Open fullBoard
 */
function fullBoard(id) {
    getFullboard();
}