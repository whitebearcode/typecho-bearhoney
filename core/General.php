<?php 

/**
 * 
 *   BearHoney 基础工具类
 *   Update at 2023/06/27
 * 
*/

class General
{
    
    public static function CommentAuthor($obj, $autoLink = NULL, $noFollow = NULL) {
    $options = Helper::options();
    $autoLink = $autoLink ? $autoLink : $options->commentsShowUrl;
    $noFollow = $noFollow ? $noFollow : $options->commentsUrlNofollow;
    if ($obj->url && $autoLink) {
        echo '<a href="'.$obj->url.'"'.($noFollow ? ' rel="external nofollow"' : NULL).(strstr($obj->url, $options->index) == $obj->url ? NULL : ' target="_blank"').'>'.$obj->author.'</a>';
    } else {
        echo $obj->author;
    }
}
    public static function editurl($url){
    $options = Helper::options();
   if (strpos($options->siteUrl, "https://") !== false) {
    echo str_replace('http://','https://',$url);
   } else {
    echo $url;
    }
    }

    //文本过滤
    public static function filterExpert($string){
    $_lenth = mb_strlen($string, "utf-8");
    $text_str = preg_replace(array("/<pre><code.*?>/si","/<img.*?>/si"),"",$string);
    $text_lenth = mb_strlen($text_str, "utf-8") - 1;
        return strip_tags(stripcslashes($text_str));
    }
    
    //文本截断
    public static function cutexpert($string, $length='20', $dot = '…'){
    $_lenth = mb_strlen($string, "utf-8");
    $text_str = preg_replace(array("/<pre><code.*?>/si","/<img.*?>/si"),"",$string);
    $text_lenth = mb_strlen($text_str, "utf-8") - 1;
    if($text_lenth <= $length) {
        return strip_tags(stripcslashes($text_str));
    }
    else{
        $res = mb_substr($text_str, 0, $length, 'UTF-8');
        return strip_tags(stripcslashes($res)).$dot;
    }
    }
    
    //获取主题控制项值
    public static function Options($key, $default = false){
    $options = bhOptions::getInstance()::get_option('bearhoney');
    return $options[$key];
    }
    
    //获取指定文章标签
    public static function tags($widget, $split = '', $default = NULL)
{

    if ($widget->tags) {
        $result = array();
        $result[] = '<li class="list-inline-item mt-2">•</li>
                 <li class="list-inline-item mt-2">
                <ul class="card-meta-tag list-inline">';
        $i=0;
        foreach ($widget->tags as $tag) {
        if($i>=3) break;
        $result[] .= '<li class="list-inline-item small"><a href="'.$tag['permalink'].'">#'.$tag['name'].'</a></li>';
        $i++;
        }
 $result[] .= '</ul></li>';
        echo implode($split,$result);
    } else {
        echo $default;
    }
}
    
    //获取文章所有标签
    public static function getPostAllTags($widget, $split = '', $default = NULL)
{

    if ($widget->tags) {
        $result = array();
        $result[] = '<div class="tag d-flex align-items-center flex-wrap pb-40">';
        foreach ($widget->tags as $tag) {
        $result[] .= '<a href="'.$tag['permalink'].'">#'.$tag['name'].'</a>';
        }
 $result[] .= '</div>';
        echo implode($split,$result);
    } else {
        echo $default;
    }
}


     //获取指定文章阅读时长
     public static function readTime($cid){
    $db=Typecho_Db::get ();
    $rs=$db->fetchRow ($db->select ('table.contents.text')->from ('table.contents')->where ('table.contents.cid=?',$cid)->order ('table.contents.cid',Typecho_Db::SORT_ASC)->limit (1));
    $text = preg_replace("/[^\x{4e00}-\x{9fa5}]/u", "", $rs['text']);
    $text_word = mb_strlen($text,'utf-8');
    echo ceil($text_word / 400);
}

    //获取文章阅读时间
    public static function publishTime($time){
        $rtime = date("Y年m月d日 H:i", $time);
        $htime = date("H:i", $time);
        $time = time() - $time;
        if ($time < 60) {
            $str = '刚刚';
        } elseif ($time < 60 * 60) {
            $min = floor($time / 60);
            $str = $min . '分钟前';
        } elseif ($time < 60 * 60 * 24) {
            $h = floor($time / (60 * 60));
            $str = $h . '小时前 ' . $htime;
        } elseif ($time < 60 * 60 * 24 * 3) {
            $d = floor($time / (60 * 60 * 24));
            if ($d == 1){
                $ztime = time() - $time;
       $zztime = date("H:i", $ztime);
                $str = '昨天 ' . $zztime;
            }else{
                $qtime = time() - $time;
       $qqtime = date("H:i", $qtime);
                $str = '前天 ' . $qqtime;
        }} else {
            $str = $rtime;
        }
         return $str;
    }
   
