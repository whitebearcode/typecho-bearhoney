<?php 
error_reporting(0);
use Typecho\Common;
use Typecho\Exception;
use Typecho\Router;
use Utils\Helper;
use Widget\Options;
if(!class_exists('CSF')){
    require_once Helper::options()->pluginDir('BearHoneyCore').'/bhoptions-framework.php';
}
if (!class_exists('bhOptions')){
    require_once \Utils\Helper::options()->pluginDir('BearHoneyCore').'/bhOptions.php';
}
require_once('core/Core.php');
function themeVersion()
        {
            return '1.2.8.20250805';
        }
function themeVersionOnly()
        {
            return '1.2.8';
        }

/**解析表情**/
$emo = false;
function reEmo($comment,$type){
    global $emo;
    $options = Helper::options();
    if(!$emo){
        $opts = array(
  'http'=>array(
   'method' => 'GET',
          'header' => 'Content-type: application/json',
          'timeout' => 60,
       'Connection'=>"close"
  )
);
$context = stream_context_create($opts);

        if(General::Options('Emoji_HideDefault') == false || General::Options('Emoji_HideDefault') == ''){
        $res = json_decode(file_get_contents($options->themeUrl."/assets/plugins/emoji/emoji.json", false, $context),true);
        $emo = $res;
        }
        if(General::Options('Emoji_Diy') == true && General::Options('Emoji_DiyUrl') !== ''){
        $res2 = json_decode(file_get_contents(General::Options('Emoji_DiyUrl'), false, $context),true);
        if(General::Options('Emoji_HideDefault') == false || General::Options('Emoji_HideDefault') == ''){
        $emo = array_merge($res,$res2);
        }
        else{
        $emo = $res2;    
        }
        }
        
        
    }


    foreach ($emo as $v){
        if($v['category'] !== ''){
                if($type == 'comment'){
                $comment = str_replace($v['data'], '<img width="30" height="30" src='.$v['icon'] .''.' loading="lazy">', $comment);
                }
                elseif($type == 'reply'){
                $comment = str_replace($v['data'], '<img width="20" height="20" src='.$v['icon'] .''.' loading="lazy">', $comment);
                }
                elseif($type == 'circle'){
                $comment = str_replace($v['data'], '<img class="honeyemo" width="25" height="25" src='.$v['icon'] .''.' loading="lazy" style="vertical-align:middle">', $comment);
                }
                else{
                $comment = str_replace($v['data'], '<img width="30" height="30" src='.$v['icon'] .''.' loading="lazy">', $comment);                    
                }
        }
    }
    //当评论没有私密评论时去除私密评论识别标签
    $comment = str_replace('@私密@', '', $comment);
    return $comment;
}


$options = bhOptions::getInstance()::get_option( 'bearhoney' );

