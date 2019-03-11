
<section class="slice bg-3 animate-hover-slide">
        <div class="w-section inverse blog-grid">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="w-box blog-post">
                                    <div class="figure" style="">
										<h2><?php echo $R['subject']?></h2>
										<iframe style="width:100%;display:block;" id="iframe_800-600" src="http://www.youtube.com/embed/<?php echo $R['movie']; ?>" frameborder="0" allowfullscreen></iframe>
										<br/>
										<?php echo getContents($R['content'],$R['html'])?>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>                       
                    </div>
                </div>
				<div class="row">
                    <div class="col-md-12">
                        <div>						
							<button class="btn btn-three" type="button" onClick="javascript:location.href='<?php echo $g['bbs_modify'].$R['uid']?>';">수정</button>&nbsp;&nbsp;&nbsp;
							<?php if($d['theme']['use_reply']):?>
								<button class="btn btn-three" type="button" onClick="javascript:location.href='<?php echo $g['bbs_reply'].$R['uid']?>';">답변</button>
							<?php endif?>&nbsp;&nbsp;&nbsp;
							<a href="<?php echo $g['bbs_delete'].$R['uid']?>" target="_action_frame_<?php echo $m?>" onclick="return confirm('정말로 삭제하시겠습니까?');"><button class="btn btn-three" type="button">삭제</button></a>&nbsp;&nbsp;&nbsp;
							<?php if($my['admin']):?>
							<button class="btn btn-three" type="button" onClick="javascript:OpenWindow('<?php echo $g['s']?>/?r=<?php echo $r?>&iframe=Y&m=admin&module=<?php echo $m?>&front=movecopy&type=multi_move&postuid=<?php echo $R['uid']?>');">이동</button>&nbsp;&nbsp;&nbsp;
							<button class="btn btn-three" type="button" onClick="javascript:OpenWindow('<?php echo $g['s']?>/?r=<?php echo $r?>&iframe=Y&m=admin&module=<?php echo $m?>&front=movecopy&type=multi_copy&postuid=<?php echo $R['uid']?>');">복사</button>&nbsp;&nbsp;&nbsp;
							<button class="btn btn-three" type="button" onClick="javascript:location.href='<?php echo $g['bbs_list']?>';">목록으로</button>
							<?php endif?>
						</div>
                    </div>
                </div>
            </div>
        </div>
    </section>




<?php if($d['theme']['show_list']&&$print!='Y'):?>
<?php include_once $g['dir_module'].'lang.'.$_HS['lang'].'/mod/_list.php'?>
<?php include_once $g['dir_module_skin'].'list.php'?>
<?php endif?>

