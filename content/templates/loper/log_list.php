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
<div id="main">
	<?php 
	if (!empty($logs)):
	foreach($logs as $value):
	 preg_match_all("|<img[^>]+src=\"([^>\"]+)\"?[^>]*>|is", $value['content'], $img);
	$imgsrcb = !empty($img[1]) ? $img[1][0] : '';
	$logdes = blog_tool_purecontent($value['content'], 178);
	if(pic_thumb($value['content'])){
	$imgsrc = pic_thumb($value['content']);
	}else
	$imgsrc = TEMPLATE_URL.'images/random/tb'.rand(1,20).'.jpg';
	?>
	<div class="title"><h2><?php topflg($value['top']); ?><a title="<?php echo $value['log_title']; ?>" href="<?php echo $value['log_url']; ?>"><?php echo $value['log_title']; ?></a>
	</h2>
	<div class="clear"></div>
	<span class="cate left">
	<?php echo date('Y.m.d',$value['date']); ?>,<?php blog_sort($value['logid']); ?>,<?php if($value['comnum']=="0"){ echo '<a title="抢沙发" href="'.$value['log_url'].'#respond">抢沙发</a>'; }else{ echo  '<a title="《'.$value['log_title'].'》上的评论" href="'.$value['log_url'].'#comments">'.$value['comnum'].'条评论</a>'; } ?>,<?php echo $value['views']; ?>人打酱油
	</span>	
	</div>
	<div class="postcontents cf">
	<div class="thumbnailbg">
	<a href="<?php echo $value['log_url']; ?>">
	<img class="thumb" src="<?php echo $imgsrc; ?>" />
	</a>
	</div>
	<div class="post-content cf"><?php echo $logdes; ?><div class="clear"></div>
	<div class="post-meta">
		<a class="post-more" rel="nofollow" title="continue" href="<?php echo $value['log_url']; ?>"></a>
		<span class="post-tags">
			Tags: <?php blog_tag($value['logid']); ?>
		</span>
		<div class="clear"></div>
	</div>
	</div>
	</div>	
    <?php endforeach; else: ?>
    <p><center>关键词“<?php echo urldecode($params[2]);?>”的搜索结果肿么能木有呢？</center></p>
    <?php endif; ?>
    <div id="pagenavi"></div>
<div class="clear"></div>	
	<nav id="oldernewer">
		<table>
			<tbody>
				<tr>
					<td><?php if($page>1): ?><span class="pageprevious"><a title="下一页" href="<?php echo BLOG_URL; ?>?page=<?php echo $page-1; ?>">下一页</a></span><?php else: ?><span class="pageprevious"></span><?php endif; ?></td>
					<td class="pagenumber"><?php echo $page_url; ?></td>
					<td><?php if($page<ceil($lognum/$index_lognum)): ?><span class="pagenext"><a title="下一页" href="<?php echo BLOG_URL; ?>?page=<?php echo $page+1; ?>">下一页</a></span><?php else: ?><span class="pagenext"></span><?php endif; ?></td>
				</tr>
			</tbody>
		</table>
	</nav>
</div>
<?php
include View::getView('side');
include View::getView('footer');
?>