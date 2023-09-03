<?php
CSF::createSection( $prefix, array(
    'parent'      => 'ExtensionList',
    'title'       => '短代码',
    'version'       => 'v1.0.1',
    'icon'        => 'fa fa-code',
    'description' => '短代码列表',
    'fields'      => array(
       array(
            'type'    => 'notice',
            'style'   => 'info',
            'content' => '<strong>1、按钮</strong><br> [btn type="按钮类型" color="颜色" url="点击按钮跳转的网址"]按钮名[/btn]<br>
    您可以在文章中添加按钮，按钮可设置跳转链接<br>
    按钮参数：<br>
    type:common<br>
    color:primary、secondary、success、danger、warning、info、light、dark、link<br>
    url:点击按钮跳转的网址，需带http(s)://，如https://www.baidu.com/<br>',
        ),
       array(
            'type'    => 'notice',
            'style'   => 'info',
            'content' => '<strong>2、视频</strong><br>[player url="视频文件地址" image="视频封面图地址"]<br>
    您可以在文章中通过该短代码插入视频',
        ),
        ),
        ));