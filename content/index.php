<?php
echo tagUX::h2Plain('DAWN', 'text-center my-2');
echo tagUX::contentBox(nodeValue(), cssUX::container);
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
