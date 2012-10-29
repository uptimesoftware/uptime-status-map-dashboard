// setup global variables
var uptime_host = 'localhost';
var uptime_user = 'admin';
var uptime_pass = 'admin';
var uptime_port = 9997;
var uptime_ver = 'v1';
var uptime_ssl = true;
// connect to the uptime API
var uptime_api = new uptimeApi(uptime_user, uptime_pass, uptime_host, uptime_port, uptime_ver, uptime_ssl);
// setup global variables
var svgEmbed;
var svgCanvas;



function onStartup() {
	// setup global variables
	// get the SVG canvas as an object
	svgCanvas = document.getElementById("svgCanvas").getSVGDocument();
	document.getElementById("newDashboardName").value = originalDashboardName;
	
	// add the <script> tag to the svg canvas; this MUST be added before loading the SVG; browser issue
	// 	<script xlink:href="js/uptime.mapEditor.svg.js"></script>
	//addScriptTagToSVG();
	
	// setup background
	setBGOnSVG(true);
	// refresh elements list
	refreshElementsList();
}

function refreshElementsList() {
	$("select#elementsList").empty().append("<option value='blank'>Loading up.time Elements...</option>");
	uptime_api.getElements("isMonitored=true", function(allElements) {
		$("select#elementsList").empty().append("<option value='blank'>Select an Element...</option>");
		//console.log(allElements);
		$.each(allElements, function(index,element) {
			$("select#elementsList").append("<option value='"+element.id+"'>"+element.name+"</option>\n");		// display just the name
			//$("select#elementsList").append("<option value='"+element.id+"'>"+element.name+" ("+element.hostname+")</option>\n");		// display name and hostname
		});
	});
	return false;
}

// not being used
function addScriptTagToSVG() {
	// 	<script xlink:href="js/uptime.mapEditor.svg.js"></script>
	var newScript = svgCanvas.createElementNS("http://www.w3.org/1999/xlink", "script");
	newScript.setAttributeNS('http://www.w3.org/1999/xlink', 'xlink:href', "js/uptime.mapEditor.svg.js")
	
	// add the group objects to the SVG document
	svgCanvas.documentElement.appendChild(newScript);
	
	// go through each <g> tag and add the necessary onmouse* attributes
	// get all the groups (g tags) in the SVG
	console.log("in here!??!");
	var groups = svgCanvas.getElementsByTagName("g");
	// go through each one to confirm if the element has already been added
	for (var i = 0; i < groups.length; i++) {
		var group = groups[i];
		// add the onmouse* attributes
		group.setAttributeNS(null, "onmouseup",   "drop(this)");
		group.setAttributeNS(null, "onmousedown", "pickUp(this)");
		group.setAttributeNS(null, "onclick",     "updateFormFields(this); showToolTip(this);");
		//group.setAttributeNS(null, "onmouseover", "updateFormFields(this)");
	}
}


function removeElement() {
	var elementToDelete = $('#elementID').attr("value");
	var elementName = $('#elementName').attr("value");
	var elementShape = $('#shapeType').attr("value");

	// confirm if they really want to delete the element
	okToRemove = false;
	var r = confirm("Are you sure you want to remove '"+elementName+"' from the map?");
	if (r == true) {
		// remove
		okToRemove = true;
	}
	else {
		// do nothing
		okToRemove = false;
		msg = "Please select a different dashboard name.";
	}

	if (okToRemove) {
		var elementToDelete = $('#elementID').attr("value");
		// remove element from the map
		// remove any <script> tags
		var groups = svgCanvas.getElementsByTagName("g");
		// go through each one and delete the one with the correct ID
		$.each(groups, function(index, group) {
			if (group.id == elementToDelete) {
				svgCanvas.documentElement.removeChild(groups[index]);
			}
		});
		
		// now let's clear the text fields and disable the button
		$("#elementID").attr('value', '');
		$("#elementName").attr('value', '');
		$("#shapeType").attr('value', '');
		$("#elementPosX").attr('value', '');
		$("#elementPosY").attr('value', '');
		$("#removeButton").attr('disabled', 'false');
	}
}



// load background into 
function setBGOnSVG(onStartup) {
	var bgFileName = document.formSetBackground.bgName.value;
	var svgImg = svgCanvas.getElementById("svgBackground");
	// no need to load background if it already has one
	if (onStartup && svgImg.hasAttributeNS('http://www.w3.org/1999/xlink', 'href') && svgImg.getAttributeNS('http://www.w3.org/1999/xlink', 'href').length > 3) {
		// since there is a background image already, let's just select it from the drop-down list
		var bgInSVG = svgImg.getAttributeNS('http://www.w3.org/1999/xlink', 'href');
		var bgImageList = document.getElementById("bgList");
		// first let's check if it exists in the current list
		var foundImg = false;
		for (var i = 0; i < bgImageList.length; i++) {
			var listItem = bgImageList[i];
			if (listItem.value == bgInSVG) {
				listItem.selected = true;
				foundImg = true;
			}
		}
		// if the bg image isn't in the list, add it
		if ( ! foundImg ) {
			bgImageList.options[bgImageList.options.length] = new Option(bgInSVG, bgInSVG);
			bgImageList.options[bgImageList.options.length-1].selected = true;
		}
	}
	else if (bgFileName != "blank") {
		svgImg.setAttributeNS('http://www.w3.org/1999/xlink', 'xlink:href', bgFileName)
	}
}

