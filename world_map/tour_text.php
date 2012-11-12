<?php

function getTourText() {
// Amberjack (Javascript) tour
$txt = <<< 'EOF'

<div class="ajTourDef" id="DashboardsTour" style="display:none">
	<div title="manage_dashboards.php?traverse=1">
	Welcome!<br/>
	Here we'll take you through the initial steps so you can create your own status map dashboards.
	<br/><br/>(click the next arrow to continue)
	</div>
	
	<div title="manage_uptime_controller_info.php">
	Before creating one you'll need to setup the up.time Controller configuration. This will allow the dashboard to communicate with the up.time API (Controller).<br/><br/>
	Here you can specify where the up.time Controller is installed. Normally it's on the same server as the monitoring station, but it doesn't have to be.
	<br/><br/>(click the next arrow to continue)
	</div>
	
	<div title="manage_background_images.php">
	We can also customize the background image of your status map. You can use any image that you like and we've included a few examples.<br/>
	An image of a world map or the server rack might be a good image to use.
	<br/><br/>(click the next arrow to continue)
	</div>

	<div title="map_editor.php">
	This is where you can drag and drop elements onto the canvas.<br/>
	You can use either a circle or a square to represent an element. Just click the add button and then drag it to wherever you like. There's no difference between the two; feel free to use whichever you prefer (or a mixture of both).<br/>
	Once you're done, just click the Save button at the bottom.
	<br/><br/>(click the next arrow to continue)
	</div>
	
	<div title="manage_dashboards.php?traverse=3">
	The dashboards created here are not automatically linked in up.time. To add a dashboard you created to GlobalScan or My Portal tab, just follow the instructions that will show up below.
	</div>
</div>
<script type="text/javascript" src="js/amberjack.pack.js"></script>
<script type="text/javascript" src="js/skin/black_beauty/control.tpl.js"></script>
<script type="text/javascript" defer="true">
	Amberjack.onCloseClickStay = true;
	Amberjack.bodyCoverCloseOnClick = true;
	Amberjack.open();
</script>

EOF;

return $txt;

}

?>