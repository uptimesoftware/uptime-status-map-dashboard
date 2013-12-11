<?php
// up.time SVG Dashboard Saver
// This will save the XML output as well as verify if the file exists already or not
// uptime software 2012
// author: Joel Pereira

// determine if we're just checking if the file exists
if (isset($_REQUEST['checkName'])) {
	$svgName = $_REQUEST['checkName'];
	$svgFileName = "saved/{$svgName}.svg";
	
	// first, verify it's a valid name 
	if (preg_match("/^[a-zA-Z0-9\-\_]+$/", $svgName)) {
		// valid name; do nothing
	}
	else {
		// invalid name
		print "Invalid dashboard name";	// 1 = file exists
		exit(0);
	}
	
	// check if the dashboard exists
	if ( file_exists($svgFileName) ) {
		print "File already exists";	// 1 = file exists
		exit(0);
	}
	else {
		print "File does not exist";	// 0 = file does not exist
		exit(0);
	}
}

// determine if we're saving the XML/SVG input
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_REQUEST['d'])) {
	$svgName = $_REQUEST['d'];
	$svgFileName = "saved/" . $svgName . ".svg";
	$xml = file_get_contents('php://input');
	
	// first, verify it's a valid name 
	if (preg_match("/^[a-zA-Z0-9\-\_]+$/", $svgName)) {
		// valid name; do nothing
	}
	else {
		// invalid name
		print "Invalid dashboard name. Can only contain letters, numbers, dash (-), and underscore (_)";	// 1 = file exists
		exit(0);
	}
	
	if (true) {
		$myFile = $svgFileName;
		$fh = fopen($myFile, 'w') or die("can't open file");
		fwrite($fh, $xml);
		fclose($fh);
	}
	else {
		$inp = fopen("php://input");
		$outp = fopen($svgFileName, "w");
		while (!feof($inp)) {
			$buffer = fread($inp, 8192);
			fwrite($outp, $buffer);
		}
		fclose($inp);
		fclose($outp);
	}
	print "Successfully saved '{$svgName}'.";
	exit(0);
}

exit(0);
?>
