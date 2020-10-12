function floatval(number){
    return parseFloat(number)||0;
}
function intval(number){
    return parseInt(number)||0;
}
function round(number){
    return parseFloat((number).toFixed(2));
}

var needToConfirm = false;
var sndMsg = true;
window.onbeforeunload = confirmExit;
function confirmExit()
{
    if (needToConfirm)
      return "You have attempted to leave this page while form submission is in progress. Are you sure?";
}
$(document).ready(function () {


    /*$('.frmAjax').validate({ 
        errorPlacement: function(){
            return false;  // suppresses error message text
        }
    });*/

    
    if((typeof recaptcha !== 'undefined') && recaptcha){
        var frmAjax='';
        $(document).on('click','.frmAjax button[type="submit"]',function(e){
            e.preventDefault();
            frmAjax=$(this).parents('.frmAjax');

            if(frmAjax.valid()){
                if($("#g-recaptcha-response").val()){
                    frmAjax.submit();
                }
                else
                    grecaptcha.execute();
            }
        })
        onSubmit=function (token) {
            frmAjax.submit();
        }
    }else{
        $(document).on('click','.frmAjax button[type="submit"]',function(e){
            var frm=$(this).parents('.frmAjax')
            $(frm).validate({ 
                errorPlacement: function(){
                    return false;  // suppresses error message text
                }
            });
        })
    }
    $(document).on('submit','.frmAjax',function(e){
        e.preventDefault();
        needToConfirm = true;
        var frmbtn=$(this).find("button[type='submit']");
        var frmIcon=$(this).find("button[type='submit'] i.fa-spinner");
        var frmMsg=$(this).find("div.alertMsg:first");
        var frm=this;

        // frmbtn.attr("disabled", true);
        frmMsg.hide();
        frmIcon.removeClass("hidden");
        $.ajax({
            url: $(this).attr('action'),
            data : new FormData(frm),
            processData: false,
            contentType: false,
            dataType: 'JSON',
            method: 'POST',

            error: function (rs) {
                console.log(rs);
            },
            success: function (rs) {
                console.log(rs);
                frmMsg.html(rs.msg).slideDown(500);
                if(rs.scroll_to_msg)
                    $('html, body').animate({ scrollTop: frmMsg.offset().top-300}, 'slow');
                if((typeof recaptcha !== 'undefined') && recaptcha)
                    grecaptcha.reset();
                if (rs.status == 1) {
                    setTimeout(function () {
                        if(rs.frm_reset){
                            frm.reset();
                            if((typeof recaptcha !== 'undefined') && recaptcha)
                                grecaptcha.reset();
                        }
                        if(rs.hide_msg)
                            frmMsg.slideUp(500);
                        frmIcon.addClass("hidden");
                        if(rs.redirect_url){
                            window.location.href = rs.redirect_url;   
                        }else{
                            frmbtn.attr("disabled", false);
                        }

                    }, 3000);
                } else {
                    setTimeout(function () {
                        if(rs.hide_msg)
                            frmMsg.slideUp(500);
                        frmbtn.attr("disabled", false);
                        frmIcon.addClass("hidden");
                        if(rs.redirect_url)
                            window.location.href = rs.redirect_url;   
                    }, 3000);
                }
            },
            complete: function (rs) {
                needToConfirm = false;
            }
        });
    });
    
    $(document).on('change', '#uploadFile', function () {
        needToConfirm = true;
        var progressBar = document.getElementById("myBar");
        var image_type = $(this).data('file');

        var elem = $(".pBar");
        var myFileList = document.getElementById('uploadFile').files;
        if(typeof myFileList[0] === 'undefined' || !myFileList[0]){
            alert('Please select a file!');
            return false;
        }
        var myFile = myFileList[0];
        var formData = new FormData();
        formData.append('image', myFile);
        formData.append('image_type', image_type);

        var xhr = new XMLHttpRequest();

        xhr.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                // Typical action to be performed when the document is ready:
                var data = this.responseText;
                var jsonResponse = JSON.parse(data);
                
                if(jsonResponse.upload_status==1){
                    if (image_type == 'cover_image')
                        $("#cover-image").css('background-image', 'url(' + jsonResponse.image + ')');
                    else
                        $("#userImage").attr("src", jsonResponse.image);
                    setTimeout(function(){
                        location.reload();
                    },1000)
                }
                else
                    alert('Uploading Error!');
                needToConfirm = false;
            }
        };
        
        xhr.upload.onloadstart = function (e) {
            elem.removeClass("hidden");
            progressBar.style.width = '0%';
        }
        xhr.upload.onprogress = function (e) {
            if (e.lengthComputable) {
                var ratio = Math.floor((e.loaded / e.total) * 100) + '%';
                progressBar.style.width = ratio;

            }
        }
        xhr.upload.onloadend = function (e) {
            progressBar.style.width = '100%';            
        }

        xhr.open("POST", base_url + 'ajax/save_mem_images');
        xhr.send(formData);
    });

    /*$(document).on('change', '#uploadFile', function () {
        needToConfirm = true;
        var progressBar = document.getElementById("myBar");
        var image_type = $(this).data('file');
        var image = '';

        var elem = $(".pBar");
        var myFileList = document.getElementById('uploadFile').files;
        if(typeof myFileList[0] === 'undefined' || !myFileList[0]){
            alert('Please select a file!');
            return false;
        }
        var myFile = myFileList[0];
        var formData = new FormData();
        formData.append('image', myFile);
        formData.append('pk_key', pk_key);
        // formData.append('image_type', image_type);

        var xhr = new XMLHttpRequest();


        xhr.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                // Typical action to be performed when the document is ready:
                var data = this.responseText;
                var jsonResponse = JSON.parse(data);
                if(jsonResponse.upload_status==1){
                    image=jsonResponse.image;

                    $.ajax({
                        url: base_url + 'ajax/save_mem_images',
                        data : {'image':image,'type':image_type},
                        dataType: 'JSON',
                        method: 'POST',
                        success: function (rs) {
                            if (image_type == 'image')
                                $("#userImage").attr("src", jsonResponse.image_path);
                            else
                                $("#cover-image").css('background-image', 'url(' + jsonResponse.image_path + ')');
                        },
                        complete: function (rs) {
                            needToConfirm = false;
                            progressBar.style.width = '100%';
                            elem.addClass("hidden");
                            if (image_type == 'image')
                                location.reload();

                        }
                    })
                    
                }else{
                    alert('Uploading Error!');
                }
            }
        };

        xhr.upload.onloadstart = function (e) {
            elem.removeClass("hidden");
            progressBar.style.width = '0%';
        }
        xhr.upload.onprogress = function (e) {
            if (e.lengthComputable) {
                var ratio = Math.floor((e.loaded / e.total) * 100) + '%';
                progressBar.style.width = ratio;

            }
        }
        xhr.upload.onloadend = function (e) {
            //progressBar.style.width = '100%';
            //elem.addClass("hidden");
        }
        xhr.open("POST", scontent_url + 'image');
        xhr.send(formData);
    });*/


    $(document).on('click','.uploadFiles .crosBtn',function(){
        $(this).parents('.uploadFiles').find('input[name="thumbnail"]').remove();
        $(this).parent('.image').remove();
    })

    /*** start croppie thumb ***/

