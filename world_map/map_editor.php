<?php

// up.time SVG Dashboard Generator
// uptime software 2012
// author: Joel Pereira

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
$backgrounds = array();
$dir = "backgrounds";
chdir($dir);
foreach ( glob("*.jpg") as $filename ) {
	//echo "<option value='backgrounds/{$filename}'>{$filename}</option>\n";
	array_push($backgrounds, $filename);
}
chdir("..");


////////////////////////////////////////////////////////////////////////////////////////////
// SMARTY: Assign variables
$smarty->assign( 'backgrounds', $backgrounds );
$smarty->assign( 'svgDashboardName', $svgDashboardName );
$smarty->assign( 'svgFileName', $svgFileName );

// SMARTY: Display page
$smarty->display('map_editor.tpl');


exit(0);
?>