   //获取随机图
    public static function randPic($cid){
        if(self::Options('diy_thumb_api') == ''){
        return 'https://api.1314.cool/bingimg?'.$cid;
        }
        else{
        return self::Options('diy_thumb_api').'?'.$cid;    
        }
    }

   //获取文章头图
    public static function firstThumb($obj) {
    //获取附件首张图片
	$attach = $obj->attachments(1)->attachment;
	//获取文章首张图片
	preg_match_all("/\<img.*?src\=\"(.*?)\"[^>]*>/i", $obj->content, $thumbUrl);
	$img_src = $thumbUrl[1][0];
	// 获取自定义随机图片
	$thumbs = explode("|",self::Options('diy_thumb'));
	// 获取文章封面
	$cover = $obj->fields->cover;

	if($cover){
	    $thumb = $cover;
	}elseif(isset($attach->isImage) && $attach->isImage == 1){
		$thumb = $attach->url;
	}else if($img_src){
		$thumb = $img_src;
	}else if(!empty(self::Options('diy_thumb')) && count($thumbs)>0){
		$thumb = $thumbs[rand(0,count($thumbs)-1)];
	}
	else{
	    if(self::Options('diy_thumb_api') == ''){
	    $thumb = 'https://api.1314.cool/bingimg?'.$obj->cid;
	    }
	    else{
	    $thumb = self::Options('diy_thumb_api').'?'.$obj->cid;    
	    }
	}
	
	
	return $thumb;
}


   //获取指定邮箱的头像
    public static function getAvatar($email){
        $email = md5($email);
        return "//cravatar.cn/avatar/" . $email;
    }
    
    //获取自定义摘要
    public static function getExcerpt($content, $limit)
    {
        if($limit == 0) {
            return "";
        } else {
            if (trim($content) == "") {
                return "暂时没有可提供的摘要";
            } else {
                return \Typecho\Common::subStr(strip_tags($content), 0, $limit, "...");
            }
        }
    }
    
   //获取自定义字段
   public static function getCustomFields($cid, $key){
    $db = Typecho_Db::get();
    $rows = $db->fetchAll($db->select('table.fields.str_value')->from('table.fields')
        ->where('table.fields.cid = ?', $cid)
        ->where('table.fields.name = ?', $key)
    );
    foreach ($rows as $row) {
        $value = $row['str_value'];
        if (!empty($value)) {
            $values[] = $value;
        }
    }
    return $values;
}

   //获取字段中的所有数字
   public static function parseNumber($str){
    return preg_replace("/[^0-9]/", "", $str);
}

