<?php
    /**
    * 朋友圈
    *
    * @package custom
    */
?>
<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php');?>
<link href="<?php $this->options->themeUrl('core/Extensions/friendCircle/styles/friendcircle.css?v=2'); ?>" rel="stylesheet">
<link href="<?php $this->options->themeUrl('core/Extensions/friendCircle/styles/plyr.min.css');?>" rel="stylesheet">
<link href="<?php $this->options->themeUrl('assets/plugins/emoji/emoji.css');?>" rel="stylesheet">


<?php
$parameter= array(
   'parentId'      => $this->hidden ? 0 : $this->cid,
   'parentContent' => $this->row,
   'respondId'     => $this->respondId,
   'commentPage'   => $this->request->filter('int')->commentPage,
   'commentsPageSize' => '4',
   'allowComment'  => $this->allow('comment')
);
$this->widget('BearSimple_Widget_Friendcircle_Archive',$parameter)->to($comments);
?>
<div class="blog-section pb-40">
    <div class="container">
        <div class="row">
    <div class="col-lg-12 mx-auto">
        <div class="banner-content">
            <div class="post-title"><svg style="margin-top:-12px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="48" height="48" fill="var(--bearhoney-accent-color)"><path d="M8.66725 11.5114C7.94997 11.5114 7.38211 10.9432 7.38211 10.2255C7.38211 9.50784 7.94997 8.93968 8.66725 8.93968C9.38454 8.93968 9.95239 9.50784 9.95239 10.2255C9.95239 10.9432 9.38454 11.5114 8.66725 11.5114ZM15.3339 11.5114C14.6166 11.5114 14.0488 10.9432 14.0488 10.2255C14.0488 9.50784 14.6166 8.93968 15.3339 8.93968C16.0512 8.93968 16.6191 9.50784 16.6191 10.2255C16.6191 10.9432 16.0512 11.5114 15.3339 11.5114ZM6.82289 19.2153L7.53841 18.7789C8.34812 18.2851 9.30697 18.095 10.2438 18.2426C10.4553 18.2759 10.6292 18.3015 10.7634 18.3192C11.1696 18.3728 11.5828 18.4 12.0006 18.4C16.4213 18.4 19.9006 15.3776 19.9006 11.8C19.9006 8.22235 16.4213 5.19995 12.0006 5.19995C7.57986 5.19995 4.10059 8.22235 4.10059 11.8C4.10059 13.1655 4.60024 14.4728 5.53227 15.5809C5.58056 15.6383 5.65277 15.7177 5.74666 15.8155C6.54199 16.6438 6.94301 17.7739 6.84765 18.9182L6.82289 19.2153ZM6.19286 21.9423C6.00989 22.0566 5.79484 22.1087 5.57981 22.0908C5.02944 22.045 4.62045 21.5616 4.66631 21.0112L4.85456 18.7521C4.90224 18.1799 4.70173 17.6149 4.30407 17.2008C4.1819 17.0735 4.08111 16.9627 4.0017 16.8683C2.80622 15.447 2.10059 13.6951 2.10059 11.8C2.10059 7.0503 6.53297 3.19995 12.0006 3.19995C17.4682 3.19995 21.9006 7.0503 21.9006 11.8C21.9006 16.5496 17.4682 20.4 12.0006 20.4C11.4911 20.4 10.9906 20.3665 10.5018 20.302C10.3491 20.2819 10.1593 20.254 9.93256 20.2182C9.46412 20.1444 8.9847 20.2395 8.57985 20.4864L6.19286 21.9423Z"></path></svg><?php $this->title() ?></div>
            
            
    <div class="friendcircle-container">
        <section class="friendcircle-bg">
            <img src="<?php if(General::Options('fcircle_Background') == null): ?><?php $this->options->themeUrl('assets/images/mountain.webp'); ?><?php else:?><?php echo General::Options('fcircle_Background');?><?php endif;?>" class="friendcircle-bg-img">
            <img src="<?php if(General::Options('fcircle_Avatar') == null): ?><?php $this->options->themeUrl('assets/images/circle_defaultAvatar.jpg'); ?><?php else:?><?php echo General::Options('fcircle_Avatar');?><?php endif;?>" class="friendcircle-bg-author">
            <span class="friendcircle-bg-author-name"><?php if(General::Options('fcircle_Name') == null): ?>神秘人<?php else:?><?php echo General::Options('fcircle_Name');?><?php endif;?></span>
            <span class="friendcircle-bg-author-sign"><?php if(General::Options('fcircle_Sign') == null): ?>神秘人的朋友圈<?php else:?><?php echo General::Options('fcircle_Sign');?><?php endif;?></span>
        </section>
        <button class="friendcircle-add" id="friendcircle-add" style="display:none"><i class="ri-add-large-line"></i> 发表朋友圈</button>


    <div class="honeydimmer" id="circleDeleteLoad" style="display:none">
    <svg class="spinner" width="65px" height="65px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg">
   <circle class="path" fill="none" stroke-width="6" stroke-linecap="round" cx="33" cy="33" r="30"></circle>
</svg>
  </div>
  
  
<div class="friendcircle-popup friendcirclex" role="alert">
<div class="honeydimmer" id="circleSendLoad" style="display:none">
    <svg class="spinner" width="65px" height="65px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg">
   <circle class="path" fill="none" stroke-width="6" stroke-linecap="round" cx="33" cy="33" r="30"></circle>
