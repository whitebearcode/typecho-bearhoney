<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>

<footer>
<div class="container">
    <div class="pb-5">
      <div class="row g-2 g-lg-4 align-items-center">
        <div class="col-lg-6 text-center text-lg-start">
                 <p class="mb-0 copyright-text content"><?php _e('Powered by <a href="http://www.typecho.org">Typecho</a> & <a href="https://github.com/whitebearcode/typecho-bearhoney"> BearHoney</a>  '); ?></p></div>
                <div class="col-lg-6 text-center text-lg-end mb-0 copyright-text content">
               <?php echo General::Options('CustomizationFooterCode'); ?><br>
     <?php if (General::Options('PoliceBa')): ?><img  src="<?php $this->options->themeUrl('assets/images/beian.png');?>"><a href="http://www.beian.gov.cn/portal/registerSystemInfo?recordcode=<?php echo General::parseNumber(General::Options('PoliceBa')); ?>"><?php echo General::Options('PoliceBa'); ?></a><?php endif; ?><?php if (General::Options('IcpBa') && General::Options('PoliceBa')): ?>  | <?php endif; ?><?php if (General::Options('IcpBa')): ?><a href="https://beian.miit.gov.cn/"><?php echo General::Options('IcpBa'); ?></a><?php endif; ?>
        </div> 
        
      </div>
    </div>
  </div>
</footer>
<script src="<?php $this->options->themeUrl('assets/plugins/bootstrap/bootstrap.min.js'); ?>"></script>
<script src="<?php $this->options->themeUrl('assets/js/bearhoney.js'); ?>?v=<?php echo themeVersion(); ?>"></script>
<script src="<?php $this->options->themeUrl('assets/plugins/fancybox/fancybox.umd.min.js'); ?>"></script>
<script>
    $(document).ready(function(){
          Fancybox.bind('[data-fancybox="image"]', {
      groupAttr:false,
      Toolbar: {
    display: {
      left: ["infobar"],
      middle: [
        "zoomIn",
        "zoomOut",
        "toggle1to1",
        "rotateCCW",
        "rotateCW",
        "flipX",
        "flipY",
      ],
      right: ["slideshow", "thumbs", "close"],
    },
  },
  
  
});
    });
</script>
<?php echo General::Options('CustomizationFooterJsCode'); ?>
<?php $this->footer(); ?>
<script src="<?php $this->options->themeUrl('assets/plugins/instant.page/instantpage.min.js'); ?>"></script>
</body>
</html>
