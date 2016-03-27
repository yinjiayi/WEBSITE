<?php if(!defined('EMLOG_ROOT')) {exit('error!');} ?>
<script>setTimeout(hideActived,2600);</script>
<section class="vbox">
	<section class="scrollable wrapper">
	<?php if(isset($_GET['active_taxis'])):?><div class="alert alert-info actived">排序更新成功</div><?php endif;?>
	<?php if(isset($_GET['active_del'])):?><div class="alert alert-info actived">删除分类成功</div><?php endif;?>
	<?php if(isset($_GET['active_edit'])):?><div class="alert alert-info actived">修改分类成功</div><?php endif;?>
	<?php if(isset($_GET['active_add'])):?><div class="alert alert-info actived">添加分类成功</div><?php endif;?>
	<?php if(isset($_GET['error_a'])):?><div class="alert alert-danger error">分类名称不能为空</div><?php endif;?>
	<?php if(isset($_GET['error_b'])):?><div class="alert alert-danger error">没有可排序的分类</div><?php endif;?>
	<?php if(isset($_GET['error_c'])):?><div class="alert alert-danger error">别名格式错误</div><?php endif;?>
	<?php if(isset($_GET['error_d'])):?><div class="alert alert-danger error">别名不能重复</div><?php endif;?>
	<?php if(isset($_GET['error_e'])):?><div class="alert alert-danger error">别名不得包含系统保留关键字</div><?php endif;?>
		<div class="row">
			<div class="col-lg-4">
				<section>
					<header class="panel-heading font-bold">分类管理</header>
					<div class="panel-body">
						<form class="form-horizontal" action="sort.php?action=add" method="post">
							<div class="form-group">
								<label class="col-sm-4 control-label">序号：</label>
								<div class="col-sm-8">
									<input maxlength="4" class="form-control" name="taxis" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label">名称*：</label>
								<div class="col-sm-8">
									<input maxlength="200" class="form-control" name="sortname" id="sortname" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label">别名 (用于URL的友好显示)：</label>
								<div class="col-sm-8">
									<input maxlength="200" class="form-control" name="alias" id="alias" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label">父分类：</label>
								<div class="col-sm-8">
									<select name="pid" id="pid" class="form-control m-b">
										<option value="0">无</option>
										<?php
											foreach($sorts as $key=>$value):
											if($value['pid'] != 0) {
												continue;
											}
										?>
										<option value="<?php echo $key; ?>"><?php echo $value['sortname']; ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label">模板：</label>
								<div class="col-sm-8">
									<input maxlength="200" class="form-control" name="template" id="template" value="log_list" />
									<span class="help-block m-b-none">用于自定义分类页面模板，对应模板目录下.php文件，默认为log_list.php</span>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label">分类描述：</label>
								<div class="col-sm-8">
									<textarea name="description" type="text" style="width:100%;height:60px;overflow:auto;" class="form-control"></textarea>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-4 control-label"></label>
								<div class="col-sm-8">
									<input name="token" id="token" value="<?php echo LoginAuth::genToken(); ?>" type="hidden" />
									<input type="submit" id="addsort" value="添加新分类" class="btn btn-primary"/>
									<span id="alias_msg_hook"></span>
								</div>
							</div>
						</form>
					</div>
				</section>
			</div>
			<div class="col-lg-8">
				<section class="panel panel-default">
					<header class="panel-heading font-bold">分类列表</header>
					<form  method="post" action="sort.php?action=taxis">
						<table id="adm_sort_list" class="table table-hover">
							<thead>
								<tr>
									<th width="10%"><b>序号</b></th>
									<th width="20%"><b>名称</b></th>
									<th width="20%"><b>描述</b></th>
									<th width="10%"><b>别名</b></th>
									<th width="10%"><b>模板</b></th>
									<th width="10%" class="text-center"><b>查看</b></th>
									<th width="10%" class="text-center"><b>文章</b></th>
									<th width="10%"></th>
								</tr>
							</thead>
							<tbody>
								<?php
									if($sorts):
										foreach($sorts as $key=>$value):
											if ($value['pid'] != 0) {
												continue;
											}
								?>
								<tr>
									<td>
										<input type="hidden" value="<?php echo $value['sid'];?>" class="sort_id" />
										<input maxlength="4" class="form-control" name="sort[<?php echo $value['sid']; ?>]" value="<?php echo $value['taxis']; ?>" style="width:45px;"/>
									</td>
									<td><a href="sort.php?action=mod_sort&sid=<?php echo $value['sid']; ?>"><?php echo $value['sortname']; ?></a></td>
									<td><?php echo $value['description']; ?></td>
									<td><?php echo $value['alias']; ?></td>
									<td><?php echo $value['template']; ?></td>
									<td class="text-center"><a href="<?php echo Url::sort($value['sid']); ?>" target="_blank"><i class="fa fa-desktop"></i></a></td>
									<td class="text-center"><a href="./admin_log.php?sid=<?php echo $value['sid']; ?>"><?php echo $value['lognum']; ?></a></td>
									<td>
										<a href="sort.php?action=mod_sort&sid=<?php echo $value['sid']; ?>"><i class="fa fa-edit"></i></a>
										<a href="javascript: em_confirm(<?php echo $value['sid']; ?>, 'sort', '<?php echo LoginAuth::genToken(); ?>');"><i class="fa fa-recycle"></i></a>
									</td>
								</tr>
								<?php
									$children = $value['children'];
									foreach ($children as $key):
									$value = $sorts[$key];
								?>
								<tr>
									<td>
										<input type="hidden" value="<?php echo $value['sid'];?>" class="sort_id" />
										<input maxlength="4" class="form-control" name="sort[<?php echo $value['sid']; ?>]" value="<?php echo $value['taxis']; ?>" style="width:45px;"/>
									</td>
									<td>---- <a href="sort.php?action=mod_sort&sid=<?php echo $value['sid']; ?>"><?php echo $value['sortname']; ?></a></td>
									<td><?php echo $value['description']; ?></td>
									<td><?php echo $value['alias']; ?></td>
									<td><?php echo $value['template']; ?></td>
									<td class="text-center"><a href="<?php echo Url::sort($value['sid']); ?>" target="_blank"><i class="fa fa-desktop"></i></a></td>
									<td class="text-center"><a href="./admin_log.php?sid=<?php echo $value['sid']; ?>"><?php echo $value['lognum']; ?></a></td>
									<td>
										<a href="sort.php?action=mod_sort&sid=<?php echo $value['sid']; ?>"><i class="fa fa-edit"></i></a>
										<a href="javascript: em_confirm(<?php echo $value['sid']; ?>, 'sort', '<?php echo LoginAuth::genToken(); ?>');"><i class="fa fa-recycle"></i></a>
									</td>
								</tr>
								<?php endforeach; ?>
								<?php endforeach;else:?>
								<tr><td class="text-center" colspan="8">还没有添加分类</td></tr>
								<?php endif;?> 
							</tbody>
						</table>
					<div class="list_footer"><input type="submit" value="改变排序" class="btn btn-info" /></div>
					</form>
				</section>
			</div>
		</div>
		<div class="footer text-center">欢迎使用 &copy; <a href="http://www.emlog.net" target="_blank">emlog</a><?php doAction('adm_footer');?></div>
	</section>