</svg>
  </div>
  <form method="post" action="<?php General::editurl($this->commentUrl) ?>" name="friendcircleform" id="commentform" class="friendcircle-form">
    <div class="friendcircle-popup-container">
      <p style="float:left">
        <div class="friendcircle-popup-close friendcircle-close-button">
          <i class="ri-arrow-left-s-line" style="pointer-events:none;"></i>
        </div>
    </p>
  <div class="submit" style="float:right">
      
        <button type="submit" name="submit" id="submit">发表</button>
      </div>
      <div class="message">
        <textarea name="text" id="text"  class="emotion" placeholder="这一刻的想法..."></textarea>
       
      </div>
      <input type="text" id="vtype" name="vtype" value="friendcircle" style="display:none">
      <br><br>
        <div class="friendcircle-popup-emoji emojis" id="facecircle">
            
  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="32" height="32" fill="var(--bearhoney-accent-color)"><path d="M12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22ZM12 20C16.4183 20 20 16.4183 20 12C20 7.58172 16.4183 4 12 4C7.58172 4 4 7.58172 4 12C4 16.4183 7.58172 20 12 20ZM8 13H16C16 15.2091 14.2091 17 12 17C9.79086 17 8 15.2091 8 13ZM8 11C7.17157 11 6.5 10.3284 6.5 9.5C6.5 8.67157 7.17157 8 8 8C8.82843 8 9.5 8.67157 9.5 9.5C9.5 10.3284 8.82843 11 8 11ZM16 11C15.1716 11 14.5 10.3284 14.5 9.5C14.5 8.67157 15.1716 8 16 8C16.8284 8 17.5 8.67157 17.5 9.5C17.5 10.3284 16.8284 11 16 11Z"></path></svg>
 </div>
 <div class="emoemo" class="ignore"  translate="no" style="position: relative;margin-top:-20px;padding-bottom:10px"></div>
   
 

<div id="getUpload">
				<div class="friendcircle-button" name="btn" id="btn"><i class="ri-image-add-line"></i> 上传图片</div>
				<div class="friendcircle-button" name="btn_v" id="btn_v"><i class="ri-video-add-line"></i> 上传音/视频</div>
				<ul id="ul_pics" class="ul_pics clearfix"></ul>
				<ul id="ul_video" class="ul_video clearfix"></ul>
		</div>


      <br><br>
      <div class="message_action">
          <div class="getMap">
      <div class="friendcircle-button" id="getMap"><i class="ri-map-pin-add-line"></i> 获取当前位置信息</div>  <input name="getMapInput" id="getMapInput" value="" style="display:none"><br><br></div>
      
      <div class="canRead">
      <i class="user alternate large green icon"></i> 
      <div class="ui right aligned toggle checkbox">
        <input type="checkbox" id="getRead" name="getRead">
       <label>仅自己可见</label>
      </div>


  
  
      </div>
      </div>
    </div>
    
  
    
  </form>
  
 
</div>


