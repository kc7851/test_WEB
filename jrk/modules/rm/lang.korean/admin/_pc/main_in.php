<?php
if($no){

	getDbDelete($table['online'],'no='.$no);

	echo "<script type='text/javascript' charset='utf-8'>
	<!--
	alert('삭제되었습니다.');
	location.href='".$g['s']."/?r=home&m=admin&module=rm&front=main';
	//-->
	</script>";
	
}else{

	echo "<script type='text/javascript' charset='utf-8'>
	<!--
	alert('정상적으로 삭제되지 않았습니다. 관리자에게 문의 하십시오.');
	location.href='".$g['s']."/?r=home&m=admin&module=rm&front=main';
	//-->
	</script>";
	
}

?>


