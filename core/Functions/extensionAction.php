<?php
require_once 'pclzip.lib.php';
use Typecho\Db;
header("HTTP/1.1 200 OK");
    header("Access-Control-Allow-Origin: *");
    date_default_timezone_set('PRC');
        ignore_user_abort(true);
set_time_limit(0);
ini_set('memory_limit',-1);
ini_set('mysql.connect_timeout', 900);
ini_set('default_socket_timeout', 900);
function is_dir_readable_and_writable($dir) {
    if (!is_dir($dir)) {
        return false;
    }
    if (!is_readable($dir) || !is_writable($dir)) {
        return false;
    }
  
    return true;
}


function extensionDownload($file_url,$path,$file_name){
    session_write_close();
         $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $file_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_FILE, fopen($path, 'wb'));

    $data = curl_exec($ch);
     if ($data === false) {
        return false;
    }

    curl_close($ch);
      if(file_exists($path)){      
            
    $archive = new PclZip($path);
$archive->extract(PCLZIP_OPT_PATH,'./usr/themes/bearhoney/core/Extensions');
unlink($path);
return true;
}
else{
    return false;
}
}

function extensionUpgrade($file_url,$path,$file_name){
     session_write_close();
         $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $file_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_FILE, fopen($path, 'wb'));

    $data = curl_exec($ch);
     if ($data === false) {
        return false;
    }

    curl_close($ch);
      if(file_exists($path)){      
            
    $archive = new PclZip($path);
$archive->extract(PCLZIP_OPT_PATH,'./usr/themes/bearhoney/core/Extensions');
unlink($path);
return true;
}
else{
    return false;
}
}


    $options = Helper::options();
    $removeChar = ["https://", "http://", "/"]; 
    Typecho_Widget::widget('Widget_User')->to($user);
    $db = \Typecho\Db::get();
    $adapter = $db->getAdapterName();
