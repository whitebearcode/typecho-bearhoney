<?php
//引入方法文件
use \Untils\Markdown as Markdown;
require_once('General.php');
require_once('Parse.php');



function themeInit($self){
     //升级API
        if (strpos($_SERVER['REQUEST_URI'], 'bh-upgrade') !== false) {
            $self->response->setStatus(200);
            $self->setThemeFile("modules/Upgrade/Upgrade.php");
        }
}

function themeFields(Typecho_Widget_Helper_Layout $layout)
{
    
    $cover = new Typecho_Widget_Helper_Form_Element_Text('cover', null, null, '文章封面', '输入文章封面图片直链');
    $layout->addItem($cover);
   
    $excerpt = new Typecho_Widget_Helper_Form_Element_Textarea('excerpt', null, null, '文章摘要', '输入自定义摘要，留空自动从文章截取。');
    $layout->addItem($excerpt);
    
    
}