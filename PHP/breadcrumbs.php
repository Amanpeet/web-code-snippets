<?php
    if($location = substr(dirname($_SERVER['PHP_SELF']), 1)){
      $dirlist = explode('/', $location);
    } else{
      $dirlist = array();
    }
    $count = array_push($dirlist, basename($_SERVER['PHP_SELF']));
    $address = 'http://'.$_SERVER['HTTP_HOST'];
    echo '<a href="'.$address.'">Home</a>';
    for($i = 0; $i < $count; $i++) {
      echo '&nbsp;&raquo;&nbsp;<a href="'.($address .= '/'.$dirlist[$i]).'">'.$dirlist[$i].'</a>';
    }
  ?>