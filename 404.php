<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>

<div class="blog-content-area pt-40 pb-50 bg-overlay">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <div class="error-styles py-80 text-center">
                    <img src="<?php $this->options->themeUrl('assets/images/404-error.png');?>" alt="404">
                    <h4 class="my-20">啊哦~您所访问的页面被小猫咪吃掉了~</h4>
                    <a class="error-link btn btn-yellow py-3 mt-30" href="<?php $this->options->siteUrl(); ?>">返回首页 →</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->need('footer.php'); ?>
