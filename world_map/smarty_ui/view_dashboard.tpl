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

</script>
<link rel="stylesheet" type="text/css" href="js/jquery.qtip.css" />
<link rel="stylesheet" type="text/css" href="uptime-dashboards.css">
<link rel="stylesheet" type="text/css" href="uptime-view-dashboard.css" />

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery.qtip.js"></script>
<script type="text/javascript" src="uptimeApi/uptimeApi.js"></script>
<script type="text/javascript" src="js/uptime.viewDashboard.js"></script>
<script type="text/javascript" src="js/jquery.qtip.svg.js"></script>
</head>
<body onload="startUp();">

<div id="svgContent">
{$svgContent}
</div>

</body>
</html>
