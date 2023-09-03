<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>

<section class="section-sm pb-0">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="text-center">
          <h1 class="page-not-found-title">404</h1>
          <p class="mb-4">啊哦~您所访问的页面被小怪兽吃掉了</p>
          <a href="<?php $this->options->siteUrl(); ?>" class="btn btn-primary">返回首页</a>
        </div>
      </div>
    </div>
  </div>
</section>
<?php $this->need('footer.php'); ?>
