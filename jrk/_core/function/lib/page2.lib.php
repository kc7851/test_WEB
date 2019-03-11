<?php
function LIB_getPageLink2($lnum,$p,$tpage,$img)
{
	$_N = $GLOBALS['g']['pagelink'].'&amp;';
	$g_p1 = '&lt;';
	$g_p2 = '&lt;';
	$g_n1 = '&gt;';
	$g_n2 = '&gt;';
	$g_cn = '';
	$g_q  = $p > 1 ? '<li><a href="'.$_N.'p=1">&lt;&lt;</a></li>' : '<li><a href="#">&lt;&lt;</a></li>';
	if($p < $lnum+1) { $g_q .= '<li><a href="">'.$g_p1.'</a></li>'; }
	else{ $pp = (int)(($p-1)/$lnum)*$lnum; $g_q .= '<li><a href="'.$_N.'p='.$pp.'">'.$g_p2.'</a></li>';} $g_q .= $g_cn;
	$st1 = (int)(($p-1)/$lnum)*$lnum + 1;
	$st2 = $st1 + $lnum;
	for($jn = $st1; $jn < $st2; $jn++)
	if ( $jn <= $tpage)
	($jn == $p)? $g_q .= '<li><a href=""><span class="selected" title="'.$jn.' 페이지">'.$jn.'</span></a></li>'.$g_cn : $g_q .= '<li><a href="'.$_N.'p='.$jn.'" class="notselected" title="'.$jn.' 페이지">'.$jn.'</a></li>'.$g_cn;
	if($tpage < $lnum || $tpage < $jn) { $g_q .= '<li><a href="">'.$g_n1.'</a></li>'; }
	else{$np = $jn; $g_q .= '<li><a href="'.$_N.'p='.$np.'">'.$g_n2.'</a></li>'; }
	$g_q  .= $tpage > $p ? '<li><a href="'.$_N.'p='.$tpage.'">&gt;&gt;</a></li>' : '<li><a href="">&gt;&gt;</a></li>';
	return $g_q;
}
?>