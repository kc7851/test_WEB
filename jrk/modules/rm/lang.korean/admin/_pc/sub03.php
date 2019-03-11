<?php
$sort	= $sort ? $sort : 'idx';
$orderby= $orderby ? $orderby : 'desc';
$recnum	= $recnum && $recnum < 200 ? $recnum : 8;

$searchFld = $_GET["searchFld"];
$searchTxt = $_GET["searchTxt"];
$edate = $_GET["edate"];
$sdate = $_GET["sdate"];

if ($sdate && $edate) $_WHERE = "connect_date >= '".$sdate."' and connect_date <= '".$edate."'" ;


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

$RCD = getDbArray('stw_media_connect_log ',$_WHERE,' * ',$sort,$orderby,$recnum,$p);
$NUM = getDbRows('stw_media_connect_log',$_WHERE);

$TPG = getTotalPage($NUM,$recnum);


?>
<link rel="stylesheet" href="/elearning/_core/css/jqueryUI/themes/base/jquery-ui.css" />
<script type="text/javascript">
//<![CDATA[
	$(function() {

		$( "#sdate" ).datepicker({

			showOn: "button",

			buttonImage: "/images/admin/calendar/icon_cal.gif",

			buttonImageOnly: true,      dateFormat :'yy-mm-dd' // 20130101

		});

	});

	$(function() {

		$( "#edate" ).datepicker({

		  showOn: "button",

		  buttonImage: "/images/admin/calendar/icon_cal.gif",

		  buttonImageOnly: true,      dateFormat :'yy-mm-dd' // 20130101

		});

	});

	function goDel2(){
	    var f = document.searchForm;
	    var f2 = document.regForm;
	    f2.media_log_delete_day.value = f.media_log_delete_day.options[f.media_log_delete_day.selectedIndex].value;
	    if (confirm('삭제 하시겠습니까?')) {
			f2.submit();
		}
	}



	function goDisConnect(code){
		if(confirm("해제 하시겠습니까?")){
			location.href="<?php echo $g['s']?>/?r=<?php echo $r?>&m=<?php echo $m?>&module=<?php echo $module?>&front=sub03_disconnect&code="+code;
		}
	}

	function goBlock(val, typecode, num){
		var strID = "";
		var strIP = "";
		if(typecode == "00201"){//ip
			strIP = val;
		}else if(typecode == "00202"){//member_id
			strID = val;
		}

		if (confirm('차단 하시겠습니까?')) {
			location.href="/elearning/?r=home&m=admin&module=drm&front=sub01_block&returnUrl=sub03&typeCode="+typecode+"&strID="+strID+"&strIP="+strIP+"&num="+num;
		}
	}

//]]>
</script>

