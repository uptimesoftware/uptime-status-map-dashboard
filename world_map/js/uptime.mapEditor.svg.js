
// Global Variables
var curGroup;
var curShapeText;
var curText;
var curShape;
var curPosX;
var curPosY;
var wasDragged = false;

function updateFormFields(group) {
	javascript:window.parent.document.formElementInfo.shapeType.value   = group.getElementsByTagName("text")[0].textContent;
	javascript:window.parent.document.formElementInfo.elementName.value = group.getElementsByTagName("text")[1].textContent;
	javascript:window.parent.document.formElementInfo.elementID.value = group.id;
	javascript:window.parent.document.formElementInfo.RemoveElement.disabled = false;
}

/*
function showToolTip(group) {
	if ( ! wasDragged) {
		alert(group.id);
	}
	wasDragged = false;
}
*/

function pickUp(group)
{
	// mouse clicked down
	curShapeText = group.getElementsByTagName("text")[0].textContent;
	curText      = group.getElementsByTagName("text")[1];
	curShape     = group.getElementsByTagName(curShapeText)[0];	// get the shape object (circle, rect, line)
	
	// set current group (global) to this one
	updateFormFields(group);
	
	// have it call the dragging function
	document.documentElement.setAttribute("onmousemove","startMouseDrag(evt)");
}

function startMouseDrag(evt)
{
	wasDragged = true;
	
	// debug output
	//console.log(group);
	//console.log(curShapeText);
	//console.log(curShape);
	//console.log(curText.textContent);

	// store the center coordinates and radius
	var mouseX = parseInt(evt.clientX)
	var mouseY = parseInt(evt.clientY)

	// get relative location (percentage of screen) so the shape can stick with the picture stretching
	curPosX = mouseX * 100 / document.documentElement.scrollWidth;
	curPosY = mouseY * 100 / document.documentElement.scrollHeight;

	// set new postion for shape
	if (curShapeText == "circle") {
		curShape.setAttributeNS(null,"cx",curPosX + "%");
		curShape.setAttributeNS(null,"cy",curPosY + "%");
	}
	if (curShapeText == "rect") {
		curShape.setAttributeNS(null,"x",curPosX + "%");
		curShape.setAttributeNS(null,"y",curPosY + "%");
	}
	curShape.setAttributeNS(null,"opacity",0.7);

	// set new text
	var textx = mouseX - 50;
	var texty = mouseY - 25;
	curText.setAttributeNS(null,"x",textx.toString());
	curText.setAttributeNS(null,"y",texty.toString());
	curText.setAttributeNS(null,"fill","grey");
	
	// set the form position variables
	javascript:window.parent.document.formElementInfo.positionXRel.value = (curPosX) + "%";
	javascript:window.parent.document.formElementInfo.positionYRel.value = (curPosY) + "%";
}

function drop(obj) {
	document.documentElement.setAttributeNS(null, "onmousemove",null);
	curShape.setAttributeNS(null,"opacity",1);
	// move and hide the text
	curText.setAttributeNS(null,"x","-100");
	curText.setAttributeNS(null,"y","-100");
	curText.setAttributeNS(null,"fill","none");
}

/*
onmouseup="drop(this);"
onmousedown="pickUp(this);"
onclick="updateFormFields(this); showToolTip(this);"
onmouseover="updateFormFields(this)">
*/

/*
<g id="12345" onmouseup="drop(this)" onmousedown="pickUp(this);" onclick="updateFormFields(this);">
<circle id="circle" cx="10%" cy="10%" r="25" opacity="1" fill="green" stroke="darkgreen" stroke-width="7.5px"/>
<text   id="shape" x="30" y="30" font-size="16pt" fill="none">circle</text>
<text   id="elementName" x="220" y="300" font-size="16pt" fill="none">Element Name (hostname)</text>
</g>
*/
