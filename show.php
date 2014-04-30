<?php
header("Content-type: text/html; charset=utf-8");
include_once('ZhConversion.php');
$input = isset($_POST['input'])?$_POST['input']:'';
$new_needle = array_merge($zh2TW, $zh2Hant);
$needle = array_keys($new_needle);
$output = str_replace($needle, $new_needle, $input);
?>
<form name="ChineseConverter" method="post">
简体:<textarea name="input" style="width:500px;height:200px;">
<?php print(htmlspecialchars($input));?>
</textarea>
<br/>
繁体:<textarea name="output" style="width:500px;height:200px;">
<?php print(htmlspecialchars($output));?>
</textarea>
<br/>
<input type="submit" value="转换"/>
</form>