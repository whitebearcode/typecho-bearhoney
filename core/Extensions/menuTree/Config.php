<?php
CSF::createSection( $prefix, array(
    'parent'      => 'ExtensionList',
    'title'       => '文章导读',
    'version'       => 'v1.0.1',
    'icon'        => 'fa fa-list-ol',
    'description' => '文章导读配置',
    'fields'      => array(
       array(
            'id'      => 'menuTree_open',
            'type'    => 'switcher',
            'title'       => '是否开启文章导读',
            'after' => '<br><br>开启则底部右侧将显示文章导读，在没有H1-H6标签的情况下显示向上和向下按钮',
            'default' => false,
        ), 
        array(
        'id'    => 'menuTree_name',
        'type'  => 'text',
        'title' => '文章导读标题',
        'after' => '请填写文章导读标题，若未填则直接显示为文章导读',
        'dependency' => array( 'menuTree_open', '==', 'true'),
      ),
      array(
            'id'      => 'menuTree_showCode',
            'type'    => 'switcher',
            'title'       => '是否显示段落章节编号',
            'after' => '<br><br>若开启段落章节编号，则在文章存在H1-H6标签的情况下，本扩展将自动在H1-H6标签前排序编号',
            'default' => false,
            'dependency' => array( 'menuTree_open', '==', 'true'),
        ),
        ),
        ));