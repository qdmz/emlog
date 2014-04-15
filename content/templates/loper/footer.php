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
if (!defined('EMLOG_ROOT')) {
    exit('error!');
}
?>
</div>
<div class="clear"></div>
<div id="footer">
<div class="footertop">
<div class="footerinfo">
<p>©2012-<?php echo date('Y',time())?> <?php echo $blogname; ?></p>
<p><?php echo $footer_info; ?><a href="http://www.miibeian.gov.cn" target="_blank"><?php echo $icp; ?></a> <?php doAction('index_footer'); ?>由<a href="http://www.emlog.net" target="_blank">EMLOG</a>强力驱动 主题由<a href="http://www.zorrorun.com" target="_blank">麦特佐罗</a>设计</p>
</div>
</div>
</div>
</body>
</html>
<script>
$(function() {          
$("img").not("#sidebar img").lazyload({
placeholder:"<?php echo TEMPLATE_URL; ?>images/image-pending.gif",
effect:"fadeIn"
});
});
</script>
<script type="text/javascript" src="<?php echo TEMPLATE_URL; ?>js/common.js"></script>