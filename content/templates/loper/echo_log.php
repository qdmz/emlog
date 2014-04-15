<?php 
/*
Template Name:Loper
Description:因为简约，所以简单。
Version:1.0
Author:麦特佐罗
Author Url:http://www.zorrorun.com
Sidebar Amount:1
ForEmlog:5.21
*/
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
<div id="main">
	<div class="breadcrumbs">
	<a href="<?php echo BLOG_URL;?>" title="返回首页">Home</a> &gt; <?php getBlogSort($logid);?> &gt; <?php echo $log_title; ?>&nbsp;&nbsp;&nbsp;<?php editflg($logid,$author); ?>
	</div>
    <div class="singletitle"><h2><?php topflg($top); ?><?php echo $log_title; ?></h2></div>
	<div class="singleinfo">
    <span class="singletime">
	<?php echo gmdate('Y年n月j日', $date); ?>
    </span>
    <span class="singlecom">
	<?php if($comnum=="0"){ echo '<a href="#respond">抢沙发</a>'; }else{ echo '<a href="#comments">'.$comnum.'条评论</a>'; } ?>
    </span>
	</div>
    <div class="post-content"><?php echo $log_content; ?>
	<p class="announce">
	版权声明：若无特殊注明，本文皆为( <?php blog_author($author); ?> )原创，转载请保留文章出处。
	</p>
	</div>
	<div class="postinfo">
    <div class="postinfocontent">
        <span class="singletag"><?php blog_tag($logid);?></span>
        <div class="clear"></div>
        <nav class="postnav"><?php neighbor_log($neighborLog); ?></nav>
		<div class="clear"></div>
		<div class="postinfoend"></div>
    </div>
	</div>
	<?php doAction('log_related', $logData); ?>
	<div id="comments">
    <div class='commentsorping'><div class='commentsays'>已有<?php echo $comnum;?>个回复</div></div>
    <?php blog_comments($comments,$params); ?>
	<?php blog_comments_post($logid,$ckname,$ckmail,$ckurl,$verifyCode,$allow_remark); ?>
	</div>
</div>
<?php
 include View::getView('side');
 include View::getView('footer');
?>