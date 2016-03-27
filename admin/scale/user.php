<?php if(!defined('EMLOG_ROOT')) {exit('error!');}?>
<section class="vbox">
	<header class="header bg-white b-b b-light"><a href="javascript:displayToggle('user_new', 2);" class="btn btn-sm btn-info pull-right">添加用户+</a><p>用户管理 <span class="badge"><?php echo $usernum; ?></span></p></header>
	<section class="scrollable wrapper">
<?php if(isset($_GET['active_del'])):?><div class="alert alert-info actived">删除成功</div><?php endif;?>
<?php if(isset($_GET['active_update'])):?><div class="alert alert-info actived">修改用户资料成功</div><?php endif;?>
<?php if(isset($_GET['active_add'])):?><div class="alert alert-info actived">添加用户成功</div><?php endif;?>
<?php if(isset($_GET['error_login'])):?><div class="alert alert-danger error">用户名不能为空</div><?php endif;?>
<?php if(isset($_GET['error_exist'])):?><div class="alert alert-danger error">该用户名已存在</div><?php endif;?>
<?php if(isset($_GET['error_pwd_len'])):?><div class="alert alert-danger error">密码长度不得小于6位</div><?php endif;?>
<?php if(isset($_GET['error_pwd2'])):?><div class="alert alert-danger error">两次输入密码不一致</div><?php endif;?>
<?php if(isset($_GET['error_del_a'])):?><div class="alert alert-danger error">不能删除创始人</div><?php endif;?>
<?php if(isset($_GET['error_del_b'])):?><div class="alert alert-danger error">不能修改创始人信息</div><?php endif;?>
		<div class="row" id="user_new">
			<div class="col-lg-12">
				<section class="panel panel-default">
					<header class="panel-heading font-bold"><i class="fa fa-user fa-fw"></i> 用户名添加</header>
					<div class="panel-body">
						<form class="form-horizontal" action="user.php?action=new" method="post">
							<div class="form-group">
								<label class="col-sm-2 control-label">用户权限：</label>
								<div class="col-sm-10">
									<select name="role" id="role" class="form-control">
										<option value="writer">作者（投稿人）</option>
										<option value="admin">管理员</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">用户名：</label>
								<div class="col-sm-10">
									<input name="login" type="text" id="login" value="" class="form-control" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">密码 (大于6位)：</label>
								<div class="col-sm-10">
									<input name="password" type="password" id="password" value="" class="form-control" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">重复密码：</label>
								<div class="col-sm-10">
									<input name="password2" type="password" id="password2" value="" class="form-control" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">审核权限：</label>
								<div class="col-sm-10" id="ischeck">
									<select name="ischeck" class="form-control">
										<option value="n">文章不需要审核</option>
										<option value="y">文章需要审核</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-4 col-sm-offset-2">
									<input name="token" id="token" value="<?php echo LoginAuth::genToken(); ?>" type="hidden" />
									<input type="submit" name="" value="添加用户" class="btn btn-success" />
								</div>
							</div>
						</form>
					</div>
				</section>
			</div>
		</div>
		<div class="row">
			<?php
				if($users):
				foreach($users as $key => $val):
				$avatar = empty($user_cache[$val['uid']]['avatar']) ? './scale/images/avatar.jpg' : '../' . $user_cache[$val['uid']]['avatar'];
			?>
			<div class="col-lg-4">
				<section class="panel panel-default">
					<header class="panel-heading bg-light no-border">
						<div class="clearfix">
							<a href="#" class="pull-left thumb-md avatar b-3x m-r"><img src="http://gravatar.duoshuo.com/avatar/<?php echo md5($val['email']);?>?s=40&d=mm&r=g"></a>
							<div class="clear">
								<div class="h3 m-t-xs m-b-xs"><?php echo empty($val['name']) ? $val['login'] : $val['name']; ?>
									<span class="pull-right">
										<?php if (UID != $val['uid']): ?>
										<a href="javascript: em_confirm(<?php echo $val['uid']; ?>, 'user', '<?php echo LoginAuth::genToken(); ?>');"><i class="fa fa-times-circle-o text-danger text-xs m-t-sm"></i></a>
										<a href="user.php?action=edit&uid=<?php echo $val['uid']?>"><i class="fa fa-edit text-primary text-xs m-t-sm"></i></a>
										<?php else:?>
										<a href="blogger.php"><i class="fa fa-edit text-primary text-xs m-t-sm"></i></a>
										<?php endif;?>
									</span>
								</div>
								<small class="text-muted"><?php echo $val['description']; ?></small>
							</div>
						</div>
					</header>
					<div class="list-group no-radius alt">
						<a class="list-group-item" href="./admin_log.php?uid=<?php echo $val['uid'];?>">
							<span class="badge bg-success"><?php echo $sta_cache[$val['uid']]['lognum']; ?></span>
							<i class="i i-paste icon icon-muted"></i> 文章
						</a>
						<a class="list-group-item">
							<span class="badge bg-info"><?php echo $val['role'] == ROLE_ADMIN ? $val['uid'] == 1 ? '创始人':'管理员' : '作者'; ?><?php if ($val['role'] == ROLE_WRITER && $val['ischeck'] == 'y') echo '(文章需审核)';?></span>
							<i class="fa fa-envelope icon-muted"></i> Role
						</a>
						<a class="list-group-item">
							<span class="badge bg-light"><?php echo $val['email']; ?></span>
							<i class="fa fa-envelope icon-muted"></i> Email
						</a>
					</div>
				</section>
			</div>
			<?php endforeach;else:?>
			<div class="alert alert-danger">还没有添加作者</div>
			<?php endif;?>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<ul class="pagination pull-right">
					<?php echo $pageurl; ?>
				</ul>
			</div>
		</div>
		<div class="footer text-center">欢迎使用 &copy; <a href="http://www.emlog.net" target="_blank">emlog</a><?php doAction('adm_footer');?></div>
	</section>
</section>
<script>
$("#user_new").css('display', $.cookie('em_user_new') ? $.cookie('em_user_new') : 'none');
$(document).ready(function(){
	$("#adm_comment_list tbody tr:odd").addClass("tralt_b");
	$("#adm_comment_list tbody tr")
		.mouseover(function(){$(this).addClass("trover");$(this).find("span").show();})
		.mouseout(function(){$(this).removeClass("trover");$(this).find("span").hide();})
    $("#role").change(function(){$("#ischeck").toggle()})
});
setTimeout(hideActived,2600);
$("#menu_category_sys").addClass('active');
$("#menu_user").addClass('active');
</script>