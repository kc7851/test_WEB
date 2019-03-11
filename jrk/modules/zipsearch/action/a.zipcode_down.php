<?php
if(!defined('__KIMS__')) exit;
include_once $g['path_core'].'function/rss.func.php';
include_once $g['dir_module'].'var/var.info.php';

$zipdata = getUrlData($zipvar['serverurl'],10);
if ($zipdata)
{
	$zipNum0 = explode("\n",$zipdata);
	$zipNum1 = count($zipNum0)-1;

	$varfile = $g['dir_module'].'var/var.info.php';
	$fp = fopen($zipdb,'w');
	fwrite($fp,$zipdata);
	fclose($fp);
	@chmod($zipdb,0707);

	$fp = fopen($varfile,'w');
	fwrite($fp, "<?php\n");
	fwrite($fp, "\$zipvar['serverurl'] = \"".$zipvar['serverurl']."\";\n");
	fwrite($fp, "\$zipvar['date'] = \"".$date['today']."\";\n");
	fwrite($fp, "\$zipvar['num'] = \"".$zipNum1."\";\n");
	fwrite($fp, "?>");
	fclose($fp);
	@chmod($varfile,0707);

	getLink('reload','','','');
}
else {
	getLink('','','우편번호데이터 서버가 응답하지 않습니다. 우편번호DB파일을 직접 등록해 주세요.','');
}
?>