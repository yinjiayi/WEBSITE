<?php
if(!defined('EMLOG_ROOT')) {exit('error!');}
$isdraft = $hide == 'y' ? true : false;
?>
<section class="vbox">
	<section class="scrollable wrapper">
		<form action="save_log.php?action=add" method="post" enctype="multipart/form-data" id="addlog" name="addlog">
		<div class="row">
			<div class="col-lg-8">
				<section class="panel panel-default">
					<header class="panel-heading font-bold"><i class="fa fa-edit fa-fw"></i> <?php if ($isdraft) :?>编辑草稿<?php else:?>编辑文章<?php endif;?><span id="msg_2" class="badge bg-primary"></span><span id="msg" class="badge bg-primary"></span>
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
							<input type="text" maxlength="200" name="title" id="title" class="form-control" value="<?php echo $title; ?>">
						</div>
						<span onclick="displayToggle('FrameUpload', 0);autosave(1);" class="show_advset">上传插入<i class="i i-minus"></i></span>
						<div id="post_bar">
							<div>
								<?php doAction('adm_writelog_head'); ?>
								<span id="asmsg"></span>
								<input type="hidden" name="as_logid" id="as_logid" value="<?php echo $logid; ?>">
							</div>
							<div id="FrameUpload" style="display: none;">
								<iframe style="width:100%;height:330px;" frameborder="0" src="attachment.php?action=attlib&logid=<?php echo $logid; ?>"></iframe>
							</div>
						</div>
						<div class="form-group">
							<textarea id="content" name="content" class="form-control" style="overflow:scroll;width:100%;height:250px;max-height:350px"><?php echo $content; ?></textarea>
						</div>
						<div class="form-group">
							<span onclick="displayToggle('advset', 1);">高级选项<i class="i i-minus"></i></span>
						</div>
						<div class="form-group" id="advset">
							<textarea id="excerpt" name="excerpt" class="form-control" style="overflow:scroll;width:100%;height:250px;max-height:350px"><?php echo $excerpt; ?></textarea>
						</div>
					</div>
				</section>
			</div>
			<div class="col-lg-4">
				<section class="panel panel-default">
					<header class="panel-heading font-bold"><i class="fa fa-cog fa-fw"></i> <?php if ($isdraft) :?>草稿设置项<?php else:?>文章设置项<?php endif;?>
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
							<select name="sort" id="sort" class="form-control m-b">
								<option value="-1">选择分类...</option>
								<?php 
									foreach($sorts as $key=>$value):
									if ($value['pid'] != 0) {
										continue;
									}
									$flg = $value['sid'] == $sortid ? 'selected' : '';
								?>
								<option value="<?php echo $value['sid']; ?>" <?php echo $flg; ?>><?php echo $value['sortname']; ?></option>
								<?php
									$children = $value['children'];
									foreach ($children as $key):
									$value = $sorts[$key];
									$flg = $value['sid'] == $sortid ? 'selected' : '';
								?>
								<option value="<?php echo $value['sid']; ?>" <?php echo $flg; ?>>&nbsp; &nbsp; &nbsp; <?php echo $value['sortname']; ?></option>
								<?php
									endforeach;
									endforeach;
								?>
							</select>
						</div>
						<div class="form-group">
							<label><strong>标签：</strong></label>
							<input name="tag" id="tag" class="form-control" maxlength="200" value="<?php echo $tagStr; ?>" />
							<span style="color:#2A9DDB;cursor:pointer;margin-right: 40px;"><a href="javascript:displayToggle('tagbox', 0);">已有标签+</a></span>
						</div>
						<div id="tagbox" style="display:none">
						<?php
							if ($tags) {
								foreach ($tags as $val){
									echo " <a href=\"javascript: insertTag('{$val['tagname']}','tag');\">{$val['tagname']}</a> ";
								}
							} else {
								echo '还没有设置过标签！';
							}
						?>
						</div>
						<div class="form-group">
							<label>发布于：</label>
							<input maxlength="200" class="form-control" name="postdate" id="postdate" value="<?php echo gmdate('Y-m-d H:i:s', $date); ?>"/>
							<input name="date" id="date" type="hidden" value="<?php echo $orig_date; ?>" >
						</div>
						<div class="form-group">
							<label>链接别名：</label>
							<input name="alias" id="alias" class="form-control" value="<?php echo $alias;?>"/>
						</div>
						<div class="form-group">
							<label>访问密码：</label>
							<input type="text" value="" name="password" id="password" class="form-control" value="<?php echo $password; ?>"/>
						</div>
						<div class="form-group">
							<label class="checkbox-inline checkbox m-n i-checks"><input type="checkbox" value="y" name="top" id="top" class="ids" <?php echo $is_top; ?> ><i></i>首页置顶</label>
							<label class="checkbox-inline checkbox m-n i-checks"><input type="checkbox" value="y" name="sortop" id="sortop" class="ids" <?php echo $is_sortop; ?> ><i></i>分类置顶</label>
							<label class="checkbox-inline checkbox m-n i-checks"><input type="checkbox" value="y" name="allow_remark" id="allow_remark" checked="checked" class="ids" <?php echo $is_allow_remark; ?>><i></i>允许评论</label>
						</div>
						<div class="text-center">
							<input name="token" id="token" value="<?php echo LoginAuth::genToken(); ?>" type="hidden" />
							<input type="hidden" name="ishide" id="ishide" value="<?php echo $hide; ?>" />
							<input type="hidden" name="gid" value=<?php echo $logid; ?> />
							<input type="hidden" name="author" id="author" value=<?php echo $author; ?> />
							<input type="submit" value="保存并返回" onclick="return checkform();" class="btn btn-primary" />
							<input type="button" name="savedf" id="savedf" value="保存" onclick="autosave(2);" class="btn btn-success" />
							<?php if ($isdraft) :?>
							<input type="submit" name="pubdf" id="pubdf" value="发布" onclick="return checkform();" class="btn btn-primary" />
							<?php endif;?>
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
loadEditor('excerpt');
checkalias();
$("#alias").keyup(function(){checkalias();});
$("#advset").css('display', $.cookie('em_advset') ? $.cookie('em_advset') : '');
setTimeout("autosave(0)",60000);
<?php if ($isdraft) :?>
$("#menu_draft").addClass('active');
<?php else:?>
$("#menu_log").addClass('active');
<?php endif;?>
</script>
