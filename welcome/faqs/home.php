<?php
$home = replaceHtml('%url%' . nodeValue() . '/');

echo tagUX::h2Plain('FAQ Center :: ' .
	getLink('Home', $home, 'btn btn-info') . ' ' .
	getLink('All', $home . 'all/', 'btn btn-warning')
	, cssUX::CenterContainer);
contentBox(nodeValue(), cssUX::container);

$for = getPageParameterAt();
$answers = __DIR__ . '/data/answers.md';

if ($for == 'all') {
	renderAny($answers);
	return;
}

$items = explode(NEWLINES2 . '----' . NEWLINES2, disk_file_get_contents($answers));
$files = getQueryParameter('files');
if ($files) echo '<textarea class="w-100" rows="12">' . '#sno	slug	name' . NEWLINE;
foreach ($items as $group) {
	$qs = explode(NEWLINES2 . '---' . NEWLINES2, $group);
	$bits = explode('. ', $qs[0], 2);
	$gno = substr($bits[0], 3);
	$gname = $bits[1];

	$gslug = urlize($gname, true);
	unset($qs[0]);

	if ($files) {
		echo $gno . '	' . $gslug . '	' . $gname . NEWLINE;
		continue;
	}

	if (!$for) {
		echo renderSingleLineMarkdown('#### ' . $gno . '. [' . $gname . ']('
			. $home . $gslug . ($for == $gslug ? '/BTNOUTLINEINFO' :'/BTNSUCCESS') . ')');
	}

	if ($for != $gslug) continue;

	echo renderSingleLineMarkdown('## ' . $gno . ' ' . $gname);

	$questions = [];
	$answers = [];

	foreach ($qs as $item) {
		$q = explode(NEWLINE, explode('**Question:** ', $item)[1])[0];
		$to = explode(NEWLINE, explode('**Applies To:** ', $item)[1])[0];
		$qslug = urlize($q, true);
		$questions[] = '1. [' . $q . '](#' . $qslug . ') &mdash;> ' . $to;
		$answers[] = cbCloseAndOpen(cssUX::container) . '<a name="' . $qslug . '"></a>' . NEWLINE .
			renderSET::create(renderSET::default, BOOLNo)->markdown()->render($item);
	}

	renderMarkdown(implode(NEWLINE, $questions));
	echo implode(NEWLINES2, $answers);
}

if ($files) echo '</textarea>';
