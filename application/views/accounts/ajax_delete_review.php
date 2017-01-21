<div id="view-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h2 class="modal-title">
                    حذف پروفایل
                </h2>
            </div>

            <div class="modal-body">
                <div id="modal-loader" style="display: none; text-align: center;">
                    <!-- ajax loader -->
                    <img src="<?php echo asset_url('img/ajax-loader.gif'); ?>">
                </div>

                <!-- mysql data will be load here -->
                <div id="dynamic-content"></div>
            </div>

        </div>
    </div>
</div>
<script>
    $(document).ready(function(){

        $(document).on('click', '#getUser', function(e){

            e.preventDefault();

            var uid = $(this).data('id'); // get id of clicked row

            $('#dynamic-content').html(''); // leave this div blank
            $('#modal-loader').show();      // load ajax loader on button click

            $.ajax({
                url: '<?php echo site_url('account/delete_review/');?>'+uid,
                type: 'POST',
                data: 'id='+uid,
                dataType: 'html'
            })
                .done(function(data){
                    console.log(data);
                    $('#dynamic-content').html(''); // blank before load.
                    $('#dynamic-content').html(data); // load here
                    $('#modal-loader').hide(); // hide loader
                })
                .fail(function(){
                    $('#dynamic-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
                    $('#modal-loader').hide();
                });

        });
    });
</script>