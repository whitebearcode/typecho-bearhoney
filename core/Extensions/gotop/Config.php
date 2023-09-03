<?php
CSF::createSection( $prefix, array(
    'parent'      => 'ExtensionList',
    'title'       => '返回顶部',
    'version'       => 'v1.0.0',
    'icon'        => 'fa fa-long-arrow-up',
    'description' => '返回顶部配置',
    'fields'      => array(
       array(
            'id'      => 'gotop_open',
            'type'    => 'switcher',
            'title'       => '是否开启返回顶部',
            'after' => '<br><br>开启则底部右侧将显示返回顶部按钮',
            'default' => false,
        ), 
        ),
        ));