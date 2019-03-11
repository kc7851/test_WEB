

<div id="bbslist">

	<div class="info">

		<div class="article">
			<?php echo number_format($NUM+count($NCD))?>개(<?php echo $p?>/<?php echo $TPG?>페이지)
			<?php if($d['bbs']['rss']):?><a href="<?php echo $g['r']?>/?m=<?php echo $m?>&amp;bid=<?php echo $B['id']?>&amp;mod=rss" target="_blank"><img src="<?php echo $g['img_core']?>/_public/ico_rss.gif" alt="rss" /></a><?php endif?>
		</div>
		
		<div class="category">
			<?php if($my['admin']):?>
			<a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=admin&amp;module=<?php echo $m?>&amp;&amp;uid=<?php echo $B['uid']?>"><img src="<?php echo $g['img_core']?>/_public/btn_admin.gif" alt="" title="게시판관리" /></a>
			<a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=admin&amp;module=<?php echo $m?>&amp;front=skin&amp;theme=<?php echo $d['bbs']['skin']?>"><img src="<?php echo $g['img_core']?>/_public/btn_explorer.gif" alt="" title="테마관리" /></a>
			<?php endif?>

			<?php if($B['category']):$_catexp = explode(',',$B['category']);$_catnum=count($_catexp)?>
			<select onchange="document.bbssearchf.cat.value=this.value;document.bbssearchf.submit();">
			<option value="">&nbsp;+ <?php echo $_catexp[0]?></option>
			<option value="" class="sline">-------------------</option>
			<?php for($i = 1; $i < $_catnum; $i++):if(!$_catexp[$i])continue;?>
			<option value="<?php echo $_catexp[$i]?>"<?php if($_catexp[$i]==$cat):?> selected="selected"<?php endif?>>ㆍ<?php echo $_catexp[$i]?><?php if($d['theme']['show_catnum']):?>(<?php echo getDbRows($table[$m.'data'],'site='.$s.' and notice=0 and bbs='.$B['uid']." and category='".$_catexp[$i]."'")?>)<?php endif?></option>
			<?php endfor?>
			</select>
			<?php endif?>
		</div>
		<div class="clear"></div>
	</div>


	<table summary="<?php echo $B['name']?$B['name']:'전체'?> 게시물리스트 입니다.">
	<caption><?php echo $B['name']?$B['name']:'전체게시물'?></caption> 
	<colgroup> 
	<col width="50"> 
	<col> 
	<col width="80"> 
	</colgroup> 
	<tbody>

	<?php foreach($NCD as $R):?> 
	<?php $R['mobile']=isMobileConnect($R['agent'])?>
	<tr class="noticetr">
	<td>
		<?php if($R['uid'] != $uid):?>
		<img src="<?php echo $g['img_module_skin']?>/ico_notice.gif" alt="공지" class="notice" />
		<?php else:?>
		<span class="now">&gt;&gt;</span>
		<?php endif?>
	</td>
	<td class="sbj">
		<?php if($R['mobile']):?><img src="<?php echo $g['img_core']?>/_public/ico_mobile.gif" class="imgpos" alt="모바일" title="모바일(<?php echo $R['mobile']?>)로 등록된 글입니다" /><?php endif?>
		<a href="<?php echo $g['bbs_view'].$R['uid']?>" class="b"><?php echo getStrCut($R['subject'],$d['bbs']['sbjcut'],'')?></a>
		<?php if(strstr($R['content'],'.jpg')):?><img src="<?php echo $g['img_core']?>/_public/ico_pic.gif" class="imgpos" alt="사진" title="사진" /><?php endif?>
		<?php if($R['upload']):?><img src="<?php echo $g['img_core']?>/_public/ico_file.gif" class="imgpos" alt="첨부파일" title="첨부파일" /><?php endif?>
		<?php if($R['hidden']):?><img src="<?php echo $g['img_core']?>/_public/ico_hidden.gif" class="imgpos" alt="비밀글" title="비밀글" /><?php endif?>
		<?php if($R['comment']):?><span class="comment">[<?php echo $R['comment']?><?php if($R['oneline']):?>+<?php echo $R['oneline']?><?php endif?>]</span><?php endif?>
		<?php if($R['trackback']):?><span class="trackback">[<?php echo $R['trackback']?>]</span><?php endif?>
		<?php if(getNew($R['d_regis'],24)):?><span class="new">new</span><?php endif?>
	</td>
	<td class="name"><span class="hand" onclick="getMemberLayer('<?php echo $R['mbruid']?>',event);"><?php echo $R[$_HS['nametype']]?></span></td>
	<td class="hit b"><?php echo $R['hit']?></td>
	<td><?php echo getDateFormat($R['d_regis'],'Y.m.d H:i')?></td>
	</tr> 
	<?php endforeach?> 

	<?php foreach($RCD as $R):?>
	<?php $R['mobile']=isMobileConnect($R['agent'])?>
	<?php $reply = substr($R['subject'],0,2); ?>
	<tr class="list">
	<td  align="center">
		<?php if($R['uid'] != $uid):?>
		<?php if($reply=='RE'){?><img src="/ara/modules/bbs/theme/_pc/qna/image/a-icon.gif"><?php }else{ ?>
		<img src="/ara/modules/bbs/theme/_pc/qna/image/q-icon.gif"> <? } ?>
		<?php else:$_rec++?>
		<span class="now">&gt;&gt;</span>
		<?php endif?>
	</td>
	<td class="sbj" height="65">
		<a href="<?php echo $g['bbs_view'].$R['uid']?>"><strong><?php if($reply=='RE'){?><font color="red"><?php echo getStrCut($R['subject'],$d['bbs']['sbjcut'],'..')?></font></strong><? }else{ ?><?php echo getStrCut($R['subject'],$d['bbs']['sbjcut'],'..')?><? } ?>
		<br/><?php echo getStrCut(strip_tags($R['content']),80,'..')?></a>
		<?php if(getNew($R['d_regis'],24)):?><span class="new">new</span><?php endif?>
	</td>
	<td class="name"><?php echo getDateFormat($R['d_regis'],'Y.m.d')?><br/><br/>
	<?php if($R['hidden']) { echo "비공개"; } else { echo $R[$_HS['nametype']]; } ?></td>
	</tr> 
	<?php endforeach?> 

	<?php if(!$NUM):?>
	<tr>
	<td>1</td>
	<td class="sbj1">게시물이 없습니다.</td>
	<td class="name">-<br/><?php echo getDateFormat($date['totime'],'Y.m.d')?></td>
	</tr> 
	<?php endif?>

	</tbody>
	</table>

	<div class="bottom">
		<div class="btnbox2">
		<?php if($B['uid']):?><a href="<?php echo $g['bbs_write']?>"><img src="<?php echo $g['img_module_skin']?>/qa_btn.jpg"></a><?php endif?>
		</div>
		<div class="clear"></div>
		<div class="pagebox01">
		<?php echo getPageLink($d['theme']['pagenum'],$p,$TPG,$g['img_core'].'/page/default')?>

		</div>
	</div>

</div>
<style>
  .bgcolor { background:#f0f0f0 }
</style>
<script>
$(function(){
     $(".list:odd").addClass("bgcolor");
});
</script>