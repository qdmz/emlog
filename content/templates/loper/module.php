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
<?php
//图片链接
function pic_thumb($content){
    preg_match_all("|<img[^>]+src=\"([^>\"]+)\"?[^>]*>|is", $content, $img);
    $imgsrc = !empty($img[1]) ? $img[1][0] : '';
	if($imgsrc):
		return $imgsrc;
	endif;
}
?>
<?php
//格式化内容工具
function blog_tool_purecontent($content, $strlen = null){
        $content = str_replace('继续阅读&gt;&gt;', '', strip_tags($content));
        if ($strlen) {
            $content = subString($content, 0, $strlen);
        }
        return $content;
}
?>
<?php
//获取分类名
function getBlogSort($blogid){
	global $CACHE; 
	$log_cache_sort = $CACHE->readCache('logsort');
	?>
	<?php if(!empty($log_cache_sort[$blogid])): ?>
	<a href="<?php echo Url::sort($log_cache_sort[$blogid]['id']); ?>" title="查看分类“<?php echo $log_cache_sort[$blogid]['name']; ?>”下的内容"><?php echo $log_cache_sort[$blogid]['name']; ?></a>
	<?php else: ?>
	<?php echo "未分类"; ?>
	<?php endif;?>
<?php }?>
<?php
//widget：我是傻逼
function widget_blogger($title){
	global $CACHE;
	$user_cache = $CACHE->readCache('user');
	$name = $user_cache[1]['mail'] != '' ? "".$user_cache[1]['name']."" : $user_cache[1]['name'];?>
	<div class="widgit-area">
	<h3><?php echo $title; ?></h3>
	<ul id="bloggerinfo">
	<div class="id-bar">
    <h4>ID : <?php echo $name; ?></h4>
    <span class="id_description">求知若饥，虚心若愚。</span>
    <div class="clear"></div>
</div>
	</ul>
	</div>
<?php }?>
<?php
//widget：日历
function widget_calendar($title){ ?>
	<div class="widgit-area">
	<h3><?php echo $title; ?></h3>
	<ul>
	<div class="calendartitle"><?php echo date('Y年m月',time())?></div>
	<div id="calendar">
	</div>
	<script>sendinfo('<?php echo Calendar::url(); ?>','calendar');</script>
	</ul>
	</div>
<?php }?>
<?php
//widget：标签
function widget_tag($title){
	global $CACHE;
	$tag_cache = $CACHE->readCache('tags');?>
	<div class="widgit-area">
	<h3><?php echo $title; ?></h3>
	<ul id="blogtags">
	<?php foreach($tag_cache as $value): ?>
		<span style="font-size:<?php echo $value['fontsize']; ?>pt; line-height:30px;">
		<a href="<?php echo Url::tag($value['tagurl']); ?>" title="<?php echo $value['usenum']; ?> 篇文章"><?php echo $value['tagname']; ?></a></span>
	<?php endforeach; ?>
	</ul>
	</div>
<?php }?>
<?php
//widget：分类
function widget_sort($title){
	global $CACHE;
	$sort_cache = $CACHE->readCache('sort'); ?>
	<div class="widgit-area">
	<h3><?php echo $title; ?></h3>
	<ul id="blogsort">
	<?php foreach($sort_cache as $value): ?>
	<li class="cat-item">
	<a title="<?php echo $value['lognum'] ?>篇文章" href="<?php echo Url::sort($value['sid']); ?>"><?php echo $value['sortname']; ?></a>
	</li>
	<?php endforeach; ?>
	</ul>
	</div>
<?php }?>
<?php
//widget：最新碎语
function widget_twitter($title){
	global $CACHE; 
	$newtws_cache = $CACHE->readCache('newtw');
	$istwitter = Option::get('istwitter');
	?>
	<div class="widgit-area">
	<h3><?php echo $title; ?></h3>
	<ul id="twitter">
	<?php foreach($newtws_cache as $value): ?>
	<?php $img = empty($value['img']) ? "" : '<a title="查看图片" class="t_img" href="'.BLOG_URL.str_replace('thum-', '', $value['img']).'" target="_blank">&nbsp;</a>';?>
	<li><?php echo $value['t']; ?><?php echo $img;?><?php echo date('  Y年m月d日',$value['date']); ?></li>
	<?php endforeach; ?>
    <?php if ($istwitter == 'y') :?>
	<?php endif;?>
	</ul>
	</div>
<?php }?>
<?php
//widget：最新评论
function widget_newcomm($title){
	global $CACHE; 
	$com_cache = $CACHE->readCache('comment');
	?>
	<div class="widgit-area">
	<h3><?php echo $title; ?></h3>
	<ul id="newcomment">
	<?php
	foreach($com_cache as $value):
	$url = Url::comment($value['gid'], $value['page'], $value['cid']);
	?>
	<li class="commm">
	  <a title="查看<?php echo $value['name']; ?>的评论" href="<?php echo $url; ?>"><span class='comer'><?php echo $value['name']; ?></span>:<?php echo preg_replace("/\[F(([1-4]?[0-9])|50)\]/",'<img class="face" alt="face" src="'.TEMPLATE_URL.'images/face/$1.gif"  />',$value['content']); ?></a>
	</li>
	<?php endforeach; ?>
	</ul>
	</div>
<?php }?>
<?php
//widget：最新日志
function widget_newlog($title){
	global $CACHE; 
	$newLogs_cache = $CACHE->readCache('newlog');
	?>
	<div class="widgit-area">
	<h3><?php echo $title; ?></h3>
	<ul id="newlog">
    <?php
    foreach($newLogs_cache as $value){?>
	<li>
    <a title="<?php echo $value['title']; ?>" href="<?php echo Url::log($value['gid']); ?>"><?php echo $value['title']; ?></a></li>
	<?php
     }  ?>
	</ul>
	</div>
<?php }?>
<?php
//widget：热门日志
function widget_hotlog($title){
	$index_hotlognum = Option::get('index_hotlognum');
	$Log_Model = new Log_Model();
	$randLogs = $Log_Model->getHotLog($index_hotlognum);?>
	<div class="widgit-area">
	<h3><?php echo $title; ?></h3>
	<ul id="hotlog">
	<?php
    foreach($randLogs as $value){?>
	<li>
    <a title="<?php echo $value['title']; ?>" href="<?php echo Url::log($value['gid']); ?>"><?php echo $value['title']; ?></a></li>
	<?php
     }  ?>
	</ul>
	</div>
<?php }?>
<?php
//widget：随机日志
function widget_random_log($title){
	$index_randlognum = Option::get('index_randlognum');
	$Log_Model = new Log_Model();
	$randLogs = $Log_Model->getRandLog($index_randlognum);?>
	<div class="widgit-area">
	<h3><?php echo $title; ?></h3>
	<ul id="randlog">
	<?php
    foreach($randLogs as $value){?>
	<li>
    <a title="<?php echo $value['title']; ?>" href="<?php echo Url::log($value['gid']); ?>"><?php echo $value['title']; ?></a></li>
	<?php
     }  ?>
	</ul>
	</div>
<?php }?>
<?php
//widget：搜索
function widget_search($title){ ?>
	<div class="widgit-area">
	<h3><?php echo $title; ?></h3>
	<ul id="logserch">
	<form name="keyform" method="get" id="searchform" action="<?php echo BLOG_URL; ?>index.php">
	<input type="text" name="keyword" class="search" placeholder="搜搜更健康">
	</form>
	</ul>
	</div>
<?php } ?>
<?php
//widget：归档
function widget_archive($title){
	global $CACHE; 
	$record_cache = $CACHE->readCache('record');
	?>
	<div class="widgit-area">
	<h3><?php echo $title; ?></h3>
	<ul id="record">
	<?php foreach($record_cache as $value): ?>
	<li class="cat-item"><a title="<?php echo $value['lognum']; ?>篇文章" href="<?php echo Url::record($value['date']); ?>"><?php echo $value['record']; ?></a></li>
	<?php endforeach; ?>
	</ul>
	</div>
<?php } ?>
<?php
//widget：自定义组件
function widget_custom_text($title, $content){ ?>
	<div class="widgit-area">
	<h3><?php echo $title; ?></h3>
	<ul>
	<?php echo $content; ?>
	</ul>
	</div>
<?php } ?>
<?php
//widget：链接
function widget_link($title){
	global $CACHE; 
	$link_cache = $CACHE->readCache('link');
	?>
	<div class="widgit-area">
	<h3><?php echo $title; ?></h3>
	<ul id="link">
	<?php foreach($link_cache as $value): ?>
	<li class="cat-item"><a title="<?php echo $value['des']; ?>" href="<?php echo $value['url']; ?>" title="<?php echo $value['des']; ?>" target="_blank">
	<?php echo $value['link']; ?>
	</a></li>
	<?php endforeach; ?>
	</ul>
	</div>
<?php }?>
<?php
//blog：导航
function blog_navi(){
	global $CACHE;
	$navi_cache = $CACHE->readCache('navi');
	?>
	<ul class="menu">
	<?php
	foreach($navi_cache as $value):
		if($value['url'] == 'admin' && (ROLE == 'admin' || ROLE == 'writer')):
			?>
			<li class="item common"><a href="<?php echo BLOG_URL; ?>admin/">管理站点</a></li>
			<li class="item common"><a href="<?php echo BLOG_URL; ?>admin/?action=logout">退出</a></li>
			<?php
			continue;
		endif;
		$newtab = $value['newtab'] == 'y' ? 'target="_blank"' : '';
		$value['url'] = $value['isdefault'] == 'y' ? BLOG_URL . $value['url'] : trim($value['url'], '/');
		$current_tab = (BLOG_URL . trim(Dispatcher::setPath(), '/') == $value['url']) ? 'current' : 'common';
		?>
		<li class="<?php echo $current_tab;?>"><a href="<?php echo $value['url']; ?>" <?php echo $newtab;?>><?php echo $value['naviname']; ?></a></li>
		<?php endforeach; ?>
	</ul>
<?php }?>
<?php
//blog：置顶
function topflg($istop){
	$topflg = $istop == 'y' ? "<span class=\"label-important\">推荐</span><i class=\"label-arrow\"></i>" : '';
	echo $topflg;
}
?>
<?php
//blog：编辑
function editflg($logid,$author){
	$editflg = ROLE == 'admin' || $author == UID ? '<a href="'.BLOG_URL.'admin/write_log.php?action=edit&gid='.$logid.'">编辑</a>' : '';
	echo $editflg;
}
?>
<?php
//blog：分类
function blog_sort($blogid){
	global $CACHE; 
	$log_cache_sort = $CACHE->readCache('logsort');
	?>
	<?php if(!empty($log_cache_sort[$blogid])): ?>
	<a href="<?php echo Url::sort($log_cache_sort[$blogid]['id']); ?>" title="查看<?php echo $log_cache_sort[$blogid]['name']; ?>下的全部文章"><?php echo $log_cache_sort[$blogid]['name']; ?></a>
	<?php else: ?>
	<?php echo "未分类"; ?>
	<?php endif;?>
<?php }?>
<?php
//blog：日志标签
function blog_tag($blogid){
	global $CACHE;
	$log_cache_tags = $CACHE->readCache('logtags');
	if (!empty($log_cache_tags[$blogid])){
		$tag = '';
		foreach ($log_cache_tags[$blogid] as $value){
			$tag .= " <a href=\"".Url::tag($value['tagurl'])."\">".$value['tagname'].'  </a>';
		}
		echo $tag;
	}
	else {$tag = '无标签';
		echo $tag;}
}
?>
<?php
//blog：日志作者
function blog_author($uid){
	global $CACHE;
	$user_cache = Cache::getInstance()->readCache('user');
	$author = $user_cache[$uid]['name'];
	$mail = $user_cache[$uid]['mail'];
	$des = $user_cache[$uid]['des'];
	if($mail!==($user_cache[1]['mail'])){ $title = !empty($mail) || !empty($des) ? "title=\"特邀作者\"" : '';}else{$title = !empty($mail) || !empty($des) ? "title=\"丐帮帮主\"" : '';}
	echo '<a href="'.Url::author($uid)."\" $title>$author</a>";
}
?>
<?php
//blog：相邻日志
function neighbor_log($neighborLog){
	extract($neighborLog);?>
	<?php if($prevLog):?>
	<span class="postprevious"><a href="<?php echo Url::log($prevLog['gid']) ?>"><?php echo $prevLog['title'];?></a></span>
	<?php else:?>
	<span class="postprevious"> （已经是最新的） </span>
	<?php endif;?>
	<?php if($nextLog && $prevLog):?>|
	<?php endif;?>
	<?php if($nextLog):?>
	<span class="postnext"><a href="<?php echo Url::log($nextLog['gid']) ?>"><?php echo $nextLog['title'];?></a></span>
	<?php else:?>
	<span class="postnext">（最后一篇了）</span>
	<?php endif;?>
<?php }?>
<?php
//blog：评论列表
function blog_comments($comments,$params){
    extract($comments);
    if($commentStacks): ?>
	<a name="comments"></a>
	<?php endif; ?>
	<ol class="commentlist">
    <?php
	$isGravatar = Option::get('isgravatar');
	$comnum = count($comments);
	foreach($comments as $value){
	if($value['pid'] != 0){
	$comnum--;
	}
	}
	$pageKey=array_search('comment-page',$params); 
	if ($pageKey===false){ 
		$page=1; 
	} 
	else{ 
		$pageKey++; 
		$page = isset($params[$pageKey])?intval($params[$pageKey]):1; 
	}
	$i= $comnum - ($page - 1)*Option::get('comment_pnum');
	foreach($commentStacks as $cid):
	$comment = $comments[$cid];
	$comment['poster'] = $comment['url'] ? '<a href="'.$comment['url'].'" target="_blank">'.$comment['poster'].'</a>' : $comment['poster'];
	?>
	<li class="comment" id="comment-<?php echo $comment['cid']; ?>">
      <div class="comment-body">
	  <div class="commenttext">
	  <a name="<?php echo $comment['cid']; ?>"></a>
      <?php if($isGravatar == 'y'): ?>
	  <div class="gravatar">
     <img src="<?php echo getGravatar($comment['mail']); ?>"/>
	 </div>
	  <?php endif; ?>
	<div class="comment-meta">
	<span class="commentid"><?php echo $comment['poster']; ?></span> <?php $mail_str="\"".strip_tags($comment['mail'])."\"";echo_levels($mail_str,"\"".$comment['url']."\""); ?>
	<span class="commenttime">（<?php echo $comment['date']; ?>）</span>
	<span class="commentcount"><?php echo '#'.$i.'';?></span>
	</div>
	<div class="commentp">
    <p><?php echo preg_replace("/\[F(([1-4]?[0-9])|50)\]/",'<img class="face" alt="face" src="'.TEMPLATE_URL.'images/face/$1.gif"  />',$comment['content']); ?></p>
    <span class="reply" style="display: none;"><a href="#comment-<?php echo $comment['cid']; ?>" onclick="commentReply(<?php echo $comment['cid']; ?>,this)">[回复]</a></span>
	</div>
	<?php blog_comments_children($comments, $comment['children']); $ii=0;?>
      </div>
	  <div class="clearline"></div>
	  </div>
	</li>
	<div style="clear:both;"></div>
	<?php $i--;endforeach; ?>
	</ol>
    <div class="commentnav">
	<?php echo $commentPageUrl;?>
    </div>
<?php }?>
<?php
//blog：子评论列表
function blog_comments_children($comments, $children){
	$isGravatar = Option::get('isgravatar');
	foreach($children as $child):
	$comment = $comments[$child];
	$comment['poster'] = $comment['url'] ? '<a href="'.$comment['url'].'" target="_blank" rel="nofollow">'.$comment['poster'].'</a>' : $comment['poster'];
	?>
	<ul class="children" id="comment-<?php echo $comment['cid']; ?>">
      <li>
	  <div class="commenttext">
	  <a name="<?php echo $comment['cid']; ?>"></a>
      <?php if($isGravatar == 'y'): ?>
	  <div class="gravatar">
     <img src="<?php echo getGravatar($comment['mail']); ?>"/>
	 </div>
	  <?php endif; ?>
	  <div class="comment-meta">
	<span class="commentid"><?php echo $comment['poster']; ?></span> <?php $mail_str="\"".strip_tags($comment['mail'])."\"";echo_levels($mail_str,"\"".$comment['url']."\""); ?>
	<span class="commenttime">（<?php echo $comment['date']; ?>）</span>
	</div>
      <div class="commentp">
    <p><?php echo preg_replace("/\[F(([1-4]?[0-9])|50)\]/",'<img class="face" alt="face" src="'.TEMPLATE_URL.'images/face/$1.gif"  />',$comment['content']); ?></p>
    <span class="reply" style="display: none;"><a href="#comment-<?php echo $comment['cid']; ?>" onclick="commentReply(<?php echo $comment['cid']; ?>,this)">[回复]</a></span>
	</div>
	</div>
      </li>
	  <?php blog_comments_children($comments, $comment['children']); $ii++;?>
	</ul>
	<?php endforeach; ?>
<?php }?>
<?php
//blog：发表评论表单
function blog_comments_post($logid,$ckname,$ckmail,$ckurl,$verifyCode,$allow_remark){
	if($allow_remark == 'y'): ?>
	<div id="comment-place">
	<div class="comment-post" id="comment-post">
		<div class="cancel-reply" id="cancel-reply" style="display:none"><a href="javascript:void(0);" onclick="cancelReply()">取消回复</a></div>
		<form method="post" name="commentform" action="<?php echo BLOG_URL; ?>index.php?action=addcom" id="commentform">
			<input type="hidden" name="gid" value="<?php echo $logid; ?>" />
			<?php if(ROLE == ROLE_VISITOR): ?>
			<div id="author_info">
					<div class="writerinfodiv">
						<input type="text" name="comname" maxlength="49" size="22" id="author" value="<?php echo $ckname; ?>" tabindex="1" /><label for="author" >昵称(必填)</label>
					</div>
					<div class="writerinfodiv">
						<input type="email" name="commail"  maxlength="128" size="22" id="email" value="<?php echo $ckmail; ?>" tabindex="2" /><label for="email" >邮箱(选填)</label>
					</div>
					<div class="writerinfodiv">
						<input type="text" name="comurl" maxlength="128" size="22" id="url" value="<?php echo $ckurl; ?>" tabindex="3" /><label for="url" >网址</label>
					</div>
				</div>
			<?php endif; ?>
			<div class="smile"><?php include View::getView('smiley');?></div>
			<p>
		   <textarea name="comment" id="comment" rows="8" tabindex="4"></textarea>
		    </p>
			<p><br/><input name="submit" type="submit" id="submit" class="submitstyle normal" tabindex="5" value="Submit Comment　(Ctrl+Enter)"/>
		     </p>
			<p><?php echo $verifyCode; ?></p>
			<input type="hidden" name="pid" id="comment-pid" value="0" size="22" tabindex="1"/>
		</form>
	</div>
	</div>
	<?php endif; ?>
<?php }?>
<?php
//comment：输出等级
function echo_levels($comment_author_email,$comment_author_url){
  $DB = MySql::getInstance();
  $vip_list = array('"1315800105@qq.com"');
	if(in_array($comment_author_email,$vip_list)){
	   echo '<a class="vip" href="mailto:1315800105@qq.com" title="会员认证"></a>';
	  }

  $adminEmail = '"1315800105@qq.com"';
  if($comment_author_email==$adminEmail)
  {
	echo '<a class="vip" href="mailto:'.$comment_author_email.'" title="作者认证"></a>';
    echo '<a class="vp" href="mailto:1315800105@qq.com" title="管理员认证"></a><a class="vip7" title="特别认证"></a>';
  }
  
  $sql = "SELECT cid as author_count FROM emlog_comment WHERE mail = ".$comment_author_email;
  $res = $DB->query($sql);
  $author_count = mysql_num_rows($res);
  if($author_count>=5 && $author_count<10 && $comment_author_email!=$adminEmail)
    echo '<a class="vip1" title="战⑤渣"></a>';
  else if($author_count>=10 && $author_count<20 && $comment_author_email!=$adminEmail)
    echo '<a class="vip2" title="优秀评论渣"></a>';
  else if($author_count>=20 && $author_count<40 && $comment_author_email!=$adminEmail)
    echo '<a class="vip3" title="评论猿"></a>';
  else if($author_count>=40 && $author_count<80 && $comment_author_email!=$adminEmail)
    echo '<a class="vip4" title="优秀评论猿"></a>';
  else if($author_count>=80 &&$author_count<160 && $comment_author_email!=$adminEmail)
    echo '<a class="vip5" title="专业评论猿"></a>';
  else if($author_count>=160 && $author_coun<320 && $comment_author_email!=$adminEmail)
    echo '<a class="vip6" title="专业评婶"></a>';
  else if($author_count>=320 && $comment_author_email!=$adminEmail)
    echo '<a class="vip7" title="专业傻逼"></a>';
}
?>