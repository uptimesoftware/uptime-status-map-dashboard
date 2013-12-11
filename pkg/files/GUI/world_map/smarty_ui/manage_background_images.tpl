<!DOCTYPE html>
<html>
<head>

<style type="text/css">
body {
	margin: 10px;
}
table {
	border: 1px solid black;
	padding: 0px;
	margin: 0px;
	border-spacing: 0px;
}
th {
	background-color: darkgrey;
	color: white;
}
td, th {
	border: 1px solid black;
	padding: 7px;
}
#message {
	color: red;
}

.imageContainer {
	overflow: auto;
	width: 100%;
}
.floatingImg {
	float: left;
	border: 1px solid #000000;
	margin: 10px;
	padding: 0px;
}
.image {
	float: left;
	width: 200px;
	height: 130px;
	margin: 0px;
	padding: 0px;
}
.deleteButton {
	margin: 0px;
	padding: 4px;
	visibility: visible;
	clear: left;
	width: 100%;
}
</style>

<script type="text/javascript">
// hide and rename submit button to prevent double-clicks (and look cooler ;) )
function hide_submit_button() {
	document.getElementById('click_once').value = "Uploading...";
	document.getElementById('click_once').disabled = true;
	document.getElementById('upload_image').submit();
	return true;
}
function deleteImage(image) {
	// ask the user what they want to do
	var r = confirm("The image '" + image + "' will be deleted forever!\nIf any dashboards require this image you will need to edit each one and select a new image.\n\nAre you sure you want to delete this image?");
	if (r == true) {
		
		return true;
	}
	else {
		return false;
	}
}
</script>
<link rel="stylesheet" type="text/css" href="uptime-dashboards.css" />
<script type="text/javascript" src="uptimeApi/jquery.js"></script>
<script type="text/javascript" src="uptimeApi/uptimeApi.js"></script>
<title>Manage Background Images</title>
</head>
<body>
<br/><a href="manage_dashboards.php">Go Back</a><br/><br/>
<h2>Manage Background Images</h2>
<p>Add or remove images to use in the status map dashboards.</p>

<form enctype="multipart/form-data" method="POST" id="upload_image">
	<input type="hidden" name="MAX_FILE_SIZE" value="75000000" />
	<input type="file" name="uploadedFile" />
	<input type="submit" value="Upload Image" id="click_once" onclick="hide_submit_button();" />
</form>
<p id="message">{$message}</p>


<h2>Loaded Background Images</h2>

<div class="imageContainer">
{foreach from=$backgroundImages item=image}
<div class="floatingImg">
	<a href="{$image}" target="image">
		<img class="image" src="{$image}" alt="{$image}">
	</a>
	<br>
	<form method="POST" action="?">
	<input type="hidden" name="imageName" value="{$image}">
	<input type="submit" name="delete" value="Delete Image" class="deleteButton" onclick="return deleteImage('{$image}');">
	</form>
</div>
{/foreach}
</div>

<br/>
<div style="clear;">
<p><a href="manage_dashboards.php">Go Back</a></p>
</div>

<!-- Tour created with Amberjack wizard: http://amberjack.org -->
{$tourText}
</body>
</html>
