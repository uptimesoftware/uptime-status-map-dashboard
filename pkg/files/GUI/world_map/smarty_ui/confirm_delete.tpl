<!DOCTYPE html>
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
<p id="message">Are you REALLY SURE you want to delete the '{$dashboard}' dashboard?</p>

<br/><br/>
<table border="0px">
<tr>
<td><form method="POST" action="?del={$dashboard}&confirm=yes"><input type="submit" name="yes" value="Yes, Delete '{$dashboard}'." id="button" /></form></td>
<td><form method="POST" action="?"><input type="submit" name="no" value="No, I Want To Keep It" id="button" /></form></td>
</tr>
</table>

</body>
</html>
