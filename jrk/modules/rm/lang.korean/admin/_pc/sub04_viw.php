<?php
	
	$searchFld = $_POST["searchFld"];
	$searchTxt = $_POST["searchTxt"];
	$p = $_POST["p"];
	$code = $_POST["code"];
	$stypecode = $_POST["stypecode"];


	if($p==''||$p==null){
		$p=1;
	}

	if($code == ""){
		$mode = "I";
	}else{
		$mode = "M";
	}

	$r_id=getDbData('stw_illegal_defense','idx="'.$code.'"','*');


?>
<script type="text/javascript">
//<![CDATA[
	function goSubmit(){
		 with(document.frm_body){
			if(typecode.value==""){
				alert("차단구분을 선택해주세요.");
				typecode.focus();
				return;
			}

			if(description.value.trim() == "" ){	//내용의 데이터 타입은 text이므로 최대값 풀어줌
				alert("description을 입력해주세요.");
				description.focus();
				return;
			}
			
			if (confirm('저장 하시겠습니까?')) { 
				document.frm_body.submit();
			}
		}
	}

	function goList(){
		location.href="/elearning/?r=home&m=admin&module=drm&front=sub04&p=<?php echo $p;?>&searchFld=<?php echo $searchFld;?>&searchFld=<?php echo $searchFld;?>&stypecode=<?php echo $stypecode;?>";
	}

	function goDelete(){
		if(confirm("삭제 하시겠습니까?")){
			document.frm_body.mode.value = "D";
			document.frm_body.submit();
		}
	}
//]]>
</script>
<?php
	$cateNum['cate']	 = '10'; // 대메뉴 번호
	$cateNum['leftMenu'] = '5';	 // left 메뉴 번호
	$cateNum['tabMenu']	 = '1';  // tab메뉴 번호
?>
<script>
	$('#amg<?php echo((int) $cateNum['cate']);?>').attr('src','/elearning/layouts/_blank/images/gnb_m<?php echo($cateNum['cate']);?>_ov.png');
	//$('#gnbSubmenu<?php echo((int) $cateNum['cate']);?>').css('display','block');
	$('#m<?php echo((int) $cateNum['cate']);?>_<?php echo((int) $cateNum['leftMenu']);?> > a').css('color','#ff9900');
</script>
<div id="masterContent">
	<div id="leftColumn">
		<div id="leftDiv">
			<?php include_once $_SERVER['DOCUMENT_ROOT']."/elearning/layouts/_blank/_cros/left_admin_".$cateNum['cate'].".php";	?>
		</div>
	</div>
	<div id="content2">
		<div id="con">
			<div id="location">
				<ul>
					<li><img src="/elearning/layouts/_blank/images/home.png" align='absMiddle'>  DRM 관리 > <span class="location">ID / IP 차단관리</span></li>
				</ul>
			</div>
			<?php // include_once $_SERVER['DOCUMENT_ROOT']."/elearning/layouts/_blank/_cros/tab_menu_".$cateNum['cate'].".php"; ?>
			<div id="siteHit">
				<ul>
					<li class="Tit1"><img src="/elearning/layouts/_blank/images/subtitle/<?php echo($cateNum['cate']);?>/t<?php echo((int) $cateNum['cate']);?>_<?php echo($cateNum['leftMenu']);?>.png"></li>
					<li class="subContents">
						<table  width='100%' id='boardS1'>
						<form name="frm_body" method="post" action="/elearning/?r=home&m=admin&module=drm&front=sub04_in" id="frm_body">
						<input type="hidden" name="code" id="code" value="<?php echo $code;?>"/>
						<input type="hidden" name="searchFld" id="searchFld" value="<?php echo $searchFld;?>"/>
						<input type="hidden" name="searchTxt" id="searchTxt" value="<?php echo $searchTxt;?>"/>
						<input type="hidden" name="p" id="p" value="<?php echo $p;?>"/>
						<input type="hidden" name="stypecode" id="typecode" value="<?php echo $stypecode;?>"/>
						<input type="hidden" name="mode" id="mode" value="<?php echo $mode;?>"/>
							<tr>
								<th style="width:120px;"><b>차단구분</b></th>
								<td>
									<select name="typecode" id="typecode">
										<option value="">선택해주세요.</option>
										<option value="00201" <?php if ($r_id['typecode'] == "00201") echo "selected" ; ?>>차단 IP</option>
										<option value="00202" <?php if ($r_id['typecode'] == "00202") echo "selected" ; ?>>차단 ID</option>
									</select>
								</td>
							</tr>
							<tr>
								<th><b>회원아이디</b></th>
								<td>
									<input name="member_id" type="text" id="member_id" maxlength="20" value="<?php echo $r_id['member_id'];?>" />
								</td>
							</tr>
							<tr>
								<th ><b>아이피</b></th>
								<td>
									<input name="ip" type="text" id="ip" maxlength="20" value="<?php echo $r_id['ip'];?>" />
								</td>
							</tr>
							<tr>
								<th><b>호스팅 주소</b></th>
								<td>
									<input name="hosting" type="text" id="hosting" maxlength="20" value="<?php echo $r_id['hosting'];?>" />
								</td>
							</tr>
							<tr>
								<th  ><b>설명</b></th>
								<td>
									<textarea name="description" id="description" style="width: 99%; height: 170px" title="설명"><?php echo $r_id['description'];?></textarea>
								</td>
							</tr>
							<tr style="display:none">
								<th><b>맥 주소</b></th>
								<td>
									<input name="mapaddr" type="text" id="mapaddr" maxlength="20" value="<?php echo $r_id['mapaddr'];?>" />
								</td>
							</tr>
							
							<tr>
								<td  align="center" align='center' colspan='2' class='noLine'>
									<a class="bt" href="javascript:goSubmit();"><img src="/images/admin/bu_confirm_gray.gif" /></a>
									<a class="bt" href="javascript:goList();"><img src="/images/admin/list_button.gif" /></a>
									<a class="bt" href="javascript:goDelete();"><img src="/images/admin/admin2/btn_cutcancle2.gif" /></a>	
								</td>
							</tr>
						</form>
						</table>
					</li>
				</ul>
			</div>
	