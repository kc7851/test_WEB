<?php
if(!defined('__KIMS__')) exit;

checkAdmin(0);
include_once $g['path_core'].'function/rss.func.php';

$zipdata = getUrlData($serverurl,10);
if (!$zipdata) getLink('','','데이터서버 주소를 확인하세요. 서버의 응답이 없습니다.','');

$zipfile = $g['dir_module'].'var/zipcode.db';
$varfile = $g['dir_module'].'var/var.info.php';

$zipNum0 = explode("\n",$zipdata);
$zipNum1 = count(file($zipfile));
$zipNum2 = count($zipNum0)-1;
if ($zipNum2 < 10000) getLink('','','데이터서버 주소를 확인하세요. 우편번호 데이터가 아닙니다.','');
if ($zipNum1 == $zipNum2) getLink('','','최신데이터가 적용된 상태입니다.','');

$fp = fopen($zipfile,'w');
fwrite($fp,$zipdata);
fclose($fp);
@chmod($zipfile,0707);

$fp = fopen($varfile,'w');
fwrite($fp, "<?php\n");
fwrite($fp, "\$zipvar['serverurl'] = \"".$serverurl."\";\n");
fwrite($fp, "\$zipvar['date'] = \"".$date['today']."\";\n");
fwrite($fp, "\$zipvar['num'] = \"".$zipNum2."\";\n");
fwrite($fp, "?>");
fclose($fp);
@chmod($varfile,0707);

getLink('reload','parent.','최신데이터로 갱신되었습니다.','');
?>