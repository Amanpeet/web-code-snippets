<?php

$variable = "xxxxx";

$html = '
<div style="background: none repeat scroll 0 0 #fff; border: 1px solid #791a18;border-radius: 10px; float:left;width: 100%; margin: 20px 0;">
  <div style="border-radius: 10px 10px 0px 0px;height:20px;font-size: 16px; background: none repeat scroll 0 0 #ccc ;color: #000;padding: 7px 0;" id="header">
    <div class="order_date" style="width:50%;float:left;">Order Date : '. $variable .'</div>
    <div class="order_invoice_no" style="width:50%;float:left;">Order Number : '. $variable.'</div>
  </div>
  <div style="padding:6px 14px;">
    <div class="invoice_for" style="width:50%;float:left;color:#000;"><strong style="color:#791a18"> INVOICE FOR: ' . $variable . ' ' . $variable . '</strong>
      <address><img src="http://localhost/localservicebrands/b.jpg" style="width:160px;height:120">
        <h3 style="margin: 0px; padding: 0px;">  Florist Billing & Technology Services, LLC. </h3>
        <br>Florist Order Management & Payment And Billing System Software
        <br> 1(877)736-3356, Shop Member Number #1559</address>
    </div>
    <div class="bill_to" style="width:50%;float:left;"><strong style="color:#791a18">BILLED TO:</strong>'. $variable . ' </div>
  </div>
  <div style="padding:6px 14px;float:left;width:96.9%;color:#000;">
    <table cellspacing="0" cellpadding="0" style="width:100%;border:1px solid #791a18;">
      <thead>
        <tr>
          <td colspan="1" style="color:#000;background: #ccc;text-align:center;">SHIP TO</td>
          <td colspan="2" style="color:#000;background: #ccc;text-align:center;">Products</td>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td colspan="1" style="border-right:1px solid #951609; border-bottom:1px solid #951609;padding: 3px;font-size:12px;" valign="top">
              <address style="font-size:12px;">
                <strong>Address : </strong> '. $variable .' <br>'. $variable .' <br>'. $variable .'<br>'. $variable.
              '</address>
          </td>
          <td colspan="2" rowspan="2" style="border-right:1px solid #951609; border-bottom:1px solid #951609;padding: 3px;font-size:12px;" valign="top">Arrangement or specialty product as per customers Request.</td>
        </tr>
        <tr>
          <td colspan="" style="border-right:1px solid #951609;border-bottom:1px solid #951609;padding: 3px;font-size:12px;"> <strong><span style="color:#791a18">Shipping Methods:</span> Product Delivered To The Address You Provided</strong></td>
        </tr>
        <tr>
          <td colspan="" style="border-right:1px solid #951609;border-bottom:1px solid #951609;padding: 3px;font-size:12px;"> <strong><span style="color:#791a18">Payment Method:</span>Credit Card</strong></td>
          <td colspan="" style="color:#000;background:#ccc;text-align:right;padding: 3px;font-size:12px;">Total Including Service, Design And
            <br> Delivery Fees & Applicable Tax</td>
          <td colspan="" style="border-right:1px solid #951609;border-bottom:1px solid #951609;padding: 3px;font-size:12px;"> $'.$variable.' </td>
        </tr>
      </tbody>
    </table>
  </div>
';


try {

    // Require composer autoload
    require_once 'mpdf/autoload.php';

    $mpdf = new mPDF();
    $mpdf->WriteHTML($html);
    $content = $mpdf->Output('', 'S');
    $attachment = chunk_split(base64_encode($content));
    $filename = "invoice.pdf";
    $separator = md5(time());
    $eol = PHP_EOL;

    // //Deal with the email
    $to = 'aspnetusername@gmail.com';
    $from = 'sender@example.com';
    $subject = 'Invoice for your order';
    $content = 'Please find the file attached';

    $headers = "From: " . $from . $eol;
    $headers .= "MIME-Version: 1.0" . $eol;
    $headers .= "Content-Type: multipart/mixed; boundary=\"" . $separator . "\"" . $eol . $eol;
    $body = "";
    $body .= "Content-Transfer-Encoding: 7bit" . $eol;
    $body .= "This is a MIME encoded message." . $eol; 
    $body .= "--" . $separator . $eol;
    $body .= "Content-Type: text/html; charset=\"iso-8859-1\"" . $eol;
    $body .= "Content-Transfer-Encoding: 8bit" . $eol . $eol;
    $body .= $message . $eol;
    $body .= "--" . $separator . $eol;
    $body .= "Content-Type: application/octet-stream; name=\"" . $filename . "\"" . $eol;
    $body .= "Content-Transfer-Encoding: base64" . $eol;
    $body .= "Content-Disposition: attachment" . $eol . $eol;
    $body .= $attachment . $eol;
    $body .= "--" . $separator . "--";

    // $is_sent = @mail($mailto, $subject, "", $header);

    // $mpdf->Output();
    // exit;

    // send email
    if( mail($to, $subject, $body, $headers) ){
      echo "Mail Sent";
    } else {
      echo "Mail Failed";
    }

}

catch(Exception $e) {
  echo "PDF Generation Error.";
}

?>