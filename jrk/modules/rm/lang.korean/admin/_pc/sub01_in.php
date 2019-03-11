<?php
	
	
	$beforeDay = $_POST["capture_image_delete_day"];
	$idx = $_POST["ListID"];
	echo "CD : ".$beforeDay."<BR>";
	echo "chkCode : ".$idx."<BR>";
	
	if ($beforeDay != "") { //기간으로 데이터 삭제
		switch($beforeDay){
			Case "1" ; $beforeDate = date("Y-m-d", strtotime("-1 month")); break;
			Case "2" ; $beforeDate = date("Y-m-d", strtotime("-2 month")); break;
			Case "3" ; $beforeDate = date("Y-m-d", strtotime("-3 month")); break;
		}

		if ($beforeDay == "" ) {
			$strwhere = " 1=1 " ;
		}else{
			$strwhere = " lookout_date <=  '".$beforeDate."'" ;
		}

	}else{ //선택삭제
		$strwhere = "";
		foreach($_POST['chk'] as $k => $v){
			if($strwhere != "") $strwhere .= " OR ";
			$strwhere .= " idx = '".$v."' ";
		}

	//$NUM = getDbRows('stw_illegal_capture_list',$strwhere);
	//echo("strwhere : ".$strwhere."<BR>");

	if($NUM > 0){
		$result2 = getDbSelect('stw_illegal_capture_list',$strwhere , 'image_path');
		while($data2 = db_fetch_array($result2)) {
			$img_path = str_replace('../../..','',$data2[image_path]);
			$tmp = explode("/",$img_path);
			if($tmp[count($tmp)-1] != ""){	// 파일명이 없으면 폴더 전체가 지워지기때문에
				if(is_file($_SERVER[DOCUMENT_ROOT].$img_path)){
					unlink($_SERVER[DOCUMENT_ROOT].$img_path);	// 원본 파일 삭제
					$thumb = str_replace($tmp[count($tmp)-1],"s_".$tmp[count($tmp)-1],$img_path);
					unlink($_SERVER[DOCUMENT_ROOT].$thumb);	// 섬내일 삭제
				}
			}
		}
		
		getDbDelete('stw_illegal_capture_list', $strwhere );
	}


	//getDbUpdate('t_stw_default_settings','val="'.$change_date.'"','div_="change_date"');
	//getDbUpdate('t_stw_default_settings','val="'.$change_count.'"','div_="change_count"');
	//getDbUpdate('t_stw_default_settings','val="'.$ip_defense_auto.'"','div_="ip_defense_auto"');


	echo "<script type='text/javascript' charset='utf-8'>
		<!--
		alert('수정되었습니다.');
		location.href='/elearning/?r=home&m=admin&module=drm&front=sub01';
		//-->
		</script>";	 

?>


