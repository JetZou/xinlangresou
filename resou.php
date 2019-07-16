<?php
header("Content-type: text/json; charset=utf-8");
include 'function.php';
$data = http_get("https://s.weibo.com/top/summary?cate=realtimehot");
$data = getSubstr($data, '<tbody>', '</tbody>');
preg_match_all('/weibo\?q=(.*)&Refer/' , $data , $matches);
for ($x=0; $x<=50; $x++) {
    $str = urldecode($matches[1][$x]);
    $str = str_replace("#","",$str);
    $str = str_replace("&topic_ad=1","",$str);
	$arr[] = $str;//数组输出
}
$arrer = json_encode($arr,JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT|JSON_FORCE_OBJECT);
echo $arrer;
