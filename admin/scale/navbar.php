<?php if(!defined('EMLOG_ROOT')) {exit('error!');} ?>
<section class="vbox">
	<section class="scrollable wrapper">
	<?php if(isset($_GET['active_taxis'])):?><div class="alert alert-info actived">排序更新成功</div><?php endif;?>
<?php if(isset($_GET['active_del'])):?><div class="alert alert-info actived">删除导航成功</div><?php endif;?>
<?php if(isset($_GET['active_edit'])):?><div class="alert alert-info actived">修改导航成功</div><?php endif;?>
<?php if(isset($_GET['active_add'])):?><div class="alert alert-info actived">添加导航成功</div><?php endif;?>
<?php if(isset($_GET['error_a'])):?><div class="alert alert-danger error">导航名称和地址不能为空</div><?php endif;?>
<?php if(isset($_GET['error_b'])):?><div class="alert alert-danger error">没有可排序的导航</div><?php endif;?>
<?php if(isset($_GET['error_c'])):?><div class="alert alert-danger error">默认导航不能删除</div><?php endif;?>
<?php if(isset($_GET['error_d'])):?><div class="alert alert-danger error">请选择要添加的分类</div><?php endif;?>
<?php if(isset($_GET['error_e'])):?><div class="alert alert-danger error">请选择要添加的页面</div><?php endif;?>
<?php if(isset($_GET['error_f'])):?><div class="alert alert-danger error">导航地址格式错误(需包含http等前缀)</div><?php endif;?>
		<div class="row">
			<div class="col-lg-8">
				<section class="panel panel-default">
					<header class="panel-heading font-bold">
						<ul class="nav nav-tabs">
							<li class="active"><a>导航管理</a></li>
						</ul>
					</header>
					<form action="navbar.php?action=taxis" method="post">
						<table id="adm_navi_list" class="table table-hover">
							<thead>
								<tr>
									<th width="50"><b>序号</b></th>
									<th width="230"><b>导航</b></th>
									<th width="100" class="text-center"><b>类型</b></th>
									<th width="360"><b>地址</b></th>
									<th width="20" class="text-center"></th>
									<th width="20" class="text-center"></th>
									<th width="90"></th>
								</tr>
							</thead>
							<tbody>
							<?php 
								if($navis):
									foreach($navis as $key=>$value):
										if ($value['pid'] != 0) {
											continue;
										}
										$value['type_name'] = '';
										switch ($value['type']) {
											case Navi_Model::navitype_home:
											case Navi_Model::navitype_t:
											case Navi_Model::navitype_admin:
												$value['type_name'] = '系统';
												break;
											case Navi_Model::navitype_sort:
												$value['type_name'] = '<font color="blue">分类</font>';
												break;
											case Navi_Model::navitype_page:
												$value['type_name'] = '<font color="#00A3A3">页面</font>';
												break;
											case Navi_Model::navitype_custom:
												$value['type_name'] = '<font color="#FF6633">自定</font>';
												break;
										}
									doAction('adm_navi_display');
							?>  
								<tr>
									<td><input class="form-control" name="navi[<?php echo $value['id']; ?>]" value="<?php echo $value['taxis']; ?>" maxlength="4" style="width:40px;"/></td>
									<td><a href="navbar.php?action=mod&amp;navid=<?php echo $value['id']; ?>" title="编辑导航"><?php echo $value['naviname']; ?></a></td>
									<td class="text-center"><?php echo $value['type_name'];?></td>
									<td><?php echo $value['url']; ?></td>
									<td class="text-center">
										<?php if ($value['hide'] == 'n'): ?>
										<a href="navbar.php?action=hide&amp;id=<?php echo $value['id']; ?>" title="点击隐藏导航"><i class="fa fa-toggle-on"></i></a>
										<?php else: ?>
										<a href="navbar.php?action=show&amp;id=<?php echo $value['id']; ?>" title="点击显示导航" style="color:red;"><i class="fa fa-toggle-off"></i></a>
										<?php endif;?>
									</td>
									<td class="text-center"><a href="<?php echo $value['url']; ?>" target="_blank"><i class="<?php echo $value['newtab'] == 'y' ? 'i i-laptop icon' : 'fa fa-desktop';?>"></i></a></td>
									<td>
										<a href="navbar.php?action=mod&amp;navid=<?php echo $value['id']; ?>" title="导航修改"><i class="fa fa-edit"></i></a>
										<?php if($value['isdefault'] == 'n'):?>
										<a href="javascript: em_confirm(<?php echo $value['id']; ?>, 'navi', '<?php echo LoginAuth::genToken(); ?>');" title="删除导航"><i class="fa fa-recycle"></i></a>
										<?php endif;?>
									</td>
								</tr>
								<?php
									if(!empty($value['childnavi'])):
									foreach ($value['childnavi'] as $val):
								?>
								<tr>
									<td><input class="form-control" name="navi[<?php echo $val['id']; ?>]" value="<?php echo $val['taxis']; ?>" maxlength="4" style="width:40px;"/></td>
									<td>---- <a href="navbar.php?action=mod&amp;navid=<?php echo $val['id']; ?>" title="编辑导航"><?php echo $val['naviname']; ?></a></td>
									<td class="text-center"><?php echo $value['type_name'];?></td>
									<td><?php echo $val['url']; ?></td>
									<td class="text-center">
										<?php if ($val['hide'] == 'n'): ?>
										<a href="navbar.php?action=hide&amp;id=<?php echo $val['id']; ?>" title="点击隐藏导航"><i class="fa fa-toggle-on"></i></a>
										<?php else: ?>
										<a href="navbar.php?action=show&amp;id=<?php echo $val['id']; ?>" title="点击显示导航" style="color:red;"><i class="fa fa-toggle-off"></i></a>
										<?php endif;?>
									</td>
									<td class="text-center"><a href="<?php echo $val['url']; ?>" target="_blank"><i class="<?php echo $val['newtab'] == 'y' ? 'i i-laptop icon' : 'fa fa-desktop';?>"></i></a></td>
									<td>
										<a href="navbar.php?action=mod&amp;navid=<?php echo $val['id']; ?>" title="导航修改"><i class="fa fa-edit"></i></a>
										<?php if($val['isdefault'] == 'n'):?>
										<a href="javascript: em_confirm(<?php echo $val['id']; ?>, 'navi', '<?php echo LoginAuth::genToken(); ?>');" title="删除导航"><i class="fa fa-recycle"></i></a>
										<?php endif;?>
									</td>
								</tr>
								<?php endforeach;endif; ?>
								<?php endforeach;else:?>
								<tr><td class="text-center" colspan="4">还没有添加导航</td></tr>
								<?php endif;?>
								</tbody>
							</table>
						</form>
						<div class="list_footer"><input type="submit" value="改变排序" class="btn btn-info" /></div>
				</section>
			</div>
			<div class="col-lg-4">
				<div class="row">
					<div class="col-lg-12">
						<section class="panel panel-default">
							<header class="panel-heading font-bold" onclick="displayToggle('navi_add_custom', 2);"><i class="fa fa-"></i>添加自定义导航</header>
							<div class="panel-body" id="navi_add_custom">
								<form class="form-horizontal" action="navbar.php?action=add" method="post" name="navi" id="navi">
									<div class="form-group">
										<label class="col-sm-4 control-label">序号：</label>
										<div class="col-sm-8">
											<input maxlength="4" class="form-control" name="taxis" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-4 control-label">导航名称*：</label>
										<div class="col-sm-8">
											<input maxlength="200" class="form-control" name="naviname" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-4 control-label">地址：</label>
										<div class="col-sm-8">
											<span class="help-block m-b-none">带http*</span>
											<input maxlength="200" class="form-control" name="url" id="url" />
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-4 control-label">父导航</label>
										<div class="col-sm-8">
											<select name="pid" id="pid" class="form-control m-b">
												<option value="0">无</option>
												<?php
													foreach($navis as $key=>$value):
														if($value['type'] != Navi_Model::navitype_custom || $value['pid'] != 0) {
															continue;
														}
												?>
												<option value="<?php echo $value['id']; ?>"><?php echo $value['naviname']; ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-4 control-label"></label>
										<div class="col-sm-8">
											<div class="checkbox i-checks">
												<label>
													<input type="checkbox" style="vertical-align:middle;" value="y" name="newtab" /><i></i>在新窗口打开
												</label>
											</div>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-4 control-label"></label>
										<div class="col-sm-8">
											<input type="submit" name="" value="添加" class="btn btn-primary" />
										</div>
									</div>
								</form>
							</div>
						</section>
					</div>
					<div class="col-lg-12">
						<section class="panel panel-default">
							<header class="panel-heading font-bold" onclick="displayToggle('navi_add_sort', 2);"><i class="fa fa-"></i>添加分类到导航</header>
							<div class="panel-body" id="navi_add_sort">
								<form class="form-horizontal" action="navbar.php?action=add_sort" method="post" name="navi" id="navi">
									<div class="form-group">
									<?php
										if($sorts):
										foreach($sorts as $key=>$value):
										if ($value['pid'] != 0) {
											continue;
										}
									?>
										<div class="col-sm-6">
											<div class="checkbox i-checks">
												<label>
													<input type="checkbox" style="vertical-align:middle;" name="sort_ids[]" value="<?php echo $value['sid']; ?>" /><i></i><?php echo $value['sortname']; ?>
												</label>
											</div>
										</div>
									<?php
										$children = $value['children'];
										foreach ($children as $key):
										$value = $sorts[$key];
									?>
										<div class="col-sm-6">
											<div class="checkbox i-checks">
												<label>
													<input type="checkbox" style="vertical-align:middle;" name="sort_ids[]" value="<?php echo $value['sid']; ?>" /><i></i><?php echo $value['sortname']; ?>
												</label>
											</div>
										</div>
									<?php
										endforeach;
										endforeach;
									?>
									<?php endif;?>
									</div>
									<div class="form-group">
										<?php if($sorts):?>
										<div class="col-sm-12">
											<input type="submit" name="" value="添加分类导航" class="btn btn-rounded  btn-block btn-primary" />
										</div>
										<?php else:?>
										<div class="alert alert-danger"><i class="fa fa-exclamation-triangle text-danger fa-fw"></i> 还没有分类，<a href="sort.php">新建分类</a></div>
										<?php endif;?>
									</div>
								</form>
							</div>
						</section>
					</div>
					
					<div class="col-lg-12">
						<section class="panel panel-default">
							<header class="panel-heading font-bold" onclick="displayToggle('navi_add_page', 2);"><i class="fa fa-"></i>添加页面到导航</header>
							<div class="panel-body" id="navi_add_page">
								<form class="form-horizontal" action="navbar.php?action=add_page" method="post" name="navi" id="navi">
									<div class="form-group">
										<?php
											if($pages):
											foreach($pages as $key=>$value): 
										?>
										<div class="col-sm-6">
											<div class="checkbox i-checks">
												<label>
													<input type="checkbox" style="vertical-align:middle;" name="pages[<?php echo $value['gid']; ?>]" value="<?php echo $value['title']; ?>" /><i></i><?php echo $value['title']; ?>
												</label>
											</div>
										</div>
										<?php endforeach;?>
										<?php endif;?>
									</div>
									<div class="form-group">
										<?php if($pages):?>
										<div class="col-sm-12">
											<input type="submit" name="" value="添加页面至导航" class="btn btn-rounded  btn-block btn-primary" />
										</div>
										<?php else:?>
										<div class="alert alert-danger"><i class="fa fa-exclamation-triangle text-danger fa-fw"></i> 还没页面，<a href="page.php">新建页面</a></div>
										<?php endif;?>
									</div>
								</form>
							</div>
						</section>
					</div>
				</div>
			</div>
		</div>
		<div class="footer text-center">欢迎使用 &copy; <a href="http://www.emlog.net" target="_blank">emlog</a><?php doAction('adm_footer');?></div>
	</section>
</section>
<script>
$("#navi_add_custom").css('display', $.cookie('em_navi_add_custom') ? $.cookie('em_navi_add_custom') : '');
$("#navi_add_sort").css('display', $.cookie('em_navi_add_sort') ? $.cookie('em_navi_add_sort') : '');
$("#navi_add_page").css('display', $.cookie('em_navi_add_page') ? $.cookie('em_navi_add_page') : '');
$(document).ready(function(){
	$("#adm_navi_list tbody tr:odd").addClass("tralt_b");
	$("#adm_navi_list tbody tr")
		.mouseover(function(){$(this).addClass("trover")})
		.mouseout(function(){$(this).removeClass("trover")})
});
setTimeout(hideActived,2600);
$("#menu_category_view").addClass('active');
$("#menu_navbar").addClass('active');
</script>
