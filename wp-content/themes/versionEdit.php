<?php
$styleSheet = fopen("academies_v2/style.css", "r") or die("Unable to open file!");
$content = fread($styleSheet,filesize("academies_v2/style.css"));
$position1 = strpos($content, 'Version:');
$position2 = strpos($content, 'License:');
$length = $position2 - ($position1 + 9);
$start = $position1 + 9;
$currentVersion = substr($content, $start, $length);
$currentVersion = floatval($currentVersion);
$oldString = "Version: ".$currentVersion;
$newVersion = $currentVersion + .1;
$newString = "Version: ".$newVersion;
echo $oldString;
echo $newString;
$output = str_replace($oldString, $newString, $content);
$fhandle = fopen("academies_v2/style.css","w");
fwrite($fhandle,$output);
fclose($styleSheet);
$jsonString = file_get_contents('info.json');
$data = json_decode($jsonString);
$data->version = $newVersion;
$newJsonString = json_encode($data);
file_put_contents('info.json', $newJsonString);

include_once('../pclzip/pclzip.lib.php');
  $archive = new PclZip('export/academies_v2.zip');
  $v_list = $archive->create('academies_v2');
  if ($v_list == 0) {
    die("Error : ".$archive->errorInfo(true));
  }

?>