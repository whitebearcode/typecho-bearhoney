<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<footer class="honey_footer">
    <?php if (General::Options('ShowWaves') == true): ?>
    
    <svg class="honey_waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
			<defs>
				<path id="honey-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
			</defs>
			<g class="honey_parallax">
				<use xlink:href="#honey-wave" x="48" y="0" fill="rgba(255,255,255,0.7)" />
				<use xlink:href="#honey-wave" x="48" y="2" fill="rgba(255,255,255,0.5)" />
				<use xlink:href="#honey-wave" x="48" y="4" fill="rgba(255,255,255,0.3)" />
				<use xlink:href="#honey-wave" x="48" y="6"  class="honey_parallax_end" />
			</g>
		</svg>
		<?php endif; ?>
<div class="w-100 mt-5 honey_border_top py-5">
<div class="container">
    <div class="row g-2 g-lg-4 align-items-center">
        <div class="col-lg-6 text-center text-lg-start">
                 <p class="mb-0 copyright-text content"><?php _e('Powered by <a href="http://www.typecho.org">Typecho</a> & <a href="https://github.com/whitebearcode/typecho-bearhoney"> BearHoney</a>  '); ?></p></div>
                <div class="col-lg-6 text-center text-lg-end mb-0 copyright-text content">
               <p class="mb-0 copyright-text content"><?php echo General::Options('CustomizationFooterCode'); ?></p>
     <?php if (General::Options('IcpBa')): ?><img width=20 height=20 style="margin-top:14px" src="<?php $this->options->themeUrl('assets/images/icpba.svg');?>"> <a href="https://beian.miit.gov.cn/"><?php echo General::Options('IcpBa'); ?></a><?php endif; ?><br><?php if (General::Options('PoliceBa')): ?><img width=20 height=20 style="margin-top:15px" src="<?php $this->options->themeUrl('assets/images/policeba.svg');?>"> <a href="http://www.beian.gov.cn/portal/registerSystemInfo?recordcode=<?php echo General::parseNumber(General::Options('PoliceBa')); ?>"><?php echo General::Options('PoliceBa'); ?></a><?php endif; ?>
        </div> 
        
      </div>
    </div>
    
    

</div>
</div>
</footer>
<script src="<?php $this->options->themeUrl('assets/plugins/bootstrap/bootstrap.min.js'); ?>?v=<?php echo themeVersion(); ?>"></script>
<script src="<?php $this->options->themeUrl('assets/js/bearhoney.js'); ?>?v=<?php echo themeVersion(); ?>"></script>
<script src="<?php $this->options->themeUrl('assets/plugins/fancybox/fancybox.umd.min.js'); ?>"></script>
<script>

    $(document).ready(function(){
       $('.color-scheme-toggler').on('click',function(){
           var e = localStorage.getItem('theme'),d=document.documentElement,c=d.classList;
           if(e == 'light'){
               c.remove('light');
               c.add('dark');
               localStorage.setItem('theme','dark');
           }
           else if(e == 'dark'){
           c.remove('dark');
               c.add('light');
               localStorage.setItem('theme','light');
           }
           else{
               c.add('dark');   
               localStorage.setItem('theme','dark');
           }
       })
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