/*var $uploadCrop;
$uploadCrop = $('#crope-image').croppie({
    viewport: {
        width: 200,
        height: 200,
        type: 'circle'
    },
    boundary: {
        width: 300,
        height: 300
    }
});

$('#uploadThumb').on('change', function () { 
    if (this.files && this.files[0]) {
        var reader = new FileReader();          
        reader.onload = function (e) {
            $uploadCrop.croppie('bind', {
                url: e.target.result
            });
            $('#thumbPopup').fadeIn();
        }           
        reader.readAsDataURL(this.files[0]);
    }
});

$(document).on('click', '#btnSave', function () {
        // var svBtn=$(this);
        $uploadCrop.croppie('result', {
            type: 'canvas',
            size: 'original'
        }).then(function (resp) {
            $('#thumbPopup').fadeOut();
            $('.miniLoader').removeClass('hidden');
            var myFileList = document.getElementById('uploadThumb').files;
            var formData = new FormData();
            if(typeof myFileList[0] === 'undefined' || !myFileList[0]){
                alert('Please select a file!');
                return false;
            }
            formData.append('image', myFileList[0]);
            formData.append('pk_key', pk_key);
            formData.append('basethumb', resp);
            $.ajax({
                url: scontent_url + 'image',
                data : formData,
                processData: false,
                contentType: false,
                dataType: 'JSON',
                method: 'POST',
                success: function (rs) {
                    if(rs.upload_status==1){
                        $('.uploadFiles').append('<input type="hidden" name="thumbnail" id="thumbnail" value="'+rs.image+'"><div class="image"><img src="'+rs.image_path+'" alt=""><div class="crosBtn">×</div></div>');
                    }
                    else
                        alert('Uploading error!')
                },
                complete: function (rs) {
                    $('.miniLoader').addClass("hidden");
                }
            })
        });
    });
    */
    /*** end croppie thumb ***/

    $(document).on('change', '.uploadFile', function () {
    // $('.miniLoader').removeClass('hidden');
    var myFileList = this.files;
    var formData = new FormData();
    if(typeof myFileList[0] === 'undefined' || !myFileList[0]){
        alert('Please select a file!');
        return false;
    }
    formData.append('image', myFileList[0]);
    formData.append('pk_key', pk_key);
    $.ajax({
        url: scontent_url + 'image',
        data : formData,
        processData: false,
        contentType: false,
        dataType: 'JSON',
        method: 'POST',
        success: function (rs) {
            if(rs.upload_status==1){
                $('.frmAjax>input#image').remove();
                $('.frmAjax').append('<input type="hidden" name="image" id="image" value="'+rs.image+'">');
            }
            else
                alert('Uploading error!')
        },
        complete: function (rs) {
            // $('.miniLoader').addClass("hidden");
        }
    })
});

    /*** multi images ***/
    $(document).on('click','.upLoadBlk .crosBtn',function(){
        $(this).parents('li').find('input[name="hidden"]').remove();
        $(this).parents('li').remove();
    })
    $(document).on('click','#createComic a.delBtn',function(){
        $('.upLoadBlk ul.imgLst').html('');
    })
    $(document).on('change', '#uploadFiles', function () {
        needToConfirm = true;
        var elem = $(".uploadBar");
        var progressBar = $(".uploadBar>span")[0];
        var myFileList = this.files;
        if(typeof myFileList[0] === 'undefined' || !myFileList[0]){
            alert('Please select at least one file!');
            return false;
        }
        var formData = new FormData();
        $.each(myFileList, function(i, file) {
            formData.append('images[]', file);
        });
        formData.append('pk_key', pk_key);

        var xhr = new XMLHttpRequest();

        xhr.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
            // Typical action to be performed when the document is ready:
            var data = this.responseText;
            var rs = JSON.parse(data);
            if(rs.upload_status==1){
                $.each(rs.image,function(i,img){
                    $('ul.imgLst').append(
                        '<li><input type="hidden" name="images[]" value="'+img+'"><div class="image"><img src="'+rs.image_path[i]+'" alt=""><div class="crosBtn">×</div></div></li>'
                        );
                })
            }
            else
                alert('Uploading error!');
        }
    };

    xhr.upload.onloadstart = function (e) {
        elem.removeClass("hidden");
        progressBar.style.width = '0%';
    }
    xhr.upload.onprogress = function (e) {
        if (e.lengthComputable) {
            var ratio = Math.floor((e.loaded / e.total) * 100) + '%';
            progressBar.style.width = ratio;

        }
    }
    xhr.upload.onloadend = function (e) {
        needToConfirm = false;
        progressBar.style.width = '100%';
        elem.addClass("hidden");
    }
    xhr.open("POST", scontent_url + 'images');
    xhr.send(formData);
});

    /*** Attachments ***/

    $(document).on('click', '.attDlt', function(){
        var maintg =$(this).parent('span');
        var id ='#'+maintg.data('store');
        $('.filesAtch').find('input'+id).remove()
        maintg.remove();
        $('textarea[name="msg"]').focus();
    })

    $(document).on('change', '.chatAtt', function () {
        needToConfirm = true;
        sndMsg=false;

        var myFileList = this.files;
        var pst=$(this).data('store');
        $.each(myFileList, function(i, file) {
            var att_name=Math.floor(Math.random() * 6)
            console.log(att_name);
            $('.filesAtch').append('<span data-id="'+file.name.replace('.','')+'">'+file.name+'<i class="fi-cross-circle attDlt"></i><em></em></span>');
        })
        $('form#frmChat textarea[name="msg"]').focus();
        $('form#frmChat button[type="submit"]').attr('disabled',true);

        $.each(myFileList, function(i, file) {
            var file_view=$('.filesAtch>span[data-id="'+file.name.replace('.','')+'"]');
            var progressBar=file_view.find('em')[0];
            var formData = new FormData();
            formData.append('attach', file);
        // formData.append('pk_key', pk_key);
        var xhr = new XMLHttpRequest();

        xhr.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                var data = this.responseText;
                var rs = JSON.parse(data);
                if(rs.upload_status==1){
                    if((typeof pst !== 'undefined') && pst=='pst'){
                        $('.filesAtch>span, .filesAtch>input').not(file_view).remove();
                        $('.filesAtch').append('<input type="hidden" name="attach" value="'+rs.attach+'" id="'+rs.file_name+'">');
                    }
                    else{
                        $('.filesAtch').append('<input type="hidden" name="attachs[]" value="'+rs.attach+'" id="'+rs.file_name+'">');
                    }
                    file_view.data('store',rs.file_name);
                    file_view.removeAttr('data-id');
                }
                else
                    file_view.addClass('fail').text('Uploading Fail')

                $('form#frmChat button[type="submit"]').attr('disabled',false)
            }
        };

        xhr.upload.onloadstart = function (e) {
            progressBar.style.width = '0%';
        }
        xhr.upload.onprogress = function (e) {
            if (e.lengthComputable) {
                var ratio = Math.floor((e.loaded / e.total) * 100) + '%';
                progressBar.style.width = ratio;

            }
        }
        xhr.upload.onloadend = function (e) {
            progressBar.style.width = '100%';
        }
        xhr.open("POST", base_url + 'upload-attachment');
        xhr.send(formData);
    });
        needToConfirm = false;
        sndMsg=true;
    });

    $(document).on('click','.heart>a.lkBtn,.like>a.lkBtn',function(){
        var btn=$(this);
        if (btn.data("disabled")) {
            return false;
        }
        btn.data("disabled", "disabled");
        $.ajax({
            url: base_url+'favorite',
            data : {'store':btn.data('store')},
            dataType: 'JSON',
            method: 'POST',
            success: function (rs) {
                btn.html(rs.data);
                btn.removeData("disabled");
                rs.active==0?btn.removeClass('active'):btn.addClass('active');
            // btn.hasClass('active')?btn.removeClass('active'):btn.addClass('active');
        },
        error: function (rs) {
            console.log(rs);
        },
        complete: function (rs) {
            btn.removeData("disabled");
        }
    })
    })



    /*$(document).on("rateyo.set",'#rating',function(e, data){
        needToConfirm = true;
        var rating = data.rating;
        var store=$(this).data('store');
        $(this).next('span').html('(You rated this)');
        $(this).removeAttr('id');
        $(this).rateYo("option", "readOnly", true);

        $.ajax({
            url: base_url+'rate',
            data : {'store':store,'rating':rating},
            dataType: 'JSON',
            method: 'POST',
            success: function (rs) {
                console.log(rs.status?'':'Pohnch to gy ho pr abi itny bry ni hoay...');
            },
            complete: function (rs) {
                needToConfirm = false;
            }
        })
    })*/

    $(document).on('click','a.subscibeBtn',function(){
        var btn=$(this);
        if (btn.data("disabled")) {
            return false;
        }
        btn.data("disabled", "disabled");
        $.ajax({
            url: base_url+'subscribe',
            data : {'store':btn.data('store'),'page':btn.data('page')},
            dataType: 'JSON',
            method: 'POST',
            success: function (rs) {
                btn.html(rs.data);
            },
            complete: function () {
                btn.removeData("disabled");
            }
        })
    })
    $(document).on('click','.followBtn>a.webBtn',function(){
        var btn=$(this);
        if (btn.data("disabled")) {
            return false;
        }
        btn.data("disabled", "disabled");
        $.ajax({
            url: base_url+'ajax/follow',
            data : {'store':btn.data('store')},
            dataType: 'JSON',
            method: 'POST',
            success: function (rs) {
                btn.html(rs.data);
            },
            complete: function () {
                btn.removeData("disabled");
            }
        })
    })


    $( ".autocomplete[data-from]" ).autocomplete({
        source: function (request, response) {
            var serach_from=$(".autocomplete").data('from');
            $.ajax({
              method: "POST",
              url: base_url+'/'+serach_from,
              data: {'query':request.term,},
              dataType: 'json',
              success: function( data ){
                response(data);
            }
        })
        },
        select: function(event, ui)
        {
            // console.log(ui);
            // $('#city_id').val(ui.item.id);
        },
        change: function (event, ui) {
            /*if(!ui.item){
                $(event.target).val("");
            }*/
        }, 
        focus: function (event, ui) {
            return false;
        },
        messages: {
            noResults: '',
            results: function() {}
        },
        minLength:3,
        autoFocus:true
    });

});

