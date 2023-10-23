<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>

    <?php if ($this->allow('comment') && !empty(General::Options('comment_url'))): ?>
       
 <div class="row">
            <div class="col-md-12 mx-auto text-center">
                <h4 class="section-title my-40">
                    评论区
                </h4>
            </div>
        </div>
        <div>

    <div id="twikoo_comment"></div>
<script src="<?php $this->options->themeUrl('assets/js/twikoo.all.min.js'); ?>"></script>
<script>
twikoo.init({
  envId: '<?php echo General::Options('comment_url');?>',
  el: '#twikoo_comment'
})
</script>
 </div>

  
    
    <?php endif; ?>