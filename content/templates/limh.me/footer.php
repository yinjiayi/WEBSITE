<?php
if (!defined('EMLOG_ROOT')) {
    exit('error!');
}
?>
</div>

<div class="clear"></div>
<div class="blackground"></div>
<div title="返回顶部(或任意位置双击左键)" class="backtop"></div>
<nav id="mmenu" role="navigation">
  <ul>
    <li>
      <div class="msearch">
        <form name="keyform" method="get" action="<?php echo BLOG_URL; ?>index.php">
          <input type="text" name="keyword" placeholder="搜搜" />
          <input type="submit" name="submit" value="搜索" />
        </form>
      </div>
    </li>
    <?php blog_navi();?>
  </ul>
</nav>
</div>
<footer id="footer" role="contentinfo">
  <address>
  <i class="fa fa-html5"></i> Copyright&nbsp;©&nbsp;2010-<?php echo date('Y',time())?>&nbsp;<?php echo $blogname; ?>
  <div class="copyright">&nbsp;|&nbsp;勉强运行：<?php echo floor((time()-strtotime(""._g('webtime').""))/86400); ?>天&nbsp;|&nbsp;<a href="http://www.miibeian.gov.cn" target="_blank"><?php echo $icp; ?></a>&nbsp;|&nbsp;<?php echo $footer_info; ?>
    <?php doAction('index_footer'); ?>
    &nbsp;|&nbsp;采用 <a href="http://www.yinjiayi.net" title="Emlog <?php echo Option::EMLOG_VERSION;?>" target="_blank">Emlog+Bootstrap <?php echo Option::EMLOG_VERSION;?></a>&nbsp;驱动&nbsp;|&nbsp;<?php echo strtoupper(runtime_display()); ?>&nbsp;|&nbsp;</div>
  </address>
</footer>
<div id="totop" class="totop"><i class="fa">&#61610;</i></div>
<div class="colorful_loading_frame">
  <div class="colorful_loading"><i class="rect1"></i><i class="rect2"></i><i class="rect3"></i><i class="rect4"></i><i class="rect5"></i></div>
</div>
</div>
<?php
$bgimgsrc = TEMPLATE_URL . 'images/bg/' . rand(1, 3) . '.jpg' ?>
<img class="bg-image" src="<?php echo $bgimgsrc; ?>" /><div class="bg-image-pattern"></div>
<script type="text/javascript">blogname="<?php echo $blogname; ?>";</script>
<?php if(_g('pjax')==1):?>
<script type="text/javascript" src="<?php echo TEMPLATE_URL; ?>js/global-pjax.js?v=20151004"></script>
<?php else: ?>
<script type="text/javascript" src="<?php echo TEMPLATE_URL; ?>js/global.js?v=20151004"></script>
<?php endif;?>
<script type="text/javascript" src="<?php echo TEMPLATE_URL; ?>js/realgravatar.js"></script>
<script type="text/javascript" src="<?php echo TEMPLATE_URL; ?>style/highslide/highslide.js?v=20150310"></script>
<link rel="stylesheet" type="text/css" href="<?php echo TEMPLATE_URL; ?>style/highslide/highslide.css?v=20141026" />
<?php doAction('myhk_player'); ?>
<?php doAction('index_bodys');//博客底部特殊挂载 ?>
</body></html>