</section>
<script>
$("#sort_new").css('display', $.cookie('em_sort_new') ? $.cookie('em_sort_new') : 'none');
$("#alias").keyup(function(){checksortalias();});
function issortalias(a){
	var reg1=/^[\w-]*$/;
	var reg2=/^[\d]+$/;
	if(!reg1.test(a)) {
		return 1;
	}else if(reg2.test(a)){
		return 2;
	}else if(a=='post' || a=='record' || a=='sort' || a=='tag' || a=='author' || a=='page'){
		return 3;
	} else {
		return 0;
	}
}
function checksortalias(){
	var a = $.trim($("#alias").val());
	if (1 == issortalias(a)){
		$("#addsort").attr("disabled", "disabled");
		$("#alias_msg_hook").html('<span id="input_error">别名错误，应由字母、数字、下划线、短横线组成</span>');
	}else if (2 == issortalias(a)){
		$("#addsort").attr("disabled", "disabled");
		$("#alias_msg_hook").html('<span id="input_error">别名错误，不能为纯数字</span>');
	}else if (3 == issortalias(a)){
		$("#addsort").attr("disabled", "disabled");
		$("#alias_msg_hook").html('<span id="input_error">别名错误，与系统链接冲突</span>');
	}else {
		$("#alias_msg_hook").html('');
		$("#msg").html('');
		$("#addsort").attr("disabled", false);
	}
}
$(document).ready(function(){
	$("#adm_sort_list tbody tr:odd").addClass("tralt_b");
	$("#adm_sort_list tbody tr")
	.mouseover(function(){$(this).addClass("trover")})
	.mouseout(function(){$(this).removeClass("trover")});
	$("#menu_sort").addClass('active');
});
</script>
