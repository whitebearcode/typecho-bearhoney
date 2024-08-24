<?php
//引入方法文件
use \Untils\Markdown as Markdown;
require_once('General.php');
require_once('Parse.php');
if(file_exists(__TYPECHO_ROOT_DIR__.__TYPECHO_THEME_DIR__.'/bearhoney/core/Extensions/comments/Comments.php')){
require_once('Extensions/comments/Comments.php');    
}
if(file_exists(__TYPECHO_ROOT_DIR__.__TYPECHO_THEME_DIR__.'/bearhoney/core/Extensions/friendCircle/FriendCircle.php')){
require_once('Extensions/friendCircle/FriendCircle.php'); 
}
function themeInit($self){
    $options = Helper::options();
    $options->commentsOrder = 'DESC';
$options->commentsAntiSpam = false;
    //同步
        if (strpos($_SERVER['REQUEST_URI'], 'syncData') !== false) {
            $self->response->setStatus(200);
            $self->setThemeFile("core/Functions/syncDataAction.php");
        }       
    //Emoji
if (strpos($_SERVER['REQUEST_URI'], 'bearEmoji') !== false) {
            $self->response->setStatus(200);
            $self->setThemeFile("core/Functions/getEmojiAction.php");
        } 
    //Circle
if (strpos($_SERVER['REQUEST_URI'], 'getCircleAction') !== false) {
            $self->response->setStatus(200);
            $self->setThemeFile("core/Functions/circleAction.php");
        }  
            if (strpos($_SERVER['REQUEST_URI'], 'getIsLogin') !== false) {
            $self->response->setStatus(200);
            $self->setThemeFile("core/Functions/getLogin.php");
        }
    //评论动作
         if (strpos($_SERVER['REQUEST_URI'], 'getCommentAction') !== false) {
            $self->response->setStatus(200);
            $self->setThemeFile("core/Functions/getCommentAction.php");
        }
     //升级API
        if (strpos($_SERVER['REQUEST_URI'], 'bh-upgrade') !== false) {
            $self->response->setStatus(200);
            $self->setThemeFile("modules/Upgrade/Upgrade.php");
        }
    //扩展操作API
        if (strpos($_SERVER['REQUEST_URI'], 'bh-extension') !== false) {
            $self->response->setStatus(200);
            $self->setThemeFile("core/Functions/extensionAction.php");
        }
    //文章查询操作API
        if (strpos($_SERVER['REQUEST_URI'], 'bh-searchArticle') !== false) {
            $self->response->setStatus(200);
            $self->setThemeFile("core/Functions/articleAction.php");
        }
         if (strpos($_SERVER['REQUEST_URI'], 'bhoptions/ajax') !== false) {
            $self->response->setStatus(200);
            $self->setThemeFile("core/Functions/Ajax.php");
        }     
    if(@$_GET['action'] === 'ajax_avatar_get' && $_GET['email'] !== null) {
$host = 'https://cravatar.cn/avatar/';
$email = strtolower( $_GET['email']);
            $hash = md5($email);
 $avatar = $host . $hash;
        echo $avatar; 
        die();
    }
    if($_SERVER['REQUEST_METHOD'] === 'POST' && strpos($_SERVER['REQUEST_URI'], 'getCircleAction') == false && strpos($_SERVER['REQUEST_URI'], 'getIsLogin') == false && strpos($_SERVER['REQUEST_URI'], 'getCommentAction') == false && strpos($_SERVER['REQUEST_URI'], 'bh-upgrade') == false && strpos($_SERVER['REQUEST_URI'], 'bh-extension') == false && strpos($_SERVER['REQUEST_URI'], 'bh-searchArticle') == false && strpos($_SERVER['REQUEST_URI'], 'bhoptions/ajax') == false && strpos($_SERVER['REQUEST_URI'], 'syncData') == false){
            $self->response->setStatus(200);
            $self->setThemeFile("core/Functions/getLoginAction.php");
}
    
}

function themeFields(Typecho_Widget_Helper_Layout $layout)
{
    
    $cover = new Typecho_Widget_Helper_Form_Element_Text('cover', null, null, '文章封面', '输入文章封面图片直链');
    $layout->addItem($cover);
   
    $excerpt = new Typecho_Widget_Helper_Form_Element_Textarea('excerpt', null, null, '文章摘要', '输入自定义摘要，留空自动从文章截取。');
    $layout->addItem($excerpt);
    
    
}