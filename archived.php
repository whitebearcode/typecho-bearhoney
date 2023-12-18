<?php
    /**
    * 归档
    *
    * @package custom
    */
?>
<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>

<div class="blog-section pb-40">
    <div class="container">
        <div class="row">
    <div class="col-lg-12 mx-auto">
        <div class="banner-content">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
            <h1 class="post-title"><?php $this->title() ?></h1>
                        </div>
        </div>
    </div>
</div>

 <div class="row">
    <div class="col-lg-12 col-md-12 mx-auto">
        <div class="blog-full-content pb-30 control-full-w-image">
          
            
                <div class="post-full-content">
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
            $output .= '<h2><i class="ri-archive-2-line"></i> '. $year .'</h2>'; 
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
</div>
</div></div>
<?php $this->need('footer.php'); ?>