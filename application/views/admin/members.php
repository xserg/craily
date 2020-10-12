<?php if ($this->uri->segment(3) == 'manage'): ?>
    <?= showMsg(); ?>
    <?= getBredcrum(ADMIN, array('#' => 'Add/Update Members')); ?>
    <div class="row margin-bottom-10">
        <div class="col-md-6">
            <h2 class="no-margin"><i class="entypo-users"></i> Add/Update <strong>Members</strong></h2>
        </div>
        <div class="col-md-6 text-right">
            <a href="<?= site_url(ADMIN . '/members'); ?>" class="btn btn-lg btn-default"><i class="fa fa-arrow-left"></i> Cancel</a>
        </div>
    </div>
    <div>
        <hr>
        <div class="row col-md-12">
            <form action=""  role="form" class="form-horizontal" method="post" enctype="multipart/form-data">

                <div class="col-md-6">
                    <h3><i class="fa fa-bars"></i> Profile Detail</h3>
                    <hr class="hr-short">
                    <?php if (isset($row->mem_fname)):?>
                        <div style="font-size: 13px"><b>Member Since:</b> <small> <?= format_date($row->mem_date); ?></small></div>
                        <div style="font-size: 13px"><b>Last Login:</b> <small> <?= format_date($row->mem_last_login,'M d Y h:i:s A'); ?></small></div>
                    <?php endif?>
                    <div class="form-group">
                        <div class="col-md-12">
                            <label class="control-label"> First Name <span class="symbol required">*</span></label>
                            <input type="text" name="mem_fname" value="<?php if (isset($row->mem_fname)) echo $row->mem_fname; ?>" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <label class="control-label"> Last Name <span class="symbol required">*</span></label>
                            <input type="text" name="mem_lname" value="<?php if (isset($row->mem_lname)) echo $row->mem_lname; ?>" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <label class="control-label"> Phone Number <span class="symbol required">*</span></label>
                            <input type="text" name="mem_phone" value="<?php if (isset($row->mem_phone)) echo $row->mem_phone; ?>" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <label class="control-label"> Country</label>
                            <select id="mem_country_id" name="mem_country_id" class="form-control">
                                <option value="">Please select Country</option>
                                <?= get_countries_options('id',$row->mem_country_id);?>
                                
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <label class="control-label"> City / State</label>
                            <input type="text" name="mem_city" value="<?php if (isset($row->mem_city)) echo $row->mem_city; ?>" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <label class="control-label"> Zip Code</label>
                            <input type="text" name="mem_zip" value="<?php if (isset($row->mem_zip)) echo $row->mem_zip; ?>" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <label class="control-label"> Address</label>
                            <input type="text" name="mem_address1" value="<?php if (isset($row->mem_address1)) echo $row->mem_address1; ?>" class="form-control">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class = "col-md-6">
                            <label class="control-label"> Profile Image <span class="symbol required">*</span></label><br>
                            <div class="dynamicUpload" style="width: 100px;">
                                <img src = "<?= get_image_src($row->mem_image,150,true); ?>" height = "80">
                                <div class="crosBtn hidden" data-image="">×</div>
                                <div class="icoMask uploadImgBtn" data-type="dp">
                                    <i class="fi-camera"></i> choose image
                                </div><br>
                                <input type="hidden" name="mem_image" id="mem_image" value="" disabled="">
                                <div class="uploadBar hidden"><span class="myBar" style="width: 70%"></span></div>
                                <div class="loadingImg hidden"><img src = "<?= base_url('assets/images/loading.gif'); ?>"></div>
                            </div>
                            <div><br />
                                <small style = "color:#F00;">* Best resolution is <strong>600 x 600</strong>.</small><br />
                                <small style = " color:#F00;">* Allowed formats are <strong>JPG | JPEG | PNG</strong>.</small><br>
                                <small style = "color:#F00;">* Image size maximum <strong>2MB</strong> allowed.</small>
                            </div>
                        </div>
                        <div class = "col-md-6">
                            <label class="control-label"> Cover Image <span class="symbol required">*</span></label><br>
                            <div class="dynamicUpload">
                                <img src = "<?= get_image_src($row->mem_cover_image,300); ?>" height = "80">
                                <div class="crosBtn hidden" data-image="">×</div>
                                <div class="icoMask uploadImgBtn" data-type="image">
                                    <i class="fi-camera"></i> choose image
                                </div><br>
                                <input type="hidden" name="mem_cover_image" id="mem_cover_image" value="" disabled="">
                                <div class="uploadBar hidden"><span class="myBar" style="width: 70%"></span></div>
                                <div class="loadingImg hidden"><img src = "<?= base_url('assets/images/loading.gif'); ?>"></div>
                            </div>
                            <div><br />
                                <small style = "color:#F00;">* Best resolution is <strong>1460 x 450</strong>.</small><br />
                                <small style = " color:#F00;">* Allowed formats are <strong>JPG | JPEG | PNG</strong>.</small><br>
                                <small style = "color:#F00;">* Image size maximum <strong>2MB</strong> allowed.</small>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-4">
                            <label class="control-label"> Status</label>
                            <select name="mem_status" id="mem_status" class="form-control">
                                <option value="0" <?php
                                if (isset($row->mem_status) && '0' == $row->mem_status) {
                                    echo 'selected';
                                }
                                ?>>InActive</option>
                                <option value="1" <?php
                                if (isset($row->mem_status) && '1' == $row->mem_status) {
                                    echo 'selected';
                                }
                                ?>>Active</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="control-label"> Verified</label>
                            <select name="mem_verified" id="mem_verified" class="form-control">
                                <option value="0" <?php
                                if (isset($row->mem_verified) && '0' == $row->mem_verified) {
                                    echo 'selected';
                                }
                                ?>>No</option>
                                <option value="1" <?php
                                if (isset($row->mem_verified) && '1' == $row->mem_verified) {
                                    echo 'selected';
                                }
                                ?>>Yes</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="control-label"> Verify Seller</label>
                            <select name="mem_seller" id="mem_seller" class="form-control">
                                <option value="0" <?php
                                if (isset($row->mem_seller) && '0' == $row->mem_seller) {
                                    echo 'selected';
                                }
                                ?>>No</option>
                                <option value="1" <?php
                                if (isset($row->mem_seller) && '1' == $row->mem_seller) {
                                    echo 'selected';
                                }
                                ?>>Yes</option>
                            </select>
                        </div>
                    </div>
                </div>    
                <div class="col-md-6">

                    <div class="col-md-12">
                        <h3><i class="fa fa-bars"></i> Personal Information</h3>
                        <hr class="hr-short">
                        <div class="form-group">
                            <div class="col-md-12">
                                <label class="control-label"> Gender </label>
                                <select id="mem_sex" name="mem_sex" class="form-control">
                                    <option value="" text="Gender">Gender</option>
                                    <option value="male" <?= $row->mem_sex=='male'?'selected':''?>>Male</option>
                                    <option value="female" <?= $row->mem_sex=='female'?'selected':''?>>Female</option>
                                    <option value="other" <?= $row->mem_sex=='other'?'selected':''?>>Other</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <label class="control-label"> Facebook Link</label>
                                <input type="text" name="mem_fb_link" value="<?php if (isset($row->mem_fb_link)) echo $row->mem_fb_link; ?>" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <label class="control-label"> Twitter Link</label>
                                <input type="text" name="mem_twitter_link" value="<?php if (isset($row->mem_twitter_link)) echo $row->mem_twitter_link; ?>" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <label class="control-label"> Youtube Link</label>
                                <input type="text" name="mem_youtube_link" value="<?php if (isset($row->mem_youtube_link)) echo $row->mem_youtube_link; ?>" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <label class="control-label"> Discord Link</label>
                                <input type="text" name="mem_discord_link" value="<?php if (isset($row->mem_discord_link)) echo $row->mem_discord_link; ?>" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <label class="control-label"> Patreon Link</label>
                                <input type="text" name="mem_patreon_link" value="<?php if (isset($row->mem_patreon_link)) echo $row->mem_patreon_link; ?>" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <label class="control-label">About <span class="symbol required">*</span></label>
                                <textarea name="mem_about" id="mem_about" rows="4" class="form-control"><?=$row->mem_about; ?></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <h3><i class="fa fa-bars"></i> Login Credentials</h3>
                        <hr class="hr-short">
                        <div class="form-group">
                            <div class="col-md-12">
                                <label class="control-label">Email <span class="symbol required">*</span></label>
                                <input type="text" name="mem_email" value="<?php if (isset($row->mem_email)) echo $row->mem_email; ?>"  class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <label class="control-label">Password </label>
                                <input type="text"  name="mem_pswd" value="<?php  if (isset($row->mem_pswd)) echo doDecode($row->mem_pswd);  ?>" class="form-control" autocomplete="off" placeholder="password" <?php  if (!empty($row->mem_pswd)) echo 'required';  ?> >
                            </div>
                        </div>
                    </div>

                    <div class="clearfix"></div>
                    <div class="col-md-12">                
                        <hr class="hr-short">
                        <div class="form-group text-right">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary btn-lg"><i class="fa fa-save"></i> Save</button>
                            </div>
                        </div>
                    </div>

                </div>
            </form>
            <input type="file" id="uploadFile" name="uploadFile" accept="image/*" class="uploadFile" data-file="">
            <div class="clearfix"></div>
        </div>
        <?php else: ?>
            <?= showMsg(); ?>
            <?= getBredcrum(ADMIN, array('#' => 'Manage Members')); ?>
            <div class="row margin-bottom-10">
                <div class="col-md-6">
                    <h2 class="no-margin"><i class="entypo-users"></i> Manage <strong>Members</strong></h2>
                </div>
                <div class="col-md-6 text-right">
                    <a href="<?= site_url(ADMIN . '/members/manage'); ?>" class="btn btn-lg btn-primary"><i class="fa fa-plus-circle"></i> Add New</a>
                </div>
            </div>
            <table class="table table-bordered datatable" id="table-1">
                <thead>
                    <tr>
                        <th width="5%" class="text-center">Sr#</th>
                        <th width="60px">Photo</th>
                        <th width="20%">Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Last Login</th>
                        <th width="8%" class="text-center">Verified</th>
                        <th width="8%" class="text-center">Status</th>
                        <th width="12%" class="text-center">&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($rows) > 0): $count = 0; ?>
                        <?php foreach ($rows as $row): ?>
                            <tr class="odd gradeX">
                                <td class="text-center"><?= ++$count; ?></td>
                                <td class="text-center">
                                    <div class="icoRound">
                                        <img src = "<?= get_image_src($row->mem_image,50,true); ?>" height = "60">
                                    </div>
                                </td>
                                <td><b><a href="<?= profile_url($row->mem_id,$row->mem_fname . ' ' . $row->mem_lname)?>" target="_blank"><?= $row->mem_fname . ' ' . $row->mem_lname; ?></a></b></td>
                                <td><?= $row->mem_email; ?></td>
                                <td><?= $row->mem_phone; ?></td>
                                <td><?= format_date($row->mem_last_login,'M d Y h:i:s A'); ?></td>
                                <td class="text-center"><?= verified_status($row->mem_verified); ?></td>
                                <td class="text-center"><?= getStatus($row->mem_status); ?></td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"> Action <span class="caret"></span></button>
                                        <ul class="dropdown-menu dropdown-primary" role="menu">
                                            <?php if ($row->mem_status == '0'): ?>
                                                <li><a href="<?= site_url(ADMIN); ?>/members/active/<?= $row->mem_id; ?>">Active</a></li>
                                                <?php else: ?>
                                                    <li><a href="<?= site_url(ADMIN); ?>/members/inactive/<?= $row->mem_id; ?>">Inactive</a></li>
                                                <?php endif; ?>

                                                <li><a href="<?= site_url(ADMIN); ?>/members/manage/<?= $row->mem_id; ?>">Edit</a></li>
                                        <li><a href="<?= site_url(ADMIN); ?>/members/delete/<?= $row->mem_id; ?>" onclick="return confirm('Are you sure?');">Delete</a></li>
                                        <li class="divider"></li>
                                        <li><a href="<?= site_url(ADMIN.'/members/comics/'.$row->mem_id); ?>" >Comics</a></li>
                                        <li><a href="<?= site_url(ADMIN.'/members/novels/'.$row->mem_id); ?>" >Novels</a></li>
                                        <li><a href="<?= site_url(ADMIN.'/members/transactions/'.$row->mem_id); ?>" >Transactions</a></li>
                                        <li><a href="<?= site_url(ADMIN.'/members/withdraws/'.$row->mem_id); ?>" >Withdraws</a></li>
                                        <li><a href="<?= site_url(ADMIN.'/members/chats/'.$row->mem_id); ?>" >Chats</a></li>
                                    </ul>
                                </div>  
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    <?php endif; ?>