<!DOCTYPE html>
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
var uptime_host = '{$controller_hostname}';
var uptime_user = '{$controller_username}';
var uptime_pass = '{$controller_password}';
var uptime_port = {$controller_port};
var uptime_ver = '{$controller_version}';
var uptime_ssl = {$controller_ssl};
var uptime_ui_hostname = '{$uptime_ui_hostname}';
var uptime_ui_port = {$uptime_ui_port};

// uptime UI settings
{if uptime_ui_ssl == true}
var uptime_ui_protocol = "https://";
{else}
var uptime_ui_protocol = "http://";
{/if}
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
{$svgContent}
</div>

</body>
</html>
