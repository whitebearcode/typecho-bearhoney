<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<!DOCTYPE html>
<html lang="zh-cn" data-theme="light">
    <head>
     <meta charset="<?php $this->options->charset(); ?>">
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <meta name="mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />
    <meta name="apple-touch-fullscreen" content="yes"/>
    <meta name="format-detection" content="email=no" />
    <meta name="wap-font-scale"  content="no" />
    <meta content="telephone=no" name="format-detection" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <?php if(!empty(General::Options('favicon'))): ?>
 <link rel="icon" href="<?php echo General::Options('favicon') ?>" />
 <?php endif; ?>
    <title><?php $this->archiveTitle([
            'category' => _t('分类 %s 下的文章'),
            'search'   => _t('包含关键字 %s 的文章'),
            'tag'      => _t('标签 %s 下的文章'),
            'author'   => _t('%s 发布的文章')
        ], '', ' - '); ?><?php $this->options->title(); ?></title>
  <link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="preload" href="https://fonts.googleapis.com/css2?family=Noto+Serif+SC:wght@200;300;400;500;600;700;900&display=swap" as="style" onload="this.rel='stylesheet'" crossorigin>

  <link rel="stylesheet" href="<?php $this->options->themeUrl('assets/css/bearhoney.min.css?v=1'); ?><?php echo themeVersion();?>">
  <link rel="stylesheet" href="<?php $this->options->themeUrl('assets/plugins/element-ui/index.min.css'); ?>">
  <link rel="stylesheet" type="text/css" href="<?php $this->options->themeUrl('assets/css/bearhoney_cards.min.css?v='); ?><?php echo themeVersion();?>">
  <link rel="stylesheet" type="text/css" href="<?php $this->options->themeUrl('assets/css/bearhoney_styles.min.css?v='); ?><?php echo themeVersion();?>">
  <link href="<?php $this->options->themeUrl('assets/plugins/toastr/toastr.min.css'); ?>" rel="stylesheet">
  <link href="<?php $this->options->themeUrl('assets/plugins/remixicon/remixicon.css'); ?>" rel="stylesheet">
  <link href="<?php $this->options->themeUrl('assets/plugins/fancybox/fancybox.min.css'); ?>?v=1" rel="stylesheet">
  <script src="<?php $this->options->themeUrl('assets/plugins/jquery/jquery.min.js'); ?>"></script>
  <script src="<?php $this->options->themeUrl('assets/js/qrious.min.js'); ?>"></script>
   <link href="<?php $this->options->themeUrl('assets/plugins/menu/menu.min.css'); ?>" rel="stylesheet">
    <!-- 通过自有函数输出HTML头部信息 -->
    <?php $this->header('commentReply=&keywords=&pingback=0&xmlrpc=0&wlw=0&generator=&template=&atom='); ?>
    <?php echo General::Options('CustomizationCode'); ?>
    
    <style>
     <?php if(!empty(General::Options('diyFont'))):?>
@font-face {
          font-family: CustomFont;
          src: url("<?php echo General::Options('diyFont');?>");
        }
     *{
          font-family: CustomFont !important;
        }
    <?php else:?>
        *{
            font-family: 'Noto Serif SC',serif!important;
        }
        <?php endif;?>
        :root {--bearhoney-accent-color: <?php if(General::Options('accentColor')):?><?php echo General::Options('accentColor');?><?php else:?>#e4a300<?php endif;?>;}
    </style>
 <script>
        if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
            document.querySelector("html").setAttribute('data-theme', 'dark')
        }else{
            document.querySelector("html").setAttribute('data-theme', 'light')
        }
 
if (typeof (Storage) !== 'undefined') {
            if (localStorage.getItem('selected-theme') == 'light') {
                document.documentElement.setAttribute('data-theme', 'light');
            }
            else if (localStorage.getItem('selected-theme') == 'dark') {
                document.documentElement.setAttribute('data-theme', 'dark');
            }
        }
          var searchContentApi = "<?php $this->options->siteUrl(); ?>index.php/bh-searchArticle";  
    </script>
</head>
<body>
  
