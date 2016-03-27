<?php
	if(!defined('EMLOG_ROOT')) {exit('error!');}
	$db = MySql::getInstance();
	global $CACHE;
	$JA_STA = $CACHE->readCache('sta');
	$JA_STA['linknum'] = count($CACHE->readCache('link'));
	$JA_STA['sortnum'] = count($CACHE->readCache('sort'));
	$JA_STA['tagsnum'] = count($CACHE->readCache('tags'));
	$JA_STA['usernum'] = count($CACHE->readCache('user'));
	//置顶文章数
	$data = $db->once_fetch_array("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "blog WHERE  top = 'y' or sortop = 'y' AND type = 'blog'");
	$JA_STA['log_top'] = $data['total'];
	//未审核文章数
	$data = $db->once_fetch_array("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "blog WHERE checked = 'n' AND type = 'blog'");
	$JA_STA['log_check'] = $data['total'];
	//加密文章数
	$data = $db->once_fetch_array("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "blog WHERE  password !='' AND type = 'blog'");
	$JA_STA['log_pass'] = $data['total'];
	//页面数量总数
	$data = $db->once_fetch_array("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "blog WHERE type = 'page'");
	$JA_STA['log_page'] = $data['total'];
	//统计微语评论总数
	$data = $db->once_fetch_array("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "reply");
	$JA_STA['log_reply'] = $data['total'];
	//统计子分类数
	$data = $db->once_fetch_array("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "sort WHERE pid != 0");
	$JA_STA['log_sort_mod'] = $data['total'];
	//统计父分类数
	$data = $db->once_fetch_array("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "sort WHERE pid = 0");
	$JA_STA['log_sort_bod'] = $data['total'];
	//统计附件总数
	$data = $db->once_fetch_array("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "attachment");
	$JA_STA['log_att'] = $data['total'];
	extract($JA_STA);
?>
<!DOCTYPE html>
<html lang="en" class="app">
<head>
<meta charset="utf-8"/>
<meta http-equiv="Content-Language" content="zh-CN" />
<meta name="author" content="emlog"/>
<meta name="robots" content="noindex, nofollow">
<title>管理中心 - <?php echo Option::get('blogname'); ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
<link rel="stylesheet" href="./scale/css/bootstrap.css" type="text/css"/>
<link rel="stylesheet" href="./scale/css/animate.css" type="text/css"/>
<link rel="stylesheet" href="./scale/css/font-awesome.min.css" type="text/css"/>
<link rel="stylesheet" href="./scale/css/icon.css" type="text/css"/>
<link rel="stylesheet" href="./scale/css/font.css" type="text/css"/>
<link rel="stylesheet" href="./scale/css/app.css" type="text/css"/>
<link rel="stylesheet" href="./scale/css/style.css" type="text/css"/>
<script src="./scale/js/jquery.min.js?v=<?php echo Option::EMLOG_VERSION; ?>"></script>
<script src="./scale/js/jquery-ui.min.js?v=<?php echo Option::EMLOG_VERSION; ?>"></script>
<script src="./scale/js/bootstrap.js"></script>
<script src="./scale/js/app.js?v=<?php echo Option::EMLOG_VERSION; ?>"></script>
<script src="./scale/js/slimscroll/jquery.slimscroll.min.js"></script>
<script src="./scale/js/app.plugin.js?v=<?php echo Option::EMLOG_VERSION; ?>"></script>
<script type="text/javascript" src="../include/lib/js/jquery/plugin-cookie.js?v=<?php echo Option::EMLOG_VERSION; ?>"></script>
<script type="text/javascript" src="./scale/js/common.js?v=<?php echo Option::EMLOG_VERSION; ?>"></script>
<!--[if lt IE 9]>
<script src="./scale/js/ie/html5shiv.js"></script>
<script src="./scale/js/ie/respond.min.js"></script>
<script src="./scale/js/ie/excanvas.js"></script>
<![endif]-->
<?php doAction('adm_head');?>
</head>
<body class="">
<section class="vbox">
<header class="bg-light header header-md navbar navbar-fixed-top-xs box-shadow">
	<div class="navbar-header aside-md dk">
		<a class="btn btn-link visible-xs" data-toggle="class:nav-off-screen" data-target="#nav"><i class="fa fa-bars"></i></a>
		<a class="navbar-brand" href="../" target="_blank" title="在新窗口浏站点"><span class="hidden-nav-xs"><?php $blog_name = Option::get('blogname');echo empty($blog_name) ? '查看我的站点' : subString($blog_name, 0, 24);?></span></a>
		<a class="btn btn-link visible-xs" data-toggle="dropdown" data-target=".user"><i class="fa fa-cog"></i></a>
	</div>
	<ul class="nav navbar-nav hidden-xs">
		<li class="dropdown">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="i i-grid"></i></a>
			<section class="dropdown-menu aside-lg bg-white on animated fadeInLeft">
				<div class="row m-l-none m-r-none m-t m-b text-center">
					<div class="col-xs-4">
						<div class="padder-v">
							<a href="comment.php">
								<span class="m-b-xs block"><i class="fa fa-comments i-2x text-primary-lt"></i></span>
								<small class="text-muted">Comments</small>
							</a>
						</div>
					</div>
					<div class="col-xs-4">
						<div class="padder-v">
							<a href="admin_log.php">
								<span class="m-b-xs block"><i class="fa fa-list-alt i-2x text-danger-lt"></i></span>
								<small class="text-muted">Article</small>
							</a>
						</div>
					</div>
					<div class="col-xs-4">
						<div class="padder-v">
							<a href="../map.php" target="_blank">
								<span class="m-b-xs block"><i class="i i-map i-2x text-success-lt"></i></span>
								<small class="text-muted">Map</small>
							</a>
						</div>
					</div>
					<div class="col-xs-4">
						<div class="padder-v">
							<a href="../">
								<span class="m-b-xs block"><i class="i i-screen i-2x text-info-lt"></i></span>
								<small class="text-muted">Web Blog</small>
							</a>
						</div>
					</div>
					<div class="col-xs-4">
						<div class="padder-v">
							<a href="blogger.php">
								<span class="m-b-xs block"><i class="fa fa-cog fa-2x text-muted"></i></span>
								<small class="text-muted">Set up</small>
							</a>
						</div>
					</div>
					<div class="col-xs-4">
						<div class="padder-v">
							<a href="#">
								<span class="m-b-xs block"><i class="i i-clock i-2x text-warning-lter"></i></span>
								<small class="text-muted">Timeline</small>
							</a>
						</div>
					</div>
				</div>
			</section>
		</li>
	</ul>
	<ul class="nav navbar-nav navbar-right m-n hidden-xs nav-user user">
		<li class="hidden-xs"><a href="<?php if (ROLE == ROLE_ADMIN):?>./configure.php<?php else: ?>./blogger.php<?php endif;?>"><i class="fa fa-cog" style="font-size:18px;"></i></a></li>

   		<?php
		$hidecmnum = ROLE == ROLE_ADMIN ? $sta_cache['hidecomnum'] : $sta_cache[UID]['hidecommentnum'];
		if ($hidecmnum > 0):
		$n = $hidecmnum > 999 ? '...' : $hidecmnum;
		?>
		<li class="hidden-xs"><a href="./comment.php?hide=y" title="<?php echo $hidecmnum; ?>条评论待审"><i class="i i-chat3"></i><span class="badge badge-sm up bg-danger"><?php echo $n; ?></span></a></li>
		<?php endif; ?>
		<li class="dropdown">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown">
			<span class="thumb-sm avatar pull-right m-t-n-sm m-b-n-sm m-l-sm"><img src="<?php echo empty($user_cache[UID]['avatar']) ? './scale/images/avatar.jpg' : '../' . $user_cache[UID]['avatar'] ?>"></span><?php echo subString($user_cache[UID]['name'], 0, 12) ?> <b class="caret"></b></a>
			<ul class="dropdown-menu animated fadeInRight">
				<li><span class="arrow top"></span><a href="?action=logout"><i class="fa fa-power-off fa-fw"></i> Logout</a></li>
			</ul>
		</li>
	</ul>
</header>
<section>
<section class="hbox stretch">
	<aside class="bg-black lt b-r b-light aside-md hidden-print" id="nav">
		<section class="vbox">
			<section class="w-f scrollable">
				<div class="slim-scroll" data-height="auto" data-disable-fade-out="true" data-distance="0" data-size="10px" data-railopacity="0.2">
					<div class="clearfix wrapper dk nav-user hidden-xs">
						<div class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<span class="thumb avatar pull-left m-r"><img src="<?php echo empty($user_cache[UID]['avatar']) ? './scale/images/avatar.jpg' : '../' . $user_cache[UID]['avatar'] ?>" class="dker"></span>
								<span class="hidden-nav-xs clear">
									<span class="block m-t-xs"><strong class="font-bold text-lt"><?php echo subString($user_cache[UID]['name'], 0, 12) ?></strong><b class="caret"></b></span>
									<span class="text-muted text-xs block"><?php if (ROLE == ROLE_ADMIN):?>Administrator<?php else:?>leaguer<?php endif;?></span>
								</span>
							</a>
							<ul class="dropdown-menu animated fadeInRight m-t-xs">
								<li><span class="arrow top hidden-nav-xs"></span><a href="?action=logout"><i class="fa fa-power-off fa-fw"></i> Logout</a></li>
							</ul>
						</div>
					</div>
					<!-- nav-->
					<nav class="nav-primary hidden-xs">
						<ul class="nav nav-main" data-ride="collapse">
							<li id="menu_home"><a href="./" class="auto"><i class="i i-home icon"></i><span class="font-bold">Dashboard</span></a></li>
							<li id="menu_wt"><a href="write_log.php" class="auto"><i class="fa fa-edit"></i><span class="font-bold">写文章</span></a></li>
							<li id="menu_draft"><a href="admin_log.php?pid=draft" class="auto"><i class="i i-paste icon"></i><span class="font-bold">草稿</span><?php if (ROLE == ROLE_ADMIN){echo $sta_cache['draftnum'] == 0 ? '' : '<b class="badge bg-danger pull-right">'.$sta_cache['draftnum'].'</b>'; }else{echo $sta_cache[UID]['draftnum'] == 0 ? '<b class="badge bg-danger pull-right">' : ''.$sta_cache[UID]['draftnum'].'</b>';}?></a></li>
							<li id="menu_log"><a href="admin_log.php" class="auto"><i class="i i-list icon"></i><span class="font-bold">文章</span></a></li>
							<?php
								$checknum = $sta_cache['checknum'];
								if (ROLE == ROLE_ADMIN && $checknum > 0):
								$n = $checknum > 999 ? '...' : $checknum;
							?>
							<li id="menu_notice"><a href="./admin_log.php?checked=n" class="auto" title="<?php echo $checknum; ?>篇文章待审"><i class="i i-list icon"></i><span class="font-bold">文章待审</span><b class="badge bg-info pull-right"><?php echo $n; ?></b></a></li>
							<?php endif; ?>
							<?php if (ROLE == ROLE_ADMIN):?>
							<li id="menu_tag"><a href="tag.php" class="auto"><i class="i i-tag icon"></i><span class="font-bold">标签</span></a></li>
							<li id="menu_sort"><a href="sort.php" class="auto"><i class="i i-add-to-list icon"></i><span class="font-bold">分类</span></a></li>
							<?php endif;?>
							<li id="menu_cm"><a href="comment.php" class="auto"><i class="i i-bubble icon"></i><span class="font-bold">评论</span></a></li>
							<?php if (ROLE == ROLE_ADMIN):?>
							<li id="menu_tw"><a href="twitter.php" class="auto"><i class="i i-twitter icon"></i><span class="font-bold">微语</span></a></li>
							<li id="menu_page"><a href="page.php" class="auto"><i class="i i-copy2 icon"></i><span class="font-bold">页面</span></a></li>
							<li id="menu_link"><a href="link.php" class="auto"><i class="i i-link2 icon"></i><span class="font-bold">链接</span></a></li>
							<li id="menu_category_view">
								<a href="#" class="auto">
									<span class="pull-right text-muted"><i class="i i-circle-sm-o text"></i><i class="i i-circle-sm text-active"></i></span>
									<i class="i i-laptop icon"></i><span class="font-bold">外观</span>
								</a>
								<ul class="nav dk">
									<li id="menu_widget"><a href="widgets.php" class="auto"><i class="fa fa-columns"></i><span>侧边栏</span></a></li>
									<li id="menu_navbar"><a href="navbar.php" class="auto"><i class="fa fa-align-justify"></i><span>导航</span></a></li>
									<li id="menu_tpl"><a href="template.php" class="auto"><i class="fa fa-magic"></i><span>模板</span></a></li>
								</ul>
							</li>
							<li id="menu_category_sys">
								<a href="#" class="auto">
									<span class="pull-right text-muted"><i class="i i-circle-sm-o text"></i><i class="i i-circle-sm text-active"></i></span>
									<i class="i i-settings icon"></i><span class="font-bold">系统</span>
								</a>
								<ul class="nav dk">
									<li id="menu_setting"><a href="./configure.php" class="auto"><i class="fa fa-wrench"></i><span>设置</span></a></li>
									<li id="menu_user"><a href="user.php" class="auto"><i class="fa fa-user"></i><span>用户</span></a></li>
									<li id="menu_data"><a href="data.php" class="auto"><i class="i i-data"></i><span>数据</span></a></li>
									<li id="menu_plug"><a href="plugin.php" class="auto"><i class="fa fa-gears"></i><span>插件</span></a></li>
									<li id="menu_store"><a href="store.php" class="auto"><i class="fa fa-shopping-cart"></i><span>应用</span></a></li>
								</ul>
							</li>
							
							<?php if (!empty($emHooks['adm_sidebar_ext'])): ?>
							<li id="menu_ext">
								<a href="#" class="auto">
									<span class="pull-right text-muted"><i class="i i-circle-sm-o text"></i><i class="i i-circle-sm text-active"></i></span>
									<i class="fa fa-puzzle-piece icon"></i><span class="font-bold">扩展功能</span>
								</a>
								<ul class="nav dk">
									<?php doAction('adm_sidebar_ext'); ?>
								</ul>
							</li>
							<?php endif;?>
							<?php endif;?>
						</ul>
					</nav>
					<!-- nav-->
				</div>
			</section>
		</section>
	</aside>
	<section>
	<?php doAction('adm_main_top'); ?>
