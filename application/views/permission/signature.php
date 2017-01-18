<?php
/**
 * Created by PhpStorm.
 * User: Miss You A
 * Date: 2017-01-16
 * Time: 19:04
 */
$this->load->view("permission/ajax_signature");
?>

<div class="container">
	<div class="row text-center ">
	    <div class="col-md-12">
	        <br /><br />
	        <h2>ورود به سیستم</h2>
	       
	        <h5>برای دسترسی به سیستم امضای دیجیتالی خود را وارد کنید.</h5>
	         <br />
	    </div>
	</div>
    <div class="row ">
    	<div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
       		<div class="panel panel-default">
                <div class="panel-heading">
                    <strong>وارد نمودن امضای دیجیتالی</strong>  
                </div>
                <div class="panel-body">
                    <form role="form">
                   	 <br />
						<div class="form-group input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-barcode" ></i></span>
                                <input class="form-control" type="email" required id="email" name="email">
                        </div>
                        <button class="btn btn-primary form-control" data-toggle="modal" data-target="#view-modal"
	        				value="request signature" name="signature" id="signature">درخواست امضای دیجیتالی
	        			</button>
                         <hr />
                    </form>
                </div>   
            </div>
        </div>       
    </div>
</div>

