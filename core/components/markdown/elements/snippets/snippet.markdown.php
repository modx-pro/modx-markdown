<?php
/** @var array $scriptProperties */
if (empty($type)) {$type = 'MarkdownExtra';}
if (empty($field)) {$field = 'content';}
else {$field = strtolower($field);}

// Allow to use parser for any text
if (!empty($raw)) {
	$input = $raw;
}
else {
	/** @var modResource $resource */
	$resource = empty($id)
		? $modx->resource
		: $modx->getObject('modResource', $id);

	if (!$resource) {
		return 'Could not retrieve resource with id = "'.$id.'"';
	}

	$fields = $modx->getFields('modResource');
	$input = array_key_exists($field,$fields)
		? $resource->get($field)
		: $resource->getTVValue($field);
}

// HTML tags in code
$input = preg_replace_callback('/`.*`/s', function($matches) {
	return htmlspecialchars($matches[0], ENT_QUOTES, 'UTF-8');
}, $input);

// Strip HTML tags
if (!empty($stripTags)) {
	// Markdown links, that looks like tag
	$input = preg_replace('#<(.*?(://|@).*?)>#', '&lt;$1&gt;', $input);
	// Strip tags
	if (is_numeric($stripTags)) {$stripTags = '';}
	else {
		$tmp = explode(',', $stripTags);
		$tmp2 = array();
		foreach ($tmp as $v) {
			$tmp2[] = '<' . trim($v, '<> ') . '>';
		}
		$stripTags = implode($tmp2);
	}
	$input = strip_tags($input, $stripTags);
}
// And decode entities
$input = html_entity_decode($input, ENT_QUOTES, 'UTF-8');

// Parse MODX tags
if (empty($escapeTags)) {
	$input = $modx->newObject('modChunk')->process(null, $input);
}
else {
	// Escape MODX params
	$input = preg_replace('/=`(.*?)`/s', '=&#96;$1&#96;', $input);
}

// Parse!
switch(strtolower($type)) {
	case 'markdown':
		if (PHP_VERSION_ID < 50300) {return 'Markdown requires PHP 5.3 or later.';}
		if (!class_exists('\Michelf\Markdown')) {
			require MODX_CORE_PATH . 'components/markdown/lib/Michelf/Markdown.inc.php';
		}
		$input = \Michelf\Markdown::defaultTransform($input);
		break;

	case 'parsedown':
		if (!class_exists('Parsedown')) {
			require MODX_CORE_PATH . 'components/markdown/lib/Parsedown.php';
		}
		$input = Parsedown::instance()->parse($input);
		break;

	case 'extended':
	case 'markdownextended':
		if (!class_exists('MarkdownExtraExtended_Parser')) {
			require MODX_CORE_PATH . 'components/markdown/lib/Extended/markdown_extended.php';
		}
		$parser = new MarkdownExtraExtended_Parser();
		$input = $parser->transform($input);
		break;

	default:
	case 'extra':
	case 'markdownextra':
		if (PHP_VERSION_ID < 50300) {return 'MarkdownExtra requires PHP 5.3 or later.';}
		if (!class_exists('\Michelf\MarkdownExtra')) {
			require MODX_CORE_PATH . 'components/markdown/lib/Michelf/MarkdownExtra.inc.php';
		}
		$input = \Michelf\MarkdownExtra::defaultTransform($input);
		break;
}

// Escape MODX tags
if (!empty($escapeTags)) {
	$input = str_replace(array('[',']','&amp;#96;'), array('&#91;','&#93;','&#96;'), $input);
}

return $input;