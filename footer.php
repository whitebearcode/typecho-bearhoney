<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>

<div class="overlay-content">
    <div class="search-area search-overly  d-flex justify-content-center aligh-items-center flex-column">
        <div class="container">
            <div class="search-input-area d-flex align-items-center">
                <input type="text" id="search-input" class="form-control" placeholder="输入您想要搜索的内容">
                <small class="esc">可按 ESC 键退出搜索</small>
                <span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg></span>
                <div class="bar-dismiss"><span class="close-icons"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 130.2 130.2">
  <line class="path line" fill="none" stroke="#ffffff" stroke-width="6" stroke-linecap="round" stroke-miterlimit="10" x1="34.4" y1="37.9" x2="95.8" y2="92.3"/>
  <line class="path line" fill="none" stroke="#ffffff" stroke-width="6" stroke-linecap="round" stroke-miterlimit="10" x1="95.8" y1="38" x2="34.4" y2="92.2"/>
</svg></span></div>

                <!-- 搜索结果 -->
                <div class="search-result">
                    <div class="custom">
                        <h2 class="no-result"><span>0</span> 篇文章已搜寻到~</h2>
                        <div id="search-full-content">
                            
                    
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="footer-area py-50">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="footer-widget row d-flex align-items-center justify-content-between flex-wrap">
                            <div class="bcopyright" style="margin:0 auto;text-align: center">
                        &copy; <?php echo date("Y");?> <a href="<?php $this->options->siteUrl();?>"><strong><?php $this->options->title();?></strong></a> All right Reserved.  <br>
                        <?php _e('Powered by <a href="http://www.typecho.org"> <strong>Typecho</strong></a> & <a href="https://github.com/whitebearcode/typecho-bearhoney"> <strong>BearHoney</strong></a> '); ?>
              <?php if (General::Options('IcpBa')): ?><br><img width=20 height=20 style="vertical-align: -3px;" src="<?php $this->options->themeUrl('assets/images/icpba.svg');?>"> <a href="https://beian.miit.gov.cn/"><?php echo General::Options('IcpBa'); ?></a><?php endif; ?> <?php if (General::Options('PoliceBa')): ?><img width=20 height=20 style="vertical-align: -3px" src="<?php $this->options->themeUrl('assets/images/policeba.svg');?>"> <a href="http://www.beian.gov.cn/portal/registerSystemInfo?recordcode=<?php echo General::parseNumber(General::Options('PoliceBa')); ?>"><?php echo General::Options('PoliceBa'); ?></a><?php endif; ?>
                      <br/><?php echo General::Options('CustomizationFooterCode'); ?>
                 </div>
                
               </div>
            </div>
        </div>
    </div>
</div>


</div>

<script src="<?php $this->options->themeUrl('assets/js/bearhoney.js'); ?>"></script>
<script src="<?php $this->options->themeUrl('assets/js/bearhoney_single.js'); ?>"></script>
<script defer src="<?php $this->options->themeUrl('assets/js/bearhoneycards.min.js'); ?>"></script>
<script src="//lib.baomitu.com/fancyapps-ui/5.0.29/fancybox/fancybox.umd.min.js"></script>
<script src="<?php $this->options->themeUrl('assets/plugins/toastr/toastr.min.js'); ?>"></script>


<script>
Fancybox.bind('[data-fancybox]');
    const typecho_notice_type = '<?php echo htmlspecialchars_decode(\Typecho\Cookie::get('__typecho_notice_type'));?>';
    const typecho_notice = '<?php echo ltrim(rtrim(htmlspecialchars_decode(\Typecho\Cookie::get('__typecho_notice')),'"]'),'["');?>';
    if(typecho_notice){
        if(typecho_notice_type == 'error'){
        toastr.error(typecho_notice);
        }
        else{
        toastr.success(typecho_notice);    
        }
    }
    <?php \Typecho\Cookie::delete('__typecho_notice');?>

  <?php if(!$this->is('single')):?>
          var moreArticle = "加载更多",
            noPostFound = "没有更多结果",
            loadingText = "正在加载...",
            pagination_next_page_number = '2',
            pagination_available_pages_number = '<?php echo ceil($this->getTotal() / $this->parameter->pageSize); ?>';
			place ='<?php if($this->is('index')):?>index<?php else:?>other<?php endif;?>';
      <?php endif;?>
            
    </script>
    <?php echo General::Options('CustomizationFooterJsCode'); ?>
<?php $this->footer(); ?>
</body>
</html>