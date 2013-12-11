<?php /* Smarty version Smarty-3.1.12, created on 2012-11-09 16:17:23
         compiled from ".\smarty_ui\manage_uptime_controller_info.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2658850981d3113d881-80841416%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c710d477dfb1d75fd45207b1b67b15ddac72d504' => 
    array (
      0 => '.\\smarty_ui\\manage_uptime_controller_info.tpl',
      1 => 1352495839,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2658850981d3113d881-80841416',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_50981d3118b0f6_41862951',
  'variables' => 
  array (
    'controller_hostname' => 0,
    'controller_username' => 0,
    'controller_password' => 0,
    'controller_port' => 0,
    'controller_ssl' => 0,
    'controller_version' => 0,
    'uptime_ui_hostname' => 0,
    'uptime_ui_ssl' => 0,
    'uptime_ui_port' => 0,
    'message' => 0,
    'tourText' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_50981d3118b0f6_41862951')) {function content_50981d3118b0f6_41862951($_smarty_tpl) {?><!DOCTYPE html>
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
#savebutton {
	padding: 4px;
	width: 75px;
}
#resetbutton {
	padding: 4px;
}
#message {
	color: red;
}
</style>

<link rel="stylesheet" type="text/css" href="uptime-dashboards.css" />
<script type="text/javascript" src="uptimeApi/jquery.js"></script>
<script type="text/javascript" src="uptimeApi/uptimeApi.js"></script>
<title>Manage up.time Controller (API) Info</title>
</head>
<body>
<br/><a href="manage_dashboards.php">Go Back</a><br/><br/>
<h2>up.time Controller (API) Connection Info</h2>
<p>This is where you can enter the connection information for your "up.time Controller". If you have not installed the "up.time Controller" yet, visit <a href="http://support.uptimesoftware.com/download.php?#controllers" target="download">the up.time download page to install it here</a>.</p>
<form method="POST">

<table>
<tr>
	<th colspan="2">up.time Controller Info</th>
</tr>
<tr>
	<td>Controller Hostname</td>
	<td><input type="text" name="controller_hostname" value="<?php echo $_smarty_tpl->tpl_vars['controller_hostname']->value;?>
"/></td>
</tr>
<tr>
	<td>Controller Username</td>
	<td><input type="text" name="controller_username" value="<?php echo $_smarty_tpl->tpl_vars['controller_username']->value;?>
"/></td>
</tr>
<tr>
	<td>Controller Password</td>
	<td><input type="password" name="controller_password" value="<?php echo $_smarty_tpl->tpl_vars['controller_password']->value;?>
"/></td>
</tr>
<tr>
	<td>Controller Port</td>
	<td><input type="text" name="controller_port" value="<?php echo $_smarty_tpl->tpl_vars['controller_port']->value;?>
"/></td>
</tr>
<tr>
	<td>Controller SSL</td>
	<td><input type="checkbox" name="controller_ssl" value="true"
	<?php if ($_smarty_tpl->tpl_vars['controller_ssl']->value==true){?>
		checked
	<?php }?>
	>Use SSL</input></td>
</tr>
<tr>
	<td>Controller Version</td>
	<td><input type="text" name="controller_version" value="<?php echo $_smarty_tpl->tpl_vars['controller_version']->value;?>
"/></td>
</tr>



<tr>
	<th colspan="2">up.time UI Location Info</th>
</tr>
<tr>
	<td>up.time UI Hostname</td>
	<td><input type="text" name="uptime_ui_hostname" value="<?php echo $_smarty_tpl->tpl_vars['uptime_ui_hostname']->value;?>
"/></td>
</tr>
<tr>
	<td>up.time UI SSL</td>
	<td><input type="checkbox" name="uptime_ui_ssl" value="true"
	<?php if ($_smarty_tpl->tpl_vars['uptime_ui_ssl']->value==true){?>
		checked
	<?php }?>
	>Use SSL (HTTPS)</input></td>
</tr>
<tr>
	<td>up.time UI Port</td>
	<td><input type="text" name="uptime_ui_port" value="<?php echo $_smarty_tpl->tpl_vars['uptime_ui_port']->value;?>
"/></td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td><input type="submit" name="save" value="Save" id="savebutton" /><input type="submit" name="resetToDefaults" value="Reset To Defaults" id="resetbutton" /></td>
</tr>
</table>

<p id="message"><?php echo $_smarty_tpl->tpl_vars['message']->value;?>
</p>

<br/><a href="manage_dashboards.php">Go Back</a>
</form>

<!-- Tour created with Amberjack wizard: http://amberjack.org -->
<?php echo $_smarty_tpl->tpl_vars['tourText']->value;?>

</body>
</html>
<?php }} ?>