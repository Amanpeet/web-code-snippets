<?php

define("HOST", "duvoraname.duvora.com");
// Database user
define("DBUSER", "duvoradb");
// Database password
define("PASS", "duvoraDB123");
// Database name
define("DB", "duvoradb");
// Database Error - User Message
define("DB_MSG_ERROR", 'Could not connect!<br />Please contact the site\'s administrator.');

############## Make the mysql connection ###########
$conn = mysql_connect(HOST, DBUSER, PASS) or die(DB_MSG_ERROR);
$db = mysql_select_db(DB) or die(DB_MSG_ERROR);

if($conn){
	echo "Connected successfully!";
}
else{
	echo "Connection Error!";
}
$value = $_POST['value'] ;

$query = mysql_query("
  SELECT * 
  FROM wp_posts 
  WHERE post_type='wpsc-product' AND ID='".$value."'
");
if( empty($query) ){
	echo "query is empty";
}
else{
	echo '<table>';
	while ($data = mysql_fetch_array($query)) {
	  echo '
	  <tr style="background-color:pink;">
	    <td style="font-size:18px;">'.$data["ID"].'</td>
	    <td style="font-size:18px;">'.$data["post_title"].'</td>
	  </tr>';
	}
	echo '</table>';
}

?>



<!-- 
post_type : wpsc-product

SELECT images.*
FROM images
INNER JOIN productPhotos ON images.imageID = productPhotos.imageID
WHERE productID in (5, 2, 4)
ORDER BY FIELD(specificProductUID, 5,2,4);

-->

