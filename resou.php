<?php
header("Content-type: text/json; charset=utf-8");
function getSubstr($str, $leftStr, $rightStr)
{
    $left = strpos($str, $leftStr);
    //echo '左边:'.$left;
    $right = strpos($str, $rightStr,$left);
    //echo '<br>右边:'.$right;
    if($left < 0 or $right < $left) return '';
    return substr($str, $left + strlen($leftStr), $right-$left-strlen($leftStr));
}
$url="http://s.weibo.com/top/summary?cate=realtimehot"; 
//获取
$UserAgent = 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.0; SLCC1; .NET CLR 2.0.50727; .NET CLR 3.0.04506; .NET CLR 3.5.21022; .NET CLR 1.0.3705; .NET CLR 1.1.4322)';  
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);  
curl_setopt($curl, CURLOPT_HEADER, 0);  
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);   
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);  
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);  
curl_setopt($curl, CURLOPT_ENCODING, ''); 
curl_setopt($curl, CURLOPT_USERAGENT, $UserAgent);  
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);  
$data = curl_exec($curl);   
curl_close($curl); 
$data = getSubstr($data,'<td class=\"td_02\"><div class=\"rank_content\"><p class=\"star_name\">\n','<!-- share hot_band -->');

$reg = '#\/([%\A-Z\d]+)#';
preg_match_all($reg , $data , $matches);
$data = array_unique($matches[1]); //数组去重
$data = array_merge($data); //数组合并


for ($x=0; $x<=49; $x++) {
    $str = urldecode($data[$x]);//2次URL编码
  	$str = urldecode($str);
	$arr[] = $str;//数组输出
}
//打印数组
print_r ($arr);


