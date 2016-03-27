<?php if(!defined('EMLOG_ROOT')) {exit('error!');}?>
<section class="vbox">
	<section class="scrollable wrapper">
<?php if(isset($_GET['error_a'])):?><div class="alert alert-danger error">标签不能为空</div><?php endif;?>
		<div class="row">
			<div class="col-lg-12">
				<section class="panel panel-default">
					<header class="panel-heading font-bold"><i class="fa fa-tags fa-fw"></i> 标签修改</header>
					<div class="panel-body">
						<form class="form-horizontal" method="post" action="tag.php?action=update_tag">
							<div class="form-group">
								<label class="col-sm-2 control-label">标签内容：</label>
								<div class="col-sm-10">
									<input size="40" value="<?php echo $tagname; ?>" name="tagname" class="form-control" />
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-4 col-sm-offset-2">
									<input type="hidden" value="<?php echo $tagid; ?>" name="tid" />
									<input type="submit" value="保 存" class="btn btn-primary" />
									<input type="button" value="取 消" class="btn btn-defaul" onclick="javascript: window.location='tag.php';"/>
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
$("#menu_tag").addClass('active');
</script>
