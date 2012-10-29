// Colours for Statuses
var uptimeColorOk = '#67B10B';
var uptimeColorOkLine = 'darkgreen';
var uptimeColorWarn = '#DAD60B';
var uptimeColorWarnLine = 'orange';
var uptimeColorCrit = '#B61211';
var uptimeColorCritLine = 'darkred';
var uptimeColorMaint = '#555B98';
var uptimeColorMaintLine = 'blue';
var uptimeColorUnknown = '#AEAEAE';
var uptimeColorUnknownLine = 'darkgrey';

// Timing variables
var showRefreshLine = true;
var refreshRate = 15;	// API refresh rate in seconds


// setup global variables
var uptime_host = 'localhost';
var uptime_user = 'admin';
var uptime_pass = 'admin';
var uptime_port = 9997;
var uptime_ver = 'v1';
var uptime_ssl = true;
var uptime_ui_url = "https://" + uptime_host + ":9999";

// connect to the uptime API
var uptime_api = new uptimeApi(uptime_user, uptime_pass, uptime_host, uptime_port, uptime_ver, uptime_ssl);

// global variables
var lastRefresh = 0;


function getGroup(id) {
	var groups = document.getElementsByTagName("g");
	for (var i = 0; i < groups.length; i++) {
		if (groups[i].id == id) {
			return groups[i];
		}
	}
	return false;
}

function startUp() {
	// add a refresh status line to the top of the SVG
	if (showRefreshLine) {
		svgCanvas = document.getElementsByTagName("svg")[0];
		var refreshBG = document.createElementNS("http://www.w3.org/2000/svg", "rect");
		refreshBG.setAttribute( "id", "refreshBG");
		refreshBG.setAttribute( "x","0px");
		refreshBG.setAttribute( "y","0px");
		refreshBG.setAttribute( "width","16em");
		refreshBG.setAttribute("font-size", "8pt")
		refreshBG.setAttribute( "height","1.3em");
		refreshBG.setAttribute( "fill","#FFFFFF");
		
		var refreshText = document.createElementNS("http://www.w3.org/2000/svg", "text");
		refreshText.setAttribute("id","refreshTextLine");
		refreshText.setAttribute("x", "0px")
		refreshText.setAttribute("y", "1em")
		refreshText.setAttribute("font-size", "8pt")
		refreshText.setAttribute('fill', '#000000');
		
		// add the objects to the SVG document
		svgCanvas.appendChild(refreshBG);
		svgCanvas.appendChild(refreshText);
		
		$("#refreshTextLine").empty().append("Auto-refreshing...");
		
		// add timing function to update the refresh line
		setInterval(function() {
			// display how many seconds are left until a new refresh
			var secs = 0;
			var nextCheck = lastRefresh + refreshRate;
			var now = new Date().getTime() / 1000;
			var secsLeft = Math.round(nextCheck - now);
			$("#refreshTextLine").empty().append("Auto-refreshing in "+secsLeft+" secs...");
		}, 1000);
	}
	
	// refresh all the statuses
	refreshStatuses();
	
	// set the timer for every (refreshRate) seconds
	setInterval(refreshStatuses, refreshRate * 1000);
}


