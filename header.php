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

  <link rel="stylesheet" href="<?php $this->options->themeUrl('assets/plugins/tabler-icons/tabler-icons.min.css'); ?>">

		<link rel="stylesheet" href="<?php $this->options->themeUrl('assets/css/bearhoney.min.css'); ?>">
		<noscript data-n-css=""></noscript>
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
			<script>!function(){try{var d=document.documentElement,c=d.classList;c.remove('light','dark');var e=localStorage.getItem('theme');if('system'===e||(!e&&false)){var t='(prefers-color-scheme: dark)',m=window.matchMedia(t);if(m.media!==t||m.matches){d.style.colorScheme = 'dark';c.add('dark')}else{d.style.colorScheme = 'light';c.add('light')}}else if(e){c.add(e|| '')}else{c.add('light')}if(e==='light'||e==='dark'||!e)d.style.colorScheme=e||'light'}catch(e){}}()</script>
<div class="header-height-fix"></div>
<header class="header-nav">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <nav class="navbar navbar-expand-lg navbar-light p-0">
         <?php if(General::Options('header_choose') == 'image' && General::Options('imagelogo') !== ''): ?>
         
          <a class="navbar-brand font-weight-bold mb-0" href="<?php $this->options->siteUrl(); ?>" title="<?php $this->options->title(); ?>">
            <img class="img-fluid" width="110" height="35" src="<?php echo General::Options('imagelogo'); ?>" alt="<?php $this->options->title(); ?>" loading="lazy"  decoding="async">
            
          </a>
          
         
								
								
          <?php endif; ?>
          <?php if(General::Options('header_choose') == '' || General::Options('header_choose') == 'text'): ?>
<a class="navbar-brand font-weight-bold mb-0" href="<?php $this->options->siteUrl(); ?>" title="<?php $this->options->title(); ?>" style="font-size:25px">
           <?php echo General::Options('textlogo_text'); ?>
          </a>
          <?php endif; ?>
          
         <button class="search-toggle d-inline-block d-lg-none ms-auto me-1 me-sm-3"
										data-toggle="search" aria-label="Search Toggle">
									<span>搜索</span>
									<svg width="22" height="22" stroke-width="1.5"
										 viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M15.5 15.5L19 19" stroke="currentColor"
											  stroke-linecap="round"
											  stroke-linejoin="round"></path>
										<path d="M5 11C5 14.3137 7.68629 17 11 17C12.6597 17 14.1621 16.3261 15.2483 15.237C16.3308 14.1517 17 12.654 17 11C17 7.68629 14.3137 5 11 5C7.68629 5 5 7.68629 5 11Z"
											  stroke="currentColor"
											  stroke-linecap="round"
											  stroke-linejoin="round"></path>
									</svg>
								</button>

         <button class="navbar-toggler" type="button"
										data-bs-toggle="collapse"
										data-bs-target="#navHeader"
										aria-controls="navHeader" aria-expanded="false"
										aria-label="Toggle navigation">
									<i class="d-inline">
										<svg xmlns="http://www.w3.org/2000/svg"
											 width="32" height="32" viewBox="0 0 24 24"
											 fill="none" stroke="currentColor"
											 stroke-width="2" stroke-linecap="round"
											 stroke-linejoin="round" class="tabler-icon tabler-icon-menu-2">
											<path d="M4 6l16 0"></path>
											<path d="M4 12l16 0"></path>
											<path d="M4 18l16 0"></path>
										</svg>
									</i>
									<i class="d-none">
										<svg xmlns="http://www.w3.org/2000/svg"
											 width="32" height="32" viewBox="0 0 24 24"
											 fill="none" stroke="currentColor"
											 stroke-width="2" stroke-linecap="round"
											 stroke-linejoin="round" class="tabler-icon tabler-icon-x">
											<path d="M18 6l-12 12"></path>
											<path d="M6 6l12 12"></path>
										</svg>
									</i>
								</button>
