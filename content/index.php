<?php
echo tagUX::h2Plain('DAWN', 'text-center my-2');
echo tagUX::contentBox(nodeValue(), cssUX::container);

$home = [
	['know-these', 'welcome'],
];

foreach ($home as $item) {
	$link = replaceHtml('%url%' . $item[0]) . '/';
	renderExcerpt(SITEPATH . '/' . $item[1] . '/' . $item[0] . '/home.md', $link, '');
	echo cbCloseAndOpen('container');
}

foreach (['what', 'who', 'usage', 'alignment'] as $item) {
	$link = replaceHtml('%url%' . $item) . '/';
	renderExcerpt(__DIR__ . '/' . $item . '.md', $link, '');
	echo cbCloseAndOpen('container');
}
echo getCodeSnippet('features');
contentBox('end', '');

runFeature(features::explore);
variable('slim', true);
network_menu(function($item) { showSite($item); });
