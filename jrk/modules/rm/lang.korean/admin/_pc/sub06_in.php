<?php
	
	if($_POST['chk']){
		$where = "";
		foreach($_POST['chk'] as $k => $v){
			if($where) $where .= " OR ";
			$where .= " idx = '".$v."' ";
		}

		getDbDelete('stw_drm_download', $where );
		$view = "삭제";
	}else{
		$idx = $_GET["idx"];
		
		getDbDelete('stw_drm_download', 'idx="'.$idx.'"' );
		$view = "삭제";
	}

echo "<script type='text/javascript' charset='utf-8'>
	<!--
	alert('".$view."되었습니다.');
	location.href='/elearning/?r=home&m=admin&module=drm&front=sub06';
	//-->
	</script>";	 

?>


