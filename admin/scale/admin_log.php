<?php
if(!defined('EMLOG_ROOT')) {exit('error!');}
$isdraft = $pid == 'draft' ? '&pid=draft' : '';
$isDisplaySort = !$sid ? "style=\"display:none;\"" : '';
$isDisplayTag = !$tagId ? "style=\"display:none;\"" : '';
$isDisplayUser = !$uid ? "style=\"display:none;\"" : '';
?>
<section class="hbox stretch">
	<aside class="aside bg-light dker b-r lt" id="subNav">
		<section class="vbox animated fadeInLeft">
			<header class="dk header"><p><?php echo $pwd; ?></p></header>
			<section class="scrollable">
				<ul class="nav">
					<?php 
						foreach($sorts as $key=>$value):
							if($value['pid'] != 0){continue;}
							$flg = $value['sid'] == $sid ? 'selected' : '';
					?>
					<li class="b-b "><a href="./admin_log.php?sid=<?php echo $value['sid']; ?>"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i><?php echo $value['sortname']; ?></a></li>
					<?php
						$children = $value['children'];
						foreach ($children as $key):
							$value = $sorts[$key];
							$flg = $value['sid'] == $sid ? 'selected' : '';
					?>
					<li class="b-b "><a href="./admin_log.php?sid=<?php echo $value['sid']; ?>"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i><?php echo $value['sortname']; ?></a></li>
					<?php
						endforeach;
						endforeach;
					?>
				</ul>
			</section>
		</section>
	</aside>
	<aside class="lter">
		<section class="vbox">
			<header class="header bg-white b-b clearfix">
				<div class="row m-t-sm">
					<div class="col-sm-8 m-b-xs">
						<a href="#subNav" data-toggle="class:hide" class="btn btn-sm btn-default active"><i class="fa fa-caret-right text fa-lg"></i><i class="fa fa-caret-left text-active fa-lg"></i></a>
						<div class="btn-group">
							<a href="./admin_log.php?<?php echo $isdraft; ?>" class="btn btn-sm btn-default" title="Refresh"><i class="fa fa-refresh"></i></a>
							<a href="javascript:logact('del');" class="btn btn-sm btn-default" title="Remove"><i class="fa fa-trash-o"></i></a>
							<a data-target="#tags" data-toggle="modal" class="btn btn-sm btn-default"><i class="fa fa-tags"></i> 按标签查看</a>
						</div>
					</div>
					<div class="col-sm-4 m-b-xs">
						<form action="admin_log.php" method="get">
							<div class="input-group">
								<input type="text" id="input_s" name="keyword" class="input-sm form-control" >
								<?php if($pid):?>
								<input type="hidden" id="pid" name="pid" class="input-sm form-control"  value="draft">
								<?php endif;?>
								<span class="input-group-btn">
									<input class="btn btn-sm btn-default" type="submit" value="Go!">
								</span>
							</div>
						</form>
					</div>
				</div>
			</header>
			<section class="scrollable wrapper">
