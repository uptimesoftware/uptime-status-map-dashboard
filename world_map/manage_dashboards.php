<?php
// Include the Smarty header file
require_once("smarty_header.php");

$message = "";

// determine if we need to delete a dashboard
if (isset($_REQUEST['del'])) {
	$svgName = $_REQUEST['del'];
		$svgFileName = "saved/{$svgName}.svg";
	// check if it's been confirmed
	if (isset($_REQUEST['confirm'])) {
		// check if the dashboard exists
		if ( ! file_exists($svgFileName) ) {
			$message = "Dashboard '{$svgName}' does not exist.";
		}
		else {
			// delete the file
			unlink($svgFileName);
		}
		
		// redirect back to itself, to clear the URL of any options
		header('Location: .');
	}
	else {
		// confirm page
		////////////////////////////////////////////////////////////////////////////////////////////
		// SMARTY: Assign variables
		$smarty->assign( 'dashboard', $svgName );
		$smarty->assign( 'message', $message );
		// SMARTY: Display page
		$smarty->display('confirm_delete.tpl');
		exit(0);
	}
}

// get current directory link(/world_map/)
$url = $_SERVER['REQUEST_URI']; //returns the current URL
$parts = explode('/',$url);
$path = "";
for ($i = 0; $i < count($parts) - 1; $i++) {
	$path .= $parts[$i] . "/";
}

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


// Amberjack (Javascript) tour
require_once("tour_text.php");
$tourText = getTourText();




////////////////////////////////////////////////////////////////////////////////////////////
// SMARTY: Assign variables
$smarty->assign( 'dashboards', $dirArray );
$smarty->assign( 'message', $message );
$smarty->assign( 'copyLinkPath', $path );
$smarty->assign( 'tourText', $tourText );
// SMARTY: Display page
$smarty->display('manage_dashboards.tpl');
?>