   //获取一言
   public static function getHitokoto($c = 'default'){
 $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, 'https://v1.hitokoto.cn/');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_TIMEOUT, 500);
    curl_setopt($curl, CURLOPT_POST, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
    $data = curl_exec($curl);
    curl_close($curl);
    $datas = json_decode($data,true);
    if($c = 'default'){
    return '“ '.$datas['hitokoto'] . ' ”';
    }
    else{
    return $datas['hitokoto'];    
    }
}
   //获取随机文章
    public static function getRandomPosts(){
$db = \Typecho\Db::get();
$result = $db->fetchAll($db->select()->from('table.contents')
->where('status = ?','publish')
->where('type = ?', 'post')
->where('created < ?', Helper::options()->time)
->offset(2)
->limit(2)
->order('RAND()')
);
if($result){
    $html = array();
        $html[] = ' <div class="row">
            <div class="col-md-8 mx-auto text-center">
                <h4 class="section-title my-40">
                    推荐文章
                </h4>
            </div>
        </div>
        <div class="row justify-content-center">';
foreach($result as $val){
    
$val = \Typecho\Widget::widget('Widget_Abstract_Contents')->push($val);
if(!$val['hidden']){
$post_title = htmlspecialchars($val['title']);
$permalink = $val['permalink'];
$date = self::publishTime($val['created']);
$md = new Markdown();
if (method_exists('BearExtensions\shortCode\Extension', 'excerpt_text')){
$targetSummary = self::getExcerpt(BearExtensions\shortCode\Extension::excerpt_text($md::convert($val['text'])), 30);
}
else{
$targetSummary = self::getExcerpt($md::convert($val['text']), 30);    
}
$expert = self::getCustomFields($val['cid'], 'excerpt');
                if($expert){
                    $targetSummary = $expert[0];
                }
$targetSummary = trim(strip_tags($targetSummary));
			$targetSummary = preg_replace('/\\s+/',' ',$targetSummary);
			if(!$targetSummary){
			    $targetSummary = '本篇文章暂无摘要~';
			}
     
$html[] = '
<div class="col-sm-6">
                <div class="related-post-card">
             
                    <div class="related-post-content">
                       
                        <h5 class="blog-title"><a href="'.$permalink.'" title="'.$post_title.'">'.$post_title.'</a></h5>
                         <div class="post-date d-flex align-items-center justify-content-between">
                            <span><i class="ri-calendar-line"></i> '.$date.'</span>
                        </div>
                        <p class="mb-0 line-clamp">'.$targetSummary.'</p>
                    </div>
                </div>
            </div>
                    ';
}
}
    $html[] .= '</div>';
        echo implode('',$html);
}
}
    public static function getArchived(){
    $db = Typecho_Db::get();      
    $result = $db->fetchAll($db->select()
    ->from('table.contents')
            ->where('table.contents.status = ?', 'publish')
            ->where('table.contents.created < ?', Helper::options()->time)
            ->where('table.contents.type = ?', 'post')
            ->order('table.contents.created', Typecho_Db::SORT_DESC));
return $result;
}
    public static function getSiteData($url, $postdata,$sendtype,$header = 'Content-type: application/x-www-form-urlencoded') {
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

    public static function getBingWalls(){
        $data = json_decode(self::getSiteData('https://cn.bing.com/HPImageArchive.aspx?format=js&idx=0&n=2', '','GET',$header = 'Content-type: application/x-www-form-urlencoded'),true)['images'];
        return $data;
    }
    
    public static function md5Encode($data){
    return md5("bearsimplev2!@#$%^&*()-=+@#$%$".$data."bearsimplev2!@#$%^&*()-=+@#$%$");
}
    public static function getExtensionAction($method,$place,$name,$funcName){
     $t = \Typecho\Plugin;
     return $t::factory($place)->$name = ['Extension', $funcName];
}


public static function theNext($widget)
{
$db = Typecho_Db::get();
$result = $db->select()->from('table.contents')
->where('table.contents.created > ? AND table.contents.created < ?',
$widget->created, Helper::options()->gmtTime)
->where('table.contents.status = ?', 'publish')
->where('table.contents.type = ?', $widget->type)
->where('table.contents.password IS NULL')
->limit(1);
 $val = $db->fetchRow($result);
if($val){
$val = \Typecho\Widget::widget('Widget_Abstract_Contents')->push($val);
if(!$val['hidden']){
    echo '
                 <div class="previous">
        <a class="previous-post" href="'.$val['permalink'].'" 
            style="background-image: url(https://cn.bing.com'.self::getBingWalls()[1]['url'].')">
            <div class="d-flex w-100">
                <div class="previous-content next-post-cont">
                    <div class="arrow-text">下一篇</div>
                    <h5 class="previous-post-title next-post-title">'.$val['title'].'</h5>
                </div>
                <div class="prev-next-arrow">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>                </div>
            </div>
        </a>
    </div>
                ';
}
}
else{
  echo '<div class="previous">
        <a class="previous-post"
            style="background-image: url(https://cn.bing.com'.self::getBingWalls()[1]['url'].')" >
            <div class="d-flex w-100">
                <div class="previous-content next-post-cont">
                    <div class="arrow-text">下一篇</div>
                    <h5 class="previous-post-title next-post-title">没有数据</h5>
                </div>
                <div class="prev-next-arrow">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>                </div>
            </div>
        </a>
    </div>';   
}
}


    
//上一篇
    public static function thePrev($widget)
{
$db = Typecho_Db::get();
$result = $db->select()->from('table.contents')
  ->where('table.contents.created < ?', $widget->created)
  ->where('table.contents.status = ?', 'publish')
  ->where('table.contents.type = ?', $widget->type)
  ->where('table.contents.password IS NULL')
    ->order('table.contents.created', Typecho_Db::SORT_ASC)
  ->limit(1);
  $val = $db->fetchRow($result);
if($val){
$val = Typecho_Widget::widget('Widget_Abstract_Contents')->push($val);
if(!$val['hidden']){
    echo '
  <div class="previous">
        <a class="previous-post" href="'.$val['permalink'].'"
            style="background-image: url(https://cn.bing.com'.self::getBingWalls()[0]['url'].')" >
            <div class="d-flex w-100">
                <div class="previous-content">
                    <div class="arrow-text">上一篇</div>
                    <h5 class="previous-post-title">'.$val['title'].'</h5>
                </div>
                <div class="prev-next-arrow">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>                </div>
            </div>
        </a>
    </div>                
                
                ';
}
}
else{
  echo ' <div class="previous">
        <a class="previous-post" style="background-image: url(https://cn.bing.com'.self::getBingWalls()[0]['url'].')" >
            <div class="d-flex w-100">
                <div class="previous-content">
                    <div class="arrow-text">上一篇</div>
                    <h5 class="previous-post-title">没有数据</h5>
                </div>
                <div class="prev-next-arrow">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>                </div>
            </div>
        </a>
    </div>';   
}
}
}