function elementAlreadyAdded() {
	var rv = false;
	
	// get selected element
	var selectList = document.getElementById("elementsList");
	var selectListText  = selectList.options[selectList.selectedIndex].text;
	var elementID = selectList.options[selectList.selectedIndex].value;
	// skip the blank (first option in the list)
	if (elementID != "blank") {
		// get all the groups (g tags) in the SVG
		var groups = svgCanvas.getElementsByTagName("g");
		// go through each one to confirm if the element has already been added
		for (var i = 0; i < groups.length; i++) {
			var group = groups[i];
			// check if the element ID exists
			if (group.id == elementID) {
				rv = true;
			}
		}
	}
	return rv;
}

function addCircle() {
	// prevent duplicate elements from being added
	if ( ! elementAlreadyAdded()) {
		addShape("circle");
	}
	else {
		$("div#errorSelectElement").empty().append("Element is already added.")
	}
	return false;
}
function addRect() {
	// prevent duplicate elements from being added
	if ( ! elementAlreadyAdded()) {
		addShape("rect");
	}
	else {
		$("div#errorSelectElement").empty().append("Element is already added.")
	}
	return false;
}
function addLine() {
	addShape("line");
}

function addShape(shape) {
	// clear any error message
	$("div#errorSelectElement").empty();

	// first check if they selected an element from the list
	var selectList = document.getElementById("elementsList");
	var selectListText  = selectList.options[selectList.selectedIndex].text;
	var selectListValue = selectList.options[selectList.selectedIndex].value;
	if (selectListValue != "blank") {
		// valid object; add a group
		
		// SVG g
		var newGroup = svgCanvas.createElementNS("http://www.w3.org/2000/svg", "g");
		newGroup.setAttribute('id', selectListValue);			// element id
		newGroup.setAttribute('shape-rendering', 'crispEdges');	// inherit or crispEdges (http://www.w3.org/TR/SVGTiny12/painting.html)
		//newGroup.setAttribute('pointer-events', 'all');
		newGroup.setAttribute('onmouseup',   'drop(this)');
		newGroup.setAttribute('onmousedown', 'pickUp(this)');
		newGroup.setAttribute('onclick',     'updateFormFields(this); showToolTip(this);');
		newGroup.setAttribute('onmouseover', 'updateFormFields(this)');
		
		// SVG circle
		if (shape == "circle") {
			var newShape = svgCanvas.createElementNS("http://www.w3.org/2000/svg", shape);
			newShape.setAttribute( "id",shape + selectListValue);		// shape (circle/rect/line)
			newShape.setAttribute( "cx","15%");
			newShape.setAttribute( "cy","15%");
			newShape.setAttribute( "r","15px");
		}
		else if (shape == "rect") {
			var newShape = svgCanvas.createElementNS("http://www.w3.org/2000/svg", shape);
			newShape.setAttribute( "id",shape + selectListValue);		// shape (circle/rect/line)
			newShape.setAttribute( "x","15%");
			newShape.setAttribute( "y","15%");
			newShape.setAttribute( "width","30px");
			newShape.setAttribute( "height","30px");
		}
		else if (shape == "line") {
			var newShape = svgCanvas.createElementNS("http://www.w3.org/2000/svg", shape);
			newShape.setAttribute( "id",shape + selectListValue);		// shape (circle/rect/line)
			newShape.setAttribute( "x1","15%");
			newShape.setAttribute( "y1","15%");
			newShape.setAttribute( "x2","30%");
			newShape.setAttribute( "y2","30%");
		}
		
		newShape.setAttribute('fill', 'lightgrey');
		newShape.setAttribute('stroke', 'grey');
		
		newShape.setAttribute('stroke-width', 8);
		newShape.setAttribute('shape-rendering', 'inherit');
		//newShape.setAttribute('pointer-events', 'inherit');
		newGroup.appendChild(newShape);
		
		// text:shape
		var newTextShape = svgCanvas.createElementNS("http://www.w3.org/2000/svg", "text");
		newTextShape.setAttribute("id","shape");
		newTextShape.setAttribute("x", "-300")
		newTextShape.setAttribute("y", "-300")
		newTextShape.setAttribute("font-size", "16pt")
		newTextShape.setAttribute('fill', 'black');
		newTextShape.setAttribute('visibility', 'hidden');
		newGroup.appendChild(newTextShape);
		// text:elementName
		var newTextElementName = svgCanvas.createElementNS("http://www.w3.org/2000/svg", "text");
		newTextElementName.setAttribute("id","elementName");
		newTextElementName.setAttribute("x", "-300")
		newTextElementName.setAttribute("y", "-300")
		newTextElementName.setAttribute("font-size", "16pt")
		newTextElementName.setAttribute('fill', 'black');
		newTextElementName.setAttribute('visibility', 'hidden');
		newGroup.appendChild(newTextElementName);
		
		// add the group objects to the SVG document
		svgCanvas.documentElement.appendChild(newGroup);
		
		// now that it's been added, let's add the text to the two new text fields
		// get the group
		newGroup = svgCanvas.getElementById(selectListValue);
		newGroup.getElementsByTagName("text")[0].textContent = shape;	// set the shape
		newGroup.getElementsByTagName("text")[1].textContent = selectListText;	// set the elementName
	}
	else {
		// select an element from the list
		$("div#errorSelectElement").append("Please select an element from the list.")
	}
}


