<?php
 /**
 * Plugin Name: 明月浩空音乐播放器免费版
 * Version: 20150913
 * Plugin URL: http://limh.me
 * Description: 基于虾米音乐、网易云音乐歌曲ID全自动解析的Html5音乐播放器
 * Author: 明月浩空
 * Author Email: admin@limh.me
 * Author URL: http://limh.me
 */
!defined('EMLOG_ROOT') && exit('access deined!');

function Myhk_Player_load(){
	require_once 'Myhk_Player_config.php';
	echo '<link rel="stylesheet" href="'.BLOG_URL.'content/plugins/Myhk_Player/style/player.css?v=20150913">'."\n";
	echo '<link href="http://libs.baidu.com/fontawesome/4.2.0/css/font-awesome.css" rel="stylesheet" type="text/css" />'."\n";
?>
<?php if($config['jquery']=='open'):?>
<script language="javascript" src="<?php echo BLOG_URL;?>include/lib/js/jquery/jquery-1.7.1.js"></script>
<?php endif;?>
<script type="text/javascript">name="<?php echo $config['user_name'] ?>";domain="<?php echo $config['user_id'] ?>";key="<?php echo $config['user_key'] ?>";</script>
<?php
}

function Myhk_Player_list(){
?>
<div id="wenkmPlayer">
	<div class="player">
		<div class="infos">
			<div class="songstyle"><i class="fa fa-music"></i> <span class="song"></span></div>
            <div class="timestyle"><i class="fa fa-clock-o"></i> <span class="time">00:00 / 00:00</span></div>
			<div class="artiststyle"><i class="fa fa-user"></i> <span class="artist"></span><span class="moshi"><i class="loop fa fa-random current"></i> 随机播放</span></div>
            <div class="artiststyle"><i class="fa fa-folder"></i> <span class="artist1"></span><span class="geci"></span></div>
		</div>
		<div class="control">
			<i class="loop fa fa-retweet" title="顺序播放"></i>
			<i class="prev fa fa-backward" title="上一首"></i>
			<div class="status">
				<b>
					<i class="play fa fa-play" title="播放"></i>
					<i class="pause fa fa-pause" title="暂停"></i>
				</b>
			</div>
			<i class="next fa fa-forward" title="下一首"></i>
			<i class="random fa fa-random current" title="随机播放"></i>
		</div>
		<div class="musicbottom">
			<div class="volume">
				<i class="mute fa fa-volume-off"></i>
				<i class="volumeup fa fa-volume-up"></i>
				<div class="progress">
					<div class="volume-on ts5">
						<div class="drag" title="音量"></div>
					</div>
				</div>
			</div>
			<div class="switch-playlist">
				<i class="fa fa-bars" title="播放列表"></i>
			</div>
            <div class="switch-ksclrc">
				<i class="fa fa-toggle-on" title="关闭歌词"></i>
			</div>
			<div class="switch-default">
				<i class="fa fa-refresh" title="切换默认专辑"></i>
			</div>
		</div>
		<div class="cover"></div>
	</div>
	<div class="playlist">
		<div class="playlist-bd">
			<div class="album-list">
				<div class="musicheader"></div>
					<div class="list"></div>
			</div>
			<div class="song-list">
				<div class="musicheader"><span></span></div>
			<div class="list"><ul></ul></div>
			</div>
		</div>
	</div>
	<div class="switch-player">
		<i class="fa fa-angle-right" style="margin-top: 20px;"></i>
	</div>
</div>
<div id="wenkmTips"></div>
<div id="wenkmLrc"></div>
<div class="myhk_pjax_loading_frame"></div>
<div class="myhk_pjax_loading"></div>
<script language="javascript" src="<?php echo BLOG_URL;?>content/plugins/Myhk_Player/js/mousewheel.js"></script>
<script language="javascript" src="<?php echo BLOG_URL;?>content/plugins/Myhk_Player/js/scrollbar.js"></script>
<script language="javascript" src="<?php echo BLOG_URL;?>content/plugins/Myhk_Player/js/player.js?v=20150913"></script>
<?php
}

function Myhk_Player_menu() {
	echo '<div class="sidebarsubmenu" id="Myhk_Player"><a href="./plugin.php?plugin=Myhk_Player"><img src="'.BLOG_URL.'content/plugins/Myhk_Player/style/logo.png" align="middle" style="margin-top:-10px"/>明月浩空音乐</a></div>';
}
addAction('index_head', 'Myhk_Player_load');
addAction('myhk_player', 'Myhk_Player_list');
addAction('adm_sidebar_ext', 'Myhk_Player_menu');