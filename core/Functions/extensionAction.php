<?php
require_once 'pclzip.lib.php';
use Typecho\Db;
header("HTTP/1.1 200 OK");
    header("Access-Control-Allow-Origin: *");
    date_default_timezone_set('PRC');
function extensionDownload($file_url,$path,$file_name){
    
    session_write_close();
        if ($fp = fopen($file_url, "rb")) {

                if (!$download_fp = fopen($path, "wb")) {
                    exit;
                }

                while (!feof($fp)) {
                    if (!file_exists($path)) {
                        fclose($download_fp);
                        exit;
                    }
                    fwrite($download_fp, fread($fp, 128), 128);
                }

                fclose($download_fp);
                fclose($fp);

            } else {
                exit;
            }
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
        if ($fp = fopen($file_url, "rb")) {

                if (!$download_fp = fopen($path, "wb")) {
                    exit;
                }

                while (!feof($fp)) {
                    if (!file_exists($path)) {
                        fclose($download_fp);
                        exit;
                    }
                    fwrite($download_fp, fread($fp, 128), 128);
                }

                fclose($download_fp);
                fclose($fp);

            } else {
                exit;
            }
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
$id = $this->user->uid;
    if ($user->hasLogin()) { 
        $db = \Typecho\Db::get();
    
        switch($_POST['type']){
            case 'installExtension':
            $needInstallExtension = $_POST['extensionId'];
             $checkExtensionInstall = $db->fetchRow($db->select()->from('table.bearExtensionsList')
            ->where('extensionId = ?',$needInstallExtension));
            if(!$checkExtensionInstall){
            $result = json_decode(file_get_contents('https://extensions.typecho.co.uk/Extensions.json'),true);
            $arr = array_filter($result, function($extension) use ($needInstallExtension) { return $extension['extensionId'] == $needInstallExtension; });
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
            if(extensionDownload('http://extensions.typecho.co.uk'.$t['extensionDownloadUrl'],__DIR__.'/'.$t['extensionUniqueId'].'.zip',$t['extensionUniqueId']) == true){
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
           $InstalledExtensioList = $db->fetchAll($db->select()->from('table.bearExtensionsList')->where('extensionStatus = ?','unactivate'));
            $result = array(
    'code' => 1,
    'message' => '获取成功',
        'data' => $InstalledExtensioList
);
            break;
            //获取未安装的扩展列表
       case 'getUnInstalledExtension':  
           $checkExtensionExist = $db->fetchAll($db->select()->from('table.bearExtensionsList'));
           $ExtensionList = json_decode(file_get_contents('https://extensions.typecho.co.uk/Extensions.json'),true);
           
           function getNotInstalledFunc($ext,$cext)
{
if ($ext === $cext)
   {
   return 0;
   }
   return ($ext>$cext)?1:-1;
}


           $extensions = array_diff_uassoc($ExtensionList,$checkExtensionExist,"getNotInstalledFunc");
           
                $result = array(
    'code' => 1,
    'message' => '获取成功',
        'data' => $extensions
);
           
            break;
            //获取已经启用的扩展列表
      case 'getActivatedExtension':  
           $activatedExtensioList = $db->fetchAll($db->select()->from('table.bearExtensionsList')->where('extensionStatus = ?','activated'));
            $result = array(
    'code' => 1,
    'message' => '获取成功',
        'data' => $activatedExtensioList
);
           
            
            break;
    //获取需要升级的扩展列表
       case 'getNeedUpgradeExtension':  
           $checkExtensionExist = $db->fetchAll($db->select()->from('table.bearExtensionsList'));
           $ExtensionList = json_decode(file_get_contents('https://extensions.typecho.co.uk/Extensions.json'),true);
            $extensions = array();
           foreach($checkExtensionExist as $r){
            foreach($ExtensionList as $rx){
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
               $result = array(
    'code' => 1,
    'message' => '获取成功',
        'data' => $extensions
);
           }
           break;
         case 'activateExtension':
            $extensionId = $_POST['extensionId']; 
            $db->query($db->update('table.bearExtensionsList')->rows(array(
                'extensionStatus' => 'activated'))->where('extensionId = ?', $extensionId));
            $result = array(
    'code' => 1,
    'message' => '扩展启用成功~'
    
);
             break;
             
         case 'unactivateExtension':
            $extensionId = $_POST['extensionId']; 
            $db->query($db->update('table.bearExtensionsList')->rows(array(
                'extensionStatus' => 'unactivate'))->where('extensionId = ?', $extensionId));
            $result = array(
    'code' => 1,
    'message' => '扩展禁用成功~'
    
);
             break;
             case 'upgradeExtension':
            $extensionId = $_POST['extensionId']; 
            $result = json_decode(file_get_contents('https://extensions.typecho.co.uk/Extensions.json'),true);
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
            $upgradeUrl = 'http://extensions.typecho.co.uk/extensions/'.$extensions['extensionUniqueId'].'/'.$extensions['extensionVersion'].'/'.$extensions['extensionUniqueId'].'_'.$extensions['extensionVersion'].'.zip';
            if(extensionUpgrade($upgradeUrl,__DIR__.'/'.$extensions['extensionUniqueId'].'_'.$extensions['extensionVersion'].'.zip',$extensions['extensionUniqueId']) == true){
            $db->query($db->update('table.bearExtensionsList')->rows(array(
                'extensionVersion' => $extensions['extensionVersion']))->where('extensionId = ?', $extensionId));
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