<?php
	$cateNum['cate']	 = '10'; // 대메뉴 번호
	$cateNum['leftMenu'] = '4';	 // left 메뉴 번호
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
					<li><img src="/elearning/layouts/_blank/images/home.png" align='absMiddle'>  DRM 관리 > <span class="location">미디어서버 접속 로그</span></li>
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
								<th width="160"><b>접속일</b></th>
								<td width='350' bgcolor="#FFFFFF">
									<input id="sdate" class="box" style="width:100px; height:20px;" name="sdate" type="text" value=""/> ~
									<input id="edate" class="box" style="width:100px; height:20px;" name="edate" type="text" value=""/>
								</td>
								<th rowspan="2" width='160'><b>삭제</b></th>
								<td rowspan="2" bgcolor="#FFFFFF">
									<select name="media_log_delete_day">
										<option value="1">1달전</option>
										<option value="2">2달전</option>
										<option value="3">3달전</option>
									</select>
									 데이터 <a href="javascript:goDel2();"><img src="/images/admin/admin2/btn_delete.gif" align="absmiddle"/></a><br />
								</td>
							</tr>
							<tr>
								<th height="30">
									<select name="searchFld">
										<option value="member_id">아이디</option>
										<option value="ip"">아이피 (IP)</option>
									</select>
								</th>
								<td height="30" bgcolor="#FFFFFF">
									<input type="text" name="searchTxt" value="" style="height:20px;" class="box"/>
									<input type="image" value="검색" align="absmiddle" src="/images/admin/admin2/search1.gif" style="width:53px; height=20px; border:0">
								</td>
							</tr>
						</form>
						</table>
						<!-- //search -->
						<br />
							<!-- list table -->
							<form name="regForm" method="post" action="/elearning/?r=<?php echo($r); ?>&m=<?php echo($m); ?>&module=<?php echo($module); ?>&front=sub03_in">
							<input name="rqpn" type="hidden" id="rqpn" value="1" />
							<input type="hidden" name="code" value="">
							<input type="hidden" name="media_log_delete_day" />

						<div id="admin_list">
							<div class="bbsbody">
								<table>
									<colgroup>
										<col width="10%"></col>
										<col width="15%"></col>
										<col width="15%"></col>
										<col width="30%"></col>
										<col width="20%"></col>
										<col width="10%"></col>
									</colgroup>
									<thead>
										<tr align='center'>
											<th scope="col" class="side1">번호</th>
											<th scope="col">아이피</th>
											<th scope="col">아이디</th>
											<th scope="col">파일명</th>
											<th scope="col">접속일자</th>
											<th scope="col" class="side2">세션종료</th>
										</tr>
									</thead>
									<tbody>
									<?php $cnt=0; while($R=db_fetch_array($RCD)):

									$uname = getDbData('t_members','UserID="'.$R['member_id'].'"','uname');
									$disconnect_date = $R['disconnect_date'];

									if ( $disconnect_date == null ) {
										$disconnect_date = "<a href=\"javascript:goDisConnect('".$R['idx']."');\"><img src='/images/admin/btn_contactcancle2.gif' align='absmiddle'></a>";
									}

									$ipCount=getDbRows('stw_illegal_defense','ip="'.$R['ip'].'"'); //IP 차단
									//echo idx, client_ip, lookout_date, member_id, lookout_process_name, image_path, lookout_process_code, description, capture_body, hosting
									$mCount=getDbRows('stw_illegal_defense','member_id="'.$R['member_id'].'"'); // ID 차단

									?>
									<tr align="center" height="35" onmouseover="this.style.backgroundColor='#f1f1f1'" onmouseout="this.style.backgroundColor=''">
										<td><span class="style5"><?php echo $R['idx'];?></span></td>
										<td><span class="style5"><?php echo $R['ip'];?></span> &nbsp;
											<?php if ($ipCount > 0) {?>
												<img src='/images/admin/admin2/cut_o.gif' align='absmiddle'>
											<?php } else { ?>
												<a href="javascript:goBlock('<?php echo $R['ip'];?>', '00201','<?php echo $R['idx'];?>');"> <img src='/images/admin/admin2/cut_x.gif' align='absmiddle'></a>
											<?php } ?>
										</td>
										<td class="al2 style9">
											<?php echo $R['member_id'];?> <img src="/images/admin/common/dot_03.gif" /> <?php echo $uname[0];?>
											<?php if ($mCount > 0) {?>
												<img src='/images/admin/admin2/cut_o.gif' align='absmiddle'>
											<?php } else { ?>
												<a href="javascript:goBlock('<?php echo $R['member_id'];?>', '00202');"> <img src='/images/admin/admin2/cut_x.gif' align='absmiddle'></a>
											<?php } ?>
										</td>
										<td><span class="style5"><?php echo $R['url'];?></span></td>
										<td><span class="style5"><?php echo $R['connect_date'];?></span></td>
										<td><span class="style5"><?php echo $disconnect_date;?></span></td>
									</tr>
									<?php 
											$cnt++; 
											endwhile; 

											if($cnt == 0){
										?>
										<tr>
											<td colspan='7' height='70' align='center'>미디어 접속 정보가 없습니다.</td>
										</tr>
										<?php } ?>
									</tbody>

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
	