<?php
/**
 * 转换JSON格式
 * 
 * @author 宋健
 * @version $Id$
 */
 
header("Content-type: text/html; charset=utf-8");
include_once('ZhConversion.php');
require_once('Models.php');

//连接数据库
$db = mysql_connect('localhost','root','');
if($db){
    mysql_query("set names 'utf8'",$db);
    mysql_select_db("hsxy_dev",$db);
} else {
    exit('没有数据库。');
}

$result = mysql_query("select id,content from `base_talk`",$db);
$new_needle = array_merge($zh2TW, $zh2Hant);
$needle = array_keys($new_needle);

while($row = mysql_fetch_array($result)){
    $json = $row['content'];
    $array = json_decode($json,TRUE);
    $big5_array = conversion_array($array,$needle,$new_needle);
    $big5_json = json_encode($big5_array);
    $big5_json = addslashes($big5_json);
    mysql_query("update `base_talk` set content = '$big5_json' where id = {$row['id']}",$db);
}

exit('转换完成。');

/**
 * 转换一个数组
 * 
 * @access global
 * @param mixed $array
 * @param mixed $needle
 * @param mixed $new_needle
 * @return void
 */
function conversion_array($array,$needle,$new_needle){
    if(is_array($array)){
        foreach($array as & $arr){
            if(!is_array($arr)){
                $arr = str_replace($needle, $new_needle, $arr);
            }
            else conversion_array(&$arr,$needle,$new_needle);
        }
    }
    return $array;
}