<?php if(isset($_GET['active_del'])):?><div class="alert alert-info actived">删除成功</div><?php endif;?>
<?php if(isset($_GET['active_up'])):?><div class="alert alert-info actived">置顶成功</div><?php endif;?>
<?php if(isset($_GET['active_down'])):?><div class="alert alert-info actived">取消置顶成功</div><?php endif;?>
<?php if(isset($_GET['error_a'])):?><div class="alert alert-danger error">请选择要处理的文章</div><?php endif;?>
<?php if(isset($_GET['error_b'])):?><div class="alert alert-danger error">请选择要执行的操作</div><?php endif;?>
<?php if(isset($_GET['active_post'])):?><div class="alert alert-info actived">发布成功</div><?php endif;?>
<?php if(isset($_GET['active_move'])):?><div class="alert alert-info actived">移动成功</div><?php endif;?>
<?php if(isset($_GET['active_change_author'])):?><div class="alert alert-info actived">更改作者成功</div><?php endif;?>
<?php if(isset($_GET['active_hide'])):?><div class="alert alert-info actived">转入草稿箱成功</div><?php endif;?>
<?php if(isset($_GET['active_savedraft'])):?><div class="alert alert-info actived">草稿保存成功</div><?php endif;?>
<?php if(isset($_GET['active_savelog'])):?><div class="alert alert-info actived">保存成功</div><?php endif;?>
<?php if(isset($_GET['active_ck'])):?><div class="alert alert-info actived">文章审核成功</div><?php endif;?>
<?php if(isset($_GET['active_unck'])):?><div class="alert alert-info actived">文章驳回成功</div><?php endif;?>
				<section class="panel panel-default">
					<form action="admin_log.php?action=operate_log" method="post" name="form_log" id="form_log">
						<input type="hidden" name="pid" value="<?php echo $pid; ?>">
						<table class="table table-border table-hover m-b-none">
							<thead>
								<tr>
									<th width="2%"><label class="checkbox m-n i-checks"><input type="checkbox"><i></i></label></th>
									<th <?php if ($pid != 'draft'): ?>width="40%"<?php else:?>width="98%"<?php endif;?>><b>标题</b></th>
									<?php if ($pid != 'draft'): ?>
									<th width="6%" class="text-center"><b>查看</b></th>
									<th width="10%" ><b>作者</b></th>
									<th width="15%" ><b>分类</b></th>
									<th width="15%" ><b><a href="./admin_log.php?sortDate=<?php echo $sortDate.$sorturl; ?>">时间</a></b></th>
									<th width="6%" class="text-center"><b><a href="./admin_log.php?sortComm=<?php echo $sortComm.$sorturl; ?>">评论</a></b></th>
									<th width="6%" class="text-center"><b><a href="./admin_log.php?sortView=<?php echo $sortView.$sorturl; ?>">阅读</a></b></th>
									<?php endif; ?>
								</tr>
							</thead>
							<tbody>
								<?php
									if($logs):
									foreach($logs as $key=>$value):
									$sortName = $value['sortid'] == -1 && !array_key_exists($value['sortid'], $sorts) ? '未分类' : $sorts[$value['sortid']]['sortname'];
									$author = $user_cache[$value['author']]['name'];
									$author_role = $user_cache[$value['author']]['role'];
								?>
								<tr>
									<td><label class="checkbox m-n i-checks"><input type="checkbox" name="blog[]" value="<?php echo $value['gid']; ?>" class="ids"><i></i></label></td>
									<td<?php if ($pid == 'draft'): ?> colspan="6"<?php endif; ?>>
										<a href="write_log.php?action=edit&gid=<?php echo $value['gid']; ?>"><?php echo $value['title']; ?></a>
										<?php if($value['top'] == 'y'): ?><i class="fa fa-level-up text-info" title="首页置顶" ></i><?php endif; ?>
										<?php if($value['sortop'] == 'y'): ?><i class="fa fa-external-link text-primary" title="分类置顶" ></i><?php endif; ?>
										<?php if($value['attnum'] > 0): ?><i class="fa fa-paperclip text-dark" title="附件：<?php echo $value['attnum']; ?>"></i><?php endif; ?>
										<?php if($pid != 'draft' && $value['checked'] == 'n'): ?><span style="color:red;"> - 待审</span><?php endif; ?>
										<?php if($pid != 'draft' && ROLE == ROLE_ADMIN && $value['checked'] == 'n'): ?>
										<a href="./admin_log.php?action=operate_log&operate=check&gid=<?php echo $value['gid']?>&token=<?php echo LoginAuth::genToken(); ?>"><i class="fa fa-mail-forward text-success" title="审核文章"></i></a> 
										<?php elseif($pid != 'draft' && ROLE == ROLE_ADMIN && $author_role == ROLE_WRITER):?>
										<a href="./admin_log.php?action=operate_log&operate=uncheck&gid=<?php echo $value['gid']?>&token=<?php echo LoginAuth::genToken(); ?>"><i class="fa fa-mail-reply-all text-danger" title="驳回文章"></i></a> 
										<?php endif;?>
									</td>
									<?php if ($pid != 'draft'): ?>
									<td class="text-center"><a href="<?php echo Url::log($value['gid']); ?>" target="_blank" title="在新窗口查看"><i class="fa fa-desktop text-primary"></i></a></td>
									<td><a href="./admin_log.php?uid=<?php echo $value['author'].$isdraft;?>"><?php echo $author; ?></a></td>
									<td><a href="./admin_log.php?sid=<?php echo $value['sortid'].$isdraft;?>"><?php echo $sortName; ?></a></td>
									<td><?php echo $value['date']; ?></td>
									<td class="text-center"><a href="comment.php?gid=<?php echo $value['gid']; ?>"><?php echo $value['comnum']; ?></a></td>
									<td class="text-center"><?php echo $value['views']; ?></a></td>
									<?php endif; ?>
								</tr>
								<?php endforeach;else:?>
								<tr><td class="text-center" colspan="8">还没有文章</td></tr>
								<?php endif;?>
							</tbody>
						</table>
						<header class="panel-heading form-inline">
							<div class="pull-right">
								<ul class="pagination pagination-sm m-t-sm m-b-none"><?php echo $pageurl; ?></ul>
							</div>
							<input name="token" id="token" value="<?php echo LoginAuth::genToken(); ?>" type="hidden" />
							<input name="operate" id="operate" value="" type="hidden" />
							<a href="javascript:void(0);" class="btn btn-default" id="select_all">全选</a>
							<a href="javascript:logact('del');" class="btn btn-default" >删除</a>
							<?php if($pid == 'draft'): ?>
							<a href="javascript:logact('pub');" class="btn btn-default">发布</a>
							<?php else: ?>
							<a href="javascript:logact('hide');" class="btn btn-default">放入草稿箱</a>
							
							<?php if (ROLE == ROLE_ADMIN):?>
							<select name="top" id="top" onChange="changeTop(this);" class="form-control">
								<option value="" selected="selected">置顶操作...</option>
								<option value="top">首页置顶</option>
								<option value="sortop">分类置顶</option>
								<option value="notop">取消置顶</option>
							</select>
							<?php endif;?>
							<select name="sort" id="sort" onChange="changeSort(this);" class="form-control">
								<option value="" selected="selected">移动到分类...</option>
								<?php
									foreach($sorts as $key=>$value):
									if($value['pid'] != 0){
										continue;
									}
								?>
								<option value="<?php echo $value['sid']; ?>"><?php echo $value['sortname']; ?></option>
								<?php
									$children = $value['children'];
									foreach ($children as $key):
									$value = $sorts[$key];
								?>
								<option value="<?php echo $value['sid']; ?>">&nbsp; &nbsp; &nbsp; <?php echo $value['sortname']; ?></option>
								<?php
									endforeach;
									endforeach;
								?>
								<option value="-1">未分类</option>
							</select>
							<?php if (ROLE == ROLE_ADMIN && count($user_cache) > 1):?>
							<select name="author" id="author" onChange="changeAuthor(this);" class="form-control">
								<option value="" selected="selected">更改作者为...</option>
								<?php
									foreach($user_cache as $key => $val):
									$val['name'] = $val['name'];
								?>
								<option value="<?php echo $key; ?>"><?php echo $val['name']; ?></option>
								<?php endforeach;?>
								</select>
							<?php endif;?>
							<?php endif;?>
						</header>
					</form>
				</section>
				<div class="footer text-center">欢迎使用 &copy; <a href="http://www.emlog.net" target="_blank">emlog</a><?php doAction('adm_footer');?></div>
			</section>
		</section>
	</aside>
