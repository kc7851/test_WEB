<?php
$sort	= $sort ? $sort : 'idx';
$orderby= $orderby ? $orderby : 'desc';
$recnum	= $recnum && $recnum < 200 ? $recnum : 8;

$searchFld = $_GET["searchFld"];
$searchTxt = $_GET["searchTxt"];
$stypecode = $_GET["stypecode"];

if ($stypecode != "" ) $_WHERE = "typecode = '".$stypecode."'" ;


if ($searchFld && $searchTxt) {
	if ($_WHERE != "" ) {
		$_WHERE .= " and ".$searchFld." like '%".trim($searchTxt)."%'";
	} else {
		$_WHERE = $searchFld." like '%".trim($searchTxt)."%'";
	}
}


if($p==''||$p==null){
 $p=1;
}

//echo $searchFld . " | " . $searchTxt;
//echo $_WHERE;

$RCD = getDbArray('stw_illegal_defense ',$_WHERE,' * ',$sort,$orderby,$recnum,$p);
$NUM = getDbRows('stw_illegal_defense',$_WHERE);

$TPG = getTotalPage($NUM,$recnum);

//echo $NUM.'!|'.$NUM.'@|'.$TPG.'#|'.$p.'*|';
?>
<script type="text/javascript">
//<![CDATA[
function goView(code){
		var frm = document.theForm;
		if(code){
			frm.code.value = code;
		}else{
			frm.code.value ="";
		}
		frm.action = "/elearning/?r=home&m=admin&module=drm&front=sub04_viw";
		frm.submit();
}

function goDelete(code){
	    var f = document.theForm;;
	    f.code.value = code;
        if(confirm("차단해제 하시겠습니까?")){
			f.mode.value = "D";
			f.submit();
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
						<!-- search -->
						<table width='100%' id='pTable'>
						<form id="searchForm" name="searchForm" method="get" action="<?php echo $g['s']?>/">
						<input type="hidden" name="r" value="<?php echo $r?>" />
						<input type="hidden" name="m" value="<?php echo $m?>" />
						<input type="hidden" name="module" value="<?php echo $module?>" />
						<input type="hidden" name="front" value="<?php echo $front?>" />

							<tr>
								<th width="160"><b>차단구분</b></th>
								<td height="30" bgcolor="#FFFFFF">
									<select name="stypecode" id="typecode">
										<option value="">선택해주세요.</option>
										<option value="00202">차단 ID</option>
										<option value="00201">차단 IP</option>
									</select>
								</td>
								<td width='50' valign='bottom' rowspan='2'><a href="javascript:goView();"><img src="/images/admin/bu_input2_orange.gif" border="0" /></a></td>
							</tr>
							<tr>
								<th height="30">
									<select name="searchFld">
										<option value="member_id">아이디</option>
										<option value="ip"">아이피 (IP)</option>
									</select>
								</th>
								<td height="30"  bgcolor="#FFFFFF">
									<input type="text" name="searchTxt" value="" style="width:220px; height:20px;" class="box"/>
									<input type="image" value="검색" align="absmiddle" src="/images/admin/admin2/search1.gif" style="width:53px; height=20px; border:0" >
								</td>
							</tr>
						</table>
						
						<!-- SearchbuttonCenter -->
						<div id="buttonSc"><br />
						<!-- list table -->
						</div>
						</form>

						<!-- list table -->
						<form name="theForm" method="post" action="/elearning/?r=home&m=admin&module=drm&front=sub04_in">
						<input name="rqpn" type="hidden" id="rqpn" value="1" />
						<input type="hidden" name="code" value="">
						<input type="hidden" name="searchFld" value="<?php echo $searchFld;?>"/>
						<input type="hidden" name="searchTxt" value="<?php echo $searchTxt;?>"/>
						<input type="hidden" name="p" value="<?php echo $p;?>"/>
						<input type="hidden" name="stypecode" value="<?php echo $stypecode;?>"/>
						<input type="hidden" name="mode" value="">

						<div id="admin_list">
							<div class="bbsbody">
								<table>
									<colgroup>
										<col width="20%"></col>
										<col width="20%"></col>
										<col width="20%"></col>
										<col width="20%"></col>
										<col width="20%"></col>
									</colgroup>
									<thead>
										<tr align='center'>
											<th scope="col" class="side1">차단구분</th>
											<th scope="col">아이피</th>
											<th scope="col">아이디</th>
											<th scope="col">차단일</th>
											<th scope="col" class="side2">차단해제</th>
										</tr>
									</thead>
									<tbody>
									<?php $cnt=0; while($R=db_fetch_array($RCD)):

									if ($R[2] == "00202") {
										$typecode_w = "차단 ID";
									} else {
										$typecode_w = "차단 IP";
									}

									?>

									<tr align="center" height="40" onmouseover="this.style.backgroundColor='#F1F1F1'" onmouseout="this.style.backgroundColor=''">
										<td><span class="style5"><a href="javascript:goView('<?php echo $R[0];?>');" ><?php echo $typecode_w;?></a></span></td>
										<td><span class="style5"><a href="javascript:goView('<?php echo $R[0];?>');" ><?php echo $R[3];?></a></span></td>
										<td class="al2 style9"><a href="javascript:goView('<?php echo $R[0];?>');" ><?php echo $R[6];?></a></td>
										<td><span class="style5"><a href="javascript:goView('<?php echo $R[0];?>');" ><?php echo $R[7];?></a></span></td>
										<td><span class="style5"><a class="bt" href="javascript:goDelete('<?php echo $R[0];?>');"><img src="/images/admin/admin2/btn_cutcancle.gif" /></a></span></span></td>
									</tr>

									<?php 
											$cnt++; 
											endwhile; 

											if($cnt == 0){
										?>
										<tr>
											<td colspan='7' height='70' align='center'>ID / IP 차단 정보가 없습니다.</td>
										</tr>
										<?php } ?>

								<span id="lblNoData"></span>
								</table>
							</div>
						</div>
						</form>
						<br>
						<div class="pagebox01" style="text-align:center">
							<script type="text/javascript">getPageLink(10,<?php echo $p?>,<?php echo $TPG?>,'/images/page/default');</script>
						</div>
					</li>
				</ul>
			</div>
	