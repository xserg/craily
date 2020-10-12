var formatter = new Intl.NumberFormat('en-US', {
  style: 'currency',
  currency: 'USD',
  minimumFractionDigits: 2,
});

// formatter.format(2500);
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
	$('body').on('click', '.add_new_card', function() {
		$('#add_new_card').modal('show');
	});
	$('body').on('change', '#payment_method', function() {
		if ($(this).val() == "#add_new_card") {
			$('#add_new_card').modal('show');
		}
	});

	$('body').on('click', '.service_details', function() {
		$('#service_details').modal('show');
	});

    $('#is_currently_work').change(function() {
        $('.to-section').show();
        if (this.checked) {
            $('.to-section').hide();
        }
    })

    /*$('.frmAjax').validate({ 
        errorPlacement: function(){
            return false;  // suppresses error message text
        }
    });*/

    
    //if((typeof recaptcha !== 'undefined') && recaptcha){
        $('#passwar').keyup(function(event) {
            /* Act on the event */
            var val = $(this).val();
            if(val.length <= 7) {
                $('#passMsg').removeClass('hide');
                $('#passMsg').html('<p style="color: red;">Password must be at least 8 characters</p>');
            } else {
                $('#passMsg').addClass('hide');
                $('#passMsg').html('');
            }
        });

        var frmAjax='';
        $(document).on('click','.frmAjax button[type="submit"]',function(e){
            e.preventDefault();
            frmAjax=$(this).parents('.frmAjax');
            if(frmAjax.valid()){
                frmAjax.submit();
                /*if($("#g-recaptcha-response").val()){
                    frmAjax.submit();
                }
                else
                    grecaptcha.execute();*/
            } else {
                if($('#passwar').hasClass('error')) {
                    $('#passMsg').removeClass('hide');
                    $('#passMsg').html('<p style="color: red;">Password must be at least 8 characters</p>');
                } else {
                    $('#passMsg').addClass('hide');
                    $('#passMsg').html('');
                }
            }
        })
        /*onSubmit=function (token) {
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
    }*/
    /*function stripeResponseHandler(status, response) {
        if (response.error) {
            $('.error')
                .removeClass('hide')
                .find('.alert')
                .text(response.error.message);
        } else {
            var token = response['id'];
            $('#stripeToken').val( token );
            $('#nextBtn').prop("disabled", false);
            $('#btnpay').prop("disabled", true);
            if(token != '') {
                alert('Your payment is submitted successfully.');
            }
            //$form.get(0).submit();
        }
    }*/
    /*$('#btnpay').click(function(e) {
        //Stripe start
        var $form    = $(".frmAjax"),
        inputSelector = ['input[type=email]', 'input[type=password]',
                         'input[type=text]', 'input[type=file]',
                         'textarea'].join(', '),
        $inputs       = $form.find('.required').find(inputSelector),
        $errorMessage = $form.find('div.error'),
        valid         = true;
        $errorMessage.addClass('hide');

        $('.has-error').removeClass('has-error');
        $inputs.each(function(i, el) {
          var $input = $(el);
          if ($input.val() === '') {
            $input.parent().addClass('has-error');
            $errorMessage.removeClass('hide');
            e.preventDefault();
          }
        });

        if (!$form.data('cc-on-file')) {
          e.preventDefault();
          Stripe.setPublishableKey($('#frmSignup_tutor').attr('data-stripe-publishable-key'));
          Stripe.createToken({
            number: $('.card-number').val(),
            cvc: $('.card-cvc').val(),
            exp_month: $('.card-expiry-month').val(),
            exp_year: $('.card-expiry-year').val()
          }, stripeResponseHandler);
        }
    });*/

    $(document).on('submit','.frmAjax',function(e) {
        e.preventDefault();
        $('#txtSubmit').trigger('click');
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
               
            },
            success: function (rs) {
                
                frmMsg.html(rs.msg).slideDown(500);
                if(rs.scroll_to_msg)
                    $('html, body').animate({ scrollTop: frmMsg.offset().top-300}, 'slow');
                if (rs.status == 1) {
                    setTimeout(function () {
                        if(rs.frm_reset){
                            frm.reset();
                            /*if((typeof recaptcha !== 'undefined') && recaptcha)
                                grecaptcha.reset();*/
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
					//alert('asa');
                    setTimeout(function () {
						//alert('asa1');
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
    $('.timepicker').timepicki('refresh');
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



if (window.location.pathname == "/tutor-multi-signup" || window.location.pathname == "/crainly/tutor-multi-signup")
{
    

    var currentTab = 0; // Current tab is set to be the first tab (0)
    showTab(currentTab); // Display the current tab

    function showTab(n) {
        // This function will display the specified tab of the form...
        var x = document.getElementsByClassName("tab");
        lengthx = x.length - 1;
        console.log(lengthx);
        x[n].style.display = "block";
        //... and fix the Previous/Next buttons:
        if (n == 0) {
            setInterval(function(){
                if($('.checkbox_card:checked').length > 0) {
                    $('.span_error').text('');
                    $('#nextBtn').show();
                } else {
                    $('.span_error').text('Please select at least one subject.');
                    $('#nextBtn').hide();
                }
            }, 1500);
            document.getElementById("prevBtn").style.display = "none";
        } else {
            document.getElementById("prevBtn").style.display = "inline";
        }
        if (n == (lengthx) - 1) {
            $('#nextBtn').addClass('nxt');
        }
        if (n == (lengthx)) {
            document.getElementById("nextBtn").innerHTML = "Submit";
            // $('#nextBtn').attr('type', 'submit');
            //$('#nextBtn').prop("disabled", true);
        } else {
            $('#nextBtn').prop("disabled", false);
            document.getElementById("nextBtn").innerHTML = "Next";
        }
        //... and run a function that will display the correct step indicator:
        fixStepIndicator(n)
    }

    function nextPrev(n) {
        // This function will figure out which tab to display
        var x = document.getElementsByClassName("tab");
        // Exit the function if any field in the current tab is invalid:
        if (n == 1 && !validateForm()) return false;
        // Hide the current tab:
        x[currentTab].style.display = "none";
        // Increase or decrease the current tab by 1:
        currentTab = currentTab + n;
        // if you have reached the end of the form...
        if (currentTab >= x.length) {
            // ... the form gets submitted:
            document.getElementById("frmSignup_tutor").submit();
            return false;
        }
        // Otherwise, display the correct tab:
        showTab(currentTab);
    }

    
    function IsEmail(email) {
        var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if(!regex.test(email)) {
            return false;
        }else{
            return true;
        }
    }

    function validatePhone(txtPhone) {
        var filter = /^((\+[1-9]{1,4}[ \-]*)|(\([0-9]{2,3}\)[ \-]*)|([0-9]{2,4})[ \-]*)*?[0-9]{3,4}?[ \-]*[0-9]{3,4}?$/;
        if (filter.test(txtPhone)) {
            return true;
        }
        else {
            return false;
        }
    }

    function validateForm() {
        // This function deals with validation of the form fields
        var x, y, i, valid = true;
        x = document.getElementsByClassName("tab");
        y = x[currentTab].getElementsByTagName("input");
        
        // A loop that checks every input field in the current tab:
        for (i = 0; i < y.length; i++) {
            // If a field is empty...
            if(y[i].type.toLowerCase() == 'text') {
                if(y[i].name == "phone") {
                    if(validatePhone(y[i].value) == false) { 
                        $('.phone_error').html('Please enter valid US phone number');
                        // add an "invalid" class to the field:
                        y[i].className += " invalid";
                        // and set the current valid status to false
                        valid = false;
                    } else {
                        $('.phone_error').html('');
                        $('#phone').removeClass('invalid');
                    }
                }

                if(y[i].name == "college") {
                    if (y[i].value == "") {
                        $('.college_error').html('This field is required');
                        // add an "invalid" class to the field:
                        y[i].className += " invalid";
                        // and set the current valid status to false
                        valid = false;
                    } else {
                        $('.college_error').html('');
                        $('#txtCollege').removeClass('invalid');
                    }
                }

                if(y[i].name == "major") {
                    if (y[i].value == "") {
                        $('.major_error').html('This field is required');
                        // add an "invalid" class to the field:
                        y[i].className += " invalid";
                        // and set the current valid status to false
                        valid = false;
                    } else {
                        $('.major_error').html('');
                        $('#txtMajor').removeClass('invalid');
                    }
                }

                if(y[i].name == "grad_year") {
                    if (y[i].value == "") {
                        $('.grad_year_error').html('This field is required');
                        // add an "invalid" class to the field:
                        y[i].className += " invalid";
                        // and set the current valid status to false
                        valid = false;
                    } else if(/^(\d{4})$/.test(y[i].value) == false) {
                        $('.grad_year_error').html('Must be four digit');
                        // add an "invalid" class to the field:
                        y[i].className += " invalid";
                        // and set the current valid status to false
                        valid = false;
                    } else if(/^(\d{4})$/.test(y[i].value) == false) {
                        $('.grad_year_error').html('Must be four digit');
                        // add an "invalid" class to the field:
                        y[i].className += " invalid";
                        // and set the current valid status to false
                        valid = false;
                    } else {
                        $('.grad_year_error').html('');
                        $('#txtGradYear').removeClass('invalid');
                    }
                }
                
                if(y[i].name == "travel_radius") {
                    var float= /^\s*(\+|-)?((\d+(\.\d+)?)|(\.\d+))\s*$/;
                    if (float.test(y[i].value)) {
                        $('.travel_radius_error').html('');
                        $('#txtTravelRadius').removeClass('invalid');
                        
                    } else {
                        $('.travel_radius_error').html('This field should be a radius.');
                        // add an "invalid" class to the field:
                        y[i].className += " invalid";
                        // and set the current valid status to false
                        valid = false;
                    } 
                    if(y[i].value == "") {
                        $('.travel_radius_error').html('This field is required');
                        // add an "invalid" class to the field:
                        y[i].className += " invalid";
                        // and set the current valid status to false
                        valid = false;
                    }
                }

                

                if(y[i].name == "fname") {
                    if (y[i].value == "") {
                        $('.fname_error').html('This field is required');
                        // add an "invalid" class to the field:
                        y[i].className += " invalid";
                        // and set the current valid status to false
                        valid = false;
                    } else {
                        $('.fname_error').html('');
                        $('#fname').removeClass('invalid');
                    }
                }

                if(y[i].name == "profile_headline") {
                    if (y[i].value == "") {
                        $('.profile_headline_error').html('This field is required');
                        // add an "invalid" class to the field:
                        y[i].className += " invalid";
                        // and set the current valid status to false
                        valid = false;
                    } else {
                        $('.profile_headline_error').html('');
                        $('#txtProfileHeadline').removeClass('invalid');
                    }
                }

                if(y[i].name == "lname") {
                    if (y[i].value == "") {
                        $('.lname_error').html('This field is required');
                        // add an "invalid" class to the field:
                        y[i].className += " invalid";
                        // and set the current valid status to false
                        valid = false;
                    } else {
                        $('.lname_error').html('');
                        $('#lname').removeClass('invalid');
                    }
                }

                if (y[i].value == "" && y[i].name != "address2") {
                    // add an "invalid" class to the field:
                    y[i].className += " invalid";                   
                    // and set the current valid status to false
                    valid = false;
                }
            }

            

            if(y[i].type.toLowerCase() == 'password') {
                if(y[i].value.length <= 7) { 
                    $('.password_error').html('Password min 8 character');
                    // add an "invalid" class to the field:
                    y[i].className += " invalid";
                    // and set the current valid status to false
                    valid = false;
                } else {
                    $('.password_error').html('');
                    $('#password').removeClass('invalid');
                }

                if (y[i].value == "") {
                    // add an "invalid" class to the field:
                    y[i].className += " invalid";                   
                    // and set the current valid status to false
                    valid = false;
                }
            }

            if(y[i].type.toLowerCase() == 'email') {

                if (y[i].value == "" || IsEmail(y[i].value) == false) {
                    // add an "invalid" class to the field:
                    y[i].className += " invalid";
                    $('.email_error').html('Email is not valid');
                    // and set the current valid status to false
                    valid = false;
                } else {
                    $('.email_error').html('');
                    $('#email').removeClass('invalid');
                }
            }
            if(y[i].type.toLowerCase() == 'number') {
                console.log(y[i].name);
                if(y[i].name == 'hourly_rate') {
                    if (y[i].value == "") {
                         y[i].className += " invalid";
                        // and set the current valid status to false
                        valid = false;
                        $('.hourly_rate_error').html('Should not be empty');
                    }
                    else if (y[i].value < 20){
                        y[i].className += " invalid";
                        valid = false;
                        $('.hourly_rate_error').html('Should be greater than or equal to 20');
                    } else if(y[i].value > 500){
                        y[i].className += " invalid";
                        // and set the current valid status to false
                        valid = false;
                        $('.hourly_rate_error').html('Should be Less than or equal to 500');
                    } else if(isFloat(y[i].value)==true)
                    {
                        y[i].className += " invalid";
                        // and set the current valid status to false
                        valid = false;
                        $('.hourly_rate_error').html('Should be integer value'); 
                    }
                   else {
                        $('.hourly_rate_error').html('');
                        $('#txtHourlyRate').removeClass('invalid');
                    }
                }
            }

        }
        if(currentTab == 1){
            // if($("input[name='state']").val() == '' || $("input[name='city']").val() == '') {
            //     $('.address_error').html('Must enter city and state');
            //     $("input[name='address']").addClass("invalid");
            //     valid = false;
            // }
            // else{
            //     $('.address_error').html('');
            //     $("input[name='address']").removeClass("invalid");
            // }
        }

        // If the valid status is true, mark the step as finished and valid:
        //if (valid) {
            //document.getElementsByClassName("step")[currentTab].className += " finish";
        //}
        if(currentTab == 2){
            // var len = $("#textareaBio").val().length;
            // if(len < 500) {
            //     $('.bio_error').html('Bio can not be less than 500 characters.');
            //     // add an "invalid" class to the field:
            //     $("#textareaBio").addClass("invalid");
            //     // and set the current valid status to false
            //     valid = false;
            // }
        }
        return valid; // return the valid status
    }
function isFloat(x) { return !!(x % 1); }
    function fixStepIndicator(n) {
        // This function removes the "active" class of all steps...
        var i, x = document.getElementsByClassName("step");
        for (i = 0; i < x.length; i++) {
            x[i].className = x[i].className.replace(" active", "");
        }
        //... and adds the "active" class on the current step:
        x[n].className += " active";
    }
}

$('#txtGradYear').keyup(function () {
    this.value = this.value.replace(/[^0-9\.]/g,'');
});

$('.collapse').on('shown.bs.collapse', function(){
    $(this).parent().find(".glyphicon-plus").removeClass("glyphicon-plus").addClass("glyphicon-minus");
}).on('hidden.bs.collapse', function(){
    $(this).parent().find(".glyphicon-minus").removeClass("glyphicon-minus").addClass("glyphicon-plus");
});

$('.nxt').click(function(event) {
    /* Act on the event */
    console.log($('#frmSignup_tutor').serialize());
});

//checkbox event
$('input[type="checkbox"]').change(function() {
    //alert ("The element with id " + this.name + " changed.");

    if ($(this).is(':checked') == true) {
        var name = $('.checkSelect').text();
        var val = $(this).parent(".checkbox-inline").text().replace('[]', '');
        var this_name = this.name.replace('[]', '');
        var cate_name = $(this).data("category");
        var str = $('.checkSelect').text();

        if(name == 'None Selected') {            
            if (str.indexOf(cate_name) == -1)
            {
                $('.checkSelect').html('<b>'+cate_name+'</b>: ');
                $('.checkSelect').append('<span class="'+this_name+'">'+val+'</span>');
            }
            else {
                $('.'+this_name+':last').after(', <span class="'+this_name+'">'+val+'</span>');
            }  
        }
        else {
            if (str.indexOf(cate_name) == -1)
            {
                $('.checkSelect').append('<br><b>'+cate_name+'</b>: ');
                $('.checkSelect').append('<span class="'+this_name+'">'+val+'</span>');
            }
            else {
                $('.'+this_name+':last').after(', <span class="'+this_name+'">'+val+'</span>');
            }
        }
    } 

    if ($(this).is(':checked') == false) {
        var val = $(this).val().replace('_', ' ');
        var str = $('.checkSelect').html();

        if(str) {
            if( str.indexOf(val) != -1 ) {
                newText = str.split(val);
                var link = newText[0];
                var date = newText[1];
                $('.checkSelect').html(link + date);
            }
        }
    }
});


// This sample uses the Autocomplete widget to help the user select a
// place, then it retrieves the address components associated with that
// place, and then it populates the form fields with those details.
// This sample requires the Places library. Include the libraries=places
// parameter when you first load the API. For example:
// <script
// src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

var placeSearch, autocomplete;

var componentForm = {
  street_number: 'short_name',
  route: 'long_name',
  locality: 'long_name',
  administrative_area_level_1: 'short_name',
  country: 'long_name',
  postal_code: 'short_name'
};

function initAutocomplete() {
  // Create the autocomplete object, restricting the search predictions to
  // geographical location types.
  autocomplete = new google.maps.places.Autocomplete(
      document.getElementById('autocomplete'), {types: ['geocode']});

  // Avoid paying for data that you don't need by restricting the set of
  // place fields that are returned to just the address components.
  autocomplete.setFields(['address_component']);

  // When the user selects an address from the drop-down, populate the
  // address fields in the form.
  autocomplete.addListener('place_changed', fillInAddress);
}

function fillInAddress() {
  // Get the place details from the autocomplete object.
  var place = autocomplete.getPlace();

  // Get each component of the address from the place details,
  // and then fill-in the corresponding field on the form.
  var addressFound = false;
    if (place.address_components)
    {
        for (var i = 0; i < place.address_components.length; i++) {
            var addressType = place.address_components[i].types[0];
            var componentForm = {
                street_number: 'short_name',
                route: 'long_name',
                locality: 'long_name',
                administrative_area_level_1: 'short_name',
                country: 'long_name',
                postal_code: 'short_name'
            };
            if (componentForm[addressType]) {
                var val = place.address_components[i][componentForm[addressType]];
				
				if(addressType =='route')
				{
					addressFound = true;
					document.getElementById('autocomplete').value = val;
				}
				
				if(addressType =='postal_code')
				{
				
					 document.getElementById('zip').value = val;
				}
				if(addressType =='administrative_area_level_1')
				{
				
					 document.getElementById('state').value = val;
				}
				if(addressType =='locality')
				{
				
					document.getElementById('city').value = val;
				}
               
            }
        }
		if(!addressFound)
		{
			document.getElementById('autocomplete').value = '';
		}
    }
}

// Bias the autocomplete object to the user's geographical location,
// as supplied by the browser's 'navigator.geolocation' object.
function geolocate() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
      var geolocation = {
        lat: position.coords.latitude,
        lng: position.coords.longitude
      };
        $('#txtLongitude').val(position.coords.longitude);
        $('#txtLatitude').val(position.coords.latitude);
      var circle = new google.maps.Circle(
          {center: geolocation, radius: position.coords.accuracy});
      autocomplete.setBounds(circle.getBounds());
    });
  }
}

//promo code js
$(document).on('click','.text-head', function(e)
{
	$('.promo_code').slideToggle( "slow" );
});

$(document).on('click','.tutor-card',function(e){
    var href=$(this).data('href');
    location.href = href;
});

function clickcheckbox(subjectids,subsujectid,subjecname){
	
	if($('#sub'+subsujectid).is(":checked"))
	{
		var selectedsubsubject = $('.collapse'+subjectids+' .subjects-count').text();
		var finalvalue  = +selectedsubsubject + +1;
		
		$('.collapse'+subjectids+' .subjects-count').text(finalvalue);
		if(finalvalue == 1)
		{
			$('.collapse'+subjectids).addClass('active');
		}
		if(finalvalue > 0)
		{
			$('.collapse'+subjectids+' .subjects-count').show();
		}
		else
		{
			$('.collapse'+subjectids+' .subjects-count').hide();
		}
		
		$('.selected-subjects-list').append('<li class="subject-list-'+subsujectid+'"><a href="javascript:;" onclick="return removesubjectlist('+subsujectid+')">'+subjecname+' <img src="assets/images/cancel-active.svg" alt=""></a></li>');
	}
	else if($('#sub'+subsujectid). is(":not(:checked)")){
		
		var selectedsubsubject = $('.collapse'+subjectids+' .subjects-count').text();
		var finalvalue  = selectedsubsubject - 1;
		$('.collapse'+subjectids+' .subjects-count').text(finalvalue);
		if(finalvalue < 1)
		{
			$('.collapse'+subjectids).removeClass('active');
		}
		if(finalvalue > 0)
		{
			$('.collapse'+subjectids+' .subjects-count').show();
		}
		else
		{
			$('.collapse'+subjectids+' .subjects-count').hide();
		}
		$('.subject-list-'+subsujectid).hide();
	}
}
function removesubjectlist(subjectids)
{
	$('.subject-list-'+subjectids).hide();
	$('#sub'+subjectids).trigger('click');
}

function addEductionDetails(allowEditDelete = false){
    var mode = $('#mode').val();
    var editIndex = $('#editIndex').val();
    $('.form-group').removeClass('input-error');

    var educationArr = {
        college: $('#university').val(),
        degree: $('#degree').val(),
        studyField: $('#studyField').val(),
        fromYear: $('#fromYear').val(),
        toYear: $('#toYear').val(),
        addmorecount: $('#addmorecount').val()
    };
    
    let isValid = true;
    if( educationArr['college'].trim() == "" ) {
        $('#university').parent().addClass('input-error');
        isValid = false;
    }
    if( educationArr['fromYear'].trim() == "" ) {
        $('#fromYear').parent().addClass('input-error');
        isValid = false;
    }
    if( educationArr['toYear'].trim() == "" ) {
        $('#toYear').parent().addClass('input-error');
        isValid = false;
    }

    if ( !isValid ) {
        return false;
    }

    let education = $('#education').val();
    if ( education == '' ) {
        education = [];
    } else {
        education = JSON.parse($('#education').val());
    }

    if ( mode == 'edit' ) {
        education[editIndex] = educationArr;
    } else {
        education.push(educationArr);
    }
    educationHtml(education, allowEditDelete);

    setTimeout(() => {
        $('#university').val('');
        $('#degree').val('');
        $('#studyField').val('');
        $('#fromYear').val('');
        $('#toYear').val('');
    }, 20);

    $('.close').trigger('click');
}

function educationHtml(education, allowEditDelete = false) {
    var educationHtml = '';
    if ( education.length > 0 ) {
        education.forEach(function(edu, i) {
            educationHtml += '<div class="added-item">';
                educationHtml += '<div class="added-item-thumb">';
                    educationHtml += '<img src="assets/images/education.svg" alt="">';
                educationHtml += '</div>';
                educationHtml += '<div class="added-item-content">';
                    educationHtml += '<h3 class="added-item-title">'+edu.college+' <span>('+edu.fromYear+' - '+edu.toYear+')</span></h3>';
                    educationHtml += '<p class="added-item-des">'+edu.degree+' with '+edu.studyField+'</p>';
                    if ( allowEditDelete ) {
                        educationHtml += '<p class="added-item-des"><a href="" style="margin-right: 10px;" data-toggle="modal" data-target="#educationModal" class="editEducation" data-id="'+i+'">Edit</a><a href="javascript:void(0);" class="deleteEducation" data-id="'+i+'">Delete</a></p>';   
                    }
                educationHtml += '</div>';
            educationHtml += '</div>';
        });
    }
    $('#educationItem').html(educationHtml);
    $('#education').val(JSON.stringify(education));
    if ( education.length >= 3 ) {
        $('#addMore').hide();
    } else {
        $('#addMore').show();
    }
}

function addWorkExperience(allowEditDelete = false){
    var mode = $('#mode').val();
    var editIndex = $('#editIndex').val();
    $('.form-group').removeClass('input-error');

    var workExperience = {
        name: $('#name').val(),
        title: $('#title').val(),
        fromYear: $('#fromYearEx').val(),
        fromMonth: $('#fromMonth').val(),
        is_currently_work: $('#is_currently_work').prop("checked"),
        toYear: $('#toYearExp').val(),
        toMonth: $('#toMonth').val(),
        description: $('#description').val()
    };
    
    let isValid = true;
    if( workExperience['name'].trim() == "" ) {
        $('#name').parent().addClass('input-error');
        isValid = false;
    }
    if( workExperience['title'].trim() == "" ) {
        $('#title').parent().addClass('input-error');
        isValid = false;
    }
    if( workExperience['fromYear'] == null ) {
        $('#fromYearEx').parent().addClass('input-error');
        isValid = false;
    }
    if( workExperience['fromMonth'] == null ) {
        $('#fromMonth').parent().addClass('input-error');
        isValid = false;
    }
    var allowAddMore = false;
    if ( !workExperience['is_currently_work'] ) {
        if( workExperience['toYear'] == null ) {
            $('#toYearExp').parent().addClass('input-error');
            isValid = false;
        }
        if( workExperience['toMonth'] == null ) {
            $('#toMonth').parent().addClass('input-error');
            isValid = false;
        }
        allowAddMore = true;
    }
    if( workExperience['description'].trim() == "" ) {
        $('#description').parent().addClass('input-error');
        isValid = false;
    }

    if ( !isValid ) {
        return false;
    }

    let workExperiences = $('#workExperiences').val();
    if ( workExperiences == '' ) {
        workExperiences = [];
    } else {
        workExperiences = JSON.parse($('#workExperiences').val());
    }

    if ( mode == 'edit' ) {
        workExperiences[editIndex] = workExperience;
    } else {
        workExperiences.push(workExperience);
    }
    workExperienceHtml(workExperiences, allowAddMore, allowEditDelete);

    $('#name').val('');
    $('#title').val('');
    $('#fromYear').val('');
    $('#fromMonth').val('');
    $('#toYear').val('');
    $('#toMonth').val('');
    $('#description').val('');

    $('.close').trigger('click');
}

function workExperienceHtml(workExperiences, allowAddMore = true, allowEditDelete = false) {
    var workExperienceHtml = '';
    if ( workExperiences.length > 0 ) {
        workExperiences.forEach(function(experience, i) {
            workExperienceHtml += '<div class="added-item">';
                workExperienceHtml += '<div class="added-item-thumb">';
                    workExperienceHtml += '<img src="assets/images/work_experience.svg" alt="">';
                workExperienceHtml += '</div>';
                workExperienceHtml += '<div class="added-item-content">';
                    workExperienceHtml += '<h3 class="added-item-title">'+experience.title+' <span>('+experience.fromMonth+' '+experience.fromYear+' - '+(!experience.is_currently_work ? experience.toMonth+' '+experience.toYear : 'Present')+')</span></h3>';
                    workExperienceHtml += '<p class="added-item-des">'+experience.name+'</p>';
                    if ( allowEditDelete ) {
                        workExperienceHtml += '<p class="added-item-des"><a href="" style="margin-right: 10px;" data-toggle="modal" data-target="#workexperienceModal" class="editExperience" data-id="'+i+'">Edit</a><a href="javascript:void(0);" class="deleteExperience" data-id="'+i+'">Delete</a></p>';   
                    }
                workExperienceHtml += '</div>';
            workExperienceHtml += '</div>';
        });
    }
    $('#workExperienceItem').html(workExperienceHtml);
    $('#workExperiences').val(JSON.stringify(workExperiences));

    if ( workExperiences.length >= 3 ) {
        $('#addMoreExp').hide();
    } else {
        if ( allowAddMore ) {
            $('#addMoreExp').show();
        } else {
            $('#addMoreExp').hide();
        }
    }
}