<div class="color-scheme-toggler d-inline-block d-lg-none ms-3">
									<svg class="sun-icon" height="24px" width="24px"
										 xmlns="http://www.w3.org/2000/svg"
										 viewBox="0 0 512 512">
										<path d="M256 105.5a152.4 152.4 0 0 0-152.2 152.2c0 83.9 68.3 152.2 152.2 152.2 83.9 0 152.2-68.3 152.2-152.2 0-84-68.3-152.2-152.2-152.2zm0 263.5c-61.4 0-111.4-50-111.4-111.4 0-61.4 50-111.4 111.4-111.4 61.4 0 111.4 50 111.4 111.4 0 61.4-50 111.4-111.4 111.4zM256 74.8c11.3 0 20.4-9.1 20.4-20.4v-23a20.4 20.4 0 1 0-40.8 0v23c0 11.3 9.1 20.4 20.4 20.4zM256 437.2a20.4 20.4 0 0 0-20.4 20.4v22.9a20.4 20.4 0 1 0 40.8 0v-22.9c0-11.2-9.1-20.4-20.4-20.4zM480.6 235.6h-23a20.4 20.4 0 1 0 0 40.8h23a20.4 20.4 0 1 0 0-40.8zM54.4 235.6h-23a20.4 20.4 0 1 0 0 40.8h22.9c11.3 0 20.4-9.1 20.4-20.4a20.3 20.3 0 0 0-20.3-20.4zM400.4 82.8 384.1 99a20.4 20.4 0 1 0 28.9 28.9l16.2-16.2a20.4 20.4 0 0 0-28.8-28.9zM99 384.1l-16.2 16.2a20.4 20.4 0 1 0 28.9 28.9l16.2-16.2A20.4 20.4 0 1 0 99 384.1zM413 384.1a20.4 20.4 0 1 0-28.9 28.9l16.2 16.2a20.4 20.4 0 1 0 28.9-28.9L413 384.1zM99 127.9A20.4 20.4 0 1 0 127.9 99l-16.2-16.2a20.4 20.4 0 1 0-28.9 28.9L99 127.9z"></path>
									</svg>
									<svg class="moon-icon" height="24px" width="24px"
										 version="1.1" xmlns="http://www.w3.org/2000/svg"
										 x="0" y="0" viewBox="0 0 172.2 172.2"
										 enable-background="new 0 0 172.151 172.151">
										<path d="M95 27.9a3.6 3.6 0 0 0-4.8 4.4 62.8 62.8 0 0 1-83.9 78.3 3.6 3.6 0 0 0-4.8 4.5 69.4 69.4 0 0 0 66 47c17.8-.1 34.6-6.7 47.7-18.9a69.4 69.4 0 0 0 22.1-48.6A69.4 69.4 0 0 0 95 27.9zm35.2 66.4a62.3 62.3 0 0 1-64.9 60.5 62.3 62.3 0 0 1-54-34.8 70 70 0 0 0 88-82 62.5 62.5 0 0 1 31 56.3zM47.4 31.4a3.6 3.6 0 0 0 5 0l5.1-5.1 5.2 5a3.6 3.6 0 0 0 5 0 3.6 3.6 0 0 0 0-5l-5.1-5 5-5a3.6 3.6 0 1 0-5-5l-5 4.9-5-5a3.6 3.6 0 1 0-5 5l5 5-5.2 5.1a3.6 3.6 0 0 0 0 5zM171.1 65.6l-5.1-5.1 5-5a3.6 3.6 0 1 0-5-5l-5 5-5-5a3.6 3.6 0 1 0-5 5l5 5-5.2 5a3.6 3.6 0 1 0 5 5.1l5.2-5.1 5 5.1a3.6 3.6 0 0 0 5.1 0 3.6 3.6 0 0 0 0-5z"></path>
										<path d="m6 95.6 5.2-5.1 5.1 5a3.6 3.6 0 0 0 5 0 3.6 3.6 0 0 0 0-5l-5-5 5-5a3.6 3.6 0 1 0-5.1-5.1l-5 5-5-5a3.6 3.6 0 1 0-5 5l5 5L1 90.5a3.6 3.6 0 1 0 5 5z"></path>
									</svg>
								</div>
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
										<ul class="list-unstyled list-inline mb-0">
											<li class="list-inline-item">
												<button class="search-toggle"
														data-toggle="search"
														aria-label="Search Toggle">
													<span>搜索</span>
													<svg width="22" height="22"
														 stroke-width="1.5"
														 viewBox="0 0 24 24"
														 fill="none" xmlns="http://www.w3.org/2000/svg">
														<path d="M15.5 15.5L19 19"
															  stroke="currentColor"
															  stroke-linecap="round"
															  stroke-linejoin="round"></path>
														<path d="M5 11C5 14.3137 7.68629 17 11 17C12.6597 17 14.1621 16.3261 15.2483 15.237C16.3308 14.1517 17 12.654 17 11C17 7.68629 14.3137 5 11 5C7.68629 5 5 7.68629 5 11Z"
															  stroke="currentColor"
															  stroke-linecap="round"
															  stroke-linejoin="round"></path>
													</svg>
												</button>
											</li>
										</ul>
									</div>
									<div class="color-scheme-toggler d-none d-lg-inline-block">
										<svg class="sun-icon" height="24px"
											 width="24px" xmlns="http://www.w3.org/2000/svg"
											 viewBox="0 0 512 512">
											<path d="M256 105.5a152.4 152.4 0 0 0-152.2 152.2c0 83.9 68.3 152.2 152.2 152.2 83.9 0 152.2-68.3 152.2-152.2 0-84-68.3-152.2-152.2-152.2zm0 263.5c-61.4 0-111.4-50-111.4-111.4 0-61.4 50-111.4 111.4-111.4 61.4 0 111.4 50 111.4 111.4 0 61.4-50 111.4-111.4 111.4zM256 74.8c11.3 0 20.4-9.1 20.4-20.4v-23a20.4 20.4 0 1 0-40.8 0v23c0 11.3 9.1 20.4 20.4 20.4zM256 437.2a20.4 20.4 0 0 0-20.4 20.4v22.9a20.4 20.4 0 1 0 40.8 0v-22.9c0-11.2-9.1-20.4-20.4-20.4zM480.6 235.6h-23a20.4 20.4 0 1 0 0 40.8h23a20.4 20.4 0 1 0 0-40.8zM54.4 235.6h-23a20.4 20.4 0 1 0 0 40.8h22.9c11.3 0 20.4-9.1 20.4-20.4a20.3 20.3 0 0 0-20.3-20.4zM400.4 82.8 384.1 99a20.4 20.4 0 1 0 28.9 28.9l16.2-16.2a20.4 20.4 0 0 0-28.8-28.9zM99 384.1l-16.2 16.2a20.4 20.4 0 1 0 28.9 28.9l16.2-16.2A20.4 20.4 0 1 0 99 384.1zM413 384.1a20.4 20.4 0 1 0-28.9 28.9l16.2 16.2a20.4 20.4 0 1 0 28.9-28.9L413 384.1zM99 127.9A20.4 20.4 0 1 0 127.9 99l-16.2-16.2a20.4 20.4 0 1 0-28.9 28.9L99 127.9z"></path>
										</svg>
										<svg class="moon-icon" height="24px"
											 width="24px" version="1.1" xmlns="http://www.w3.org/2000/svg"
											 x="0" y="0" viewBox="0 0 172.2 172.2"
											 enable-background="new 0 0 172.151 172.151">
											<path d="M95 27.9a3.6 3.6 0 0 0-4.8 4.4 62.8 62.8 0 0 1-83.9 78.3 3.6 3.6 0 0 0-4.8 4.5 69.4 69.4 0 0 0 66 47c17.8-.1 34.6-6.7 47.7-18.9a69.4 69.4 0 0 0 22.1-48.6A69.4 69.4 0 0 0 95 27.9zm35.2 66.4a62.3 62.3 0 0 1-64.9 60.5 62.3 62.3 0 0 1-54-34.8 70 70 0 0 0 88-82 62.5 62.5 0 0 1 31 56.3zM47.4 31.4a3.6 3.6 0 0 0 5 0l5.1-5.1 5.2 5a3.6 3.6 0 0 0 5 0 3.6 3.6 0 0 0 0-5l-5.1-5 5-5a3.6 3.6 0 1 0-5-5l-5 4.9-5-5a3.6 3.6 0 1 0-5 5l5 5-5.2 5.1a3.6 3.6 0 0 0 0 5zM171.1 65.6l-5.1-5.1 5-5a3.6 3.6 0 1 0-5-5l-5 5-5-5a3.6 3.6 0 1 0-5 5l5 5-5.2 5a3.6 3.6 0 1 0 5 5.1l5.2-5.1 5 5.1a3.6 3.6 0 0 0 5.1 0 3.6 3.6 0 0 0 0-5z"></path>
											<path d="m6 95.6 5.2-5.1 5.1 5a3.6 3.6 0 0 0 5 0 3.6 3.6 0 0 0 0-5l-5-5 5-5a3.6 3.6 0 1 0-5.1-5.1l-5 5-5-5a3.6 3.6 0 1 0-5 5l5 5L1 90.5a3.6 3.6 0 1 0 5 5z"></path>
										</svg>
									</div>
									
									
									
          </div>
        </nav>
      </div>
    </div>
  </div>
</header>

<div class="search-block">
 	<div data-toggle="search-close">
					<span class="text-primary">
						<svg xmlns="http://www.w3.org/2000/svg" width="38"
							 height="38" viewBox="0 0 24 24" fill="none" stroke="currentColor"
							 stroke-width="2" stroke-linecap="round"
							 stroke-linejoin="round" class="tabler-icon tabler-icon-x">
							<path d="M18 6l-12 12"></path>
							<path d="M6 6l12 12"></path>
						</svg>
					</span>
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

<script id="__NEXT_DATA__" type="application/json">
			
		</script>