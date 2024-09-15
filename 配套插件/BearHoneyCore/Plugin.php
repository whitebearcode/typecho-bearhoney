<?php
namespace TypechoPlugin\BearHoneyCore;
error_reporting(0);
use Utils\Helper;
use Typecho\Plugin\PluginInterface;
use Typecho\Widget\Helper\Form;
use Typecho\{Plugin\Exception, Widget, Db, Widget\Request as WidgetRequest};
use \CSF as CSF;
use bhOptions;
use Widget\Options;
use Typecho\Common;
use Typecho\Router;
use Widget\Archive;
use Widget\Contents\Post\Admin;
use Widget\Contents\Post\Edit;
use Widget\Feedback;
use Widget\Service;
use ReflectionClass;
use Utils\PasswordHash;
use Typecho\Widget\Response as WidgetResponse;
use Utils\Markdown as Markdown;
require_once 'loadExtensions.php';
require_once 'vendors/autoload.php';
/**
 * BearHoney主题核心插件
 * <br>安装后无需进行其他设置
 * @package BearHoneyCore
 * @author BearNotion
 * @version v1.2.0-release
 * @link https://www.bearnotion.ru/
 *
 */



if (!defined('__TYPECHO_ROOT_DIR__')) exit;
if (!defined('pluginName')) {
  define('pluginName', 'BearHoneyCore');
}
require_once 'bhoptions-framework.php';

class Plugin implements PluginInterface
{
     public static $cache = null;
	public static $html = null;
	public static $path = null;
	public static $sys_config = null;
	public static $plugin_config = null;
	public static $request = null;
	public static $passed = false;
     public static function getNS(): string
    {
        return __NAMESPACE__;
    }
    
    public static function activate()
    {
        /* 
         *
         *  初始化路由和方法
         *
         */
        bhRouter::initRouter();
        \Typecho\Plugin::factory('index.php')->begin_999 = [__CLASS__, 'initevent'];
        if(get_option('bearhoney')['Cache'] == true && !empty(get_option('bearhoney')['Cache_choose'])){
        \Typecho\Plugin::factory('index.php')->begin_15789 = [__CLASS__, 'C'];
		\Typecho\Plugin::factory('index.php')->end_15789 = [__CLASS__, 'S'];
        \Typecho\Plugin::factory('Widget_Contents_Post_Edit')->finishPublish_15789 = [__CLASS__, 'post_update'];
        \Typecho\Plugin::factory('Widget_Contents_Page_Edit')->finishPublish_15789 = [__CLASS__, 'post_update'];
        \Typecho\Plugin::factory('Widget_Contents_Post_Edit')->delete_15789 = [__CLASS__, 'post_del_update'];
        \Typecho\Plugin::factory('Widget_Contents_Page_Edit')->delete_15789 = [__CLASS__, 'post_del_update'];
        \Typecho\Plugin::factory('Widget_Feedback')->finishComment_15789 = [__CLASS__, 'comment_update'];
		\Typecho\Plugin::factory('Widget_Comments_Edit')->finishDelete_15789 = [__CLASS__, 'comment_update2'];
		\Typecho\Plugin::factory('Widget_Comments_Edit')->finishEdit_15789 = [__CLASS__, 'comment_update2'];
		\Typecho\Plugin::factory('Widget_Comments_Edit')->finishComment_15789 = [__CLASS__, 'comment_update2'];
        \Typecho\Plugin::factory('Widget_Abstract_Contents')->contentEx_15789 = [__CLASS__, 'cache_contentEx'];
        \Typecho\Plugin::factory('BhCache.Widget_Cache')->getCache_15789 = [__CLASS__, 'BhCache_getCache'];
        \Typecho\Plugin::factory('BhCache.Widget_Cache')->setCache_15789 = [__CLASS__, 'BhCache_setCache'];
        }
        \Typecho\Plugin::factory('admin/header.php')->header_999 = [__CLASS__, 'enqueue_style'];
        \Typecho\Plugin::factory('admin/footer.php')->end_999 = [__CLASS__, 'enqueue_script'];
        self::getExtensionFunc('activate');
        \CSF::activateEvent();
        
        
        
         return _t('BearHoneyCore核心同步完成');
    }

    public static function deactivate()
    {
        bhRouter::removeRouter();
        self::getExtensionFunc('deactivate');
        return _t('BearHoneyCore核心清除完成');
    }
    
    
   

    public static function initevent()
    {
        if (!class_exists('bhOptions')){
            require_once \Utils\Helper::options()->pluginDir('BearHoneyCore').'/bhOptions.php';
        }
    }
    
