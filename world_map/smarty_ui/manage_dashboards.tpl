<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="uptime-dashboards.css" />

<script type="text/javascript" src="uptimeApi/jquery.js"></script>
<script type="text/javascript" src="uptimeApi/uptimeApi.js"></script>
<title>Manage Map Dashboards</title>
</head>
<body style="margin: 0px">

{if false}
<h2>Manage Background Images</h2>
<div>
<a href="manage_background_images.php">
(not functional) Manage Background Images
</a>
</div>
{/if}

<h2>Create New Dashboard</h2>
<div>
<a href="map_editor.php">
Create New Dashboard
</a>
</div>

<h2>Manage Existing Dashboards</h2>
<div>
{if $dashboards|@count gt 0}
<table id="dashboards" border="1" width="75%" cellspacing="0px" cellpadding="3px">
<tr>
	<th>Del</th>
	<th>Name (Click to View)</th>
	<th>Edit</th>
	<th>Copy Link</th>
</tr>

{foreach from=$dashboards item=dash}
<tr>
	<td><a href="">Del</a></td>
	<td><a href="view_dashboard.php?d={$dash}" target="view">{$dash}</a></td>
	<td><a href="map_editor.php?d={$dash}">Edit</a></td>
	<td><input id="copyText" type="text" value="view_dashboard.php?d={$dash}" onclick="this.select(); document.execCommand('Copy');" size="50" /></td>
</tr>
{/foreach}
</table>

{else}

Go ahead and create some dashboards!

{/if}
</div>

</body>
</html>
