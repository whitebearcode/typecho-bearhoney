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
          <li class="d-inline-block d-lg-block me-2 mb-2"><a onclick="return qq_click()"><i><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-brand-qq" width="18" height="18" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
   <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
   <path d="M6 9.748a14.716 14.716 0 0 0 11.995 -.052c.275 -9.236 -11.104 -11.256 -11.995 .052z"></path>
   <path d="M18 10c.984 2.762 1.949 4.765 2 7.153c.014 .688 -.664 1.346 -1.184 .303c-.346 -.696 -.952 -1.181 -1.816 -1.456"></path>
   <path d="M17 16c.031 1.831 .147 3.102 -1 4"></path>
   <path d="M8 20c-1.099 -.87 -.914 -2.24 -1 -4"></path>
   <path d="M6 10c-.783 2.338 -1.742 4.12 -1.968 6.43c-.217 2.227 .716 1.644 1.16 .917c.296 -.487 .898 -.934 1.808 -1.347"></path>
   <path d="M15.898 13l-.476 -2"></path>
   <path d="M8 20l-1.5 1c-.5 .5 -.5 1 .5 1h10c1 0 1 -.5 .5 -1l-1.5 -1"></path>
   <path d="M13.75 7m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
   <path d="M10.25 7m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
</svg></i></a></li>
          <li class="d-inline-block d-lg-block me-2 mb-2"><a data-bs-toggle="modal" data-bs-target="#WeChatShare"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-brand-wechat" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
   <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
   <path d="M16.5 10c3.038 0 5.5 2.015 5.5 4.5c0 1.397 -.778 2.645 -2 3.47l0 2.03l-1.964 -1.178a6.649 6.649 0 0 1 -1.536 .178c-3.038 0 -5.5 -2.015 -5.5 -4.5s2.462 -4.5 5.5 -4.5z"></path>
   <path d="M11.197 15.698c-.69 .196 -1.43 .302 -2.197 .302a8.008 8.008 0 0 1 -2.612 -.432l-2.388 1.432v-2.801c-1.237 -1.082 -2 -2.564 -2 -4.199c0 -3.314 3.134 -6 7 -6c3.782 0 6.863 2.57 7 5.785l0 .233"></path>
   <path d="M10 8h.01"></path>
   <path d="M7 8h.01"></path>
   <path d="M15 14h.01"></path>
   <path d="M18 14h.01"></path>
</svg></a></li>
            <li class="d-inline-block d-lg-block me-2 mb-2"><a onclick="return wb_click()"><i></I><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-brand-weibo" width="18" height="18" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
   <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
   <path d="M19 14.127c0 3.073 -3.502 5.873 -8 5.873c-4.126 0 -8 -2.224 -8 -5.565c0 -1.78 .984 -3.737 2.7 -5.567c2.362 -2.51 5.193 -3.687 6.551 -2.238c.415 .44 .752 1.39 .749 2.062c2 -1.615 4.308 .387 3.5 2.693c1.26 .557 2.5 .538 2.5 2.742z"></path>
   <path d="M15 4h1a5 5 0 0 1 5 5v1"></path>
</svg></i></a></li>
            <li class="d-inline-block d-lg-block me-2 mb-2"><a onclick="return tbs_click()">
											<i>
												<svg xmlns="http://www.w3.org/2000/svg"
													 width="18" height="18"
													 viewBox="0 0 24 24" fill="none"
													 stroke="currentColor"
													 stroke-width="2"
													 stroke-linecap="round"
													 stroke-linejoin="round"
													 class="tabler-icon tabler-icon-brand-twitter">
														<path d="M22 4.01c-1 .49 -1.98 .689 -3 .99c-1.121 -1.265 -2.783 -1.335 -4.38 -.737s-2.643 2.06 -2.62 3.737v1c-3.245 .083 -6.135 -1.395 -8 -4c0 0 -4.182 7.433 4 11c-1.872 1.247 -3.739 2.088 -6 2c3.308 1.803 6.913 2.423 10.034 1.517c3.58 -1.04 6.522 -3.723 7.651 -7.742a13.84 13.84 0 0 0 .497 -3.753c0 -.249 1.51 -2.772 1.818 -4.013z"></path>
												</svg>
											</i>
										</a></li>
  
            <li class="d-inline-block d-lg-block me-2 mb-2">
										<a onclick="return fbs_click()">
											<i>
												<svg xmlns="http://www.w3.org/2000/svg"
													 width="18" height="18"
													 viewBox="0 0 24 24" fill="none"
													 stroke="currentColor"
													 stroke-width="2"
													 stroke-linecap="round"
													 stroke-linejoin="round"
													 class="tabler-icon tabler-icon-brand-facebook">
													<path d="M7 10v4h3v7h4v-7h3l1 -4h-4v-2a1 1 0 0 1 1 -1h3v-4h-3a5 5 0 0 0 -5 5v2h-3"></path>
												</svg>
											</i>
										</a>
									</li>
            <li class="d-inline-block d-lg-block me-2 mb-2"><a onclick="return ins_click()">
											<i>
												<svg xmlns="http://www.w3.org/2000/svg"
													 width="18" height="18"
													 viewBox="0 0 24 24" fill="none"
													 stroke="currentColor"
													 stroke-width="2"
													 stroke-linecap="round"
													 stroke-linejoin="round"
													 class="tabler-icon tabler-icon-brand-linkedin">
													<path d="M4 4m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z"></path>
													<path d="M8 11l0 5"></path>
													<path d="M8 8l0 .01"></path>
													<path d="M12 16l0 -5"></path>
													<path d="M16 16v-3a2 2 0 0 0 -4 0"></path>
												</svg>
											</i></a></li>
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
     <span class="text-primary"data-bs-dismiss="modal" aria-label="Close">
						<svg xmlns="http://www.w3.org/2000/svg" width="38"
							 height="38" viewBox="0 0 24 24" fill="none" stroke="currentColor"
							 stroke-width="2" stroke-linecap="round"
							 stroke-linejoin="round" class="tabler-icon tabler-icon-x">
							<path d="M18 6l-12 12"></path>
							<path d="M6 6l12 12"></path>
						</svg>
					</span>
      </div>
      <div class="modal-body text-center">
        <img src="https://api.pwmqr.com/qrcode/create/?url=<?php $this->permalink() ?>" width=300 height=300 loading="lazy">
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


			
			
			 <?php $this->need('comments.php'); ?>
            
            
            
				</div></div></div>
				
				</div>	
  

  
  </div>
</section>

<?php $this->need('footer.php'); ?>
