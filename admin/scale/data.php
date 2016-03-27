<?php if(!defined('EMLOG_ROOT')) {exit('error!');} ?>
<section class="vbox">
	<section class="scrollable wrapper">
<?php if(isset($_GET['active_del'])):?><div class="alert alert-info actived">备份文件删除成功</div><?php endif;?>
<?php if(isset($_GET['active_backup'])):?><div class="alert alert-info actived">数据备份成功</div><?php endif;?>
<?php if(isset($_GET['active_import'])):?><div class="alert alert-info actived">备份导入成功</div><?php endif;?>
<?php if(isset($_GET['error_a'])):?><div class="alert alert-danger error">请选择要删除的备份文件</div><?php endif;?>
<?php if(isset($_GET['error_b'])):?><div class="alert alert-danger error">备份文件名错误(应由英文字母、数字、下划线组成)</div><?php endif;?>
<?php if(isset($_GET['error_c'])):?><div class="alert alert-danger error">服务器空间不支持zip，无法导入zip备份</div><?php endif;?>
<?php if(isset($_GET['error_d'])):?><div class="alert alert-danger error">上传备份失败</div><?php endif;?>
<?php if(isset($_GET['error_e'])):?><div class="alert alert-danger error">错误的备份文件</div><?php endif;?>
<?php if(isset($_GET['error_f'])):?><div class="alert alert-danger error">服务器空间不支持zip，无法导出zip备份</div><?php endif;?>
<?php if(isset($_GET['active_mc'])):?><div class="alert alert-info actived">缓存更新成功</div><?php endif;?>
		<div class="row">
			<div class="col-lg-8">
				<section class="panel panel-default">
					<header class="panel-heading font-bold"><i class="i i-data fa-fw"></i> 数据库备份</header>
					<div class="panel-body">
						<form method="post" action="data.php?action=dell_all_bak" name="form_bak" id="form_bak">
							<table id="adm_bakdata_list" class="table table-hover">
								<thead>
									<tr>
										<th width="5%"></th>
										<th width="25"><b>备份文件</b></th>
										<th width="25%"><b>备份时间</b></th>
										<th width="25%"><b>文件大小</b></th>
										<th width="10%"></th>
									</tr>
								</thead>
								<tbody>
									<?php
										if($bakfiles):
										foreach($bakfiles  as $value):
										$modtime = smartDate(filemtime($value),'Y-m-d H:i:s');
										$size =  changeFileSize(filesize($value));
										$bakname = substr(strrchr($value,'/'),1);
									?>
									<tr>
										<td><label class="checkbox i-checks" style="margin-top:0px;margin-bottom:0px;"><input type="checkbox" value="<?php echo $value; ?>" name="bak[]" class="ids"><i></i></label></td>
										<td><a href="../content/backup/<?php echo $bakname; ?>"><?php echo $bakname; ?></a></td>
										<td><?php echo $modtime; ?></td>
										<td><?php echo $size; ?></td>
										<td><a href="javascript: em_confirm('<?php echo $value; ?>', 'backup', '<?php echo LoginAuth::genToken(); ?>');">导入</a></td>
									</tr>
									<?php endforeach;else:?>
									<tr><td class="text-center" colspan="5">还没有备份</td></tr>
									<?php endif;?>
								</tbody>
							</table>
							<div class="form-group">
								<a href="javascript:void(0);" id="select_all" class="btn btn-default m-r-md">全选</a><a href="javascript:bakact('del');" class="btn btn-default">删除</a>
							</div>
						</form>
					</div>
				</section>
			</div>
			<div class="col-lg-4">
				<div class="row">
					<div class="col-lg-12">
						<section class="panel panel-default">
							<header class="panel-heading font-bold" onclick="displayToggle('backup', 2);"><i class="i i-data fa-fw"></i> 备份数据库</header>
							<div class="panel-body" id="backup">
								<form action="data.php?action=bakstart" method="post">
									<div class="form-group">
										<label>可备份的数据库表：</label>
										<select multiple="multiple" size="12" name="table_box[]" class="form-control">
											<?php foreach($tables  as $value): ?>
											<option value="<?php echo DB_PREFIX; ?><?php echo $value; ?>" selected="selected"><?php echo DB_PREFIX; ?><?php echo $value; ?></option>
											<?php endforeach; ?>
										</select>
									</div>
									<div class="form-group">
										<label>将站点内容数据库备份到：</label>
										<select name="bakplace" id="bakplace" class="form-control">
											<option value="local" selected="selected">本地（自己电脑）</option>
											<option value="server">服务器空间</option>
										</select>
									</div>
									<div class="form-inline form-group m-l-sm" id="local_bakzip">
										<div class="checkbox i-checks">
											<label>
												<input type="checkbox" style="vertical-align:middle;" value="y" name="zipbak" id="zipbak"><i></i>压缩成zip包
											</label>
										</div>
									</div>
									<div class="form-group">
										<input name="token" id="token" value="<?php echo LoginAuth::genToken(); ?>" type="hidden" />
										<input type="submit" value="开始备份" class="btn btn-rounded  btn-block btn-primary" />
									</div>
								</form>
							</div>
						</section>
					</div>
					<div class="col-lg-12">
						<section class="panel panel-default">
							<header class="panel-heading font-bold" onclick="displayToggle('import', 2);"><i class="fa fa-terminal fa-fw"></i> 导入本地备份</header>
							<div class="panel-body" id="import">
								<form action="data.php?action=import" enctype="multipart/form-data" method="post">
									<section class="panel vertical_border blue_border">
										<div class="panel-body">仅可导入相同版本emlog导出的数据库备份文件，且数据库表前缀需保持一致。<br />当前数据库表前缀：<?php echo DB_PREFIX; ?></div>
									</section>
									<div class="form-group">
										<input type="file" name="sqlfile" />
									</div>
									<div class="form-group">
										<input name="token" id="token" value="<?php echo LoginAuth::genToken(); ?>" type="hidden" />
										<input type="submit" value="导入" class="btn btn-rounded  btn-block btn-primary" />
									</div>
								</form>
							</div>
						</section>
					</div>
					<div class="col-lg-12">
						<section class="panel panel-default">
							<header class="panel-heading font-bold" onclick="displayToggle('cache', 2);"><i class="fa fa-refresh fa-spin fa-fw margin-bottom"></i> 更新缓存</header>
							<div class="panel-body" id="cache">
								<section class="panel vertical_border blue_border">
									<div class="panel-body">
									缓存可以加快站点的加载速度。通常系统会自动更新缓存，无需手动。有些特殊情况，比如缓存文件被修改、手动修改过数据库、页面出现异常等才需要手动更新.
									</div>
								</section>
								<p><input type="button" onclick="window.location='data.php?action=Cache';" value="更新缓存" class="btn btn-success" /></p>
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
$("#backup").css('display', $.cookie('em_backup') ? $.cookie('em_backup') : '');
$("#import").css('display', $.cookie('em_import') ? $.cookie('em_import') : '');
$("#cache").css('display', $.cookie('em_cache') ? $.cookie('em_cache') : '');
setTimeout(hideActived,2600);
$(document).ready(function(){
	selectAllToggle();
	$("#bakplace").change(function(){$("#server_bakfname").toggle();$("#local_bakzip").toggle();});
});
function bakact(act){
	if (getChecked('ids') == false) {
		alert('请选择要操作的备份文件');
		return;
	}
	if(act == 'del' && !confirm('你确定要删除所选备份文件吗？')){return;}
	$("#operate").val(act);
	$("#form_bak").submit();
}
$("#menu_category_sys").addClass('active');
$("#menu_data").addClass('active');
</script>
