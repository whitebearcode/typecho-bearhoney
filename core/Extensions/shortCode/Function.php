<?php
namespace BearExtensions\shortCode;
use Utils\Helper;
use bhOptions;
class Extension{
    public static function getNS(): string
    {
        return __NAMESPACE__;
    }
    
    public static function activate(){
       \Typecho\Plugin::factory('Widget_Abstract_Contents')->excerptEx_1 = [__CLASS__, 'shortcode_parse_content'];
       \Typecho\Plugin::factory('Widget_Abstract_Contents')->contentEx_1 = [__CLASS__, 'shortcode_parse_content'];
       \Typecho\Plugin::factory('admin/write-post.php')->bottom_1 =  [__CLASS__,'shortcode_button'];
       \Typecho\Plugin::factory('Widget_Archive')->header_2 = [__CLASS__, 'shortcode_headlink']; 
       \Typecho\Plugin::factory('Widget_Archive')->footer_2 = [__CLASS__, 'shortcode_footlink']; 
    }
    
    public static function get_shortcode_atts_regex()
    {
        return '/([\w-]+)\s*=\s*"([^"]*)"(?:\s|$)|([\w-]+)\s*=\s*\'([^\']*)\'(?:\s|$)|([\w-]+)\s*=\s*([^\s\'"]+)(?:\s|$)|"([^"]*)"(?:\s|$)|\'([^\']*)\'(?:\s|$)|(\S+)(?:\s|$)/';
    }
    
    public static function shortcode_parse_atts($text)
    {
        $atts = array();
        $pattern = self::get_shortcode_atts_regex();
        $text = preg_replace("/[\x{00a0}\x{200b}]+/u", ' ', $text);
        if (preg_match_all($pattern, $text, $match, PREG_SET_ORDER)) {
            foreach ($match as $m) {
                if (!empty($m[1])) {
                    $atts[strtolower($m[1])] = stripcslashes($m[2]);
                } elseif (!empty($m[3])) {
                    $atts[strtolower($m[3])] = stripcslashes($m[4]);
                } elseif (!empty($m[5])) {
                    $atts[strtolower($m[5])] = stripcslashes($m[6]);
                } elseif (isset($m[7]) && strlen($m[7])) {
                    $atts[] = stripcslashes($m[7]);
                } elseif (isset($m[8]) && strlen($m[8])) {
                    $atts[] = stripcslashes($m[8]);
                } elseif (isset($m[9])) {
                    $atts[] = stripcslashes($m[9]);
                }
            }
            foreach ($atts as &$value) {
                if (false !== strpos($value, '<')) {
                    if (1 !== preg_match('/^[^<]*+(?:<[^>]*+>[^<]*+)*+$/', $value)) {
                        $value = '';
                    }
                }
            }
        } else {
            $atts = ltrim($text);
        }
        return $atts;
    }
    


    public static function get_shortcode_regex($tagnames = null)
    {
        global $shortcode_tags;
        if (empty($tagnames)) {
            $tagnames = array_keys($shortcode_tags);
        }
        $tagregexp = join('|', array_map('preg_quote', $tagnames));
        return
            '\\['                           
            . '(\\[?)'                        
            . "($tagregexp)"       
            . '(?![\\w-])'                    
            . '('                         
            . '[^\\]\\/]*'               
            . '(?:'
            . '\\/(?!\\])'     
            . '[^\\]\\/]*'          
            . ')*?'
            . ')'
            . '(?:'
            . '(\\/)'                    
            . '\\]'           
            . '|'
            . '\\]'              
            . '(?:'
            . '('       
            . '[^\\[]*+'  
            . '(?:'
            . '\\[(?!\\/\\2\\])'
            . '[^\\[]*+'
            . ')*+'
            . ')'
            . '\\[\\/\\2\\]'    
            . ')?'
            . ')'
            . '(\\]?)'; 
    }
    
    public static function excerpt_text($content)
    {
        if (strpos($content, '[btn') !== false) {
            $pattern = self::get_shortcode_regex(array('btn'));
            $content = preg_replace("/$pattern/", '', $content);
        }
       if (strpos($content, '[player') !== false) {
            $pattern = self::get_shortcode_regex(array('player'));
            $content = preg_replace("/$pattern/", '', $content);
        }
        return $content;
    }
    
