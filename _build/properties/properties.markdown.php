<?php

$properties = array();

$tmp = array(
    'id' => array(
        'type' => 'numberfield',
        'value' => '',
    ),
    'field' => array(
        'type' => 'textfield',
        'value' => 'content',
    ),
    'type' => array(
        'type' => 'list',
        'options' => array(
            array('text' => 'GitHub Flavored', 'value' => 'Parsedown'),
            array('text' => 'Classic Markdown', 'value' => 'Markdown'),
            array('text' => 'Markdown Extra', 'value' => 'MarkdownExtra'),
        ),
        'value' => 'Parsedown',
    ),
    'stripTags' => array(
        'type' => 'combo-boolean',
        'value' => false,
    ),
    'escapeTags' => array(
        'type' => 'combo-boolean',
        'value' => true,
    ),
);

foreach ($tmp as $k => $v) {
    $properties[] = array_merge(
        array(
            'name' => $k,
            'desc' => PKG_NAME_LOWER . '_prop_' . $k,
            'lexicon' => PKG_NAME_LOWER . ':properties',
        ), $v
    );
}

return $properties;