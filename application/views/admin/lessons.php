<?php if ($this->uri->segment(3) == 'detail'): ?>
    <?= showMsg(); ?>
    <?= getBredcrum(ADMIN, array('#' => 'Lesson Detail')); ?>
    <div class="row margin-bottom-10">
        <div class="col-md-6">
            <h2 class="no-margin"><i class="entypo-list"></i> <strong> Lesson</strong> Detail</h2>
        </div>
        <div class="col-md-6 text-right">
            <a href="<?= site_url(ADMIN . '/lessons'); ?>" class="btn btn-lg btn-default"><i class="fa fa-arrow-left"></i> Cancel</a>
        </div>
    </div>
    <div>
        <hr>
        <div class="row col-md-12">
            <h3><i class="fa fa-bars"></i> Lesson Detail </h3>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td width="120"><strong>Tutor Name:</strong></td>
                        <td><?=ucwords($member->mem_fname.' '.$member->mem_lname)?></td>
                        <td width="120"><strong>Stduent Name:</strong></td>
                        <td><?= $row->mem_name?></td>
                    </tr>
                    <tr>
                        <td><strong>Subject:</strong></td>
                        <td><?= $row->subject?></td>
                        <td><strong>Date:</strong></td>
                        <td><?= format_date($row->lesson_date_time)?></td>
                    </tr>
                    <tr>
                        <td><strong>Start Time:</strong></td>
                        <td><?= format_date($row->lesson_date_time,'h:i A')?></td>
                        <td><strong>Hours:</strong></td>
                        <td><?= hours_format($row->hours)?></td>
                    </tr>
                    <tr>
                        <td><strong>Total:</strong></td>
                        <td>$ <span style="font-size:14px; font-weight: bold; color:green"><?=$row->amount?></span></td>
                        <?php if ($row->promocode!=''): ?>
                            <td><strong>Discount:</strong></td>
                            <td><?= format_amount($row->discount)?> &emsp;<small>(<?= $row->promocode?>)</small></td>
                        <?php endif ?>
                    </tr>
                    <tr>
                        <td><strong>Lesson Type:</strong></td>
                        <td><?= $row->lesson_type?></td>
                        <td><strong>Status:</strong></td>
                        <td><?=get_lesson_status($row->status)?></td>
                    </tr>
                    <?php if ($row->lesson_type=='In Person'):?>
                        <tr>
                            <td><strong>Location:</strong></td>
                            <td><?= $row->address?></td>
                        </tr>
                    <?php endif?>
                    <tr>
                        <td><strong>Message:</strong></td>
                        <td colspan="3"><?= $row->detail?></td>
                    </tr>
                </tbody>
            </table>
        </div>
            <div class="row col-md-12">
                <h3><i class="fa fa-info-circle"></i> Lesson History </h3>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th width="50%">Tutor</th>
                            <th width="50%">Student</th>
                        <tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <?php foreach($logs as $log):?>
                                    <?php if($log->member_type == 'tutor'):?>
                                        <span style="margin-right:20px"><?= $log->log_time?></span><strong style="color:<?= ($log->in_out == 'in')?'green':'red'?>"><?= ($log->in_out == 'in')?'Connected: ':'Disconnected: '?></strong>
                                    <br>
                                    <?php endif;?>
                                <?php endforeach;?>
                            </td>
                            <td>
                                <?php foreach($logs as $log):?>
                                    <?php if($log->member_type == 'student'):?>
                                        <span style="margin-right:20px"><?= $log->log_time?></span><strong style="color:<?= ($log->in_out == 'in')?'green':'red'?>"><?= ($log->in_out == 'in')?'Connected: ':'Disconnected: '?></strong>
                                    <br>
                                    <?php endif;?>
                                <?php endforeach;?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        <?php if($row->status==2 && ($row->completed>0 || $row->canceled==1)):?>
            <div class="row col-md-12">
                <h3><i class="fa fa-list-alt"></i> Lesson Completed </h3>
                <form action="" role="form" class="form-horizontal frmAjax" method="post" enctype="multipart/form-data">
                    <div class="alertMsg"></div>
                <table class="table table-bordered">
                    <tbody>
                        <?php if ($row->canceled==1): ?>
                            <tr>
                                <td><strong>Status:</strong></td>
                                <td><span class="miniLbl red">Canceled</span></td>

                                <td><strong>Canceled By:</strong></td>
                                <td><?= ucwords($canceled_by->mem_fname.' '.$canceled_by->mem_lname)?></td>

                                <td><strong>Canceled Date:</strong></td>
                                <td><?= format_date($row->final_date)?></td>
                            </tr>
                        <?php endif ?>
                        <?php if ($row->completed>0): ?>
                            <tr>
                                <td><strong>Status:</strong></td>
                                <td><?= get_completed_status($row->completed)?></td>
                                <td><strong>Date:</strong></td>
                                <td><input type="text" name="date" class="form-control datepicker" value="<?= format_date($row->final_date,'m/d/Y')?>" required></td>
                            </tr>
                            <tr>
                                <td><strong>Start Time:</strong></td>
                                <td><input type="text" id="start_time" name="start_time" class="form-control timepicker" placeholder="Start Time" required="" value="<?= get_meridian_time($row->final_start_time)?>"></td>

                                <td><strong>End Time:</strong></td>
                                <td><input type="text" id="end_time" name="end_time" class="form-control timepicker" placeholder="End Time" required="" value="<?= get_meridian_time($row->final_end_time)?>"></td>
                            </tr>
                            <?php if ($row->completed==2): ?>
                                <?php $review=get_mem_rating($row->student_id,$row->id);?>
                                <tr>
                                    <td><strong>Ratting:</strong></td>
                                    <td colspan="3">
                                        <div class="rateYo" id="rating"data-rateyo-rating="<?= $review->rating?>"></div>
                                        <input type="hidden" name="rating" value="<?= $review->rating?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Comment:</strong></td>
                                    <td colspan="3">
                                        <textarea name="comment" id="comment" rows="5" style="width: 100%; resize: none; border: none;" required=""><?= $review->comment?></textarea>
                                    </td>
                                </tr>
                            <?php endif?>
                        <?php endif?>
                    </tbody>
                </table>
                <?php if ($row->completed>0): ?>
                    <div class="form-group text-right">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary btn-lg col-md-2 pull-right">Save <i class="fa fa-spinner fa-pulse fa-1x fa-fw hidden"></i></button>
                        </div>
                    </div>

                <?php endif ?>
                </form>
            </div>
        <?php endif?>
    </div>
