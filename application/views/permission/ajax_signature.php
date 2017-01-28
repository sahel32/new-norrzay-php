<div id="view-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
     style="display: none; margin-top: 100px">
    <div class="modal-dialog modal-resize">
        <div class="modal-content">

            <div class="modal-body">
                <div id="modal-loader" style="display: block; text-align: center;">
                    <!-- ajax loader -->
                    <img src="<?php echo asset_url('img/ajax-loader.gif'); ?>">
                </div>

                <!-- mysql data will be load here -->
                <div id="dynamic-content">

                </div>
            </div>

        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $(document).on('click', '#signature', function(){

            //alert(isValidEmailAddress(email))
            var times=0
            var email=$("#email").val();
            var result='';
            //alert(email)
            //if(email=="" || isValidEmailAddress(email)){
            //if(email==""){
            if(false){
                setTimeout(function () {
                    $('#modal-loader').hide();
                    $('#dynamic-content').html("<center><h4>لطفا ایمل خودرا وارد کنید</h4></center>")
                }, 2500);
            }else {
                var loop = setInterval(function () {
                    times++;
                    if (times >= 10) {
                        clearInterval(loop);
                        $('#view-modal').modal('hide');
                    }
                    $.ajax({
                        type: 'POST',
                        url: '<?php echo site_url('anvander/check_permission'); ?>',
                        data: {re_email: email},
                        dataType: 'html'
                    })
                        .done(function (data) {

                            if(data==1){
                                result="درحال ری دایرکت کردن"
                                var  url='<?php echo site_url(''); ?>';
                                
                                window.location.href=url;
                            }
                                result = times * 3;
                            $('#dynamic-content').html("<center><h4>" + result + " ثانبه</4></center>")
                        })
                        .fail(function () {
                            $('#dynamic-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
                            $('#view-modal').modal('hide');
                           // clearInterval(loop);
                        });
                }, 3000);
            }
        });
    });
</script>