 <?php
$url = 'http://api.openweathermap.org/data/2.5/weather?id=1274746&lang=en&units=metric&APPID=25e09a35cb5292de7e0419b957277565';
$handle = curl_init($url);
curl_setopt($handle,  CURLOPT_RETURNTRANSFER, TRUE);
$response = curl_exec($handle);
$clima=json_decode($response);
$temp=round($clima->main->temp);
$main=$clima->weather[0]->main;
$description=$clima->weather[0]->description;
$icon=$clima->weather[0]->icon.".png";
$date = date_default_timezone_set('Asia/Kolkata');
$today = date("F j, Y, g:i a");
$cityname = $clima->name; 
// echo $cityname . " - " .$today . "<br>";
// echo "Main: " . $main ."<br>";
echo "Temperature: " . $temp ."&deg;C<br>";
echo "Description: " . $description ."<br>";
echo "<img src='http://openweathermap.org/img/w/" . $icon ."' / >"; 
//$httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);
//echo $httpCode;
curl_close($handle); 
?>
