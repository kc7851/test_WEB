<div id="bbsview">

	<div class="viewbox">

		<div class="icon hand" onclick="getMemberLayer('<?php echo $R['mbruid']?>',event);"><?php if($g['member']['photo']):?><img src="<?php echo $g['url_root']?>/_var/simbol/<?php echo $g['member']['photo']?>" alt="" /><?php endif?></div>

		<div class="subject">
			<h1><?php echo $R['subject']?></h1>
		</div>
		<div class="info">
			<div class="xleft">
				<span class="han"><?php echo $R[$_HS['nametype']]?></span> <span class="split">|</span> 
				<?php echo getDateFormat($R['d_regis'],$d['theme']['date_viewf'])?> <span class="split">|</span> 
				<span class="han">조회</span> <span class="num"><?php echo $R['hit']?></span> 
				<?php if($d['theme']['show_score1']):?><span class="split">|</span> <span class="han">공감</span> <span class="num"><?php echo $R['score1']?></span> <?php endif?>
				<?php if($d['theme']['show_score2']):?><span class="split">|</span> <span class="han">비공감</span> <span class="num"><?php echo $R['score2']?></span> <?php endif?>
			</div>
			<div class="xright">
				<ul>
				<?php if($d['theme']['use_singo']):?>
				<li class="g"><a href="<?php echo $g['bbs_action']?>singo&amp;uid=<?php echo $R['uid']?>" target="_action_frame_<?php echo $m?>" onclick="return confirm('정말로 신고하시겠습니까?');"><img src="<?php echo $g['img_core']?>/_public/b_cop.gif" alt="신고" title="신고" />신고</a></li>
				<?php endif?>
				<?php if($d['theme']['use_print']):?>
				<li class="g"><a href="javascript:printWindow('<?php echo $g['bbs_print'].$R['uid']?>');"><img src="<?php echo $g['img_core']?>/_public/b_print.gif" alt="인쇄" title="인쇄" />인쇄</a></li>
				<?php endif?>
				<?php if($d['theme']['use_scrap']):?>
				<li class="g"><a href="<?php echo $g['bbs_action']?>scrap&amp;uid=<?php echo $R['uid']?>" target="_action_frame_<?php echo $m?>" onclick="return isLogin();"><img src="<?php echo $g['img_core']?>/_public/b_scrap.gif" alt="스크랩" title="스크랩" />스크랩</a></li>
				<?php endif?>
				<?php if($d['theme']['use_font']):?>
				<li><div id="fontface"></div><img src="<?php echo $g['img_core']?>/_public/b_font.gif" alt="글꼴" title="글꼴" class="hand" onclick="fontFace('vContent','fontface');" /></li>
				<li><img src="<?php echo $g['img_core']?>/_public/b_plus.gif" alt="확대" title="확대" class="hand" onclick="fontResize('vContent','+');"/></li>
				<li><img src="<?php echo $g['img_core']?>/_public/b_minus.gif" alt="축소" title="축소" class="hand" onclick="fontResize('vContent','-');" /></li>
				<?php endif?>
				</ul>
			</div>
			<div class="clear"></div>
		</div>


		<div id="vContent" class="content">

			<?php echo getContents($R['content'],$R['html'])?>

			<?php if($d['theme']['show_score1']||$d['theme']['show_score2']):?>
			<div class="scorebox">
			<?php if($d['theme']['show_score1']):?>
			<a href="<?php echo $g['bbs_action']?>score&amp;value=good&amp;uid=<?php echo $R['uid']?>" target="_action_frame_<?php echo $m?>" onclick="return confirm('정말로 평가하시겠습니까?');"><img src="<?php echo $g['img_module_skin']?>/btn_s_1.gif" alt="공감" /></a> 
			<?php endif?>
			<?php if($d['theme']['show_score2']):?>
			<a href="<?php echo $g['bbs_action']?>score&amp;value=bad&amp;uid=<?php echo $R['uid']?>" target="_action_frame_<?php echo $m?>" onclick="return confirm('정말로 평가하시겠습니까?');"><img src="<?php echo $g['img_module_skin']?>/btn_s_2.gif" alt="비공감" /></a> 
			<?php endif?>
			</div>
			<?php endif?>

			<?php if($R['tag']&&$d['theme']['show_tag']):?>
			<div class="tag">
			<img src="<?php echo $g['img_core']?>/_public/ico_tag.gif" alt="태그" />
			<?php $_tags=explode(',',$R['tag'])?>
			<?php $_tagn=count($_tags)?>
			<?php $i=0;for($i = 0; $i < $_tagn; $i++):?>
			<?php $_tagk=trim($_tags[$i])?>
			<a href="<?php echo $g['bbs_orign']?>&amp;where=subject|tag&amp;keyword=<?php echo urlencode($_tagk)?>"><?php echo $_tagk?></a><?php if($i < $_tagn-1):?>, <?php endif?>
			<?php endfor?>
			</div>
			<?php endif?>

			<?php if($d['upload']['data']&&$d['theme']['show_upfile']):?>
			<div class="attach">
			<ul>
			<?php foreach($d['upload']['data'] as $_u):?>
			<?php if($_u['hidden'])continue?>
			<li>
				<a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=upload&amp;a=download&amp;uid=<?php echo $_u['uid']?>" title="<?php echo $_u['caption']?>"><?php echo $_u['name']?></a>
				<span class="size">(<?php echo getSizeFormat($_u['size'],1)?>)</span>
				<span class="down">(<?php echo number_format($_u['down'])?>)</span>
			</li>
			<?php endforeach?>
			</ul>
			</div>
			<?php endif?>

			<?php if($d['theme']['snsping']):?>
			<div class="snsbox">
			<img src="<?php echo $g['img_core']?>/_public/sns_t1.gif" alt="twitter" title="게시글을 twitter로 보내기" onclick="snsWin('t');" />
			<img src="<?php echo $g['img_core']?>/_public/sns_f1.gif" alt="facebook" title="게시글을 facebook으로 보내기" onclick="snsWin('f');" />
			<img src="<?php echo $g['img_core']?>/_public/sns_m1.gif" alt="me2day" title="게시글을 me2day로 보내기" onclick="snsWin('m');" />
			<img src="<?php echo $g['img_core']?>/_public/sns_y1.gif" alt="요즘" title="게시글을 요즘으로 보내기" onclick="snsWin('y');" />
			</div>
			<?php endif?>
		</div>
	</div>

	<div class="bottom">
		<?php if($my['uid']==1){?>
		<span><a href="<?php echo $g['bbs_modify'].$R['uid']?>">
			<input type="button" value=" 수정 " class="btnnavy" />
		</a></span>
		<?php if($d['theme']['use_reply']):?><span><a href="<?php echo $g['bbs_reply'].$R['uid']?>">
			<input type="button" value=" 답변 " class="btnnavy" />
		</a></span><?php endif?>
		<span><a href="<?php echo $g['bbs_delete'].$R['uid']?>" target="_action_frame_<?php echo $m?>" onclick="return confirm('정말로 삭제하시겠습니까?');">
			<input type="button" value=" 삭제 " class="btnnavy" />
		</a></span>
		<?php if($my['admin']):?>
		<span><a href="javascript:OpenWindow('<?php echo $g['s']?>/?r=<?php echo $r?>&iframe=Y&m=admin&module=<?php echo $m?>&front=movecopy&type=multi_move&postuid=<?php echo $R['uid']?>');">
		<input type="button" value=" 이동 " class="btnnavy" />
		</a></span>
		<span><a href="javascript:OpenWindow('<?php echo $g['s']?>/?r=<?php echo $r?>&iframe=Y&m=admin&module=<?php echo $m?>&front=movecopy&type=multi_copy&postuid=<?php echo $R['uid']?>');">
			<input type="button" value=" 복사 " class="btnnavy" />
		</a></span>
		<?php endif?>
		<?php } ?>
		<span><a href="<?php echo $g['bbs_list']?>">
			<input type="button" value=" 목록으로 " class="btnnavy" />
		</a></span>
	</div>

	<?php if(!$d['bbs']['c_hidden']):?>
	<div class="comment">
		<img src="<?php echo $g['img_module_skin']?>/ico_comment.gif" alt="" class="icon1" />
		<a href="#." onclick="commentShow('comment');">댓글 <span id="comment_num<?php echo $R['uid']?>"><?php echo $R['comment']?></span>개</a>
		<?php if(getNew($R['d_comment'],24)):?><img src="<?php echo $g['img_core']?>/_public/ico_new_01.gif" alt="new" /><?php endif?>
		<?php if($d['theme']['use_trackback']):?>
		| <a href="#." onclick="commentShow('trackback');">엮인글 <span id="trackback_num<?php echo $R['uid']?>"><?php echo $R['trackback']?></span>개</a>
		<?php if(getNew($R['d_trackback'],24)):?><img src="<?php echo $g['img_core']?>/_public/ico_new_01.gif" alt="new" /><?php endif?>
		<?php endif?>
	</div>
	<a name="CMT"></a>
	<iframe name="commentFrame" id="commentFrame" src="<?php if(!$d['bbs']['c_hidden']&&($CMT || $d['bbs']['c_open'])):?><?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=comment&amp;skin=<?php echo $d['bbs']['c_skin']?>&amp;hidepost=<?php echo ($R['display']?0:1)?>&amp;iframe=Y&amp;cync=[<?php echo $m?>][<?php echo $R['uid']?>][uid,comment,oneline,d_comment][<?php echo $table[$m.'data']?>][<?php echo $R['mbruid']?>][m:<?php echo $m?>,bid:<?php echo $R['bbsid']?>,uid:<?php echo $R['uid']?>]&amp;CMT=<?php echo $CMT?><?php endif?>" width="100%" height="0" frameborder="0" scrolling="no" allowTransparency="true"></iframe>
	<?php endif?>

