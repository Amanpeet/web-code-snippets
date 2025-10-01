<?php
require 'pdfcrowd.php';

$bodyx = '
    <tr>
        <td colspan="" style="border-right:1px solid #951609;border-bottom:1px solid #951609;padding: 3px;font-size:12px;">
        <strong><span style="color:#791a18">Shipping Methods:</span> Product Delivered To The Address You Provided</strong></td>
    </tr>
';

try {
    // generate a PDF file
    $client = new Pdfcrowd("aspnet", "43c1a3c8020541280ff1d4df2102e0cb");
    $pdf = $client->convertHtml($bodyx);

    // //Deal with the email
    $to = 'aspnetusername@gmail.com';
    $from = 'sender@example.com';
    $subject = 'a PDF file for you';
    $content = 'Please find the file attached';
    $attachment = chunk_split(base64_encode($pdf));

    $filename = "myfile.pdf";
    $boundary =md5(date('r', time()));

    $headers = "From: $from\r\nReply-To: $from";
    $headers .= "\r\nMIME-Version: 1.0\r\nContent-Type: multipart/mixed; boundary=\"_1_$boundary\"";
    $message="This is a multi-part message in MIME format.
    --_1_$boundary
    Content-Type: multipart/alternative; boundary=\"_2_$boundary\"
    --_2_$boundary
    Content-Type: text/plain; charset=\"iso-8859-1\"
    Content-Transfer-Encoding: 7bit
    $content
    --_2_$boundary--
    --_1_$boundary
    Content-Type: application/pdf; name=\"$filename\"
    Content-Transfer-Encoding: base64
    Content-Disposition: attachment
    $attachment
    --_1_$boundary--";

    mail($to, $subject, $message, $headers);

}

catch(PdfcrowdException $e) {
    echo "Pdfcrowd Error: " . $e->getMessage();
}


/*****************************************************/

// try {   
//     // create an API client instance
//     $client = new Pdfcrowd("aspnet", "43c1a3c8020541280ff1d4df2102e0cb");

//     // convert a web page and store the generated PDF into a $pdf variable
//     // $pdf = $client->convertURI('http://example.com/');
//     $pdf = $client->convertHtml($bodyx);

//     // set HTTP response headers
//     header("Content-Type: application/pdf");
//     header("Cache-Control: no-cache");
//     header("Accept-Ranges: none");
//     header("Content-Disposition: attachment; filename=\"created.pdf\"");

//     // send the generated PDF 
//     echo $pdf;
// }
// catch(PdfcrowdException $e) {
//     echo "Pdfcrowd Error: " . $e->getMessage();
// }


?>