if( class_exists( 'CSF' ) ) {
    $Tyoptions = Helper::options();
    $db = \Typecho\Db::get();
  $prefix = 'bearhoney'; 
  CSF::createOptions( $prefix, array(
    'menu_title' => 'Bearhoney',
    'menu_slug'  => 'my-bearhoney',
  ) );
  CSF::createSection( $prefix, array(
    'title'       => '使用说明',
    'icon'        => 'fas fa-bolt',
    'description' => '欢迎使用BearHoney主题，本主题为<strong>日志类主题</strong>，以下是本主题的使用说明。',
    'fields'      => array(

        array(
            'type'    => 'heading',
            'content' => '使用说明',
        ),

        array(
            'type'    => 'content',
            'content' => '1、主题用户交流QQ群:561848356<br>2、主题文档中心:<a href="https://docs.whitebear.dev/">戳这里访问</a><br><font color=red>3、若主题配置保存失败请检查是否开启了防火墙，且防火墙是否拦截了请求</font><br>4、不懂的问题或本主题存在的问题可加群或在BearTalk社区中进行反馈，也可先在文档中心查询<br>
    5、
        BearTalk社区是为使用者提供的一个讨论交流社区，传送门：<a href="https://www.beartalk.ru" target="_blank">戳这里</a><center>  <br>
 <div class="csf-submessage csf-submessage-info">当前版本: v'.themeVersion().' / 最新版本: v<font id="version"></font></div>
<div id="versiontips" style="margin-top:10px"></div></center>


<script src="'.Helper::options()->themeUrl.'/assets/plugins/jquery/jquery.min.js"></script>
  <script src="'.Helper::options()->themeUrl.'/assets/plugins/layer/layer.min.js?v=1" type="application/javascript"></script>
<script>

$(function() {


$.post("https://upgrade.typecho.co.uk/Bearhoney/version.php",function(data,status){
switch(status)
{
case "success":
json = JSON.parse(data);
nowversion = "'.themeVersion().'";
$("#version").html(json.version);
if(json.version > nowversion){
if (/(iPhone|iPad|iPod|iOS|Android)/i.test(navigator.userAgent)) {
    $("#versiontips").html(\'<div class="csf-submessage csf-submessage-warning">检测到有新版本可以更新，请及时完成更新!<br><a href="#check" class="ui warning label">前往更新<a></div>\');
} else {
    $("#versiontips").html(\'<div class="csf-submessage csf-submessage-warning">检测到有新版本可以更新，请及时完成更新!<br><a href="#tab=在线升级" class="ui warning label">前往更新<a></div>\'); 
};

}
break;
case "error":
$("#version").html("最新版本获取失败");
break;
case "timeout":
$("#version").html("最新版本获取超时");
break;
default: $("#version").html("'.themeVersion().'");
}
    });
});
</script>',
        ),

        array(
            'type'    => 'submessage',
            'style'   => 'info',
            'content' => '在反馈本主题相关的问题时，请务必将以下内容放入您要反馈的内容中',
        ),
array(
                'type'    => 'notice',
            'style'   => 'info',
                'content' => '<ul style="margin:0 auto;"><li>BearHoney主题版本：v'.themeVersion().'[<a href="https://docs.whitebear.dev/index.php/archives/7/" target="_blank">更新日志</a>]</li><li>PHP版本：'.PHP_VERSION.'</li><li>网站服务器：'.$_SERVER['SERVER_SOFTWARE'].'</li><li>数据库：'.$db->getAdapterName().'[Version：'.$db->getVersion().']</li><li>Typecho版本：'.$Tyoptions->version.'</li><li>User Agent信息：'.$_SERVER['HTTP_USER_AGENT'].'</li></ul>',
        ),

    )
) );
  CSF::createSection( $prefix, array(
    'title'  => '基础设置',
    'icon'   => 'fas fa-rocket',
    'fields' => array(

      array(
            'id'      => 'header_choose',
            'type'    => 'radio',
            'title'   => '站点LOGO类型',
            'inline'  => true,
            'options' => array(
                'text'    => '文字LOGO',
                'image'   => '图片LOGO',
            ),
            'default' => 'text'
        ),
      array(
        'id'    => 'textlogo_text',
        'type'  => 'text',
        'title' => '站点文字LOGO',
        'default' => $Tyoptions->title,
        'after' => '请填入站点文字LOGO',
        'dependency' => array( 'header_choose', '==', 'text' ),
      ),

      array(
            'id'      => 'imagelogo',
            'title'   => '站点图片LOGO',
            'after' => '请上传站点图片LOGO',
            'type'    => 'upload',
            'dependency' => array( 'header_choose', '==', 'image' ),
        ),
     array(
            'id'      => 'imagelogo_dark',
            'title'   => '站点图片LOGO[黑暗模式]',
            'after' => '请上传黑暗模式时的站点图片LOGO',
            'type'    => 'upload',
            'dependency' => array( 'header_choose', '==', 'image' ),
        ),
     
      array(
            'id'      => 'favicon',
            'type'    => 'upload',
            'title'   => '站点Favicon图标',
        ),
      array(
            'id'      => 'diyFont',
            'type'    => 'upload',
            'title'   => '站点自定义字体',
            'after' => '可填写自定义字体地址或直接上传自定义字体~',
        ),  
    array(
        'id'    => 'index_text',
        'type'  => 'text',
        'title' => '站点首页格言',
        'after' => '请填入站点首页格言',
      ),
      array(

            'id'      => 'accentColor',
            'type'    => 'color',
            'title'       => '全局强调色',
            'after' => '请选择全局强调色，它将用于多个地方，不建议设置为transparent（透明色），不选则为暗黄色。'
        ), 
    array(
            'id'      => 'articleListStyle',
            'type'    => 'radio',
            'title'   => '文章列表模式',
            'inline'  => true,
            'options' => array(
                'text'    => '纯文字模式',
                'pic'    => '图文模式',
            ),
            'default' => 'text',
            'after' => '图文模式的图片封面优先级：<br>文章封面自定义字段->文章附件首张图片->文章内容中首张图片->随机图片->默认图片',
        ),
        array(
        'id'    => 'articleListStyle_RandPic',
        'type'  => 'textarea',
        'title' => '随机图片列表',
        'after' => '请填入图片直链，多张图片使用|分隔',
        'dependency' => array( 'articleListStyle', '==', 'pic' )
      ),
    array(
            'id'      => 'avatar__choose',
            'type'    => 'radio',
            'title'   => '头像服务选择',
            'inline'  => true,
            'options' => array(
                'cravatar'    => 'Cravatar服务(cravatar.cn)',
                'cravatar2'    => 'Cravatar服务(cravatar.com)',
                'weavatar'   => 'Weavatar服务',
                'gravatar'   => 'Gravatar服务',
                'diyavatar'   => '自定义头像',
            ),
            'default' => 'cravatar',
            'after' => 'Cravatar服务：Cravatar适合在国内使用，优先级:Cravatar头像->Gravatar头像->QQ头像<br>Weavatar服务：Weavatar也适合在国内使用，优先级:Weavatar头像->Gravatar头像->QQ头像<br>Gravatar服务：在国内官方源可能访问不了头像，支持了多个镜像源并支持您填写自定义镜像源<br>自定义头像：您可以通过自定义头像在前台为每个用户显示出随机头像，在自定义头像栏为空时默认为Cravatar<br><font color=red>目前QQ头像调用的是Weavatar，若注册过Weavatar，则不会显示QQ头像</font>',
        ),
        array(
            'id'      => 'Cravatar_default',
            'type'    => 'upload',
            'title'   => 'Cravatar默认头像',
            'after' => '考虑到Cravatar默认头像略丑的问题，这里支持自定义Cravatar默认头像。',
            'dependency' => array( 'avatar__choose', '==', 'cravatar' ),
        ),
        array(
            'id'      => 'Cravatar2_default',
            'type'    => 'upload',
            'title'   => 'Cravatar默认头像',
            'after' => '考虑到Cravatar默认头像略丑的问题，这里支持自定义Cravatar默认头像。',
            'dependency' => array( 'avatar__choose', '==', 'cravatar2' ),
        ),
        array(
            'id'      => 'Weavatar_default',
            'type'    => 'upload',
            'title'   => 'Weavatar默认头像',
            'after' => '考虑到Weavatar默认头像略丑的问题，这里支持自定义Weavatar默认头像。',
            'dependency' => array( 'avatar__choose', '==', 'weavatar' ),
        ),
        array(
        'id'    => 'DiyAvatar',
        'type'  => 'textarea',
        'title' => '自定义头像',
        'after' => '您可以自定义前台评论区随机头像，格式为a.png,b.png，保证每个头像图片都为直链可直接访问，多个头像图片使用英文逗号分隔，当本栏为空时默认使用Cravatar服务。',
        'dependency' => array( 'avatar__choose', '==', 'diyavatar' ),
      ),
      array(
            'id'          => 'Gravatar',
            'type'        => 'select',
            'title'       => 'Gravatar源选择',
            'after' => '因Gravatar官方在中国大陆地区被Q，导致在中国大陆访问使用Gravatar的站点时头像不显示,这里支持您自主选择合适的源,若为自定义，举例:cdn.v2ex.com/gravatar/<br>本功能适配QQ,当填写的邮箱为QQ邮箱时则显示QQ头像',
            'options'     => array('1' => 'Gravatar官方源', '3' => 'V2EX*Gravatar镜像源','4' => 'LOLI.NET*Gravatar镜像源','7' => '自定义Gravatar镜像源'),
            'default' => '5',
            'dependency' => array( 'avatar__choose', '==', 'gravatar' ),
        ),
      array(
        'id'    => 'GravatarUrl',
        'type'  => 'text',
        'title' => '自定义Gravatar源地址',
        'after' => '请填入自定义Gravatar镜像源地址,格式:cdn.v2ex.com/gravatar/<br>Tips:当您所填写的自定义地址访问时能够显示图片时则您所填写的地址是正常的',
        'dependency' => array( 'Gravatar|avatar__choose', '==|==', '7|gravatar' ),
      ),
      
    )
  ) );
CSF::createSection( $prefix, array(
    'title'  => '顶部设置',
    'icon'   => 'fas fa-chevron-up',
    'fields' => array(
     
        array(
            'id'       => 'CustomizationCode',
            'type'     => 'code_editor',
            'title'    => '顶部自定义代码',
            'subtitle' => '如百度Meta验证代码，均可以放在这里',
        ),
        array(
            'id'      => 'showLogin',
            'type'    => 'switcher',
            'title'       => '是否显示登录按钮',
            'subtitle' => '可选择是否显示登录按钮，登录后将显示管理中心入口。',
            'default' => false,
        ),
        
    )
  ) );
  CSF::createSection( $prefix, array(
    'title'  => '底部设置',
    'icon'   => 'fas fa-chevron-down',
    'fields' => array(
    array(
        'id'    => 'IcpBa',
        'type'  => 'text',
        'title' => 'ICP备案号',
        'after' => '请填写您网站的ICP备案号,若无ICP备案请为空',
      ),
      array(
        'id'    => 'PoliceBa',
        'type'  => 'text',
        'title' => '公安备案号',
        'after' => '请填写您网站的公安备案号,若无公安备案请为空',
      ),
      array(
            'id'       => 'CustomizationFooterCode',
            'type'     => 'code_editor',
            'title'    => '底部自定义代码',
            'after' => '可放置网站统计代码等<br><font color=red>谨慎填写，仅需填写代码即可！</font>需注意语法，若语法错误可能会造成前台报错甚至组件动作失效！',
        ),
    array(
            'id'       => 'CustomizationFooterJsCode',
            'type'     => 'code_editor',
            'title'    => '底部自定义JS代码',
            'after' => '可放置自定义JS代码等<br><font color=red>谨慎填写，仅需填写代码即可！</font>需注意JS语法，若语法错误可能会造成前台报错甚至组件动作失效！',
        ),
    )
  ) );
  CSF::createSection( $prefix, array(
    'title'  => '扩展中心',
    'icon'   => 'fas fa-building',
    'fields' => array(
      array(
            'type'    => 'heading',
            'content' => '扩展中心',
        ),
        array(
            'type'    => 'subheading',
            'content' => '您可以通过扩展中心安装您所需要的功能扩展<br><div class="ui red label" id="rebuildExtension">戳这里重建扩展表</div>',
        ),

        array(
                    'type' =>'content',
                    'content' => '
                    <style>
                    .label{cursor: pointer;}
                    </style>
                    <div class="ui secondary menu"style="margin-top:-30px;">
    <a class="active item" data-tab="first">未安装</a>
  <a class="item" data-tab="second">未启用</a>
  <a class="item" data-tab="third">已启用</a>
  <a class="item" data-tab="fourth">检测更新</a>
</div>
  <!-- ExtensionsList loading -->
			<div class="ui basic segment" id="extensionsList-Loading" style="display:none">
    <div class="ui active blue elastic loader"></div>
    
    <br>
    <br>
    <br>
    <br>
</div>
<div class="ui bottom attached active tab " data-tab="first">

                   <table class="ui celled long scrolling black table">
  <thead>
    <tr>
    <th>扩展ID</th>
      <th>扩展名称</th>
      <th>扩展描述</th>
      <th>扩展版本</th>
      <th>扩展作者</th>
      <th>状态</th>
      <th>操作</th>
    </tr>
  </thead>
  <tbody id="extensionsList" style="word-break:break-all">

  </tbody>
</table>
<div class="extensionsPage"></div>
</div>


<div class="ui bottom attached tab " data-tab="second">

  <table class="ui celled long scrolling black table">
  <thead>
    <tr>
    <th>扩展ID</th>
      <th>扩展名称</th>
      <th>扩展描述</th>
      <th>扩展版本</th>
      <th>扩展作者</th>
      <th>状态</th>
      <th>操作</th>
    </tr>
  </thead>
  <tbody id="extensionsList_noOpen" style="word-break:break-all">

  </tbody>
</table>
<div class="extensionsPage_noOpen"></div>


</div>

<div class="ui bottom attached tab " data-tab="third">

 <table class="ui celled long scrolling black table">
  <thead>
    <tr>
    <th>扩展ID</th>
      <th>扩展名称</th>
      <th>扩展描述</th>
      <th>扩展版本</th>
      <th>扩展作者</th>
      <th>状态</th>
      <th>操作</th>
    </tr>
  </thead>
  <tbody id="extensionsList_Open" style="word-break:break-all">

  </tbody>
</table>
<div class="extensionsPage_Open"></div>



</div>

<div class="ui bottom attached tab " data-tab="fourth">

  <table class="ui celled long scrolling black table">
  <thead>
    <tr>
    <th>扩展ID</th>
      <th>扩展名称</th>
      <th>扩展描述</th>
      <th>扩展作者</th>
      <th>当前版本</th>
      <th>最新版本</th>
      <th>操作</th>
    </tr>
  </thead>
  <tbody id="extensionsList_Upgrade" style="word-break:break-all">
  </tbody>
</table>
<div class="extensionsPage_Upgrade"></div>
</div>
<script src="'.Helper::options()->themeUrl.'/assets/js/bearhoney_backend.js?v=13"></script>
',
                ),
               
        
    )
  ) );
  require_once('core/Extensions.php');
  
  
  
  
CSF::createSection( $prefix, array(
    'title'       => '数据备份',
    'icon'        => 'fas fa-shield-alt',
    'description' => '本主题支持您通过以下功能对您所填写的配置信息进行备份导出，也可以对备份的数据进行导入。',
    'fields'      => array(

        array(
            'type' => 'backup',
        ),

    )
) );

?>

<?php

                $htmls = '
        <div class="ui three steps">
  <div class="step" id="check">
    <i class="tree icon"></i>
    <div class="content">
      <div class="title">检测</div>
    </div>
  </div>
  <div class="disabled step" id="upgrade">
    <i class="angle double right icon"></i>
    <div class="content">
      <div class="title">升级</div>
    </div>
  </div>
  <div class="disabled step" id="finished">
    <i class="info icon"></i>
    <div class="content">
      <div class="title">完成</div>
    </div>
  </div>
</div>
<div id="checkcon">
<div class="ui placeholder segment">
  <div class="ui icon header">
    <i class="cloud icon"></i>
    您可以通过点击以下按钮进行检测是否符合在线升级的条件
  </div>
  <div class="inline">
    <div class="ui button" id="checkbtn">检测版本</div>
  </div>

</div>
  <div id="versiontipss"></div>
</div>
<div id="upgradecon" style="display:none">
<div class="ui placeholder segment">
  <div class="ui icon header">
    <i class="cloud icon"></i>
    检测到最新版本为 v<font id="newversion"></font>，您可以通过点击以下按钮进行在线升级
  </div>
<div class="ui piled segment" style="margin-top:10px;">
  <h4 class="ui header">更新内容</h4>
  <p id="upgradelog"></p>
</div>
  <div class="inline">
    <div class="ui button" id="upgradebtn" style="margin-top:-10px;">立即更新</div>
    
  </div>
 <center><div id="pre-message" style="margin-top:20px;"></div></center>
 <center><div id="progress-message" style="margin-top:20px;"></div></center>
<progress id="progress" value="0" max="100" style="display:none;margin-top:10px;width:100%;max-width:100%;height:20px"></progress> 

</div>
</div>

<div id="finishcon" style="display:none">
<div class="ui placeholder segment">
  <div class="ui icon header">
    <i class="green check icon"></i>
    您已成功升级到最新版本，系统将在三秒后自动刷新~~~
  </div>

</div>
</div>

<script>
//检测
$("#checkbtn").on("click",function(){
$("#checkbtn").addClass("loading").attr("disabled","disabled");
    $.post("https://upgrade.typecho.co.uk/Bearhoney/version.php",function(data,status){
switch(status)
{
case "success":
json = JSON.parse(data);
nowversion = "'.themeVersion().'";
if(json.version > nowversion){
$("#versiontipss").html(\'<div class="csf-submessage csf-submessage-warning">检测到有新版本可以更新，3秒钟后自动跳转下一步!</div>\');
$("#newversion").html(json.version);
$.post("https://upgrade.typecho.co.uk/Bearhoney/upgrade_log.php",function(data,status){
$("#upgradelog").html(data);
});
setTimeout(function(){
$("#check").addClass("completed");
$("#upgrade").removeClass("disabled");
$("#checkcon").hide();
$("#upgradecon").fadeIn();
},3000);
}
if(json.version == nowversion){
$("#versiontipss").html(\'<div class="csf-submessage csf-submessage-success">当前版本为最新版本，无需更新~<a href="https://docs.whitebear.dev/index.php/archives/7/" target="_blank">查看版本更新日志</a></div>\');
$("#checkbtn").removeClass("loading").removeAttr("disabled","disabled");
}
break;
case "error":
toastr.warning("最新版本获取失败，请稍后重试");
$("#checkbtn").removeClass("loading").removeAttr("disabled","disabled");
break;
case "timeout":
toastr.warning("最新版本获取超时，请稍后重试");
$("#checkbtn").removeClass("loading").removeAttr("disabled","disabled");
break;
}
    });
});

//升级
$("#upgradebtn").on("click",function(){
$("#upgradebtn").addClass("loading").attr("disabled","disabled");
$("#upgradebtn").css("pointer-events","none");

$.ajax({
                        type: "GET",
                        url: "/index.php/bh-upgrade",
                        data: {
                            "action": "prepare-download",
                        },
                        dateType: "json",
                        success: function(json) {
                            json = JSON.parse(json);
                            if(json.code == 0){
                             layer.msg(json.message, {icon: 2});  
                             $("#upgradebtn").removeClass("loading").removeAttr("disabled","disabled");
$("#upgradebtn").css("pointer-events","auto");
                            }
                            else{
                           $("#pre-message").html("升级包大小："+json.filesize+"，预计需要三十秒，请耐心等待~");
                           $("#progress-message").html("升级进度：0%");
                           $("#progress").fadeIn();
                        let x = document.getElementById("progress");   
                        x.setAttribute("value", "1");
                        intervaldown();
                        //设置定时器定时每5秒获取一次升级进度
                        let progressx = setInterval(function(){ 
                        intervalprogress();
                        }, 5000);
                        $("#progress").one("click",function(){
                            clearInterval(progressx);
                            finishUpgrade();
                        })
                        
                        
                            }
                        },
                        error: function() {
alert("升级准备检测失败，请稍后重试");
$("#upgradebtn").removeClass("loading").removeAttr("disabled","disabled");
                        }
                    });
                    
});
function intervaldown(){
$.ajax({
                        type: "GET",
                        url: "/index.php/bh-upgrade",
                        data: {
                            "action": "download",
                        },
                        dateType: "json",
                    });
}
function intervalprogress(){
$.ajax({
                        type: "GET",
                        url: "/index.php/bh-upgrade",
                        data: {
                            "action": "getsize",
                        },
                        dateType: "json",
                        success: function(json) {
                            json = JSON.parse(json);
                           $("#progress-message").html("升级进度："+json.filesize+"%");
let x = document.getElementById("progress");   
                        x.setAttribute("value", json.filesize);
                if(json.filesize == "100"){
                
                $("#progress-message").html("正在进行数据效验，请稍后...");
                setTimeout(function(){
                   $("#progress").click();
},3000);
                }
                        },
                        error: function() {
alert("获取升级进度失败");
                        }
                    });
}
function finishUpgrade(){
$.ajax({
                        type: "GET",
                        url: "/index.php/bh-upgrade",
                        data: {
                            "action": "finish",
                        },
                        dateType: "json",
                        success: function(json) {
$("#upgrade").addClass("completed");
$("#finished").removeClass("disabled");
$("#upgradecon").hide();
$("#finishcon").fadeIn();
setTimeout(function(){
window.parent.location.reload();
},3000);
                        },
                        error: function() {
alert("升级失败");
                        }
                    });
}
</script>
        ';
        
        CSF::createSection( $prefix, array(
    'title'       => '在线升级',
    'icon'        => 'fa fa-grav',
    
    'fields'      => array(
        array(
            'type'    => 'notice',
            'style'   => 'info',
            'content' => '<strong>注意事项</strong><p> <ul><li>1、若您有开启缓存，那么在升级完成后需要清除一次缓存。</li><li>2、若出现在线升级卡顿无法升级，可能是您的服务器网络到升级节点之间存在异常，则需要手动覆盖升级或者稍等一会再试试。</li><li>3、若升级完毕后出现报错，可尝试通过手动覆盖新版本来进行修复，下载地址:<a href="https://files.bear.dance/Bearhoney/Bearhoney_v'.themeVersionOnly().'.release.zip">戳这里</a></ul></p>',
        ),
array(
                    'type' =>'content',
                    'content' => $htmls,
                ),
        

    )
) );
}
function themeConfig($form)
{

   ?>
       <?php $all = Typecho_Plugin::export();
       \Widget\Security::alloc()->to($security);?>
<?php if (!array_key_exists('BearHoneyCore', $all['activated'])) : ?>
   <div class="update-check message error"><p>检测到未开启BearHoneyCore，主题尚处于封印状态，您需要安装启用BearHoneyCore核心插件后方能解除封印！<br>当下方出现解除封印按钮时点击按钮后即可解除封印~~~
   <?php if(is_dir(Helper::options()->pluginDir('BearHoneyCore'))):?><br><br><button onclick="window.location.href='<?php $security->index('/action/plugins-edit?activate=BearHoneyCore'); ?>'"  class="btn">
解除封印</button></p>
</div>
<?php endif;?>
   <?php else:?>
<style>
.body.container{
    max-width:100%!important;
}
</style>
      <link href="<?php echo Helper::options()->themeUrl;?>/assets/plugins/toastr/toastr.min.css" rel="stylesheet">
	<script src="<?php echo Helper::options()->themeUrl;?>/assets/plugins/toastr/toastr.min.js"></script>
        
<?php

    $params = [
        'args'=> [
            'framework_title' => 'BearHoney v'.themeVersionOnly(),
            'footer_text' => '自豪的采用BearHoney主题!',
        ]
    ];
    CSF::setup('bearhoney', $params);
    
    ?>
       <?php endif; ?>
       <?php
       CSF::setTypechoOptionForm($form);
       ?>
              <?php if (array_key_exists('BearHoneyCore', $all['activated'])) : ?>
          <style>

        .popup{
            all:unset;
            font-size:0; overflow:hidden;
        }
        .message{
            all:unset;
            font-size:0; overflow:hidden;
        }
        .message a{
            all:unset;
            font-size:0; overflow:hidden;
        }
        .success{
            all:unset;
            font-size:0; overflow:hidden;
        }
        .success a{
            all:unset;
            font-size:0; overflow:hidden;
        }
        .message.popup.success{
            all:unset;
            font-size:0; overflow:hidden;
        }
        </style>
           <script>
           window.deactivateURL = '<?php $security->index('/action/plugins-edit?deactivate=BearHoneyCore'); ?>';
           window.activateURL = '<?php $security->index('/action/plugins-edit?activate=BearHoneyCore'); ?>';
           window.siteName = "<?php echo Helper::options()->title; ?>";
           window.siteDesc = "<?php echo Helper::options()->description; ?>";
           window.siteUrl = "<?php echo Helper::options()->siteUrl; ?>";
           window.useTheme = 'bearhoney';
           window.siteToken = '<?php echo General::md5Encode(Helper::options()->siteUrl); ?>7bae2123bear';
        </script>
<?php endif; ?>

       <?php if (!array_key_exists('BearHoneyCore', $all['activated'])) : ?>
       
    <script src="'.Helper::options()->themeUrl.'/assets/plugins/jquery/jquery.min.js"></script>
    

   <script>
       $('#wpwrap').hide();
   </script>
   <?php endif; ?>
    <?php
} ?>