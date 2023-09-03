<?php
$db = \Typecho\Db::get();
$adapter = $db->getAdapterName();
$table = $db->getPrefix() . 'bearExtensionsList';
            if ("Pdo_SQLite" === $adapter || "SQLite" === $adapter || "pgsql" === $adapter || "Pdo_Pgsql" === $adapter) {
                $db->query(" CREATE TABLE IF NOT EXISTS " . $table . " (
			   id INTEGER PRIMARY KEY,
			   extensionId TEXT,
			   extensionUniqueId TEXT,
			   extensionName TEXT,
			   extensionDec TEXT,
			   extensionVersion TEXT,
			   extensionAuthor TEXT,
			   extensionStatus TEXT)");
            }
            else{
                $dbConfig = null;
            if (class_exists('\Typecho\Db')) {
                $dbConfig = $db->getConfig($db::READ);
            } else {
                $dbConfig = $db->getConfig()[0];
            }
            $charset = $dbConfig->charset;
            
            
            $db->query("CREATE TABLE IF NOT EXISTS " . $table . " (
				  `id` int(8) NOT NULL AUTO_INCREMENT,
				  `extensionId` varchar(1000) NOT NULL,
				  `extensionUniqueId` varchar(1000) NOT NULL,
			      `extensionName` varchar(1000) NOT NULL,
			      `extensionDec` varchar(1000) NOT NULL,
			      `extensionVersion` varchar(1000) NOT NULL,
			      `extensionAuthor` varchar(1000) DEFAULT NULL,
			      `extensionStatus` varchar(1000) NOT NULL,
				  PRIMARY KEY (`id`)
				) DEFAULT CHARSET=$charset AUTO_INCREMENT=1");
				
				
            }
$ActivatedExtensionList = $db->fetchAll($db->select()->from('table.bearExtensionsList')->where('extensionStatus = ?','activated'));
if($ActivatedExtensionList){
$directory =__TYPECHO_ROOT_DIR__.'/usr/themes/bearhoney/core/Extensions/';
if(is_dir($directory)) {
    $scan = scandir($directory);
    unset($scan[0], $scan[1]);
    foreach($scan as $file) {
        foreach($ActivatedExtensionList as $extension) { 
         if($extension['extensionUniqueId'] === $file){
        require_once($directory.$file."/".'Function.php');
         }
            
        }
         
    }
}
}