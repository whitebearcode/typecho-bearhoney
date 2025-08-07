<?php
namespace BearExtensionsLoad;
use Utils\Helper;
use bhOptions;
use Typecho\Plugin as Extension;
class Action{
    public static function getExtensionAction($method,$place,$name,$extensionName,$funcName){
     return Extension::factory($place)->$name = [$extensionName, $funcName];
}
}