<?php if (!$comments->have()): ?> 
<center>
    <div style="margin-top:40px">
              <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="200" height="200" viewBox="0 0 480 480"><defs><linearGradient id="a" x1="1.128" y1="0.988" x2="0.364" y2="1" gradientUnits="objectBoundingBox"><stop offset="0" stop-color="#e0e5ef" stop-opacity="0"/><stop offset="1" stop-color="#e0e5ef"/></linearGradient><linearGradient id="c" x1="1" y1="0.5" x2="0.112" y2="1.125" gradientUnits="objectBoundingBox"><stop offset="0" stop-color="#fff" stop-opacity="0"/><stop offset="1" stop-color="#747f95"/></linearGradient><linearGradient id="d" x1="-0.392" y1="1.114" x2="0.5" y2="0.396" gradientUnits="objectBoundingBox"><stop offset="0" stop-color="#fff" stop-opacity="0"/><stop offset="1" stop-color="#ebedf5"/></linearGradient><linearGradient id="e" x1="-0.906" y1="1.646" x2="0.636" y2="0.061" xlink:href="#d"/><linearGradient id="f" x1="-0.109" y1="1.931" x2="0.736" y2="0.141" xlink:href="#d"/></defs><g transform="translate(-135 -375)"><circle cx="184" cy="184" r="184" transform="translate(191 443)" fill="#f3f3fa"/><path d="M2925,350h0c-8.837,0-16-32.235-16-72s7.163-72,16-72c.038,0,11.813.471,18.75-7.529s9-14.486,9-24.469c0-34.257,14.681-58.6,28.25-63.313,3.909-.688,10,.818,16-4.354s8-9.372,8-16.333c0-37.555,12.536-68,28-68s28,30.445,28,68c0,6.961-.667,10.328,5.333,15.5s14.76,4.5,18.667,5.187c13.569,4.714,24,33.055,24,67.312a101.212,101.212,0,0,0,2.333,20s4.485,11.842,11,5.5,9.13-14.885,10.25-22.871C3135.767,157.923,3142.61,142,3149,142c6.519,0,12.127,16.566,14.645,40.566.741,7.066,2.2,11.743,6.521,17.6A14.3,14.3,0,0,0,3180.92,206H3181c6.488,0,12.073,16.409,14.617,40.308.5,4.725.982,7.6,5.3,11.527S3212.884,262,3212.884,262l.116,0c2.16,0,4.255,1.8,6.228,5.344a58.6,58.6,0,0,1,5.086,14.573C3227.336,294.758,3229,311.835,3229,330c0,6.817-.237,13.546-.7,20H2925Zm303.3,0h0Z" transform="translate(-2718 397)" fill="url(#a)"/><path d="M117,208H.7c-.466-6.453-.7-13.181-.7-20,0-18.163,1.664-35.24,4.686-48.083a58.6,58.6,0,0,1,5.086-14.573C11.745,121.8,13.84,120,16,120l.116,0s7.651-.242,11.967-4.166,4.8-6.8,5.3-11.527C35.927,80.408,41.513,64,48,64a16.6,16.6,0,0,0,3.3-1.014A6.153,6.153,0,0,0,53.365,61.5c6.515-6.342,9.13-14.884,10.25-22.871C66.8,15.924,73.642,0,80.032,0,86.55,0,92.158,16.566,94.676,40.567c.742,7.065,2.2,11.742,6.521,17.6A14.3,14.3,0,0,0,111.951,64h.081c6.487,0,12.073,16.409,14.617,40.307.5,4.725.983,7.6,5.3,11.527S143.915,120,143.915,120l.116,0c2.16,0,4.255,1.8,6.228,5.344a58.6,58.6,0,0,1,5.086,14.573c3.022,12.844,4.686,29.921,4.686,48.083,0,6.818-.237,13.546-.7,20H117Zm42.328,0h0ZM.7,208h0Z" transform="translate(350.969 539)" fill="url(#a)"/><path d="M2989,62c-10.838-4.087-16.3,0-32,0-26.51,0-48-8.954-48-20s21.49-20,48-20h256a16,16,0,1,1,0,32s-15.5,0-27.5,3S3165,68.714,3165,68.714,3127.392,110,3081,110c-38.041,0-70.176-13.246-80.647-31.653C2998.219,74.6,2999.838,66.087,2989,62Z" transform="translate(-2702 701)" fill="#d1d6e2"/><path d="M-2493,98s-56.355,45.651-64,16,74.25-17.75-16,72" transform="translate(3044 409)" fill="none" stroke="#909aa9" stroke-linecap="round" stroke-width="2" stroke-dasharray="10"/><path d="M4,2.2C7.15-.75,16,0,16,0s-1.5,4-2.6,8-.232,5.942-1.8,8C7.6,21.25,0,21,0,21s.75-3.4,2-8S.85,5.15,4,2.2Z" transform="translate(447 603.085)" fill="#909aa9"/><ellipse cx="10" cy="4" rx="10" ry="4" transform="translate(294 787)" fill="url(#c)"/><path d="M8.44,24s8.115-6,6.94-10S11.51,9.625,9.775,6.125A11.222,11.222,0,0,1,8.44,0S1.767,2.625,1.5,9.375C1.38,12.419,4.436,14.344,6.171,18A32.451,32.451,0,0,1,8.44,24Z" transform="translate(287 794.497) rotate(-90)" fill="#909aa9"/><path d="M0,0,57,4.5,136,0l31.5,12,17,10-37,8.5-24.5-5-58,5L4,23Z" transform="translate(191 699)" fill="#fff"/><path d="M-1.4,1.2,60,9l58.75-5.25L143,9l36-9V24.5L144.4,29l-16.2-7.25L95.6,23l-5.1,1.5L67.2,21.75,5,23.25S2.8,16.713,1.2,11.2-1.4,1.2-1.4,1.2Z" transform="translate(196 720)" fill="#eceff5"/><ellipse cx="43" cy="9.5" rx="43" ry="9.5" transform="translate(253 701)" fill="#ebedf5"/><g transform="translate(63 354)"><g transform="translate(258.49 305.55)"><path d="M525.021,66.584a31.23,31.23,0,0,1,7.085,10.425c2.772,6.6,5.877,13.459,8.386,14.78s3.695,10.033-8.053,8.185S525.021,66.584,525.021,66.584Z" transform="translate(-524.241 -66.584)" fill="#fff"/><path d="M525.494,68.3a32.341,32.341,0,0,1,6.953,16.851c.847,8.628,2.933,13.332,5.151,13.016a12.659,12.659,0,0,1-5.991-.025C528.092,97.37,524.074,68.412,525.494,68.3Z" transform="translate(-523.763 -65.64)" fill="url(#d)"/></g><path d="M537.949,131.675a34.415,34.415,0,0,0,14.137,1.09c6.9-.975,8.727-13.747-.647-15.059-7.267-1.02-6.026-12.167-7.366-22.433s-6.56-18.848-7.364-23.026,4.251-9.233,3.614-18.062c-.652-9.065-6.3-10.479-8.307-10.074s-3.609,2.392-6.154,3.47-6.292-.673-11.112,1.619-9.377,7.547-9.377,7.547c-2.009,2.561.4,10.648-.938,14.691s-6.694,39.223-6.56,49.062,6.426,16.715,19.952,18.467,19.419-.606,19.856-4.448c.279-2.443,1.905-11.053-7.8-12.535-4.83-.74-7.363-1.347-7.363-1.347" transform="translate(-279.872 225.445)" fill="#fff"/><path d="M519.206,44.961s.961-1.578,1.726-1.594c1.313-.026,2.7,1.631,2.7,1.631S519.249,46.731,519.206,44.961Z" transform="translate(-268.363 226.187)" fill="#757f95"/><path d="M522.077,37.922c-2.054-.536-2.278,2.085-2.278,2.085s-2.89-.313-2.6,1.743c.357,2.566,5.831,2.443,5.831,2.443S524.583,38.578,522.077,37.922Z" transform="translate(-269.464 223.151)" fill="#757f95"/><path d="M505.743,52.715s-6.088-1.338-6.755,3.318,4.181,7.509,7.656.6" transform="translate(-279.292 231.235)" fill="#fff"/><path d="M503.084,74.624s-1.45,17.9,1.1,22.385c2.3,4.044,10.662,5.138,16.755,4.63a25.038,25.038,0,0,0,6.013-1.246c6.068-2.157,2.831-6.2,0-8.893s-3.738-10.346-8.593-14.5" transform="translate(-276.501 243.626)" fill="url(#e)"/><path d="M514.078,48.635a.6.6,0,0,0-.522.31v0l-.009.014a4.814,4.814,0,0,1-3.228,2.322l-.019,0,0,0a.6.6,0,0,0-.509.5l-.011,0-.406,1.078s.341-.014.842-.088l.057-.307.11-.584v.865c.188-.031.389-.073.6-.121v-.747l.064.454.037.268a5.609,5.609,0,0,0,2.386-1.138,4.083,4.083,0,0,0,1.152-1.977c.04-.155.054-.248.054-.248A.6.6,0,0,0,514.078,48.635Z" transform="translate(-273.668 229.087)" fill="#757f95"/><path d="M531.516,76.393c-3.6-3.507-6.766.555-6.766.555s-6.2-4.888-8.5.26C513.373,83.63,528.051,94,528.051,94S535.2,79.982,531.516,76.393Z" transform="translate(-270.216 243.516)" fill="url(#f)"/><path d="M504.118,75.051s5.02,15.274,7.571,19.76c3.236,5.688,9.468,8.51,15.533,6.355s2.831-5.527,0-8.223S523.148,81.155,518.293,77" transform="translate(-277.496 242.564)" fill="#fff"/></g><path d="M0,9.833l18-9.5,2.667,4v8.2L13,18,8.167,12.532,0,13.671Z" transform="translate(377 777)" fill="#eceff5"/><path d="M4,3.167,18,0V10l-5,3.167-4.833-4L0,10Z" transform="translate(377 777)" fill="#fff"/><path d="M-.211,18.893,16,12l.246,14.107-2.084,4.646L0,31Z" transform="matrix(1, 0.017, -0.017, 1, 400.376, 734.864)" fill="#eceff5"/><path d="M9.75,12H16l-3.75,7H0Z" transform="translate(400 735)" fill="#fff"/><g transform="translate(447 690)"><path d="M97,0,63.923,4.5,24.316,0,8.523,12,0,22l18.55,8.5,12.283-5,29.079,5,23.488-5,6.467-12.126Z" transform="translate(-1 12)" fill="#fff"/><path d="M81.149.607l-28.1,3.945L26.17,1.9l-11.1,2.655L-2.651-1.333V12.391l17.083,2.276L21.846,11l14.917.632,2.334.759L49.759,11l28.991,1.391s-1.4-1.778,0-4.724A43.992,43.992,0,0,0,81.149.607Z" transform="translate(1.651 35.333)" fill="#eceff5"/></g></g></svg></div>
           <h3>博主当前还没有朋友圈呢~</h3>
        
              
  </center>
  <?php endif;?>
