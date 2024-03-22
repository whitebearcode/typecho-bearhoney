<?php
namespace TypechoPlugin\BearHoneyCore;
use BearHoneyCore;
use bhOptions;
use \Utils\Helper;
use Typecho\{Exception, Widget, Db};
use Typecho\Cookie;
use Widget\Options;


if(!class_exists('CSF')){
    require_once Helper::options()->pluginDir('BearHoneyCore').'/bhoptions-framework.php';
}

if (!class_exists('bhOptions')){
    require_once \Utils\Helper::options()->pluginDir('BearHoneyCore').'/bhOptions.php';
}

class Action extends Widget implements \Widget\ActionInterface
{

 

    /**
     * 初始化
     * @return $this
     */
    
}