    //按钮回调
    public static function parseButtonCallback($matches)
    {
        $matches[3] = preg_replace("/<a href=.*?>(.*?)<\/a>/",'$1',$matches[3]);
        $attr = htmlspecialchars_decode($matches[3]);
        $attrs = self::shortcode_parse_atts($attr);
        $type = "";
        $color = "primary";
        $linkUrl = "";
        if (@$attrs['type'] == "common") {
            $type = "btn btn-";
        }
        if (@$attrs['url'] != "") {
            $linkUrl = 'window.open("' . $attrs['url'] . '","_blank")';
        }
        if (@$attrs['color'] != "") {
            $color = $attrs['color'];
        }
       
 
        return <<<EOF
<button class="{$type}{$color}" onclick='{$linkUrl}'>{$matches[5]}</button>
EOF;
}
     //视频播放器回调
    public static function parsePlayerCallback($matches)
    {
        $matches[3] = preg_replace("/<a href=.*?>(.*?)<\/a>/",'$1',$matches[3]);
        $attr = htmlspecialchars_decode($matches[3]);
        $attrs = self::shortcode_parse_atts($attr);

        $config = [
            'live' => false,
            'autoplay' => false,
            'theme' => '#FADFA3',
            'loop' => 'true',
            'screenshot' => false,
            'hotkey' => true,
            'preload' => 'metadata',
            'lang' => 'zh-cn',
            'logo' => null,
            'volume' => 0.7,
            'mutex' => true,
            'video' => [
                'url' => isset($attrs['url']) ? $attrs['url'] : null,
                'pic' => isset($attrs['image']) ? $attrs['image'] : Helper::options()->themeUrl.'/assets/images/placeholder.png',
                'type' => 'auto',
                'thumbnails' => null,
            ],
        ];
        $json = json_encode($config,JSON_UNESCAPED_SLASHES);
        return <<<EOF
        <div class="dplayer" data-config='{$json}'></div>
EOF;
    }
    
    
    
    public static function shortcode_parse_content($content,$obj,$text)
    {
      $content = empty($text)?$content:$text;
      //解析显示按钮短代码
    if (strpos($content, '[btn') !== false) {
            $pattern = self::get_shortcode_regex(array('btn'));
            $content = preg_replace_callback("/$pattern/", 'self::parseButtonCallback', $content);
        }
    //解析显示视频播放器短代码
    if (strpos($content, '[player') !== false) {
            $pattern = self::get_shortcode_regex(array('player'));
            $content = preg_replace_callback("/$pattern/", 'self::parsePlayerCallback', $content);
    }
      if(!$obj->is('single') && strpos($content, '[hide') !== false){
      $content = '文章包含隐藏内容，请进入文章内页查看~';
      }
      if(!$obj->is('single') && strpos($content, '[login') !== false){
      $content = '文章包含隐藏内容，请进入文章内页查看~';
      }
      if(!$obj->is('single')){
       $content = self::excerpt_text($content);
      }

               return $content;
}

