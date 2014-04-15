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
require_once View::getView('module');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title><?php echo $site_title; ?></title>
<meta name="keywords" content="<?php echo $site_key; ?>" />
<meta name="description" content="<?php echo $site_description; ?>" />
<link rel="shortcut icon" href="<?php echo TEMPLATE_URL; ?>images/favicon.ico" type="image/x-icon" />
<link rel="wlwmanifest" type="application/wlwmanifest+xml" href="<?php echo BLOG_URL; ?>wlwmanifest.xml" />
<link rel="EditURI" type="application/rsd+xml" title="RSD" href="<?php echo BLOG_URL; ?>xmlrpc.php?rsd" />
<link rel="alternate" type="application/rss+xml" title="RSS"  href="<?php echo BLOG_URL; ?>rss.php" />
<link href="<?php echo TEMPLATE_URL; ?>style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo TEMPLATE_URL; ?>js/jquery.min.js"></script>
<script src="<?php echo BLOG_URL; ?>include/lib/js/common_tpl.js" type="text/javascript"></script>
<?php doAction('index_head'); ?>
</head>
<!--你看的不是代码，是哥的寂寞~-->
<body>
		<div id="if-logged-in">
		<div class="container">
			<p class="noticebar">
			<?php global $CACHE;$newtws = $CACHE->readCache('newtw');if(empty($newtws)){ echo "Stay Hungry,Stay Foolish(求知若饥，虚心若愚。)——Steve Jobs";}else{echo preg_replace("/\[F(([1-4]?[0-9])|50)\]/",'<img alt="face" src="'.TEMPLATE_URL.'images/face/$1.gif"  />',$newtws[0]['content']);echo "<script type='text/javascript'>if ( (/MSIE 6.0/ig.test(navigator.appVersion))||(/MSIE 7.0/ig.test(navigator.appVersion))||(/MSIE 8.0/ig.test(navigator.appVersion)) ) {document.write('<font color=red>垃圾浏览器滚粗</font>');}</script>" ;}?>
			</p>
			<p class="snsright">
			<a href="#" title="RSS Feed" class="feedsns" rel="nofollow">feed订阅</a>
			<a href="#" title="腾讯微博" class="qqsns" rel="nofollow">腾讯微博</a>
			<a href="#" title="新浪微博" class="sinasns" rel="nofollow">新浪微博</a>
			<a href="#" title="twitter" class="twittersns" rel="nofollow">twitter</a> 
			<span class="right">你好，欢迎光临！</span>					
			</p>
		</div>
	</div>
	<div id="header">
	<div class="hgroup">
    <h1>
        <a title="<?php echo $blogname; ?>" href="<?php echo BLOG_URL; ?>"><?php echo $blogname; ?></a>
    </h1>
	</div>
	<div class="searchbarswitch"></div>
	<div class="searchbar" style="margin-top: 0px;">
	<div class="searchfade" style="display: none;">
	<form id="searchform" class="search" name="keyform" method="get" action="<?php echo BLOG_URL; ?>index.php">
        <input class="search_text" type="text" value="Search...and Enter" onclick="if(this.value=='Search...and Enter')this.value=''" onfocus="this.value='';" onblur="if(this.value =='')this.value='Search...and Enter';" name="keyword"></input>
        <input class="search_submit" type="submit" value="" name="submit"></input>
    </form>
	</div>
	</div>
	<div class="clear"></div>
	<nav class="primary">
	<a class="feedrss" title="点滴记忆 RSS Feed" href="http://localhost/wp/?feed=rss2" style="opacity: 0;">rss</a>
	<?php blog_navi();?>
	</nav>
	<div class="clear"></div>
	<div class="feedtips"></div>
	</div>
	<div id="content">