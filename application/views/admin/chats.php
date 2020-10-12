
<?= showMsg(); ?>
<?= getBredcrum(ADMIN, array('#' => 'Chat Management')); ?>
<div class="row margin-bottom-10">
    <div class="col-md-12">
        <h2 class="no-margin"><i class="fa fa-comments"></i> Manage <?php if ($this->uri->segment(4) > 0): ?><strong>" <?php echo ucwords($member_row->mem_fname.' '.$member_row->mem_lname); ?>'s "</strong> <?php endif; ?>Chats</h2>
    </div>
</div>
<table class="table table-bordered datatable chat-datatable" data-member="<?=$member_row->mem_id?>">
    <thead>
        <tr>
            <th>Members</th>
            <th>Last Message</th>
            <th>Date</th>
            <th width="12%" class="text-center">&nbsp;</th>
        </tr>
    </thead>
    <tbody>
        <?php //if (count($rows) > 0): $count = 0; ?>
            <?php //foreach ($rows as $row): ?>
                <tr class="odd gradeX">
                    <td>
                        
                    </td>
                    <td>
                        
                    </td>
                    <td></td>
                    <td class="text-center">
                        
                    </td>
                </tr>
            <?php //endforeach; ?>
        <?php //endif; ?>
    </tbody>
</table>
<script type="text/javascript">
    (function($){
        $(function(){

        })
    }(jQuery))
</script>