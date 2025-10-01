<?php
/**
 * Template Name: Report page
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); 

//getting the role and setting accordingly
if ($GLOBALS['currentRole'] == "administrator"){
  //echo "the ADMIN";
}
elseif ($GLOBALS['currentRole'] == "client") {
  $isClient = true;
  //echo "Client";
}
elseif ($GLOBALS['currentRole'] == "customer") {
  $isCustomer = true;
  //echo "Customer";
}
else{
  //echo "Other";
}

wp_enqueue_script('jquery-ui-datepicker');
wp_enqueue_style('jquery-style', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/jquery-ui.css');
?>

<style>
tr th.header{
  text-align: center;
  border-right: 1px solid rgb(238, 238, 238);
  font-weight: bold;
}
tr th.header.widest{
  width:30% !important;
}
tr th.header.wider{
  width:25% !important;
}

/*PAGINATION STYLE*/
.mini-pagination{
  text-align: right;
  padding: 6px 0px;
}
.mini-pagination > a {
  background: #DCDCDC;
  border: 1px solid #B7B7B7;
  display: inline-block;
  margin-left: 6px;
  margin-bottom: 6px;
  padding: 3px 6px;
  text-align: right;
}
.mini-pagination > a:hover {
  background: #D4D4D4;
  text-decoration: none;
}
.print-btn, .export-btn{
  text-decoration:none;
  color:#000;
  background-color:#ddd;
  border:1px solid #ccc;
  padding:8px;
  margin-top: 16px;
}
.print-btn:hover, .export-btn:hover{
  background-color:#D0D0D0;
}
</style>

