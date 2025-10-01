<?php
include "./class/header.php";
include "./class/functions.php";
// include "./common_file/header.php";
?>
<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Local Service Brands - CPanel</title>

  <!-- stylesheets -->
  <link rel="icon" type="image/png" href="img/favicon.png" />
  <link rel="stylesheet" href="css/bootstrapx.css">
  <link rel="stylesheet" href="css/style.css">

  <style>
  .text-center th { text-align: center; }
  .text-bold td { font-weight: bold; }
  .shop-item .norm-text strong div strong { color: #000; }
  .shop-item .btn.btn-default.red.dark { background-color: #373737; font-size: 13px; padding: 3px 6px; }
  .accordion-item {/*border:1px solid #555555;*/ }
  .mnth-title:before { content: ""; display: block; position: absolute; height: 100px; width: 30%; left: 35%; border: 1px solid #ccc; background: white; z-index: -1; border-radius: 3px; }
  .row-edit-btn, .row-save-btn { background: #111; color: #fff; border: none; padding: 3px 6px; }
  .row-save-btn { background: #fa5151; font-weight: bold; }
  .row-cancel-btn { background: #000; border: none; padding: 3px 3px; color: #fff; text-align: center; margin: 0px 2px; }
  .ajax-loader { display: none; position: absolute; padding: 18px 0; }
  .ajax-loader img { height: 32px; margin-left: 20px; }
  .ajax_form_output{ display:none; color: #fa5151; text-align: center; font-size: 18px; padding: 20px; }
  /* Modal window */
  .modal { display: none; background: rgba(0, 0, 0, 0.7); position: fixed; height: 100%; width: 100%; left: 0; top: 0; z-index: 9999; }
	.modal .box { background: white; height: 600px; width: 800px; position: relative; display: block; margin: auto; margin-top: 60px; z-index: 9999; border-radius: 4px; border: 1px solid #D7D6D6; box-shadow: 0px 2px 4px -2px rgba(0, 0, 0, 0.7); padding: 30px; overflow: auto; }
  .modal .close-btn { background: #e4e4e4; border-radius: 50%; cursor: pointer; font-size: 1.5em; position: absolute; right: 10px; top: 10px; height: 40px; width: 40px; text-align: center; line-height: 40px; transition: all 0.2s ease 0s; }
  .modal .close-btn:hover { background: #C8C8C8; }
  .modal .box .modal-space { font-size: 1.1em; line-height: 1.6; }
	.modal-space.ticket-item .image { float: right; width: 40%; padding-left: 30px; }
	.modal-space.ticket-item .image img { max-width: 100%; }
	.modal-space.ticket-item span { font-weight: bold; padding: 14px 14px 14px 0; display: inline-block; }
	.modal-space.ticket-item span.url { float: left; clear: both; }
	.modal-space.ticket-item .description { float: left; width: 60%; }
	.modal-space.ticket-item div { overflow: auto; clear:both; padding: 20px ; text-align:center; }
	.modal-space.ticket-item div .tic-save-btn,	.modal-space.ticket-item div .tic-cancel-btn { padding: 6px 12px; float:none; }
	.modal .box input, .modal .box textarea { display: block; width: 100%; }

  /* table */
  .ticket-item .image img { max-width: 130px; }
  .ticket-item .title { font-size: 15px; font-weight: bold; text-transform: capitalize; }
	.editing { border: 2px dashed black; background: #f2f2ea; }

	.tic-view-button, .tic-edit-button, .tic-delete-button, .tic-save-btn, .tic-cancel-btn { background: #000; border: 1px solid #000; border-radius: 3px; padding: 3px 6px; color: #fff; float: left; margin: 0 2px 2px 0;}
	.tic-delete-button { background: #fa5151; color: #fff; }
	.tic-save-button { background: #75CB21; color: #fff; }



  </style>
</head>

<body>
  <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an outdated browser. Please <a href="http://browsehappy.com/">upgrade your browser</a>.</p>
      <![endif]-->
  
  <!-- Add navbar-fixed-top for fixed topbar -->
  <nav class="navbar navbar-inverse main-menu" role="navigation">
    <div class="container-fluid">
      <div class="navbar-header">
        <button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a href="#" class="navbar-brand">CPanel</a>
      </div>
      <div class="navbar-collapse collapse">
        <ul class="nav navbar-nav navbar-right">
          <li><a href="dashboard.php">Dashboard</a></li>
          <li class="dropdown">
            <a aria-expanded="true" aria-haspopup="true" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#"> Propagation System <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li> <a href="index.php"> Validation And Research Section </a> </li>
              <li> <a href="non_propogation.php">CNL With Non-Propogated DID Number</a> </li>
              <li> <a href="publisher_tiles.php">Publisher Tiles</a> </li>
              <li> <a href="identity_report.php">Marge Report Of Identity</a> </li>
              <li> <a href="propagated_report.php">Total Summary Results For Master DID Database</a> </li>
              <li> <a href="blended_report.php">Blended Id DID Number And Propagated DID Number</a> </li>
              <li> <a href="quarantine_report.php">Quarantine Report</a> </li>
              <li> <a href="propagated_report_list.php">Propagated Report</a> </li>
            </ul>
          </li>
          <li class="dropdown">
            <a aria-expanded="true" aria-haspopup="true" role="button" data-toggle="dropdown" class="dropdown-toggle" href="lookup.php"> Record Look-up <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li> <a href="lookup.php">By DID Number</a> </li>
              <li> <a href="lookup.php">By State</a> </li>
              <li> <a href="lookup.php">By City</a> </li>
              <li> <a href="lookup.php">By ZipCode</a> </li>
              <li> <a href="lookup.php">By Name</a> </li>
              <li> <a href="lookup.php">By Agent</a> </li>
              <li> <a href="lookup.php">By Date Range Created</a> </li>
              <li> <a href="lookup.php">By Oldest Comment</a> </li>
              <li> <a href="lookup.php">By Newest Comment</a> </li>
            </ul>
          </li>
          <li><a href="settings.php">Settings</a></li>
          <li><a href="cityflorist/admin777/">City Florist</a></li>
          <li><a href="money.php">Money</a></li>
          <li><a href="comments_claiming.php">Comments/Claiming</a></li>
          <li class="dropdown">
            <a aria-expanded="true" aria-haspopup="true" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#"> <span><img src="img/icons/user.png" alt=""></span> <?php echo $_SESSION['user_name']?> <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="settings.php">Settings</a></li>
              <li class="divider" role="separator"></li>
              <li><a href="s_destroy.php">Logout</a></li>
            </ul>
          </li>

        </ul>
      </div><!--/.nav-collapse -->
    </div>
  </nav>


<?php
//INCLUDING THE HEADER
// include "./header.php";
$active="newcompany_order";
?>


<!-- PAGE SECTIONS -->
<div class="container content-wrapper">

    <div class="row content-section">

      <?php 
        $con = mysqli_connect("localhost","local854_local","local123","local854_local");
        $grab_internet_order_alert = mysqli_query($con,"SELECT a.agent_name, a.id,a.recipient_first,a.recipient_last FROM order_recipient_information a LEFT JOIN booked_order_details b ON a.unique_order_id = b.booking_unique_id WHERE b.booking_unique_id IS NULL AND a.agent_name='online'");
        $grab_cancelticket_data = mysqli_query($con,"SELECT * FROM customer_ticket WHERE florist_cancelation_report='1' ");
        $grab_ticket_data       = mysqli_query($con,"SELECT * FROM order_payment_details WHERE send_transaction_receipt_by_fax='1' OR send_transaction_receipt='1' ");
        $grab_ticket_data_other = mysqli_query($con,"SELECT * FROM customer_ticket WHERE open_customer_ticket='1' ");
      ?>

      <nav class="navbar navbar-default inner-menu">
        <div class="container">
          <div class="">
            <ul class="nav navbar-nav">
              <li class="icon-item"><a href="#"> <img src="img/cart.png" alt=""> </a></li>
              <li>
                <a href="https://www.localservicebrands.com/admin_lsbs/order_report.php?database_report=Search&order_query=internet_order_booked&addtional_val=&addtional_val1=&addtional_val2=&addtional_val3=">Internet <br>Orders 
                  <?php if(mysqli_num_rows($grab_internet_order_alert) > 0)  {  echo "<span class='notify'></span>";} ?>
                </a>
              </li>
              <li>
                <a href="https://www.localservicebrands.com/admin_lsbs/order_report.php?database_report=Search&order_query=order_topfcr&addtional_val=&addtional_val1=&addtional_val2=&addtional_val3=">Cancellation <br>Confirmation
                <?php if(mysqli_num_rows($grab_cancelticket_data) > 0)  {  echo "<span class='notify'></span>";} ?>
                </a>
              </li>
              <li>
                <a href="https://www.localservicebrands.com/admin_lsbs/order_report.php?database_report=Search&order_query=payment_receipt&addtional_val=&addtional_val1=&addtional_val2=&addtional_val3=#">Payment Recipient <br>Request
                <?php if(mysqli_num_rows($grab_ticket_data) > 0)  {  echo "<span class='notify'></span>";} ?>
                </a>
              </li>
              <li>
                <a href="https://www.localservicebrands.com/admin_lsbs/order_report.php?database_report=Search&order_query=order_top&addtional_val=&addtional_val1=&addtional_val2=&addtional_val3=#">Ticket <br>Open
                <?php if(mysqli_num_rows($grab_ticket_data_other) > 0)  {  echo "<span class='notify'></span>";} ?>
                </a>
              </li>
              <li>
                <a href="https://www.localservicebrands.com/admin_lsbs/order_report_search.php?database_report=Search&order_query=FTD_field_empty&addtional_val=&addtional_val1=&addtional_val2=&addtional_val3=#">FTD Report</a>
              </li>
              <li>
                <a href="https://www.localservicebrands.com/admin_lsbs/order_report_search.php?database_report=Search&order_query=order_confirmation&addtional_val=&addtional_val1=&addtional_val2=&addtional_val3=#">Delivery <br>Confirmation</a>
              </li>
              <li>
                <a href="https://www.localservicebrands.com/admin_lsbs/month_report.php#">COG Pay <br>Balance</a>
              </li>
              <li>
                <a href="http://www.danapointflowersandgiftbaskets.com/#">New Florist <br>Demo</a>
              </li>
              <li>
                <a href="https://www.localservicebrands.com/admin_lsbs/did_report.php#">Master DID <br>List</a>
              </li>
              <li>
                <a href="https://www.localservicebrands.com/admin_lsbs/moz_locations.php#">MOZ Locations</a>
              </li>
              <li class="active icon-item"><a href="https://www.localservicebrands.com/admin_lsbs/non_propogation_yellow_page.php"> <img src="img/ypages.png" alt=""> </a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </nav>
    </div>

    <div class="row content-section">

      <div class="jumbotron mini">
        <h1 class="page-header"><strong>Customer</strong> Service Tickets </h1>
        <p class="bold-links pull-left text-left">
          <a>All tickets: <span style="color:#222;"> 0 </span></a> &nbsp; &nbsp;
          <a>Open Tickets: <span style="color:#222;"> 0 </span></a> 
        </p>
        <a class="bold-links pull-right" href="#"> <span><</span> BACK TO ORDERS </a>
      </div>
    </div>

    <div class="row content-section">
      <div class="whitey">
        <form id="service_ticket_form" name="" action="" method="POST" enctype="multipart/form-data">
          <!-- <input id="did_number_for_identityx" name="did_number_for_identity" class="form-control" type="hidden"> -->

          <div class="row content-section">
            <div class="col-md-12">
              <h3 class="text-center"> <strong> Submit </strong> your ticket </h3>

              <div class="row">
                <div class="col-md-12">
                  <form class="customer-form">
                    
                    <div class="row">
                      <div class="col-sm-4 text-right">
                        <h5>Title</h5>
                      </div>
                      <div class="col-sm-5">
                        <div class="input-group">
                          <input type="text" class="form-control" id="tic_title" name="tic_title" placeholder="Title">
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-sm-4 text-right">
                        <h5>User Description</h5>
                      </div>
                      <div class="col-sm-6">
                        <div class="input-group">
                          <textarea class="form-control" id="tic_description" name="tic_description" placeholder="Description"></textarea>
                        </div>
                      </div>
                    </div>

                    <div class="row">                      
                      <div class="col-sm-4 text-right">
                        <h5>Status</h5>
                      </div>
                      <div class="col-sm-5">
                        <div class="input-group">
                          <select id="tic_status" name="tic_status" class="form-control">
                            <option value="pending"> Pending </option>
                            <option value="working"> Working </option>
                            <option value="complete"> Complete </option>
                            <option value="closed"> Closed </option>
                          </select>
                        </div>
                      </div>
                    </div>


                    <div class="row">
                      <div class="col-sm-4 text-right">
                        <h5>Image</h5>
                      </div>
                      <div class="col-sm-5">
                        <div class="input-group date" id="date-time">
                          <input type='file' class="form-control" id="tic_file" name="tic_file" class="" />
                        </div>
                      </div> 
                    </div>

                    <div class="row">
                      <div class="col-sm-4 text-right">
                        <h5>Date &amp; Time</h5>
                      </div>
                      <div class="col-sm-5">
                        <div class="input-group date" id="date-time">
                          <input type='text' class="form-control datepickery" id="datepickery" name="tic_datepicker" placeholder="dd/mm/yyyy" />
                          <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                          </span>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-sm-4 text-right">
                        <h5>URL</h5>
                      </div>
                      <div class="col-sm-5">
                        <input type="text" class="form-control form-url" id="tic_url" name="tic_url" placeholder="www.example.com">
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-sm-12">
                        <div class="input-group text-center">
                          <br><br>
                          <button id="ticket_submit_btn" class="btn btn-default btn-lg red" type="button">Submit</button>
                          <span class="center ajax-loader" style="display:none;">
                            <img src="img/modal-loader.gif" alt="Loading">
                          </span>
                        </div>  
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-sm-12">
                        <div class="ajax_form_output text-center">
                          <p></p>
                        </div>  
                      </div>
                    </div>

                  </form>
                </div>

              </div>

            </div>
          </div>
        </form>
      </div>
    </div>

    <div class="row content-section">
      <div class="whitey">
        <table id="tickets_table" class="table table-striped tablesorter text-center">
          <thead>
            <tr>
              <th class=""> SR NO. </th>
              <th class=""> TITLE </th>
              <th class=""> IMAGE </th>
              <!-- <th class=""> DESCRIPTION </th> -->
              <th class=""> STATUS </th>
              <th class=""> URL </th>
              <th class=""> DATE </th>
              <th class=""> ACTIONS </th>
            </tr>
          </thead>

          <tbody>
          	<!-- data from ajax -->

          	<tr class="ticket-item" data-id="">
          	  <td class="sr_no"> 1 </td>
          	  <td class="title"> title </td>
          	  <td class="image"> <img src='http://placehold.it/200x200' alt =""> </td>
          	  <td class="status"> status</td>
          	  <td class="url"> url </td>
          	  <td class="dated"> dated</td>
          	  <td class="actions">
          	    <button type="button" class="tic-view-button" data-id="">VIEW</button>
          	    <button type="button" class="tic-edit-button" data-id="">EDIT</button>
          	    <button type="button" class="tic-delete-button" data-id="">DELETE</button>
          	  </td>
          	  <td class="description" style="display:none; "> description </td>
          	</tr>

          </tbody>          
        </table>

        <div id="grand_ouput" class="">
          <!-- ajax content populates here -->
        </div>
      </div>
    </div>


</div>  
<!-- /content-wrapper -->

<!-- modal window html -->
<div class="modal">
  <div class="box">
	  <form id="update_ticket_form" name="" action="" method="POST" enctype="multipart/form-data">
	    <div class="close-btn">X</div>
	    <h3 class="title">Modal Title</h3>
	  	<div class="modal-space ticket-item" data-id="">
		    <span class="status"> status </span> 
		    <span class="dated"> dated </span><br clear="all">
		    <p class="image"> <img src='http://placehold.it/200x200' alt =""> </p>
		    <p class="description"> description </p>
		    <span class="url"> url </span>
		    <span class="center ajax-loader updater" style="display:none;">
          <img src="img/modal-loader.gif" alt="Loading">
        </span>
	  	</div>
		</form>
  </div>
</div>

<!-- Plugins -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<!-- <script src="js/add_desh.js"></script>  -->
<script src="js/jquery.tablesorter.min.js"></script>

<script>
$(document).ready(function(){

  // Essentials
  $(".datepickery").datepicker();
  // $(".tablesorter").tablesorter();

  // load tickets function
  loadTickets();

  /* Modal window script */
  $("div.modal").hide();
  $("div.close-btn").click(function(){
    $("div.modal").fadeOut(300);

    $('.modal .box input, .modal .box textarea, .modal .box .modal-space div').remove();
  });

  //ON GET REPORT BuTTon
  $("#ticket_submit_btn").on("click", function(e){
    e.preventDefault();
    
    var $form  = $('#service_ticket_form'),
      formData = new FormData(),
      params   = $form.serializeArray(),
      files    = $form.find('[name="tic_file"]')[0].files;

    $.each(files, function(i, file) {
      formData.append('tic_file', file);
    });

    $.each(params, function(i, val) {
      formData.append(val.name, val.value);
    });

    //set action
    formData.append('initilize_action', 'new_ticket');

    $(".ajax-loader").show();
    $(".ajax_form_output").slideUp();

    $("#grand_ouput").html("");

    //the main ajax
    $.ajax({
      type: "POST",
      url: "https://www.localservicebrands.com/admin_lsbs/ajax/service_ticket.php",
      data: formData,
      processData: false,
      contentType: false,
      success: function(data){
        // var obj = jQuery.parseJSON(data);
        console.log("AJAX SUCCESS: ");
        $(".ajax_form_output p").html(data);
        $(".ajax_form_output").slideDown();
      },
      error: function(err){
        console.log("Ajax Error: "+err);
      },
      complete: function(){
        console.log("Ajax Completed!");
        $(".ajax-loader").hide();
      }
    });

  });

  //ON GET REPORT BuTTon
  $("#tickets_table").on("click", ".tic-view-button", function(e){
    e.preventDefault();
    var getthis = $(this).attr('data-id');
    var gettr = $(this).closest('tr.ticket-item');

    var title = gettr.find('.title');
    var image = gettr.find('.image');
    var description = gettr.find('.description');
    var status = gettr.find('.status');
    var url = gettr.find('.url');
    var dated = gettr.find('.dated');

    /* Text to input in modal */
    $('.modal .box').find('.title').html( title.text() );
    $('.modal .box').find('.status').html( status.text() );
    $('.modal .box').find('.dated').html( dated.text() );
    $('.modal .box').find('.description').html( description.text() );
    $('.modal .box').find('.url').html( url.text() );
    $('.modal .box').find('.image').html( image.html() );
    $('.modal').show();
    
  });

  //ON EDIT BTN CLICK
  $("#tickets_table").on("click", ".tic-edit-button", function(e){

  	e.preventDefault();
  	var getthis = $(this).attr('data-id');
  	var gettr = $(this).closest('tr.ticket-item');

  	var title = gettr.find('.title');
  	var image = gettr.find('.image');
  	var description = gettr.find('.description');
  	var status = gettr.find('.status');
  	var url = gettr.find('.url');
  	var dated = gettr.find('.dated');

  	/* Text to input in modal */
  	$('.modal .box').find('.title').html( title.text() );
  	$('.modal .box').find('.status').html( status.text() );
  	$('.modal .box').find('.dated').html( dated.text() );
  	$('.modal .box').find('.description').html( description.text() );
  	$('.modal .box').find('.url').html( url.text() );
  	$('.modal .box').find('.image').html( image.html() );
  	$('.modal').show();

  	var btn_id = $(this).attr("data-id");
  	var this_row = $(this).closest("tr.ticket-item");
  	var this_modal = $('.modal .box');
    // this_row.addClass("editing");
  	console.log("This Btn is for id: "+btn_id);

		var title       = this_modal.find(".title");
		var image       = this_modal.find(".image");
		var status      = this_modal.find(".status");
		var url         = this_modal.find(".url");
		var dated       = this_modal.find(".dated");
		var description = this_modal.find(".description");

		title.after("<input name='tic_upd_title' type='text' value='"+title.html()+"'>");
		image.append("<input name='tic_upd_image' type='file' value=''>");
		status.append("<input name='tic_upd_status' type='text' value='"+status.html()+"'>");
		url.append("<input name='tic_upd_url' type='text' value='"+url.html()+"'>");
		dated.append("<input name='tic_upd_datepicker' type='text' class='datepickery' value='"+dated.html()+"'>");
		description.append("<textarea name='tic_upd_description'>"+description.html()+"</textarea>");

		url.after("<div><button type='button' class='btn btn-default red tic-save-button' data-id='"+btn_id+"'>SAVE</button></div>");

  });

  //ON SAVE BTN CLICK
  $(".modal-space").on("click", ".tic-save-button", function(e){
  	e.preventDefault();

  	var btn_id = $(this).attr("data-id");  	
  	console.log("AJAX tic-save-button: "+btn_id);

  	var $form  = $('#update_ticket_form'),
  	  formData = new FormData(),
  	  params   = $form.serializeArray(),
  	  files    = $form.find('[name="tic_upd_image"]')[0].files;

  	$.each(files, function(i, file) {
  	  formData.append('tic_upd_image', file);
  	});

  	$.each(params, function(i, val) {
  	  formData.append(val.name, val.value);
  	});

  	//set action
  	formData.append('initilize_action', 'update_ticket');
  	formData.append('ticket_id', btn_id);

  	$(".ajax-loader.updater").show();

  	//the main ajax
  	$.ajax({
  	  type: "POST",
  	  url: "https://www.localservicebrands.com/admin_lsbs/ajax/service_ticket.php",
  	  data: formData,
  	  processData: false, // important for file upload
  	  contentType: false, // important for file upload
  	  success: function(data){
  	    // var obj = jQuery.parseJSON(data);
  	    console.log("AJAX SUCCESS: "+data);
  	  },
  	  error: function(err){
  	    console.log("Ajax Error: "+err);
  	  },
  	  complete: function(){
  	    console.log("Ajax Completed!");
  	    $(".ajax-loader.updater").hide();

  	    $("div.modal").fadeOut(300);
  	    $('.modal .box input, .modal .box textarea, .modal .box .modal-space div').remove();
  	  }
  	});


  });

  //ON CANCEL BTN CLICK
  $("#tickets_table").on("click", ".tic-delete-button", function(){

    var this_row = $(this).closest("tr");
    var btn_id = $(this).attr("data-id");
    var confirmer = confirm("Are you sure you want to delete this ticket?");

    //the main ajax
    if(confirmer){
    	console.log("trying to delete ticket!");
	    $.ajax({
	      type: "POST",
	      url: "https://www.localservicebrands.com/admin_lsbs/ajax/service_ticket.php",
	      data: {
	        'initilize_action': 'delete_ticket',
	        'ticket_id': btn_id
	      },
	      success: function(data){
	        // var obj = jQuery.parseJSON(data);
	        console.log("AJAX SUCCESS: "+ data);
	        this_row.html('<td colspan="7">'+data+'</td>');
	      },
	      error: function(err){
	        console.log("Ajax Error: "+err);
	      },
	      complete: function(){
	        console.log("Ajax Completed!");
	        // $(".ajax-loader").hide();
	      }
	    });    	
    }

  });

});


function loadTickets(){

  $("#tickets_table tbody").html("");

  //the main ajax
  $.ajax({
    type: "POST",
    url: "https://www.localservicebrands.com/admin_lsbs/ajax/service_ticket.php",
    data: {
      'initilize_action': 'load_tickets'
    },
    // processData: false,
    // contentType: false,
    success: function(data){
      // var obj = jQuery.parseJSON(data);
      // console.log("AJAX SUCCESS: "+ data);
      $("#tickets_table tbody").html(data);
    },
    error: function(err){
      console.log("loadTickets Error: "+err);
    },
    complete: function(){
      console.log("loadTickets Completed!");
      // $(".ajax-loader").hide();
    }
  });

}

</script>



<footer>
  <!-- footer content -->
</footer>

<!-- Moved to header -->
<!--
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="js/bootstrap.js"></script>
  <script src="js/main.js"></script> 
  -->
  
</body>
</html>

<?php mysqli_close($con);?>

