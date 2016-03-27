<?php
!defined('EMLOG_ROOT') && exit('access deined!');
//emLoadJQuery();外部加载了JQ了
$album = isset($_GET['album']) ? intval($_GET['album']) : '';
global $CACHE;
$navis = $CACHE->readCache('navi');
$kl_album_title = '';
$kl_album_hide = true;
foreach($navis as $navi){
	if($navi['url'] == '?plugin=kl_album' && $navi['isdefault'] == 'y'){
		$kl_album_title = $navi['naviname'];
		$kl_album_hide = false;
		break;
	}
}
$options_cache = $CACHE->readCache('options');
$kl_album_config = unserialize($options_cache['kl_album_config']);
$DB = MySql::getInstance();
$blogname = $options_cache['blogname'];
$bloginfo = $options_cache['bloginfo'];
$site_title = $options_cache['site_title'];
$site_description = $options_cache['site_description'];
$site_key = $options_cache['site_key'];
$comments = array('commentStacks'=>array(), 'commentPageUrl'=>'');
$ckname = $ckmail = $ckurl = $verifyCode = false;
$icp = $options_cache['icp'];
$footer_info = $options_cache['footer_info'];
$allow_remark = 'n';
$log_content = $log_title = $logid = $content_info = '';
$site_title = empty($kl_album_title) ? $site_title : $kl_album_title.' - '.$site_title;
$log_title = $kl_album_title;

