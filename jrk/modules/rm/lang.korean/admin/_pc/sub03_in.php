<?php

$beforeDay = $_POST["media_log_delete_day"];

//echo "CD : ".$beforeDay."<BR>";
//echo "chkCode : ".$idx."<BR>";

if ($beforeDay != "") { //기간으로 데이터 삭제
				
	switch($beforeDay){
	 Case "1" ; $beforeDate = date("Y-m-d", strtotime("-1 month")); break;
	 Case "2" ; $beforeDate = date("Y-m-d", strtotime("-2 month")); break;
	 Case "3" ; $beforeDate = date("Y-m-d", strtotime("-3 month")); break;
	}

	if ($beforeDay == "" ) {
		$strwhere = " 1=1 " ;
	} else {
		$strwhere = " connect_date <=  '".$beforeDate."'" ;
	}
} 

//echo "strwhere : ".$strwhere."<BR>";


$data = getDbRows('stw_media_connect_log',$strwhere);
//echo "data : ".$data."<BR>";

if ( $data > 0 ) {				
	getDbDelete('stw_media_connect_log', $strwhere );
}


echo "<script type='text/javascript' charset='utf-8'>
	<!--
	alert('데이터를 삭제 했습니다.');
	location.href='/elearning/?r=home&m=admin&module=drm&front=sub03';
	//-->
	</script>";	 

?>


