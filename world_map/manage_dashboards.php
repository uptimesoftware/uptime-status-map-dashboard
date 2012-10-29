<?php
// Include the Smarty header file
require_once("smarty_header.php");

// open this directory 
$saveDir = opendir("saved");
// get each entry
while($entryName = readdir($saveDir)) {
	// don't add the . and ..
	if (preg_match("/\.svg$/", $entryName)) {
		$dirArray[] = substr($entryName, 0, count($entryName)-5);	// remove the ".svg"
	}
}
// close directory
closedir($saveDir);

// sort
sort($dirArray, SORT_STRING);

////////////////////////////////////////////////////////////////////////////////////////////
// SMARTY: Assign variables
$smarty->assign( 'dashboards', $dirArray );
// SMARTY: Display page
$smarty->display('manage_dashboards.tpl');
?>

