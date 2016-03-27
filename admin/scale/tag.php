<?php if(!defined('EMLOG_ROOT')) {exit('error!');}?>
<section class="vbox">
	<header class="header bg-white b-b b-light"><p><i class="fa fa-tags"></i> 标签管理</p></header>
	<section class="scrollable wrapper">
	<?php if(isset($_GET['active_del'])):?><div class="alert alert-info actived">删除标签成功</div><?php endif;?>
	<?php if(isset($_GET['active_edit'])):?><div class="alert alert-info actived">修改标签成功</div><?php endif;?>
	<?php if(isset($_GET['error_a'])):?><div class="alert alert-danger error">请选择要删除的标签</div><?php endif;?>
		<form action="tag.php?action=dell_all_tag" method="post" name="form_tag" id="form_tag">
			<div class="row">
				<?php
					if($tags):
					foreach($tags as $key=>$value):
				?>
				<div class="col-lg-2-4">
					<section class="panel panel-default">
						<div class="panel-body"><label class="checkbox-inline checkbox i-checks" style="margin-top:0px;"><input type="checkbox" name="tag[<?php echo $value['tid']; ?>]" class="ids" value="1" /><i></i><a href="tag.php?action=mod_tag&tid=<?php echo $value['tid']; ?>"><?php echo $value['tagname']; ?></a></label></div>
					</section>
				</div>
			<?php endforeach; ?>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="panel-body">
						<div class="form-group">
							<input name="token" id="token" value="<?php echo LoginAuth::genToken(); ?>" type="hidden" />
							<a href="javascript:void(0);" id="select_all" class="btn btn-default">全选</a>
							<a href="javascript:deltags();" class="btn btn-default" >删除</a>
						</div>
					</div>
				</div>
			</div>
			<?php else:?>
			<div class="alert alert-danger">还没有标签，写文章的时候可以给文章打标签</div>
			<?php endif;?>
		</form>
		<div class="footer text-center">欢迎使用 &copy; <a href="http://www.emlog.net" target="_blank">emlog</a><?php doAction('adm_footer');?></div>
	</section>
</section>
<script>
selectAllToggle();
function deltags(){
	if (getChecked('ids') == false) {
		alert('请选择要删除的标签');
		return;
	}
	if(!confirm('你确定要删除所选标签吗？')){return;}
	$("#form_tag").submit();
}
setTimeout(hideActived,2600);
$("#menu_tag").addClass('active');
</script>
