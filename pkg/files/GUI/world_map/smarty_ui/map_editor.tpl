<!DOCTYPE html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=9">
<link rel="stylesheet" type="text/css" href="uptime-dashboards.css" />

<script type='text/javascript'>
var originalDashboardName = "{$svgDashboardName}";

// uptimeAPI variables
var uptime_host = '{$controller_hostname}';
var uptime_user = '{$controller_username}';
var uptime_pass = '{$controller_password}';
var uptime_port = {$controller_port};
var uptime_ver = '{$controller_version}';
var uptime_ssl = {$controller_ssl};

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
								{foreach from=$backgrounds item=background}
								<option value="{$background}">{$background}</option>
								{/foreach}
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
								<a href="{$uptimeApiTestLink}" target="apiTest">List not working? Click here to test up.time API.</a><br/>
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
			<embed src="{$svgFileName}"
				id="svgCanvas"
				class="image"
				width="100%" height="100%"
				type="image/svg+xml"
			></embed>
		</td>
	</tr>
</table>


<!-- Tour created with Amberjack wizard: http://amberjack.org -->
{$tourText}

</body>
</html>