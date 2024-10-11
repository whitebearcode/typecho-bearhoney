<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<!DOCTYPE html>
<html lang="zh-cn" data-theme="light">
    <head>
     <meta charset="<?php $this->options->charset(); ?>">
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />
    <meta name="apple-touch-fullscreen" content="yes"/>
    <meta name="format-detection" content="email=no" />
    <meta name="wap-font-scale"  content="no" />
    <meta name="viewport" content="user-scalable=no, width=device-width" />
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

  <link rel="stylesheet" href="<?php $this->options->themeUrl('assets/css/bearhoney.min.css?v='); ?><?php echo themeVersion();?>">
  <link rel="stylesheet" href="<?php $this->options->themeUrl('assets/plugins/element-ui/index.min.css'); ?>">
  <link rel="stylesheet" type="text/css" href="<?php $this->options->themeUrl('assets/css/bearhoney_cards.min.css?v='); ?><?php echo themeVersion();?>">
  <link rel="stylesheet" type="text/css" href="<?php $this->options->themeUrl('assets/css/bearhoney_styles.min.css?v='); ?><?php echo themeVersion();?>">
  <link href="<?php $this->options->themeUrl('assets/plugins/lazyload/transition.min.css'); ?>" rel="stylesheet">
  <link href="<?php $this->options->themeUrl('assets/plugins/toastr/toastr.min.css'); ?>" rel="stylesheet">
  <link href="<?php $this->options->themeUrl('assets/plugins/remixicon/remixicon.css'); ?>" rel="stylesheet">
  <link href="<?php $this->options->themeUrl('assets/plugins/fancybox/fancybox.min.css'); ?>?v=1" rel="stylesheet">
  <script src="<?php $this->options->themeUrl('assets/plugins/jquery/jquery.min.js'); ?>"></script>
  <script src="<?php $this->options->themeUrl('assets/js/qrious.min.js'); ?>"></script>
   <link href="<?php $this->options->themeUrl('assets/plugins/menu/menu.min.css'); ?>" rel="stylesheet">
    <!-- 通过自有函数输出HTML头部信息 -->
    <?php $this->header('commentReply=1&keywords=&pingback=0&xmlrpc=0&wlw=0&generator=&template=&atom='); ?>
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
    
<?php if($this->is('single')):?>
(function () {
    window.TypechoComment = {
        dom : function (id) {
            return document.getElementById(id);
        },
    
        create : function (tag, attr) {
            var el = document.createElement(tag);
        
            for (var key in attr) {
                el.setAttribute(key, attr[key]);
            }
        
            return el;
        },

        reply : function (cid, coid) {
            var comment = this.dom(cid), parent = comment.parentNode,
                response = this.dom('respond-post-<?php echo $this->cid;?>'), input = this.dom('comment-parent'),
                form = 'form' == response.tagName ? response : response.getElementsByTagName('form')[0],
                textarea = response.getElementsByTagName('textarea')[0];
            if (null == input) {
                input = this.create('input', {
                    'type' : 'hidden',
                    'name' : 'parent',
                    'id'   : 'comment-parent'
                });

                form.appendChild(input);
            }

            input.setAttribute('value', coid);

            if (null == this.dom('comment-form-place-holder')) {
                var holder = this.create('div', {
                    'id' : 'comment-form-place-holder'
                });

                response.parentNode.insertBefore(holder, response);
            }
            //comment.appendChild(response);
            comment.insertAdjacentElement("afterend",response);
            this.dom('cancel-comment-reply-link').style.display = '';

            if (null != textarea && 'text' == textarea.name) {
                textarea.focus();
            }

            return false;
        },

        cancelReply : function () {
            var response = this.dom('respond-post-<?php echo $this->cid;?>'),
            holder = this.dom('comment-form-place-holder'), input = this.dom('comment-parent');

            if (null != input) {
                input.parentNode.removeChild(input);
            }

            if (null == holder) {
                return true;
            }

            this.dom('cancel-comment-reply-link').style.display = 'none';
            holder.parentNode.insertBefore(response, holder);
            return false;
        }
    };
})();
<?php endif;?>
    </script>
</head>
<body>
<div class="header-area">

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12" style="padding-top:40px;padding-bottom:40px">
                <div class="header-area-inner d-flex justify-content-lg-between align-items-center flex-wrap">
                    <!-- LOGO -->
                    <div class="logo text-center" style="margin:0 auto;width:100%">
                        <?php if(General::Options('header_choose') == 'image'):?>
                        <a href="<?php $this->options->siteUrl(); ?>"><img class="light-logo" src="<?php echo General::Options('imagelogo');?>"  height="75" loading="lazy"></a>
                        <a href="<?php $this->options->siteUrl(); ?>"><img class="dark-logo" src="<?php echo General::Options('imagelogo_dark');?>"  height="75" loading="lazy"></a>
                        <?php else:?>
<h2><a href="<?php $this->options->siteUrl(); ?>"><?php echo General::Options('textlogo_text');?></a></h2>
<?php endif;?>
                    </div>
    
       </div>
       
       
      

                        
                        
       </div>
           <div class="d-flex justify-content-between align-items-center flex-wrap" style="margin:0 auto;margin-bottom:20px">
    
                  
                            <div class="dark-light" style="padding-right:20px">
                            <div class="icon-dark">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-sun"><circle cx="12" cy="12" r="5"></circle><line x1="12" y1="1" x2="12" y2="3"></line><line x1="12" y1="21" x2="12" y2="23"></line><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line><line x1="1" y1="12" x2="3" y2="12"></line><line x1="21" y1="12" x2="23" y2="12"></line><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line></svg>                            </div>
                            <div class="icon-light">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-moon"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path></svg>                            </div>
                        </div>
                         <div class="search-bar">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                        </div>
                        
                        </div>
                      
   
                        
<div class="col-md-12">


                <nav id="honeynavbar" class="sm-navbar sm-navbar--sticky-top sm-navbar--offcanvas-left sm-navbar--drop-reverse-x">


  <span class="sm-toggler-state" id="toggler"></span>
  <div class="sm-toggler" style="margin:0 auto">
    <a class="sm-toggler-anchor sm-toggler-anchor--show" href="#toggler" role="button" aria-label="Open main menu">
      <span class="sm-toggler-icon sm-toggler-icon--show"></span>
    </a>
    <a class="sm-toggler-anchor sm-toggler-anchor--hide" href="#" role="button" aria-label="Close main menu">
      <span class="sm-toggler-icon sm-toggler-icon--hide"></span>
    </a>
  </div>

  <a class="sm-offcanvas-overlay" href="#" aria-hidden="true" tabindex="-1"></a>

  <div class="sm-offcanvas">
    <div class="sm-hide-large" style="display: flex; align-items: center; justify-content: space-between" aria-hidden="true">
<h1 class="sm-brand">导航</h1>
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