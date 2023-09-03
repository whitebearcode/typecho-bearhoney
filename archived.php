<?php
    /**
    * 归档
    *
    * @package custom
    */
?>
<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>

<section class="page-header section-sm">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
        <h1 class="section-title h2 mb-3">
          <span><?php $this->title() ?></span>
        </h1>
        <ul class="list-inline breadcrumb-menu mb-3">
          <li class="list-inline-item"><a href="<?php $this->options->siteUrl(); ?>"><i class="ti ti-home"></i>  <span>首页</span></a></li>
          <li class="list-inline-item">• &nbsp; <a href="<?php $this->permalink() ?>"><span><?php $this->title() ?></span></a></li>
        </ul>
      </div>
    </div>
  </div>
</section>

<section>
  <div class="container">
    <div class="row">
      <div class="col-lg-10 mx-auto">
        <div class="archive-block">
            
             <?php 
    
    $year=0; $mon=0; $i=0; $j=0;
    $sul = General::getArchived();
    if($sul){
    foreach($sul as $archives){
        $archives = Typecho_Widget::widget('Widget_Abstract_Contents')->push($archives);
        $year_tmp = date('Y',$archives['created']);
        $mon_tmp = date('n',$archives['created']);
        $day_tmp = date('j日',$archives['created']);
        $y=$year; $m=$mon;
        
        if ($mon != $mon_tmp && $mon > 0) $output .= '';
        if ($year != $year_tmp) {
            $year = $year_tmp;
            $output .= '<h2><i class="ti ti-archive"></i>'. $year .'</h2>'; 
        }
   
        $output .= '<p class="archive-post-item">'. $mon_tmp .'月'.$day_tmp.'<span>•</span><a href="'.$archives['permalink'] .'">'. $archives['title'] .'</a></p>';
    }
    }
    $output .= '';
    echo $output;
?>

        </div>
      </div>
    </div>
  </div>
</section>

<?php $this->need('footer.php'); ?>