<?php if(!defined('EMLOG_ROOT')) {exit('error!');}?>
<section class="vbox">
	<section class="scrollable wrapper">
<?php if(isset($_GET['active_edit'])):?><div class="alert alert-info actived">个人资料修改成功</div><?php endif;?>
<?php if(isset($_GET['active_del'])):?><div class="alert alert-info actived">头像删除成功</div><?php endif;?>
<?php if(isset($_GET['error_a'])):?><div class="alert alert-danger error">昵称不能太长</div><?php endif;?>
<?php if(isset($_GET['error_b'])):?><div class="alert alert-danger error">电子邮件格式错误</div><?php endif;?>
<?php if(isset($_GET['error_c'])):?><div class="alert alert-danger error">密码长度不得小于6位</div><?php endif;?>
<?php if(isset($_GET['error_d'])):?><div class="alert alert-danger error">两次输入的密码不一致</div><?php endif;?>
<?php if(isset($_GET['error_e'])):?><div class="alert alert-danger error">该登录名已存在</div><?php endif;?>
<?php if(isset($_GET['error_f'])):?><div class="alert alert-danger error">该昵称已存在</div><?php endif;?>
		<div class="row">
			<div class="col-lg-12">
				<section class="panel panel-default">
					<header class="panel-heading font-bold">
						<ul class="nav nav-tabs">
							<?php if (ROLE == ROLE_ADMIN):?>
							<li class=""><a href="./configure.php">基本设置</a></li>
							<li class=""><a href="./seo.php">SEO设置</a></li>
							<li class="active"><a href="./blogger.php">个人设置</a></li>
							<?php else:?>
							<li class="active"><a href="./blogger.php">个人设置</a></li>
							<?php endif;?>
                      </ul>
					</header>
					<div class="panel-body">
						<form class="form-horizontal" action="blogger.php?action=update" method="post" name="blooger" id="blooger" enctype="multipart/form-data">
							<div class="row">
								<div class="col-lg-4">
									<section class="panel no-border">
										<div class="panel-body">
											<div class="row m-t-xl">
												<div class="col-xs-12 text-center">
													<div class="inline"><?php echo $icon; ?></div>
												</div>
											</div>
											<div class="wrapper m-t-xl m-b">
												<div class="row m-b">
													<div class="col-xs-12 text-center">
														<input type="hidden" name="photo" value="<?php echo $photo; ?>"/><input name="photo" type="file" />
														<div class="text-lt font-bold"> (支持JPG、PNG格式图片)</div>
													</div>
												</div>
											</div>
										</div>
									</section>
								</div>
								<div class="col-lg-8">
									<div class="form-group">
										<label class="col-sm-2 control-label">昵称：</label>
										<div class="col-sm-10">
											<input maxlength="50" class="form-control" value="<?php echo $nickname; ?>" name="name" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label">邮箱：</label>
										<div class="col-sm-10">
											<input name="email" class="form-control" value="<?php echo $email; ?>" maxlength="200" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label">个人描述：</label>
										<div class="col-sm-10">
											<textarea name="description" class="form-control" style="width:100%; height:65px;" type="text" maxlength="500"><?php echo $description; ?></textarea>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label">登陆名：</label>
										<div class="col-sm-10">
											<input maxlength="200" class="form-control" value="<?php echo $username; ?>" name="username" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label">新密码（不小于6位，不修改请留空）：</label>
										<div class="col-sm-10">
											<input type="password" maxlength="200" class="form-control" value="" name="newpass" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label">再输入一次新密码：</label>
										<div class="col-sm-10">
											<input type="password" maxlength="200" class="form-control" value="" name="repeatpass" />
										</div>
									</div>
									<div class="form-group">
										<div class="col-sm-4 col-sm-offset-2">
											<input name="token" id="token" value="<?php echo LoginAuth::genToken(); ?>" type="hidden" />
											<input type="submit" value="保存设置" class="btn btn-primary" />
										</div>
									</div>
								</div>
							</div>
						</form>
					</div>
				</section>
			</div>
		</div>
		<div class="footer text-center">欢迎使用 &copy; <a href="http://www.emlog.net" target="_blank">emlog</a><?php doAction('adm_footer');?></div>
	</section>
</section>
<script>
setTimeout(hideActived,2600);
$("#menu_category_sys").addClass('active');
$("#menu_setting").addClass('active');
</script>