<?php else: ?>
    <?= showMsg(); ?>
    <?= getBredcrum(ADMIN, array('#' => 'Lessons Management')); ?>
    <div class="row margin-bottom-10">
        <div class="col-md-12">
            <h2 class="no-margin"><i class="entypo-list"></i> Manage <?php if ($this->uri->segment(4) > 0): ?><strong>" <?php echo ucwords($member_row->mem_fname.' '.$member_row->mem_lname); ?> "</strong> <?php endif; ?>Lessons</h2>
        </div>
    </div>
    <table class="table table-bordered datatable" id="table-2">
        <thead>
            <tr>
                <!-- <th width="5%" class="text-center">Sr#</th> -->
                <th>Student</th>
                <th>Tutor</th>
                <th>Lesson Date</th>
                <th>Date</th>
                <th>Amount</th>
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            <?php //if (count($rows) > 0): $count = 0; ?>
                <?php //foreach ($rows as $row): ?>
                    <tr class="odd gradeX">
                        <!--  <td class="text-center"></td> -->
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="text-center">
                            
                        </td>
                    </tr>
                <?php //endforeach; ?>
            <?php //endif; ?>
        </tbody>
    </table>
<?php endif?>
<script type="text/javascript">
    (function($){
        $(function(){
            $('.rateYo').rateYo({
                fullStar: true,
                normalFill: '#ddd',
                ratedFill: '#f6a623',
                starWidth: '14px',
                spacing: '2px'
            });
            $(document).on("rateyo.set",'#rating',function(e, data){
                var rating=data.rating;
                $('input[name="rating"]').val(rating);
            });
        })
    }(jQuery))
</script>