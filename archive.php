<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>

<div class="banner-section section-bg-two">
    <div class="container-fluid"> 
        <div class="row banner-content">
                
                <div class="col-xl-12 col-md-12 align-self-center">
                <div class="tags-content maxw-800">
                    
                    <h3 class="post-title"><?php $this->archiveTitle(array(
            'category'  =>  _t('%s'),
            'search'    =>  _t('%s'),
            'tag'       =>  _t('%s'),
            'author'    =>  _t('%s')
        ), '', ''); ?></h3>
                    <p class="text-yellow">
                        <span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg></span><font style="vertical-align:middle"> <?php $this->archiveTitle([
            'category' => _t('该分类下共有'),
            'search'   => _t('根据该关键词共搜索到'),
            'tag'      => _t('该标签下共有'),
            'author'   => _t('该作者共发表了')
        ], '', ''); ?> <?php echo $this->getTotal();?> 篇文章</font>
                    </p>
                        <?php if($this->is('category') && $this->getDescription() !== null):?><p><?php echo $this->getDescription(); ?></p><?php endif;?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="blog-post-masonary-section py-70">
    <div class="container-fluid">
      
        <div class="row">
            <div class="col-md-12">
                    <?php if($this->have()): ?>
                    <div class="blog-post-masonary-card">
        <?php while ($this->next()): ?>
           
<div class="single-blog-post-card post tag-sports tag-technology">
    <div class="single-blog-item">
        <div class="blog-thumb">
            
                <div class="visibility-badge">
</div>
        </div>
        <div class="blog-content featured-icons">
            <div class="post-date d-flex align-items-center justify-content-between">
                <bh><?php $this->category('</bh><bh style="display:none">'); ?></bh>
                <span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg> <font style="vertical-align:middle"><?php echo General::publishTime($this->created);?></font></span>
            </div>
            <h5 class="blog-title"><a class="global-underline" href="<?php $this->permalink() ?>"><?php $this->title() ?></a></h5>
                <p class="mb-0 line-clamp"><?php if($this->fields->excerpt):?><?php echo $this->fields->excerpt;?><?php else:?><?php echo General::filterExpert($this->excerpt);?><?php endif; ?></p>
        </div>
    </div>
</div>
     <?php endwhile; ?>
     </div>
          <?php else:?><div class="row h4 justify-content-center align-items-center">