    public static function getIpLocation($ip){
     $options = bhOptions::getInstance()::get_option( 'bearhoney' );
     if($options['Comment_ipget_data_choose'] == 2 && $options['Comment_ipget_data_tencent_key'] !== ''){
         if(trim($options['Comment_ipget_data_tencent_sign']) !== ''){
             $md5 = md5('/ws/location/v1/ip?ip='.$ip.'&key='.$options['Comment_ipget_data_tencent_key'].$options['Comment_ipget_data_tencent_sign']);
             $url = 'https://apis.map.qq.com/ws/location/v1/ip?key='.$options['Comment_ipget_data_tencent_key'].'&ip='.$ip.'&sig='.$md5;
         }
         else{
        $url = 'https://apis.map.qq.com/ws/location/v1/ip?key='.$options['Comment_ipget_data_tencent_key'].'&ip='.$ip;
         }
$headers['User-Agent'] = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:93.0)';

foreach( $headers as $n => $v )
{ $headerArr[] = $n .':' . $v; }
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url); 
curl_setopt($ch, CURLOPT_USERAGENT, $headerArr);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
curl_setopt($ch, CURLOPT_TIMEOUT, 10);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);
   $info = json_decode($response,true)['result']['ad_info'];
   $nation = $info['nation'];
   $province = $info['province'];
   $city = $info['city'];
   $district = $info['district'];
   if($nation !== NULL){
   return $nation.$province.$city.$district;
   }
   else{
   return '天外来客';    
   }
     }
     else{
$url = 'https://ip.zxinc.org/api.php?type=json&ip='.$ip;
$headers['User-Agent'] = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:93.0)';

