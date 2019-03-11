<?php
	$sort	= $sort ? $sort : 'idx';
	$orderby= $orderby ? $orderby : 'desc';
	$recnum	= $recnum && $recnum < 200 ? $recnum : 8;

	$searchFld = $_GET["searchFld"];
	$searchTxt = $_GET["searchTxt"];
	$edate = $_GET["edate"];
	$sdate = $_GET["sdate"];

	if ($sdate && $edate) $_WHERE = "lookout_date >= '".$sdate."' and lookout_date < '".$edate."'" ;


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

	$RCD = getDbArray('stw_illegal_capture_list',$_WHERE,'idx, client_ip, lookout_date, member_id, lookout_process_name, image_path, lookout_process_code, description, capture_body, hosting',$sort,$orderby,$recnum,$p);
	$NUM = getDbRows('stw_illegal_capture_list',$_WHERE);

	$TPG = getTotalPage($NUM,$recnum);

	//echo $NUM.'!|'.$NUM.'@|'.$TPG.'#|'.$p.'*|';

?>
<link rel="stylesheet" href="/elearning/_core/css/jqueryUI/themes/base/jquery-ui.css" />
<script type="text/javascript">
//<![CDATA[
		function change_stat()
		{
			if(frm_body.totalcheck.checked == true) {
				checkAll=true;
				checkall('frm_body','chk[]',true);
			}
			else {
				checkAll=false;
				checkall('frm_body','chk[]',false);
				//for(i=0;i<'10';i++)
				//{
					//document.getElementById("idname"+[i]).className="listBlur";
				//}
			}
		}

		//체크박스 전체선택, 선택해제
		function checkall(formname,checkname,thestate){

			var el_collection=eval("document."+formname+".elements['"+checkname+"']");
			if(el_collection != null)
			{
				if(el_collection.length){
					for (c=0;c<el_collection.length;c++)
					{
						el_collection[c].checked=thestate
						el_collection[c].parentNode.parentNode.className='listSelected';
					}

				}
				else{
					el_collection.checked=thestate;
				}
			}
		}

		function view_image(image_url) {
				view_popup = window.open('','v_p','left=0,top=0,resizable=yes');
				view_popup.document.open();
				view_popup.document.write('<html>\n'+
							'<head>\n'+
							'<title>캡쳐화면 리스트</title>\n'+
							'<sc'+'ript language="javascript">\n'+
							'<!'+'--\n'+
							'function view_popup_resize() {\n'+
							'\tvar original_image_width = document.all.original_image.width + 15;\n'+
							'\tvar original_image_height = document.all.original_image.height + 80;\n\n'+
							'\tresizeTo(original_image_width,original_image_height);\n'+
							'}\n'+
							'function move() {\n'+
							'window.scroll(window.event.clientX - 70,window.event.clientY -50)\n'+
							'}\n'+
							'document.onmousemove = move\n'+
							'//'+'-->\n'+
							'</sc'+'ript>\n'+
							'</head>\n'+
							'<body scroll="no" leftmargin="0" topmargin="0">\n'+
							'<table border="0" width="100%" height="100%" cellspacing="0" cellpadding="0">\n'+
							'<tr>\n'+
							'<td align="center">\n'+
							'<a href="#" onclick="window.close();" onfocus="this.blur();">\n'+
							'<img src="'+image_url.replace('_s','')+'" name="original_image" onload="view_popup_resize();" border="0"></a>\n'+
							'</td>\n'+
							'</tr>\n'+
							'</table>\n'+
							'</body>\n'+
							'</html>');
				view_popup.document.close();
				view_popup.document.focus();
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
			location.href="/elearning/?r=home&m=admin&module=drm&front=sub01_block&&typeCode="+typecode+"&strID="+strID+"&strIP="+strIP+"&num="+num;
		   }
		}

		function goCodeDel(){
		   if(confirm("삭제 하시겠습니까?")){
				var f = document.frm_body;

				var strGroupList = "";
				var ObjList = f.elements['chk[]'];
				var nIDCnt = 0;

				if (ObjList == null) {
					alert("항목을 선택하세요");
					return;
				}

				var nCnt = ObjList.length;
				if (nCnt > 1) {
					for (n = 0; n < nCnt; n++) {
						if (ObjList[n].checked) {
							if (nIDCnt == 0) {
								strGroupList += ObjList[n].value;
								nIDCnt += 1;
							}
							else
								strGroupList += "," + ObjList[n].value;
						}
					}
				}
				else {
					if (ObjList.checked)
						strGroupList = ObjList.value;
				}
				if (strGroupList.length <= 0) {
					alert("항목을 선택하세요");
					return;
				}
				f.ListID.value = strGroupList;



				f.submit();
		   }
		}

		function goDel(){
				var f = document.searchForm;
				var f2 = document.frm_body;
				f2.capture_image_delete_day.value = f.capture_image_delete_day.options[f.capture_image_delete_day.selectedIndex].value;
				if (confirm('삭제 하시겠습니까?')) {
					f2.submit();
				}
			}
