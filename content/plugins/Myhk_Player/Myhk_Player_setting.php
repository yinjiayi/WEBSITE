<?php
header("Content-Type: text/html; charset=utf8");
!defined('EMLOG_ROOT') && exit('access deined!');
function plugin_setting_view(){
require_once 'Myhk_Player_config.php';
$file = 'http://free.limh.me/my/url.txt';
$content = file_get_contents($file);
$start3 = strpos($content, "E=", 0);
$end3   = strpos($content, "F", $start3);
$banben = substr($content, $start3+2, $end3-$start3-2);
$start4 = strpos($content, "F=", 0);
$end4   = strpos($content, "G", $start4);
$xiazai = substr($content, $start4+2, $end4-$start4-2);
?>
	<link href="/content/plugins/Myhk_Player/style/style.css" type="text/css" rel="stylesheet" />
	<div class="com-hd">
		<b><img src="/content/plugins/Myhk_Player/style/logo.png" align="middle" style="margin-top:-10px"/> <a href="http://free.limh.me" target="_blank">明月浩空音乐播放器</a> V.20150913</b>
		<?php
		if(isset($_GET['setting'])){
			echo "<span class='actived'>设置保存成功!</span>";
		}
		?>
	</div>
	<form action="plugin.php?plugin=Myhk_Player&action=setting" method="post">
		<table class="tb-set">
			<tr>
				<td align="right" width="50%"><b>版本更新：</b><br />(检测播放器版本更新)</td>
				<td width="50%"><?php
		if($banben=='20150913'){
			echo '当前版本：<span class="sel">20150913</span> 暂无更新！';
		}else{
			echo '当前版本：<span class="sel">20150913</span></br></br>最新版本：<span class="sel"><a style="color:#f00" href="http://free.limh.me/update_'.$banben.'.html" title="点击查看'.$banben.'版本更新日志" target="_blank">'.$banben.'</a></span> 请<a title="点击下载播放器插件'.$banben.'版本" href="'.$xiazai.'" target="_blank">[点击这里]</a>下载';
		}
		?></td>
			</tr>
			<tr>
				<td align="right"><b>加载jQuery：</b><br />(当模板未加载jQuery导致左侧播放器开关点不动时开启)</td>
				<td><span class="sel"><select name="jquery"><option value="open" <?php if($config["jquery"]=="open") echo "selected"; ?>>开启</option><option value="close" <?php if($config["jquery"]=="close") echo "selected"; ?>>关闭</option></select></span></td>
			</tr>
			<tr>
				<td align="right"><b>free.limh.me用户名：</b><br />(填写<b>歌单后台显示的绑定域名</b>，也就是你的网址)</td>
				<td><input type="text" class="txt" name="user_id" value="<?php echo $config["user_id"]; ?>" /></td>
			</tr>
			<tr>
				<td align="right"><b>free.limh.me密码：</b><br />(填写歌单后台登陆密码，<b>仅后台显示用于备忘</b>)</td>
				<td><input type="text" class="txt" name="user_psd" value="<?php echo $config["user_psd"]; ?>" /></td>
			</tr>
			<tr>
				<td align="right"><b>free.limh.me激活码：</b><br />(填写<b>歌单后台显示的激活码</b>，用于播放器检测授权)</td>
				<td><input type="text" class="txt" name="user_key" value="<?php echo $config["user_key"]; ?>" /></td>
			</tr>
			<tr>
				<td align="right"><b>网站名称：</b><br />(填写你的网站名称，用于播放器界面显示)</td>
				<td><input type="text" class="txt" name="user_name" value="<?php echo $config["user_name"]; ?>" /></td>
			</tr>
			<tr>
				<td align="right"><b>后台地址：</b><br />(播放器歌单后台管理地址)</td>
				<td><b>免费版后台：<a href="http://free.limh.me" target="_blank">http://free.limh.me</b></a> 商业版购买请联系 <a href="http://wpa.qq.com/msgrd?v=3&uin=6354321&site=qq&menu=yes" target="_blank">QQ：6354321</a></td>
			</tr>
			<tr>
				<td align="right"></td>
				<td><input type="submit" name="submit" value="保存设置" /></td>
			</tr>
		</table>
	</form>
	<?php
}
function plugin_setting(){
	require_once 'Myhk_Player_config.php';
	$jquery = $_POST["jquery"]==""?"close":$_POST["jquery"];
	$user_psd = $_POST["user_psd"]==""?"123456":$_POST["user_psd"];
	$user_id = $_POST["user_id"]==""?"limh.me":$_POST["user_id"];
	$user_name = $_POST["user_name"]==""?"明月浩空博客":$_POST["user_name"];
	$user_key = $_POST["user_key"]==""?"QQ:6354321":$_POST["user_key"];
	$newConfig = '<?php
$config = array(
	"jquery" => "'.$jquery.'",
	"user_id" => "'.str_replace(array("\r\n", "\r", " ", "\n"), "", $user_id).'",
	"user_psd" => "'.$user_psd.'",
	"user_key" => "'.str_replace(array("\r\n", "\r", " ", "\n"), "", $user_key).'",
	"user_name" => "'.str_replace(array("\r\n", "\r", "\n"), "", $user_name).'"
);';
	echo $newConfig;
	@file_put_contents(EMLOG_ROOT.'/content/plugins/Myhk_Player/Myhk_Player_config.php', $newConfig);
}
?>