<?php
use Typecho\Db;
ob_clean();
header("HTTP/1.1 200 OK");
    header("Access-Control-Allow-Origin: *");
    header('Content-type: application/json');
    date_default_timezone_set('PRC');
    $options = Helper::options();
    $removeChar = ["https://", "http://"]; 
    Typecho_Widget::widget('Widget_User')->to($user);
    $db = \Typecho\Db::get();
$id = $this->user->uid;
$opts = array(
  'http'=>array(
   'method' => 'GET',
          'header' => 'Content-type: application/json',
          'timeout' => 60 * 10,
       'Connection'=>"close"
  )
);
$context = stream_context_create($opts);
        if(General::Options('Emoji_HideDefault') == false || General::Options('Emoji_HideDefault') == ''){
        $res = json_decode(file_get_contents($options->themeUrl."/assets/plugins/emoji/emoji.json", false, $context),true);
        $result = $res;
        }
        if(General::Options('Emoji_Diy') == true && General::Options('Emoji_DiyUrl') !== ''){
        $res2 = json_decode(file_get_contents(General::Options('Emoji_DiyUrl'), false, $context),true);
        if(General::Options('Emoji_HideDefault') == false || General::Options('Emoji_HideDefault') == ''){
        $result = array_merge($res,$res2);
        }
        else{
        $result = $res2;    
        }
        }
       

        exit(json_encode($result,JSON_UNESCAPED_UNICODE));
