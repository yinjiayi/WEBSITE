<?php if(!defined('EMLOG_ROOT')) {exit('error!');} ?>
<section class="vbox">
	<section class="scrollable wrapper">
<?php if(isset($_GET['active_taxis'])):?><div class="alert alert-info actived">排序更新成功</div><?php endif;?>
<?php if(isset($_GET['active_del'])):?><div class="alert alert-info actived">删除成功</div><?php endif;?>
<?php if(isset($_GET['active_edit'])):?><div class="alert alert-info actived">修改成功</div><?php endif;?>
<?php if(isset($_GET['active_add'])):?><div class="alert alert-info actived">添加成功</div><?php endif;?>
<?php if(isset($_GET['error_a'])):?><div class="alert alert-danger error">站点名称和地址不能为空</div><?php endif;?>
<?php if(isset($_GET['error_b'])):?><div class="alert alert-danger error">没有可排序的链接</div><?php endif;?>
		<div class="row">
			<div class="col-lg-8">
				<section class="panel panel-default">
					<header class="panel-heading font-bold"><i class="i i-link2 icon fa-fw"></i> 友情链接管理</header>
					<div class="panel-body">
						<form action="link.php?action=link_taxis" method="post">
							<table id="adm_link_list" class="table table-hover">
								<thead>
									<tr>
										<th width="5%"><b>序号</b></th>
										<th width="15%"><b>链接</b></th>
										<th width="5%" class="text-center"><b>状态</b></th>
										<th width="5%" class="text-center"><b>查看</b></th>
										<th width="25%"><b>描述</b></th>
										<th width="10%"></th>
									</tr>
								</thead>
								<tbody>
									<?php
										if($links):
										foreach($links as $key=>$value):
										doAction('adm_link_display');
									?>  
									<tr>
										<td><input class="form-control" name="link[<?php echo $value['id']; ?>]" value="<?php echo $value['taxis']; ?>" maxlength="4" style="width:40px;"/></td>
										<td><a href="link.php?action=mod_link&amp;linkid=<?php echo $value['id']; ?>" title="修改链接"><?php echo $value['sitename']; ?></a></td>
										<td class="text-center">
											<?php if ($value['hide'] == 'n'): ?>
											<a href="link.php?action=hide&amp;linkid=<?php echo $value['id']; ?>" title="点击隐藏链接" class="text-primary"><i class="fa fa-toggle-on"></i></a>
											<?php else: ?>
											<a href="link.php?action=show&amp;linkid=<?php echo $value['id']; ?>" title="点击显示链接" class="text-danger"><i class="fa fa-toggle-off"></i></a>
											<?php endif;?>
										</td>
										<td class="text-center">
											<a href="<?php echo $value['siteurl']; ?>" target="_blank" title="查看链接"><i class="fa fa-desktop"></i></a>
										</td>
										<td><?php echo $value['description']; ?></td>
										<td>
											<a href="link.php?action=mod_link&amp;linkid=<?php echo $value['id']; ?>" class="m-r-sm"><i class="fa fa-edit"></i></a>
											<a href="javascript: em_confirm(<?php echo $value['id']; ?>, 'link', '<?php echo LoginAuth::genToken(); ?>');"><i class="fa fa-recycle"></i></a>
										</td>
									</tr>
									<?php endforeach;else:?>
									<tr><td class="text-center" colspan="6">还没有添加链接</td></tr>
									<?php endif;?>
								</tbody>
							</table>
							<div class="form-group">
								<input type="submit" value="改变排序" class="btn btn-success" />
							</div>
						</form>
					</div>
				</section>
			</div>
			<div class="col-lg-4">
				<section class="panel panel-default">
					<header class="panel-heading font-bold" onclick="displayToggle('link_new', 2);"><i class="fa fa-link fa-fw"></i> 添加链接</header>
					<div class="panel-body" id="link_new">
						<form action="link.php?action=addlink" method="post" name="link" id="link">
							<div class="form-inline form-group">
								<label>序号：</label>
								<input maxlength="4" class="form-control" name="taxis" style="width:50px;"/>
							</div>
							<div class="line line-dashed b-b line-lg pull-in"></div>
							<div class="form-group">
								<label>名称：</label>
								<input maxlength="200" class="form-control" name="sitename" />
							</div>
							<div class="line line-dashed b-b line-lg pull-in"></div>
							<div class="form-group">
								<label>地址：</label>
								<input maxlength="200" class="form-control" name="siteurl" />
							</div>
							<div class="line line-dashed b-b line-lg pull-in"></div>
							<div class="form-group">
								<label>描述：</label>
								<textarea name="description" type="text" class="form-control" style="width:100%;height:60px;overflow:auto;"></textarea>
							</div>
							<div class="line line-dashed b-b line-lg pull-in"></div>
							<div class="form-group">
								<div class="col-sm-8 col-sm-offset-4">
									<input type="submit" name="" value="添加链接" class="btn btn-primary" />
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
$("#link_new").css('display', $.cookie('em_link_new') ? $.cookie('em_link_new') : 'none');
setTimeout(hideActived,2600);
$("#menu_link").addClass('active');
</script>
