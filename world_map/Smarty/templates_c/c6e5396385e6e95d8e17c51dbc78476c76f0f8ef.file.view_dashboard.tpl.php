<?php /* Smarty version Smarty-3.1.12, created on 2012-11-07 15:00:09
         compiled from ".\smarty_ui\view_dashboard.tpl" */ ?>
<?php /*%%SmartyHeaderCode:320075099896c15e1e6-14347169%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c6e5396385e6e95d8e17c51dbc78476c76f0f8ef' => 
    array (
      0 => '.\\smarty_ui\\view_dashboard.tpl',
      1 => 1352318406,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '320075099896c15e1e6-14347169',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5099896c1eb9b6_34094159',
  'variables' => 
  array (
    'controller_hostname' => 0,
    'controller_username' => 0,
    'controller_password' => 0,
    'controller_port' => 0,
    'controller_version' => 0,
    'controller_ssl' => 0,
    'uptime_ui_hostname' => 0,
    'uptime_ui_port' => 0,
    'svgContent' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5099896c1eb9b6_34094159')) {function content_5099896c1eb9b6_34094159($_smarty_tpl) {?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=9">
<title>View Dashboard</title>
<style>
	html, body, #svgContent {
		padding: 0px;
		margin: 0px;
		border: 0px;
		width:  100%;
		height: 100%;            /* IE treats as min-height */ 
	}
</style>
<script type="text/javascript">

// uptimeAPI variables
var uptime_host = '<?php echo $_smarty_tpl->tpl_vars['controller_hostname']->value;?>
';
var uptime_user = '<?php echo $_smarty_tpl->tpl_vars['controller_username']->value;?>
';
var uptime_pass = '<?php echo $_smarty_tpl->tpl_vars['controller_password']->value;?>
';
var uptime_port = <?php echo $_smarty_tpl->tpl_vars['controller_port']->value;?>
;
var uptime_ver = '<?php echo $_smarty_tpl->tpl_vars['controller_version']->value;?>
';
var uptime_ssl = <?php echo $_smarty_tpl->tpl_vars['controller_ssl']->value;?>
;
var uptime_ui_hostname = '<?php echo $_smarty_tpl->tpl_vars['uptime_ui_hostname']->value;?>
';
var uptime_ui_port = <?php echo $_smarty_tpl->tpl_vars['uptime_ui_port']->value;?>
;

// uptime UI settings
<?php if ('uptime_ui_ssl'==true){?>
var uptime_ui_protocol = "https://";
<?php }else{ ?>
var uptime_ui_protocol = "http://";
<?php }?>
var uptime_ui_url = uptime_ui_protocol + uptime_ui_hostname + ":" + uptime_ui_port + "/";

</script>
<link rel="stylesheet" type="text/css" href="js/jquery.qtip.css" />
<link rel="stylesheet" type="text/css" href="uptime-dashboards.css">
<link rel="stylesheet" type="text/css" href="uptime-view-dashboard.css" />

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery.qtip.js"></script>
<script type="text/javascript" src="uptimeApi/uptimeApi.js"></script>
<script type="text/javascript" src="js/uptime.viewDashboard.js"></script>
</head>
<body onload="startUp();">

<div id="svgContent">
<?php echo $_smarty_tpl->tpl_vars['svgContent']->value;?>

</div>

</body>
</html>
<?php }} ?>