$kl_album_info = $options_cache['kl_album_info'];
$kl_album_info = unserialize($kl_album_info);
if(is_array($kl_album_info)) krsort($kl_album_info);
if($kl_album_config !== false){
	if($kl_album_hide && !empty($kl_album_config['disabled']) && $kl_album_config['disabled'] == 'y') emMsg('不存在的页面！');
	if(!empty($kl_album_config['key'])) $site_key = $kl_album_config['key'];
	if(!empty($kl_album_config['description'])) $site_description = $kl_album_config['description'];
	//显示相册列表
	if($album === ''){
		if(empty($kl_album_info)){
			$log_content = "还没有创建相册！";
		}else{
			$query1 = $DB->query("select a.* from (select album, addtime, id from ".DB_PREFIX."kl_album order by album, addtime desc, id desc) a group by album");
			$new_str_arr = array();
			while($row1 = $DB->fetch_array($query1)){
				$new_str_arr[$row1['album']] = time() - $row1['addtime'] < 3600*24*15 ? ' background:url(./content/plugins/kl_album/images/new.gif) no-repeat;' : '';
			}
			$log_content .=	'<div id="album"><ul>';
			foreach ($kl_album_info as $val){
				if($val['name'] == '') continue;
				if(ROLE != 'admin'){
					if($val['restrict'] == 'private') continue;
				}
				if($val['restrict'] == 'private'){
					$coverPath = '../content/plugins/kl_album/images/only_me.jpg';
				}else{
					if(isset($val['head']) && $val['head'] != 0){
						$iquery = $DB->query("SELECT * FROM ".DB_PREFIX."kl_album WHERE id={$val['head']}");
						if($DB->num_rows($iquery) > 0){
							$irow = $DB->fetch_row($iquery);
							$coverPath = substr($irow[2], strpos($irow[2], 'upload/'), strlen($irow[2])-strpos($irow[2], 'upload/'));
						}else{
							$coverPath = '../content/plugins/kl_album/images/no_cover_s.jpg';
						}
					}else{
						$iquery = $DB->query("SELECT * FROM ".DB_PREFIX."kl_album WHERE album={$val['addtime']}");
						if($DB->num_rows($iquery) > 0){
							$irow = $DB->fetch_array($iquery);
							$coverPath = substr($irow['filename'], strpos($irow['filename'], 'upload/'), strlen($irow['filename'])-strpos($irow['filename'], 'upload/'));
						}else{
							$coverPath = '../content/plugins/kl_album/images/no_cover_s.jpg';
						}
					}
				}
				$log_content .=	'
<li>
<p class="cover"><a href="./?plugin=kl_album&album='.$val['addtime'].'" title="创建日期：'.$val['description'].'" style="background:url('.$coverPath.') 50% 50% no-repeat" target="_blank"></a></p>
<p class="title"><a href="./?plugin=kl_album&album='.$val['addtime'].'" title="创建日期：'.$val['description'].'" target="_blank">'.$val['name'].'</a></p>
</table>
<p class="new" style="'.$new_str_arr[$val['addtime']].'"></p>
<style type="text/css">#sidebar{display:none}</style>
<style type="text/css">#content{border-right:0px}</style>
</li>';
			}
			$log_content .=	'</ul></div>';
		}

		$allow_remark = 'n';
		$logid = '';

		include View::getView('header');
		include View::getView('page-photo');
	}
	//显示单个相册里的照片
	if($album !== ''){
		$log_title = '';
		$exist_album = false;
		if(is_array($kl_album_info)){
			foreach ($kl_album_info as $val){
				if($val['addtime'] == $album){
					$albumrestrict = $val['restrict'];
					$albumname = $val['name'];
					$albumpwd = isset($val['pwd']) ? $val['pwd'] : '';
					$exist_album = true;
				}
			}
			if($exist_album === false || ($albumrestrict == 'private' && ROLE != 'admin')){
				$log_content .= '不存在的相册';
			}else{
				if($albumrestrict == 'protect' && ROLE != 'admin'){
					$postpwd = isset($_POST['albumpwd']) ? addslashes(trim($_POST['albumpwd'])) : '';
					$cookiepwd = isset($_COOKIE['kl_albumpwd_'.$album]) ? addslashes(trim($_COOKIE['kl_albumpwd_'.$album])) : '';
					kl_album_AuthPassword($postpwd, $cookiepwd, $albumpwd, $album, BLOG_URL.'?plugin=kl_album', 'kl_albumpwd_');
				}
				$kl_album = Option::get('kl_album_'.$album);
				if(is_null($kl_album)){
					$condition = " and album={$album} order by id desc";
				}else{
					$idStr = empty($kl_album) ? 0 : $kl_album;
					$condition = " and id in({$idStr}) order by substring_index('{$idStr}', id, 1)";
				}
				$query = $DB->query("SELECT * FROM ".DB_PREFIX."kl_album WHERE 1 {$condition}");
				$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
				$page_all_no = $DB->num_rows($query);
				$page_num = isset($kl_album_config['num_rows']) ? $kl_album_config['num_rows'] : 20;
				$pageurl =  pagination($page_all_no, $page_num, $page, './?plugin=kl_album&album='.$album.'&page=');
				$start_num = !empty($page) ? ($page - 1) * $page_num : 0;
				$query = $DB->query("SELECT * FROM ".DB_PREFIX."kl_album WHERE 1 {$condition} LIMIT $start_num, $page_num");
				$photos = array();
				$log_content .= '
<div style="margin-bottom:-10px"><h2 class="post-name"><a href="./?plugin=kl_album" pjax="相册"><i class="fa fa-arrow-circle-o-left"></i>返回相册列表</a></h2></div>
<div id="photolist">
<style type="text/css">#sidebar{display:none}</style>
<style type="text/css">#content{border-right:0px}</style>
<style type="text/css">#content{width:100%}</style>
<center><img src="../content/plugins/kl_album/images/loading.gif" style="width:16px; height:16px" /><br />正在用吃奶的力气预加载所有图片...<br />（Ps.保证每张图片100%可正常查看）</center>';
				while($photo = $DB->fetch_array($query)){
					$log_content .=	'
<div class="cell" style="margin-top:15px">
<a href="'.str_replace('thum-', '', substr($photo['filename'], 1, strlen($photo['filename']))).'" target="_blank" title="相片描述：明月浩空博客 '.$photo['truename'].'&#13;上传日期：'.$photo['description'].'">
<img src="'.substr($photo['filename'], 1, strlen($photo['filename'])).'" /><br />'.$photo['truename'].'</a>
</div>';
				}
				$log_content .= '</div><div style="margin-left:40px;" class="pagenavi">'.$pageurl.'<span>(共有 '.$page_all_no.' 张相片)</span></div>';
			}
		}else{
			$log_content .= '参数错误。';
		}

		$allow_remark = 'n';
		$logid = '';

		addAction('index_head', 'kl_album_show_js');

		include View::getView('header');
		include View::getView('page-photo1');
	}
}else{
	emMsg('不存在的页面！');
}

function kl_album_show_js(){
	$active_plugins = Option::get('active_plugins');
	echo '<script src="../content/plugins/kl_album/js/lazyload.js" type="text/javascript"></script>
<script src="../content/plugins/kl_album/js/waterfall.js" type="text/javascript"></script>
';
}
?>