//]]>
</script>
<script>
	$(function() {
		$( "#sdate" ).datepicker({
			showOn: "button",
			buttonImage: "/images/admin/calendar/icon_cal.gif",
			buttonImageOnly: true,
			dateFormat :'yy-mm-dd' // 20130101
		});
	});

	$(function() {
		$( "#edate" ).datepicker({
			showOn: "button",
			buttonImage: "/images/admin/calendar/icon_cal.gif",
			buttonImageOnly: true,
			dateFormat :'yy-mm-dd' // 20130101
		});
	});
</script>
<script language="JavaScript" src="/share/js/sys.js"></script>

<!-- search -->
<?php
	$cateNum['cate']	 = '10'; // 대메뉴 번호
	$cateNum['leftMenu'] = '2';	 // left 메뉴 번호
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
					<li><img src="/elearning/layouts/_blank/images/home.png" align='absMiddle'>  DRM 관리 > <span class="location">캡쳐/다운현황</span></li>
				</ul>
			</div>
			<?php // include_once $_SERVER['DOCUMENT_ROOT']."/elearning/layouts/_blank/_cros/tab_menu_".$cateNum['cate'].".php"; ?>
			<div id="siteHit">
				<ul>
					<li class="Tit1"><img src="/elearning/layouts/_blank/images/subtitle/<?php echo($cateNum['cate']);?>/t<?php echo((int) $cateNum['cate']);?>_<?php echo($cateNum['leftMenu']);?>.png"></li>
					<li class="subContents">
						<table width='100%' id='pTable'>
						<form id="searchForm" name="searchForm" method="get" action="<?php echo $g['s']?>/">
						<input type="hidden" name="r" value="<?php echo $r?>" />
						<input type="hidden" name="m" value="<?php echo $m?>" />
						<input type="hidden" name="module" value="<?php echo $module?>" />
						<input type="hidden" name="front" value="<?php echo $front?>" />
						<input type="hidden" name="rqpn" id="rqpn" value="1" />
						<input type="hidden" name="menudiv" value="9" />
							<tr>
								<th width="120px"><b>접속일</b></th>
								<td width="350" bgcolor="#FFFFFF">
									<input id="sdate" class="box" style="width:100px;height:18px;" name="sdate" type="text" value=""/> ~
									<input id="edate" class="box" style="width:100px;height:18px;" name="edate" type="text" value=""/></td>
								<th width="120px" rowspan="2" style="text-align:center;"><b>삭제</b></th>
								<td rowspan="2" bgcolor="#FFFFFF">
									<select name="capture_image_delete_day">
										<option value="1">1달전</option>
										<option value="2">2달전</option>
										<option value="3">3달전</option>
									</select>
									데이터 <a href="javascript:goDel();"><img src="/images/admin/admin2/btn_delete.gif" align="absmiddle"/></a>
								</td>
							</tr>
							<tr>
								<th>
									<select name="searchFld" id="searchFld">
										<option value="member_id">아이디</option>
										<option value="client_ip"">아이피 (IP)</option>
									</select>
								</th>
								<td bgcolor="#FFFFFF">
									<input type="text" name="searchTxt" value="" style="width:220px; height:18px;" class="box" />
									<input type="image" align="absmiddle" src="/images/admin/admin2/search1.gif" style="width:53px; height=20px; border:0"/>
								</td>
							</tr>
						</form>
						</table>
						<br>
						<form name="frm_body" method="post" action="/elearning/?r=home&m=admin&module=drm&front=sub01_in" id="frm_body">
						<input type="hidden" name="capture_image_delete_day"/>
						<input type="hidden" name="ListID" value="">
						<div id="admin_list">
							<div class="bbsbody">
								<table>
									<colgroup>
										<col width="5%"></col>
										<col width="5%"></col>
										<col width="15%"></col>
										<col width="10%"></col>
										<col width="10%"></col>
										<col width="15%"></col>
										<col width="30%"></col>
										<col width="10%"></col>
									</colgroup>
									<thead>
										<tr align='center'>
											<th scope="col" class="side1"><input class="nobdr" onclick="change_stat();" type="checkbox" value="checkbox" name="totalcheck" id="totalcheck"></th>
											<th scope="col">번호</th>
											<th scope="col">아이피</th>
											<th scope="col">아이디</th>
											<th scope="col">캡쳐툴명</th>
											<th scope="col">캡쳐이미지</th>
											<th scope="col">캡쳐내용</th>
											<th scope="col" class="side2">감시날짜</th>
										</tr>
									</thead>
									<tbody>

								<?php $cnt=0; while($R=db_fetch_array($RCD)):
									$ipCount=getDbRows('stw_illegal_defense','ip="'.$R['client_ip'].'"'); //IP 차단
									//echo idx, client_ip, lookout_date, member_id, lookout_process_name, image_path, lookout_process_code, description, capture_body, hosting
									$mCount=getDbRows('stw_illegal_defense','member_id="'.$R['member_id'].'"'); // ID 차단
								?>
										<tr align="center" height="35" onmouseover="this.style.backgroundColor='#F1F1F1'" onmouseout="this.style.backgroundColor=''" bgcolor="#FFFFFF">
											<td><input class="nobdr" type="checkbox" name="chk[]" id="chk[]" value="<?php echo $R['idx'];?>" onclick="chk_selected(this);"></td>
											<td><span class="style5"><?php echo $R['idx'];?></td>
											<td><span class="style5"><a href="javascript:centerPop('/Em/Etcs/GetOtherSiteSources.aspx?U_rl=h_t_t_p_www.ipsearch.co.kr/Search.aspxq_uery=115.90.152.146', 800, 600, 'yes', 1);"><?php echo $R['client_ip'];?></a>
												<?php if ($ipCount > 0) {?>
													<img src='/images/admin/admin2/cut_o.gif' align='absmiddle'>
												<?php } else { ?>
													<a href="javascript:goBlock('<?php echo $R['client_ip'];?>', '00201','<?php echo $R['idx'];?>');"> <img src='/images/admin/admin2/cut_x.gif' align='absmiddle'></a>
												<?php } ?>
												</td>
												<td  class="al2 style5"><a href="javascript:goMemberView('1816059307372950');"><?php echo $R['member_id'];?></a>
												<?php if ($mCount > 0) {?>
													<img src='/images/admin/admin2/cut_o.gif' align='absmiddle'>
												<?php } else { ?>
													<a href="javascript:goBlock('<?php echo $R['member_id'];?>', '00202');"> <img src='/images/admin/admin2/cut_x.gif' align='absmiddle'></a>
												<?php } ?>
											</td>
											<td><span class="style5"><?php echo $R['lookout_process_name'];?></td>
											<td><img src="<?php echo $R['image_path'];?>" border="0" style="width:100px;height:80px;cursor:pointer" onclick="view_image(this.src);" ></td>
											<td><span class="style5"><?php echo $R['capture_body'];?></td>
											<td><span class="style5"><span class="style5"><?php echo $R['lookout_date'];?></td>
										</tr>
										<?php 
											$cnt++; 
											endwhile; 

											if($cnt == 0){
										?>
										<tr>
											<td colspan='7' height='70' align='center'>캡쳐 / 다운 정보가 없습니다.</td>
										</tr>
										<?php } ?>
										<span id="lblNoData"></span>
									</tbody>
								</table>
								<table width=100% border=0 cellpadding=8 cellspacing=1>
									<tr style="height:30px;">
										<td style="text-align:left;padding-left:15px;" >
											<a href="javascript:goCodeDel();"><img src="/images/admin/btn_selectDel.gif" /></a>
										</td>
									</tr>
								</table>
							</div>
						</div>
						</form>
						<br />
						<div class="pagebox01" style="text-align:center;">
							<script type="text/javascript">getPageLink(10,<?php echo $p?>,<?php echo $TPG?>,'/images/page/default');</script>
						</div>

					</li>
				</ul>
			</div>
		