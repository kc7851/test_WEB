<?php
	$typeCode = $_GET["typeCode"];
	$strID = $_GET["strID"];
	$strIP = $_GET["strIP"];
	$num = $_GET["num"];
	
	$returnTemp = "none";
		
	// 이미차단됬는지 확인한다.
	if($typeCode == "00201"){
		//IP
		$strwhere = "typecode = '".$typeCode."' and ip = '".$strIP."'";
		$data = getDbRows('stw_illegal_defense',$strwhere);
			
		if ( $data > 0 ) {
			$returnTemp = "overlap";
		}
	}else if($typeCode == "00202"){		
		//ID
		$strwhere = "typecode = '".$typeCode."' and member_id = '".$strID."'";
		$data = getDbRows('stw_illegal_defense',$strwhere);
			
		if ( $data > 0 ) {
			$returnTemp = "overlap";
		}
	}
		
	if ($returnTemp == "overlap") {}
	else{
			
		
		$result = getDbSelect('stw_illegal_defense','','IFNull(MAX(idx),0) + 1 as maxIdx');
		$data = mysql_fetch_array($result);

		if ( $data == 0 ) {
			$strCodeTemp = "1";
		} Else {
			$strCodeTemp =$data[maxIdx];
		}
	
		for($i=1;$i<(9 - strlen($strCodeTemp));$i++){
			$strCodeTemp = "0".$strCodeTemp;
		}
			
			$strCode = "ide_".$strCodeTemp;
		//$strTemp = "캡쳐시도 현황에서 차단됨" ;urlencode(iconv("euc-kr","utf-8","캡쳐시도 현황에서 차단됨"));
		$strTemp = "캡쳐시도 현황에서 차단됨" ;urlencode("캡쳐시도 현황에서 차단됨");
		
		If ($typeCode == "00201"){
			// 아이피
			getDbInsert('stw_illegal_defense','code,typecode,ip,description,createdon','"'.$strCode.'","'.$typeCode.'","'.$strIP.'","'.$strTemp.'",now()');
		}
		If ($typeCode == "00202") {
			//아이디
			getDbInsert('stw_illegal_defense','code,typecode,member_id,description,createdon','"'.$strCode.'","'.$typeCode.'","'.$strID.'","'.$strTemp.'",now()');
		}

		//echo $strQuery2;
	}

if($_GET['returnUrl']){
	echo "<script type='text/javascript' charset='utf-8'>
		<!--
		alert('차단되었습니다.');
		location.href='/elearning/?r=home&m=admin&module=drm&front=".$_GET['returnUrl']."';
		//-->
		</script>";	 
}else{
	echo "<script type='text/javascript' charset='utf-8'>
		<!--
		alert('차단되었습니다.');
		location.href='/elearning/?r=home&m=admin&module=drm&front=sub01';
		//-->
		</script>";	 
}

?>


