<?php
$sheet = getSheet('principles', false);

$format = htmlUX::keyOf(htmlUX::artHAuto2) .
	'<a class="d-inline-block w-100 fw-bold text-center" style="color: %hex%" href="#todo-%slug%">
		#%sno%<br />%text%<br />%svg%<br />%description%</a>'
	. htmlUX::keyOf(htmlUX::artClose);

$result = [htmlUX::keyOf(htmlUX::artAllHAuto)];

foreach ($sheet->getAllItemsAsObject(false, function($obj) { 
	$obj['slug'] = urlize($obj['text']);
	$obj['hex'] = explode('"', explode('stroke="', $obj['svg'])[1], 2)[0]; //pick from svg..
	return $obj;
}) as $item)
	$result[] = replaceItems($format, $item, WRAPREPLACE);

$result[] = htmlUX::keyOf(htmlUX::artAllClose);
return replaceHtml(htmlUX::replaceAll(implode(NEWLINE, $result)));
