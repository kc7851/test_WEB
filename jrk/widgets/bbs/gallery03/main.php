			<div class="product">
				<div>
					<h3 class="main_h3">제품안내</h3><span class="explain">클릭하시면 자세히 볼 수 있습니다.</span>
					<a href="<?php echo $wdgvar['link']?>" class="plus">더보기</a>
				</div>
				<ul class="product_list">
				<?php $_RCD1=getDbArray($table['bbsdata'],($wdgvar['bid']?'bbs=2 and ':'').'display=1 and site='.$_HS['uid'],'*','gid','asc',1,1)?>
				<?php while($_R1=db_fetch_array($_RCD1)):?>
				<?php $_thumbimg=getUploadImage($_R1['upload'],$_R1['d_regis'],$_R1['content'],'jpg|jpeg')?>
				<?php $_thumbimg=$_thumbimg?$_thumbimg:$g['img_core'].'/blank.gif'?>
				<?php $_link=getPostLink($_R1)?>
					<li><a href="<?php echo $_link?>"><img src="<?php echo $_thumbimg?>" style="width:<?php echo $wdgvar['width']?>px;height:<?php echo $wdgvar['height']?>px" alt="제품1" /></a></li>
				<?php endwhile?>
				
				<?php $_RCD2=getDbArray($table['bbsdata'],($wdgvar['bid']?'bbs=3 and ':'').'display=1 and site='.$_HS['uid'],'*','gid','asc',1,1)?>
				<?php while($_R2=db_fetch_array($_RCD2)):?>
				<?php $_thumbimg=getUploadImage($_R2['upload'],$_R2['d_regis'],$_R2['content'],'jpg|jpeg')?>
				<?php $_thumbimg=$_thumbimg?$_thumbimg:$g['img_core'].'/blank.gif'?>
				<?php $_link=getPostLink($_R2)?>				
					<li><a href="<?php echo $_link?>"><img src="<?php echo $_thumbimg?>" style="width:<?php echo $wdgvar['width']?>px;height:<?php echo $wdgvar['height']?>px" alt="제품2" /></a></li>
				<?php endwhile?>

				<?php $_RCD3=getDbArray($table['bbsdata'],($wdgvar['bid']?'bbs=4 and ':'').'display=1 and site='.$_HS['uid'],'*','gid','asc',1,1)?>
				<?php while($_R3=db_fetch_array($_RCD3)):?>
				<?php $_thumbimg=getUploadImage($_R3['upload'],$_R3['d_regis'],$_R3['content'],'jpg|jpeg')?>
				<?php $_thumbimg=$_thumbimg?$_thumbimg:$g['img_core'].'/blank.gif'?>
				<?php $_link=getPostLink($_R3)?>
					<li><a href="<?php echo $_link?>"><img src="<?php echo $_thumbimg?>" style="width:<?php echo $wdgvar['width']?>px;height:<?php echo $wdgvar['height']?>px" alt="제품3" /></a></li>
				<?php endwhile?>
				
				<?php $_RCD4=getDbArray($table['bbsdata'],($wdgvar['bid']?'bbs=5 and ':'').'display=1 and site='.$_HS['uid'],'*','gid','asc',1,1)?>
				<?php while($_R4=db_fetch_array($_RCD4)):?>
				<?php $_thumbimg=getUploadImage($_R4['upload'],$_R4['d_regis'],$_R4['content'],'jpg|jpeg')?>
				<?php $_thumbimg=$_thumbimg?$_thumbimg:$g['img_core'].'/blank.gif'?>
				<?php $_link=getPostLink($_R4)?>
					<li><a href="<?php echo $_link?>"><img src="<?php echo $_thumbimg?>" style="width:<?php echo $wdgvar['width']?>px;height:<?php echo $wdgvar['height']?>px" alt="제품4" /></a></li>
				<?php endwhile?>
				
				</ul>
			</div>