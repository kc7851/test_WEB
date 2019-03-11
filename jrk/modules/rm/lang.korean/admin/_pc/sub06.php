<?php
$sort	= $sort ? $sort : 'idx';
$orderby= $orderby ? $orderby : 'desc';
$recnum	= $recnum && $recnum < 200 ? $recnum : 8;

$searchFld = $_GET["searchFld"];
$searchTxt = $_GET["searchTxt"];
$edate = $_GET["edate"];
$sdate = $_GET["sdate"];

if ($sdate && $edate) $_WHERE = "regdate >= '".$sdate."' and regdate < '".$edate."'" ;


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

$RCD = getDbArray('stw_drm_download a left join swes_s_mbrid b on a.userid = b.id left join swes_s_mbrdata c on b.uid = c.memberuid',$_WHERE,' a.*, c.name ',$sort,$orderby,$recnum,$p);
$NUM = getDbRows('stw_drm_download',$_WHERE);

$TPG = getTotalPage($NUM,$recnum);

//echo $NUM.'!|'.$NUM.'@|'.$TPG.'#|'.$p.'*|';
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

	function goDelete(idx){
		   if(confirm("삭제 하시겠습니까?")){
				if(idx == 'all'){
					document.frm_body.submit();
				}else{
					location.href="/elearning/?r=home&m=admin&module=drm&front=sub06_in&idx="+idx;
				}
			}
	}

	//체크박스 전체선택, 선택해제
	function checkall(checkname,thestate){
		var el_collection=document.frm_body.elements[checkname];
		if(el_collection != null)
		{
			if(el_collection.length){
				for (c=0;c<el_collection.length;c++)
				{
					el_collection[c].checked=thestate
					el_collection[c].parentNode.parentNode.className='listSelected';
				}
			}else{
				el_collection.checked=thestate;
			}
		}
	}

	function change_stat(){
		if(document.frm_body.totalcheck.checked == true){
			checkall('chk[]',true);
		}else{
			checkall('chk[]',false);
			//for(i=0;i<'10';i++)
			//{
				//document.getElementById("idname"+[i]).className="listBlur";
			//}
		}
	}

//]]>
</script>
<?php
	$cateNum['cate']	 = '10'; // 대메뉴 번호
	$cateNum['leftMenu'] = '7';	 // left 메뉴 번호
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
					<li><img src="/elearning/layouts/_blank/images/home.png" align='absMiddle'>  DRM 관리 > <span class="location">모바일 다운로드 현황</span></li>
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
						<input type="hidden" id="rqpn" name="rqpn" value="1" />
							<tr>
								<th width="160"><b>다운로드일자</b></th>
								<td bgcolor="#FFFFFF">
									<input name="sdate" type="text" id="sdate" class="box" style="width:100px; height:20px;" />
									&nbsp;&nbsp;
									<input name="edate" type="text" id="edate" class="box" style="width:100px; height:20px;" />
								</td>
							</tr>
							<tr>
								<th height="30">
									<select name="searchFld" id="searchFld">
										<option selected="selected" value="a.userid">아이디</option>
										<option value="b.uname">고객명</option>
										<option value="a.movietitle">컨텐츠명</option>
									</select>
								</th>
								<td height="30" bgcolor="#FFFFFF">
									<input name="searchTxt" type="text" id="searchTxt" style="width:220px;" class="box" onfocus="overInput(this);" onblur="outInput(this);" />
									<input type="image" name="SchBtn" id="SchBtn" align="absmiddle" src="/images/admin/admin2/search1.gif" style="border-width:0px;" />
									<a href="/elearning/?r=home&m=admin&module=drm&front=sub06"><img src="/images/admin/admin2/reset.gif" border="0" align="absmiddle" style="padding:3px 0 0 0;"></a>
								</td>
							</tr>
						</form>
						</table>
											
						<br>
						<!-- list table -->
						<form name="frm_body" method="post" action="<?php echo $g['s']?>/?r=<?php echo($r); ?>&m=<?php echo($m);?>&module=<?php echo($module); ?>&front=sub06_in" id="frm_body">
						<div id="admin_list">
							<div class="bbsbody">
								<table>
									<colgroup>
										<col width="5%"></col>
										<col width="10%"></col>
										<col width="10%"></col>
										<col width="10%"></col>
										<col width="40%"></col>
										<col width="15%"></col>
										<col width="10%"></col>
									</colgroup>
									<thead>
										<tr align='center'>
											<th scope="col" class="side1"><input class="nobdr" onclick="change_stat();" type="checkbox" value="checkbox" name="totalcheck" id="totalcheck"></th>
											<th scope="col">번호</th>
											<th scope="col">아이디</th>
											<th scope="col">고객명</th>
											<th scope="col">컨텐츠명</th>
											<th scope="col">다운로드일자</th>
											<th scope="col" class="side2">삭제</th>
										</tr>
									</thead>
									<tbody>
									<?php $cnt=0; while($R=db_fetch_array($RCD)): ?>
									<tr height="35" onmouseover="this.style.backgroundColor='#fefdf4'" onmouseout="this.style.backgroundColor=''">
										<td align="center"><input class="nobdr" type="checkbox" name="chk[]" id="chk[]" value="<?php echo $R['idx'];?>" onclick="chk_selected(this);"></td>
										<td align="center"><span class="style5"><?php echo $R['idx'];?></span></td>
										<td><span class="style5"><?php echo $R['userid'];?></span></td>
										<td><span class="style5"><?php echo $R['name'];?></span></td>
										<td class="al2 style5"><?php echo $R['movietitle'];?></td>
										<td><span class="style5"><?php echo $R['regdate'];?></span></td>
										<td><span class="style5"><a class="bt" href="javascript:goDelete('<?php echo $R['idx'];?>');"><img src="/images/admin/admin2/btn_delete.gif" /></a></span></td>
									</tr>
									<?php 
											$cnt++; 
											endwhile; 

											if($cnt == 0){
										?>
										<tr>
											<td colspan='7' height='70' align='center'>모바일 다운로드 정보가 없습니다.</td>
										</tr>
										<?php } ?>
									<span id="lblNoData"></span>
									<tr>
										<td colspan='7' style="text-align:left;"><img src="/images/admin/btn_selectDel.gif" onClick="goDelete('all');" style='cursor:pointer' /></td>
									</tr>
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
		