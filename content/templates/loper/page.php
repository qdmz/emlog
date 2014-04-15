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
	<div class="title"><h2><?php echo $log_title; ?></h2></div>
	<div class="clear"></div>
	<div class="post-content"><?php echo $log_content; ?></div>
	<div id="comments">
   <div class='commentsorping'><div class='commentsays'>已有<?php echo $comnum;?>个回复</div></div>
    <?php blog_comments($comments,$params); ?>
	<?php blog_comments_post($logid,$ckname,$ckmail,$ckurl,$verifyCode,$allow_remark); ?>
	</div>
	<div style="clear:both;"></div>
</div>
<?php
 include View::getView('side');
 include View::getView('footer');
?>