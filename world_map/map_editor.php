<?php

// up.time SVG Dashboard Generator
// uptime software 2012
// author: Joel Pereira

require_once("controller_conf_functions.php");

// default dashboard/map template
$svgFileName = "load_map_for_editor.php";	// this will load the default SVG template file
$svgDashboardName = "";

// determine if we're loading another saved dashboard
if (isset($_REQUEST['d'])) {
	$svgDashboardName = $_REQUEST['d'];
	$svgFileName = "load_map_for_editor.php?d={$svgDashboardName}";
}


// Include the Smarty header file
require_once("smarty_header.php");


// load the pictures in the "backgrounds" directory
$dir = "backgrounds/";
$backgrounds = array();
foreach ( glob($dir . "{*.jpg,*.JPG,*.jpeg,*.JPEG,*.png,*.PNG,*.gif,*.GIF}", GLOB_BRACE) as $filename ) {
	//echo "<option value='backgrounds/{$filename}'>{$filename}</option>\n";
	array_push($backgrounds, $filename);
}


// get the uptimeAPI info from the saved file for this dashboard
$options = array();
$options = uptimeController::load_controller_info($options);



// Amberjack (Javascript) tour
require_once("tour_text.php");
$tourText = getTourText();


////////////////////////////////////////////////////////////////////////////////////////////
// SMARTY: Assign variables
$smarty->assign( 'backgrounds', $backgrounds );
$smarty->assign( 'svgDashboardName', $svgDashboardName );
$smarty->assign( 'svgFileName', $svgFileName );

// uptimeApi
$uptimeApiTestLink = "{$options['controller_username']}:{$options['controller_password']}@{$options['controller_hostname']}:{$options['controller_port']}/api/{$options['controller_version']}/";
$uptimeApiTestLink = "{$options['controller_username']}:{$options['controller_password']}@{$options['controller_hostname']}:{$options['controller_port']}/api/";

$smarty->assign( 'controller_hostname', $options['controller_hostname'] );
$smarty->assign( 'controller_username', $options['controller_username'] );
$smarty->assign( 'controller_password', $options['controller_password'] );
$smarty->assign( 'controller_port', $options['controller_port'] );
$smarty->assign( 'controller_version', $options['controller_version'] );
$smarty->assign( 'tourText', $tourText );
if ($options['controller_ssl'] == true) {
	$smarty->assign( 'controller_ssl', "true" );
	$uptimeApiTestLink = "https://" . $uptimeApiTestLink;
}
else {
	$smarty->assign( 'controller_ssl', "false" );
	$uptimeApiTestLink = "http://" . $uptimeApiTestLink;
}
$smarty->assign( 'uptimeApiTestLink', $uptimeApiTestLink );

// SMARTY: Display page
$smarty->display('map_editor.tpl');


exit(0);
?>