<?php if ($comments->have()): ?>    
    <br>
    
     <?php
      ob_start();
   $comments->listComments();
   $comments_content = ob_get_contents();
      ob_end_clean();
   $comments_content = preg_replace("/<ol class=\"comment-list\">/sm", '<ul id="friendcircle-list" class="friendcircle-list friendcircle-list-front">', $comments_content);
   $comments_content = preg_replace("/<\/ol>/sm", '</ul>', $comments_content);
   echo $comments_content;
   ?>




    <?php

      ob_start(); 

      $comments->pageNav('&laquo;','&raquo;', 1, '');
      $content = ob_get_contents();
      ob_end_clean();
      $content = preg_replace("/<ol class=\"(.*?)\">/sm", '<div class="honeyPagination"><ul>', $content);
      $content = preg_replace("/<li><span>(.*?)<\/span><\/li>/sm", '<a><li>...</li></a>', $content);
      $content = preg_replace("/<li class=\"current\"><a href=\"(.*?)\">(.*?)<\/a><\/li>/sm", '<a class="is-active"><li>$2</li></a>', $content);
      $content = preg_replace("/<li><a href=\"(.*?)\">(.*?)<\/a><\/li>/sm", '<a href="$1"><li>$2</li></a>', $content);
       $content = preg_replace("/<li [class=\"prev\"]+><a href=\"(.*?)\">(.*?)<\/a><\/li>/sm", '<a href="$1"><li>上一页</li></a>', $content);
      $content = preg_replace("/<li [class=\"next\"]+><a href=\"(.*?)\">(.*?)<\/a><\/li>/sm", '<a href="$1"><li>下一页</li></a>', $content);
      
      $content = preg_replace("/<\/ol>/sm", '</ul></div>', $content);
      
      echo $content;
     ?>

    <?php endif; ?>
    


        </div>



<div id="friendcircle-comment-container" style="display:none">
   
  <div class="honeydimmer" id="circleLoad" style="display:none">
    <svg class="spinner" width="65px" height="65px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg">
   <circle class="path" fill="none" stroke-width="6" stroke-linecap="round" cx="33" cy="33" r="30"></circle>