$id = $this->user->uid;
    if ($user->hasLogin()) { 


        $db = \Typecho\Db::get();
    
        switch($_POST['type']){
            case 'installExtension':
                
                $directory = __TYPECHO_ROOT_DIR__.__TYPECHO_THEME_DIR__;
if (!is_dir_readable_and_writable($directory)) {
     $result = array(
    'code' => 0,
    'message' => '安装前置检测不通过，原因：usr/themes目录不可读或不可写，请先赋予权限后重试！'
    
);
exit(json_encode($result)); 
}
if(!function_exists('curl_init')){
     $result = array(
    'code' => 0,
    'message' => '安装前置检测不通过，原因：php-curl扩展未安装，请安装后重试！'
    
);
exit(json_encode($result));     
}
            $needInstallExtension = $_POST['extensionId'];
            if ("pgsql" === $adapter || "Pdo_Pgsql" === $adapter) {
$checkExtensionInstall = $db->fetchRow($db->select()->from('table.bearExtensionsList')
            ->where('extensionid = ?',$needInstallExtension));
    }
    else{
             $checkExtensionInstall = $db->fetchRow($db->select()->from('table.bearExtensionsList')
            ->where('extensionId = ?',$needInstallExtension));
    }
            if(!$checkExtensionInstall){
            $result = json_decode(file_get_contents('http://extensions.typecho.co.uk/Extensions.json'),true);
            $arr = array_filter($result, function($extension) use ($needInstallExtension) { return $extension['extensionId'] == $needInstallExtension; });
            $extensions = array();
            foreach($arr as $t){
               $extensions = array(
                'extensionid' => $t['extensionId'],
                'extensionuniqueid' => $t['extensionUniqueId'],
                'extensionname' => $t['extensionName'],
                'extensiondec' => $t['extensionDec'],
                'extensionversion' => $t['extensionVersion'],
                'extensionauthor' => $t['extensionAuthor'],
                'extensionstatus' => 'unactivate'
            ); 
            }
            if($t['extensionRequireVersion'] && $t['extensionRequireVersion'] < Helper::options()->Version){
                $result = array(
    'code' => 0,
    'message' => '安装前置检测不通过，原因：您的Typecho版本大于该扩展所要求的Typecho版本('.$t['extensionRequireVersion'].')'
    
);
exit(json_encode($result)); 
            }
            if(extensionDownload('https://extensions.typecho.co.uk'.$t['extensionDownloadUrl'],__DIR__.'/'.$t['extensionUniqueId'].'.zip',$t['extensionUniqueId']) == true){
            $db->query($db->insert('table.bearExtensionsList')->rows($extensions));
            $result = array(
    'code' => 1,
    'message' => '扩展安装成功~'
    
);
}
else{
    $result = array(
    'code' => 0,
    'message' => '抱歉，扩展安装失败，请稍后重试~'
);
}


            }
            else{
               $result = array(
    'code' => 0,
    'message' => '抱歉，该扩展已安装，请勿重复安装~'
);
            }
            break;
            //获取已经安装的扩展列表
        case 'getInstalledExtension':  
            if ("pgsql" === $adapter || "Pdo_Pgsql" === $adapter) {
                $InstalledExtensioList = array();
$arr = $db->fetchAll($db->select()->from('table.bearExtensionsList')->where('extensionstatus = ?','unactivate'));
foreach($arr as $extension){
               $InstalledExtensioList[] = array(
                'extensionId' => $extension['extensionid'],
                'extensionUniqueId' => $extension['extensionuniqueid'],
                'extensionName' => $extension['extensionname'],
                'extensionDec' => $extension['extensiondec'],
                'extensionVersion' => $extension['extensionversion'],
                'extensionAuthor' => $extension['extensionauthor'],
                'extensionStatus' => 'unactivate'
            ); 
            }
    }
    else{
           $InstalledExtensioList = $db->fetchAll($db->select()->from('table.bearExtensionsList')->where('extensionStatus = ?','unactivate'));
    }
    
            $result = array(
    'code' => 1,
    'message' => '获取成功',
        'data' => $InstalledExtensioList
);
            break;
            //获取未安装的扩展列表
       case 'getUnInstalledExtension':  
           if ("pgsql" === $adapter || "Pdo_Pgsql" === $adapter) {
$checkExtensionExist = array_column(array_merge_recursive($db->fetchAll($db->select()->from('table.bearExtensionsList'))),'extensionuniqueid');
    }
    else{
           $checkExtensionExist = array_column(array_merge_recursive($db->fetchAll($db->select()->from('table.bearExtensionsList'))),'extensionUniqueId');
    }
           $ExtensionList = array_merge_recursive(json_decode(file_get_contents('http://extensions.typecho.co.uk/Extensions.json'),true));
         $ExtensionList = array_map(function($item) {
    unset($item['extensionDownloadUrl']); 
    return $item;
}, $ExtensionList);
$extensions = array();
foreach($ExtensionList as $r){
 if(!in_array($r['extensionUniqueId'],$checkExtensionExist)){
     $extensions[] = array(
                'extensionId' => $r['extensionId'],
                'extensionUniqueId' => $r['extensionUniqueId'],
                'extensionName' => $r['extensionName'],
                'extensionDec' => $r['extensionDec'],
                'extensionVersion' => $r['extensionVersion'],
                'extensionNewVersion' => $rx['extensionVersion'],
                'extensionAuthor' => $r['extensionAuthor'],
                'extensionStatus' => 'unactivate'
            );   
 }
    
}


         
                $result = array(
    'code' => 1,
    'message' => '获取成功',
        'data' => $extensions
);
            
            break;
            //获取已经启用的扩展列表
      case 'getActivatedExtension':  
          if ("pgsql" === $adapter || "Pdo_Pgsql" === $adapter) {
$activatedExtensioList = array();
$arr = $db->fetchAll($db->select()->from('table.bearExtensionsList')->where('extensionstatus = ?','activated'));
foreach($arr as $extension){
               $activatedExtensioList[] = array(
                'extensionId' => $extension['extensionid'],
                'extensionUniqueId' => $extension['extensionuniqueid'],
                'extensionName' => $extension['extensionname'],
                'extensionDec' => $extension['extensiondec'],
                'extensionVersion' => $extension['extensionversion'],
                'extensionAuthor' => $extension['extensionauthor'],
                'extensionStatus' => 'unactivate'
            ); 
            }
           
    }
    else{
           $activatedExtensioList = $db->fetchAll($db->select()->from('table.bearExtensionsList')->where('extensionStatus = ?','activated'));
    }
            $result = array(
    'code' => 1,
    'message' => '获取成功',
        'data' => $activatedExtensioList
);
           
            
            break;
    //获取需要升级的扩展列表
       case 'getNeedUpgradeExtension':  
           $checkExtensionExist = $db->fetchAll($db->select()->from('table.bearExtensionsList'));
           $ExtensionList = json_decode(file_get_contents('http://extensions.typecho.co.uk/Extensions.json'),true);
            $extensions = array();
           foreach($checkExtensionExist as $r){
            foreach($ExtensionList as $rx){
                if ("pgsql" === $adapter || "Pdo_Pgsql" === $adapter) {
                if(($rx['extensionUniqueId'] === $r['extensionuniqueid']) && (str_replace('v','',$rx['extensionVersion']) > str_replace('v','',$r['extensionversion']))){
                  $extensions[] = array(
                'extensionId' => $r['extensionid'],
                'extensionUniqueId' => $r['extensionuniqueid'],
                'extensionName' => $r['extensionname'],
                'extensionDec' => $r['extensiondec'],
                'extensionVersion' => $r['extensionversion'],
                'extensionNewVersion' => $rx['extensionVersion'],
                'extensionAuthor' => $r['extensionauthor'],
                'extensionStatus' => 'unactivate'
            );   
                }
                
                }
                
                else{
                  if(($rx['extensionUniqueId'] === $r['extensionUniqueId']) && (str_replace('v','',$rx['extensionVersion']) > str_replace('v','',$r['extensionVersion']))){
                  $extensions[] = array(
                'extensionId' => $r['extensionId'],
                'extensionUniqueId' => $r['extensionUniqueId'],
                'extensionName' => $r['extensionName'],
                'extensionDec' => $r['extensionDec'],
                'extensionVersion' => $r['extensionVersion'],
                'extensionNewVersion' => $rx['extensionVersion'],
                'extensionAuthor' => $r['extensionAuthor'],
                'extensionStatus' => 'unactivate'
            );   
                } 
                }
            }
               $result = array(
    'code' => 1,
    'message' => '获取成功',
        'data' => $extensions
);
           }
           break;
         case 'activateExtension':
            $extensionId = $_POST['extensionId']; 
            if ("pgsql" === $adapter || "Pdo_Pgsql" === $adapter) {
            $db->query($db->update('table.bearExtensionsList')->rows(array(
                'extensionstatus' => 'activated'))->where('extensionid = ?', $extensionId));    
            }
            else{
            $db->query($db->update('table.bearExtensionsList')->rows(array(
                'extensionStatus' => 'activated'))->where('extensionId = ?', $extensionId));
            }
            $result = array(
    'code' => 1,
    'message' => '扩展启用成功~'
    
);
             break;
             
         case 'unactivateExtension':
            $extensionId = $_POST['extensionId']; 
            if ("pgsql" === $adapter || "Pdo_Pgsql" === $adapter) {
            $db->query($db->update('table.bearExtensionsList')->rows(array(
                'extensionstatus' => 'unactivate'))->where('extensionid = ?', $extensionId));    
            }
            else{
            $db->query($db->update('table.bearExtensionsList')->rows(array(
                'extensionStatus' => 'unactivate'))->where('extensionId = ?', $extensionId));
            }
            $result = array(
    'code' => 1,
    'message' => '扩展禁用成功~'
    
);
             break;
             case 'rebuildExtension':
                 $table = $db->getPrefix() . 'bearExtensionsList';
                 $sql = "DROP TABLE IF EXISTS $table";
    $db->query($sql);
 $result = array(
    'code' => 1,
    'message' => '扩展表重建成功~'
    
);
             
                 break;
             case 'upgradeExtension':
                 $directory = __TYPECHO_ROOT_DIR__.__TYPECHO_THEME_DIR__;
if (!is_dir_readable_and_writable($directory)) {
     $result = array(
    'code' => 0,
    'message' => '更新前置检测不通过，原因：usr/themes目录不可读或不可写，请先赋予权限后重试！'
    
);
exit(json_encode($result)); 
}
            $extensionId = $_POST['extensionId']; 
            $result = json_decode(file_get_contents('http://extensions.typecho.co.uk/Extensions.json'),true);
            $arr = array_filter($result, function($extension) use ($extensionId) { return $extension['extensionId'] == $extensionId; });
            $extensions = array();
            foreach($arr as $t){
               $extensions = array(
                'extensionId' => $t['extensionId'],
                'extensionUniqueId' => $t['extensionUniqueId'],
                'extensionName' => $t['extensionName'],
                'extensionDec' => $t['extensionDec'],
                'extensionVersion' => $t['extensionVersion'],
                'extensionAuthor' => $t['extensionAuthor'],
                'extensionStatus' => 'unactivate'
            ); 
            }
            if($t['extensionRequireVersion'] && $t['extensionRequireVersion'] < Helper::options()->Version){
                $result = array(
    'code' => 0,
    'message' => '更新前置检测不通过，原因：您的Typecho版本大于该扩展所要求的Typecho版本('.$t['extensionRequireVersion'].')'
    
);
exit(json_encode($result)); 
            }
            $upgradeUrl = 'https://extensions.typecho.co.uk/extensions/'.$extensions['extensionUniqueId'].'/'.$extensions['extensionVersion'].'/'.$extensions['extensionUniqueId'].'_'.$extensions['extensionVersion'].'.zip';
            if(extensionUpgrade($upgradeUrl,__DIR__.'/'.$extensions['extensionUniqueId'].'_'.$extensions['extensionVersion'].'.zip',$extensions['extensionUniqueId']) == true){
                if ("pgsql" === $adapter || "Pdo_Pgsql" === $adapter) {
            $db->query($db->update('table.bearExtensionsList')->rows(array(
                'extensionversion' => $extensions['extensionVersion']))->where('extensionid = ?', $extensionId));  
            }
            else{
            $db->query($db->update('table.bearExtensionsList')->rows(array(
                'extensionVersion' => $extensions['extensionVersion']))->where('extensionId = ?', $extensionId));
            }
            $result = array(
    'code' => 1,
    'message' => '扩展升级成功~'
    
);
}
else{
    $result = array(
    'code' => 0,
    'message' => '抱歉，扩展升级失败，请稍后重试~'
);
    
    
}


             break;
        }
        exit(json_encode($result)); 
    }