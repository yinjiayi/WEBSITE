<?php if(!defined('EMLOG_ROOT')) {exit('error!');}?>
<script>setTimeout(hideActived,2600);</script>
<section class="vbox">
	<section class="scrollable wrapper">
<?php if(isset($_GET['error_a'])):?><div class="alert alert-danger error">只支持zip压缩格式的插件包</div><?php endif;?>
<?php if(isset($_GET['error_b'])):?><div class="alert alert-danger error">上传失败，插件目录(content/plugins)不可写</div><?php endif;?>
<?php if(isset($_GET['error_c'])):?><div class="alert alert-danger error">空间不支持zip模块，请按照提示手动安装插件</div><?php endif;?>
<?php if(isset($_GET['error_d'])):?><div class="alert alert-danger error">请选择一个zip插件安装包</div><?php endif;?>
<?php if(isset($_GET['error_e'])):?><div class="alert alert-danger error">安装失败，插件安装包不符合标准</div><?php endif;?>
		<?php if(isset($_GET['error_c'])): ?>
		<div class="well">
		手动安装插件： <br />
		1、把解压后的插件文件夹上传到 content/plugins 目录下。<br />
		2、登录后台进入插件管理,插件管理里已经有了该插件，点击激活即可。<br />
		</div>
		<?php endif; ?>
		<div class="row">
			<div class="col-lg-12">
				<section class="panel panel-default">
					<header class="panel-heading font-bold"><i class="fa fa-cogs fa-fw"></i> Emlog 插件安装<span id="msg badge bg-primary"></span></header>
					<div class="panel-body">
						<form action="./plugin.php?action=upload_zip" method="post" enctype="multipart/form-data" >
							<div style="margin:50px 0px 50px 20px;">
								<input name="token" id="token" value="<?php echo LoginAuth::genToken(); ?>" type="hidden" />
								<input name="pluzip" type="file" />
								<input type="submit" value="上传安装" class="submit" /> （上传一个zip压缩格式的插件安装包）
							</div>
						</form>
						<div style="margin:10px 20px;">获取更多插件：<a href="store.php">应用中心&raquo;</a></div>
					</div>
				</section>
			</div>
		</div>
		<div class="footer text-center">欢迎使用 &copy; <a href="http://www.emlog.net" target="_blank">emlog</a><?php doAction('adm_footer');?></div>
	</section>
</section>
<script>
$("#menu_category_sys").addClass('active');
$("#menu_plug").addClass('active');
</script>