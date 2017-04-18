<!DOCTYPE html>
<html>
<head>
  <title>JSON</title>
</head>
<style type="text/css">
  select {
    width: 40%;
    padding: 16px 20px;
    border: none;
    border-radius: 4px;
    background-color: green;
}
.button {
    background-color: #4CAF50; /* Green */
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
}
</style>
<body>
<center><h1>Prakiraan Cuaca Untuk UMKM Di Semarang</h1></center>
<form action="" method="POST">
  <select name="kota">
    <option value=" "></option>
	<option value="Kalibanteng">Kalibanteng</option>
    <option value="Bulustalan">Bulustalan</option>
    <option value="Mugassari">Mugassari</option>
    <option value="Tembalang">Tembalang</option>
    <option value="Ungaran">Ungaran</option>
    <option value="Gunungpati">Gunungpati</option>
    <option value="Cangkiran">Cangkiran</option>
    <option value="Pleburan">Pleburan</option>
    <option value="Tlogosari">Tlogosari</option>
    <option value="Kedungmundu">Kedungmundu</option>
  </select>
  <input type="submit" class="button" name="submit" value="Cari">
</form>
<br>
<?php
error_reporting(0);
$id = $_POST['kota'];
if($_POST['submit']){
  $json_string = file_get_contents("http://api.wunderground.com/api/0e4b71198dc78edf/geolookup/conditions/q/IA/$id.json");
  $parsed_json = json_decode($json_string);
  $location = $parsed_json->{'location'}->{'city'};
  $city = $parsed_json->{'location'}->{'nearby_weather_stations'}->{'airport'}->{'station'}[0]->{'city'};
  $local = $parsed_json->{'current_observation'}->{'observation_time'};
  $weather = $parsed_json->{'current_observation'}->{'weather'};
  $feelslike_c= $parsed_json->{'current_observation'}->{'feelslike_c'};
  $wind_degrees= $parsed_json->{'current_observation'}->{'wind_degrees'};
  $temperature_string = $parsed_json->{'current_observation'}->{'temperature_string'};
  $UV = $parsed_json->{'current_observation'}->{'UV'};
  $dewpoint_string = $parsed_json->{'current_observation'}->{'dewpoint_string'};
  $visibility_km = $parsed_json->{'current_observation'}->{'visibility_km'};
  $icon = $parsed_json->{'current_observation'}->{'icon'};

  echo "  ${location} ${image}\n";
  echo "<br>";
  echo "<img src='http://icons.wxug.com/i/c/k/" .$icon. ".gif'><br/>";
  echo "<br>";
  echo "Waktu : ${local}\n";
  echo "<br>";
  echo "Cuaca : ${weather}\n";
  echo "<br>";
  echo "Temperature : ${temperature_string}\n";
  echo "<br>";
  echo "UV : ${UV}\n";
  echo "<br>";
  echo "Suhu udara : ${wind_degrees}\n";
  echo "<br>";
  echo "Derajat angin : ${feelslike_c}\n";
  echo "<br>";
  echo "Titik Pengembunan : ${dewpoint_string}\n";
  echo "<br>";
  echo "Jarak Pandang : ${visibility_km}\n";
  
 }
?>
</body>
</html>