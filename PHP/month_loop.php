<?php
  // Month Dateloop
  $date = '2015-12';
  $end_date = date('Y-m');

  while (strtotime($date) <= strtotime($end_date)) {
    echo "$date\n";
    $date = date ("Y-m", strtotime("+1 month", strtotime($date)));
  }
?>