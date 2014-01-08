<?php

$properties = array();

$tmp = array(
	'id' => array(
		'type' => 'numberfield',
		'value' => ''
	),
	'field' => array(
		'type' => 'textfield',
		'value' => 'content'
	),
	'type' => array(
		'type' => 'list',
		'options' => array(
			array('text' => 'Markdown','value' => 'Markdown'),
			array('text' => 'Parsedown','value' => 'Parsedown'),
			array('text' => 'MarkdownExtra','value' => 'MarkdownExtra'),
		),
		'value' => 'MarkdownExtra',
	),
	'stripTags' => array(
		'type' => 'textfield',
		'value' => 0,
	),
	'escapeTags' => array(
		'type' => 'combo-boolean',
		'value' => true,
	)
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