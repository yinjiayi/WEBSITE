<?php
	if(!defined('EMLOG_ROOT')) {exit('error!');}
	$Getip=$_SERVER["REMOTE_ADDR"];
	$json=file_get_contents('http://ip.taobao.com/service/getIpInfo.php?ip='.$Getip);
	$arr=json_decode($json);
?>
<?php if (ROLE == ROLE_ADMIN):?>
<section class="hbox stretch">
	<section>
		<section class="vbox">
			<section class="scrollable wrapper">
				<section class="row m-b-md">
					<div class="col-sm-6">
						<h3 class="m-b-xs text-black">Dashboard</h3>
						<small>Welcome back, <?php echo subString($user_cache[UID]['name'], 0, 12) ?>, <i class="fa fa-map-marker fa-lg text-primary"></i> 
						<?php echo $arr->data->country.'&nbsp;'.$arr->data->area.'&nbsp;'.$arr->data->region.'&nbsp;'.$arr->data->city.'&nbsp;'.$arr->data->isp;?>
						</small>
					</div>
					<div class="col-sm-6 text-right text-left-xs m-t-md">
						<a href="#nav,#sidebar" class="btn btn-icon b-2x btn-info btn-rounded" data-toggle="class:nav-xs,show"><i class="fa fa-bars"></i></a>
					</div>
				</section>
				<div class="row">
					<div class="col-sm-offset-2 col-md-2 col-sm-4">
						<div class="panel b-a">
							<div class="panel-heading no-border bg-primary lt text-center">
								<a href="./admin_log.php"><i class="fa fa-file-text fa fa-3x m-t m-b text-white"></i></a>
							</div>
							<div class="padder-v text-center clearfix">
								<div class="col-xs-12 b-r">
									<div class="h3 font-bold">文章管理</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-2 col-sm-4">
						<div class="panel b-a">
							<div class="panel-heading no-border bg-info lt text-center">
								<a href="./write_log.php"><i class="fa fa-tags fa fa-3x m-t m-b text-white"></i></a>
							</div>
							<div class="padder-v text-center clearfix">
								<div class="col-xs-12 b-r">
									<div class="h3 font-bold">写写点点</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-2 col-sm-4">
						<div class="panel b-a">
							<div class="panel-heading no-border bg-success lt text-center">
								<a href="./comment.php"><i class="fa fa-user fa fa-3x m-t m-b text-white"></i></a>
							</div>
							<div class="padder-v text-center clearfix">
								<div class="col-xs-12 b-r">
									<div class="h3 font-bold">评论管理</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-2 col-sm-4">
						<div class="panel b-a">
							<div class="panel-heading no-border bg-danger lt text-center">
								<a href="./twitter.php"><i class="i i-data fa fa-3x m-t m-b text-white"></i></a>
							</div>
							<div class="padder-v text-center clearfix">
								<div class="col-xs-12 b-r">
									<div class="h3 font-bold">随缘微语</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<section class="panel panel-default">
							<header class="panel-heading font-bold"><i class="fa fa-signal fa-fw"></i> 站点数据统计</header>
							<div class="panel-body list-icon">
								<div class="col-md-3 col-sm-4"><i class="fa fa-file-text"></i><?php echo $sta_cache['lognum'];?>篇文章</div>
								<div class="col-md-3 col-sm-4"><i class="fa fa-thumbs-up"></i><?php echo $log_top;?>篇文章置顶</div>
								<div class="col-md-3 col-sm-4"><i class="fa fa-file-text-o"></i><?php echo $draftnum;?>篇草稿</div>
								<div class="col-md-3 col-sm-4"><i class="fa fa-copy"></i><?php echo $log_check; ?>篇待审文章</div>
								<div class="col-md-3 col-sm-4"><i class="fa fa-file"></i><?php echo $log_page; ?>个页面</div>
								<div class="col-md-3 col-sm-4"><i class="fa fa-comments"></i><?php echo $sta_cache['comnum_all'];?>条评论</div>
								<div class="col-md-3 col-sm-4"><i class="fa fa-twitter"></i><?php echo $sta_cache['twnum'];?>条微语</div>
								<div class="col-md-3 col-sm-4"><i class="fa fa-link"></i><?php echo $linknum; ?>个友链</div>
								<div class="col-md-3 col-sm-4"><i class="fa fa-power-off"></i><?php echo $log_pass; ?>篇加密文章</div>
								<div class="col-md-3 col-sm-4"><i class="fa fa-flag"></i><?php echo $sortnum; ?>个分类</div>
								<div class="col-md-3 col-sm-4"><i class="fa fa-level-down"></i><?php echo $log_sort_bod; ?>个父分类</div>
								<div class="col-md-3 col-sm-4"><i class="fa fa-mail-forward"></i><?php echo $log_sort_mod; ?>个子分类</div>
								<div class="col-md-3 col-sm-4"><i class="fa fa-user"></i><?php echo $usernum; ?>位会员</div>
								<div class="col-md-3 col-sm-4"><i class="fa fa-tags"></i><?php echo $tagsnum;?>个标签</div>
								<div class="col-md-3 col-sm-4"><i class="fa fa-paperclip"></i><?php echo $log_att; ?>个附件</div>
							</div>
						</section>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<section class="panel panel-default">
							<header class="panel-heading font-bold"><i class="fa fa-tachometer fa-fw"></i> 系统信息</header>
							<table class="table table-bordered">
								<tbody>
									<tr>
										<td>当前程序版本</td>
										<td>Emlog <?php echo Option::EMLOG_VERSION; ?></td>
										<td>最新版本</td>
										<td><span id="upmsg"><a id="ckup" href="javascript:void(0);">检查更新</a></span></td>
									</tr>
									<tr>
										<td>数据库表</td>
										<td><?php echo DB_NAME; ?></td>
										<td>数据库表前缀</td>
										<td><?php echo DB_PREFIX; ?></td>
									</tr>
									<tr>
										<td>服务器操作系统</td>
										<td><?php echo php_uname('s') ; ?></td>
										<td>服务器端口</td>
										<td><?php echo $_SERVER["SERVER_PORT"]; ?></td>
									</tr>
									<tr>
										<td>服务器剩余空间</td>
										<td><?php echo intval(diskfreespace(".") / (1024 * 1024))."M" ; ?></td>
										<td>服务器时间</td>
										<td><?php date_default_timezone_set("Asia/Shanghai");echo date("Y-m-d H:i:s");?></td>
									</tr>
									<tr>
										<td>WEB服务器版本</td>
										<td><?php echo $_SERVER['SERVER_SOFTWARE'] ; ?></td>
										<td>服务器语种</td>
										<td><?php echo getenv("HTTP_ACCEPT_LANGUAGE") ; ?></td>
									</tr>
									<tr>
										<td>PHP版本</td><td><?php echo $php_ver; ?></td>
										<td>ZEND版本</td><td><?php echo zend_version() ; ?></td>
									</tr>
									<tr>
										<td>脚本运行可占最大内存</td>
										<td><?php echo ini_get("memory_limit"); ?></td>
										<td>脚本上传文件大小限制</td>
										<td><?php echo $uploadfile_maxsize; ?></td>
									</tr>
									<tr>
										<td>POST方法提交限制</td>
										<td><?php echo ini_get("post_max_size"); ?></td>
										<td>脚本超时时间</td>
										<td><?php echo ini_get("max_execution_time"); ?></td>
									</tr>
								</tbody>
							</table>
						</section>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-6">
						<section class="panel panel-default">
							<header class="panel-heading font-bold"><i class="fa fa-info-circle fa-fw"></i> Emlog 开发信息</header>
							<table class="table table-bordered">
								<tbody>
									<tr>
										<td>版权所有</td>
										<td><a class="btn btn-default" href="http://www.emlog.net" target="_blank"> Emlog</a></td>
									</tr>
									<tr>
										<td>开 发 者</td>
										<td>
											<a class="btn btn-default" href="#" target="_blank"><i class="fa fa-at"></i> 那多记忆</a>
											<a class="btn btn-default" href="https://github.com/emlog/emlog" target="_blank"><i class="fa fa-github"></i> GitHub</a>
										</td>
									</tr>
									<tr>
										<td>帮助</td>
										<td><a class="btn btn-default" href="http://wiki.emlog.net/doku.php?id=tpldev" target="_blank">模版标签说明</a></td>
									</tr>
									<tr>
										<td>许可协议</td>
										<td>
											<a class="btn btn-danger" href="http://www.emlog.net/license/" target="_blank"><i class="fa fa-ticket"></i> 商业授权</a>
											<a class="btn btn-success" href="http://www.emlog.net/donate" target="_blank"><i class="fa fa-jpy"></i> 捐赠</a>
										</td>
									</tr>
									<tr>
										<td>相关链接</td>
										<td>
											<a class="btn btn-default" href="http://www.emlog.net/" target="_blank" se_prerender_url="complete">EM官网</a>
											<a class="btn btn-default" href="http://www.emlog.net/download" target="_blank">Em Down</a>
											<a class="btn btn-default" href="http://www.emlog.net/templates" target="_blank">模板</a>
											<a class="btn btn-default" href="http://wiki.emlog.net/doku.php" target="_blank">文档</a>
											<a class="btn btn-default" href="http://bbs.emlog.net/" target="_blank">讨论区</a></td>
										</tr>
									</tbody>
								</table>
						</section>
					</div>
					<div class="col-lg-6">
						<section class="panel panel-default">
							<header class="panel-heading font-bold"><i class="fa fa-volume-up fa-fw"></i> Emlog 官方消息</header>
							<div class="panel-body" id="admindex_msg">
								<ul></ul>
							</div>
						</section>
					</div>
				</div>
				<div class="footer text-center">欢迎使用 &copy; <a href="http://www.emlog.net" target="_blank">emlog</a><?php doAction('adm_footer');?></div>
			</section>
		</section>
	</section>
	<aside class="aside-md bg-black hide" id="sidebar">
		<section class="vbox animated fadeInRight">
			<section class="scrollable">
				<?php if($comment): ?>
				<div class="wrapper"><strong>Comments list</strong></div>
				<ul class="list-group no-bg no-borders auto">
					<?php
						foreach($comment as $key=>$value):
							$ishide = $value['hide']=='y'?'<font color="red">[待审]</font>':'';
							$mail = !empty($value['mail']) ? "{$value['mail']}" : '';
							$ip = !empty($value['ip']) ? "{$value['ip']}" : '';
							$poster = !empty($value['url']) ? ''. $value['poster'].'' : $value['poster'];
							$value['content'] = str_replace('<br>',' ',$value['content']);
							$sub_content = subString($value['content'], 0, 50);
							$value['title'] = subString($value['title'], 0, 42);
					?>
					<li class="list-group-item">
						<div class="media">
							<span class="pull-left thumb-sm avatar"><img src="http://gravatar.duoshuo.com/avatar/<?php echo md5($mail);?>?s=40&d=mm&r=g" class="img-circle"></span>
							<div class="media-body">
								<div><a href="comment.php?action=edit_comment&amp;cid=<?php echo $value['cid']; ?>" title="<?php echo $ip?>"><?php echo $poster;?></a></div>
								<small class="text-muted"><?php echo $value['date']; ?></small>
							</div>
						</div>
					</li>
					<?php endforeach;?>
				</ul>
				<?php else:?>
				<div class="wrapper"><strong>尚未收到评论</strong></div>
				<?php endif;?>
			</section>
		</section>
	</aside>