function refreshStatuses() {
	lastRefresh = new Date().getTime() / 1000;
	// load all the element statuses
	var allGTags = document.getElementsByTagName("g");
	//for (var i = 0; i < allG.length; i++) {
	$.each(allGTags, function(index, value) {
		var curG = value;
		var curShapeText = curG.getElementsByTagName("text")[0].textContent;
		var curElementID = curG.id;
		// update the status (ASYNC)
		uptime_api.getElementStatus(curElementID, function(elementStatus) {
			// Since this is an asyncronous function, it cannot access any variables outside of this function
			var monitorStatuses = elementStatus.monitorStatus;
		
//console.log(elementStatus);

			// if error exists; ignore
			if (typeof(elementStatus.error) != "undefined") {
				// TODO: do nothing right now
				//alert(elementStatus.errorDescription);
			}
			else {
				var group = getGroup(elementStatus.id)
				var shapeText = group.getElementsByTagName("text")[0].textContent;
				var shape = group.getElementsByTagName(shapeText)[0];
				// change the colour based on the status (crit, warn, ok, etc)
				if (elementStatus.status == "OK") {
					//shape.setAttribute("fill", uptimeColorOk);
					shape.setAttribute("stroke", uptimeColorOk);
				}
				else if (elementStatus.status == "WARN") {
					//shape.setAttribute("fill", uptimeColorWarn);
					shape.setAttribute("stroke", uptimeColorWarn);
				}
				else if (elementStatus.status == "CRIT") {
					//shape.setAttribute("fill", uptimeColorCrit);
					shape.setAttribute("stroke", uptimeColorCrit);
				}
				else if (elementStatus.status == "MAINT") {
					//shape.setAttribute("fill", uptimeColorMaint);
					shape.setAttribute("stroke", uptimeColorMaint);
				}
				else if (elementStatus.status == "UNKNOWN") {
					//shape.setAttribute("fill", uptimeColorUnknown);
					shape.setAttribute("stroke", uptimeColorUnknown);
				}
				
				// make the inside shape color the status of the WORST MONITOR STATUS
				// get the worst monitor status
				var worstStatus = getWorstMonitorStatus(monitorStatuses);
				if (worstStatus == "OK") {
					shape.setAttribute("fill", uptimeColorOk);
				}
				else if (worstStatus == "WARN") {
					shape.setAttribute("fill", uptimeColorWarn);
				}
				else if (worstStatus == "CRIT") {
					shape.setAttribute("fill", uptimeColorCrit);
				}
				else if (worstStatus == "MAINT") {
					shape.setAttribute("fill", uptimeColorMaint);
				}
				else if (worstStatus == "UNKNOWN") {
					shape.setAttribute("fill", uptimeColorUnknown);
				}

//console.log('#' + curShapeText + curElementID);
//console.log($('#' + curShapeText + curElementID));


				// setup string
				var tipText = "<a href='" + uptime_ui_url + "/main.php?section=Profile&subsection=&id=" + elementStatus.id + "&name=" + elementStatus.name + "&displaytab=2' target='_blank' class='uptime" + elementStatus.status + "' style='text-decoration: none;'>" +
							"Monitor Status:<br/>";
				// add monitor status info
				var numOfOK = 0;
				var numOfWarn = 0;
				var numOfCrit = 0;
				var numOfMaint = 0;
				var numOfUnknown = 0;
				// add a visual representation of the monitor statuses for the current system
				var barHeight = 35;
				var barMaxWidth = 250;
				var monitorText = "";
				// foreach function
				$.each(monitorStatuses, function(index, monitor) {
					if (monitor.isMonitored) {	// only look at checks that isMonitored=true
						monitorText += "<tr><td class='"+monitor.status+"'>";
						monitorText += monitor.name;
						monitorText += "</td><td class='"+monitor.status+"'>";
						monitorText += monitor.status;
						monitorText += "</td></tr>";
						// also, while we're here, let's calculate the status totals
						if (monitor.status == "OK") { numOfOK++; }
						if (monitor.status == "WARN") { numOfWarn++; }
						if (monitor.status == "CRIT") { numOfCrit++; }
						if (monitor.status == "MAINT") { numOfMaint++; }
						if (monitor.status == "UNKNOWN") { numOfUnknown++; }
					}
				});
				tipText += "<table border='1px' cellspacing='0px' cellpadding='2px' style='border-color: 1px'>";
				tipText += "<tr><td colspan='2'>";
				//tipText += "<div id='bar"+elementStatus.id+"' width='"+barMaxWidth+"px' height='"+barHeight+"px' style='margin: 0px;'>";
				tipText += "<div id='bar"+elementStatus.id+"' width='100%' height='100%' style='margin: 0px;'>";
				tipText += genStatusBarSVG(barMaxWidth, barHeight, numOfCrit, numOfWarn, numOfOK, numOfMaint, numOfUnknown);
				tipText += "</div>";
				tipText += "</td></tr>";
				tipText += monitorText
				tipText += "</table>";
				tipText += "</a>";
				
				tipTitle = "<a href='" + uptime_ui_url + "/main.php?section=Profile&subsection=&id=" + elementStatus.id + "&name=" + elementStatus.name + "&displaytab=2' target='_blank' class='uptime" + elementStatus.status + "' style='text-decoration: none;'>" +
						elementStatus.name + " (Host is " + elementStatus.status + ")</a>"

				// add QTip2
				// good example: http://fiddle.jshell.net/ZHNFu/9/show/#test
				$('#' + curShapeText + curElementID).qtip({
					//id: "tt" + curShapeText + curElementID,
					content: {
						text: tipText,
						title: tipTitle
					},
					style: {
						classes: 'ui-tooltip-rounded ui-tooltip-uptime' + elementStatus.status,
						//height:400,
						tip: {corner: true}
					},
					position: {
						my: 'bottom right',
						at: 'top left',
						target: $('#' + curShapeText + curElementID),
						viewport: $('#' + curShapeText + curElementID)
						//target: [5, 5],
					},
					show: {solo:true},
					hide: {event: 'unfocus'}
				});
			}
		});
	});
}

