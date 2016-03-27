<?php if(!defined('EMLOG_ROOT')) {exit('error!');}?>

		<section class="vbox">
			<section class="scrollable wrapper">
				<?php if(isset($_GET['active_del'])):?><div class="alert alert-info actived">删除页面成功</div><?php endif;?>
				<?php if(isset($_GET['active_hide_n'])):?><div class="alert alert-info actived">发布页面成功</div><?php endif;?>
				<?php if(isset($_GET['active_hide_y'])):?><div class="alert alert-info actived">禁用页面成功</div><?php endif;?>
				<?php if(isset($_GET['active_pubpage'])):?><div class="alert alert-info actived">页面保存成功</div><?php endif;?>
				<section class="panel panel-default">
					<header class="panel-heading font-bold">
						<ul class="nav nav-tabs">
							<li class="active"><a href="page.php">页面管理 <span class="badge"><?php echo $pageNum; ?></span></a></li>
							<li><a href="page.php?action=new">新建页面</a></li>
						</ul>
					</header>
					<form action="page.php?action=operate_page" method="post" name="form_page" id="form_page">
						<table width="100%" id="adm_comment_list" class="table table-hover">
							<thead>
								<tr>
									<th width="4%"><b></b></th>
									<th width="65%"><b>标题</b></th>
									<th width="10%"><b>模板</b></th>
									<th width="10%" class="text-center"><b>评论</b></th>
									<th width="10%"><b>时间</b></th>
								</tr>
							</thead>
							<tbody>
								<?php
									if($pages):
										foreach($pages as $key => $value):
											if(empty($navibar[$value['gid']]['url'])){
												$navibar[$value['gid']]['url'] = Url::log($value['gid']);
											}
											$isHide = $value['hide'] == 'y' ? '<font color="red"> - 草稿</font>' : '<a href="'.$navibar[$value['gid']]['url'].'" target="_blank" title="查看页面"><i class="fa fa-share-square-o"></i></a>';
								?>
								<tr>
									<td><label class="checkbox i-checks" style="margin-top:0px;margin-bottom:0px;"><input type="checkbox" name="page[]" value="<?php echo $value['gid']; ?>" class="ids" /><i></i></label></td>
									<td>
										<a href="page.php?action=mod&id=<?php echo $value['gid']?>"><?php echo $value['title']; ?></a> <?php echo $isHide; ?>
										<?php if($value['attnum'] > 0): ?><i class="fa fa-paperclip" title="附件：<?php echo $value['attnum']; ?>"></i><?php endif; ?>
									</td>
									<td><?php echo $value['template']; ?></td>
									<td class="text-center"><a href="comment.php?gid=<?php echo $value['gid']; ?>"><?php echo $value['comnum']; ?></a></td>
									<td><?php echo $value['date']; ?></td>
								</tr>
								<?php endforeach;else:?>
								<tr><td class="text-center" colspan="5">还没有页面</td></tr>
								<?php endif;?>
							</tbody>
						</table>
						<input name="token" id="token" value="<?php echo LoginAuth::genToken(); ?>" type="hidden" />
						<input name="operate" id="operate" value="" type="hidden" />
					</form>
					<div class="list_footer">
						<a href="javascript:void(0);" id="select_all" class="btn btn-default">全选</a>
						<a href="javascript:pageact('del');" class="btn btn-default">删除</a>
						<a href="javascript:pageact('hide');" class="btn btn-default">转为草稿</a>
						<a href="javascript:pageact('pub');" class="btn btn-default">发布</a>
					</div>
					<div class="panel-body text-right">
						<ul class="pagination"><?php echo $pageurl; ?></ul>
					</div>
				</section>
				<div class="footer text-center">欢迎使用 &copy; <a href="http://www.emlog.net" target="_blank">emlog</a><?php doAction('adm_footer');?></div>
			</section>
		</section>
<script>
$(document).ready(function(){
	$("#adm_comment_list tbody tr:odd").addClass("tralt_b");
	$("#adm_comment_list tbody tr")
		.mouseover(function(){$(this).addClass("trover")})
		.mouseout(function(){$(this).removeClass("trover")});
	selectAllToggle();
});
setTimeout(hideActived,2600);
function pageact(act){
	if (getChecked('ids') == false) {
		alert('请选择要操作的页面');
		return;}
	if(act == 'del' && !confirm('你确定要删除所选页面吗？')){return;}
	$("#operate").val(act);
	$("#form_page").submit();
}
$("#menu_page").addClass('active');
</script>
