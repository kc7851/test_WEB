<?php
include_once $g['path_core'].'function/rss.func.php';
include_once $g['path_module'].$module.'/var/var.info.php';
$maxupsize  = str_replace('M','',ini_get('upload_max_filesize'));
$zipcodenum = getUrlData(str_replace('zipcode.db','num.txt',$zipvar['serverurl']),10);
$zipcodearr = explode("\n",$zipcodenum);
$zipcodelen = count($zipcodearr);
$zipmessage = '현재 최신 우편번호 데이터를 유지하고 있습니다.';
if ($zipcodelen > $zipvar['num']) $zipmessage = '업데이트가 필요합니다.';
?>

<div id="zipbox">

	<form name="procForm" action="<?php echo $g['s']?>/" method="post" target="_action_frame_<?php echo $m?>" enctype="multipart/form-data" onsubmit="return saveCheck(this);">
	<input type="hidden" name="r" value="<?php echo $r?>" />
	<input type="hidden" name="m" value="<?php echo $module?>" />
	<input type="hidden" name="a" value="zipcode_update" />

	<div class="notice">
		우편번호DB를 실시간으로 업데이트할 수 있습니다.<br />
		업데이트 버튼을 클릭하시면 항상 최신데이터로 유지할 수 있습니다.<br />
		우편번호 업데이트 공지시 업데이트해 주세요.
	</div>

	<table>
		<tr>
			<td class="td1">데이터서버 주소</td>
			<td class="td2"> : <input type="text" name="serverurl" value="<?php echo $zipvar['serverurl']?>" size="60" class="input" /></td>
		</tr>
		<tr>
			<td class="td1"></td>
			<td class="td2 sfont">(데이터서버의 주소가 정확해야만 데이터 동기화가 가능합니다)</td>
		</tr>
		<tr>
			<td class="td1">마지막 업데이트</td>
			<td class="td2"> : <script type="text/javascript">getDateFormat('<?php echo $zipvar['date']?>','xxxx년 xx월 xx일');</script></td>
		</tr>
		<tr>
			<td class="td1">현재 검색지역수</td>
			<td class="td2 b"> : <?php echo number_format($zipvar['num'])?> </td>
		</tr>
		<tr>
			<td class="td1">현재 데이터상태</td>
			<td class="td2 red"> : <?php echo $zipmessage?> </td>
		</tr>
	</table>

	<div class="submitbox">
		<input type="button" value="우편번호검색" class="btngray btn" onclick="OpenWindow('<?php echo $g['s']?>/?r=<?php echo $r?>&m=zipsearch&zip1=zip1&zip2=zip2&addr1=addr1');" />
		<input type="submit" class="btnblue" value=" 업데이트 " />
	</div>

	</form>

</div>

<script type="text/javascript">
//<![CDATA[
var isUpdate = false;
function saveCheck(f)
{
	if (isUpdate == true)
	{
		alert('동기화 작업중입니다. 잠시만 기다려 주세요.');
		return false;
	}
	if(confirm('정말로 실행하시겠습니까?         '))
	{
		isUpdate = true;
		return isUpdate;
	}
}
//]]>
</script>

