<!-- function -->
<?php
// newlines preserving html
function nl2br_save_html($string) {
  if (!preg_match("#</.*>#", $string)){ // avoid looping if no tags in the string.
    return nl2br($string);
  }
  $string = str_replace(array("\r\n", "\r", "\n"), "\n", $string);
  $lines = explode("\n", $string);
  $output = '';
  foreach ($lines as $line) {
    $line = rtrim($line);
    if (!preg_match("#</?[^/<>]*>$#", $line)) // See if line finished with has html opening or closing tag
      $line .= '<br />';
    $output .= $line . "\n";
  }
  return $output;
}
?>

<!-- test -->
<?php
$your_string ='WE CONGRATULATE THE FOLLOWING STUDENTS AS PER THE ORDER OF MERIT LISTED BELOW:
<table class="table table-bordered">
  <tr>';

echo nl2br_save_html($your_string);
?>