<?php

// up.time SVG Dashboard Loader
// This will simply load the previously saved SVG dashboard and add the necessary <script> tag(s) and mouse/over/etc events for editing/dragging/dropping.
// uptime software 2012
// author: Joel Pereira

// default dashboard/map template
$svgFileName = "map_editor_template.svg";

// determine if we're loading another saved dashboard
if (isset($_REQUEST['d'])) {
	$svgName = $_REQUEST['d'];
	$svgFileName = "saved/{$svgName}.svg";
	// check if the dashboard exists
	if ( ! file_exists($svgFileName) ) {
		print "Dashboard '{$svgName}' does not exist.<br/>";
		exit(2);
	}
}

// load the SVG as XML
$svgContents = simplexml_load_file($svgFileName);

// add <script> tag
$scriptTag = $svgContents->addChild("script", LIBXML_NOEMPTYTAG);
$scriptTag -> addAttribute("xlink:href", 'js/uptime.mapEditor.svg.js', 'http://www.w3.org/1999/xlink');
// add the mouse events to the <g> tags
foreach ($svgContents->g as $g) {
	$g->addAttribute('onmouseup',   'drop(this);');
	$g->addAttribute('onmousedown', 'pickUp(this);');
	$g->addAttribute('onclick',     'updateFormFields(this);');
	//$g->addAttribute('onmouseover', 'updateFormFields(this)');
}


// echo the SVG XML contents
header('Content-Type:image/svg+xml');
print $svgContents->asXML();
exit(0);
?>
