<section id="slider-wrapper" class="layer-slider-wrapper">
    <div id="layerslider" style="width:100%;height:500px;"> 
		
		
		<div class="ls-slide" data-ls="transition2d:1;timeshift:-1000;">
        	<!-- slide background -->
            <img src="<?php echo $g['img_layout'];?>/jrk_main_vs01.jpg" class="ls-bg" alt="Slide background"/>            
            <!-- Right Image -->
            
            
        </div>
	
        <div class="ls-slide" data-ls="transition2d:1;timeshift:-1000;">
        	<!-- slide background -->
            <img src="<?php echo $g['img_layout'];?>/jrk_main_vs02.jpg" class="ls-bg" alt="Slide background"/>
            
                     

        </div>
        
        <div class="ls-slide" data-ls="transition2d:1;timeshift:-1000;">
        	<!-- slide background -->
            <img src="<?php echo $g['img_layout'];?>/jrk_main_vs03.jpg" class="ls-bg" alt="Slide background"/>            
            <!-- Right Image -->
                   
            
        </div>		
    </div>
</section>
<section class="slice relative animate-hover-slide bg-3">
	<div class="w-section inverse">
		<div class="container">
			
			<div class="carousel-inner">
				<div class="item active">
					<div class="row">

						<div class="col-md-4">
							<div class="clearfix">
								<div style="float:left;width:45px">
									<i class="glyphicon glyphicon-bullhorn round-icon"></i>
								</div>
								<div style="float:left;">
									<p class="title clearfix">
										<a href="./?m=bbs&bid=notic"><H4>공지사항</H4></a>
									
									</p>
									<ul >
										<?php $_RCD=getDbArray($table['bbsdata'],'bbs=7 and display=1 and site=1','*','gid','asc',0,3)?>
										<?php while($_R=db_fetch_array($_RCD)):?>
										<li><a href="<?php echo getPostLink($_R)?>" title="<?php echo $_R[$_HS['nametype']]?>님"><?php echo getStrCut($_R['subject'],22,'')?></a></li>	
										<?php endwhile?>					
									</ul>
								</div>
							</div>
						</div>
						
						<div class="col-md-4">
							<div class="clearfix">
								<div style="float:left;width:45px">
									<i class="glyphicon glyphicon-envelope round-icon"></i>
								</div>
								<div style="float:left;">
									<p class="title clearfix">
										<a href="./?m=bbs&bid=sub0401"><H4>온라인상담문의</H4></a>
										
									</p>
									<ul>
										<?php $_RCD2=getDbArray($table['bbsdata'],'bbs=15 and display=1 and site=1','*','gid','asc',0,3)?>
										<?php while($_R2=db_fetch_array($_RCD2)):?>
										<li><a href="<?php echo getPostLink($_R2)?>" title="<?php echo $_R2[$_HS['nametype']]?>님"><?php echo getStrCut($_R2['subject'],22,'')?></a></li>	
										<?php endwhile?>					
									</ul>
								</div>
							</div>
						</div>

						<div class="col-md-4">
							<H4>Contacts</H4>							
							<img src="<?php echo $g['img_layout'];?>/jrk_main_cs.jpg">
						</div>

						

						
						


						
						
					</div>
				</div>
			</div>
		</div>
	</div>
</section>