<svg height="200" node-id="1" sillyvg="true" template-height="1024" template-width="1024" version="1.1" viewBox="0 0 1024 1024" width="200" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><defs node-id="39"><linearGradient gradientUnits="objectBoundingBox" id="linearGradient-1" node-id="5" spreadMethod="pad" x1="0.75774837" x2="0.26300043" y1="0.89788246" y2="0.06672812"><stop offset="0" stop-color="#dce2ec"></stop><stop offset="1" stop-color="#eef1f5"></stop></linearGradient><linearGradient gradientUnits="objectBoundingBox" id="linearGradient-2" node-id="8" spreadMethod="pad" x1="0.2833117" x2="0.47835723" y1="0.5" y2="0.15123942"><stop offset="0" stop-color="#dce2ec" stop-opacity="0"></stop><stop offset="1" stop-color="#dce2ec"></stop></linearGradient><linearGradient gradientUnits="objectBoundingBox" id="linearGradient-3" node-id="11" spreadMethod="pad" x1="0.52506536" x2="0.5369437" y1="0.8267667" y2="0.1585097"><stop offset="0" stop-color="#dce0e9"></stop><stop offset="1" stop-color="#dce0e9"></stop></linearGradient><linearGradient gradientUnits="objectBoundingBox" id="linearGradient-4" node-id="14" spreadMethod="pad" x1="1.1537404" x2="-0.101114154" y1="0.5805712" y2="0.41226244"><stop offset="0" stop-color="#f0f4f8"></stop><stop offset="1" stop-color="#dee4ed"></stop></linearGradient><linearGradient gradientUnits="objectBoundingBox" id="linearGradient-5" node-id="17" spreadMethod="pad" x1="0.110735975" x2="0.9418903" y1="0.62347084" y2="0.3693628"><stop offset="0" stop-color="#f0f4f8"></stop><stop offset="1" stop-color="#dee4ed"></stop></linearGradient></defs><g node-id="70"><path d="M 412.00 412.00 L 612.00 412.00 L 612.00 612.00 L 412.00 612.00 Z" fill="none" group-id="1" id="bg" node-id="22" stroke="none" target-height="200" target-width="200" target-x="412" target-y="412"></path><g node-id="71"><path d="M 412.00 412.00 L 612.00 412.00 L 612.00 612.00 L 412.00 612.00 Z" fill="none" group-id="1,2" id="矩形" node-id="24" stroke="none" target-height="200" target-width="200" target-x="412" target-y="412"></path><g node-id="72"><path d="M 209.60 758.40 L 512.00 664.01 L 512.00 282.80 L 209.60 370.51 Z" fill="#ced3de" fill-rule="nonzero" group-id="1,2,3" id="Path" node-id="26" stroke="none" target-height="475.60004" target-width="302.4" target-x="209.6" target-y="282.8"></path><g node-id="73"><path d="M 814.40 758.40 L 512.00 664.01 L 512.00 282.80 L 814.40 370.51 Z" fill="#6d7c9a" fill-opacity="0.4" fill-rule="nonzero" group-id="1,2,3,4" id="Path" node-id="27" stroke="none" target-height="475.60004" target-width="302.40002" target-x="512" target-y="282.8"></path></g><path d="M 213.24 750.41 L 509.83 656.44 L 509.83 281.95 L 213.24 364.24 Z" fill="#ced3dc" fill-rule="nonzero" group-id="1,2,3" id="Path" node-id="28" stroke="none" target-height="468.45996" target-width="296.58997" target-x="213.24" target-y="281.95"></path><path d="M 806.43 750.41 L 509.83 656.44 L 509.83 281.95 L 806.43 364.24 Z" fill="#d8dce3" fill-rule="nonzero" group-id="1,2,3" id="Path" node-id="29" stroke="none" target-height="468.45996" target-width="296.6" target-x="509.83" target-y="281.95"></path><path d="M 512.00 848.00 L 209.60 753.52 L 209.60 366.40 L 512.00 460.88 Z" fill="url(#linearGradient-1)" fill-rule="nonzero" group-id="1,2,3" id="Path" node-id="30" stroke="none" target-height="481.6" target-width="302.4" target-x="209.6" target-y="366.4"></path><path d="M 512.00 848.00 L 814.40 753.52 L 814.40 366.40 L 512.00 460.88 Z" fill="url(#linearGradient-1)" fill-rule="nonzero" group-id="1,2,3" id="Path" node-id="31" stroke="none" target-height="481.6" target-width="302.40002" target-x="512" target-y="366.4"></path><path d="M 443.48 780.80 L 209.60 754.53 L 209.60 366.40 L 512.00 461.12 Z" fill="url(#linearGradient-2)" fill-opacity="0.09" fill-rule="nonzero" group-id="1,2,3,5" id="Path" node-id="32" stroke="none" target-height="414.4" target-width="302.4" target-x="209.6" target-y="366.4"></path><path d="M 580.52 717.01 L 814.40 758.40 L 814.40 377.60 L 512.00 470.53 Z" fill="url(#linearGradient-3)" fill-opacity="0.2" fill-rule="nonzero" group-id="1,2,3,6" id="Path" node-id="33" stroke="none" target-height="380.80002" target-width="302.40002" target-x="512" target-y="377.6"></path><path d="M 512.00 283.00 L 370.34 176.00 L 64.00 280.07 L 210.70 377.60 Z" fill="url(#linearGradient-4)" fill-rule="nonzero" group-id="1,2,3" id="Path" node-id="34" stroke="none" target-height="201.6" target-width="448" target-x="64" target-y="176"></path><path d="M 512.00 283.00 L 653.66 176.00 L 960.00 280.07 L 813.30 377.60 Z" fill="url(#linearGradient-5)" fill-rule="nonzero" group-id="1,2,3" id="Path" node-id="35" stroke="none" target-height="201.6" target-width="448" target-x="512" target-y="176"></path><path d="M 210.70 366.40 L 512.00 460.92 L 361.70 556.80 L 64.00 458.01 Z" fill="#f4f8fd" fill-rule="nonzero" group-id="1,2,3" id="Path" node-id="36" stroke="none" target-height="190.4" target-width="448" target-x="64" target-y="366.4"></path><path d="M 813.30 366.40 L 512.00 460.92 L 662.29 556.80 L 960.00 458.01 Z" fill="#f2f6fa" fill-rule="nonzero" group-id="1,2,3" id="Path" node-id="37" stroke="none" target-height="190.4" target-width="448" target-x="512" target-y="366.4"></path></g></g></g></svg>
啊哦~暂无最新文章</div>
             <?php endif;?>
           
            </div>
        </div>
        <div class="row mt-20 loadmore-section">
            <div class="col-md-8 mx-auto text-center">
                <div class="read-more-btn">
                    <div style="display:none">
                    <?php $this->pageLink('下一页','next'); ?>
        </div>
                    <button class="btn btn-yellow load-more-posts">加载更多</button>
                </div>
            </div>
        </div>
    </div>
</div>
     
 
   

<?php $this->need('footer.php'); ?>
