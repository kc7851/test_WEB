<?php


$sort	= $sort ? $sort : 'no';
$orderby= $orderby ? $orderby : 'desc';
$recnum	= $recnum && $recnum < 200 ? $recnum : 20;



if ($marr1)
{
	if ($marr1==1) $_WHERE .= ' and marr1=0';
	else $_WHERE .= ' and marr1>0';
}
if ($mailing) $_WHERE .= ' and mailing='.($mailing-1);
if ($sms) $_WHERE .= ' and sms='.($sms-1);

if ($addr0)
{
	$_WHERE .= $addr0!='NULL'?" and addr0='".$addr0."'":" and addr0=''";
}
if ($where && $keyw) $_WHERE .= " and ".$where." like '%".trim($keyw)."%'";

//사이트선택적용

$RCD = getDbArray($table['online'],$_WHERE,'*',$sort,$orderby,$recnum,$p);
$NUM = getDbRows($table['online'],$_WHERE);
$TPG = getTotalPage($NUM,$recnum);


?>


<div id="mbrlist">


	<div class="sbox">
		<form name="procForm" action="<?php echo $g['s']?>/" method="get">
		<input type="hidden" name="r" value="<?php echo $r?>" />
		<input type="hidden" name="m" value="<?php echo $m?>" />
		<input type="hidden" name="module" value="<?php echo $module?>" />
		<input type="hidden" name="front" value="<?php echo $front?>" />
		

		<div>
		<select name="where">
		<option value="data_no1"<?php if($where=='data_no1'):?> selected="selected"<?php endif?>>회사명</option>
		<option value="data_no2"<?php if($where=='data_no2'):?> selected="selected"<?php endif?>>담당자</option>
		<option value="data_area"<?php if($where=='data_area'):?> selected="selected"<?php endif?>>내용</option>
		</select>

		<input type="text" name="keyw" value="<?php echo stripslashes($keyw)?>" class="input" />

		<input type="submit" value="검색" class="btnblue" />
		<input type="button" value="리셋" class="btngray" onclick="location.href='<?php echo $g['adm_href']?>';" />
		
		</div>

		</form>
	</div>


	<div class="info">

		<div class="article">
			<?php echo number_format($NUM)?>명(<?php echo $p?>/<?php echo $TPG?>페이지)
		</div>
		
		<div class="category">

		</div>
		<div class="clear"></div>
	</div>


	<form name="listForm" action="<?php echo $g['s']?>/" method="post" target="_action_frame_<?php echo $m?>">
	<input type="hidden" name="r" value="<?php echo $r?>" />
	<input type="hidden" name="m" value="<?php echo $module?>" />
	<input type="hidden" name="a" value="" />
	<input type="hidden" name="act" value="" />
	<input type="hidden" name="_WHERE" value="<?php echo $_WHERE?>" />
	<input type="hidden" name="_num" value="<?php echo $NUM?>" />


	<table summary="회원리스트 입니다.">
	<caption>회원리스트</caption> 
	<colgroup> 
	<col width="30">
	<col width="50"> 
	<col width="70"> 
	<col width="70"> 
	<col width="120"> 
	<col width="120"> 
	<col> 
	<col width="120">
	<col width="70">
	<col width="30">
	</colgroup> 
	<thead>
	<tr>
	<th scope="col" class="side1"><img src="<?php echo $g['img_core']?>/_public/ico_check_01.gif" alt="선택/반전" class="hand" onclick="chkFlag('mbrmembers[]');" /></th>
	<th scope="col">번호</th>
	<th scope="col">회사명</th>
	<th scope="col">담당자</th>
	<th scope="col">회사 전화번호</th>
	<th scope="col">이메일</th>
	<th scope="col">내용</th>
	<th scope="col">날짜</th>
	<th scope="col">삭제</th>
	<th scope="col" class="side2"></th>
	</tr>
	</thead>
	<tbody>
	<?php while($R=db_fetch_array($RCD)):?>
	<tr>
	<td class="side1"><input type="checkbox" name="mbrmembers[]" value="<?php echo $R['memberuid']?>" /></td>
	<td><?php echo ($NUM-((($p-1)*$recnum)+$_recnum++))?></td>
	<td><?php echo $R['data_no1']?></td>
	<td><?php echo $R['data_no2']?></td>
	<td><?php echo $R['data_no3']?></td>
	<td><?php echo $R['data_no4']?></td>
	<td onMouseOver="review_read('cm_<?php echo $R['no']?>')" onMouseOut="review_read('cm_<?php echo $R['no']?>')"><?php echo $R['data_area']?></td>
	<td><?php echo $R['date']?></td>
	<td><input class='btngray' type='button' value='삭제' onClick="window.location='<?php echo $g['s']?>/?r=home&m=admin&module=rm&front=main_in&no=<?php echo $R['no']?>'"/></td>
	<td></td>
	</tr>

	<tr  id="cm_<?php echo $R['no']?>" style='display:none;background:#EFEFEF;'>
		<td></td><td colspan="8" style="padding:10px 0 10px 0;"><?php echo $R['data_area']?></td><td></td>
	</tr>

	<?php endwhile?>
	</tbody>
	</table>

	<?php if(!$NUM):?>
	<div class="nodata"><img src="<?php echo $g['img_core']?>/_public/ico_notice.gif" alt="" /> 온라인 상담 내용이 없습니다.</div>
	<?php endif?>

	<div class="pagebox01">
		<script type="text/javascript">getPageLink(10,<?php echo $p?>,<?php echo $TPG?>,'<?php echo $g['img_core']?>/page/default');</script>
	</div>



	</form>



</div>

<script type="text/javascript">
//<![CDATA[
function review_read( id ) // 제목에 hover 시 보이게 하기
{
	show_id = document.all[id]

	if( show_id.style.display == 'table-row' )
	{
		show_id.style.display = 'none'
	}
	else
	{
		show_id.style.display = 'table-row'
	}
}

//]]>
</script>