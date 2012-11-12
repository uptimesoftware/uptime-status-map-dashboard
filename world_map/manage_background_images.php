<?php
// Include the Smarty header file
require_once("smarty_header.php");

// manage the background pictures
// add, delete pictures

// setup defaults
$message = "";
$imageDir = "backgrounds/";


// upload new image
// http://www.w3schools.com/PHP/php_file_upload.asp
if (isset($_FILES) && count($_FILES) > 0) {
	$uploaded_file = basename( $_FILES['uploadedFile']['name']);
	$target_file = $imageDir . $uploaded_file;
	
	if ($_FILES["uploadedFile"]["error"] > 0) {
		$message = "Error uploading file: " . $_FILES["uploadedFile"]["error"] . "<br/>\nSee '<a href='http://php.net/manual/en/features.file-upload.errors.php'>http://php.net/manual/en/features.file-upload.errors.php</a>' for more info.";
		$message = "Error uploading file. Try again.";
		$message = "Error uploading file. Make sure the Apache httpd.conf file is configured to allow file uploads larger than 2MB and try again.";
	}
	else {
		// good uploaded file, so let's move it to the backgrounds directory
		// make sure the file type is valid
		if ($_FILES["uploadedFile"]["size"] > 100 && $_FILES["uploadedFile"]["size"] < 100000000) {
			 // copy the image
			copy($_FILES["uploadedFile"]["tmp_name"], $target_file);
			$message = "Image saved.";
		}
		else {
			$message = "Invalid file.";
		}
	}
	
}
// delete image
else if (isset($_REQUEST['delete']) && isset($_REQUEST['imageName'])) {
	$img = $_REQUEST['imageName'];
	$ok = unlink($img);
	if ($ok) {
		$message = "Image '{$img}' deleted successfully.";
	}
	else {
		$message = "Error: Could not delete '{$img}'.";
	}
}


// load all images
// load the pictures in the "backgrounds" directory
$backgroundImages = array();
foreach ( glob($imageDir . "{*.jpg,*.JPG,*.jpeg,*.JPEG,*.png,*.PNG,*.gif,*.GIF}", GLOB_BRACE) as $filename ) {
	//echo "<option value='backgrounds/{$filename}'>{$filename}</option>\n";
	array_push($backgroundImages, $filename);
}


// Amberjack (Javascript) tour
require_once("tour_text.php");
$tourText = getTourText();


////////////////////////////////////////////////////////////////////////////////////////////
// SMARTY: Assign variables
$smarty->assign( 'message', $message );
$smarty->assign( 'backgroundImages', $backgroundImages );
$smarty->assign( 'tourText', $tourText );
// SMARTY: Display page
$smarty->display('manage_background_images.tpl');
?>