foreach( $headers as $n => $v )
{ $headerArr[] = $n .':' . $v; }
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url); 
curl_setopt($ch, CURLOPT_USERAGENT, $headerArr);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
curl_setopt($ch, CURLOPT_TIMEOUT, 10);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);
    
    $info = json_decode($response,true)['data']['country'];
    if($info == null){
    $info = '未知';    
    }
      return $info;
     }
     
  
     }
     
    public static function C()
    {
        self::initEnv();
        $op = Helper::options();
        $scheme = parse_url($op->siteUrl)['scheme'];
        $host = parse_url($op->siteUrl)['host'];
        $ip = gethostbyname($_SERVER['HTTP_HOST']);
        if (self::$plugin_config->enable_gcache == '0')
            return ;
        if (self::$plugin_config->Cache_choose == '0')
            return;
        if (!self::preCheck()) return;

        if (!self::initPath()) return;
        try {
            $data = self::getCache();
            if (!empty($data)) {
                if ($data['time'] + self::$plugin_config->expire < time())
                    self::$passed = false;
              
               $html = $data['html'];
           
         echo $html;
                die;
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        ob_flush();
    }

    public static function S($html = '')
    {
        if (self::$plugin_config->Cache_choose == '0')
            return;
        if (is_null(self::$path) || !self::$passed)
            return;
        if (empty($html))
            $html = ob_get_contents();
        $data = array();
        $data['time'] = time();
        $data['html'] = $html;
        self::setCache($data);
    }

    public static function getCache($name = null)
    {
        if ($name) return unserialize(self::$cache->get($name));
        return unserialize(self::$cache->get(self::$path));
    }

    public static function setCache($data, $name = null)
    {
        if ($name) return self::$cache->set($name, serialize($data));
        return self::$cache->set(self::$path, serialize($data));
    }

    public static function delCache($path, $rmHome = True)
    {
        self::$cache->delete($path);
        if ($rmHome)
            self::$cache->delete('/');
    }

    public static function preCheck($checkPost = True)
    {
        if ($checkPost && self::$request->isPost()) return false;

        if (self::$plugin_config->login && \Typecho\Widget::widget('Widget_User')->hasLogin())
            return false;
        if (self::$plugin_config->enable_ssl == '0' && self::$request->isSecure() == true)
            return false;
        if (self::$plugin_config->Cache_choose == '0')
            return false;
        self::$passed = true;
        return true;
    }

    public static function initEnv()
    {
        if (!class_exists('bhOptions')){
            require_once \Utils\Helper::options()->pluginDir('BearHoneyCore').'/bhOptions.php';
        }
        if (is_null(self::$sys_config))
            self::$sys_config = bhOptions::getInstance();
        if (is_null(self::$plugin_config))
            self::$plugin_config = (Object)self::$sys_config::get_option('bearhoney');
        if (is_null(self::$request))
            self::$request = new \Typecho\Request();
    }

    public static function initPath($pathInfo='')
    {

        if(empty($pathInfo))
            $pathInfo = self::$request->getPathInfo();
        if (!self::needCache($pathInfo)){
            return false;
        }

        self::$path = $pathInfo;
        return self::initBackend(self::$plugin_config->Cache_choose);
    }

    public static function initBackend($backend){
        if ($backend == '0') return false;
        $options = get_option('bearhoney');
        $class_name = "typecho_".$options['Cache_choose'];
        require_once __TYPECHO_ROOT_DIR__.'/usr/themes/bearhoney/core/Extensions/siteCache/vendors/cache.interface.php';
        require_once __TYPECHO_ROOT_DIR__.'/usr/themes/bearhoney/core/Extensions/siteCache/vendors/'.$class_name.'.class.php';
        self::$cache = call_user_func(array($class_name, 'getInstance'), self::$plugin_config);
        if (is_null(self::$cache))
            return false;
        return true;
    }

    public static function needCache($path)
    {
        $pattern = '#^' . __TYPECHO_ADMIN_DIR__ . '#i';
        if (preg_match($pattern, $path)) return false;
        $pattern = '#^/action#i';
        if (preg_match($pattern, $path)) return false;
        $requestUrl = self::$request->getRequestUri();
        $pattern = '/.*?s=.*/i';
        if (preg_match($pattern, $requestUrl)) return false;
        $pattern = '#^/search#i';
        if (preg_match($pattern, $path) and in_array('search', self::$plugin_config->cache_page)) return true;
        $_routable = Helper::options()->routingTable;
        $post_regx = $_routable[0]['post']['regx'];
        if (array_key_exists('TePass', \Typecho\Plugin::export()['activated'])){
        if (preg_match($post_regx,$path,$arr)){
            if ($arr[1] and !empty($arr[1])){
                $db = \Typecho\Db::get();
                try {
		    $database = $db->getConfig($db::READ)['database'];
                    $tepass_exist = $db->fetchRow($db->select()->from('information_schema.TABLES')->where('TABLE_NAME = ?',$db->getPrefix().'tepass_posts')->where('TABLE_SCHEMA = ?',$database));
                    if (isset($tepass_exist) and count($tepass_exist) > 0){
                          $p_id = $db->fetchObject($db->select('id')->from('table.tepass_posts')->where('post_id = ?',$arr[1]))->id;
                          if ($p_id) return false;
                    }

                }catch (Typecho_Db_Query_Exception $e){
                    
                }

            }
        }
}


        foreach ($_routable as $page => $route) {
            if ($route['widget'] != '\Widget\Archive' and $route['widget'] != 'Widget_Archive') continue;
            $regx = Router::get($page);
            if (preg_match($regx['regx'], $path)) {
                $exclude = array('_year', '_month', '_day', '_page');
                $page = str_replace($exclude, '', $page);

                if (in_array($page, get_option('bearhoney')['cache_page']))
                    return true;
            }
        }
        return false;
    }

    public static function post_update($contents, $class)
    {
        if ('publish' != $contents['visibility'] || $contents['created'] > time())
            return;

        self::initEnv();
        if (self::$plugin_config->Cache_choose == '0')
            return;
        self::$passed = true;

        $type = $contents['type'];
        $routeExists = (NULL != \Typecho\Router::get($type));
        if (!$routeExists) {
            self::initPath('#');
            self::delCache(self::$path);
            return;
        }

        $db = \Typecho\Db::get();
        $contents['cid'] = $class->cid;
        $contents['categories'] = $db->fetchAll($db->select()->from('table.metas')
            ->join('table.relationships', 'table.relationships.mid = table.metas.mid')
            ->where('table.relationships.cid = ?', $contents['cid'])
            ->where('table.metas.type = ?', 'category')
            ->order('table.metas.order', \Typecho\Db::SORT_ASC));
        $contents['category'] = urlencode(current(\Typecho\Common::arrayFlatten($contents['categories'], 'slug')));
        $contents['slug'] = urlencode(empty($contents['slug'])?$class->slug:$contents['slug']);
        $contents['date'] = new \Typecho\Date($contents['created']);
        $contents['year'] = $contents['date']->year;
        $contents['month'] = $contents['date']->month;
        $contents['day'] = $contents['date']->day;

        if (!self::initPath(\Typecho\Router::url($type, $contents))){
            return;
        }
        self::delCache(self::$path);
        if ($class->cid)
            self::delCache(self::getPostMarkCacheName($class->cid));
    }

    public static function post_del_update($cid, $obj)
    {
        if (self::$plugin_config->Cache_choose == '0')
            return;
        $db = \Typecho\Db::get();
        $postObject = $db->fetchObject($db->select('cid','slug', 'type')
            ->from('table.contents')->where('cid = ?', $cid));
        if (!$postObject->cid){
            return;
        }
        $value = [];
        $value['cid'] = $cid;
        $value['type'] = $postObject->type;
        $value['slug'] = urlencode($postObject->slug);
        $pathInfo = \Typecho\Router::url($value['type'], $value);

        self::initEnv();

        self::initBackend(self::$plugin_config->Cache_choose);
        self::delCache($pathInfo);
        if ($cid){
            self::delCache(self::getPostMarkCacheName($cid));
        }
    }

    public static function comment_update($comment)
    {
        if (self::$plugin_config->Cache_choose == '0')
            return;
        self::initEnv();
        if (!self::preCheck(false)) return;
        if (!self::initBackend(self::$plugin_config->Cache_choose))
            return;
        $path_info = self::$request->getPathInfo();
        $article_url = preg_replace('/\/comment$/i','',$path_info);

        self::delCache($article_url);
        if ($comment->cid)
            self::delCache(self::getPostMarkCacheName($comment->cid));
    }

    public static function comment_update2($comment, $edit)
    {
        if (self::$plugin_config->Cache_choose == '0')
            return;
        self::initEnv();
        self::preCheck(false);
        self::initBackend(self::$plugin_config->Cache_choose);
        $perm = stripslashes($edit->parentContent['permalink']);
        $perm = preg_replace('/(https?):\/\//', '', $perm);
        $perm = preg_replace('/'.$_SERVER['HTTP_HOST'].'/', '', $perm);
        self::delCache($perm);
        if ($edit->cid)
            self::delCache(self::getPostMarkCacheName($edit->cid));
        if ($comment->cid)
            self::delCache(self::getPostMarkCacheName($comment->cid));
    }
    
    public static function getPostMarkCacheName($cid){
        if (!self::$path)
            self::$path = self::$request->getPathInfo();
        return self::$path.'_'.$cid.'_markdown';
    }

    public static function cache_contentEx($content, $obj, $lastResult){
        if (self::$plugin_config->Cache_choose == '0')
            return $content;
        $content = empty( $lastResult ) ? $content : $lastResult;
        if (self::$plugin_config->enable_markcache == '0'){
            return $content;
        }
        if (substr_count($content,'<!--no-cache-->'))
            return $content;
        self::initEnv();
        self::$path = self::$request->getPathInfo();
        $cacheName = self::getPostMarkCacheName($obj->cid);
        self::initEnv();
        if (!self::preCheck(false)) {
            return $content;
        }
        if (!self::initBackend(self::$plugin_config->Cache_choose)){
            return $content;
        }
        try {
            $data = self::getCache($cacheName);
            if (!empty($data)) {
                if ($data['time'] + self::$plugin_config->expire < time())
                    self::$passed = false;
                return $data['html'];
            }
        } catch (Exception $e) {
            return $content;
        }

        if (is_null(self::$path) || !self::$passed)
            return $content;
        $data = array();
        $data['time'] = time();
        $data['html'] = $content;
        self::setCache($data,$cacheName);
        return $content;
    }

    public static function BhCache_setCache($cacheKey,$val){
        self::initEnv();
        if (!self::preCheck(false)) {
            return false;
        }
        if (!self::initBackend(self::$plugin_config->Cache_choose)){
            return false;
        }
        $data = array();
        $data['time'] = time();
        $data['html'] = $val;
        self::setCache($data,$cacheKey);
        return true;
    }
    
    public static function BhCache_getCache($cacheKey){
        self::initEnv();
        if (!self::preCheck(false)) {
            return false;
        }
        if (!self::initBackend(self::$plugin_config->Cache_choose)){
            return false;
        }
        try{
            $data = self::getCache($cacheKey);
            if (!empty($data)) {
                if ($data['time'] + self::$plugin_config->expire < time())
                    self::$passed = false;
                return $data['html'];
            }
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }
        return false;
    }
    
    
    public static function send_request($url, $postdata,$sendtype,$header = 'Content-type: application/x-www-form-urlencoded') {
     if($postdata){
         if(is_array($postdata)){
    $data = http_build_query($postdata);
         }
         else{
           $data = $postdata;
         }
    $options    = array(
        'http' => array(
            'method'  => $sendtype,
            'header'  => $header,
            'content' => $data,
            'timeout' => 5
        )
    );
     }
     else{
     $options    = array(
        'http' => array(
            'method'  => $sendtype,
            'header'  => "Content-type: application/x-www-form-urlencoded",
            'timeout' => 5
        )
    );    
     }
    $context = stream_context_create($options);
    $result    = file_get_contents($url, false, $context);
    if($http_response_header[0] !== 'HTTP/1.1 200 OK'){
        $result = array(
            "result" => "success",
            "reason" => "request fail"
        );
        return json_encode($result);
    }else{
        return $result;
    }
}

    public static function enqueue_style($header=null, $old=null)
    {
        if ($old!=null) $header = $old;
        return CSF::get_enqueue_style($header);
    }

    public static function enqueue_script($footer=null)
    {
        return CSF::get_enqueue_script($footer);
    }

    public static function config(Form $form)
    {

    }

    public static function personalConfig(Form $form)
    {
    }
    
    

    public static function configHandle($origin_config, $is_init)
    {
        return true;
    }

    public static  function authToken($string, $operation = 'DECODE', $key = '', $expiry = 0) { 
    $opurl = Helper::options()->siteUrl; 
  $ckey_length = 4;  
  $key = md5($key ? $key : $GLOBALS['discuz_auth_key']);  
  $keya = md5(substr($key, 0, 16));  
  $keyb = md5(substr($key, 16, 16));  
  $keyc = $ckey_length ? ($operation == 'DECODE' ? substr($string, 0, $ckey_length): 
substr(md5(microtime()), -$ckey_length)) : '';  
  $cryptkey = $keya.md5($keya.$keyc);  
  $key_length = strlen($cryptkey);  
  $string = $operation == 'DECODE' ? base64_decode(substr($string, $ckey_length)) : 
sprintf('%010d', $expiry ? $expiry + time() : 0).substr(md5($string.$keyb), 0, 16).$string;  
  $string_length = strlen($string);  
  $result = '';  
  $box = range(0, 255);  
  $rndkey = array();  
  for($i = 0; $i <= 255; $i++) {  
    $rndkey[$i] = ord($cryptkey[$i % $key_length]);  
  }  
  for($j = $i = 0; $i < 256; $i++) {  
    $j = ($j + $box[$i] + $rndkey[$i]) % 256;  
    $tmp = $box[$i];  
    $box[$i] = $box[$j];  
    $box[$j] = $tmp;  
  }  
  for($a = $j = $i = 0; $i < $string_length; $i++) {  
    $a = ($a + 1) % 256;  
    $j = ($j + $box[$a]) % 256;  
    $tmp = $box[$a];  
    $box[$a] = $box[$j];  
    $box[$j] = $tmp;  
    $result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));  
  }  
  if($operation == 'DECODE') { 
    if((substr($result, 0, 10) == 0 || substr($result, 0, 10) - time() > 0) && 
substr($result, 10, 16) == substr(md5(substr($result, 26).$keyb), 0, 16)) {  
      return substr($result, 26);  
    } else {  
      return '';  
    }  
  } else {  
    return $keyc.str_replace('=', '', base64_encode($result));  
  }  
}

    public static function getSecurity($typeName,$name,$value = null){
    if($typeName == 'get'){
        $value = \Typecho\Cookie::get($name);
        return $value;
    }
    elseif($typeName == 'set'){
        \Typecho\Cookie::set($name, $value);
    }
    else{
        \Typecho\Cookie::delete($name, $value);
    }
}

    
    public static function checkExtensionLoad($extensioName){
        $db = \Typecho\Db::get();
        $adapter = $db->getAdapterName();
         if ("pgsql" === $adapter || "Pdo_Pgsql" === $adapter) {
         $ExtensionLoad = $db->fetchRow($db->select()->from('table.bearExtensionsList')
            ->where('extensionuniqueid = ?',$extensioName)->where('extensionstatus = ?','activated'));    
         }
         else{
        $ExtensionLoad = $db->fetchRow($db->select()->from('table.bearExtensionsList')
            ->where('extensionUniqueId = ?',$extensioName)->where('extensionStatus = ?','activated'));
         }
         if(!$ExtensionLoad){
               return false;
            }
           return true; 
            
    }
    
    private static function getExtensionFunc($type)
    {
$directory = __TYPECHO_ROOT_DIR__.'/usr/themes/bearhoney/core/Extensions/';
if(is_dir($directory)) {
    $scan = scandir($directory);
    unset($scan[0], $scan[1]);
    foreach($scan as $file) {
        $file = '\BearExtensions\\'.$file.'\Extension';
        switch($type){
            case 'activate':
                if (method_exists($file, 'activate')){
        $file::activate();
                }
        break;
        case 'deactivate':
                if (method_exists($file, 'deactivate')){
        $file::deactivate();
                }
        break;
        }
    }}
        
    }

}