<div class="header-area">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12" style="padding-top:40px;padding-bottom:40px">
                <div class="header-area-inner">
                    <!-- LOGO -->
                    <div class="logo mx-auto text-center" style="width:100%;">
                        <?php if(General::Options('header_choose') == 'image'):?>
                        <a href="<?php $this->options->siteUrl(); ?>"><img class="light-logo" src="<?php echo General::Options('imagelogo');?>"  height="75" loading="lazy"></a>
                        <a href="<?php $this->options->siteUrl(); ?>"><img class="dark-logo" src="<?php echo General::Options('imagelogo_dark');?>"  height="75" loading="lazy"></a>
                        <?php else:?>
<h2><a href="<?php $this->options->siteUrl(); ?>"><?php echo General::Options('textlogo_text');?></a></h2>
<?php endif;?>
                    </div>
    
       </div>
  
       </div>
           <div class="mx-auto text-center" style="margin-bottom:20px;display: flex; align-items: center;">
    
                  
                            <div class="dark-light bh_module">
                            <div class="icon-dark">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="32" height="32" fill="currentColor"><path d="M12 18C8.68629 18 6 15.3137 6 12C6 8.68629 8.68629 6 12 6C15.3137 6 18 8.68629 18 12C18 15.3137 15.3137 18 12 18ZM12 16C14.2091 16 16 14.2091 16 12C16 9.79086 14.2091 8 12 8C9.79086 8 8 9.79086 8 12C8 14.2091 9.79086 16 12 16ZM11 1H13V4H11V1ZM11 20H13V23H11V20ZM3.51472 4.92893L4.92893 3.51472L7.05025 5.63604L5.63604 7.05025L3.51472 4.92893ZM16.9497 18.364L18.364 16.9497L20.4853 19.0711L19.0711 20.4853L16.9497 18.364ZM19.0711 3.51472L20.4853 4.92893L18.364 7.05025L16.9497 5.63604L19.0711 3.51472ZM5.63604 16.9497L7.05025 18.364L4.92893 20.4853L3.51472 19.0711L5.63604 16.9497ZM23 11V13H20V11H23ZM4 11V13H1V11H4Z"></path></svg>                           </div>
                            <div class="icon-light">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="32" height="32" fill="currentColor"><path d="M10 6C10 10.4183 13.5817 14 18 14C19.4386 14 20.7885 13.6203 21.9549 12.9556C21.4738 18.0302 17.2005 22 12 22C6.47715 22 2 17.5228 2 12C2 6.79948 5.9698 2.52616 11.0444 2.04507C10.3797 3.21152 10 4.56142 10 6ZM4 12C4 16.4183 7.58172 20 12 20C14.9654 20 17.5757 18.3788 18.9571 15.9546C18.6407 15.9848 18.3214 16 18 16C12.4772 16 8 11.5228 8 6C8 5.67863 8.01524 5.35933 8.04536 5.04293C5.62119 6.42426 4 9.03458 4 12ZM18.1642 2.29104L19 2.5V3.5L18.1642 3.70896C17.4476 3.8881 16.8881 4.4476 16.709 5.16417L16.5 6H15.5L15.291 5.16417C15.1119 4.4476 14.5524 3.8881 13.8358 3.70896L13 3.5V2.5L13.8358 2.29104C14.5524 2.1119 15.1119 1.5524 15.291 0.835829L15.5 0H16.5L16.709 0.835829C16.8881 1.5524 17.4476 2.1119 18.1642 2.29104ZM23.1642 7.29104L24 7.5V8.5L23.1642 8.70896C22.4476 8.8881 21.8881 9.4476 21.709 10.1642L21.5 11H20.5L20.291 10.1642C20.1119 9.4476 19.5524 8.8881 18.8358 8.70896L18 8.5V7.5L18.8358 7.29104C19.5524 7.1119 20.1119 6.5524 20.291 5.83583L20.5 5H21.5L21.709 5.83583C21.8881 6.5524 22.4476 7.1119 23.1642 7.29104Z"></path></svg>                     </div>
                        </div>
                         <div class="search-bar bh_module" style="cursor:pointer;">
                           <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="32" height="32" fill="currentColor"><path d="M18.031 16.6168L22.3137 20.8995L20.8995 22.3137L16.6168 18.031C15.0769 19.263 13.124 20 11 20C6.032 20 2 15.968 2 11C2 6.032 6.032 2 11 2C15.968 2 20 6.032 20 11C20 13.124 19.263 15.0769 18.031 16.6168ZM16.0247 15.8748C17.2475 14.6146 18 12.8956 18 11C18 7.1325 14.8675 4 11 4C7.1325 4 4 7.1325 4 11C4 14.8675 7.1325 18 11 18C12.8956 18 14.6146 17.2475 15.8748 16.0247L16.0247 15.8748Z"></path></svg>
                        </div>
                        
                  
                        
                        
                         <nav id="honeynavbar" class="sm-navbar sm-navbar--offcanvas-left sm-navbar--collapsible-only sm-navbar--offcanvas-only">

  <span class="sm-toggler-state" id="toggler"></span>
  <div class="sm-toggler bh_module">
    <a class="sm-toggler-anchor sm-toggler-anchor--show" href="#toggler" role="button" aria-label="Open main menu">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="32" height="32" fill="currentColor"><path d="M3 4H21V6H3V4ZM3 11H21V13H3V11ZM3 18H21V20H3V18Z"></path></svg>
    </a>
    <a class="sm-toggler-anchor sm-toggler-anchor--hide" href="#" role="button" aria-label="Close main menu">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="32" height="32" fill="currentColor"><path d="M11.9997 10.5865L16.9495 5.63672L18.3637 7.05093L13.4139 12.0007L18.3637 16.9504L16.9495 18.3646L11.9997 13.4149L7.04996 18.3646L5.63574 16.9504L10.5855 12.0007L5.63574 7.05093L7.04996 5.63672L11.9997 10.5865Z"></path></svg>
   
    </a>
  </div>

  <a class="sm-offcanvas-overlay" href="#" aria-hidden="true" tabindex="-1"></a>

  <div class="sm-offcanvas">
    <div style="display: flex; align-items: center; justify-content: space-between" aria-hidden="true">
      <h1 class="sm-brand"><a href="#" tabindex="-1">导航</a></h1>
      <div class="sm-toggler">
        <a class="sm-toggler-anchor sm-toggler-anchor--hide" href="#" role="button" tabindex="-1">
          <span class="sm-toggler-icon sm-toggler-icon--hide"></span>
        </a>
      </div>
    </div>
