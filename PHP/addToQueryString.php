<?php
	$new_data = array("pagex" =>"1");
	$full_data = array_merge($_GET, $new_data);
	$forward_link = http_build_query($full_data);
	echo "<a href=?$forward_link>First </a>";
?>
