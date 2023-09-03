<?php
namespace BearExtensions\gotop;
use Utils\Helper;
use bhOptions;
class Extension{
    public static function getNS(): string
    {
        return __NAMESPACE__;
    }
    public static function activate(){
       \Typecho\Plugin::factory('Widget_Archive')->header_1 = [__CLASS__, 'headlink']; 
       \Typecho\Plugin::factory('Widget_Archive')->footer_1 = [__CLASS__, 'footlink']; 
    }
    public static function headlink(){
        $options = bhOptions::getInstance()::get_option('bearhoney');
        $dir = Helper::options()->themeUrl.'/core/Extensions/gotop/';
        $cssUrl = $dir.'style.css';
        if($options['gotop_open'] == true){
        echo '<link rel="stylesheet" type="text/css" href="' . $cssUrl . '" />';
        }
    }
    public static function footlink(){
        $options = bhOptions::getInstance()::get_option('bearhoney');
        $dir = Helper::options()->themeUrl.'/core/Extensions/gotop/';
        $jsUrl = $dir.'script.js';
        if($options['gotop_open'] == true){
        echo '
        <div class="progress-wrap">
		<svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
			<path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"/>
		</svg>
	</div>
        <script src="' . $jsUrl . '" /></script>';
    }
    }
}
