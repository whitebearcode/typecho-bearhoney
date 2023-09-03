<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>

<section class="page-header section-sm">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
      
        <h1 class="section-title h2 mb-3">
          <span><?php $this->archiveTitle([
            'category' => _t('分类 - %s'),
            'search'   => _t('搜索 - %s'),
            'tag'      => _t('标签 - %s'),
            'author'   => _t('作者 - %s')
        ], '', ''); ?></span>
        </h1>
          <?php if($this->is('category') && $this->getDescription() !== null):?><p class="mb-2"><?php echo $this->getDescription();?></p><?php endif; ?>
        <ul class="list-inline breadcrumb-menu mb-3">
          <li class="list-inline-item"><a href="<?php $this->options->siteUrl(); ?>"><i class="ti ti-home"></i>  <span>首页</span></a></li>
          <li class="list-inline-item">• &nbsp; <a><span><?php $this->archiveTitle([
            'category' => _t('分类'),
            'search'   => _t('搜索'),
            'tag'      => _t('标签'),
            'author'   => _t('作者')
        ], '', ''); ?></span></a></li>
          <li class="list-inline-item">• &nbsp; <a><span><?php $this->archiveTitle([
            'category' => _t('%s'),
            'search'   => _t('%s'),
            'tag'      => _t('%s'),
            'author'   => _t('%s')
        ], '', ''); ?></span></a></li>
        </ul>
      </div>
    </div>
  </div>
</section>

<section>
  <div class="container">
 
    <div class="row gy-5 gx-4 g-xl-5">
                <?php if($this->have()): ?>
        <?php while ($this->next()): ?>
      <div class="col-lg-6">
        <article class="card post-card h-100 border-0 bg-transparent">
          <div class="card-body">
           <a class="d-block" href="<?php $this->permalink() ?>"
              title="<?php $this->title() ?>">
              <div class="post-image position-relative">
                <img class="rounded img-fluid w-100" src="<?php echo General::firstThumb($this);?>" alt="<?php $this->title() ?>"  style="max-height:300px;object-fit: cover" loading="lazy" decoding="async">
              </div>
            </a>
           
            <a class="d-block" href="<?php $this->permalink() ?>"
              title="<?php $this->title() ?>">
              <h3 class="mb-3 post-title">
                <?php $this->title() ?>
              </h3>
            </a>
             <ul class="card-meta list-inline mb-3">
              <li class="list-inline-item mt-2">
                <i class="ti ti-calendar-event"></i>
                <span><?php echo General::publishTime($this->created);?></span>
              </li>
              <li class="list-inline-item mt-2">—</li>
              <li class="list-inline-item mt-2">
                <i class="ti ti-folder"></i>
                <span><bh><?php $this->category('</bh><bh style="display:none">'); ?></bh></span>
              </li>
            </ul>
            <p><?php if($this->fields->excerpt):?><?php echo $this->fields->excerpt;?><?php else:?><?php echo General::cutexpert($this->excerpt,20);?><?php endif;?></p>
          </div>
          <div class="card-footer border-top-0 bg-transparent p-0">
            <ul class="card-meta list-inline">
              <li class="list-inline-item mt-2">
                <a href="<?php $this->author->permalink();?>" class="card-meta-author" title="<?php echo $this->author->name;?>">
                  <img class="w-auto" src="<?php echo General::getAvatar($this->author->mail); ?>" alt="" width="26" height="26"> <span><?php echo $this->author->screenName;?></span>
                </a>
              </li>
             <?php echo General::tags($this); ?>
              
            </ul>
          </div>
        </article>
      </div>
     <?php endwhile; ?>
     <?php else:?><div class="row h4 justify-content-center align-items-center">
