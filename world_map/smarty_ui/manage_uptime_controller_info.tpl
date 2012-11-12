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
	<td><input type="text" name="controller_hostname" value="{$controller_hostname}"/></td>
</tr>
<tr>
	<td>Controller Username</td>
	<td><input type="text" name="controller_username" value="{$controller_username}"/></td>
</tr>
<tr>
	<td>Controller Password</td>
	<td><input type="password" name="controller_password" value="{$controller_password}"/></td>
</tr>
<tr>
	<td>Controller Port</td>
	<td><input type="text" name="controller_port" value="{$controller_port}"/></td>
</tr>
<tr>
	<td>Controller SSL</td>
	<td><input type="checkbox" name="controller_ssl" value="true"
	{if $controller_ssl == true}
		checked
	{/if}
	>Use SSL</input></td>
</tr>
<tr>
	<td>Controller Version</td>
	<td><input type="text" name="controller_version" value="{$controller_version}"/></td>
</tr>



<tr>
	<th colspan="2">up.time UI Location Info</th>
</tr>
<tr>
	<td>up.time UI Hostname</td>
	<td><input type="text" name="uptime_ui_hostname" value="{$uptime_ui_hostname}"/></td>
</tr>
<tr>
	<td>up.time UI SSL</td>
	<td><input type="checkbox" name="uptime_ui_ssl" value="true"
	{if $uptime_ui_ssl == true}
		checked
	{/if}
	>Use SSL (HTTPS)</input></td>
</tr>
<tr>
	<td>up.time UI Port</td>
	<td><input type="text" name="uptime_ui_port" value="{$uptime_ui_port}"/></td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td><input type="submit" name="save" value="Save" id="savebutton" /><input type="submit" name="resetToDefaults" value="Reset To Defaults" id="resetbutton" /></td>
</tr>
</table>

<p id="message">{$message}</p>

<br/><a href="manage_dashboards.php">Go Back</a>
</form>

<!-- Tour created with Amberjack wizard: http://amberjack.org -->
{$tourText}
</body>
</html>