<style>
    .sm-nav li{margin:5px 3px 5px 3px}
</style>
    <ul class="sm-nav  sm-nav--center">
      <li class="sm-nav-item"><a class="sm-nav-link<?php if($this->is('index')):?> current<?php endif;?>" href="<?php $this->options->siteUrl(); ?>">首页</a></li>
     <?php $this->widget('Widget_Metas_Category_List')->to($categorys); ?>
      <li class="sm-nav-item">
          <a class="sm-nav-link sm-sub-toggler<?php if($this->is('category')): ?> current<?php endif;?>">分类</a>
    
        <ul class="sm-sub">
                  <?php while($categorys->next()): ?>

<?php if ($categorys->levels === 0): ?>

<?php $children = $categorys->getAllChildren($categorys->mid); ?>

<?php if (empty($children)) { ?>
          <li class="sm-sub-item"><a class="sm-sub-link<?php if($this->is('category',$categorys->slug)): ?> current<?php endif;?>" href="<?php $categorys->permalink(); ?>"><?php $categorys->name(); ?></a></li>
          <?php }  else { ?>
          <li class="sm-sub-item">
            <a class="sm-sub-link sm-sub-link--split<?php if($this->is('category',$categorys->slug)): ?> current<?php endif;?>" href="<?php $categorys->permalink(); ?>"><?php $categorys->name(); ?></a
            ><button class="sm-sub-link sm-sub-link--split sm-sub-toggler" aria-label="Toggle"></button>
            <ul class="sm-sub">
                <?php foreach ($children as $mid) { ?>
           <?php $child = $categorys->getCategory($mid); ?>
              <li class="sm-sub-item"><a class="sm-sub-link<?php if($this->is('category',$child['slug'])): ?> current<?php endif;?>" href="<?php echo $child['permalink'] ?>"><?php echo $child['name']; ?></a></li>
              <?php } ?>
              
              
            </ul>
          </li>
          <?php } ?>
          <?php endif; ?><?php endwhile; ?>
         
        
         
        </ul>
      </li>
      
      <?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>              
         <?php if($pages->have()): ?>
         <?php while($pages->next()): ?>
