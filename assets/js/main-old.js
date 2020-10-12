$(document).ready(function() {
    /*========== Toggle ==========*/
    $(document).on('click', '.toggle', function() {
        $('.toggle').toggleClass('active');
        $('.upperlay').toggleClass('active');
        $('nav').toggleClass('move');
        $('html').toggleClass('move');
        $('body').toggleClass('move');
        $('header').toggleClass('move');
    });
    $(document).on('click', '.upperlay, #nav > li .runBtn', function() {
        $('.toggle').removeClass('active');
        $('.upperlay').removeClass('active');
        $('nav').removeClass('move');
        $('html').removeClass('move');
        $('body').removeClass('move');
        $('header').removeClass('move');
    });


    $(document).on('click', '#comicLst .infoBlk .showHideBtn > a', function() {
        $(this).parents('.infoBlk').toggleClass('view');

    });


    $(document).on('click', 'header .srchBtn', function() {
        $(this).toggleClass('active');
        $('header form').fadeToggle();
    });


    $(document).on('click', '#detailPg .topHead .toggleBtn', function() {
        $(this).toggleClass('active');
        $('#detailPg').toggleClass('active');
        $('#detailPg .blackBar').toggleClass('active');
    });


    /*========== Dropdown ==========*/
    $(document).on('click', '.dropBtn', function(e) {
        e.stopPropagation();
        var $this = $(this).parent().children('.dropCnt');
        $('.dropCnt').not($this).removeClass('active');
        var $parent = $(this).parent('.dropDown');
        $parent.children('.dropCnt').toggleClass('active');
    });
    $(document).on('click', '.dropCnt', function(e) {
        e.stopPropagation();
    });
    $(document).on('click', function() {
        $('.dropCnt').removeClass('active');
    });


    /*========== File Upload ==========*/
    $(document).on('click', '.uploadAtt', function(){
        $('.chatAtt').trigger('click');
    })
    var imgFile;
    $(document).on('click', '.uploadImg', function(){
        $('.uploadFile').trigger('click');
        $('#uploadFile').trigger('click');
        imgFile = $(this);
        $('#uploadFile').data('file',$(this).attr('data-image-src'));
    });

    $(document).on('change', '.uploadFile', function(){
        // alert(imgFile);
        var file = $(this).val();
        // imgFile.html(file);
        $('.imgSelect').removeClass('hidden').html(file);
    });

    $(document).on('change', '.multiFiles', function(){
        var file = parseInt(this.files.length);
        file=file>0? file+" file selected" :'Choose Images';
        $(this).prev('span').html(file);
    });

    /*var imgFile;
    $(document).on('click', '.uploadImg', function() {
        $('.uploadFile').trigger('click');
        imgFile = $(this).attr('data-image-src');
    });
    $(document).on('change', '.uploadFile', function() {
        // alert(imgFile);
        var file = $(this).val();
        $('.uploadImg').html(file);
    });*/


    $(document).on('click', '.faqLst > li > h3', function() {
        $('.faqLst > li .cntnt').not($(this).parent('li').children('.cntnt').slideToggle()).slideUp();
        $('.faqLst > li i').not($(this).parent('li').children('i').toggleClass('fi-plus').toggleClass('fi-minus')).removeClass('fi-minus').addClass('fi-plus');
    });


    /*========== Popup ==========*/
    $(document).on('click', '.popup', function(e) {
        if ($(e.target).closest('.popup ._inner').length === 0) {
            $('.popup').fadeOut('3000');
            $('body').removeClass('flow');
            $('.popup .videoBlk').html('');
        }
    });
    $(document).on('click', '.crosBtn', function() {
        $('.popup').fadeOut();
        $('body').removeClass('flow');
        $('.popup .videoBlk').html('');

    });
    $(document).keydown(function(e) {
        if (e.keyCode == 27) $('.crosBtn').click();
    });
    $(document).on('click', '.popBtn', function() {
        $('body').addClass('flow');
    });

    /*var preView = $('#messages .chat .buble:nth-last-child(1) .cntnt').html();
    $('#messages .frnds li p .preview').html(preView);
    var topHead = $('#messages .frnds li p').html();
    $('#messages .frnds li').click(function() {
        if ($(this).hasClass('.active')) {
            return false;
        } else {
            var findChat = $(this).attr('data-chat');
            var personName = $(this).find('#messages .frnds li .name').text();
            $('#messages .chat').removeClass('active');
            $('#messages .frnds li').removeClass('active');
            $(this).addClass('active');
            $('#messages .chat[data-chat = ' + findChat + ']').addClass('active');
        }
    });*/
    $('#messages .frnds li').click(function() {
        if ($(this).hasClass('active')) {
            return false;
        } else {
            var findChat = $(this).attr('data-chat');
            window.location=base_url+'messages/'+findChat;
        }
    });
    $(document).on('click', '#messages .frnds li', function() {
        // $('body').addClass('flow');
        $('#messages .chatBlk').addClass('active');
    });
    $(document).on('click', '#messages .chatPerson .backBtn', function() {
        // $('body').removeClass('flow');
        $('#messages .chatBlk').removeClass('active');
    });


    $('#detailPg .blackBar .icoLst > li > a').click(function() {
        var viewBlk = $(this).data('show');
        $('#detailPg .sideBlk').removeClass('view');
        if ($(this).parent().hasClass('active')) {
            $('#detailPg .ouTer').removeClass('view');
            $('#detailPg .blackBar .icoLst > li').removeClass('active');
            $('#detailPg .sideBlk[id = ' + viewBlk + ']').removeClass('view');
        } else {
            $('#detailPg .ouTer').addClass('view');
            $('#detailPg .blackBar .icoLst > li').removeClass('active');
            $(this).parent().addClass('active');
            $('#detailPg .sideBlk[id = ' + viewBlk + ']').addClass('view');
        }
    });
    $('#detailPg .sideBlk > .crosBtn').click(function() {
        $('#detailPg .sideBlk').removeClass('view');
        $('#detailPg .ouTer').removeClass('view');
        $('#detailPg .blackBar .icoLst > li').removeClass('active');
    });

    fontsize = $('#fontSize');
    $('#fontDown').click(function() {
        currentFont = parseInt(fontsize.val());
        currentFont -= 2;
        if (currentFont >= 14)
            setFontSize(currentFont);

    });
    $('#fontUp').click(function() {
        currentFont = parseInt(fontsize.val());
        currentFont += 2;
        if (currentFont <= 36)
            setFontSize(currentFont);
    });

    $('#detailPg #displayBlk .fontLst > li').click(function() {
        font = $(this).data('font');
        $('.chapter').css('font-family', font);
        $('#detailPg #displayBlk .fontLst > li').removeClass('active');
        $(this).addClass('active');
    });

    $('#defaultBg').click(function() {
        $('.bgLst > li').removeClass('active');
        $(this).addClass('active');
        $('body').removeClass('wallBg, moonBg');
    });
    $('#moonBg').click(function() {
        $('.bgLst > li').removeClass('active');
        $(this).addClass('active');
        $('body').removeClass('wallBg');
        $('body').addClass('moonBg');
    });


    $('#schedulePg .scheduleDays h2').click(function() {
        $('#schedulePg .scheduleDays > .col').removeClass('active');
        $(this).parent('.col').addClass('active');
    });

});

function setFontSize(f) {
    s = f + 'px';
    $('.chapter').css('font-size', s);
    $('#fontSize').val(f);
}


function textAreaAdjust(o) {
    o.style.height = '1px';
    o.style.height = (25 + o.scrollHeight) + 'px';
}


/*========== Page Loader ==========*/
$(window).on('load', function() {
    $('.loader').delay(700).fadeOut();
    $('#pageloader').delay(1200).fadeOut('slow');
});