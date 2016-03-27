<?php if(!defined('EMLOG_ROOT')) {exit('error!');}?>
<section class="vbox">
	<section class="scrollable wrapper">
		<div class="row">
			<div class="col-lg-12">
				<section class="panel panel-default">
					<header class="panel-heading font-bold"><i class="fa fa-comments fa-fw"></i> 回复评论</header>
					<div class="panel-body">
						<form action="comment.php?action=doreply" method="post">
							<dd class="project-people">
								<a><img alt="image" class="img-circle" src="http://gravatar.duoshuo.com/avatar/<?php echo md5($mail);?>?s=40&d=mm&r=g"></a>
							</dd>
							<div class="row">
								<div class="col-xs-6">
									<h4><?php echo $poster; ?></h4>
									<p>Come From：<?php echo $ip;?></p>
								</div>
								<div class="col-xs-6 text-right">
									<p class="h4">#<?php echo addslashes($_GET['cid']);?></p>
									<h5><?php echo $date; ?></h5>           
								</div>
							</div>
							<strong><?php echo $poster; ?>的评论内容：</strong>
							<div class="well m-t">
								<div class="row">
									<div class="col-lg-12">
										<p><?php echo $comment; ?></p>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label>回复内容：</label>
								<textarea name="reply" rows="5" cols="60" class="form-control"></textarea>
							</div>
							<div class="form-group pull-right">
								<div class="col-lg-12">
									<input type="hidden" value="<?php echo $commentId; ?>" name="cid" />
									<input type="hidden" value="<?php echo $gid; ?>" name="gid" />
									<input type="hidden" value="<?php echo $hide; ?>" name="hide" />
									<input type="submit" value="回复" class="btn btn-primary" />
									<?php if ($hide == 'y'): ?>
									<input type="submit" value="回复并审核" name="pub_it" class="btn btn-primary" />
									<?php endif; ?>
									<input type="button" value="取 消" class="btn btn-default" onclick="javascript: window.history.back();"/></li>
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
$("#menu_cm").addClass('active');
</script>
