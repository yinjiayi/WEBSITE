<?php if(!defined('EMLOG_ROOT')) {exit('error!');}?>
<section class="vbox">
	<section class="scrollable wrapper">
		<div class="row">
			<div class="col-lg-12">
				<section class="panel panel-default">
					<header class="panel-heading font-bold"><i class="fa fa-align-justify fa-fw"></i> 修改导航</header>
					<div class="panel-body">
						<form class="form-horizontal" action="navbar.php?action=update" method="post">
							<div class="form-group">
								<label class="col-sm-2 control-label">导航名称：</label>
								<div class="col-sm-10">
									<input size="20" value="<?php echo $naviname; ?>" name="naviname" class="form-control">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">导航地址：</label>
								<div class="col-sm-10">
									<input size="50" value="<?php echo $url; ?>" name="url" class="form-control" <?php echo $conf_isdefault; ?> />
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label"></label>
								<div class="col-sm-10">
									<div class="checkbox i-checks">
										<label>
											<input type="checkbox" style="vertical-align:middle;" value="y" name="newtab" <?php echo $conf_newtab; ?> /><i></i>在新窗口打开
										</label>
									</div>
								</div>
							</div>
							<?php if ($type == Navi_Model::navitype_custom && $pid != 0): ?>
							<div class="form-group">
								<label class="col-sm-2 control-label">父导航：</label>
								<div class="col-sm-10">
									<select name="pid" id="pid" class="form-control m-b">
										<option value="0">无</option>
										<?php
											foreach($navis as $key=>$value):
												if($value['type'] != Navi_Model::navitype_custom || $value['pid'] != 0) {
													continue;
												}
												$flg = $value['id'] == $pid ? 'selected' : '';
										?>
										<option value="<?php echo $value['id']; ?>" <?php echo $flg;?>><?php echo $value['naviname']; ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>
							<?php endif; ?>
							<div class="form-group">
								<div class="col-sm-4 col-sm-offset-2">
									<input type="hidden" value="<?php echo $naviId; ?>" name="navid" />
									<input type="hidden" value="<?php echo $isdefault; ?>" name="isdefault" />
									<input type="submit" value="保 存" class="btn btn-primary" />
									<input type="button" value="取 消" class="btn btn-default" onclick="javascript: window.history.back();" />
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
$("#menu_category_view").addClass('active');
$("#menu_navbar").addClass('active');
</script>
