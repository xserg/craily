$(document).ready(function() {
    /*========== Toggle ==========*/
    $(document).on('click', '.toggle', function() {
        $('.toggle').toggleClass('active');
        $('nav').slideToggle();
        $('.upperlay').toggleClass('active');
    });
    $(document).on('click', '.upperlay', function() {
        $('.toggle').removeClass('active');
        $('nav').slideUp();
        $('.upperlay').removeClass('active');
    });


    $(document).on('click', 'header .srchBtn', function() {
        $(this).toggleClass('active');
        $('header form').fadeToggle();
    });


    $(document).on('click', '#dash .lBar .head', function() {
        $('#sBar').slideToggle();
    });


    $(document).on('click', '#search .circleBtn', function() {
        $('body').toggleClass('flow');
        $('#search .circleBtn').toggleClass('change');
        $('#search .flexRow > .col1').toggleClass('active');
    });


    /*========== File Upload ==========*/
    $(document).on('click', '.uploadAtt', function(){
        $('.chatAtt').trigger('click');
    })
    var imgFile;
    $(document).on('click', '.uploadImg', function(){
        $(this).parents('form').find('.uploadFile, #uploadFile, .tutorImg').trigger('click').data('file',$(this).attr('data-image-src'));
        // $('#uploadFile').trigger('click');
        imgFile = $(this);
        // $('#uploadFile').data('file',$(this).attr('data-image-src'));
    });

    $(document).on('change', '.uploadFile', function(){
        // alert(imgFile);
        var file = $(this).val();
        // imgFile.html(file);
        $('.imgSelect').removeClass('hidden').html(file);
    });

    $(document).on('change', '.tutorImg', function(){
        var file = $(this).val();
        imgFile.html(file);
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


    $(document).on('click', '.faqLst > li > h3', function() {
        $('.faqLst > li .cntnt').not($(this).parent('li').children('.cntnt').slideToggle()).slideUp();
        $(".faqLst > li i").not($(this).parent('li').children('i').toggleClass("fi-plus").toggleClass("fi-minus")).removeClass("fi-minus").addClass("fi-plus");
    });



    /*========== Popup ==========*/
    $(document).on('click', '.popup', function(e) {
        if ($(e.target).closest('.popup ._inner, .popup .inside').length === 0) {
            $('.popup').fadeOut('3000');
            $('body').removeClass('flow');
        }
    });
    $(document).on('click', '.crosBtn', function() {
        $('.popup').fadeOut();
        $('body').removeClass('flow');
    });
    $(document).keydown(function(e) {
        if (e.keyCode == 27) $('.crosBtn').click();
    });
    $(document).on('click', '.popBtn', function() {
        var popUp = $(this).data('popup');
        $('body').addClass('flow');
        $('.popup[data-popup= "' + popUp+'"]').fadeIn().find('input:first').focus().end().find('form').get(0).reset();
    });


    /*$('.nextBtn').click(function() {
        // fieldset
        currStep = $(this).parents('fieldset');
        nextStep = currStep.next('fieldset');
        currStep.hide();
        nextStep.fadeIn();
    });
    $('.prevBtn').click(function() {
        // fieldset
        currStep = $(this).parents('fieldset');
        prevStep = currStep.prev('fieldset');
        currStep.hide();
        prevStep.fadeIn();
    });*/


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
    });
    $(document).on('click', '#messages .frnds li', function() {
        // $('body').addClass('flow');
        $('#messages .chatBlk').addClass('active');
    });
    $(document).on('click', '#messages .chatPerson .backBtn', function() {
        // $('body').removeClass('flow');
        $('#messages .chatBlk').removeClass('active');
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


    /*$(document).on('click', '#myTrans .tableBlk tbody tr', function() {
        link = $(this).data('link');
        window.location = link;
    });*/

    $(document).on('click', '#payMthd a[data-pay-method]', function() {
        method = $(this).data('pay-method');
        $('#payMthd a[data-pay-method]').removeClass('active');
        $(this).addClass('active');
        $('div[data-pay-method]').hide();
        $('div[data-pay-method=' + method +']').fadeIn();
    });

    $(document).on('click', '#contact a[data-contact]', function() {
        method = $(this).data('contact');
        $('#contact a[data-contact]').removeClass('active');
        $(this).addClass('active');
        $('div[data-contact]').hide();
        $('div[data-contact=' + method +']').fadeIn();
    });

    $(".phoneLst > li > input").keyup(function(e){
        if ((e.keyCode>47 && e.keyCode<58) || (!e.shiftKey && e.keyCode>=95 && e.keyCode<=105))
            $(this).parent().next().children().focus();
        if (e.keyCode===8)
            $(this).parent().prev().children().focus();
    });
});


function textAreaAdjust(o) {
    o.style.height = '1px';
    o.style.height = (25 + o.scrollHeight) + 'px';
}


/*========== Page Loader ==========*/
$(window).on('load', function() {
    $('.loader').delay(700).fadeOut();
    $('#pageloader').delay(1200).fadeOut('slow');
});