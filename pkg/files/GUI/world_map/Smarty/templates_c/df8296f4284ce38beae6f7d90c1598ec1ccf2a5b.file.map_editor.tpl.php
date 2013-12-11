<?php /* Smarty version Smarty-3.1.12, created on 2012-11-09 17:00:21
         compiled from ".\smarty_ui\map_editor.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3090509810f350e377-98534366%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'df8296f4284ce38beae6f7d90c1598ec1ccf2a5b' => 
    array (
      0 => '.\\smarty_ui\\map_editor.tpl',
      1 => 1352498391,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3090509810f350e377-98534366',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_509810f3566901_43618445',
  'variables' => 
  array (
    'svgDashboardName' => 0,
    'controller_hostname' => 0,
    'controller_username' => 0,
    'controller_password' => 0,
    'controller_port' => 0,
    'controller_version' => 0,
    'controller_ssl' => 0,
    'backgrounds' => 0,
    'background' => 0,
    'uptimeApiTestLink' => 0,
    'svgFileName' => 0,
    'tourText' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_509810f3566901_43618445')) {function content_509810f3566901_43618445($_smarty_tpl) {?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=9">
<link rel="stylesheet" type="text/css" href="uptime-dashboards.css" />

<script type='text/javascript'>
var originalDashboardName = "<?php echo $_smarty_tpl->tpl_vars['svgDashboardName']->value;?>
";

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

</script>
<script type='text/javascript' src='js/jquery.js'></script>
<script type='text/javascript' src='uptimeApi/uptimeApi.js'></script>
<script type='text/javascript' src='js/uptime.mapEditor.js'></script>

<style type="text/css">
html, body {
	margin: 0px;
	padding: 0px;
	height: 100%;
	width: 100%;
}
table {
	border-collapse: collapse;
	border: 1px solid black;
	border-spacing: 0px;
	margin: 0px;
	padding: 0px;
	width: 100%;
	height: 100%;
}
td.outer {
	border: 1px solid black;
	height: 100%;
	margin: 0px;
	padding: 0px;
}
td.menu {
	border: 1px solid black;
	margin: 0px;
	padding: 4px;
}
</style>

</head>
<body onLoad="onStartup();">
<table class="outer">
	<tr>
		<td width="350px" class="outer" style="border: 0px;">
			
			<table style="border: 0px;">
				<tr>
					<td valign="top" class="menu" style="height: 75px;">
						<br /><a href="manage_dashboards.php">Go Back</a><br /><br />
						
						1. Set Background<br/>
						(in "backgrounds" dir)<br/>
						<form name="formSetBackground">
							<select id="bgList" name="bgName" onchange="setBGOnSVG();">
								<?php  $_smarty_tpl->tpl_vars['background'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['background']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['backgrounds']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['background']->key => $_smarty_tpl->tpl_vars['background']->value){
$_smarty_tpl->tpl_vars['background']->_loop = true;
?>
								<option value="<?php echo $_smarty_tpl->tpl_vars['background']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['background']->value;?>
</option>
								<?php } ?>
							</select>
							<input type="button" name="load" value="Load" onclick="setBGOnSVG();" />
						</form>
					</td>
				</tr>
				<tr valign="top">
					<td class="menu" style="height: 100px;">
						2. Add Element Shape<br/>
						<form name="">
							<div id="errorSelectElement" style="color: red;"></div>
							<select id="elementsList">
							</select>
							<input type="button" name="refreshList" value="Reload List" onclick="refreshElementsList();" /><br/>
							<div id="listNotWorking">
								<a href="<?php echo $_smarty_tpl->tpl_vars['uptimeApiTestLink']->value;?>
" target="apiTest">List not working? Click here to test up.time API.</a><br/>
								<a href="manage_uptime_controller_info.php">Click here to change the up.time Controller settings.</a><br/>
							</div>
							<input type="button" name="circle" value="Add Circle" style="width: 120px" onclick="addCircle();" /><br/>
							<input type="button" name="square" value="Add Square" style="width: 120px" onclick="addRect();" />
						</form>
					</td>
				</tr>
				<tr valign="top">
					<td class="menu" style="height: 150px;">
						3. Configure Element<br/>
						<form name="formElementInfo">
							<input type="hidden" name="elementID" value="" id="elementID" readonly />
							<table style='border: 0px;'>
							<tr>
								<td>Shape:</td>
								<td><input type="text" name="shapeType" value="" id="shapeType" readonly /></td>
							</tr>
							<tr>
								<td>Element Name:</td>
								<td><input type="text" name="elementName" value="" id="elementName" readonly /></td>
							</tr>
							<tr>
								<td>Position (x):</td>
								<td><input type="text" name="positionXRel" value="" id="elementPosX" readonly /></td>
							</tr>
							<tr>
								<td>Position (y):</td>
								<td><input type="text" name="positionYRel" value="" id="elementPosY" readonly /></td>
							</tr>
							<tr>
								<td>&nbsp;</td>
								<td><input type="button" name="RemoveElement" value="Remove Element From Map" id="removeButton" onclick="removeElement();"  disabled /></td>
							</tr>
							</table>
						</form>
					</td>
				</tr>
				<tr valign="top">
					<td class="menu" style="height: 50px;">
						4. Save Dashboard<br/>
						<form>
						Dashboard Name:<br/><input id="newDashboardName" type="text" name="newDashboardName" value="" /><br/>
						<div id="saveStatus" style="color: red;"></div>
						<div><input type="button" name="saveDashboard" value="Save Dashboard" onclick="return saveDashboardFunc();" onsubmit="return false;" />
						<br/><br/><a href="manage_dashboards.php">Go Back</a>
						</div>
						</form>
					</td>
				</tr>
			</table>
			
		</td>
		<td class="outer">
			<embed src="<?php echo $_smarty_tpl->tpl_vars['svgFileName']->value;?>
"
				id="svgCanvas"
				class="image"
				width="100%" height="100%"
				type="image/svg+xml"
			></embed>
		</td>
	</tr>
</table>


<!-- Tour created with Amberjack wizard: http://amberjack.org -->
<?php echo $_smarty_tpl->tpl_vars['tourText']->value;?>


</body>
</html><?php }} ?>