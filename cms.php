<?php
variables([
	VARLinkToSectionHome => true,
]);

function site_before_render() {
	autosetPageMenu([VARDontOverwriteLogo => true, VARLinkToNodeHome => true]);
}
