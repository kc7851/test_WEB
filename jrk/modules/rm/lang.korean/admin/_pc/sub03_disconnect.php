<?php

$code = $_GET["code"];

if ($code == "" ) {
	echo "<script type='text/javascript' charset='utf-8'>
	<!--
	alert('입력 양식이 비어있습니다');
	history.go(-1);
	//-->
	</script>";	 
}

getDbUpdate('stw_media_connect_log','disconnect_date = now()','idx="'.$code.'"');

//echo "code=".$code;


if($_GET['returnUrl']){
	echo "<script type='text/javascript' charset='utf-8'>
		<!--
		alert('정상적으로 접속해제 되었습니다.');
		location.href='/elearning/?r=home&m=admin&module=drm&front=".$_GET['returnUrl']."';
		//-->
		</script>";	 
}else{
	echo "<script type='text/javascript' charset='utf-8'>
		<!--
		alert('정상적으로 접속해제 되었습니다.');
		location.href='/elearning/?r=home&m=admin&module=drm&front=sub03';
		//-->
		</script>";	 
}
?>