<li class="sm-nav-item"><a class="sm-nav-link<?php if($this->is('page',$pages->slug)): ?> current<?php endif; ?>" href="<?php $pages->permalink(); ?>"><?php $pages->title(); ?></a></li>
<?php endwhile;?>
         <?php endif;?>
         <?php if(General::Options('showLogin') == true):?>
<?php if(!$this->user->hasLogin()):?>
        <li class="sm-nav-item"><a class="sm-nav-link signin-popup mr-2" href="javascript:void(0);">登录</a></li>
<?php else:?>
<li class="sm-nav-item"><a class="sm-nav-link" href="<?php echo $this->options->adminUrl;?>" target="_blank">管理中心</a></li>
<?php endif;?>
<?php endif;?>
         
    </ul>
  </div>
</nav>


                        </div>
                      
   
                        
<div class="col-md-12">


               

        
<div id="signin" class="authentication-content">
    
<div class="authentication-box">
    <div class="close-modal"><i class="ri-close-large-fill"></i>
          </div>
    <div class="signup-form">
        <h4 class="mb-1">登录</h4>
        <p class="mb-4">使用您在本站的账号密码进行登录</p>
        <form action="<?php $this->options->loginAction(); ?>" method="post" name="login" role="form">
            <div class="signup-form position-relative">
                <input class="form-control" type="text" id="loginname" name="name" required="true" autocomplete="false"
                    placeholder="输入您的账号"><br>
                    <input class="form-control" type="password" id="password" name="password" required="true" autocomplete="false"
                    placeholder="输入您的密码">
                    
                <button type="submit" class="btn btn-signin p-0">
                    <span class="button-text"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#FFAF29" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-send"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg></span>
                    <span class="button-loader loader loader-yellow"></span>
                </button>
            </div><p class="mt-4">
            <?php if ($this->options->allowRegister):?>
            还没有账号? <a href="#" class="signup-popup">那就注册一个！</a>
           <?php endif;?>
           </p>
        </form>
    </div>
</div>

</div>

<div id="signup" class="authentication-content">

<div class="authentication-box">
    <div class="close-modal">
        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 130.2 130.2">
  <line class="path line" fill="none" stroke="#ffffff" stroke-width="6" stroke-linecap="round" stroke-miterlimit="10" x1="34.4" y1="37.9" x2="95.8" y2="92.3"/>
  <line class="path line" fill="none" stroke="#ffffff" stroke-width="6" stroke-linecap="round" stroke-miterlimit="10" x1="95.8" y1="38" x2="34.4" y2="92.2"/>
</svg>    </div>
    <div class="signup-form">
        <h4 class="mb-1">注册</h4>
        <p class="mb-4">仅需花费几秒钟就可以完成注册啦~<br>*注册成功后将自动登录，建议第一时间修改默认密码~</p>
        <form action="<?php $this->options->registerAction(); ?>" method="post" name="register" role="form">
            <div class="signup-form overflow-hidden">
                <input class="form-control"type="text" id="regname" name="name" required="true" autocomplete="false"
                    placeholder="输入您要注册的账号"><br>
                    <input class="form-control"type="email" id="regmail" name="mail" required="true" autocomplete="false"
                    placeholder="输入您的邮箱">
                    
                <button type="submit" class="btn btn-signin p-0">
                    <span class="button-text"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#FFAF29" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-send"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg></span>
                    <span class="button-loader loader loader-yellow"></span>
                </button>
            </div>
            <p class="mt-4">已经有账号了？ <a href="#" class="signin-popup">点击这里登录</a></p>
            
        </form>
    </div>
</div>
</div>                   
</div>
          
             </div>  </div>
        
    </div>