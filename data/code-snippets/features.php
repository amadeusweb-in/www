<?php
$items = explode(NEWLINES2 . '---' . NEWLINES2, disk_file_get_contents(SITEPATH . '/data/features.md'));
$tabName = 'canvas-feature';

$links = [];
$tabs = [];
foreach ($items as $ix => $item) {
	$bits = explode('**', $item, 3);
	$name = $bits[1];
	$item = renderSET::create(renderSET::default, false)->markdown()->render($bits[2]);
	$slug = $tabName . '-' . str_replace('.', '', urlize($name));
	$links[] = '			<li class="nav-item" role="presentation">
				<button class="nav-link ' . ($ix == 0 ? 'active ' : '') . 'container-modules-loaded" data-bs-toggle="pill" data-bs-target="#' . $slug
					. '" type="button" role="tab" aria-controls="#' . $slug . '" aria-selected="' . ($ix == 0 ? 'true' : 'false') . '">' . $name . '</button>
			</li>';
	$tabs[] = '			<div class="tab-pane fade' . ($ix == 0 ? ' active show' : '') . '" id="' . $slug . '" role="tabpanel" aria-labelledby="' . $tabName . '">'
				. NEWLINE . $item . NEWLINE . '</div>';
}
return '<div class="row g-0 tabs-bordered">
	<div class="col-md-3">
		<ul class="nav canvas-tabs tabs nav-tabs flex-column mb-3" id="' . $tabName . '" role="tablist">
		'
		. implode(NEWLINES2, $links)
		. '
		</ul>
	</div>
	<div class="col-md-9">
		<div id="' . $tabName . '" class="tab-content">'
		. implode(NEWLINES2, $tabs)
		. '
		</div>
	</div>
</div>

<style>
.tabs-bordered .tab-content p { margin-bottom: 20px; }
</style>';
