<?php if(!defined('EMLOG_ROOT')) {exit('error!');}?>
<section class="vbox">
	<section class="scrollable wrapper">
<?php if(isset($_GET['error_login'])):?><div class="alert alert-danger error">用户名不能为空</div><?php endif;?>
<?php if(isset($_GET['error_exist'])):?><div class="alert alert-danger error">该用户名已存在</div><?php endif;?>
<?php if(isset($_GET['error_pwd_len'])):?><div class="alert alert-danger error">密码长度不得小于6位</div><?php endif;?>
<?php if(isset($_GET['error_pwd2'])):?><div class="alert alert-danger error">两次输入密码不一致</div><?php endif;?>
		<div class="row">
			<div class="col-lg-12">
				<section class="panel panel-default">
					<header class="panel-heading font-bold"><i class="fa fa-user fa-fw"></i> 修改作者资料</header>
					<div class="panel-body">
						<form class="form-horizontal" action="user.php?action=update" method="post">
							<div class="form-group">
								<label class="col-sm-2 control-label">用户名</label>
								<div class="col-sm-10">
									<input type="text" value="<?php echo $username; ?>" name="username" class="form-control" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">昵称</label>
								<div class="col-sm-10">
									<input type="text" value="<?php echo $nickname; ?>" name="nickname" class="form-control" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">新密码(不修改请留空)</label>
								<div class="col-sm-10">
									<input type="password" value="" name="password" class="form-control" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">重复新密码</label>
								<div class="col-sm-10">
									<input type="password" value="" name="password2" class="form-control" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">电子邮件</label>
								<div class="col-sm-10">
									<input type="text"  value="<?php echo $email; ?>" name="email" class="form-control" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">用户权限：</label>
								<div class="col-sm-10">
									<select name="role" id="role" class="form-control">
										<option value="writer" <?php echo $ex1; ?>>作者</option>
										<option value="admin" <?php echo $ex2; ?>>管理员</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">用户文章权限：</label>
								<div class="col-sm-10" id="ischeck">
									<select name="ischeck" class="form-control">
										<option value="n" <?php echo $ex3; ?>>文章不需要审核</option>
										<option value="y" <?php echo $ex4; ?>>文章需要审核</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">个人描述</label>
								<div class="col-sm-10">
									<textarea name="description" rows="5" class="form-control"><?php echo $description; ?></textarea>
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-4 col-sm-offset-2">
									<input name="token" id="token" value="<?php echo LoginAuth::genToken(); ?>" type="hidden" />
									<input type="hidden" value="<?php echo $uid; ?>" name="uid" />
									<input type="submit" value="保 存" class="btn btn-primary" />
									<input type="button" value="取 消" class="btn btn-default" onclick="window.location='user.php';" />
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
$("#menu_user").addClass('active');
if($("#role").val() == 'admin') $("#ischeck").hide();
$("#role").change(function(){$("#ischeck").toggle()})
</script>