<section id="content">
  <div class="container_12">
    <div class="wrapper">
      <article class="grid_4">
        <div class="box-1">
          <?php if(is_page('19')){ ?>
          <h3 class="head-1 hp-1"><em class="heading-row-2">Mailing Address:</em></h3>
          Precise Financial Group, LLC
          5005 W. 81st Place, Suite 401
          Westminster, CO 80031 <br>
          <br>
          <h3 class="head-1 hp-1"><em class="heading-row-2">Call:</em></h3>
          Toll-free:  888-314-3633
          Fax:  303-487-3839 <br>
          <br>
          Business hours are Monday - Thursday, 9:00 a.m. to 5:30 p.m.,
          and Friday 9:00 a.m. to 5:00 p.m., MST <br>
          <br>
          <h3 class="head-1 hp-1"><em class="heading-row-2">Email:</em></h3>
          info@precisefinancialgroup.com
          <?php }else{ ?>
          <h3 class="head-1 hp-1"><em class="heading-row-2">Helpful Links</em></h3>
          <ul>
            <?php
              if (is_user_logged_in() ) {
                echo  '<li><a href="'.wp_logout_url( get_permalink() ).'"><span><img src="'.get_template_directory_uri().'/images/img4.png" /></span> Log Out</a></li>';
              }
              else if (!is_user_logged_in() ) {
                echo  '<li><a href="https://www.precisefinancialgroup.com/my-account/"><span><img src="'.get_template_directory_uri().'/images/img4.png" /></span> Client Login</a></li>';
              }
              if (is_user_logged_in() ) {
                echo '<li><a href="https://www.precisefinancialgroup.com/h/"><span><img src="'.get_template_directory_uri().'/images/board.png" /></span> Report</a></li>';
                if($isCustomer){
                  echo '<li><a href="https://www.precisefinancialgroup.com/payment"><span><img src="'.get_template_directory_uri().'/images/img5.png" /></span> Make A Payment</a></li>';
                }
              }
              ?>
            <!-- <li><a href=""><span><img src="<?php echo get_template_directory_uri(); ?>/images/img5.png" /></span> Make A Payment</li> -->
            <li><a href="https://www.precisefinancialgroup.com/contact/"><span><img src="<?php echo get_template_directory_uri(); ?>/images/img3.png" /></span> Contact Us</a></li>
          </ul>
          <?php } ?>
          <img src="https://www.precisefinancialgroup.com/wp-content/uploads/2015/12/TransUn.jpg" alt="transunit" class="transunit" />
        </div>
      </article>
      <article class="grid_8">
        <div class="box-1">
          <?php  if (is_user_logged_in() ) { 
                $serverName = "184.168.194.68"; //serverName\instanceName
                $connectionInfo = array( "Database"=>"PFGllc", "UID"=>"Client", "PWD"=>"N92#tny7");
                $conn = sqlsrv_connect( $serverName, $connectionInfo);

                if( $conn ) {
                  //echo "Connection established.<br />";
                }else{
                  echo "Connection could not be established.<br />";
                  die( print_r( sqlsrv_errors(), true));
                }

              ?>
          <form class="report-form" method="GET" >
            <fieldset class="main_select">
              <label>Select</label>
              <select name="query_name">
                <!-- <option value="report_ac_d_amount" <?php if($_GET['query_name']=='report_ac_d_amount'){ echo 'selected';} ?>>Report of Name, Account Number, Date Of Payment and Amount</option> -->

                <!-- <option value="report_paid_agency" <?php if($_GET['query_name']=='report_paid_agency'){ echo 'selected';} ?>>Report Of Amount Paid To Agency</option> -->

                <!-- <option value="report_paid_client" <?php if($_GET['query_name']=='report_paid_client'){ echo 'selected';} ?>>Report Of Amount Paid To Client</option> -->

                <!-- <option value="report_commission" <?php if($_GET['query_name']=='report_commission'){ echo 'selected';} ?>>Report Of Commissions Due Agency For Each Payment</option> -->

                <!-- <option value="report_amount_due_client" <?php if($_GET['query_name']=='report_amount_due_client'){ echo 'selected';} ?>>Report Of Total Amount Due Client And/Or Agency</option> -->

                <!-- <option value="report_amt_transfer" <?php if($_GET['query_name']=='report_amt_transfer'){ echo 'selected';} ?>>Report Of Dollar Amount and Number Of Accounts Transferred To Agency Each Month For The Past Thirteen Months</option> -->

                <!-- <option value="report_monthly_collection" <?php if($_GET['query_name']=='report_monthly_collection'){ echo 'selected';} ?>>Report Of Payment Count and Monthly Collection Activity In Dollar Amounts</option> -->

                <!-- <option value="report_recovery_acc_collection" <?php if($_GET['query_name']=='report_recovery_acc_collection'){ echo 'selected';} ?>>Report Of Net Recovery Percentage Of All Accounts Placed For Collection</option> -->

                <!-- <option value="report_fees_retained" <?php if($_GET['query_name']=='report_fees_retained'){ echo 'selected';} ?>>Report Of Fees Retained On Dollar Amounts Recovered</option> -->

                <!-- <option value="report_debtors_name" <?php if($_GET['query_name']=='report_debtors_name'){ echo 'selected';} ?>>Report Of Debtor's Name And Account Number</option> -->

                <!-- <option value="report_balance_date_collection" <?php if($_GET['query_name']=='report_balance_date_collection'){ echo 'selected';} ?>>Report Of Initial Balance And Date Placed For Collection</option> -->

                <!-- <option value="report_current_ac_bal" <?php if($_GET['query_name']=='report_current_ac_bal'){ echo 'selected';} ?>>Report Of Current Account Balance</option> -->

                <!-- <option value="report_status_account" <?php if($_GET['query_name']=='report_status_account'){ echo 'selected';} ?>>Report Of Current Status Of Account</option> -->

                <!-- new reports -->
                <option value="report_accounting_recovery" <?php if($_GET['query_name']=='report_accounting_recovery'){ echo 'selected';} ?>>Client Accounting Report and Recovery Rate</option>

                <option value="report_current_month" <?php if($_GET['query_name']=='report_current_month'){ echo 'selected';} ?>>Client Payment Report for Current Month</option>

                <option value="report_debtors_inventory" <?php if($_GET['query_name']=='report_debtors_inventory'){ echo 'selected';} ?>>Debtor Inventory Report</option>

                <option value="report_closed_inventory" <?php if($_GET['query_name']=='report_closed_inventory'){ echo 'selected';} ?>>Closed Inventory Report</option>

              </select>
            </fieldset>
            <fieldset style="display:none;">
              <label>Search By Query</label>
              <input type="text" <?php echo 'value="'.$_GET['input_query'].'"';?> name="input_query">
            </fieldset>
            <!-- date range hidden -->
<!--             <fieldset id='from-date'>
              <label class="date">From</label>
              <input type="hidden" name="start_date" <?php echo 'value="'.$_GET['start_date'].'"';?> class="MyDate_f">
                <input type="text" name="f_start_date" <?php echo 'value="'.$_GET['f_start_date'].'"';?> class="MyDate">
              </fieldset>
              <fieldset id='to-date'>
              <label class="date">To</label>
              <input type="hidden" name="end_date" <?php echo 'value="'.$_GET['end_date'].'"';?> class="MyDate1_f ">
                <input type="text" name="f_end_date" <?php echo 'value="'.$_GET['f_end_date'].'"';?> class="MyDate1 ">
            </fieldset> -->
            <?php
              //getting required id
              $user_id= get_current_user_id();
              $sql = "SELECT ClientID FROM dbo.Clients WHERE wpID = '$user_id' ";
              $stmt = sqlsrv_query( $conn, $sql );
              if( $stmt === false) {
                echo "connection failed!";
                die( print_r( sqlsrv_errors(), true) );
              }
              while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
                $user_id= $row['ClientID'];
              }

              // For the packages report_accounting_recovery
              $sql= " SELECT Package FROM PFGrem.package WHERE ClientID='$user_id' GROUP BY Package";
              $stmt = sqlsrv_query( $conn, $sql );
              if( $stmt === false) {
                die( print_r( sqlsrv_errors(), true) );
              }
              echo "<fieldset class='package-select' style='display:none'> <label> Package </label> <select name='package_select'>";
              echo "<option>Show All</option>";
              while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) { 
                echo "<option>". $row['Package'] ."</option>";
              }
              echo "</select> </fieldset>";

              //For the months report_current_month
              $sql= " SELECT DISTINCT DATENAME(MONTH, CheckDate) AS month,  YEAR(CheckDate) AS year FROM PFGrem.Payments WHERE CheckDate IS NOT NULL ORDER BY year DESC";
              $stmt = sqlsrv_query( $conn, $sql );
              if( $stmt === false) {
                die( print_r( sqlsrv_errors(), true) );
              }
              echo "<fieldset class='month-select' style='display:none'> <label> Month </label> <select name='month_select'>";
              echo "<option>Current Month</option>";
              while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) { 
                echo "<option>". $row['month'] ." - ". $row['year'] ."</option>";
              }
              echo "</select> </fieldset>";
            ?>

            <button class="report-search">Search</button>
          </form>
          <br />
          <br />
          <?php if ($_SERVER["REQUEST_METHOD"] == "GET") 
            {
              $label = $_GET['query_name'];
              switch($label){
                case 'report_ac_d_amount':
                 echo '<span class="table_title">Report of Name, Account Number, Date of Payment and Amount</span>';
                break;
                case 'report_paid_agency':
                  echo '<span class="table_title">Report Of Amount Paid To Agency</span>';
                break;
                case 'report_paid_client':
                  echo '<span class="table_title">Report Of Amount Paid To Client</span>';
                break;
                case 'report_commission':
                  echo '<span class="table_title">Report Of Commission</span>';
                break;
                case 'report_amount_due_client':
                  echo '<span class="table_title">Report Of Amount Due Client And/Or Agency</span>';
                break;
                case 'report_amt_transfer':
                  echo '<span class="table_title">Report Of Amount Transfer (Last 13 Months)</span>';
                break;
                case 'report_monthly_collection':
                  echo '<span class="table_title">Report Of Monthly Collection</span>';
                break;
                case 'report_recovery_acc_collection':
                  echo '<span class="table_title">Report Of Recovery Account Collection</span>';
                break;
                case 'report_fees_retained':
                  echo '<span class="table_title">Report Of Fees Retained</span>';
                break;
                case 'report_debtors_name':
                  echo '<span class="table_title">Report Of Debtors Name</span>';
                break;
                case 'report_balance_date_collection':
                  echo '<span class="table_title">Report Of Initial Balance And Date Placed For Collection</span>';
                break;
                case 'report_current_ac_bal':
                  echo '<span class="table_title">Report Of Current Account Balance</span>';
                break;
                case 'report_status_account':
                  echo '<span class="table_title">Report Of Current Status Of Account</span>';
                break;
                //new reports
                case 'report_accounting_recovery':
                  echo '<span class="table_title"> Client Accounting Report and Recovery Rate </span>';
                break;
                case 'report_current_month':
                  echo '<span class="table_title"> Client Payment Report for Current Month </span>';
                break;
                case 'report_debtors_inventory':
                  echo '<span class="table_title"> Debtor Inventory Report </span>';
                break;
                case 'report_closed_inventory':
                  echo '<span class="table_title"> Closed Inventory Report </span>';
                break;
              }
            } ?>
        <div>
          <table class="report-grid">
            <thead>
              <?php if($label=='report_ac_d_amount'){?>
              <tr style="border: 1px solid rgb(238, 238, 238);">
                <th class="header"><?php echo 'ID';?></th>
                <th class="header"><?php echo 'Client ID';?></th>
                <th class="header"><?php echo 'Customer CustID';?></th>
                <th class="header"><?php echo 'Customer Name';?></th>
                <th class="header"><?php echo '$'.'Amount';?></th>
                <th class="header"><?php echo 'Date';?></th>
              </tr>
              <?php }else if($label=='report_paid_agency'){ ?>
              <tr style="border: 1px solid rgb(238, 238, 238);">
                <th class="header"><?php echo 'ID';?></th>
                <th class="header"><?php echo '$'.'Amount Paid Agency';?></th>
                <th class="header"><?php echo 'Date';?></th>
              </tr>
               <?php }else if($label=='report_paid_client'){ ?>
              <tr style="border: 1px solid rgb(238, 238, 238);">
                <th class="header"><?php echo 'ID';?></th>
                <th class="header"><?php echo '$'.'Amount Paid Client';?></th>
                <th class="header"><?php echo 'Date';?></th>
              </tr>
              <?php }else if($label=='report_commission'){ ?>
              <tr style="border: 1px solid rgb(238, 238, 238);">
                <th class="header"><?php echo 'ID';?></th>
                <th class="header"><?php echo 'Commissions Due Agency';?></th>
                <th class="header"><?php echo 'Date';?></th>
              </tr>
              <?php }else if($label=='report_amount_due_client'){ ?>
              <tr style="border: 1px solid rgb(238, 238, 238);">
                <th class="header"><?php echo 'ID';?></th>
                <th class="header"><?php echo '$'.'Amount Due';?></th>
                <th class="header"><?php echo 'Date';?></th>
              </tr>
              <?php }else if($label=='report_amt_transfer'){ ?>
              <tr style="border: 1px solid rgb(238, 238, 238);">
                <th class="header"><?php echo 'ID';?></th>
                <th class="header"><?php echo 'Year';?></th>
                <th class="header"><?php echo 'Month';?></th>
                <th class="header"><?php echo 'Accounts Transferred';?></th>
                <th class="header"><?php echo '$'.'Total Balance';?></th>
              </tr>
              <?php }else if($label=='report_monthly_collection'){ ?>
              <tr style="border: 1px solid rgb(238, 238, 238);">
                <th class="header"><?php echo 'ID';?></th>
                <th class="header"><?php echo 'Year';?></th>
                <th class="header"><?php echo 'Month';?></th>
                <th class="header"><?php echo 'Payments (AmtPaidAgency)';?></th>
                <th class="header"><?php echo '$'.'Total Amount';?></th>                
              </tr>
              <?php }else if($label=='report_recovery_acc_collection'){ ?>
              <tr style="border: 1px solid rgb(238, 238, 238);">
                <th class="header"><?php echo 'ID';?></th>
                <th class="header"><?php echo '$'.'Total Amount';?></th>
                <th class="header"><?php echo '$'.'Collected Amount';?></th>
                <th class="header"><?php echo 'Progress';?></th>
              </tr>
              <?php }else if($label=='report_fees_retained'){ ?>
              <tr style="border: 1px solid rgb(238, 238, 238);">
                <th class="header"><?php echo 'ID';?></th>
                <th class="header"><?php echo '$'.'Amount Recovered ';?></th>
                <th class="header"><?php echo 'Date';?></th>
              </tr>
              <?php }else if($label=='report_debtors_name'){ ?>
              <tr style="border: 1px solid rgb(238, 238, 238);">
                <th class="header"><?php echo 'ID';?></th>
                <th class="header"><?php echo 'Debtors-Name';?></th>
                <th class="header"><?php echo 'Account <br>Number';?></th>
                <th class="header"><?php echo 'Date';?></th>
              </tr>
              <?php }else if($label=='report_balance_date_collection'){ ?>
              <tr style="border: 1px solid rgb(238, 238, 238);">
                <th class="header"><?php echo 'ID';?></th>
                <th class="header"><?php echo 'Date Placed';?></th>
                <th class="header"><?php echo '$'.'Balance';?></th>
                <th class="header"><?php echo 'Date';?></th>
              </tr>
              <?php }else if($label=='report_current_ac_bal'){ ?>
              <tr style="border: 1px solid rgb(238, 238, 238);">
                <th class="header"><?php echo 'ID';?></th>
                <th class="header"><?php echo 'Account Number';?></th>
                <th class="header"><?php echo '$'.'Account Balance';?></th>
                <th class="header"><?php echo 'Date';?></th>
              </tr>
              <?php }else if($label=='report_status_account'){ ?>
              <tr style="border: 1px solid rgb(238, 238, 238);">
                <th class="header"><?php echo 'ID';?></th>
                <th class="header"><?php echo 'Account Number';?></th>
                <th class="header"><?php echo 'Account Status';?></th>
                <th class="header"><?php echo 'Date';?></th>
              </tr>

              <!-- new reports -->
              <?php }else if($label=='report_accounting_recovery'){ ?>
              <tr style="border: 1px solid rgb(238, 238, 238);">                
                <th class="header widest"><?php echo 'Package';?></th>
                <th class="header"><?php echo 'Total Number of Accounts';?></th>
                <th class="header"><?php echo 'Total Principle Amount Placed';?></th>
                <th class="header"><?php echo 'Current Balance';?></th>
                <th class="header"><?php echo 'Total Payments Received';?></th>
                <th class="header"><?php echo 'Total Paid Client';?></th>
                <th class="header"><?php echo 'Total Paid Agency';?></th>
                <th class="header"><?php echo 'Recovery Rate';?></th>
              </tr>
              <?php }else if($label=='report_current_month'){ ?>
              <tr style="border: 1px solid rgb(238, 238, 238);">
                <th class="header"><?php echo 'Acct #';?></th>
                <th class="header"><?php echo 'Cust ID';?></th>
                <th class="header widest"><?php echo 'Debtor Name';?></th>
                <th class="header"><?php echo 'Date';?></th>
                <th class="header"><?php echo 'Amount';?></th>
                <th class="header"><?php echo 'Fee Rate';?></th>
                <th class="header"><?php echo 'Agency Fee';?></th>
                <th class="header"><?php echo 'Client Fee';?></th>
                <th class="header wider"><?php echo 'Package Status';?></th>
              </tr>
              <?php }else if($label=='report_debtors_inventory'){ ?>
              <tr style="border: 1px solid rgb(238, 238, 238);">
                <th class="header"><?php echo 'Acct #';?></th>
                <th class="header"><?php echo 'CustomerID ';?></th>
                <th class="header widest"><?php echo 'Debtors Name ';?></th>
                <th class="header"><?php echo 'Principle Amount';?></th>
                <th class="header"><?php echo 'Current Balance';?></th>
                <th class="header wider"><?php echo 'Current Status ';?></th>
                <th class="header wider"><?php echo 'Last Call Date';?></th>
              </tr>
              <?php }else if($label=='report_closed_inventory'){ ?>
              <tr style="border: 1px solid rgb(238, 238, 238);">
                <th class="header"><?php echo 'Acct #';?></th>
                <th class="header"><?php echo 'CustomerID ';?></th>
                <th class="header widest"><?php echo 'Debtors Name ';?></th>
                <th class="header"><?php echo 'Current Balance';?></th>
                <th class="header wider"><?php echo 'Current Status';?></th>
              </tr>
              <?php }?>
            </thead>
            <tbody>

              <?php
              $op_action = $_GET['query_name'];
              $user_id= get_current_user_id();
              //for money format
              // setlocale(LC_MONETARY, 'en_US.UTF-8');

              $sql = "SELECT ClientID FROM dbo.Clients WHERE wpID = '$user_id' ";
              $stmt = sqlsrv_query( $conn, $sql );
              if( $stmt === false) {
                echo "connection failed!";
                die( print_r( sqlsrv_errors(), true) );
              }       
              while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
                echo "ClientID: ". $row['ClientID'];
                $user_id= $row['ClientID'];
              }

              
              
              switch($op_action){
                case 'report_ac_d_amount':
                  if(!empty($_GET['start_date']) && !empty($_GET['end_date'])){
                    $start_date =date('Y-m-d',strtotime($_GET['start_date']));
                    $end_date =date('Y-m-d',strtotime($_GET['end_date']));
                    $query_dates = "AND (CSdt BETWEEN '".$start_date."' AND '".$end_date."')";
                  }else{
                    $query_dates=' ';
                  }
                  $sql = "SELECT TOP (50) PayID, ClientID, CScustid, CSfname, CSamount, CSdt FROM dbo.Pinfo WHERE ClientID = '$user_id' ".$query_dates;
                  $stmt = sqlsrv_query( $conn, $sql );
                  if( $stmt === false) {
                      die( print_r( sqlsrv_errors(), true) );
                  }       
                  while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) { ?>
                  <tr class="">
                    <td><?php echo $row['PayID']; ?></td>
                    <td><?php echo $row['ClientID']; ?></td>
                    <td><?php echo $row['CScustid'];?></td>
                    <td><?php echo $row['CSfname'];?></td>
                    <td><?php echo '$'.round($row['CSamount'], 2); ?></td>
                    <td><?php echo date_format($row['CSdt'],'F j, Y');?></td>
                  </tr><?php
                  }/*sqlsrv_free_stmt( $stmt);*/
                break;
                case 'report_paid_agency':
                  if(!empty($_GET['start_date']) && !empty($_GET['end_date'])){
                    $start_date =date('Y-m-d',strtotime($_GET['start_date']));
                    $end_date =date('Y-m-d',strtotime($_GET['end_date']));
                    $query_dates = "AND (AmtPaidDate BETWEEN '".$start_date."' AND '".$end_date."')";
                  }else{
                    $query_dates=' ';
                  }
                  $sql = "SELECT TOP (50) ClientID, AmtPaidAgency, AmtPaidDate FROM PFGrem.Payments  WHERE ClientID = '$user_id' ".$query_dates;
                  $stmt = sqlsrv_query( $conn, $sql );
                  if( $stmt === false) {
                    die( print_r( sqlsrv_errors(), true) );
                  }         
                  while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) { ?>
                  <tr class="">
                    <td><?php echo $row['ClientID'];?></td>
                    <td><?php echo '$'.$row['AmtPaidAgency'];?></td>
                    <td><?php echo date_format($row['AmtPaidDate'],'F j, Y');?></td>
                  </tr><?php
                  }/*sqlsrv_free_stmt( $stmt);*/
                break;
                case 'report_paid_client':
                  if(!empty($_GET['start_date']) && !empty($_GET['end_date'])){
                    $start_date =date('Y-m-d',strtotime($_GET['start_date']));
                    $end_date =date('Y-m-d',strtotime($_GET['end_date']));
                    $query_dates = "AND (AmtPaidDate BETWEEN '".$start_date."' AND '".$end_date."')";
                  }else{
                    $query_dates=' ';
                  }
                  $sql = "SELECT TOP (50) ClientID, AmtPaidClient, AmtPaidDate FROM PFGrem.Payments WHERE ClientID = '$user_id' ".$query_dates;
                  $stmt = sqlsrv_query( $conn, $sql );
                  if( $stmt === false) {
                      die( print_r( sqlsrv_errors(), true) );
                  }         
                  while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) { ?>
                  <tr class="">
                    <td><?php echo $row['ClientID'];?></td>
                    <td><?php echo '$'.$row['AmtPaidClient'];?></td>
                    <td><?php echo date_format($row['AmtPaidDate'],'F j, Y');?></td>
                  </tr><?php
                  }/*sqlsrv_free_stmt( $stmt);*/
                break;
                 case 'report_commission':
                 if(!empty($_GET['start_date']) && !empty($_GET['end_date'])){
                    $start_date =date('Y-m-d',strtotime($_GET['start_date']));
                    $end_date =date('Y-m-d',strtotime($_GET['end_date']));
                    $query_dates = "AND (CSdt BETWEEN '".$start_date."' AND '".$end_date."')";
                  }else{
                    $query_dates=' ';
                  }
                  $sql = "SELECT TOP (50) ClientID, Comm, CSdt FROM dbo.Pinfo WHERE ClientID = '$user_id' ".$query_dates;
                  $stmt = sqlsrv_query( $conn, $sql );
                  if( $stmt === false) {
                      die( print_r( sqlsrv_errors(), true) );
                  }         
                  while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) { ?>
                  <tr class="">
                    <td><?php echo $row['ClientID'];?></td>
                    <td><?php echo $row['Comm'];?></td>
                    <td><?php echo date_format($row['CSdt'],'F j, Y');?></td>
                  </tr><?php
                  }/*sqlsrv_free_stmt( $stmt);*/
                break;
                case 'report_amount_due_client':
                if(!empty($_GET['start_date']) && !empty($_GET['end_date'])){
                    $start_date =date('Y-m-d',strtotime($_GET['start_date']));
                    $end_date =date('Y-m-d',strtotime($_GET['end_date']));
                    $query_dates = "AND (AmtPaidDate BETWEEN '".$start_date."' AND '".$end_date."')";
                  }else{
                    $query_dates=' ';
                  }
                  $sql = "SELECT TOP (50) ClientID, AmtDueClient, AmtPaidDate FROM PFGrem.Payments WHERE ClientID = '$user_id' ".$query_dates;
                  $stmt = sqlsrv_query( $conn, $sql );
                  if( $stmt === false) {
                      die( print_r( sqlsrv_errors(), true) );
                  }         
                  while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) { ?>
                  <tr class="">
                    <td><?php echo $row['ClientID'];?></td>
                    <td><?php echo '$'.$row['AmtDueClient'];?></td>
                    <td><?php echo date_format($row['AmtPaidDate'],'F j, Y');?></td>
                  </tr><?php
                  }/*sqlsrv_free_stmt( $stmt);*/
                break;
                case 'report_amt_transfer':
                $gid1 = 1;
                if(!empty($_GET['start_date']) && !empty($_GET['end_date'])){
                    $start_date =date('Y-m-d',strtotime($_GET['start_date']));
                    $end_date =date('Y-m-d',strtotime($_GET['end_date']));
                    $query_dates = "AND (AmtPaidDate BETWEEN '".$start_date."' AND '".$end_date."')";
                  }else{
                    $query_dates=' ';
                  }
                  $sql = "SELECT 
                            SUM(CONVERT(float, Balance)) AS [sumBalance], 
                            COUNT(*) as [totalCount],
                            DATENAME(month, CSdt) AS [Month], 
                            DATENAME(year, CSdt) AS [Year]
                          FROM dbo.PInfo
                          WHERE ClientID = '$user_id' and CSdt >= DATEADD(m, -13, convert(date, convert(varchar(6), getdate(),112) + '01'))
                          GROUP BY DATENAME(month, CSdt), DATENAME(year, CSdt)";
                  
                  $stmt = sqlsrv_query( $conn, $sql );
                  if( $stmt === false) {
                      die( print_r( sqlsrv_errors(), true) );
                  }
                  while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) { ?>
                  <tr class="">
                    <td><?php echo $gid1; ?></td>
                    <td><?php echo $row['Year'];?></td>
                    <td><?php echo $row['Month'];?></td>
                    <td><?php echo $row['totalCount'];?></td>
                    <td><?php echo '$'.$row['sumBalance'];?></td>
                  </tr><?php
                  $gid1++;
                  }/*sqlsrv_free_stmt( $stmt);*/

                  //Extra query for GRAND TOTAL
                  $sql_grand= "SELECT SUM(CONVERT(float, Balance)) AS [grandBalance] FROM dbo.PInfo WHERE ClientID = '$user_id' and CSdt >= DATEADD(m, -13, convert(date, convert(varchar(6), getdate(),112) + '01')) ";
                  $stmt_grand = sqlsrv_query( $conn, $sql_grand );
                  if( $stmt_grand === false) {
                    die( print_r( sqlsrv_errors(), true) );
                  }
                  while( $row_grand = sqlsrv_fetch_array( $stmt_grand, SQLSRV_FETCH_ASSOC) ) { ?>
                  <tr class="tfoot" >
                    <td><?php echo ""; ?></td>
                    <td><?php echo ""; ?></td>
                    <td><?php echo ""; ?></td>
                    <td><?php echo "Grand Total" ?></td>
                    <td><?php echo "$".$row_grand['grandBalance'];?></td>
                  </tr><?php
                  }
                break;

                case 'report_monthly_collection':
                if(!empty($_GET['start_date']) && !empty($_GET['end_date'])){
                    $query_dates=' ';
                  }else{
                    $query_dates=' ';
                  }
                  $sql = "SELECT 
                            SUM(AmtPaidAgency) AS [paidAgency], 
                            COUNT(AmtPaidAgency) as [totalCount],
                            DATENAME(month, AmtPaidDate) AS [Month], 
                            DATENAME(year, AmtPaidDate) AS [Year]
                          FROM PFGrem.Payments
                          WHERE ClientID = '$user_id' and AmtPaidDate >= DATEADD(d, -30, convert(date, convert(varchar(6), getdate(),112) + '01'))
                          GROUP BY DATENAME(month, AmtPaidDate), DATENAME(year, AmtPaidDate)
                           ";
                  $stmt = sqlsrv_query( $conn, $sql );
                  if( $stmt === false) {
                    die( print_r( sqlsrv_errors(), true) );
                  }
                  $gid2 = 1;     
                  while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) { ?>
                  <tr class="">
                    <td><?php echo $gid2; ?></td>
                    <td><?php echo $row['Year'];?></td>
                    <td><?php echo $row['Month'];?></td>
                    <td><?php echo $row['totalCount'];?></td>               
                    <td><?php echo '$'.$row['paidAgency']."$";?></td>
                  </tr><?php
                  $gid2++;
                  }/*sqlsrv_free_stmt( $stmt);*/
                break;

                case 'report_recovery_acc_collection':
                $gid3 = 1;
                if(!empty($_GET['start_date']) && !empty($_GET['end_date'])){
                    $start_date =date('Y-m-d',strtotime($_GET['start_date']));
                    $end_date =date('Y-m-d',strtotime($_GET['end_date']));
                    $query_dates = "AND (AmtPaidDate BETWEEN '".$start_date."' AND '".$end_date."')";
                  }else{
                    $query_dates=' ';
                  }
                  $sql = "SELECT 
                            SUM(Balance) as [Balance],
                            SUM(CurBalance) as [curBalance],
                            ((SUM(CurBalance) / SUM(Balance))*100) as [Percentage]
                          FROM dbo.PInfo
                          WHERE ClientID = '$user_id' 
                  ";
                  $stmt = sqlsrv_query( $conn, $sql );
                  if( $stmt === false) {
                      die( print_r( sqlsrv_errors(), true) );
                  }         
                  while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) { ?>
                  <tr class="">
                    <td><?php echo $gid3; ?></td>
                    <td><?php echo '$'.round($row['Balance']."$", 2); ?></td>
                    <td><?php echo '$'.round($row['curBalance']."$", 2); ?></td>
                    <td><?php echo round($row['Percentage']."%", 2); ?></td>
                  </tr><?php
                  $gid3++;
                  }/*sqlsrv_free_stmt( $stmt);*/
                break;

                case 'report_fees_retained':
                if(!empty($_GET['start_date']) && !empty($_GET['end_date'])){
                    $start_date =date('Y-m-d',strtotime($_GET['start_date']));
                    $end_date =date('Y-m-d',strtotime($_GET['end_date']));
                    $query_dates = "AND (CSdt BETWEEN '".$start_date."' AND '".$end_date."')";
                  }else{
                    $query_dates=' ';
                  }
                  $sql = "SELECT TOP (50) ClientID, Fees, CSdt FROM dbo.Pinfo WHERE ClientID = '$user_id' ".$query_dates;
                  $stmt = sqlsrv_query( $conn, $sql );
                  if( $stmt === false) {
                      die( print_r( sqlsrv_errors(), true) );
                  }         
                  while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) { ?>
                  <tr class="">
                    <td><?php echo $row['ClientID'];?></td>
                    <td><?php echo '$'.round($row['Fees'], 2); ?></td>
                    <td><?php echo date_format($row['CSdt'],'F j, Y');?></td>
                  </tr><?php
                  }/*sqlsrv_free_stmt( $stmt);*/
                break;
                case 'report_debtors_name':
                if(!empty($_GET['start_date']) && !empty($_GET['end_date'])){
                    $start_date =date('Y-m-d',strtotime($_GET['start_date']));
                    $end_date =date('Y-m-d',strtotime($_GET['end_date']));
                    $query_dates = "AND (CSdt BETWEEN '".$start_date."' AND '".$end_date."')";
                  }else{
                    $query_dates=' ';
                  }
                  $sql = "SELECT TOP (50) ClientID,AccNumber, CSfname, CSdt FROM dbo.Pinfo WHERE ClientID = '$user_id' ".$query_dates;
                  $stmt = sqlsrv_query( $conn, $sql );
                  if( $stmt === false) {
                      die( print_r( sqlsrv_errors(), true) );
                  }         
                  while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) { ?>
                  <tr class="">
                    <td><?php echo $row['ClientID'];?></td>
                    <td><?php echo $row['CSfname'];?></td>
                    <td><?php echo $row['AccNumber'];?></td>
                    <td><?php echo date_format($row['CSdt'],'F j, Y');?></td>
                  </tr><?php
                  }/*sqlsrv_free_stmt( $stmt);*/
                break;
                case 'report_balance_date_collection':
                if(!empty($_GET['start_date']) && !empty($_GET['end_date'])){
                    $start_date =date('Y-m-d',strtotime($_GET['start_date']));
                    $end_date =date('Y-m-d',strtotime($_GET['end_date']));
                    $query_dates = "AND (CSdt BETWEEN '".$start_date."' AND '".$end_date."')";
                  }else{
                    $query_dates=' ';
                  }
                  $sql = "SELECT TOP (50) ClientID, DatePlaced, Balance, CSdt FROM dbo.Pinfo WHERE ClientID = '$user_id' ".$query_dates;
                  $stmt = sqlsrv_query( $conn, $sql );
                  if( $stmt === false) {
                      die( print_r( sqlsrv_errors(), true) );
                  }         
                  while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) { ?>
                  <tr class="">
                    <td><?php echo $row['ClientID'];?></td>
                    <td><?php if(!empty($row['DatePlaced'])){echo date_format($row['DatePlaced'],'F j, Y');}?></td>
                    <td><?php echo '$'.round($row['Balance'], 2);?></td>
                    <td><?php echo date_format($row['CSdt'],'F j, Y');?></td>
                  </tr><?php
                  }/*sqlsrv_free_stmt( $stmt);*/
                break;
                case 'report_current_ac_bal':
                if(!empty($_GET['start_date']) && !empty($_GET['end_date'])){
                    $start_date =date('Y-m-d',strtotime($_GET['start_date']));
                    $end_date =date('Y-m-d',strtotime($_GET['end_date']));
                    $query_dates = "AND (CSdt BETWEEN '".$start_date."' AND '".$end_date."')";
                  }else{
                    $query_dates=' ';
                  }
                  $sql = "SELECT TOP (50) ClientID, AccNumber,CurBalance , CSdt FROM dbo.Pinfo WHERE ClientID = '$user_id' ".$query_dates;
                  $stmt = sqlsrv_query( $conn, $sql );
                  if( $stmt === false) {
                      die( print_r( sqlsrv_errors(), true) );
                  }         
                  while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) { ?>
                  <tr class="">
                    <td><?php echo $row['ClientID'];?></td>
                    <td><?php echo $row['AccNumber'];?></td>
                    <td><?php echo '$'.round($row['CurBalance'], 2); ?></td>
                    <td><?php echo date_format($row['CSdt'],'F j, Y');?></td>
                  </tr><?php
                  }/*sqlsrv_free_stmt( $stmt);*/
                break;
                case 'report_status_account':
                if(!empty($_GET['start_date']) && !empty($_GET['end_date'])){
                    $start_date =date('Y-m-d',strtotime($_GET['start_date']));
                    $end_date =date('Y-m-d',strtotime($_GET['end_date']));
                    $query_dates = "AND (CSdt BETWEEN '".$start_date."' AND '".$end_date."')";
                  }else{
                    $query_dates=' ';
                  }
                  $sql = "SELECT TOP (50) ClientID, AccNumber, CSdt FROM dbo.Pinfo  WHERE ClientID = '$user_id' ".$query_dates;
                  $stmt = sqlsrv_query( $conn, $sql );
                  if( $stmt === false) {
                      die( print_r( sqlsrv_errors(), true) );
                  }         
                  while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) { ?>
                  <tr class="">
                    <td><?php echo $row['ClientID'];?></td>
                    <td><?php echo $row['AccNumber'];?></td>
                    <td><?php echo $row['Status'];?></td>
                    <td><?php echo date_format($row['CSdt'],'F j, Y');?></td>
                  </tr><?php
                  }/*sqlsrv_free_stmt( $stmt);*/
                break;

                //THE NEW REPORTS
                case 'report_accounting_recovery':
                if(!empty($_GET['start_date']) && !empty($_GET['end_date'])){
                    $start_date =date('Y-m-d',strtotime($_GET['start_date']));
                    $end_date =date('Y-m-d',strtotime($_GET['end_date']));
                    $query_dates = "AND (CheckDate BETWEEN '".$start_date."' AND '".$end_date."')";
                    //check dates not allowed here
                    $query_dates=' ';
                  }else{
                    $query_dates=' ';
                  }

                  //pagination part
                  $num_rec_per_page = 30;
                  if (isset($_GET["pagex"])) {
                    $pagex = $_GET["pagex"];
                  } else {
                    $pagex = 1;
                  }
                  echo " Page: ".$pagex;
                  $start_from = ($pagex - 1) * $num_rec_per_page;

                  $sql= " SELECT * FROM PFGrem.package WHERE ClientID='$user_id' ".$query_dates." ORDER BY Package ASC OFFSET $start_from ROWS FETCH NEXT $num_rec_per_page ROWS ONLY ";

                  $stmt = sqlsrv_query( $conn, $sql );
                  if( $stmt === false) {
                    die( print_r( sqlsrv_errors(), true) );
                  }         
                  while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) { ?>
                  <tr class="">
                    <td><?php echo $row['Package'];?></td>
                    <td><?php echo $row['RCount'];?></td>
                    <td><?php echo '$' . number_format($row['TotBalance'], 2); ?></td>
                    <td><?php echo '$' . number_format($row['TotCurBalance'], 2); ?></td>
                    <td><?php echo $row['TotPayments'];?></td>
                    <td><?php echo '$' . number_format($row['TotPaidClient'], 2); ?></td>
                    <td><?php echo '$' . number_format($row['TotPaidAgency'], 2); ?></td>
                    <td><?php echo $row['RecoveryRate']."%";?></td>
                  </tr><?php
                  }/*sqlsrv_free_stmt( $stmt);*/

                  //pagination part 2
                  $sql = "SELECT COUNT(*) AS countx FROM PFGrem.package WHERE ClientID='$user_id' ";
                  $stmt = sqlsrv_query( $conn, $sql );
                  while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
                    $total_records = $row['countx'];
                  }
                  $total_pages   = ceil($total_records / $num_rec_per_page);

                  echo "<div class='mini-pagination'>";
                  //for first page
                  $new_data = array("pagex" => "1");
                  $full_data = array_merge($_GET, $new_data);
                  $url = http_build_query($full_data);            
                  echo "<a href=?$url> First </a> ";

                  //for each page
                  if( $total_pages > 10 ){
                    $i = $pagex;
                    $min_pages = $i + 10 ;
                    if( $min_pages >= $total_pages ){
                      $i = $total_pages - 10;
                      $min_pages = $i + 10 ;
                    }
                    for ( $i; $i <= $min_pages; $i++) {
                      $new_data = array( "pagex" => $i );
                      $full_data = array_merge($_GET, $new_data);
                      $url = http_build_query($full_data);
                      echo "<a href=?$url>" . $i . "</a>";
                    }

                    //dots to next page
                    if( ! ($min_pages >= $total_pages-10) ){
                      $new_data = array( "pagex" => $min_pages+1 );
                      $full_data = array_merge($_GET, $new_data);
                      $url = http_build_query($full_data);
                      echo "<a href=?$url> ... </a> ";
                    }
                  } else{
                    for ( $i=1; $i <= $total_pages; $i++) {
                      $new_data = array( "pagex" => $i );
                      $full_data = array_merge($_GET, $new_data);
                      $url = http_build_query($full_data);
                      echo "<a href=?$url>" . $i . "</a>";
                    }
                  }

                  //last page
                  $new_data = array("pagex" => $total_pages);
                  $full_data = array_merge($_GET, $new_data);
                  $url = http_build_query($full_data);
                  echo "<a href=?$url> Last </a> ";

                  echo "</div>";
                break;
                
                case 'report_current_month':
                if(!empty($_GET['start_date']) && !empty($_GET['end_date'])){
                    $start_date =date('Y-m-d',strtotime($_GET['start_date']));
                    $end_date =date('Y-m-d',strtotime($_GET['end_date']));
                    $query_dates = "AND (CheckDate BETWEEN '".$start_date."' AND '".$end_date."')";
                    //check dates not allowed here
                    $query_dates=' ';
                  }else{
                    $query_dates=' ';
                  }

                  //pagination part 1
                  $num_rec_per_page = 30;
                  if (isset($_GET["pagex"])) {
                    $pagex = $_GET["pagex"];
                  } else {
                    $pagex = 1;
                  }
                  echo " Page: ".$pagex;
                  $start_from = ($pagex - 1) * $num_rec_per_page;

                  //inputing selected package
                  $selectedMonth ='%';
                  $selectedMonth = $_GET['month_select'];
                  if( $selectedMonth == NULL || $selectedMonth == 'Current Month' ){
                    $selectedMonth = date("F - Y");
                  }
                  $year_val = substr($selectedMonth, -4, 4);
                  $arrx = explode(' -', $selectedMonth);
                  $month_val = $arrx[0];

                  echo "<b id='month_val'> Selected Month: ".$selectedMonth."</b>";


                  //$sql = "SELECT * FROM PFGrem.Payments WHERE ( MONTH(CAST(CheckDate as date)) = MONTH(getdate()) AND YEAR(CAST(CheckDate as date)) = YEAR(getdate()) ) AND ClientID = '$user_id' ".$query_dates;
                  $sql= " SELECT * FROM PFGrem.Payments";
                  $sql = "SELECT * FROM PFGrem.Payments WHERE ( DATENAME(MONTH, CheckDate) = '$month_val' AND YEAR(CheckDate) = '$year_val' ) AND ClientID = '$user_id' ORDER BY CheckDate DESC OFFSET $start_from ROWS FETCH NEXT $num_rec_per_page ROWS ONLY ";

                  $stmt = sqlsrv_query( $conn, $sql );
                  if( $stmt === false) {
                      die( print_r( sqlsrv_errors(), true) );
                  }

                  while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) { ?>
                  <tr class="">
                    <td><?php echo $row['AccNumber'];?></td>
                    <td><?php echo $row['CustomerID'];?></td>
                    <td><?php echo $row['Fullname'];?></td>
                    <td><?php echo date_format($row['DatePlaced'],'F j, Y');?></td>
                    <td><?php echo '$' . number_format($row['Amount'], 2); ?></td>
                    <td><?php echo $row['FeeRate'];?></td>
                    <td><?php echo '$' . number_format($row['AgencyFee'], 2); ?></td>
                    <td><?php echo '$' . number_format($row['ClientFee'], 2); ?></td>
                    <td><?php echo $row['Status'];?></td>
                  </tr><?php
                  }/*sqlsrv_free_stmt( $stmt);*/

                  //Pagination part 2
                  $sql = "SELECT COUNT(*) AS countx FROM PFGrem.Payments WHERE ( DATENAME(MONTH, CheckDate) = '$month_val' AND YEAR(CheckDate) = '$year_val' ) AND ClientID = '$user_id' ";
                  $stmt = sqlsrv_query( $conn, $sql );
                  while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
                    $total_records = $row['countx'];
                  }
                  $total_pages   = ceil($total_records / $num_rec_per_page);

                  echo "<div class='mini-pagination'>";
                  //for first page
                  $new_data = array("pagex" => "1");
                  $full_data = array_merge($_GET, $new_data);
                  $url = http_build_query($full_data);            
                  echo "<a href=?$url> First </a> ";

                  //for each page
                  if( $total_pages > 10 ){
                    $i = $pagex;
                    $min_pages = $i + 10 ;
                    if( $min_pages >= $total_pages ){
                      $i = $total_pages - 10;
                      $min_pages = $i + 10 ;
                    }
                    for ( $i; $i <= $min_pages; $i++) {
                      $new_data = array( "pagex" => $i );
                      $full_data = array_merge($_GET, $new_data);
                      $url = http_build_query($full_data);
                      echo "<a href=?$url>" . $i . "</a>";
                    }

                    //dots to next page
                    if( ! ($min_pages >= $total_pages-10) ){
                      $new_data = array( "pagex" => $min_pages+1 );
                      $full_data = array_merge($_GET, $new_data);
                      $url = http_build_query($full_data);
                      echo "<a href=?$url> ... </a> ";
                    }
                  } else{
                    for ( $i=1; $i <= $total_pages; $i++) {
                      $new_data = array( "pagex" => $i );
                      $full_data = array_merge($_GET, $new_data);
                      $url = http_build_query($full_data);
                      echo "<a href=?$url>" . $i . "</a>";
                    }
                  }

                  //last page
                  $new_data = array("pagex" => $total_pages);
                  $full_data = array_merge($_GET, $new_data);
                  $url = http_build_query($full_data);
                  echo "<a href=?$url> Last </a> ";

                  echo "</div>";

                  //Displaying grand sum on last page
                  if( $pagex == $total_pages ){
                  	$sql = "SELECT SUM(Amount) AS totalAmount, SUM(AgencyFee) AS totalAgencyFee, SUM(ClientFee) AS totalClientFee FROM PFGrem.Payments WHERE ( DATENAME(MONTH, CheckDate) = '$month_val' AND YEAR(CheckDate) = '$year_val' ) AND ClientID = '$user_id' ";
                  	$stmt = sqlsrv_query( $conn, $sql );
                  	if( $stmt === false) {
                  	  die( print_r( sqlsrv_errors(), true) );
                  	}
                  	while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) { ?>
                  	<tr class="tfoot">
                  	  <td><?php echo "Grand Total"; ?></td>
                  	  <td><?php //echo $row['CustomerID'];?></td>
                  	  <td><?php //echo $row['Fullname'];?></td>
                  	  <td><?php //echo date_format($row['DatePlaced'],'F j, Y');?></td>
                  	  <td><?php echo '$' . number_format($row['totalAmount'], 2); ?></td>
                  	  <td><?php //echo $row['FeeRate'];?></td>
                  	  <td><?php echo '$' . number_format($row['totalAgencyFee'], 2); ?></td>
                  	  <td><?php echo '$' . number_format($row['totalClientFee'], 2); ?></td>
                  	  <td><?php //echo $row['Status'];?></td>
                  	</tr><?php
                  	}
                  }
                break;
                

                case 'report_debtors_inventory':
                  if(!empty($_GET['start_date']) && !empty($_GET['end_date'])){
                    $start_date =date('Y-m-d',strtotime($_GET['start_date']));
                    $end_date =date('Y-m-d',strtotime($_GET['end_date']));
                    $query_dates = "AND (CheckDate BETWEEN '".$start_date."' AND '".$end_date."')";
                  }else{
                    $query_dates=' ';
                  }

                  //pagination part
                  $num_rec_per_page = 30;
                  if (isset($_GET["pagex"])) {
                    $pagex = $_GET["pagex"];
                  } else {
                    $pagex = 1;
                  }
                  echo " Page: ".$pagex;
                  $start_from = ($pagex - 1) * $num_rec_per_page;

                  //inputing selected package
                  $selectedPackage ='%';
                  $selectedPackage = $_GET['package_select'];
                  if( $selectedPackage == NULL || $selectedPackage == 'Show All' ){
                    $selectedPackage ='%';
                  }
                  echo "<i id='pack_val'> Selected Package: ".$selectedPackage."</i>";

                 // $sql = "SELECT DISTINCT customerid, * FROM PFGrem.Payments WHERE ClientID='$user_id' AND Amount > 0 ".$query_dates." ORDER BY Lastcall DESC ";SELECT DISTINCT customerid, CheckDate, AccNumber, Fullname, Amount, CurBalance, Status, Lastcall FROM PFGrem.Payments WHERE ClientID='$user_id' AND Package LIKE '$selectedPackage' group by customerid ORDER BY Lastcall DESC OFFSET $start_from ROWS FETCH NEXT $num_rec_per_page ROWS ONLY
                  $sql = "SELECT DISTINCT customerid, CheckDate, AccNumber, Fullname, Amount, CurBalance, Status, Lastcall FROM PFGrem.Payments WHERE ClientID='$user_id' AND Package LIKE '$selectedPackage' group by CustomerID ORDER BY Lastcall DESC OFFSET $start_from ROWS FETCH NEXT $num_rec_per_page ROWS ONLY ";
                  $stmt = sqlsrv_query( $conn, $sql );

                  if( $stmt === false) {
                    die( print_r( sqlsrv_errors(), true) );
                  }

                  while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) { ?>
                  <tr class="">
                    <td><?php echo $row['AccNumber'];?></td>
                    <td><?php echo $row['customerid'];?></td>
                    <td><?php echo $row['Fullname'];?></td>
                    <td><?php echo '$' . number_format($row['Amount'], 2); ?></td>
                    <td><?php echo '$' . number_format($row['CurBalance'], 2); ?></td>
                    <td><?php echo $row['Status'];?></td>
                    <td><?php echo date_format($row['Lastcall'],'F j, Y');?></td>
                  </tr><?php
                  }/*sqlsrv_free_stmt( $stmt);*/

                  //pagination part 2
                  $sql = "SELECT COUNT(DISTINCT customerid) AS countx FROM PFGrem.Payments WHERE ClientID='$user_id' AND Amount > 0 AND Package LIKE '$selectedPackage' ";
                  $stmt = sqlsrv_query( $conn, $sql );
                  while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
                  	$total_records = $row['countx'];
                  }
                  $total_pages   = ceil($total_records / $num_rec_per_page);

                  echo "<div class='mini-pagination'>";
                  //for first page
                  $new_data = array("pagex" => "1");
                  $full_data = array_merge($_GET, $new_data);
                  $url = http_build_query($full_data);            
                  echo "<a href=?$url> First </a> ";

                  //for each page
                  if( $total_pages > 10 ){
                    $i = $pagex;
                    $min_pages = $i + 10 ;
                    if( $min_pages >= $total_pages ){
                      $i = $total_pages - 10;
                      $min_pages = $i + 10 ;
                    }
                    for ( $i; $i <= $min_pages; $i++) {
                      $new_data = array( "pagex" => $i );
                      $full_data = array_merge($_GET, $new_data);
                      $url = http_build_query($full_data);
                      echo "<a href=?$url>" . $i . "</a>";
                    }

                    //dots to next page
                    if( ! ($min_pages >= $total_pages-10) ){
                      $new_data = array( "pagex" => $min_pages+1 );
                      $full_data = array_merge($_GET, $new_data);
                      $url = http_build_query($full_data);
                      echo "<a href=?$url> ... </a> ";
                    }
                  } else{
                    for ( $i=1; $i <= $total_pages; $i++) {
                      $new_data = array( "pagex" => $i );
                      $full_data = array_merge($_GET, $new_data);
                      $url = http_build_query($full_data);
                      echo "<a href=?$url>" . $i . "</a>";
                    }
                  }

                  //last page
                  $new_data = array("pagex" => $total_pages);
                  $full_data = array_merge($_GET, $new_data);
                  $url = http_build_query($full_data);
                  echo "<a href=?$url> Last </a> ";

                  echo "</div>";

                  //Displaying grand sum on last page
                  if( $pagex == $total_pages ){
                  	//$sql = "SELECT SUM(Amount) as totalAmount, SUM(CurBalance) as totalCurBalance FROM ( SELECT DISTINCT customerid, * FROM PFGrem.Payments WHERE ClientID='$user_id' ) group by date";
                  	$sql = "SELECT DISTINCT customerid, * FROM PFGrem.Payments WHERE ClientID='$user_id' AND Package LIKE '$selectedPackage' ";

                  	$stmt = sqlsrv_query( $conn, $sql );
                  	if( $stmt === false) {
                  	  die( print_r( sqlsrv_errors(), true) );
                  	}
                  	$totalAmount = 0;
                  	$totalCurBalance = 0;
                		while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) { 
                			 $totalAmount += $row['Amount']; 
                			 $totalCurBalance += $row['CurBalance']; 
                		}
                		?>
                  	<tr class="tfoot">
                  	  <td><?php echo "Grand Total"; ?></td>
                      <td><?php //echo $row['CustomerID'];?></td>
                      <td><?php //echo $row['Fullname'];?></td>
                      <td><?php echo '$' . number_format( $totalAmount , 2); ?></td>
                      <td><?php echo '$' . number_format( $totalCurBalance , 2); ?></td>
                      <td><?php //echo $row['Status'];?></td>
                      <td><?php //echo date_format($row['Lastcall'],'F j, Y');?></td>
                  	</tr>
                  	<?php                  	
                  }
                break;

                
                case 'report_closed_inventory':
                if(!empty($_GET['start_date']) && !empty($_GET['end_date'])){
                    $start_date =date('Y-m-d',strtotime($_GET['start_date']));
                    $end_date =date('Y-m-d',strtotime($_GET['end_date']));
                    $query_dates = "AND (CheckDate BETWEEN '".$start_date."' AND '".$end_date."')";
                  }else{
                    $query_dates=' ';
                  }

                  //pagination part
                  $num_rec_per_page = 30;
                  if (isset($_GET["pagex"])) {
                    $pagex = $_GET["pagex"];
                  } else {
                    $pagex = 1;
                  }
                  echo " Current Page: ".$pagex;
                  $start_from = ($pagex - 1) * $num_rec_per_page;

                  $sql = "SELECT * FROM PFGrem.Payments WHERE ClientID ='$user_id' AND (Status= 'closed' OR Status = 'closed pif' OR Status = 'closed bk' OR Status = 'closed rtc' OR Status = 'bankrupt' OR Status = 'deceased' OR Status = 'out of stat' OR Status = 'uncollectable' OR Status = 'paid in full' OR Status = 'settledd in full' ) ORDER BY Status OFFSET $start_from ROWS FETCH NEXT $num_rec_per_page ROWS ONLY ";
                  $stmt = sqlsrv_query( $conn, $sql );
                  if( $stmt === false) {
                      die( print_r( sqlsrv_errors(), true) );
                  }         
                  while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) { ?>
                  <tr class="">
                    <td><?php echo $row['AccNumber'];?></td>
                    <td><?php echo $row['CustomerID'];?></td>
                    <td><?php echo $row['Fullname'];?></td>
                    <td><?php echo '$' . number_format($row['CurBalance'], 2); ?></td>
                    <td><?php echo $row['Status'];?></td>
                  </tr><?php
                  }/*sqlsrv_free_stmt( $stmt);*/

                  //pagination part 2
                  $sql = "SELECT COUNT(*) AS countx FROM PFGrem.Payments WHERE ClientID ='$user_id' AND (Status= 'closed' OR Status = 'closed pif' OR Status = 'closed bk' OR Status = 'closed rtc' OR Status = 'bankrupt' OR Status = 'deceased' OR Status = 'out of stat' OR Status = 'uncollectable' OR Status = 'paid in full' OR Status = 'settledd in full' ) ";
                  $stmt = sqlsrv_query( $conn, $sql );
                  while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
                    $total_records = $row['countx'];
                  }
                  $total_pages   = ceil($total_records / $num_rec_per_page);

                  echo "<div class='mini-pagination'>";

                  if( $total_pages > 1 ){

	                  //for first page
	                  $new_data = array("pagex" => "1");
	                  $full_data = array_merge($_GET, $new_data);
	                  $url = http_build_query($full_data);
	                  echo "<a href=?$url> First </a> ";

	                  //for each page
	                  if( $total_pages > 10 ){
	                    $i = $pagex;
	                    $min_pages = $i + 10 ;
                    	if( $min_pages >= $total_pages ){
                    		$i = $total_pages - 10;
	                    	$min_pages = $i + 10 ;
                    	}
	                    for ( $i; $i <= $min_pages; $i++) {
	                      $new_data = array( "pagex" => $i );
	                      $full_data = array_merge($_GET, $new_data);
	                      $url = http_build_query($full_data);
	                      echo "<a href=?$url>" . $i . "</a>";
	                    }

	                    //dots to next page
                    	if( ! ($min_pages >= $total_pages-10) ){
		                    $new_data = array( "pagex" => $min_pages+1 );
		                    $full_data = array_merge($_GET, $new_data);
		                    $url = http_build_query($full_data);
		                    echo "<a href=?$url> ... </a> ";
                    	}
	                  } else{
                      for ( $i=1; $i <= $total_pages; $i++) {
                        $new_data = array( "pagex" => $i );
                        $full_data = array_merge($_GET, $new_data);
                        $url = http_build_query($full_data);
                        echo "<a href=?$url>" . $i . "</a>";
                      }
                    }

	                  //last page
	                  $new_data = array("pagex" => $total_pages);
	                  $full_data = array_merge($_GET, $new_data);
	                  $url = http_build_query($full_data);
	                  echo "<a href=?$url> Last </a> ";
                  }

                  echo "</div>";

                  if( $pagex == $total_pages ){
                  	$sql = "SELECT SUM(CurBalance)as totalCurBalance FROM PFGrem.Payments WHERE ClientID ='$user_id' AND (Status= 'closed' OR Status = 'closed pif' OR Status = 'closed bk' OR Status = 'closed rtc' OR Status = 'bankrupt' OR Status = 'deceased' OR Status = 'out of stat' OR Status = 'uncollectable' OR Status = 'paid in full' OR Status = 'settledd in full' ) ";
                  	$stmt = sqlsrv_query( $conn, $sql );
                  	if( $stmt === false) {
                  	  die( print_r( sqlsrv_errors(), true) );
                  	}
                  	while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) { ?>
                  	<tr class="tfoot">
                  	  <td><?php echo "Grand Total"; ?></td>
                      <td><?php //echo $row['CustomerID'];?></td>
                      <td><?php //echo $row['Fullname'];?></td>
                      <td><?php echo '$' . number_format($row['totalCurBalance'], 2); ?></td>
                      <td><?php //echo $row['Status'];?></td>
                  	</tr><?php
                  	}
                  }                  
                break;

              }?>
            </tbody>
          </table>
          </div>
          <br clear="all" />

          <?php
          		$reportTitle = $_GET['query_name'];
          		$userIDx= $user_id;
          		$new_datax = array( "query_name" => $reportTitle, "userIDx" => $userIDx );
          		// $full_datax = array_merge($_GET, $new_datax);
          		$urlx = http_build_query($new_datax);
          		$exportBtnUrl = site_url()."/wp-content/themes/own/export_table.php?".$urlx;          	
          ?>
          <a href="#" class="print-btn">Print Table</a>
          <a href="<?php echo $exportBtnUrl; ?>" target="_blank" class="export-btn"> View/Export Whole Table </a>
          <?php }?>
        </div>
      </article>
    </div>
  </div>
