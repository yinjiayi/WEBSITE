<?php if(!defined('EMLOG_ROOT')) {exit('error!');}?>
<section class="vbox">
	<section class="scrollable wrapper">
		<div class="row">
			<div class="col-lg-12">
				<section class="panel panel-default">
					<header class="panel-heading font-bold">安装<?php echo $source_typename;?></header>
					<div class="panel-body"><div id="addon_ins"><span class="ajaxload"><?php echo $source_typename;?>正在下载安装中</span></div></div>
				</section>
			</div>
		</div>
		<div class="footer text-center">欢迎使用 &copy; <a href="http://www.emlog.net" target="_blank">emlog</a><?php doAction('adm_footer');?></div>
	</section>
</section>
<script>
$("#menu_category_sys").addClass('active');
$("#menu_store").addClass('active');
$(document).ready(function(){
    $.get('./store.php', {action:'addon', source:"<?php echo $source;?>", type:"<?php echo $source_type;?>" },
      function(data){
        if (data.match("succ")) {
            $("#addon_ins").html('<div class="alert alert-info"><?php echo $source_typename;?>安装成功，<?php echo $source_typeurl;?></div>');
        } else if(data.match("error_down")){
            $("#addon_ins").html('<div class="alert alert-danger"><?php echo $source_typename;?>下载失败，可能是服务器网络问题，请手动下载安装，<a href="store.php">返回应用中心</a></div>');
        } else if(data.match("error_zip")){
            $("#addon_ins").html('<div class="alert alert-danger"><?php echo $source_typename;?>安装失败，可能是你的服务器空间不支持zip模块，请手动下载安装，<a href="store.php">返回应用中心</a></div>');
        } else if(data.match("error_dir")){
            $("#addon_ins").html('<div class="alert alert-danger"><?php echo $source_typename;?>安装失败，可能是应用目录不可写，<a href="store.php">返回应用中心</a></div>');
        }else{
            $("#addon_ins").html('<div class="alert alert-danger"><?php echo $source_typename;?>安装失败，<a href="store.php">返回应用中心</a></div>');
        }
      });
})
</script>