function refresh_rateYo(){
    $('.rateYo').rateYo({
        fullStar: true,
        normalFill: '#ddd',
        ratedFill: '#f6a623',
        starWidth: '14px',
        spacing: '2px'
    });
}
function refresh_selectpicker(){
    $('.selectpicker').selectpicker('refresh');
}
function refresh_datepicker(){
    $('.datepicker').datepicker('update','');
}
function refresh_timepicker(){
    // $('.timepicker').timepicki('refresh');
    $('.timepicker').timepicki({
        reset: true,
        step_size_minutes: 15,
        overflow_minutes:true,
        start_time: ["12", "00", "AM"],
        disable_keyboard_mobile: true
    });
}
function shareLinkedin(url, title) {
    window.open('https://www.linkedin.com/shareArticle?mini=true&url=' + url + '&title=' + title, 'sharer', 'toolbar=0,status=0,width=548,height=325,top=170,left=400');
}
function shareFacebook(url, title) {
    window.open('http://www.facebook.com/sharer/sharer.php?u=' + url + '&t=' + title, 'sharer', 'toolbar=0,status=0,width=548,height=325,top=170,left=400');
    s}
    function shareTwitter(url, title) {
        window.open('https://twitter.com/home?status=' + title + ' ' + url + '', 'sharer', 'toolbar=0,status=0,width=548,height=325,top=170,left=400');
    }
    function shareGoogle(url, title) {
        window.open('https://plus.google.com/share?url=' + url + '&title=' + title, 'sharer', 'toolbar=0,status=0,width=548,height=325,top=170,left=400');
    }
    function sharePinterest(url, image, title) {
        window.open('https://pinterest.com/pin/create/button/?url=' + url + '&media=' + image + '&description=' + title, 'sharer', 'toolbar=0,status=0,width=548,height=325,top=170,left=400');
    }
    function shareWhatsapp(title) {
        document.location = 'whatsapp://send?text=' + title;
    }