function getWorstMonitorStatus(monitorStatuses) {
	// order of best to worst(same as the GlobalScan > All Services dashboard, but unknown is worst than ok):
	// maint, ok, unknown, warn, crit
	var worstVal = 0;
	
	$.each(monitorStatuses, function(index, monitor) {
		// convert status to int value
		var value = convertStatusToInt(monitor.status);
		if (value > worstVal) {
			worstVal = value;
		}
	});
	return convertIntToStatus(worstVal);
}
function convertStatusToInt(status) {
	// maint(1), ok(2), unknown(3), warn(4), crit(5)
	var val = 0;
	switch(status) {
		case "CRIT":
		val = 5;
		break;
		case "WARN":
		val = 4;
		break;
		case "UNKNOWN":
		val = 3;
		break;
		case "OK":
		val = 2;
		break;
		case "MAINT":
		val = 1;
		break;
	}
	return val;
}
function convertIntToStatus(status) {
	// maint(1), ok(2), unknown(3), warn(4), crit(5)
	var val = "";
	switch(status) {
		case 5:
		val = "CRIT";
		break;
		case 4:
		val = "WARN";
		break;
		case 3:
		val = "UNKNOWN";
		break;
		case 2:
		val = "OK";
		break;
		case 1:
		val = "MAINT";
		break;
	}
	return val;
}

function genStatusBarSVG(maxWidth, maxHeight, crit, warn, ok, maint, unknown) {
	var rv = "";
	var barOK = "#67B10B";
	var barWarn = "#DAD60B";
	var barCrit = "#B61211";
	var barMaint = "#555B98";
	var barUnknown = "#AEAEAE";
	var barBackground = "#000000";
	
	var offset = 2;	// number of pixels to offset for "border"
	var total = crit+warn+ok+maint+unknown;
	// calculate pixel widths
	crit    = crit * (maxWidth-(offset*2)) / total;
	warn    = warn * (maxWidth-(offset*2)) / total;
	ok      = ok * (maxWidth-(offset*2)) / total;
	maint   = maint * (maxWidth-(offset*2)) / total;
	unknown = unknown * (maxWidth-(offset*2)) / total;
	var curXPos = offset;	// track the current position
	
	rv += '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:ev="http://www.w3.org/2001/xml-events" preserveAspectRatio="none" width="'+maxWidth+'px" height="'+maxHeight+'px">';
	rv += "<rect x='0' y='0' width='"+maxWidth+"px' height='"+maxHeight+"px' style='fill:"+barBackground+"'></rect>";
	rv += "<rect x='"+curXPos+"' y='"+offset+"' width='"+crit+"px' height='"+(maxHeight-offset*2)+"px' style='fill:"+barCrit+"'></rect>";
	curXPos += crit;
	rv += "<rect x='"+curXPos+"' y='"+offset+"' width='"+warn+"px' height='"+(maxHeight-offset*2)+"px' style='fill:"+barWarn+"'></rect>";
	curXPos += warn;
	rv += "<rect x='"+curXPos+"' y='"+offset+"' width='"+ok+"px' height='"+(maxHeight-offset*2)+"px' style='fill:"+barOK+"'></rect>";
	curXPos += ok;
	rv += "<rect x='"+curXPos+"' y='"+offset+"' width='"+maint+"px' height='"+(maxHeight-offset*2)+"px' style='fill:"+barMaint+"'></rect>";
	curXPos += maint;
	rv += "<rect x='"+curXPos+"' y='"+offset+"' width='"+unknown+"px' height='"+(maxHeight-offset*2)+"px' style='fill:"+barUnknown+"'></rect>";
	rv += "</svg>";
	return rv;
}



