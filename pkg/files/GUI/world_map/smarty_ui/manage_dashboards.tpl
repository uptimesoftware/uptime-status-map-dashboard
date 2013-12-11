<!DOCTYPE html>
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
<div id="message">{$message}</div>
{if $dashboards|@count gt 0}
<table id="dashboards" border="1" width="75%" cellspacing="0px" cellpadding="3px">
<tr>
	<th>Del</th>
	<th>Edit</th>
	<th>Name (Click to View)</th>
	<th>Copy Link</th>
</tr>

{foreach from=$dashboards item=dash}
<tr>
	<td><a href="?del={$dash}" onclick="return confirmDelete('{$dash}');">Del</a></td>
	<td><a href="map_editor.php?d={$dash}">Edit</a></td>
	<td><a href="view_dashboard.php?d={$dash}" target="view">{$dash}</a></td>
	<td><input id="copyText" type="text" value="{$copyLinkPath}view_dashboard.php?d={$dash}&" onclick="this.select(); document.execCommand('Copy');" size="60" /></td>
</tr>
{/foreach}
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
globalscan.custom.tab.name=My Dashboard
globalscan.custom.tab.URL=[PASTE THE URL HERE]
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


{else}

Go ahead and create some dashboards!

{/if}
</div>



<!-- Tour created with Amberjack wizard: http://amberjack.org -->
{$tourText}
</body>
</html>