</section>
<script>
$(document).ready(function(){
	$("#admindex_msg ul").html("<span class=\"ajax_remind_1\">正在读取...</span>");
	$.getJSON("<?php echo OFFICIAL_SERVICE_HOST;?>services/messenger.php?v=<?php echo Option::EMLOG_VERSION; ?>&callback=?",
	function(data){
		$("#admindex_msg ul").html("");
		$.each(data.items, function(i,item){
			var image = '';
			if (item.image != ''){
				image = "<a href=\""+item.url+"\" target=\"_blank\" title=\""+item.title+"\"><img src=\""+item.image+"\"></a><br />";
			}
			$("#admindex_msg ul").append("<li>"+image+"<span>"+item.date+"</span><a href=\""+item.url+"\" target=\"_blank\">"+item.title+"</a></li>");
		});
	});
	$("#menu_home").addClass('active');
});
$("#ckup").click(function(){
    $("#upmsg").html("正在检查，请稍后").addClass("ajaxload");
	$.getJSON("<?php echo OFFICIAL_SERVICE_HOST;?>services/check_update.php?ver=<?php echo Option::EMLOG_VERSION; ?>&callback=?",
    function(data){
        if (data.result.match("no")) {
            $("#upmsg").html("目前还没有适合您当前版本的更新！").removeClass();
        } else if(data.result.match("yes")) {
            $("#upmsg").html("有可用的emlog更新版本 "+data.ver+"，更新之前请您做好数据备份工作，<a id=\"doup\" href=\"javascript:doup('"+data.file+"','"+data.sql+"');\">现在更新</a>").removeClass();
        } else{
            $("#upmsg").html("检查失败，可能是网络问题").removeClass();
        }
    });
});
function doup(source,upsql){
    $("#upmsg").html("系统正在更新中，请耐心等待").addClass("ajaxload");
    $.get('./index.php?action=update&source='+source+"&upsql="+upsql,
      function(data){
        $("#upmsg").removeClass();
        if (data.match("succ")) {
            $("#upmsg").html('恭喜您！更新成功了，请<a href="./">刷新页面</a>开始体验新版emlog');
        } else if(data.match("error_down")){
            $("#upmsg").html('下载更新失败，可能是服务器网络问题');
        } else if(data.match("error_zip")){
            $("#upmsg").html('解压更新失败，可能是你的服务器空间不支持zip模块');
        } else if(data.match("error_dir")){
            $("#upmsg").html('更新失败，目录不可写');
        }else{
            $("#upmsg").html('更新失败');
        }
      });
}
</script>
<?php else:?>
<?php endif; ?>
