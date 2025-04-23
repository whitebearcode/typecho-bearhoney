<?php
header("HTTP/1.1 200 OK");
    header("Access-Control-Allow-Origin: *");
    header('Content-Type: application/json; charset=utf-8');
    date_default_timezone_set('PRC');
error_reporting(0);
use Markdown;
$db = Typecho_Db::get();
$select = $db->select()->from('table.contents');
$removeChar = ["https://", "http://", "/"]; 
$options = Helper::options();
    if (stripos($_SERVER['HTTP_REFERER'], str_replace($removeChar, "", $options->siteUrl)) !== false) {
        

            if ($this->user->hasLogin()) {
                $select->where("table.contents.password IS NULL
                 OR table.contents.password = '' OR table.contents.authorId = ?", $this->user->uid);
            } else {
                $select->where("table.contents.password IS NULL OR table.contents.password = ''");
            }

           
$result = array(
    'posts' => array()
);
$md = new Markdown();
            $r = $db->fetchAll($select->where('table.contents.type = ?', 'post')->where('status = ?','publish')->limit(100));
                if($r){
foreach($r as $val){
$val = Typecho_Widget::widget('Widget_Abstract_Contents')->push($val);
$published_at = date('Y-m-d h:m:s',$val['created']);
if (method_exists('BearExtensions\shortCode\Extension', 'excerpt_text')){
$targetSummary = General::getExcerpt(BearExtensions\shortCode\Extension::excerpt_text($md::convert($val['text'])), 30);
}
else{
$targetSummary = General::getExcerpt($md::convert($val['text']), 30);    
}
$expert = General::getCustomFields($val['cid'], 'excerpt');
                if($expert){
                    $targetSummary = $expert[0];
                }
$targetSummary = trim( strip_tags($targetSummary));
		$targetSummary = preg_replace('/\\s+/',' ',$targetSummary);
			if(!$targetSummary){
			    $targetSummary = '本篇文章暂无摘要~';
			}

      
 $result['posts'][] = array(
	 'url' => "?s=".$_GET['keyword'],
	 'title' => "实时搜索数据为空~~~",
	 'plaintext' => "可以戳这里手动搜索该关键词",
	);      
$result['posts'][] = array(
    'id' => $val['cid'],
    'title' => $val['title'],
	'url' => $val['permalink'],
	'published_at'=> $published_at,
	'plaintext' => $targetSummary,
	'excerpt' => $targetSummary,
	);
	
}

}
else{
    $result['posts'][] = array(
	 'url' => "?s=".$_GET['keyword'],
	 'title' => "实时搜索数据为空~~~",
	 'plaintext' => "可以戳这里手动搜索该关键词",
	);
}
}
else{
    $result['posts'][] = array(
	 'url' => "?s=".$_GET['keyword'],
	 'title' => "实时搜索数据获取失败~~~",
	 'plaintext' => "可以戳这里手动搜索该关键词",
	);
}
        echo json_encode($result);         
                
    
?>