    public static function shortcode_button(){
        ?>
        <style>.wmd-button-row {
    height: auto;
}
</style>
<link rel="stylesheet" href="//cdn.staticfile.org/font-awesome/4.7.0/css/font-awesome.min.css" />
<link rel="stylesheet" href="//cdn.staticfile.org/limonte-sweetalert2/11.3.10/sweetalert2.min.css" />
<link href="https://staticfile.typecho.co.uk/sweetalert2/bootstrap-4.css" rel="stylesheet">
<link rel="stylesheet" href="//cdn.staticfile.org/bootstrap-colorpicker/3.4.0/css/bootstrap-colorpicker.min.css" />
<script src="//cdn.staticfile.org/limonte-sweetalert2/11.3.10/sweetalert2.min.js"></script>
        <script type="text/javascript" src="//cdn.staticfile.org/bootstrap-colorpicker/3.4.0/js/bootstrap-colorpicker.min.js"></script>
        <script>
        $(document).ready(function() {
shortCode_button();
shortCode_player();
});



//插入按钮
function shortCode_button(){
    	if ($("#wmd-button-row").length > 0) {
		$('#wmd-button-row').append('<li class="wmd-button" id="wmd-btn-button" style="" title="插入按钮"><span style="background: none;margin-top:7px;font-size: 15px;text-align: center;color: #999999;font-family: serif;"><i class="fa fa-circle-o-notch"></i></span></li>');

		
		
		$(document).on('click', '#wmd-btn-button',
		function() {
			$('body').append('<div id="btn_Panel">' + '<div class="wmd-prompt-background" style="position: fixed; top: 0px; z-index: 1000; opacity: 0.5; height: 100%; left: 0px; width: 100%;"></div>' + '<div class="wmd-prompt-dialog">' + '<div>' + '<p><b>插入按钮</b><br><br></p>' + '<p>按钮类型：<select id="btn-type" style="margin-bottom:10px">' + '<option value="common">普通' + '</select></p>' + '<p>按钮颜色：<select id="btn-color" style="margin-bottom:10px">' + '<option value="primary">粉黑色' + '<option value="secondary">灰色'+ '<option value="success">绿色'+ '<option value="danger">红色'+ '<option value="warning">黄色'+ '<option value="info">青色'+ '<option value="light">白色'+ '<option value="dark">黑色'+ '<option value="link">无色' + '</select></p>' + '<p>按钮跳转网址：<input name="btn-url" type="text" placeholder="填写按钮跳转网址"></input></p>' + '<p>按钮显示文字：<input name="btn-text" type="text" placeholder="填写按钮显示文字"></input></p>' + '</div>' + '<button type="button" class="btn btn-s primary" id="btn_submit">确定</button>' + '<button type="button" class="btn btn-s" id="btn_cancel">取消</button>' + '</div>' + '</div>');
		});
		

		
		$(document).on('click', '#btn_cancel',
		function() {
			$('#btn_Panel').remove();
			$('#text').focus();
		});
		
		$(document).on('click', '#btn_submit',
		function() {
			var type = $("#btn-type option:selected").val();
			var color = $("#btn-color option:selected").val();
			var link = $('.wmd-prompt-dialog input[name="btn-url"]').val();
			var text = $('.wmd-prompt-dialog input[name="btn-text"]').val();
			if (text == '') {
				text = '这是一个按钮';
			}
			textContent = '\r\n' + '[btn type="' + type + '" color="' + color + '" url="' + link + '"]'+text+'[/btn]' + '\r\n';
			myField = document.getElementById('text');
			insertButton(myField, textContent, '#btn_Panel');
		});
    	};
}

//插入播放器
function shortCode_player(){
    	if ($("#wmd-button-row").length > 0) {
		$('#wmd-button-row').append('<li class="wmd-button" id="wmd-player-button" style="" title="插入视频"><span style="background: none;margin-top:7px;font-size: 15px;text-align: center;color: #999999;font-family: serif;"><i class="fa fa-video-camera"></i></span></li>');

		
		
		$(document).on('click', '#wmd-player-button',
		function() {
			$('body').append('<div id="player_Panel">' + '<div class="wmd-prompt-background" style="position: fixed; top: 0px; z-index: 1000; opacity: 0.5; height: 100%; left: 0px; width: 100%;"></div>' + '<div class="wmd-prompt-dialog">' + '<div>' + '<p><b>插入视频</b><br><br></p>' + '<p>视频文件链接：<input name="player-videourl" type="text" placeholder="填写视频文件链接"></input></p>' + '<p>视频封面图片链接：<input name="player-imgurl" type="text" placeholder="填写视频封面图片链接"></input></p>' + '</div>' + '<button type="button" class="btn btn-s primary" id="player_submit">确定</button>' + '<button type="button" class="btn btn-s" id="player_cancel">取消</button>' + '</div>' + '</div>');
		});
		

		
		$(document).on('click', '#player_cancel',
		function() {
			$('#player_Panel').remove();
			$('#text').focus();
		});
		
		$(document).on('click', '#player_submit',
		function() {
			var videourl = $('.wmd-prompt-dialog input[name="player-videourl"]').val();
			var imgurl = $('.wmd-prompt-dialog input[name="player-imgurl"]').val();
			textContent = '\r\n' + '[player url="' + videourl + '" image="' + imgurl + '"]' + '\r\n';
			myField = document.getElementById('text');
			insertButton(myField, textContent, '#player_Panel');
		});
    	};
}



function insertButton(myField, textContent, modelId = '') {
	if (modelId != '') {
		$(modelId).remove();
	}
	if (document.selection) {
		myField.focus();
		var sel = document.selection.createRange();
		sel.text = textContent;
		myField.focus();
	} else if (myField.selectionStart || myField.selectionStart == '0') {
		var startPos = myField.selectionStart;
		var endPos = myField.selectionEnd;
		var cursorPos = startPos;
		myField.value = myField.value.substring(0, startPos) + textContent + myField.value.substring(endPos, myField.value.length);
		cursorPos += textContent.length;
		myField.selectionStart = cursorPos;
		myField.selectionEnd = cursorPos;
		myField.focus();
	} else { //其他环境
		myField.value += textContent;
		myField.focus();
	}
}
</script>
        <?php
    }
    
    public static function shortcode_headlink(){
        $options = bhOptions::getInstance()::get_option('bearhoney');
        $dir = Helper::options()->themeUrl.'/core/Extensions/shortCode/Modules/';
        $cssUrl = $dir.'Player/player.min.css';
        echo '<link rel="stylesheet" type="text/css" href="' . $cssUrl . '" />';
    }
    public static function shortcode_footlink(){
        $options = bhOptions::getInstance()::get_option('bearhoney');
        $dir = Helper::options()->themeUrl.'/core/Extensions/shortCode/Modules/';
        echo '
        <script src="' . $dir . '/Player/player.min.js" /></script>
        <script src="' . $dir . '/Player/load-player.js" /></script>
        <script src="' . $dir . '/Player/hls.min.js" /></script>
        <script src="' . $dir . '/Player/flv.min.js" /></script>';
    }
    

}