</section>
<script>
jQuery(document).ready(function() {

  //Package and Month select for Queries
  function packageMonth(){
    $('.package-select, .month-select').hide();
		var select_val = $( ".main_select option:selected" ).val();
    if(select_val == 'report_debtors_inventory'){
      $('.package-select').show();
    } else if(select_val == 'report_current_month'){
      $('.month-select').show();
    }
  }

  //calling on page-load
  packageMonth();
  //calling on select change
  $( ".main_select" ).change(function() {
    packageMonth();
  });


  //showing print button only if table is visible
  if($(".report-grid td").is(':visible')){
    $('.print-btn').show();
    $('.export-btn').show();
  } else{
    $('.print-btn').hide();
    $('.export-btn').hide();
  }

  //PRINT FUNCTION
  $(".print-btn").click(function(){
    PrintElement('.report-grid');
  });  
  function PrintElement(elem){
    Popup($(elem).parent().html());
  }
  //Creates a new window and populates it with your content
  function Popup(data) {
    //Create your new window
    var w = window.open('', 'Print Me', 'height=600,width=800');
    w.document.write('<html><head><title>Print Me</title>');
    //Include your stylesheet (optional)
    w.document.write("<link rel='stylesheet' id='twentyfifteen-table-css'  href='https://www.precisefinancialgroup.com/wp-content/themes/own/css/table.css' type='text/css' media='all' /> ");
    w.document.write('</head><body>');
    //Write your content
    w.document.write(data);
    w.document.write('</body></html>');
    w.print();
    w.close();
    return true;
  }//print end



  //FUNCTION TO EXPORT TO CSV
  function exportTableToCSV($table, filename) {

    var $rows = $table.find('tr:has(td),tr:has(th)'),
      tmpColDelim = String.fromCharCode(11),
      tmpRowDelim = String.fromCharCode(0),

      // actual delimiter characters for CSV format
      colDelim = '","',
      rowDelim = '"\r\n"',

      // Grab text from table into CSV formatted string
      csv = '"' + $rows.map(function(i, row) {
        var $row = $(row),
          $cols = $row.find('td,th');

        return $cols.map(function(j, col) {
          var $col = $(col),
            text = $col.text();

          return text.replace(/"/g, '""');

        }).get().join(tmpColDelim);

      }).get().join(tmpRowDelim)
      .split(tmpRowDelim).join(rowDelim)
      .split(tmpColDelim).join(colDelim) + '"',

      // Data URI
      csvData = 'data:application/csv;charset=utf-8,' + encodeURIComponent(csv);

    console.log(csv);

    if (window.navigator.msSaveBlob) { // IE 10+
      //alert('IE' + csv);
      window.navigator.msSaveOrOpenBlob(new Blob([csv], {
        type: "text/plain;charset=utf-8;"
      }), "csvname.csv")
    } else {
      $(this).attr({
        'download': filename,
        'href': csvData,
        'target': '_blank'
      });
    }
  }
  // Calling button for CSV export
  $(".csv-export-btn").on('click', function(event) {
    // Don't event.preventDefault() or return false coz we need typical hyperlink
    var table = $('.report-grid');
    exportTableToCSV.apply(this, [ table, 'export.csv' ]);
  });



  jQuery('.MyDate').datepicker({
    dateFormat: "DD MM d yy",
      onSelect: function(dateText, inst) {
        console.log(dateText);
        var dateArr = dateText.split(' ')
        var suffix = "";
        switch(inst.selectedDay) {
        case '1': case '21': case '31': suffix = 'st'; break;
        case '2': case '22': suffix = 'nd'; break;
        case '3': case '23': suffix = 'rd'; break;
        default: suffix = 'th';
        }
    
        var dt = $.datepicker.formatDate('dd-mm-yy', new Date(dateText));
        $(".MyDate_f").val(dt);
    
        $(".MyDate").val(dateArr[0] +' '+ dateArr[1] +' '+ dateArr[2] + suffix +', '+ dateArr[3]);
      }
  });
  jQuery('.MyDate1').datepicker({
    dateFormat: "DD MM d yy",
      onSelect: function(dateText, inst) {
        var dateArr = dateText.split(' ')
        var suffix = "";
        switch(inst.selectedDay) {
        case '1': case '21': case '31': suffix = 'st'; break;
        case '2': case '22': suffix = 'nd'; break;
        case '3': case '23': suffix = 'rd'; break;
        default: suffix = 'th';
        }
    
        var dt = $.datepicker.formatDate('dd-mm-yy', new Date(dateText));
        $(".MyDate1_f").val(dt);
    
        $(".MyDate1").val(dateArr[0] +' '+ dateArr[1] +' '+ dateArr[2] + suffix +', '+ dateArr[3]);
      }
  });

  //Disabling search if both dates are not input
  $(".report-search").click(function(event){
    var date1 = $(".MyDate").val();
    var date2 = $(".MyDate1").val();
    if(!date1 && !date2){
      return;
    }
    else if(!date1){
      alert("Select The 'From Date Fields' !!");
      event.preventDefault();
    }else if(!date2){
      alert("Select The 'To Date Fields' !!");
      event.preventDefault();
    }
    else{
      return;
    }
  });

});
</script>
<?php get_footer(); ?>






