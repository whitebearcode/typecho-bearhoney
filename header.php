<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<!DOCTYPE html>
<html lang="zh-cn">
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
 <link rel="shortcut icon" href="<?php echo General::Options('favicon') ?>" />
 <?php endif; ?>
    <title><?php $this->archiveTitle([
            'category' => _t('分类 %s 下的文章'),
            'search'   => _t('包含关键字 %s 的文章'),
            'tag'      => _t('标签 %s 下的文章'),
            'author'   => _t('%s 发布的文章')
        ], '', ' - '); ?><?php $this->options->title(); ?></title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Crete+Round&family=Work+Sans:wght@500;600&family=Noto+Serif+SC:wght@200;300;400;500;600;700;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?php $this->options->themeUrl('assets/plugins/bootstrap/bootstrap.min.css'); ?>">
  <link rel="stylesheet" href="<?php $this->options->themeUrl('assets/plugins/tabler-icons/tabler-icons.min.css'); ?>">
  <link rel="stylesheet" href="<?php $this->options->themeUrl('assets/css/bearhoney.css'); ?>?v=<?php echo themeVersion(); ?>">
  <link rel="stylesheet" href="<?php $this->options->themeUrl('assets/plugins/fancybox/fancybox.min.css'); ?>">
  <script src="<?php $this->options->themeUrl('assets/plugins/jquery/jquery.min.js'); ?>"></script>
    <!-- 通过自有函数输出HTML头部信息 -->
    <?php $this->header('commentReply=1&description=&pingback=0&xmlrpc=0&wlw=0&generator=&template=&atom='); ?>
    <?php echo General::Options('CustomizationCode'); ?>
    <style>
        *{
            font-family: 'Noto Serif SC',serif!important;
        }
    </style>
</head>

<body>
<div class="header-height-fix"></div>
<header class="header-nav">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <nav class="navbar navbar-expand-lg navbar-light p-0">
         <?php if(General::Options('header_choose') == 'image' && General::Options('imagelogo') !== ''): ?>
         
          <a class="navbar-brand font-weight-bold mb-0" href="<?php $this->options->siteUrl(); ?>" title="<?php $this->options->title(); ?>">
            <img class="img-fluid" width="110" height="35" src="<?php echo General::Options('imagelogo'); ?>" alt="<?php $this->options->title(); ?>">
            
          </a>
          
          <?php endif; ?>
          <?php if(General::Options('header_choose') == '' || General::Options('header_choose') == 'text'): ?>
<a class="navbar-brand font-weight-bold mb-0" href="<?php $this->options->siteUrl(); ?>" title="<?php $this->options->title(); ?>" style="font-size:25px">
           <?php echo General::Options('textlogo_text'); ?>
          </a>
          <?php endif; ?>
          
          <button class="search-toggle d-inline-block d-lg-none ms-auto me-1 me-sm-3" data-toggle="search" aria-label="搜索">
            <span>搜索</span>
            <svg width="22" height="22" stroke-width="1.5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15.5 15.5L19 19" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/><path d="M5 11C5 14.3137 7.68629 17 11 17C12.6597 17 14.1621 16.3261 15.2483 15.237C16.3308 14.1517 17 12.654 17 11C17 7.68629 14.3137 5 11 5C7.68629 5 5 7.68629 5 11Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/></svg>
          </button>

          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navHeader" aria-controls="navHeader" aria-expanded="false" aria-label="Toggle navigation">
            <i class="ti ti-menu-2 menu-open"></i>
            <i class="ti ti-x menu-close"></i>
          </button>

          <div class="collapse navbar-collapse" id="navHeader">
            <ul class="navbar-nav mx-auto">
              <li class="nav-item active">
                <a class="nav-link" href="<?php $this->options->siteUrl(); ?>">首页</a>
              </li>
               <?php $this->widget('Widget_Metas_Category_List')->to($categorys); ?>
                <?php if($categorys->have()): ?>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdownCategory" role="button" data-bs-toggle="dropdown" aria-expanded="false">分类</a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdownCategory">
                    <?php while($categorys->next()): ?>
                  <li><a class="dropdown-item<?php if($this->is('category',$categorys->slug)): ?> active<?php endif; ?>" href="<?php $categorys->permalink(); ?>"><?php $categorys->name(); ?></a></li>
<?php endwhile; ?>
                </ul>
              </li>
              <?php endif; ?>
              <?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
              <?php if($pages->have()): ?>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdownPage" role="button" data-bs-toggle="dropdown" aria-expanded="false">页面</a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdownPage">
                    <?php while($pages->next()): ?>
                  <li><a class="dropdown-item<?php if($this->is('page',$pages->slug)): ?> active<?php endif; ?>" href="<?php $pages->permalink(); ?>"><?php $pages->title(); ?></a></li>
                  <?php endwhile; ?>
                </ul>
              </li>
            </ul>
            <?php endif; ?>
            <div class="navbar-right d-none d-lg-inline-block">
              <ul class="social-links list-unstyled list-inline">
                <li class="list-inline-item ms-4 d-none d-lg-inline-block">
                  <button class="search-toggle" data-toggle="search" aria-label="搜索">
                    <span>搜索</span>
                    <svg width="22" height="22" stroke-width="1.5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15.5 15.5L19 19" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/><path d="M5 11C5 14.3137 7.68629 17 11 17C12.6597 17 14.1621 16.3261 15.2483 15.237C16.3308 14.1517 17 12.654 17 11C17 7.68629 14.3137 5 11 5C7.68629 5 5 7.68629 5 11Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/></svg>
                  </button>
                </li>
              </ul>
            </div>
            
          </div>
        </nav>
      </div>
    </div>
  </div>
</header>

<div class="search-block">
  <div data-toggle="search-close">
    <span class="ti ti-x text-primary"></span>
  </div>
  <input type="text" id="js-search-input"  name="js-search-input" placeholder="输入关键词进行搜索" aria-label="输入关键词进行搜索"><br><br>
   <button type="submit" id="search-submit"  class="input-group-text w-10 justify-content-left"><i class="ti ti-search me-2"></i> 点此搜索</button>
<?php $this->widget('Widget_Metas_Tag_Cloud', 'ignoreZeroCount=1&limit=20')->to($tags); ?>
<?php if($tags->have()): ?>
  <div class="mt-4 card-meta">
    <p class="h4 mb-3">通过标签搜索相关文章</p>
    <ul class="card-meta-tag list-inline">
        <?php while($tags->next()): ?>
      <li class="list-inline-item me-1 mb-2">
        <a class="small" href="<?php $tags->permalink();?>"><?php $tags->name(); ?></a>
      </li>
      <?php endwhile; ?>
    </ul>
  </div>
<?php endif; ?>
<?php if($categorys->have()): ?>
  <div class="mt-4 card-meta">
    <p class="h4 mb-3">通过分类搜索文章</p>
    <ul class="card-meta-tag list-inline">
        <?php while($categorys->next()): ?>
      <li class="list-inline-item me-1 mb-2">
        <a class="small" href="<?php $categorys->permalink();?>"><?php $categorys->name();?></a>
      </li>
      <?php endwhile; ?>
     <?php endif; ?>
    </ul>
  </div>
</div>