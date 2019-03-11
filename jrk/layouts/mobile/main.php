<div id="header" class="headerfix<?php echo $d['layout']['headerfix']?>">
	<div class="logo">
		<?php echo getLayoutLogo($d['layout'])?>
	</div>
	<div class="tool">
		<img src="<?php echo $g['img_layout']?>/btn_admin_off.png" alt="" onclick="mLayerShow('_admin_layer_','_system_layer_',this);" />
		<img src="<?php echo $g['img_layout']?>/btn_tool_off.png" alt="" onclick="mLayerShow('_system_layer_','_admin_layer_',this);" />
		
		<?php if($my['uid']):?>
		<div id="_admin_layer_">
			<div class="_layerbox _admin_">
			<div class="arr">▲</div>
			<div class="tt _admin_" onclick="mLayerHide();"><i><?php echo $my[$_HS['nametype']]?>님의 정보</i><span>×</span></div>
			<div class="mbrinfo">
				<div class="symbol"><a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;mod=mypage&amp;page=simbol"><img src="<?php echo $g['s']?>/_var/simbol/<?php echo $my['photo']?$my['photo']:'0.gif'?>" alt="" /></a></div>
				<div class="name">
					<div class="namel"><?php echo $my[$_HS['nametype']]?>님</div>
					<div class="namer">
						(<?php echo $my['email']?>) <br /><br />
						마지막 접속시간 : <br />
						<?php echo getDateFormat($my['last_log'],'Y/m/d H:i')?> <br /><br />
						포인트 : <?php echo number_format($my['point'])?>P
					</div>
				</div>
				<div class="clear"></div>
			</div>
			<div class="btnbox">
			<a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;a=logout">로그아웃</a>
			<a href="<?php echo RW('mod=mypage')?>">계정관리</a>
			</div>
			</div>
		</div>
		<div id="_system_layer_">
			<div class="_layerbox">
			<div class="arr">▲</div>
			<div class="tt" onclick="mLayerHide();"><i>내 계정 관리</i><span>×</span></div>
			<ul>
			<?php if($my['admin']):?>
			<li class="admin"><a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;_themeConfig=detail"><i>타이틀/메뉴 설정</i></a></li>
			<li class="admin"><a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;_themeConfig=front"><i>메인화면 설정</i></a></li>
			<?php endif?>
			<li><a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;mod=mypage&amp;page=post"><i>내가 등록한 게시물</i></a></li>
			<li><a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;mod=mypage&amp;page=comment"><i>내가 등록한 댓글</i></a></li>
			<li><a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;mod=mypage&amp;page=paper"><i>내 쪽지함</i></a></li>
			<li><a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;mod=mypage&amp;page=friend"><i>친구관리</i></a></li>
			<li><a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;mod=mypage&amp;page=point"><i>포인트 적립/사용정보</i></a></li>
			<li><a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;mod=mypage&amp;page=scrap"><i>스크랩 자료</i></a></li>
			<li><a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;mod=mypage&amp;page=simbol"><i>캐릭터(사진) 변경</i></a></li>
			<li><a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;mod=mypage&amp;page=log"><i>나의 접속기록</i></a></li>
			<li><a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;mod=mypage&amp;page=info"><i>회원가입 정보 수정</i></a></li>
			<li><a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;mod=mypage&amp;page=pw"><i>패스워드 변경</i></a></li>
			<li><a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;mod=mypage&amp;page=out"><i>회원탈퇴</i></a></li>
			</ul>
			<div class="updown"><img src="<?php echo $g['img_core']?>/_public/arr_top.gif" alt="" class="filter" /><br /><img src="<?php echo $g['img_core']?>/_public/arr_bottom.gif" alt="" class="filter" /></div>
			<div class="btnbox">
			<?php if($my['admin']):?>
			<a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=admin">관리자</a>
			<?php else:?>
			<a href="<?php echo RW('mod=mypage')?>">데스크</a>
			<?php endif?>
			<a href="#." onclick="mLayerHide();">닫기</a>
			</div>
			</div>
		</div>
		<?php else:?>
		<div id="_login_layer_">
			<div class="_layerbox _login_">
			<div class="arr">▲</div>
			<div class="tt _admin_" onclick="mLayerHide();"><i id="_login_layer_tt_"></i><span>×</span></div>
			<div class="loginmsg">
				<div class="mtt">로그인 안내</div>
				<div class="mnt">
					이 서비스를 이용하기 위해서는 로그인이 필요합니다.<br />
					지금 로그인하시겠습니까?<br />
					<a href="<?php echo RW('mod=join')?>">회원가입</a>
					<a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;mod=login&amp;page=idpwsearch">아이디/비밀번호 찾기</a>
				</div>
			</div>
			<div class="btnbox">
			<a href="<?php echo RW('mod=login')?>">로그인</a>
			<a href="#." onclick="mLayerHide();">취소</a>
			</div>			
			</div>
		</div>
		<?php endif?>

	</div>
	<div class="clear"></div>
