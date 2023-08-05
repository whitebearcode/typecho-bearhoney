<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>

<section class="section-sm pb-0">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-10">
        <div class="mb-5">
          <h3 class="h3 mb-4 post-titles"><?php $this->title() ?></h3>

          <ul class="card-meta list-inline mb-2">
            <li class="list-inline-item mt-2">
              <a href="<?php $this->author->permalink() ?>" class="card-meta-author" title="<?php $this->author(); ?>的文章">
                <img class="w-auto" src="<?php echo General::getAvatar($this->author->mail); ?>" alt="" width="26" height="26">  <span><?php $this->author->screenName(); ?></span>
              </a>
            </li>
            <li class="list-inline-item mt-2">—</li>
            <li class="list-inline-item mt-2">
              <i class="ti ti-clock"></i>
              <span>预计阅读时长≈<?php General::readTime($this->cid);?>分钟</span>
            </li>
            <li class="list-inline-item mt-2">—</li>
            <li class="list-inline-item mt-2">
              <i class="ti ti-calendar-event"></i>
              <span>发表于 <?php echo General::publishTime($this->created);?></span>
            </li>
          </ul>
        </div>
      </div>

      <div class="col-lg-12">
        
      </div>
      <div class="col-lg-2 post-share-block order-1 order-lg-0 mt-5 mt-lg-0">
        <div class="position-sticky" style="top:150px">
          <span class="d-inline-block mb-3 small" style="margin-left:5px">分享</span>
          <ul class="social-share icon-box">
          <li class="d-inline-block d-lg-block me-2 mb-2" onclick="return qq_click()"><i class="ti ti-brand-qq"></i></li>
          <li class="d-inline-block d-lg-block me-2 mb-2" data-bs-toggle="modal" data-bs-target="#WeChatShare"><i class="ti ti-brand-wechat"></i></li>
            <li class="d-inline-block d-lg-block me-2 mb-2" onclick="return wb_click()"><i class="ti ti-brand-weibo"></i></li>
            <li class="d-inline-block d-lg-block me-2 mb-2" onclick="return tbs_click()"><i class="ti ti-brand-twitter"></i></li>
            <li class="d-inline-block d-lg-block me-2 mb-2" onclick="return fbs_click()"><i class="ti ti-brand-facebook"></i></li>
            <li class="d-inline-block d-lg-block me-2 mb-2" onclick="return ins_click()"><i class="ti ti-brand-linkedin"></i></li>
          </ul>
        </div>
        <script type="text/javascript">
        var title=$(document.head).find("[name=title], [name=Title]").attr("content")||document.title;
        var url=window.location.href;
        var domain=window.location.origin;
        var imgurl=$("img:first").prop("data-src")||$("img:first").prop("src");
        var description=$(document.head).find("[name=description], [name=Description]").attr("content")||"";
        var source=$(document.head).find("[name=site], [name=Site]").attr("content")||document.title;
          function qq_click(){pageLink = 'http://connect.qq.com/widget/shareqq/index.html?url='+url+'&title='+title+'&source='+source+'&desc='+description+'&pics='+imgurl;socialWindow(pageLink, 570, 570);}
          function wb_click(){pageLink = 'http://service.weibo.com/share/share.php?url='+url+'&title='+title+'&pic='+imgurl+'&appkey=';socialWindow(pageLink, 570, 570);}
          function tbs_click(){pageLink = 'https://twitter.com/intent/tweet?text='+title+'&url='+url+'&via='+domain;socialWindow(pageLink, 570, 570);}
          function fbs_click(){pageLink = 'https://www.facebook.com/sharer/sharer.php?u='+url+'&title='+title+'&source='+source+'&desc='+description+'&link='+url+'&captain=&picture='+imgurl;socialWindow(pageLink, 570, 570);}
          function ins_click(){pageLink = 'http://www.linkedin.com/shareArticle?mini=true&ro=true&title='+title+'&url='+title+'&summary='+description+'&source='+source+'&armin=armin';socialWindow(pageLink, 570, 570);}
          function socialWindow(pageLink, width, height){var left = (screen.width - width) / 2;var top = (screen.height - height) / 2;var params = "menubar=no,toolbar=no,status=no,width=" + width + ",height=" + height + ",top=" + top + ",left=" + left;window.open(pageLink,"",params);}
        </script>
       

<!-- Modal -->
<div class="modal fade" id="WeChatShare" tabindex="-1" aria-labelledby="WeChatShare" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="WeChatShare">微信分享</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
        <img src="https://api.pwmqr.com/qrcode/create/?url=<?php $this->permalink() ?>" loading="lazy">
      </div>
      <div class="modal-footer">
          <button class="btn btn-secondary" onclick="window.location.href='https://api.pwmqr.com/qrcode/create/?url=<?php $this->permalink() ?>&down=1'">保存二维码</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">关闭</button>
      </div>
    </div>
  </div>
</div>


      </div>
      <div class="col-lg-8 post-content-block order-0 order-lg-2">
        <div class="content">
          <?php echo Parse::ParseContent($this->content); ?>
        </div>

      </div>
      
   


    </div>


			
			
			
            
            
            
				</div></div></div></div>	
  

  
  </div>
</section>

<?php $this->need('footer.php'); ?>
