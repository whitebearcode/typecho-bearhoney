<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>

    <?php if ($this->allow('comment') && !empty(General::Options('comment_url'))): ?>
       
  <div class="single-post-similer">
      <div class="row justify-content-center">
        <div class="col-lg-12">
  <div class="text-center">
            <h2 class="section-title">
              <span>评论区</span>
            </h2>
          </div>
              
    <div id="twikoo_comment"></div>
<script src="<?php $this->options->themeUrl('assets/js/twikoo.all.min.js'); ?>"></script>
<script>
twikoo.init({
  envId: '<?php echo General::Options('comment_url');?>',
  el: '#twikoo_comment'
})
</script>
 </div>
  </div>
  </div>
  
    
    <?php endif; ?>