<?php if(!defined('EMLOG_ROOT')) {exit('error!');}?>
<section class="vbox">
	<section class="scrollable wrapper">
		<form action="page.php?action=add" method="post" enctype="multipart/form-data" id="addlog" name="addlog">
			<div class="row">
				<div class="col-lg-8">
					<section class="panel panel-default">
						<header class="panel-heading font-bold"><i class="fa fa-edit fa-fw"></i> 新建页面<span id="msg_2" class="badge bg-primary"></span><span id="msg" class="badge bg-primary"></span>
							<ul class="nav nav-pills pull-right">
								<li>
									<a href="#" class="panel-toggle text-muted">
										<i class="i i-plus text-active"></i>
										<i class="i i-minus text"></i>
									</a>
								</li>
							</ul>
						</header>
						<div class="panel-body">
							<div class="form-group">
								<input type="text" maxlength="200" name="title" id="title" class="form-control" placeholder="输入页面标题">
								<input name="date" id="date" type="hidden" value="" >
							</div>
							<span onclick="displayToggle('FrameUpload', 0);autosave(4);" class="show_advset">上传插入<i class="i i-minus"></i></span>
							<div id="post_bar">
								<div>
									<?php doAction('adm_writelog_head'); ?>
									<span id="asmsg"></span>
									<input type="hidden" name="as_logid" id="as_logid" value="-1">
								</div>
								<div id="FrameUpload" style="display: none;">
									<iframe style="width:100%;height:330px;" frameborder="0" src="attachment.php?action=selectFile"></iframe>
								</div>
							</div>
							<div class="form-group">
								<textarea id="content" name="content" class="form-control" style="width:100%; height:360px;"></textarea>
							</div>
						</div>
					</section>
				</div>
				<div class="col-lg-4">
					<section class="panel panel-default">
						<header class="panel-heading font-bold"><i class="fa fa-cog fa-fw"></i> 页面设置项
							<ul class="nav nav-pills pull-right">
								<li>
									<a href="#" class="panel-toggle text-muted">
										<i class="i i-plus text-active"></i>
										<i class="i i-minus text"></i>
									</a>
								</li>
							</ul>
						</header>
						<div class="panel-body">
							<div class="form-group">
								<label>链接别名：</label>
								<input name="alias" id="alias" class="form-control" />
								<span class="help-block m-b-none">用于自定义该页面的链接地址。需要<a href="./seo.php" target="_blank">启用链接别名</a></span>
							</div>
							<div class="form-group">
								<label>页面模板：</label>
								<input maxlength="200" class="form-control" name="template" id="template" value="page" />
								<span class="help-block m-b-none">用于自定义页面模板，对应模板目录下.php文件</span>
							</div>
							<div class="form-group">
								<label class="checkbox-inline checkbox m-n i-checks"><input type="checkbox" value="y" name="allow_remark" id="allow_remark" ><i></i>页面接受评论</label>
							</div>
							<div class="text-center">
								<input name="token" id="token" value="<?php echo LoginAuth::genToken(); ?>" type="hidden" />
								<input type="hidden" name="ishide" id="ishide" value="">
								<input type="submit" value="发布页面" onclick="return checkform();" class="btn btn-primary" />
								<input type="button" name="savedf" id="savedf" value="保存" onclick="autosave(3);" class="btn btn-success" />
							</div>
						</div>
					</section>
				</div>
			</div>
		</form>
		<div class="footer text-center">欢迎使用 &copy; <a href="http://www.emlog.net" target="_blank">emlog</a><?php doAction('adm_footer');?></div>
	</section>
</section>
<script charset="utf-8" src="./editor/kindeditor.js?v=<?php echo Option::EMLOG_VERSION; ?>"></script>
<script charset="utf-8" src="./editor/lang/zh_CN.js?v=<?php echo Option::EMLOG_VERSION; ?>"></script>
<script>
loadEditor('content');
$("#menu_page").addClass('active');
$("#alias").keyup(function(){checkalias();});
</script>
