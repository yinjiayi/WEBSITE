<?php if(!defined('EMLOG_ROOT')) {exit('error!');}?>
<script>setTimeout(hideActived,2600);</script>
<section class="vbox">
	<section class="scrollable wrapper">
<?php if(isset($_GET['activated'])):?><div class="alert alert-info actived">设置保存成功</div><?php endif;?>
<?php if(isset($_GET['error'])):?><div class="alert alert-danger error">保存失败：根目录下的.htaccess不可写</div><?php endif;?>
		<div class="row">
			<div class="col-lg-12">
				<section class="panel panel-default">
					<header class="panel-heading font-bold">
						<ul class="nav nav-tabs">
							<li class=""><a href="./configure.php">基本设置</a></li>
							<li class="active"><a href="./seo.php">SEO设置</a></li>
							<li class=""><a href="./blogger.php">个人设置</a></li>
                      </ul>
					</header>
					<div class="panel-body">
						<section class="panel vertical_border blue_border">
							<div class="panel-body">你可以在这里修改文章链接的形式，如果修改后文章无法访问，那可能是你的服务器空间不支持URL重写，请修改回默认形式、关闭文章连接别名。<br />启用链接别名后可以自定义文章和页面的链接地址。</div>
						</section>
						<form class="form-horizontal" action="seo.php?action=update" method="post">
							<div class="form-group">
								<label class="col-sm-2 control-label">文章链接设置：</label>
								<div class="col-sm-10">
									<div class="radio i-checks">
										<label><input type="radio" name="permalink" value="0" <?php echo $ex0; ?>><i></i>默认形式：<span class="badge"><?php echo BLOG_URL; ?>?post=1</span></label>
									</div>
									<div class="radio i-checks">
										<label><input type="radio" name="permalink" value="1" <?php echo $ex1; ?>><i></i>文件形式：<span class="badge"><?php echo BLOG_URL; ?>post-1.html</span></label>
									</div>
									<div class="radio i-checks">
										<label><input type="radio" name="permalink" value="2" <?php echo $ex2; ?>><i></i>目录形式：<span class="badge"><?php echo BLOG_URL; ?>post/1</span></label>
									</div>
									<div class="radio i-checks">
										<label><input type="radio" name="permalink" value="3" <?php echo $ex3; ?>><i></i>分类形式：<span class="badge"><?php echo BLOG_URL; ?>category/1.html</span></label>
									</div>
								</div>
							</div>
							<div class="line line-dashed b-b line-lg pull-in"></div>
							<div class="form-group">
								<label class="col-sm-2 control-label">启用文章链接别名：</label>
								<div class="col-sm-10">
									<div class="checkbox i-checks">
										<label class="switch"><input type="checkbox" style="vertical-align:middle;" value="y" name="isalias" id="isalias" <?php echo $isalias; ?>><span></span></label>
									</div>
								</div>
							</div>
							<div class="line line-dashed b-b line-lg pull-in"></div>
							<div class="form-group">
								<label class="col-sm-2 control-label">启用文章链接别名html后缀：</label>
								<div class="col-sm-10">
									<div class="checkbox i-checks">
										<label class="switch"><input type="checkbox" style="vertical-align:middle;" value="y" name="isalias_html" id="isalias_html" <?php echo $isalias_html; ?>><span></span></label>
									</div>
								</div>
							</div>
							<div class="line line-dashed b-b line-lg pull-in"></div>
							<div class="form-group">
								<label class="col-sm-2 control-label">站点浏览器标题：</label>
								<div class="col-sm-10">
									<input maxlength="200" class="form-control" value="<?php echo $site_title; ?>" name="site_title" />
								</div>
							</div>
							<div class="line line-dashed b-b line-lg pull-in"></div>
							<div class="form-group">
								<label class="col-sm-2 control-label">站点关键字：</label>
								<div class="col-sm-10">
									<input maxlength="200" class="form-control" value="<?php echo $site_key; ?>" name="site_key" />
								</div>
							</div>
							<div class="line line-dashed b-b line-lg pull-in"></div>
							<div class="form-group">
								<label class="col-sm-2 control-label">站点浏览器描述：</label>
								<div class="col-sm-10">
									<textarea name="site_description" class="form-control" cols="" rows="4" ><?php echo $site_description; ?></textarea>
								</div>
							</div>
							<div class="line line-dashed b-b line-lg pull-in"></div>
							<div class="form-group">
								<label class="col-sm-2 control-label">文章浏览器标题方案：</label>
								<div class="col-sm-10">
									<select name="log_title_style" class="form-control m-b">
										<option value="0" <?php echo $opt0; ?>>文章标题</option>
										<option value="1" <?php echo $opt1; ?>>文章标题 - 站点标题</option>
										<option value="2" <?php echo $opt2; ?>>文章标题 - 站点浏览器标题</option>
									</select>
								</div>
							</div>
							<div class="line line-dashed b-b line-lg pull-in"></div>
							<div class="form-group">
								<div class="col-sm-4 col-sm-offset-2">
									<input name="token" id="token" value="<?php echo LoginAuth::genToken(); ?>" type="hidden" />
									<input type="submit" value="保存设置" class="btn btn-primary" />
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
$("#menu_category_sys").addClass('active');
$("#menu_setting").addClass('active');
</script>