</svg>
  </div>


             <div class="friendcircle-comment-types">
                 
                 <div id="nologinshow" style="display:none">
            <input type="text" id="friendcircle-comment-nickname" placeholder="昵称*">
            <input type="email" id="friendcircle-comment-email" placeholder="邮箱*">
            <input type="url" id="friendcircle-comment-url" placeholder="网址">
            </div>
            <div id="loginshowlabel" style="display:none;padding-left: 5px;">
                <div class="honeyLabel" style="float:left">
  <img src="<?php echo General::getAvatar($this->user->mail); ?>">
  <name id="authorname"></name>
</div>
                   </div>
            <textarea id="friendcircle-comment-textarea" class="emotion_circle" required="" spellcheck="false" maxlength="500" onchange="this.value=this.value.substring(0, 500)" onkeydown="this.value=this.value.substring(0, 500)" onkeyup="this.value=this.value.substring(0, 500)" placeholder="评论内容"></textarea>
            <button id="friendcircle-comment-submit"><i class="ri-send-plane-line"></i> 发送</button>
            <button id="friendcircle-comment-cancelsubmit"><i class="ri-close-circle-line"></i> 取消</button>
              <div class="friendcircle-comment-emoji" id="facecirclecomment">
  <i class="ri-emotion-line"></i>
 </div>
          
                
            </div>
 <div  class="ignore emoemo"  translate="no"></div>
            
         </div>
      

</div></div></div></div></div>


<script src="<?php $this->options->themeUrl('core/Extensions/friendCircle/styles/moxie.js?v=2');?>"></script>
<script src="<?php $this->options->themeUrl('core/Extensions/friendCircle/styles/plupload.js');?>"></script>

