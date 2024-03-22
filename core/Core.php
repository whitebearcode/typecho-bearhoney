<?php
//引入方法文件
use \Untils\Markdown as Markdown;
require_once('General.php');
require_once('Parse.php');
if(file_exists(__TYPECHO_ROOT_DIR__.__TYPECHO_THEME_DIR__.'/bearhoney/core/Extensions/comments/Comments.php')){
require_once('Extensions/comments/Comments.php');    
}

function themeInit($self){
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
        if(isset($_GET['action']) == 'ajax_avatar' && $_SERVER['REQUEST_METHOD'] == 'GET' ) {
$host = 'https://cravatar.cn/avatar/';
$email = strtolower( $_GET['email']);
            $hash = md5($email);
 $avatar = $host . $hash;
        echo $avatar; 
        die();
    }else { return; }
}

function themeFields(Typecho_Widget_Helper_Layout $layout)
{
    
    $cover = new Typecho_Widget_Helper_Form_Element_Text('cover', null, null, '文章封面', '输入文章封面图片直链');
    $layout->addItem($cover);
   
    $excerpt = new Typecho_Widget_Helper_Form_Element_Textarea('excerpt', null, null, '文章摘要', '输入自定义摘要，留空自动从文章截取。');
    $layout->addItem($excerpt);
    
    
}