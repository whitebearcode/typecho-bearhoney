<?php 
CSF::createSection( $prefix, array(
    'id'    => 'ExtensionList',
    'title' => '管理扩展',
    'icon'  => 'fas fa-building',
) );
$db = \Typecho\Db::get();
$adapter = $db->getAdapterName();
if ("pgsql" === $adapter || "Pdo_Pgsql" === $adapter) {
$ActivatedExtensionList = $db->fetchAll($db->select()->from('table.bearExtensionsList')->where('extensionstatus = ?','activated'));
    }
    else{
$ActivatedExtensionList = $db->fetchAll($db->select()->from('table.bearExtensionsList')->where('extensionStatus = ?','activated'));
}
if($ActivatedExtensionList){
$directory = dirname(__FILE__).'/Extensions/';
if(is_dir($directory)) {
    $scan = scandir($directory);
    unset($scan[0], $scan[1]);
    foreach($scan as $file) {
     foreach($ActivatedExtensionList as $extension) { 
         if ("pgsql" === $adapter || "Pdo_Pgsql" === $adapter) {
if($extension['extensionuniqueid'] === $file){
        require_once($directory.$file."/".'Config.php');
         }
    }
    else{
         if($extension['extensionUniqueId'] === $file){
        require_once($directory.$file."/".'Config.php');
         }
     }
     }
    }
}
}