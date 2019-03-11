<?php
if(!defined('__KIMS__')) exit;

checkAdmin(0);

if($folder)
{
	$folder = $_POST['folder'];
	if(!trim($folder)) getLink('', '', '정상적인 접속이 아닙니다.', '');
}
if($newfile)
{
	$newfile = $_POST['newfile'];
	if(!trim($newfile)) getLink('', '', '정상적인 접속이 아닙니다.', '');
}

$folder = './'.str_replace('./','',$folder);
$nFile = $folder.getUTFtoKR($newfile);

$fp = fopen($nFile,'w');
fwrite($fp,trim(stripslashes($content)));
fclose($fp);
@chmod($nFile,0707);

getLink('reload','parent.',$alert,$history);
?>