</section>
<div class="modal fade" id="tags" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog" style="width:900px; z-index:1080">
		<div class="modal-content" style="border-radius: 0px; z-index:1080">
		<div class="modal-content" >
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">标签：</h4>
			</div>
			<div class="modal-body">
				<div id="f_tag">
				<?php 
					if(empty($tags)) echo '还没有标签';
					foreach($tags as $val):
					$a = 'tag_'.$val['tid'];
					$$a = '';
					$b = 'tag_'.$tagId;
					$$b = "class=\"filter\"";
					?>
					<a href="./admin_log.php?tagid=<?php echo $val['tid'].$isdraft; ?>" class="btn btn-default"><?php echo $val['tagname']; ?></a>
					<?php endforeach;?>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<script>
$(document).ready(function(){
	$("#adm_log_list tbody tr:odd").addClass("tralt_b");
	$("#adm_log_list tbody tr")
		.mouseover(function(){$(this).addClass("trover");$(this).find("span").show();})
		.mouseout(function(){$(this).removeClass("trover");$(this).find("span").hide();});
	$("#f_t_tag").click(function(){$("#f_tag").toggle();$("#f_sort").hide();$("#f_user").hide();});
	selectAllToggle();
});
setTimeout(hideActived,2600);
function logact(act){
	if (getChecked('ids') == false) {
		alert('请选择要操作的文章');
		return;}
	if(act == 'del' && !confirm('你确定要删除所选文章吗？')){return;}
	$("#operate").val(act);
	$("#form_log").submit();
}
function changeSort(obj) {
	if (getChecked('ids') == false) {
		alert('请选择要操作的文章');
		return;}
	if($('#sort').val() == '')return;
	$("#operate").val('move');
	$("#form_log").submit();
}
function changeAuthor(obj) {
	if (getChecked('ids') == false) {
		alert('请选择要操作的文章');
		return;}
	if($('#author').val() == '')return;
	$("#operate").val('change_author');
	$("#form_log").submit();
}
function changeTop(obj) {
	if (getChecked('ids') == false) {
		alert('请选择要操作的文章');
		return;}
	if($('#top').val() == '')return;
	$("#operate").val(obj.value);
	$("#form_log").submit();
}
function selectSort(obj) {
    window.open("./admin_log.php?sid=" + obj.value + "<?php echo $isdraft?>", "_self");
}
function selectUser(obj) {
    window.open("./admin_log.php?uid=" + obj.value + "<?php echo $isdraft?>", "_self");
}
<?php if ($isdraft) :?>
$("#menu_draft").addClass('active');
<?php else:?>
$("#menu_log").addClass('active');
<?php endif;?>
</script>
