<?php if(!defined('EMLOG_ROOT')) {exit('error!');}?>
<section class="vbox">
	<section class="scrollable wrapper">
	<?php if(isset($_GET['active_del'])):?><div class="alert alert-info actived">删除评论成功</div><?php endif;?>
	<?php if(isset($_GET['active_show'])):?><div class="alert alert-info actived">审核评论成功</div><?php endif;?>
	<?php if(isset($_GET['active_hide'])):?><div class="alert alert-info actived">隐藏评论成功</div><?php endif;?>
	<?php if(isset($_GET['active_edit'])):?><div class="alert alert-info actived">修改评论成功</div><?php endif;?>
	<?php if(isset($_GET['active_rep'])):?><div class="alert alert-info actived">回复评论成功</div><?php endif;?>
	<?php if(isset($_GET['error_a'])):?><div class="alert alert-danger error">请选择要执行操作的评论</div><?php endif;?>
	<?php if(isset($_GET['error_b'])):?><div class="alert alert-danger error">请选择要执行的操作</div><?php endif;?>
	<?php if(isset($_GET['error_c'])):?><div class="alert alert-danger error">回复内容不能为空</div><?php endif;?>
	<?php if(isset($_GET['error_d'])):?><div class="alert alert-danger error">内容过长</div><?php endif;?>
	<?php if(isset($_GET['error_e'])):?><div class="alert alert-danger error">评论内容不能为空</div><?php endif;?>
		<div class="row">
			<div class="col-lg-12">
				<section class="panel panel-default">
					<div class="panel-body">
				<div class="p-xs">
					<div class="pull-left m-r-md">
						<i class="fa fa-comments text-navy mid-icon"></i>
					</div>
					<h2>评论管理 <span class="label"><?php echo $cmnum; ?></span></h2>
					<span>
						<?php if ($hideCommNum > 0) :?>
						<ol class="breadcrumb">
							<li><a href="./comment.php?<?php echo $addUrl_1 ?>">全部</a></li>
							<li><a href="./comment.php?hide=y&<?php echo $addUrl_1 ?>">待审<?php
							$hidecmnum = ROLE == ROLE_ADMIN ? $sta_cache['hidecomnum'] : $sta_cache[UID]['hidecommentnum'];
							if ($hidecmnum > 0) echo '('.$hidecmnum.')';
							?></a></li>
							<li><a href="comment.php?hide=n&<?php echo $addUrl_1 ?>">已审</a></li>
						</ol>
						<?php else:?>
						你可以自由管理您站内的评论。
						<?php endif;?>
					</span>
				</div>
					</div>
				</section>
			</div>
			<div class="col-lg-12">
				<form action="comment.php?action=admin_all_coms" method="post" name="form_com" id="form_com">
					<section class="comment-list block">
						<?php
							if($comment):
							foreach($comment as $key=>$value):
							$ishide = $value['hide']=='y'?'<font color="red">[待审]</font>':'';
							$mail = !empty($value['mail']) ? "{$value['mail']}" : '';
							$ip = !empty($value['ip']) ? "{$value['ip']}" : '';
							$poster = !empty($value['url']) ? '<a href="'.$value['url'].'" target="_blank">'. $value['poster'].'</a>' : $value['poster'];
							$value['content'] = str_replace('<br>',' ',$value['content']);
							$sub_content = subString($value['content'], 0, 50);
							$value['title'] = subString($value['title'], 0, 42);
							doAction('adm_comment_display');
						?>
						<article id="comment-id-1" class="comment-item">
							<a href="<?php echo $value['url']; ?>" target="_blank" class="pull-left thumb-sm"><img src="http://gravatar.duoshuo.com/avatar/<?php echo md5($mail);?>?s=40&d=mm&r=g" class="img-circle"></a>
							<section class="comment-body m-b">
								<header>
									<a href="<?php echo $value['url']; ?>" target="_blank"><strong><?php echo $poster;?></strong></a>
									<label class="label m-l-xs pull-right">
										<a href="javascript: em_confirm(<?php echo $value['cid']; ?>, 'comment', '<?php echo LoginAuth::genToken(); ?>');" class="btn btn-xs btn-danger"><i class="fa fa-close fa-fw"></i> 删除</a>
										<a href="comment.php?action=edit_comment&amp;cid=<?php echo $value['cid']; ?>" class="btn btn-xs btn-default"><i class="fa fa-edit fa-fw"></i> 编辑</a>
										<a href="comment.php?action=reply_comment&amp;cid=<?php echo $value['cid']; ?>" class="btn btn-xs btn-primary"><i class="fa fa-pencil fa-fw"></i> 回复</a>
										<a href="<?php echo Url::log($value['gid']); ?>" target="_blank" class="btn btn-xs btn-info"><i class="fa fa-eye fa-fw"></i> 查看</a>
										<?php if($value['hide'] == 'y'):?>
										<a href="comment.php?action=show&amp;id=<?php echo $value['cid']; ?>" class="btn btn-xs btn-warning"><i class="fa fa-share-square-o fa-fw"></i> 审核</a>
										<?php else: ?>
										<a href="comment.php?action=hide&amp;id=<?php echo $value['cid']; ?>" class="btn btn-xs btn-warning"><i class="fa fa-random fa-fw"></i> 隐藏</a>
										<?php endif;?>
									</label>
									<div class="line line-dashed b-b line-lg" style="border-bottom:1px solid #666;margin-bottom:0px;"></div>
									<span class="text-muted text-xs block m-t-xs"><div class="checkbox-inline" style="padding-left:0px;"><a class="checkbox i-checks"><label><input type="checkbox" style="vertical-align:middle;" value="<?php echo $value['cid']; ?>" name="com[]" class="ids"/><i></i></label></a></div><?php echo $value['date']; ?> <small class="text-muted">来自 <?php echo $ip; ?><?php if (ROLE == ROLE_ADMIN): ?><a href="javascript: em_confirm('<?php echo $value['ip']; ?>', 'commentbyip', '<?php echo LoginAuth::genToken(); ?>');" title="删除来自该IP的所有评论" class="care"><i class="fa fa-times-circle-o text-danger"></i></a><?php endif;?></small></span>
								</header>
								<div class="<?php if($value['hide'] == 'y'):?>m-t-sm bg-primary panel-body img-rounded<?php else: ?>m-t-sm<?php endif;?>"><?php echo $sub_content; ?></div>
							</section>
						</article>
						<?php endforeach;else:?>
						<div class="alert alert-warning">还没有收到评论</div>
						<?php endif;?>
					</section>
					<div class="list_footer" style="margin-top:20px;">
						<div class="pull-right">
							<ul class="pagination pagination-sm m-t-sm m-b-none"><?php echo $pageurl; ?></ul>
						</div>
						<a href="javascript:void(0);" id="select_all" class="btn btn-default">全选</a>
						<a href="javascript:commentact('del');" class="btn btn-default">删除</a>
						<a href="javascript:commentact('hide');" class="btn btn-default">隐藏</a>
						<a href="javascript:commentact('pub');" class="btn btn-default">审核</a>
						<input name="operate" id="operate" value="" type="hidden" />
					</div>
				</form>
			</div>
		</div>
		<div class="footer text-center">欢迎使用 &copy; <a href="http://www.emlog.net" target="_blank">emlog</a><?php doAction('adm_footer');?></div>
	</section>
</section>
<script>
$(document).ready(function(){
	selectAllToggle();
});
setTimeout(hideActived,2600);
function commentact(act){
	if (getChecked('ids') == false) {
		alert('请选择要操作的评论');
		return;
	}
	if(act == 'del' && !confirm('你确定要删除所选评论吗？')){return;}
	$("#operate").val(act);
	$("#form_com").submit();
}
$("#menu_cm").addClass('active');
</script>
