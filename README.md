Markdown for MODX Revolution
============
Vasily Naumkin <bezumkin@yandex.ru>

Allows you to write site documents very easy:
```
[[Markdown?
	&id=`15`
	&field=`content`
]]
[[Markdown?field=`introtext`]]
```

You can specify type of parser (default is MarkdownExtra.)
```
[[Markdown?type=`Markdown`]]
[[Markdown?type=`MarkdownExtra`]]
[[Markdown?type=`Parsedown`]]
```

To allow the use of MODX tags within Markdown text, specify `&escapeTags` parameter. (default is 1)
```
[[Markdown? &field=`content` &type=`Parsedown` &escapeTags=`0`]]
```

Also this snippet can parse and process any string, that should be passed via `&raw` parameter.
```
[[Markdown? &raw=`[[+placeholder]]`]]
```

Feel free to suggest ideas/improvements/bugs on GitHub:
<http://github.com/bezumkin/modx-markdown/issues>

Libraries
---------
This package includes:

* PHP Markdown lib by Michel Fortin <https://github.com/michelf/php-markdown>
* Parsedown lib by Emanuil Rusev <https://github.com/erusev/parsedown>

Requirement
-----------
**PHP Markdown** requires PHP 5.3 or later.

Before PHP 5.3.7, pcre.backtrack_limit defaults to 100 000, which is too small
in many situations. You might need to set it to higher values. Later PHP
releases defaults to 1 000 000, which is usually fine.

**Parsedown** requires PHP 5.2 or later.