</div>
<div id="topmenu">
	<?php if($d['layout']['headerfix']):?><div class="headergap"></div><?php endif?>
	<div class="nav">
		<ul>
		<li class="allmenu<?php if($_themePage=='menu'):?> on<?php endif?>"><a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;_themePage=menu"><i>전체메뉴</i></a></li>
		<li<?php if($d['layout']['tmenu_1']=='m'.$_HM['uid']||$d['layout']['tmenu_1']=='b'.$B['uid']):?> class="on"<?php endif?>><a href="<?php echo $d['layout']['tmenu_1_link']?>"><i><?php echo $d['layout']['tmenu_1_text']?></i></a></li>
		<li<?php if($d['layout']['tmenu_2']=='m'.$_HM['uid']||$d['layout']['tmenu_2']=='b'.$B['uid']):?> class="on"<?php endif?>><a href="<?php echo $d['layout']['tmenu_2_link']?>"><i><?php echo $d['layout']['tmenu_2_text']?></i></a></li>
		<li<?php if($d['layout']['tmenu_3']=='m'.$_HM['uid']||$d['layout']['tmenu_3']=='b'.$B['uid']):?> class="on"<?php endif?>><a href="<?php echo $d['layout']['tmenu_3_link']?>"><i><?php echo $d['layout']['tmenu_3_text']?></i></a></li>
		</ul>
		<div class="clear"></div>
	</div>
</div>

<div id="content">

	<?php if($d['layout']['_is_ownmain']) include $g['path_layout'].$d['layout']['dir'].'/_cross/_main.php'?>
	<?php if($d['layout']['_is_content']) include __KIMS_CONTENT__?>
	<?php if(!$d['layout']['begin']&&!$_themeConfig) include $g['path_layout'].$d['layout']['dir'].'/_cross/_begin.php'?>

</div>

<div id="footer">
	<div id="searchbox" class="search">
		<form action="<?php echo $g['s']?>/">
		<input type="hidden" name="r" value="<?php echo $r?>" />
		<input type="hidden" name="mod" value="search" />
		<input type="text" id="m_keyword" name="keyword" value="<?php echo $_keyword?>" class="inputx" onblur="searchBlur();" />
		<input type="image" value="검색" src="<?php echo $g['img_layout']?>/btn_search.gif" class="submit" />
		</form>
	</div>
	<div class="foot">
		<div class="btnbox">
			<a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;a=pcmode">PC모드</a>
			<?php if($my['uid']):?>
			<a href="<?php echo RW('mod=mypage')?>">나의계정</a>
			<a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;a=logout">로그아웃</a>
			<?php else:?>
			<a href="<?php echo RW('mod=login')?>">로그인</a>
			<a href="<?php echo RW('mod=join')?>">회원가입</a>
			<?php endif?>
			<a href="#." onclick="searchBox();">검색</a>
			<a href="#">맨위로</a>
		</div>
		<div class="link">
			<span><?php echo $_SERVER['HTTP_HOST']?> &copy; <?php echo $date['year']?></span> <i></i>
			<a href="<?php echo RW('mod=agreement')?>">이용약관</a> <i></i>
			<a href="<?php echo RW('mod=private')?>">개인정보 취급방침</a>
		</div>
	</div>
	<div class="adv">
		<iframe src="http://ad.kimsq.com/400_40/" width="100%" height="40" frameborder="0" scrolling="no"></iframe>
	</div>
</div>



<script type="text/javascript">
//<![CDATA[
window.onload = function() {window.scrollTo(0,1);}
//]]>
</script>