</div> 


<script type="text/javascript">
//<![CDATA[
<?php if($d['theme']['snsping']):?>
function snsWin(sns)
{
	var snsset = new Array();
	var enc_tit = "<?php echo urlencode($_HS['title'])?>";
	var enc_sbj = "<?php echo urlencode($R['subject'])?>";
	var enc_url = "<?php echo urlencode($g['url_root'].($_HS['rewrite']?($_HS['usescode']?'/'.$r:'').'/b/'.$R['bbsid'].'/'.$R['uid']:'/?'.($_HS['usescode']?'r='.$r.'&':'').'m='.$m.'&bid='.$R['bbsid'].'&uid='.$R['uid']))?>";
	var enc_tag = "<?php echo urlencode(str_replace(',',' ',$R['tag']))?>";

	snsset['t'] = 'http://twitter.com/home/?status=' + enc_sbj + '+++' + enc_url;
	snsset['f'] = 'http://www.facebook.com/sharer.php?u=' + enc_url + '&t=' + enc_sbj;
	snsset['m'] = 'http://me2day.net/posts/new?new_post[body]=' + enc_sbj + '+++["'+enc_tit+'":' + enc_url + '+]&new_post[tags]='+enc_tag;
	snsset['y'] = 'http://yozm.daum.net/api/popup/prePost?sourceid=' + enc_url + '&prefix=' + enc_sbj;
	window.open(snsset[sns]);
}
<?php endif?>
function printWindow(url) 
{
	window.open(url,'printw','left=0,top=0,width=700px,height=600px,statusbar=no,scrollbars=yes,toolbar=yes');
}
function commentShow(type)
{
	var url;
	if (type == 'comment')
	{
		url = '<?php echo $g['s']?>/?r=<?php echo $r?>&m=comment&skin=<?php echo $d['bbs']['c_skin']?>&hidepost=<?php echo ($R['display']?0:1)?>&iframe=Y&cync=';
		url+= '[<?php echo $m?>][<?php echo $R['uid']?>]';
		url+= '[uid,comment,oneline,d_comment]';
		url+= '[<?php echo $table[$m.'data']?>][<?php echo $R['mbruid']?>]';
		url+= '[m:<?php echo $m?>,bid:<?php echo $R['bbsid']?>,uid:<?php echo $R['uid']?>]';
		url+= '&CMT=<?php echo $CMT?>';
	}
	else {
		url = '<?php echo $g['s']?>/?r=<?php echo $r?>&m=trackback&iframe=Y&cync=';
		url+= '[<?php echo $m?>][<?php echo $R['uid']?>]';
		url+= '[m:<?php echo $m?>,bid:<?php echo $R['bbsid']?>,uid:<?php echo $R['uid']?>]';
		url+= '&TBK=<?php echo $TBK?>';
	}

	frames.commentFrame.location.href = url;
}
function setImgSizeSetting()
{
	<?php if($d['theme']['use_autoresize']):?>
	var ofs = getOfs(getId('vContent')); 
	getDivWidth(ofs.width,'vContent');
	<?php endif?>
	getId('vContent').style.fontFamily = getCookie('myFontFamily');
	getId('vContent').style.fontSize = getCookie('myFontSize');

	<?php if($TRACKBACK):?>
	commentShow('trackback');
	<?php endif?>

	<?php if($print=='Y'):?>
	document.body.style.padding = '15px';
	self.print();
	<?php endif?>
}
window.onload = setImgSizeSetting;
//]]>
</script>

<?php if($d['theme']['show_list']&&$print!='Y'):?>
<?php include_once $g['dir_module'].'lang.'.$_HS['lang'].'/mod/_list.php'?>
<?php include_once $g['dir_module_skin'].'list.php'?>
<?php endif?>

