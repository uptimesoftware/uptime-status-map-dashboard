<?php /* Smarty version Smarty-3.1.12, created on 2012-11-09 16:18:18
         compiled from ".\smarty_ui\manage_background_images.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2100509ad52094c565-08271906%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '91adf9335bee43644f933601bffb028f32995f99' => 
    array (
      0 => '.\\smarty_ui\\manage_background_images.tpl',
      1 => 1352495875,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2100509ad52094c565-08271906',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_509ad5209c2245_91515560',
  'variables' => 
  array (
    'message' => 0,
    'backgroundImages' => 0,
    'image' => 0,
    'tourText' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_509ad5209c2245_91515560')) {function content_509ad5209c2245_91515560($_smarty_tpl) {?><!DOCTYPE html>
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
<p id="message"><?php echo $_smarty_tpl->tpl_vars['message']->value;?>
</p>


<h2>Loaded Background Images</h2>

<div class="imageContainer">
<?php  $_smarty_tpl->tpl_vars['image'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['image']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['backgroundImages']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['image']->key => $_smarty_tpl->tpl_vars['image']->value){
$_smarty_tpl->tpl_vars['image']->_loop = true;
?>
<div class="floatingImg">
	<a href="<?php echo $_smarty_tpl->tpl_vars['image']->value;?>
" target="image">
		<img class="image" src="<?php echo $_smarty_tpl->tpl_vars['image']->value;?>
" alt="<?php echo $_smarty_tpl->tpl_vars['image']->value;?>
">
	</a>
	<br>
	<form method="POST" action="?">
	<input type="hidden" name="imageName" value="<?php echo $_smarty_tpl->tpl_vars['image']->value;?>
">
	<input type="submit" name="delete" value="Delete Image" class="deleteButton" onclick="return deleteImage('<?php echo $_smarty_tpl->tpl_vars['image']->value;?>
');">
	</form>
</div>
<?php } ?>
</div>

<br/>
<div style="clear;">
<p><a href="manage_dashboards.php">Go Back</a></p>
</div>

<!-- Tour created with Amberjack wizard: http://amberjack.org -->
<?php echo $_smarty_tpl->tpl_vars['tourText']->value;?>

</body>
</html>
<?php }} ?>