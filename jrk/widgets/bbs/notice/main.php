				<p class="title clearfix">
					<strong>공지사항</strong>
					<a href="<?php echo $wdgvar['link'.$j]?>">More</a>
				</p>
				<ul>
					<?php $_RCD=getDbArray($table['bbsdata'],($wdgvar['bid']?'bbs='.$wdgvar['bid'].' and ':'').'display=1 and site='.$_HS['uid'],'*','gid','asc',$wdgvar['limit'],1)?>
					<?php while($_R=db_fetch_array($_RCD)):?>

					<li><a href="<?php echo getPostLink($_R)?>" title="<?php echo $_R[$_HS['nametype']]?>님"><?php echo getStrCut($_R['subject'],$wdgvar['sbjcut'],'')?></a></li>	

					<?php endwhile?>					
				</ul>
