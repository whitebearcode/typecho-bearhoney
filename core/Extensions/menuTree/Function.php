<?php
namespace BearExtensions\menuTree;
use Utils\Helper;
use bhOptions;
class Extension{
    public static function getNS(): string
    {
        return __NAMESPACE__;
    }
    public static function activate(){
       \Typecho\Plugin::factory('Widget_Archive')->header_menuTree = [__CLASS__, 'headlink2']; 
       \Typecho\Plugin::factory('Widget_Archive')->footer_menuTree = [__CLASS__, 'footlink2']; 
    }
    public static function headlink2(){
        $options = bhOptions::getInstance()::get_option('bearhoney');
        $dir = Helper::options()->themeUrl.'/core/Extensions/menuTree/';
        $cssUrl = $dir.'menutree.min.css?v=1.0.1';
        if($options['menuTree_open'] == true){
        echo '<link rel="stylesheet" type="text/css" href="' . $cssUrl . '" />';
        }
    }
    public static function footlink2(){
        $options = bhOptions::getInstance()::get_option('bearhoney');
        $dir = Helper::options()->themeUrl.'/core/Extensions/menuTree/';
        $jsUrl = $dir.'menutree.min.js?v=1.0.1';
        if($options['menuTree_name'] == ''){
          $options['menuTree_name'] = '文章导读';  
        }
        if($options['menuTree_showCode'] == ''){
          $options['menuTree_showCode'] = 'false';  
        }
        if($options['menuTree_open'] == true){
        echo '
            <script src="' . $jsUrl . '" /></script>
        <script>
       (function(){
    const defaults = Outline.DEFAULTS
    let outline
    defaults.title =  "'.$options['menuTree_name'].'", 
    defaults.selector = "h1,h2,h3,h4,h5,h6",
    defaults.position = "relative",
    defaults.showCode = '.$options['menuTree_showCode'].',
    defaults.stickyHeight = 86,
    defaults.parentElement = "#aside",
    defaults.articleElement = ".content",
    outline = new Outline(Outline.DEFAULTS)
  })();
  </script>'
    ;
    }
    }
}
