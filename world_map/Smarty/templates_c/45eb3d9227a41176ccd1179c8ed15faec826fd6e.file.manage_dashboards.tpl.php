<?php /* Smarty version Smarty-3.1.12, created on 2012-11-09 17:11:46
         compiled from ".\smarty_ui\manage_dashboards.tpl" */ ?>
<?php /*%%SmartyHeaderCode:28710509810bbb295a2-34387468%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '45eb3d9227a41176ccd1179c8ed15faec826fd6e' => 
    array (
      0 => '.\\smarty_ui\\manage_dashboards.tpl',
      1 => 1352499105,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '28710509810bbb295a2-34387468',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_509810bbbb4142_22101314',
  'variables' => 
  array (
    'message' => 0,
    'dashboards' => 0,
    'dash' => 0,
    'copyLinkPath' => 0,
    'tourText' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_509810bbbb4142_22101314')) {function content_509810bbbb4142_22101314($_smarty_tpl) {?><!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="uptime-dashboards.css" />
<style>
#message {
	color: red;
}
#startTourImage {
	float: right;
	width: 125px;
	height: 120px;
}
</style>
<script type="text/javascript">
function confirmDelete(dashboardName) {
	// ask the user what they want to do
	var r = confirm("Dashboard will be deleted forever!\nAre you sure you want to delete '" + dashboardName + "'?");
	if (r == true) {
		return true;
	}
	else {
		return false;
	}
}
</script>
<script type="text/javascript" src="uptimeApi/jquery.js"></script>
<script type="text/javascript" src="uptimeApi/uptimeApi.js"></script>
<title>Manage Map Dashboards</title>
</head>
<body style="margin: 20px">


<a href="?traverse=1&tourId=DashboardsTour&skinId=black_beauty"><img src="start_tour.png" alt="Click here to start tour!" id="startTourImage" /></a>


<h1>Create and Manage Your up.time Status Map Dashboards</h1>
<br/>

<h2>1. Setup Connection to up.time Controller (API)</h2>
<div>
<a href="manage_uptime_controller_info.php">
Setup Connection to up.time Controller (API)
</a>
</div>

<h2>2. Manage Background Images</h2>
<div>
<a href="manage_background_images.php">
Manage Background Images
</a>
</div>

<h2>3. Create New Dashboard</h2>
<div>
<a href="map_editor.php">
Create New Dashboard
</a>
</div>

<h2>4. Manage Existing Dashboards</h2>
<div>
<div id="message"><?php echo $_smarty_tpl->tpl_vars['message']->value;?>
</div>
<?php if (count($_smarty_tpl->tpl_vars['dashboards']->value)>0){?>
<table id="dashboards" border="1" width="75%" cellspacing="0px" cellpadding="3px">
<tr>
	<th>Del</th>
	<th>Edit</th>
	<th>Name (Click to View)</th>
	<th>Copy Link</th>
</tr>

<?php  $_smarty_tpl->tpl_vars['dash'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['dash']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['dashboards']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['dash']->key => $_smarty_tpl->tpl_vars['dash']->value){
$_smarty_tpl->tpl_vars['dash']->_loop = true;
?>
<tr>
	<td><a href="?del=<?php echo $_smarty_tpl->tpl_vars['dash']->value;?>
" onclick="return confirmDelete('<?php echo $_smarty_tpl->tpl_vars['dash']->value;?>
');">Del</a></td>
	<td><a href="map_editor.php?d=<?php echo $_smarty_tpl->tpl_vars['dash']->value;?>
">Edit</a></td>
	<td><a href="view_dashboard.php?d=<?php echo $_smarty_tpl->tpl_vars['dash']->value;?>
" target="view"><?php echo $_smarty_tpl->tpl_vars['dash']->value;?>
</a></td>
	<td><input id="copyText" type="text" value="<?php echo $_smarty_tpl->tpl_vars['copyLinkPath']->value;?>
view_dashboard.php?d=<?php echo $_smarty_tpl->tpl_vars['dash']->value;?>
&" onclick="this.select(); document.execCommand('Copy');" size="60" /></td>
</tr>
<?php } ?>
</table>

<br/>
<p>To add any dashboard to a custom tab in the up.time interface just follow the steps below. You can have one custom tab in GlobalScan and an unlimited amount in My Portal.</p>
<h4>Adding a tab to GlobalScan:</h4>
<ul>
	<li>Copy the link of the dashboard you want to use (you can use any internal/external URL as well)</li>
	<li>Click on the Config tab</li>
	<li>Click on the "up.time Configuration" link on the left side menu</li>
	<li>Paste the following in the textfield and click on Save</li>
</ul>
<textarea cols="80" rows="4">
globalscan.custom.tab.enabled=true
globalscan.custom.tab.name=CCTV Page Rotator
globalscan.custom.tab.URL=/Page_Rotator/
</textarea>

<br/><br/>
<h4>Adding a tab to My Portal:</h4>
<ul>
	<li>Copy the link of the dashboard you want to use (you can use any internal/external URL as well)</li>
	<li>Click on the Config tab</li>
	<li>Click on the "up.time Configuration" link on the left side menu</li>
	<li>Paste the following in the textfield and click on Save (if you want to add more tabs, just change the "tab1" by increasing the number for each custom tab. Example: myportal.custom.tab1 ...)</li>
</ul>
<textarea cols="80" rows="4">
myportal.custom.tab1.enabled=true
myportal.custom.tab1.name=Map Status Dashboard (anything you like here)
myportal.custom.tab1.URL=[PASTE THE URL HERE]
</textarea>


<?php }else{ ?>

Go ahead and create some dashboards!

<?php }?>
</div>



<!-- Tour created with Amberjack wizard: http://amberjack.org -->
<?php echo $_smarty_tpl->tpl_vars['tourText']->value;?>

</body>
</html>
<?php }} ?>