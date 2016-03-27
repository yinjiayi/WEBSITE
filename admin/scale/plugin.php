<?php if(!defined('EMLOG_ROOT')) {exit('error!');}?>

<section class="vbox">
	<header class="header bg-white b-b b-light"><p><i class="fa fa-plug"></i> 插件管理</p></header>
	<section class="scrollable wrapper">
		<?php if(isset($_GET['activate_install'])):?><div class="alert alert-info actived">插件上传成功，请激活使用</div><?php endif;?>
		<?php if(isset($_GET['active'])):?><div class="alert alert-info actived">插件激活成功</div><?php endif;?>
		<?php if(isset($_GET['activate_del'])):?><div class="alert alert-info actived">删除成功</div><?php endif;?>
		<?php if(isset($_GET['active_error'])):?><div class="alert alert-danger error">插件激活失败</div><?php endif;?>
		<?php if(isset($_GET['inactive'])):?><div class="alert alert-info actived">插件禁用成功</div><?php endif;?>
		<?php if(isset($_GET['error_a'])):?><div class="alert alert-danger error">删除失败，请检查插件文件权限</div><?php endif;?>
		<div class="row">
			<div class="col-lg-12">
				<section class="panel panel-default">
					<div class="panel-body">
						<div class="text-center p-lg">
							<h2>如果没有找到您需要的插件</h2>
							<span>您可以点击</span>
							<a href="./store.php" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> <span class="bold">应用中心</span></a>按钮
						</div>
					</div>
				</section>
			</div>
			<div class="col-lg-12">
				<section class="panel panel-default">
					<div class="panel-body">
						<div class="panel-group" id="version">
							<?php 
								if($plugins):
								$i = 0;
								foreach($plugins as $key=>$val):
									$plug_state = 'fa-toggle-off text-dark';
									$plug_action = 'active';
									$plug_state_des = '点击激活插件';
									if (in_array($key, $active_plugins)){
										$plug_state = 'fa-toggle-on text-info';
										$plug_action = 'inactive';
										$plug_state_des = '点击禁用插件';
									}
									$i++;
									if (TRUE === $val['Setting']) {
										$val['Name'] = "<a data-toggle=\"collapse\" href=\"#plugin{$i}\" class=\"faq-question\">{$val['Name']}</a><a href=\"./plugin.php?plugin={$val['Plugin']}\" title=\"点击设置插件\"><i class=\"fa fa-cogs\"></i></a>";
									}else{
										$val['Name'] = $val['Name'] = "<a data-toggle=\"collapse\" href=\"#plugin{$i}\" class=\"faq-question\">{$val['Name']}</a>";
									}
							?>	
							<div class="faq-item">
								<div class="row">
									<div class="col-md-6">
										<?php echo $val['Name']; ?>
										<?php if ($val['Author'] != ''):?>
											<?php if ($val['AuthorUrl'] != ''):?>
											<i class="fa fa-user"></i><small><strong><a href="<?php echo $val['AuthorUrl'];?>" class="text-info" target="_blank"> <?php echo $val['Author'];?></a></strong></small>
											<?php else:?>
											<i class="fa fa-user"></i><small><strong> <?php echo $val['Author'];?></strong></small>
											<?php endif;?>
										<?php endif;?>
									</div>
									<div class="col-md-4">
										<span class="small font-bold">版本：<?php echo $val['Version']; ?></span>
										<?php if ($val['ForEmlog'] != ''):?><div class="tag-list">适用于emlog：<?php echo $val['ForEmlog'];?></div><?php endif;?>
									</div>
									<div class="col-md-2 text-right">
										<a href="./plugin.php?action=<?php echo $plug_action;?>&plugin=<?php echo $key;?>&token=<?php echo LoginAuth::genToken(); ?>"><i class="fa <?php echo $plug_state; ?> fa-3x" title="<?php echo $plug_state_des; ?>" ></i></a>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
										<div id="plugin<?php echo $i; ?>" class="panel-collapse collapse faq-answer">
											<div class="panel-body">
												<p><?php echo $val['Description']; ?><?php if ($val['Url'] != ''):?><a href="<?php echo $val['Url'];?>" target="_blank">更多信息&raquo;</a><?php endif;?></p>
												<p class="text-right"><a href="javascript: em_confirm('<?php echo $key; ?>', 'plu', '<?php echo LoginAuth::genToken(); ?>');" class="btn btn-default">插件卸载</a></p>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="line line-dashed b-b line-lg pull-in"></div>
							<?php endforeach;else: ?>
							<div class="alert alert-danger">还没有安装插件</div>
							<?php endif;?>
						</div>
					</div>
					<div class="panel-body"><a class="btn btn-info" href="./plugin.php?action=install">安装插件</a></div>
				</section>
			</div>
		</div>
		<div class="footer text-center">欢迎使用 &copy; <a href="http://www.emlog.net" target="_blank">emlog</a><?php doAction('adm_footer');?></div>
	</section>
</section>
<script>
$("#adm_plugin_list tbody tr:odd").addClass("tralt_b");
$("#adm_plugin_list tbody tr")
	.mouseover(function(){$(this).addClass("trover")})
	.mouseout(function(){$(this).removeClass("trover")})
setTimeout(hideActived,2600);
$("#menu_category_sys").addClass('active');
$("#menu_plug").addClass('active');
</script>