function addRequestVariables(str, key, value) {
	if ('undefined' == typeof str || str.length == 0) {
		str += key + "=" + value;
	}
	else {
		str += "&" + key + "=" + value;
	}
	return str;
}



// Save the dashboard
function saveDashboardFunc() {
	// get all the SVG elements and POST/save them
	// clear the label
	$("#saveStatus").empty();
	
	msg = "";
	
	// make sure the dashboard name is entered and valid
	var newDashboardName = $("#newDashboardName");
	if (newDashboardName.val().length > 0) {
		// initialize the XMLHttpRequest object
		var xmlhttp;
		if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp = new XMLHttpRequest();
		}
		else { // code for IE6, IE5
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange=function() {
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				document.getElementById("saveStatus").innerHTML = xmlhttp.responseText;
			}
		}
		// URL to check and save the map/dashboard
		var saveURL = "save_map.php";

		// let's verify if the dashboard already exists or not
		var okToSave = false;
		
		// before we save anything, let's validate the dashboard name
		xmlhttp.open("GET", saveURL + "?checkName=" + newDashboardName.val(), false);
		xmlhttp.send();
		if (xmlhttp.responseText == "File does not exist") {	// check if file exists or not
			// passed
			okToSave = true;
		}
		else if (xmlhttp.responseText == "File already exists") {
			if (newDashboardName.val() == originalDashboardName) {
				// using same name, so just save
				okToSave = true;
			}
			else {
				// this is a new file, but the dashboard name already exists; overwrite?
				// ask the user what they want to do
				var r = confirm("File already exists.\nAre you sure you want to overwrite '" + newDashboardName.val() + "'?");
				if (r == true) {
					// overwrite file
					okToSave = true;
				}
				else {
					// do nothing
					okToSave = false;
					msg = "Please select a different dashboard name.";
				}
			}
		}
		else {
			// other error; invalid file name
			okToSave = false;
		}
		
		
		
		if (okToSave) {
			// since we're editing a current dashboard with the same name, just save over it

			// the POST data string
			var postData = "";
			
			// get the full SVG/XML
			postData = svgCanvas.documentElement;	// get SVG XML output
			
			// remove any <script> tags
			var rem = postData.getElementsByTagName("script");
			for (var i = 0; i < rem.length; i++) {
				postData.removeChild(rem[i]);
			}
			// remove any onmouse* attributes on the <g> tags
			// get all the groups (g tags) in the SVG
			var groups = postData.getElementsByTagName("g");
			// go through each one to confirm if the element has already been added
			for (var i = 0; i < groups.length; i++) {
				var group = groups[i];
				// drop the onmouse* attributes
				if (group.hasAttributeNS(null, "onmouseup")) {
					group.removeAttributeNS(null, "onmouseup");
				}
				if (group.hasAttributeNS(null, "onmousedown")) {
					group.removeAttributeNS(null, "onmousedown");
				}
				if (group.hasAttributeNS(null, "onclick")) {
					group.removeAttributeNS(null, "onclick");
				}
				if (group.hasAttributeNS(null, "onmouseover")) {
					group.removeAttributeNS(null, "onmouseover");
				}
			}

			
			// serialize the SVG into an XML string
			var s = new XMLSerializer();
			postData = s.serializeToString(postData);
			
			// Open a connection to the server
			xmlhttp.open("POST", saveURL + "?d=" + newDashboardName.val(), true);

			// Tell the server you're sending it XML
			xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xmlhttp.setRequestHeader("Content-type", "text/xml");
			// send XML
			xmlhttp.send(postData);
			
			
			// re-add the script tag and onmouse* functions to the SVG
			addScriptTagToSVG();
		}
		else {
			// display msg and do nothing else
			if (msg.length > 0) {
				document.getElementById("saveStatus").innerHTML = msg;
			}
		}
	}
	else {
		document.getElementById("saveStatus").innerHTML = "Please enter a dashboard name.";
	}
	return false;
}
