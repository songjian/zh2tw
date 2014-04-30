<?php
header("Content-type: text/html; charset=utf-8");
include_once('ZhConversion.php');
$file = 'hsxy_dev.sql';
$input = file_get_contents($file);
$new_needle = array_merge($zh2TW, $zh2Hant);
$needle = array_keys($new_needle);
$output = str_replace($needle, $new_needle, $input);
file_put_contents($file,$output);