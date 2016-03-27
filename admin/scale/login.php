<?php if(!defined('EMLOG_ROOT')) {exit('error!');}?>
<!DOCTYPE html>
<html lang="en" class="app">
<head>
<meta charset="utf-8"/>
<title>柒爱后花园</title>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
<link rel="stylesheet" href="./scale/css/bootstrap.css" type="text/css"/>
<link rel="stylesheet" href="./scale/css/animate.css" type="text/css"/>
<link rel="stylesheet" href="./scale/css/font-awesome.min.css" type="text/css"/>
<link rel="stylesheet" href="./scale/css/icon.css" type="text/css"/>
<link rel="stylesheet" href="./scale/css/font.css" type="text/css"/>
<link rel="stylesheet" href="./scale/css/app.css?v=<?php echo Option::EMLOG_VERSION; ?>" type="text/css"/>
<link rel="stylesheet" href="./scale/css/login.css?v=<?php echo Option::EMLOG_VERSION; ?>" type="text/css"/>
<script src="./scale/js/jquery.min.js"></script>
<script type="text/javascript" src="./scale/js/common.js?v=<?php echo Option::EMLOG_VERSION; ?>"></script>
<!--[if lt IE 9]>
<script src="./scale/js/ie/html5shiv.js"></script>
<script src="./scale/js/ie/respond.min.js"></script>
<script src="./scale/js/ie/excanvas.js"></script>
<![endif]-->
</head>
<body>
<section class="m-t-lg wrapper-md animated fadeInUp">
	<div class="container aside-xl">
		<a class="navbar-brand block">Seven、love</a>
		<section class="m-b-lg">
			<header class="wrapper text-center"></header>
			<form name="f" method="post" action="./index.php?action=login">
				<div class="list-group">
					<div class="list-group-item">
						<input type="text" name="user" id="user"  placeholder="用户名" class="form-control no-border">
					</div>
					<div class="list-group-item">
						<input type="password" name="pw" id="pw" placeholder="密码" class="form-control no-border">
					</div>
					<?php echo $ckcode; ?>
				</div>
				<div class="list-group">
					<label class="checkbox i-checks">
						<input type="checkbox" name="ispersis" id="ispersis" value="1" /><i></i>记住我
					</label>
				</div>
				<div class="list-group"><input type="submit" value=" 登 录" class="btn btn-lg btn-primary btn-block"></div>
				<div class="list-group"><?php doAction('login_ext'); ?></div>
			</form>
			<?php if ($error_msg): ?><div class="alert alert-danger"><?php echo $error_msg; ?></div><?php endif;?>
		</section>
	</div>
</section>
<footer id="footer">
	<div class="text-center padder">
		<p><small>柒爱 &copy; 2015</small></p>
	</div>
</footer>
<script src="./scale/js/bootstrap.js"></script>
<script src="./scale/js/app.js?v=<?php echo Option::EMLOG_VERSION; ?>"></script>
<script src="./scale/js/slimscroll/jquery.slimscroll.min.js"></script>
<script src="./scale/js/app.plugin.js?v=<?php echo Option::EMLOG_VERSION; ?>"></script>
</body>
</html>
