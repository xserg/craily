<!doctype html>
<html>

<head>
    <title>Messages - <?= $site_settings->site_name ?></title>
    <?php $this->load->view('includes/site-master'); ?>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAmqmsf3pVEVUoGAmwerePWzjUClvYUtwM&libraries=places"></script>
</head>

<body id="home-page">
    <?php $this->load->view('includes/header'); ?>


    <main>


        <section id="messages">
            <div class="contain-fluid">
                <div class="flexRow flex">
                    <div class="col col1">
                        <div class="barBlk relative">
                            <div class="srchMsngr">
                                <input type="text" id="srchFrnd" placeholder="Search" class="txtBox">
                                <button type="button"><i class="fi-search"></i></button>
                            </div>
                            <ul class="frnds scrollbar">
                                <?php if (count($msg_header) < 1) : ?>
                                    <li data-chat="">
                                        No chat available
                                    </li>
                                <?php endif ?>
                                <?php foreach ($msg_header as $key => $head_msg) : ?>
                                    <li data-chat="<?= doEncode($head_msg->mem_one == $this->session->mem_id ? $head_msg->mem_two : $head_msg->mem_one) ?>" <?= $sender_row->mem_id == $head_msg->mem_one || $sender_row->mem_id == $head_msg->mem_two ? ' class="active"' : ''; ?>>
                                        <div class="ico"><img src="<?= get_image_src(get_mem_image($head_msg->mem_one == $this->session->mem_id ? $head_msg->mem_two : $head_msg->mem_one), 50, true) ?>" alt=""></div>
                                        <p class="name"><?= get_format_mem_name($head_msg->mem_one == $this->session->mem_id ? $head_msg->mem_two : $head_msg->mem_one) ?></p>
                                        <div class="miiBdge"><?= (!in_array($sender_row->mem_id, array($head_msg->mem_one, $head_msg->mem_two)) && $head_msg->msg_row->status == 'new' && $head_msg->msg_row->sender_id <> $this->session->mem_id) ? '<i class="fi-envelope"></i><span class="dot"></span>' : '' ?></div>
                                    </li>
                                <?php endforeach ?>
                            </ul>
                        </div>
                    </div>

                    <div class="col col2">
                        <div class="chatBlk relative">
                            <div class="chatPerson">
                                <div class="backBtn"><a href="javascript:void(0)"><i class="fi-arrow-left"></i></a></div>
                                <h3><?= ucwords($sender_row->mem_fname . ' ' . $sender_row->mem_lname) ?></h3>
                            </div>
                            <div class="chat active" data-chat="person1">
                                <?php if (count($msgs_rows) < 1) : ?>
                                    <p class="text-center">No message available</p>
                                <?php endif ?>
                                <?php foreach ($msgs_rows as $key => $msg_row) : ?>
                                    <?php if ($msg_row->msg_type == 'lesson') : ?>
                                        <?= $msg_row->lesson->txt ?>
                                        <?php continue ?>
                                    <?php endif ?>
                                    <?php if ($msg_row->sender_id == $this->session->mem_id) : ?>
                                        <div class="buble me">
                                            <div class="ico"><a href="<?= profile_url($mem_data->mem_id, $mem_data->mem_fname . ' ' . $mem_data->mem_lname) ?>"><img src="<?= get_image_src($mem_data->mem_image, 50, true) ?>" alt=""></a></div>
                                            <div class="cntnt">
                                                <div class="time"><?= format_date($msg_row->time, 'h:i a - F d, Y') ?></div>
                                                <?= nl2br($msg_row->msg) ?>
                                                <?php if (count($msg_row->attachments) > 0) : ?>
                                                    <div class="atch">
                                                        <?php foreach ($msg_row->attachments as $index => $attch) : ?>
                                                            <span><a href="<?= SITE_VPATH . 'attachments/' . $attch->attachment ?>" target="_blank"><i class="fi-link"></i> <?= $attch->att_name ?></a></span>
                                                        <?php endforeach ?>
                                                    </div>
                                                <?php endif ?>
                                            </div>
                                        </div>
                                    <?php else : ?>
                                        <div class="buble you">
                                            <div class="ico"><a href="<?= profile_url($sender_row->mem_id, $sender_row->mem_fname . ' ' . $sender_row->mem_lname) ?>"><img src="<?= get_image_src($sender_row->mem_image, 50, true) ?>" alt=""></a></div>
                                            <div class="cntnt">
                                                <div class="time"><?= format_date($msg_row->time, 'h:i a - F d, Y') ?></div>
                                                <?= nl2br($msg_row->msg) ?>
                                                <?php if (count($msg_row->attachments) > 0) : ?>
                                                    <div class="atch">
                                                        <?php foreach ($msg_row->attachments as $index => $attch) : ?>
                                                            <span><a href="<?= SITE_VPATH . 'attachments/' . $attch->attachment ?>" target="_blank"><i class="fi-link"></i> <?= $attch->att_name ?></a></span>
                                                        <?php endforeach ?>
                                                    </div>
                                                <?php endif ?>
                                            </div>
                                        </div>
                                    <?php endif ?>
                                <?php endforeach ?>
                            </div>
                            <div class="write">
                                <form class="relative" id="frmChat">
                                    <div class="filesAtch"></div>
                                    <div class="inBlk">
                                        <textarea class="txtBox scrollbar" name="msg" id="msg" placeholder="Type a message..." onkeypress="textAreaAdjust(this)" autofocus=""></textarea>
                                        <input type="file" id="uploadFile" name="uploadFile" class="uploadFile" data-file="">
                                        <div class="bTn text-right clearfix">
                                            <?php if (!empty($subjects)) : ?>
                                                <button type="button" class="webBtn smBtn popBtn pull-left" data-popup="request-lesson"><?= $this->session->mem_type == 'tutor' ? 'Schedule Lesson' : 'Request Lesson' ?></button>
                                            <?php endif ?>

                                            <button type="button" class="webBtn smBtn uploadAtt" id=""><i class="fi-link"></i></button>
                                            <button type="submit" class="webBtn smBtn colorBtn">Send</button>
                                        </div>
                                    </div>
                                </form>
                                <input type="file" name="attachments[]" class="chatAtt" multiple="multiple">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php if (!empty($subjects)) : ?>
                <div class="popup" data-popup="request-lesson">
                    <div class="tableDv">
                        <div class="tableCell">
                            <div class="contain">
                                <div class="_inner">
                                    <div class="crosBtn"></div>
                                    <h3><?= $this->session->mem_type == 'tutor' ? 'Schedule Lesson' : 'Request Lesson' ?></h3>
                                    <form action="<?= site_url('book-chat-lesson/' . $encoded_id) ?>" method="post" autocomplete="off" id="frmBkLsn">
                                        <div class="row formRow">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-xx-6 txtGrp">
                                                <select name="subject" id="subject" class="txtBox selectpicker" data-live-search="true" title="Select your subject">
                                                    <option value="">Select your subject</option>
                                                    <?php foreach ($subjects as $subject) : ?>
                                                        <option value="<?= $subject->id ?>"><?= str_replace('_', ' ', $subject->name) ?></option>
                                                    <?php endforeach ?>
                                                </select>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-xx-6 txtGrp">
                                                <input type="text" name="date" id="date" class="txtBox datepicker" <?= $not_avail_days == '' ? '' : ' data-date-days-of-week-disabled="' . $not_avail_days . '"' ?> data-date-start-date="0d" placeholder="Date" readonly="">
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-xx-6 txtGrp">
                                                <input type="text" name="time" id="time" class="txtBox timepicker" placeholder="Time">
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-xx-6 txtGrp">
                                                <select name="hours" id="hours" class="txtBox selectpicker" title="How many hours?">
                                                    <option value="" readonly>How many hours?</option>
                                                    <?php for ($i = 0; $i <= 4; $i++) : ?>
                                                        <?php if ($i > 0) : ?>
                                                            <option value="<?= $i ?>"><?= $i . ' ' ?><?= ($i > 1) ? "hours" : "hour" ?></option>
                                                        <?php endif ?>
                                                        <?php if ($i < 4) : ?>
                                                            <option value="<?= $i ?>.5"><?= ($i > 0) ? $i . ' ' : '' ?><?= ($i > 0) ? (($i > 1) ? "hours " : "hour ") : '' ?>30 minutes</option>
                                                        <?php endif ?>
                                                    <?php endfor ?>
                                                </select>
                                                <!-- <input type="text" name="hours" id="hours" class="txtBox" placeholder="How many hours?"> -->
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-xx-6 txtGrp">
                                                <select name="lesson_type" id="lesson_type" class="txtBox selectpicker" title="Lesson type">
                                                    <option value="">Lesson type</option>
                                                    <option value="In Person">In Person</option>
                                                    <option value="Online">Online</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-xx-6 txtGrp">
                                                <input type="text" name="address" id="txtaddress" class="txtBox" placeholder="Address" autocomplete="off" disabled="">
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-xx-12 txtGrp">
                                                <textarea id="detail" name="detail" class="txtBox" style="height: 75px" placeholder="Details (optional)"></textarea>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-xx-12 txtGrp">
                                                <small>*Lesson booking time is in <i><b>America/Los_Angeles</b></i> time that is <i><b>PDT</b></i> time. Kindly book lesson according to this time.</small>
                                                <div>
                                                    <small>Lesson Booking Time:</small>
                                                    <span id="systemTime"></span>
                                                </div>
                                                <div>
                                                    <small>Your Current Time:</small>
                                                    <span id="userTime"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="bTn text-center">
                                            <button type="submit" class="webBtn colorBtn"><?= $this->session->mem_type == 'tutor' ? 'Schedule Lesson' : 'Request Lesson' ?> <i class="fa-spinner hidden"></i></button>
                                        </div>
                                        <div class="alertMsg"></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif ?>
            <div class="popup detail-pupup" data-popup="view-detail">
                <div class="tableDv">
                    <div class="tableCell">
                        <div class="contain">
                            <div class="_inner">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- messages -->


    </main>

    <?php $this->load->view('includes/footer'); ?>
    <script type="text/javascript">
        $(function() {
            $(document).on('click', '.srchMsngr > button[type="button"] > i.fi-cross', function() {
                $(this).attr('class', 'fi-search');
                $('ul.frnds>li').removeClass('hidden');
                $('#srchFrnd').val('');
            })
            $(document).on('input', '#srchFrnd', function() {
                var icon = $('.srchMsngr > button[type="button"] > i');
                var keyword = $(this).val().toLowerCase();
                var count = 0;
                if (keyword.length == 0) {
                    icon.attr('class', 'fi-search')
                    $('ul.frnds>li').removeClass('hidden');
                    return false;
                }
                icon.attr('class', 'fi-cross')
                $('ul.frnds>li>p.name').each(function() {
                    var str = $(this).text().toLowerCase();

                    if (str.indexOf(keyword) >= 0) {
                        $(this).parent('li').removeClass('hidden');
                    } else {
                        $(this).parent('li').addClass('hidden');
                    }
                });
            });
            $('.chat').scrollTop($('.chat').prop("scrollHeight"));
            var store = '<?= $encoded_id ?>';

            <?php if ($is_push == '') : ?>
                window.history.pushState({}, "", base_url + "messages/" + store);
            <?php endif ?>

            $(document).on('submit', '#frmChat', function(e) {
                e.preventDefault();
                if (store == "" || sndMsg == false) {
                    return false;
                }

                var chtBtn = $(this).find("button[type='submit']");
                var chtBx = $(this).find("textarea");
                if (chtBx.val() == '' && $("input[name='attachs[]']").length < 1) {
                    chtBx.focus();
                    return false;
                }
                chtBtn.attr("disabled", true);
                needToConfirm = true;

                var frm = this;
                var frmData = new FormData(frm);
                frmData.append('store', store)
                chtBx.attr("disabled", true);

                $.ajax({
                    url: "<?= site_url('send-msg') ?>",
                    data: frmData,
                    processData: false,
                    contentType: false,
                    dataType: 'JSON',
                    method: 'POST',
                    success: function(data) {
                        console.log(data);
                        if (data.status > 0) {
                            $('.chat>p').remove();
                            $('.chat').append(data.msg);
                            var frnd_order = $('.frnds >li[data-chat="' + store + '"]').index();
                            if (frnd_order > 0) {
                                $(".frnds >li:eq(0)").before($(".frnds >li:eq(" + frnd_order + ")"));
                            }
                            $('.frnds >li[data-chat="' + store + '"]').find('.preview').html(data.sidemsg);
                            $('.frnds >li[data-chat="' + store + '"]').find('.time').html(data.time);

                            $(frm).find("input[name='attachs[]']").remove();
                            frm.reset();
                            $('.uploadFile').val();
                            $('.filesAtch').html('');

                        } else
                            alert(data.msg);
                    },
                    complete: function() {
                        needToConfirm = false;
                        chtBtn.attr("disabled", false);
                        chtBx.attr("disabled", false);
                        chtBx.focus();
                        $('.chat').scrollTop($('.chat').prop("scrollHeight"));
                    }
                })
            })
            $(document).on('change', '#lesson_type', function() {
                var v = $(this).val()
                if (v == 'Online')
                    $('#txtaddress').attr('disabled', true).parent('div').addClass('hidden')
                else
                    $('#txtaddress').attr('disabled', false).parent('div').removeClass('hidden')
            })

            setInterval(() => {
                var defaultTime = new Date().toLocaleString('en-US', {
                    timeZone: 'America/Los_Angeles'
                });
                var date = new Date().toLocaleString('en-US');

                $('#systemTime').text(defaultTime);
                $('#userTime').text(date);
            }, 1000)

            $(document).on('submit', '#frmBkLsn', function(e) {
                e.preventDefault();
                needToConfirm = true;
                var frmbtn = $(this).find("button[type='submit']");
                var frmIcon = $(this).find("button[type='submit'] i.fa-spinner");
                var frmMsg = $(this).find("div.alertMsg:first");
                var frm = this;

                // frmbtn.attr("disabled", true);
                frmMsg.hide();
                frmIcon.removeClass("hidden");
                $.ajax({
                    url: $(this).attr('action'),
                    data: new FormData(frm),
                    processData: false,
                    contentType: false,
                    dataType: 'JSON',
                    method: 'POST',

                    error: function(rs) {
                        console.log(rs);
                    },
                    success: function(rs) {
                        console.log(rs);
                        if (rs.status == 1) {
                            $.ajax({
                                url: base_url + 'send-noti-msg',
                                data: {
                                    'store': store,
                                    'lesson': rs.lesson<?= $this->session->mem_type == 'tutor' ? ",'type':'tt'" : '' ?>
                                },
                                dataType: 'JSON',
                                method: 'POST',
                                success: function(res) {

                                    $('.chat>p').remove();
                                    $('.chat').append(res.msg);
                                    var frnd_order = $('.frnds >li[data-chat="' + store + '"]').index();
                                    if (frnd_order > 0) {
                                        $(".frnds >li:eq(0)").before($(".frnds >li:eq(" + frnd_order + ")"));
                                    }
                                    setTimeout(function() {
                                        frmbtn.attr("disabled", false);
                                        frmIcon.addClass("hidden");
                                        frm.reset();
                                        $('.popup[data-popup= "request-lesson"] .crosBtn').trigger('click');
                                        $('.chat').scrollTop($('.chat').prop("scrollHeight"));
                                    }, 3000);
                                }
                            })
                        } else {
                            frmMsg.html(rs.msg).slideDown(500);
                            if (rs.scroll_to_msg)
                                $('html, body').animate({
                                    scrollTop: frmMsg.offset().top - 300
                                }, 'slow');
                            setTimeout(function() {
                                frmbtn.attr("disabled", false);
                                frmIcon.addClass("hidden");
                            }, 1500);
                        }
                    },
                    complete: function(rs) {
                        needToConfirm = false;
                    }
                });
            });
            <?php if ($this->session->mem_type == 'student' && !empty($subjects)) : ?>
                $(document).on('click', 'div[data-popup="view-detail"] .bkNow', function(e) {
                    e.preventDefault()

                    var btn = $(this);
                    var payment_method = $('#payment_method').val();
                    var promocode = $('#promocode').val();
                    var store = btn.data('store');
                    if (store == '' || payment_method == '')
                        return false;
                    needToConfirm = true;

                    btn.attr("disabled", true);
                    btn.find("i.fa-spinner").removeClass('hidden');
                    $('div[data-popup="view-detail"] .alertMsg:first').html('');
                    $.ajax({
                        url: base_url + '/book-now',
                        data: {
                            'store': store,
                            'payment_method': payment_method,
                            'promocode': promocode,
                            'payment_type': 'saved-card'
                        },
                        dataType: 'JSON',
                        method: 'POST',
                        success: function(rs) {
                            setTimeout(function() {
                                if (rs.status === 1) {
                                    btn.parents('div._inner').append(rs.data);
                                    btn.parents('.svdCards').remove();
                                    $('div[data-popup="view-detail"] .alertMsg:first, div[data-popup="view-detail"] form').remove();
                                } else {
                                    $('div[data-popup="view-detail"] .alertMsg:first').html(rs.msg)
                                    btn.attr("disabled", false);
                                    btn.find("i.fa-spinner").addClass('hidden');
                                }
                            }, 1000)
                        },
                        error: function(rs) {
                            console.log(rs);
                        },
                        complete: function(rs) {
                            needToConfirm = false;
                        }
                    })
                })
                $(document).on('submit', 'div[data-popup="view-detail"] form.frmCreditCard', function(e) {
                    e.preventDefault()
                    var frmbtn = $(this).find("button[type='submit']");
                    var frmIcon = frmbtn.find("i.fa-spinner");
                    var frmMsg = $(this).find("div.alertMsg:first");
                    var frm = this;

                    var store = frmbtn.data('store');
                    if (store == '')
                        return false;
                    needToConfirm = true;

                    frmbtn.attr("disabled", true);
                    frmIcon.removeClass("hidden");
                    frmMsg.html('');

                    var formData = new FormData(frm);
                    formData.append('store', store);
                    $.ajax({
                        url: base_url + '/book-now',
                        data: formData,
                        processData: false,
                        contentType: false,
                        dataType: 'JSON',
                        method: 'POST',
                        success: function(rs) {
                            setTimeout(function() {
                                if (rs.status === 1) {
                                    frmbtn.parents('div._inner').append(rs.data);
                                    frmbtn.parents('.svdCards').remove();
                                    $(frm).remove();
                                } else {
                                    frmMsg.html(rs.msg)
                                    frmbtn.attr("disabled", false);
                                    frmbtn.find("i.fa-spinner").addClass('hidden');
                                }
                            }, 1000)
                        },
                        error: function(rs) {
                            console.log(rs);
                        },
                        complete: function(rs) {
                            needToConfirm = false;
                        }
                    })
                })
                $(document).on('click', 'div[data-popup="view-detail"] .addCard,div[data-popup="view-detail"]  .cnclBtnNCard', function() {
                    $('div[data-popup="view-detail"] form,div[data-popup="view-detail"]  .svdCards').slideToggle();
                });
            <?php endif ?>
            ajaxSearch = false;
            <?php if ($this->session->mem_type == 'tutor') : ?>
                $(document).on('click', 'div[data-popup="view-detail"] a.actn-btn', function(e) {
                    e.preventDefault()
                    if (ajaxSearch)
                        return;
                    ajaxSearch = true;
                    var btn = $(this);
                    var rdstore = btn.data('store');
                    var link = btn.data('link');
                    if (rdstore == '' || link == '')
                        return false;
                    if (btn.data("disabled"))
                        return false;
                    if (link == 'reject-lesson-request')
                        if (!confirm('Are you sure ?'))
                            return false;
                    needToConfirm = true;


                    btn.data("disabled", "disabled");
                    btn.find("i.fa-spinner").removeClass('hidden');
                    $.ajax({
                        url: base_url + '/' + link,
                        data: {
                            'store': rdstore
                        },
                        dataType: 'JSON',
                        method: 'POST',
                        success: function(rs) {
                            if (rs.status === 1) {
                                $.ajax({
                                    url: base_url + 'send-noti-msg',
                                    data: {
                                        'store': store,
                                        'lesson': rdstore
                                    },
                                    dataType: 'JSON',
                                    method: 'POST',
                                    success: function(res) {
                                        if (res.status == 1) {

                                            btn.parents('div.bTn').after(rs.data);
                                            btn.parents('div.bTn').remove();
                                            /*setTimeout(function () {
                                                $('div[data-popup="view-detail"] .crosBtn').trigger('click');
                                            }, 1500);*/

                                        }
                                    },
                                    error: function(res) {
                                        console.log(res);
                                    },
                                })
                            } else
                                alert('Something went wrong!')
                        },
                        error: function(rs) {
                            console.log(rs);
                        },
                        complete: function(rs) {
                            ajaxSearch = false;
                            needToConfirm = false;
                        }
                    })
                })
            <?php endif ?>
            $(document).on('click', 'a.view-detail', function(e) {
                e.preventDefault()
                if (ajaxSearch)
                    return;
                ajaxSearch = true;
                needToConfirm = true;
                var btn = $(this);
                var rdStore = btn.data('store');
                var link = btn.data('link');
                if (rdStore == '' || link == '')
                    return false;

                var image = $(this).attr('data-image');
                var name = $(this).attr('data-name');
                var mem_id = $(this).attr('data-mem');

                $.ajax({
                    url: base_url + '/' + link,
                    data: {
                        'store': rdStore,
                        'image': image,
                        'name': name,
                        'mem_id': mem_id
                    },
                    dataType: 'JSON',
                    method: 'POST',
                    success: function(rs) {
                        if (rs.status === 1) {
                            $('body').addClass('flow');
                            var detail_popup = $(".popup[data-popup='view-detail']");
                            detail_popup.find('._inner').html(rs.data);
                            refresh_rateYo();
                            refresh_selectpicker();
                            detail_popup.fadeIn();
                        } else
                            alert('Something went wrong!')
                    },
                    error: function(rs) {
                        console.log(rs);
                    },
                    complete: function(rs) {
                        ajaxSearch = false;
                        needToConfirm = false;
                    }
                })
            })
            /*$(document).on('keydown',"textarea[name='msg']",function(e){
                if (e.keyCode === 13 && e.ctrlKey) {
                    $(this).val(function(i,val){
                        return val + "\n";
                    });
                }
                else if (e.keyCode === 13 && !e.ctrlKey) {
                    e.preventDefault();
                    $('#frmChat').submit();

                }
            })*/
            $(document).on('keydown', "textarea[name='msg']", function(e) {
                if (e.keyCode === 13 && (e.ctrlKey || e.shiftKey)) {
                    var val = this.value;
                    if (typeof this.selectionStart == "number" && typeof this.selectionEnd == "number") {
                        var start = this.selectionStart;
                        this.value = val.slice(0, start) + "\n" + val.slice(this.selectionEnd);
                        this.selectionStart = this.selectionEnd = start + 1;
                    } else if (document.selection && document.selection.createRange) {
                        this.focus();
                        var range = document.selection.createRange();
                        range.text = "\r\n";
                        range.collapse(false);
                        range.select();
                    }
                    return false;
                } else if (e.keyCode === 13 && !e.ctrlKey && !e.shiftKey) {
                    e.preventDefault();
                    $(this).parents('form#frmChat').submit();
                }
            })
            $(document).on('click', '.apply_button', function(e) {
                e.preventDefault();
                var promocode = $('#promocode').val();
                var btn = $(this);
                btn.find("i.fa-spinner").removeClass('hidden');
                var store = $('#encoded_id').val();
                var total_num = $('#total_sum').val();

                $.ajax({
                    url: '<?php echo base_url(); ?>check_coupon',
                    data: {
                        'store': store,
                        'promocode': promocode,
                        'total_num': total_num
                    },
                    dataType: 'JSON',
                    method: 'POST',
                    success: function(rs) {
                        console.log(rs);
                        if (rs.status === 1) {
                            $('.pre_promo_code').hide();
                            $('.promo_coded').show();
                            $('.promo_code').hide();
                            $('.applied_promo_view').text(rs.promo_code_discount);
                            //$('.applied_promo_code').text(rs.promo_code_discount);
                            $('.total_amount_applied').text(rs.amount);
                            $('.show_result').html(rs.data);
                        } else {
                            $('.show_result').html(rs.data);
                            $('div[data-popup="view-detail"] .alertMsg:first').html(rs.msg)
                            btn.attr("disabled", false);
                            btn.find("i.fa-spinner").addClass('hidden');
                        }

                    },
                    error: function(rs) {
                        console.log(rs);
                    },
                    complete: function(rs) {
                        ajaxSearch = false;
                        needToConfirm = false;
                    }
                });
            });
            setInterval(function() {
                $.ajax({
                    method: "POST",
                    url: "<?= site_url('get-chat') ?>",
                    dataType: 'json',
                    data: {
                        'store': store
                    },
                    success: function(data) {
                        if (data.status > 0) {
                            $('.chat>p').remove();
                            if (data.msg && data.msg != '') {
                                $('.chat').append(data.msg);

                                var frnd_order = $('.frnds >li[data-chat="' + store + '"]').index();
                                if (frnd_order > 0) {
                                    $(".frnds >li:eq(0)").before($(".frnds >li:eq(" + frnd_order + ")"));
                                }

                                $('.chat').scrollTop($('.chat').prop("scrollHeight"));
                            }

                            /*$('.frnds >li[data-chat="'+store+'"]').find('.preview').html(data.sidemsg);
                            $('.frnds >li[data-chat="'+store+'"]').find('.time').html(data.time);*/

                        } else
                            alert(data.msg);
                        // console.log(data);
                    },
                    complete: function(data) {}
                })
            }, 3000);
        })
        <?php if (!empty($subjects)) : ?>

            function initialize() {
                var input = document.getElementById('txtaddress');
                input.removeAttribute('disabled')
                google.maps.event.addDomListener(input, 'keydown', function(e) {
                    if (e.keyCode == 13 && $('.pac-container:visible').length) {
                        e.preventDefault();
                    }
                });
                var autocomplete = new google.maps.places.Autocomplete(input);
            }
            google.maps.event.addDomListener(window, 'load', initialize);
        <?php endif ?>
    </script>
</body>

</html>