<svg height="200" node-id="1" sillyvg="true" template-height="1024" template-width="1024" version="1.1" viewBox="0 0 1024 1024" width="200" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><defs node-id="39"><linearGradient gradientUnits="objectBoundingBox" id="linearGradient-1" node-id="5" spreadMethod="pad" x1="0.75774837" x2="0.26300043" y1="0.89788246" y2="0.06672812"><stop offset="0" stop-color="#dce2ec"></stop><stop offset="1" stop-color="#eef1f5"></stop></linearGradient><linearGradient gradientUnits="objectBoundingBox" id="linearGradient-2" node-id="8" spreadMethod="pad" x1="0.2833117" x2="0.47835723" y1="0.5" y2="0.15123942"><stop offset="0" stop-color="#dce2ec" stop-opacity="0"></stop><stop offset="1" stop-color="#dce2ec"></stop></linearGradient><linearGradient gradientUnits="objectBoundingBox" id="linearGradient-3" node-id="11" spreadMethod="pad" x1="0.52506536" x2="0.5369437" y1="0.8267667" y2="0.1585097"><stop offset="0" stop-color="#dce0e9"></stop><stop offset="1" stop-color="#dce0e9"></stop></linearGradient><linearGradient gradientUnits="objectBoundingBox" id="linearGradient-4" node-id="14" spreadMethod="pad" x1="1.1537404" x2="-0.101114154" y1="0.5805712" y2="0.41226244"><stop offset="0" stop-color="#f0f4f8"></stop><stop offset="1" stop-color="#dee4ed"></stop></linearGradient><linearGradient gradientUnits="objectBoundingBox" id="linearGradient-5" node-id="17" spreadMethod="pad" x1="0.110735975" x2="0.9418903" y1="0.62347084" y2="0.3693628"><stop offset="0" stop-color="#f0f4f8"></stop><stop offset="1" stop-color="#dee4ed"></stop></linearGradient></defs><g node-id="70"><path d="M 412.00 412.00 L 612.00 412.00 L 612.00 612.00 L 412.00 612.00 Z" fill="none" group-id="1" id="bg" node-id="22" stroke="none" target-height="200" target-width="200" target-x="412" target-y="412"></path><g node-id="71"><path d="M 412.00 412.00 L 612.00 412.00 L 612.00 612.00 L 412.00 612.00 Z" fill="none" group-id="1,2" id="矩形" node-id="24" stroke="none" target-height="200" target-width="200" target-x="412" target-y="412"></path><g node-id="72"><path d="M 209.60 758.40 L 512.00 664.01 L 512.00 282.80 L 209.60 370.51 Z" fill="#ced3de" fill-rule="nonzero" group-id="1,2,3" id="Path" node-id="26" stroke="none" target-height="475.60004" target-width="302.4" target-x="209.6" target-y="282.8"></path><g node-id="73"><path d="M 814.40 758.40 L 512.00 664.01 L 512.00 282.80 L 814.40 370.51 Z" fill="#6d7c9a" fill-opacity="0.4" fill-rule="nonzero" group-id="1,2,3,4" id="Path" node-id="27" stroke="none" target-height="475.60004" target-width="302.40002" target-x="512" target-y="282.8"></path></g><path d="M 213.24 750.41 L 509.83 656.44 L 509.83 281.95 L 213.24 364.24 Z" fill="#ced3dc" fill-rule="nonzero" group-id="1,2,3" id="Path" node-id="28" stroke="none" target-height="468.45996" target-width="296.58997" target-x="213.24" target-y="281.95"></path><path d="M 806.43 750.41 L 509.83 656.44 L 509.83 281.95 L 806.43 364.24 Z" fill="#d8dce3" fill-rule="nonzero" group-id="1,2,3" id="Path" node-id="29" stroke="none" target-height="468.45996" target-width="296.6" target-x="509.83" target-y="281.95"></path><path d="M 512.00 848.00 L 209.60 753.52 L 209.60 366.40 L 512.00 460.88 Z" fill="url(#linearGradient-1)" fill-rule="nonzero" group-id="1,2,3" id="Path" node-id="30" stroke="none" target-height="481.6" target-width="302.4" target-x="209.6" target-y="366.4"></path><path d="M 512.00 848.00 L 814.40 753.52 L 814.40 366.40 L 512.00 460.88 Z" fill="url(#linearGradient-1)" fill-rule="nonzero" group-id="1,2,3" id="Path" node-id="31" stroke="none" target-height="481.6" target-width="302.40002" target-x="512" target-y="366.4"></path><path d="M 443.48 780.80 L 209.60 754.53 L 209.60 366.40 L 512.00 461.12 Z" fill="url(#linearGradient-2)" fill-opacity="0.09" fill-rule="nonzero" group-id="1,2,3,5" id="Path" node-id="32" stroke="none" target-height="414.4" target-width="302.4" target-x="209.6" target-y="366.4"></path><path d="M 580.52 717.01 L 814.40 758.40 L 814.40 377.60 L 512.00 470.53 Z" fill="url(#linearGradient-3)" fill-opacity="0.2" fill-rule="nonzero" group-id="1,2,3,6" id="Path" node-id="33" stroke="none" target-height="380.80002" target-width="302.40002" target-x="512" target-y="377.6"></path><path d="M 512.00 283.00 L 370.34 176.00 L 64.00 280.07 L 210.70 377.60 Z" fill="url(#linearGradient-4)" fill-rule="nonzero" group-id="1,2,3" id="Path" node-id="34" stroke="none" target-height="201.6" target-width="448" target-x="64" target-y="176"></path><path d="M 512.00 283.00 L 653.66 176.00 L 960.00 280.07 L 813.30 377.60 Z" fill="url(#linearGradient-5)" fill-rule="nonzero" group-id="1,2,3" id="Path" node-id="35" stroke="none" target-height="201.6" target-width="448" target-x="512" target-y="176"></path><path d="M 210.70 366.40 L 512.00 460.92 L 361.70 556.80 L 64.00 458.01 Z" fill="#f4f8fd" fill-rule="nonzero" group-id="1,2,3" id="Path" node-id="36" stroke="none" target-height="190.4" target-width="448" target-x="64" target-y="366.4"></path><path d="M 813.30 366.40 L 512.00 460.92 L 662.29 556.80 L 960.00 458.01 Z" fill="#f2f6fa" fill-rule="nonzero" group-id="1,2,3" id="Path" node-id="37" stroke="none" target-height="190.4" target-width="448" target-x="512" target-y="366.4"></path></g></g></g></svg>
啊哦~本页面暂无内容</div>
             <?php endif;?>
    </div>
  </div>
