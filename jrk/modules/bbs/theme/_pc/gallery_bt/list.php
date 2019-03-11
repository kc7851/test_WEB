<section class="slice bg-3 animate-hover-slide">
	<div class="w-section inverse work">
		<div class="container">
		<?php if($my['admin']):?>
		<div class="row">
			<a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=admin&amp;module=<?php echo $m?>&amp;&amp;uid=<?php echo $B['uid']?>"><img src="<?php echo $g['img_core']?>/_public/btn_admin.gif" alt="" title="게시판관리" /></a>
			<a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=admin&amp;module=<?php echo $m?>&amp;front=skin&amp;theme=<?php echo $d['bbs']['skin']?>"><img src="<?php echo $g['img_core']?>/_public/btn_explorer.gif" alt="" title="테마관리" /></a>
		</div>
		
		<div class="row">
			<div class="col-md-12">
				<div class="btn-group pull-right">
					<button type="button" class="btn btn-three"  onClick="javascript:location.href='<?php echo $g['bbs_write']?>';">글쓰기</button>					
				</div>
			</div>
		</div>
		<?php endif?>
		<?php if($NUM):?>
			<div class="row">          
				<div id="ulSorList">


				<?php $class_no=0;?>

				<?php foreach($RCD as $R):?>
				<?php $class_no=$class_no+1;;?>
				<?php $R['mobile']=isMobileConnect($R['agent'])?>
				<?php $_thumbimg=getUploadImage($R['upload'],$R['d_regis'],$R['content'],'jpg|jpeg')?>
					<div class="mix category_<?php echo $class_no;?> col-lg-3 col-md-3 col-sm-6" data-cat="<?php echo $class_no;?>">
						<div class="w-box inverse">
							<div class="figure">
								<img alt="" src="<?php echo $_thumbimg?>" class="img-responsive">
								<div class="figcaption bg-2"></div>
								<div class="figcaption-btn">
									<a href="<?php echo $_thumbimg?>" class="btn btn-xs btn-one theater"><i class="fa fa-plus-circle"></i> Zoom</a>
									<a href="<?php echo $g['bbs_view'].$R['uid']?>" class="btn btn-xs btn-one"><i class="fa fa-link"></i> View</a>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12">
									<h2><a href="<?php echo $g['bbs_view'].$R['uid']?>"><?php echo getStrCut($R['subject'],$d['bbs']['sbjcut'],'')?></a></h2>									
								</div>
							</div>
						</div>
					</div>
				<?php endforeach?> 
					
				</div>				
			</div>
			

		<?php endif?>
		<br/>
		<br/>

			<div  class="row">
				<div class="col-md-3">
					<ul class="pagination" style="margin:0px;">
						<?php echo getPageLink2($d['theme']['pagenum'],$p,$TPG,$g['img_core'].'/page/default')?>
					</ul>
				</div>
				<div class="col-md-3">
					<div class="dropdown-form">
						<form name="bbssearchf" class="form-default form-inline p-15" action="<?php echo $g['s']?>/">
							<input type="hidden" name="r" value="<?php echo $r?>" />
							<input type="hidden" name="c" value="<?php echo $c?>" />
							<input type="hidden" name="m" value="<?php echo $m?>" />
							<input type="hidden" name="bid" value="<?php echo $bid?>" />
							<input type="hidden" name="cat" value="<?php echo $cat?>" />
							<input type="hidden" name="sort" value="<?php echo $sort?>" />
							<input type="hidden" name="orderby" value="<?php echo $orderby?>" />
							<input type="hidden" name="recnum" value="<?php echo $recnum?>" />
							<input type="hidden" name="type" value="<?php echo $type?>" />
							<input type="hidden" name="iframe" value="<?php echo $iframe?>" />
							<input type="hidden" name="skin" value="<?php echo $skin?>" />
							<?php if($d['theme']['search']):?>
							<input type="hidden" name="where" value="subject|tag" />							
							<div class="input-group">
								<input type="text" name="keyword" class="form-control" placeholder="검색어를 입력해 주세요"  value="<?php echo $_keyword?>">
								<span class="input-group-btn">
									<button class="btn btn-two" type="button" onClick="javascript:document.bbssearchf.submit();">검색</button>
								</span>
							</div>
							<?php endif?>
						</form>

					</div>
				</div>
				<?php if($my['admin']):?>
				<div class="col-md-6">
					<div class="btn-group pull-right">						
							<?php if($B['uid']):?><button class="btn btn-three" type="button" onClick="javascript:location.href='<?php echo $g['bbs_write']?>';">글쓰기</button><?php endif?>						
					</div>
				</div>
				<?php endif?>
			</div>		

		</div>
	</div>
</section>

