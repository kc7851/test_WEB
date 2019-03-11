<?php
$searchFld = $_POST["searchFld"];
$searchTxt = $_POST["searchTxt"];
$p = $_POST["p"];
$code = $_POST["code"];
$stypecode = $_POST["stypecode"];
$mode = $_POST["mode"];

$typecode = $_POST["typecode"];
$member_id = $_POST["member_id"];
$ip = $_POST["ip"];
$description = $_POST["description"];

$hosting = $_POST['hosting'];

switch($mode){
 Case "I" ;  //입력
	
	$result = getDbSelect('stw_illegal_defense','','IFNull(MAX(idx),0) + 1 as maxIdx');
	$data = mysql_fetch_array($result);

	if ( $data == 0 ) {
		$strCodeTemp = "1";
	} Else {
		$strCodeTemp =$data[maxIdx];
	}
	
	for($i = 1;$i < (9 - strlen($strCodeTemp));$i++) {
		$strCodeTemp = "0".$strCodeTemp;
	}
	
	$strCode = "ide_".$strCodeTemp;

	if ($typecode == "00202"){
		// 아이디
		getDbInsert('stw_illegal_defense','code,typecode,member_id,description,createdon, hosting','"'.$strCode.'","'.$typecode.'","'.$member_id.'","'.$description.'",now(),"'.$hosting.'"');
	}else if ($typeCode == "00201"){
		//아이피
		getDbInsert('stw_illegal_defense','code,typecode,ip, description,createdon, hosting','"'.$strCode.'","'.$typecode.'","'.$ip.'","'.$description.'",now(), "'.$hosting.'"');
	}

	echo $typeCode;

	$view = "저장";

	break;
 Case "M" ; //수정
	
	getDbUpdate('stw_illegal_defense','typecode="'.$typecode.'", ip="'.$ip.'" , description="'.$description.'" , member_id="'.$member_id.'" , hosting="'.$hosting.'" ','idx="'.$code.'"');
	$view = "수정";

	break;
 Case "D" ; //삭제
	
	getDbDelete('stw_illegal_defense', 'idx="'.$code.'"' );
	$view = "삭제";

	break;
}

//echo "CD : ".$beforeDay."<BR>";
//echo "chkCode : ".$idx."<BR>";




echo "<script type='text/javascript' charset='utf-8'>
	<!--
	alert('".$view."되었습니다.');
	location.href='/elearning/?r=home&m=admin&module=drm&front=sub04';
	//-->
	</script>";	 

?>


