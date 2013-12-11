<?php /* Smarty version Smarty-3.1.12, created on 2012-11-07 16:29:37
         compiled from ".\smarty_ui\confirm_delete.tpl" */ ?>
<?php /*%%SmartyHeaderCode:4304509ac415550472-34227741%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '06414862567b7b50134dff4bcde57443d24fd086' => 
    array (
      0 => '.\\smarty_ui\\confirm_delete.tpl',
      1 => 1352323776,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '4304509ac415550472-34227741',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_509ac415598556_06917877',
  'variables' => 
  array (
    'dashboard' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_509ac415598556_06917877')) {function content_509ac415598556_06917877($_smarty_tpl) {?><!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="uptime-dashboards.css" />
<style>
#message {
	color: red;
	font-size: 13px;
	font-weight: bold;
}
#button {
	padding: 5px;
}
</style>
<script type="text/javascript" src="uptimeApi/jquery.js"></script>
<script type="text/javascript" src="uptimeApi/uptimeApi.js"></script>
<title>Confirm Deletion</title>
</head>
<body style="margin: 100px">

<br/><br/>
<h2>Final Confirmation</h2>

<br/>
<p id="message">Are you REALLY SURE you want to delete the '<?php echo $_smarty_tpl->tpl_vars['dashboard']->value;?>
' dashboard?</p>

<br/><br/>
<table border="0px">
<tr>
<td><form method="POST" action="?del=<?php echo $_smarty_tpl->tpl_vars['dashboard']->value;?>
&confirm=yes"><input type="submit" name="yes" value="Yes, Delete '<?php echo $_smarty_tpl->tpl_vars['dashboard']->value;?>
'." id="button" /></form></td>
<td><form method="POST" action="?"><input type="submit" name="no" value="No, I Want To Keep It" id="button" /></form></td>
</tr>
</table>

</body>
</html>
<?php }} ?>