</section>


        
        <?php
      ob_start(); 
      $this->pageNav('&laquo;','&raquo;', 1, '');
      $content = ob_get_contents();
      ob_end_clean();
      $content = preg_replace("/<ol class=\"(.*?)\">/sm", '<div class="container"><div class="section"><div class="row justify-content-center align-items-center"><div class="col-xl-6 col-lg-8 col-md-10"><div class="col-12"><nav class="text-center mt-5"><ul class="pagination justify-content-center border border-white rounded d-inline-flex">', $content);
      $content = preg_replace("/<li><span>(.*?)<\/span><\/li>/sm", '<li class="page-item mt-2 mx-2">...</li>', $content);
      $content = preg_replace("/<li class=\"current\"><a href=\"(.*?)\">(.*?)<\/a><\/li>/sm", '<li class="page-item active"><a href="$1" class="page-link rounded">$2</a></li>', $content);
      $content = preg_replace("/<li><a href=\"(.*?)\">(.*?)<\/a><\/li>/sm", '<li class="page-item"><a href="$1" class="page-link rounded">$2</a></li>', $content);
       $content = preg_replace("/<li [class=\"prev\"]+><a href=\"(.*?)\">(.*?)<\/a><\/li>/sm", '<li class="page-item"><a class="page-link rounded w-auto px-4" href="$1" aria-label="上一页">上一页</a></li>', $content);
      $content = preg_replace("/<li [class=\"next\"]+><a href=\"(.*?)\">(.*?)<\/a><\/li>/sm", '<li class="page-item"><a class="page-link rounded w-auto px-4" href="$1" aria-label="下一页">下一页</a></li>', $content);
      $content = preg_replace("/<\/ol>/sm", '</ul></nav></div></div></div></div></div>', $content);
      echo $content;
     ?>
     
 
   

<?php $this->need('footer.php'); ?>