<script src="<?php $this->options->themeUrl('core/Extensions/friendCircle/styles/plyr.min.js');?>"></script>


      <script>



      $(function(){
Fancybox.bind('[data-fancybox]');
           $(".friendcircle-action").on('click mouseenter',function() {
            $(".tool-container").hide();
            $(this).find(".tool-container").show();
       
        });

      $(document).on('click',function(event) {
          if (!$(event.target).closest('.circle-action').length) {
              $(".tool-container").hide();
          }
         });
          $('.circle-pictures .circle-picture img,.friendcircle-avatar img,.friendcircle-bg img')
  .visibility({
    type       : 'image',
    transition : 'fade in',
    duration   : 1000
  })
;
       function plyr(){
           if(!$(".circle_player").length){
            return false;   
           }
         const players = Plyr.setup('.circle_player',{
              controls : [
                'play-large', 'play', 'progress', 'current-time', 'mute', 'volume', 'captions',  'pip', 'airplay', 'fullscreen' 
              ],
              
          });
         players.forEach(function(player){
             

          player.on('enterfullscreen', (event) => {
  const instance = event.detail.plyr;
  $(".plyr--video .plyr__controls .plyr__progress__container").show();
  $(".plyr--video .plyr__controls .plyr__time").show();
});
         player.on('exitfullscreen', (event) => {
  const instance = event.detail.plyr;
  $(".plyr--video .plyr__controls .plyr__progress__container").hide();
  $(".plyr--video .plyr__controls .plyr__time").hide();
});
});
}
plyr();

          $.getScript("<?php $this->options->themeUrl('assets/plugins/emoji/emoji.js');?>",function(){
        $('#facecircle').BearhoneyEmoji($('.emotion'));
          $('#facecirclecomment').BearhoneyEmoji($('.emotion_circle'));
              
          });

          function autoResize(element) {
  element.style.height = 'auto';
  element.style.height = `${element.scrollHeight}px`;
}

var textarea = document.getElementById('friendcircle-comment-textarea');
$("#friendcircle-comment-textarea").on("input propertychange",function(){

    autoResize(this);
    if(this.value.length){
    $("#friendcircle-comment-container").attr("style", "box-shadow: inset 0px 0px 0px 1px var(--bearhoney-accent-color);");
    $("#friendcircle-comment-submit").addClass("friendcircle-comment-readySubmit");
    }
    else{
    $("#friendcircle-comment-container").attr("style", "box-shadow: inset 0px 0px 0px 0px var(--bearhoney-accent-color);");
    $("#friendcircle-comment-submit").removeClass("friendcircle-comment-readySubmit");    
    }
});


  
          dom = function (id) {
            return document.getElementById(id);
        };
        create = function (tag, attr) {
            var el = document.createElement(tag);
        
            for (var key in attr) {
                el.setAttribute(key, attr[key]);
            }
        
            return el;
        };
        $('.circle-like').on('click',function(){
            $('.circle-like').css("pointer-events","none");
            var coid = $(this).attr('data-coid');
            $.ajax({
        url: '<?php General::getCircleAction();?>',
        type: 'POST',
        dataType: 'html',
        data: {
                            "action": 'like',
                            "coid":coid
                        },
                        
        
        success: function(response) {
            $('.circle-like').css("pointer-events","auto");
            json = JSON.parse(response);
            if(json.code == 500){
                toastr.warning(json.msg,"点赞失败");
							return false;
            }
            toastr.success("您已点赞成功~","点赞成功");
           
		    
			if(json.likeUser !== '' && json.likeVisitor !== ''){
			    json.likeVisitor = '，'+json.likeVisitor;
			}

		   if(!$("#friendcircle-comments-"+coid).length){
		       $("#friendcircle-action-"+coid).after('<div class="friendcircle-comments" id="friendcircle-comments-'+coid+'"><span id="friendcircle-comments-like-'+coid+'"><i class="ri-heart-3-line"></i> '+json.likeUser+json.likeVisitor+'</span></div>');
		   }
		   if($("#friendcircle-comments-"+coid).length && !$("#friendcircle-comments-like-"+coid).length){
			$("#friendcircle-comments-"+coid).prepend('<span id="friendcircle-comments-like-'+coid+'"><i class="ri-heart-3-line"></i> '+json.likeUser+json.likeVisitor+'</span><hr>');
			}
			if($("#friendcircle-comments-"+coid).length && $("#friendcircle-comments-like-"+coid).length){
			$("#friendcircle-comments-like-"+coid).empty().html('<i class="ri-heart-3-line"></i> '+json.likeUser+json.likeVisitor);
			}
			
			
			
				
        },
        
        error: function(req, status, error) {
            $('.circle-like').css("pointer-events","auto");
          toastr.warning("网络错误","点赞失败");
        }
    });
    
    
    
        });
        
        $('.circle-comment-children').on('click',function(){
            $('.circle-action').css("pointer-events","none");
              var response = dom('friendcircle-comment-container');
              var com = dom('circle-children-'+$(this).attr('data-coid'));
              window.localStorage.setItem('reply-coid', $(this).attr('data-coid'));
                com.appendChild(response).style.display = "block";
                $("#friendcircle-comment-textarea").attr("placeholder", "回复"+$(this).attr('data-parentName')+":");
                document.getElementById("friendcircle-comment-textarea").focus();
          });
          $('.circle-comment').on('click',function(){
              $('.circle-action').css("pointer-events","none");
              var response = dom('friendcircle-comment-container');
              var com = dom('comment-'+$(this).attr('data-coid'));
              window.localStorage.setItem('reply-coid', $(this).attr('data-coid'));
             $("#friendcircle-comment-textarea").attr("placeholder", "回复<?php echo $this->author->screenName;?>:");
                com.appendChild(response).style.display = "block";
               document.getElementById("friendcircle-comment-textarea").focus();
          });
         
         $('#friendcircle-comment-cancelsubmit').on('click',function(){
             var response = dom('friendcircle-comment-container');
              response.style.display = "none";
              $('.circle-action').css("pointer-events","auto");
         });
         $('.circle-delete').on('click',function(){
             var coid = $(this).attr('data-coid');
             var confirms = confirm("是否删除这条朋友圈?");
             if(confirms == true){
                $("#circleDeleteLoad").fadeIn();
                $.ajax({
                        type: "POST",
                        async:true,
                        url: window.location.href,
                        data: {
                            "action": 'deleteCircle',
                            "coid":coid
                        },
                        dateType: "json",
                        success: function(url) {
                            $.ajax({
                        type: "GET",
                        async:true,
                        url: url,
                        dateType: "json",
                        success: function(json) {
                            
                            
                 $.ajax({
                        type: "POST",
                        async:true,
                        url: '<?php General::getCircleAction();?>',
                        data: {
                            "action": 'delete',
                            "coid":coid
                        },
                        dateType: "json",
                        success: function(json) {
                    toastr.success("您已成功删除，即将自动刷新~","删除成功");
							setTimeout(function() {
            window.location.reload();
            },2000);
                          
                            
                    
                        }
     });
     
     
                        },
                        error: function() {
                           alert('删除失败~');
                        }
                    });
                          
                            
                    
                        }
     });
                
                
                
                
                
                
                
             }
         });
         $('#friendcircle-comment-submit').on('click',function(){
             $("#friendcircle-comment-submit").css("pointer-events","none");
             $("#circleLoad").fadeIn();
             if(!$('#nologinshow').is(':hidden')){
             if(!$('#friendcircle-comment-nickname').val()){
                 toastr.warning("您还没填写昵称！","啊哦");
				$("#circleLoad").fadeOut();
				$("#friendcircle-comment-submit").css("pointer-events","auto");
				return false;
             };
             if(!$('#friendcircle-comment-email').val()){
                 toastr.warning("您还没填写邮箱！","啊哦");
                 
				$("#circleLoad").fadeOut();
				$("#friendcircle-comment-submit").css("pointer-events","auto");
				return false;
             }}
             $.ajax({
        url: '<?php General::editurl($this->commentUrl) ?>',
        type: 'POST',
        dataType: 'json',
        data: {
                            "author": $('#friendcircle-comment-nickname').val(),
                            "mail": $('#friendcircle-comment-email').val(),
                            "url": $('#friendcircle-comment-url').val(),
                            "text": $('#friendcircle-comment-textarea').val(),
                            "SecurityToken": $('#SecurityToken').val(),
                            "parent": window.localStorage.getItem('reply-coid'),
                            "vtype":'circlecomment'
                        },
                        
        
        success: function(response) {
            toastr.success("您已评论成功，将自动刷新~","评论成功");
           
							window.location.reload();
        },
        
        error: function(req, status, error) {
          var div = $('<div>');
        div.html(req.responseText);
        var content = div.find('.header-area');
        var content2 = div.find('.container');
        if(content.length > 0){
            toastr.success("您已评论成功，将自动刷新~","评论成功");
           $("#friendcircle-comment-submit").css("pointer-events","auto");
           $("#circleLoad").fadeOut();
           window.location.reload();
        }
        else{
            toastr.error(content2.text(),"评论失败");
         window.location.reload();
        }
        }
    });
    
    
         });
         
         
      
      <?php
    $phpMaxFilesize = function_exists('ini_get') ? trim(ini_get('upload_max_filesize')) : 0;

if (preg_match("/^([0-9]+)([a-z]{1,2})$/i", $phpMaxFilesize, $matches)) {
    $phpMaxFilesize = strtolower($matches[1] . $matches[2] . (1 == strlen($matches[2]) ? 'b' : ''));
}
    ?>
      
       function fileUploadError (error) {
        var file = error.file, code = error.code, word; 
        
        switch (code) {
            case plupload.FILE_SIZE_ERROR:
                word = '<?php _e('文件大小超过限制'); ?>';
                break;
            case plupload.FILE_EXTENSION_ERROR:
                word = '<?php _e('文件扩展名不被支持'); ?>';
                break;
            case plupload.FILE_DUPLICATE_ERROR:
                word = '<?php _e('文件已经上传过'); ?>';
                break;
            case plupload.HTTP_ERROR:
            default:
                word = '<?php _e("上传出现错误，可能的原因：1、允许上传的文件类型与所上传的文件类型不符。2、配置了外部存储但没有正确配置。"); ?>';
                break;
        }
        alert(word);
        this.removeFile(file);
        $("#" + file.id).remove();
       }
       
      


		var uploader = new plupload.Uploader({
				runtimes: 'html5,flash,silverlight,html4',
				browse_button: 'btn',
				url: "<?php $this->security->index('/action/upload?cid='.$this->cid);?>",
				flash_swf_url   :   '<?php $this->options->themeUrl('core/Extensions/friendCircle/styles/Moxie.swf');?>',
            filters         :   {
                max_file_size       :   '<?php echo $phpMaxFilesize;?>',
                mime_types          :   [{'title' : '允许上传的文件', 'extensions' : 'gif,jpg,jpeg,png,bmp,webp'}],
                prevent_duplicates  :   false
            },
				multi_selection: false, 
				init: {
					FilesAdded: function(up, files) { //文件上传前
					$("#btn_v").hide();
						if (up.files.length > 9) {
							alert("抱歉，仅能上传9张图片~");
							uploader.destroy();
						} else {
							var li = '';
							plupload.each(files, function(file) { //遍历文件
								li += "<li id='" + file['id'] + "'><div class='fprogress'><span class='fbar'></span><span class='fpercent'>0%</span></div></li>";
							});
							$("#ul_pics").append(li);
							uploader.start();
						}
					},
					UploadProgress: function(up, file) { 
						var percent = file.percent;
						$("#" + file.id).find('.fbar').css({
							"width": percent + "%"
						});
						$("#" + file.id).find(".fpercent").text(percent + "%");
					},
					FileUploaded: function(up, file, info) {
					   if (200 == info.status) {
					        var data = $.parseJSON(info.response);
	                      //var data = eval("(" + info.response + ")");
	                      if (data) {
						$("#" + file.id).html("<div class='img'><img data-fancybox='image' src='" + data[0] + "'/><input name='image' value='" + data[0] + "' style='display:none'></div>");
						return;
					    }
					   }
					   fileUploadError.call(uploader, {
                        code : plupload.HTTP_ERROR,
                        file : file
                    });
					},
					Error: function(up, err) {
						fileUploadError.call(uploader, err);
					}
				}
			});
			uploader.init();
			
	var uploader_video = new plupload.Uploader({
				runtimes: 'html5,flash,silverlight,html4',
				browse_button: 'btn_v',
				url: "<?php $this->security->index('/action/upload?cid='.$this->cid);?>",
				flash_swf_url   :   '<?php $this->options->themeUrl('core/Extensions/friendCircle/styles/Moxie.swf');?>',
            filters         :   {
                max_file_size       :   '<?php echo $phpMaxFilesize;?>',
                mime_types          :   [{'title' : '允许上传的文件', 'extensions' : 'mp3,mp4,mov,wmv,wma,rmvb,rm,avi,flv,ogg,oga,ogv,flac'}],
                prevent_duplicates  :   false
            },
				multi_selection: false, 
				init: {
					FilesAdded: function(up, files) { //文件上传前
					if (up.files.length == 1) {
					    $("#btn_v").hide();
					    }
					$("#btn").hide();
						if (up.files.length > 1) {
							alert("抱歉，仅能上传一个视频~");
							uploader.destroy();
						} else {
							var li = '';
							plupload.each(files, function(file) { //遍历文件
								li += "<li id='" + file['id'] + "'><div class='fprogress'><span class='fbar'></span><span class='fpercent'>0%</span></div></li>";
							});
							$("#ul_video").append(li);
							uploader_video.start();
						}
					},
					UploadProgress: function(up, file) { 
						var percent = file.percent;
						$("#" + file.id).find('.fbar').css({
							"width": percent + "%"
						});
						$("#" + file.id).find(".fpercent").text(percent + "%");
					},
					FileUploaded: function(up, file, info) {
					    if (200 == info.status) {
					        var data = $.parseJSON(info.response);
	                      //var data = eval("(" + info.response + ")");
	                      if (data) {
                         if(data[0].search('.mp3') !== -1){
                             $("#" + file.id).html("<div class='friendcircle_video'><audio class='circle_player' controls><source src='" + data[0] + "'></audio><input name='image' value='" + data[0] + "' style='display:none'></div>");    
						
                         }
                         else{
                         $("#" + file.id).html("<div class='friendcircle_video'><video class='circle_player' controls crossorigin playsinline><source src='" + data[0] + "'></video><input name='image' value='" + data[0] + "' style='display:none'></div>");
                         }
						plyr();
						return;
	                      }
					    }
					    fileUploadError.call(uploader_video, {
                        code : plupload.HTTP_ERROR,
                        file : file
                    });
					},
					Error: function(up, err) {
						fileUploadError.call(uploader_video, err);
					}
				}
			});
			uploader_video.init();		
		
    
$(function () {

    getCommentInfo();

function getCookie(name){
    const strcookie = document.cookie;
    const arrcookie = strcookie.split("; ");
    for (let i = 0; i < arrcookie.length; i++) {
        const arr = arrcookie[i].split("=");
        if (arr[0] === name){
            return arr[1];
        }
    }
    return "";
};
function getCommentInfo(){
    let nick = document.getElementById('friendcircle-comment-nickname');
    let mail = document.getElementById('friendcircle-comment-email');
    let url = document.getElementById('friendcircle-comment-url');
    let nick_value = decodeURIComponent(getCookie('<?php echo Typecho_Cookie::getPrefix()?>__typecho_remember_author'));
    let mail_value = decodeURIComponent(getCookie('<?php echo Typecho_Cookie::getPrefix()?>__typecho_remember_mail'));
    let url_value = decodeURIComponent(getCookie('<?php echo Typecho_Cookie::getPrefix()?>__typecho_remember_url'));
    if (nick && nick_value!== 'null') nick.value = nick_value;
    if (mail && mail_value!== 'null') mail.value = mail_value;
    if (url && url_value!== 'null') url.value = url_value;
    $.post('<?php General::getIsLogin(); ?>',{action:'find'},function (res) {
        res = JSON.parse(res);
        switch(res.code){
            case 0 :
        $('#loginshowlabel').hide();
    $('#nologinshow').show();
    break;
    case 1 :
        switch(res.group){
            case 'administrator':
        $('#friendcircle-add').fadeIn();
        $('.circle-delete').fadeIn();
        break;
        }
        $('#loginshowlabel').show();
    $('#nologinshow').hide();
    $('#authorname').html(res.name);
    break;
        }
    });



     $.post('<?php General::getCommentAction(); ?>',{action:'getCommentToken'},function (res) {
         res = JSON.parse(res);
         if(res.code == 1){
        var tokenInput=$("<input type=\"hidden\" name=\"SecurityToken\"  id=\"SecurityToken\">");
tokenInput.attr("value", res.token);
$("#commentform").append(tokenInput);
         }
    })
}



function closeForm() {
  $('.friendcircle-popup').removeClass('is-visible');
}


$('#getMap').on('click', function (event) {
    $('#getMap').html('<i class="ri-map-pin-add-line"></i> 正在获取您的位置，请稍等...');
    $('#getMap').css("pointer-events","none");
    $.post(window.location.href,{action:'getmap'},function (res) {
        $('#getMap').html('<i class="ri-map-pin-add-line"></i> '+res);
        $('#getMapInput').val(res);
    });
});
  
  $('#friendcircle-add').on('click', function () {
 
    $('.friendcirclex').addClass('is-visible');
    document.getElementById("text").focus();
   
  });


  $('.friendcircle-popup').on('click', function (event) {
    if ($(event.target).is('.friendcircle-popup-close') || $(event.target).is('.friendcircle-popup')) {
      event.preventDefault();
      $(this).removeClass('is-visible');
    }
  });

 
  $(document).keyup(function (event) {
    if (event.which == '27') {
      $('.friendcircle-popup').removeClass('is-visible');
    }
  });


function undatakey(formdata,name)
{
    result = '';
    for(var i in formdata.split("&")){
        var row = formdata.split("&")[i];
        var key = row.split("=")[0];
        var value = row.split("=")[1];
        if(key != name){
            result = result + row + "&";
        }
    }
    
    return result;
}


$('#commentform').submit(function(e) {
    e.preventDefault();
    var formData = undatakey($('#commentform').serialize(),'image').slice(0, -1);
var resources = '';
$('input[name=image]').each(function () {
   resources +=  $(this).val()+',';
});
$("#commentform").css("pointer-events","none");
             $("#circleSendLoad").fadeIn();
             
             
    if(!$('#text').val()){
                 toastr.warning("动态内容不能为空哦！","系统提醒");
$("#commentform").css("pointer-events","auto");
             $("#circleSendLoad").fadeOut();	
             return false;
    };					
    $.ajax({
        url: '<?php General::editurl($this->commentUrl) ?>',
        type: 'POST',
        dataType: 'json',
        data: formData+ '&resources=' + encodeURIComponent(resources.substring(0,resources.length -1)),
        
        success: function(response) {
           						
toastr.success("您已发表成功，将自动刷新~","发表成功");
							window.location.reload();
        },
        
        error: function(req, status, error) {
          var div = $('<div>');
        div.html(req.responseText);
        var content = div.find('.header-area');
        var content2 = div.find('.container');
        if(content.length > 0){
            toastr.success("您已发表成功，将自动刷新~","发表成功");
						
							window.location.reload();
       
         
        }
        else{
         $("#commentform").css("pointer-events","auto");
             $("#circleSendLoad").fadeOut();
             toastr.error(content2.text(),"发表失败");
        }
        }
    });
});




 
});
});
    </script>


    
             
<?php $this->need('footer.php'); ?>