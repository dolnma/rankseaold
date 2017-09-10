/* =========================================================
 * bootstrap-slider.js v2.0.0
 * http://www.eyecon.ro/bootstrap-slider
 * =========================================================
 * Copyright 2012 Stefan Petre
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * ========================================================= */





var sl1,chgap,dotButton;
var RGBChange,r,g,b,alphaSlider;
var chcolor;
var chthickness, chothickness;
var chdynsplitdist;

var c;
var ctx;
var width;
var height;
var xMid;
var yMid;
var drawDot = false;
var outString;
var mX;
var mY;
var lastDraw = 0;

var drawCrosshair = function(){
	var now = Date.now();
	if (lastDraw + 10 > now){
		return;
	} else if (thickness * sizeVal > 75 && lastDraw + 50 > now){
		return;
	}
	lastDraw = now;
	ctx.clearRect(0,0,width,height);
	
	var thickness = Math.round(chthickness.getValue()*2*1.095);
	var gapVal = chgap.getValue() + 4;
	var sizeVal = Math.round(sl1.getValue()*2*1.095);
	var choThick = chothickness.getValue();
	var useAlpha = alphaSlider.getValue()/255;
	xMid = mX;
	yMid = mY;
	xMid -= Math.round(thickness/2);
	yMid -= Math.round(thickness/2);
	
	$("#rLabel").val(parseFloat(r.getValue()));
	$("#bLabel").val(b.getValue());
	$("#gLabel").val(g.getValue());
	$("#alphaLabel").val(alphaSlider.getValue());
	$("#chsizeLabel").val(sl1.getValue());
	$("#chgapLabel").val(chgap.getValue());
	$("#chthicknessLabel").val(chthickness.getValue());
	$("#chothicknessLabel").val(chothickness.getValue());
	
	
	outString = 
	"cl_crosshaircolor 5"+
	";cl_crosshaircolor_r "+r.getValue()+
	";cl_crosshaircolor_b "+b.getValue()+
	";cl_crosshaircolor_g "+g.getValue()+
	";cl_crosshairsize " +sl1.getValue()+
	";<br>"+
	"cl_crosshairgap " +chgap.getValue()+
	";cl_crosshairthickness "+chthickness.getValue();

	outString += ";cl_crosshairusealpha 1";
	outString += ";cl_crosshairalpha "+alphaSlider.getValue();
	outString += ";<br>";
	
	if (chothickness.getValue() == 0){
		outString += "cl_crosshair_drawoutline 0";
	} else {
		outString += "cl_crosshair_drawoutline 1";
		outString += ";cl_crosshair_outlinethickness " + chothickness.getValue();
	}
	if (drawDot){
		outString += ";cl_crosshairdot 1";
	} else {
		outString += ";cl_crosshairdot 0";
	}
	outString += ";cl_crosshairstyle 4";
	outString += "<br><br>"+
	
	"<a href = '?r=" + r.getValue() +
	"&g=" + g.getValue() +
	"&b=" + b.getValue() +
	"&alpha=" + alphaSlider.getValue() +
	"&gap=" + chgap.getValue() +
	"&size=" + sl1.getValue() +
	"&thick=" + chthickness.getValue() +
	"&othick=" + chothickness.getValue() +
	"&dot=" + (drawDot ? 1:0) +
	"'>Link this crosshair</a>";
	$("#console").html(outString);


	var dotTop2 = yMid;
	var dotLeft2 = xMid;
	var topTop = dotTop2 - gapVal - sizeVal;
	var topLeft = dotLeft2;
	var leftTop = dotTop2;
	var leftLeft = dotLeft2 - gapVal - sizeVal;
	var rightTop = dotTop2;
	var rightLeft = dotLeft2 + thickness + gapVal;
	var botTop = dotTop2 + thickness + gapVal;
	var botLeft = dotLeft2;

	
	

	$("#crosshairFrame").css({opacity: useAlpha});

	chcolor = 'rgb('+r.getValue()+','+g.getValue()+','+b.getValue()+')';
	ctx.fillStyle=chcolor;
	
	drawRect(leftLeft,leftTop,sizeVal,thickness);
	drawHollowRect(leftLeft,leftTop,sizeVal,thickness,choThick);
	
	drawRect(rightLeft,rightTop,sizeVal,thickness);
	drawHollowRect(rightLeft,rightTop,sizeVal,thickness,choThick);
	
	
	drawRect(topLeft,topTop,thickness,sizeVal);
	drawHollowRect(topLeft,topTop,thickness,sizeVal,choThick);
	
	drawRect(botLeft,botTop,thickness,sizeVal);//bottom
	drawHollowRect(botLeft,botTop,thickness,sizeVal,choThick);

	
	if (drawDot){
		drawRect(dotLeft2,dotTop2,thickness,thickness);
		drawHollowRect(dotLeft2,dotTop2,thickness,thickness,choThick);
	}
	
}
//$(window).load(function() { 	

function debounce(func, wait, immediate) {
	var timeout;
	return function() {
		var context = this, args = arguments;
		var later = function() {
			timeout = null;
			if (!immediate) func.apply(context, args);
		};
		var callNow = immediate && !timeout;
		clearTimeout(timeout);
		timeout = setTimeout(later, wait);
		if (callNow) func.apply(context, args);
	};
};
var myEfficientFn = debounce(function() {
	rdy();
}, 250);
window.addEventListener('resize', myEfficientFn);


function rdy(){
	//alert("test2");
c = document.getElementById("crosshairFrame");
if (!c){
	return;
}
//alert(c.width + "," + c.height);

	c.setAttribute('width', $("#chbg").width());
	c.setAttribute('height', $("#chbg").height());
//alert($("#chbg").height());
//alert(c.width + "," + c.height);
ctx = c.getContext("2d");
width = c.width;
height = c.height;
xMid = width/2;
yMid  = height/2;
mX = xMid;
mY = yMid;
	var get = [];
	location.search.replace('?', '').split('&').forEach(function (val) {
		split = val.split("=", 2);
		get[split[0]] = split[1];
		if (split[1] == parseInt(split[1])){
			split[1] = parseInt(split[1]);
		}
	});

	sl1 = $('#sl1').slider({step:0.5}).on('slideStop', drawCrosshair).data('slider');
	alphaSlider = $('#Alpha').slider().on('slideStop', drawCrosshair).data('slider');
	r = $('#R').slider().on('slideStop', drawCrosshair).data('slider');
	g = $('#G').slider().on('slideStop', drawCrosshair).data('slider');
	b = $('#B').slider().on('slideStop', drawCrosshair).data('slider');		
	chgap = $('#chgap').slider().on('slideStop', drawCrosshair).data('slider');
	chthickness = $('#chthickness').slider({step:0.5}).on('slideStop', drawCrosshair).data('slider');
	chothickness = $('#chothickness').slider().on('slideStop', drawCrosshair).data('slider');
	//chdynsplitdist = $('#chdynsplitdist').slider().on('slide', drawCrosshair).data('slider');
	
	$('#sl1').slider({step:0.5}).on('slide', drawCrosshair).data('slider');
	$('#Alpha').slider().on('slide', drawCrosshair).data('slider');
	$('#R').slider().on('slide', drawCrosshair).data('slider');
	$('#G').slider().on('slide', drawCrosshair).data('slider');
	$('#B').slider().on('slide', drawCrosshair).data('slider');		
	$('#chgap').slider().on('slide', drawCrosshair).data('slider');
	$('#chthickness').slider({step:0.5}).on('slide', drawCrosshair).data('slider');
	$('#chothickness').slider().on('slide', drawCrosshair).data('slider');

	$("#rLabel").on('change',function(){r.setValue($("#rLabel").val());drawCrosshair()});
	$("#bLabel").on('change',function(){b.setValue($("#bLabel").val());drawCrosshair()});
	$("#gLabel").on('change',function(){g.setValue($("#gLabel").val());drawCrosshair()});
	$("#alphaLabel").on('change',function(){alphaSlider.setValue($("#alphaLabel").val());drawCrosshair()});
	$("#chsizeLabel").on('change',function(){sl1.setValue($("#chsizeLabel").val());drawCrosshair()});
	$("#chgapLabel").on('change',function(){chgap.setValue($("#chgapLabel").val());drawCrosshair()});
	$("#chthicknessLabel").on('change',function(){chthickness.setValue($("#chthicknessLabel").val());drawCrosshair()});
	$("#chothicknessLabel").on('change',function(){chothickness.setValue($("#chothicknessLabel").val());drawCrosshair()});
	//$("#chdynsplitdistLabel").on('change',function(){chdynsplitdist.setValue($("#chdynsplitdistLabel").val())});
	
	$("#crosshairFrame").click(function(e){
		var div = $("#crosshairFrame");
		
		mX = Math.round(e.pageX - div.offset().left);
		mY = Math.round(e.pageY - div.offset().top);
		drawCrosshair();
		
	});
	$("#crosshairFrame").dblclick(function() {
		var src = $("#chbg").attr('src').split('/').pop();
		if (src == '1.jpg'){
			$("#chbg").attr('src','/assets/crosshair/2.jpg');
		} else if (src == '2.jpg'){
			$("#chbg").attr('src','/assets/crosshair/3.jpg');
		} else if (src == '3.jpg'){
			$("#chbg").attr('src','/assets/crosshair/4.jpg');
		} else if (src == '4.jpg'){
			$("#chbg").attr('src','/assets/crosshair/5.jpg');
		} else if (src == '5.jpg'){
			$("#chbg").attr('src','/assets/crosshair/6.jpg');
		} else if (src == '6.jpg'){
			$("#chbg").attr('src','/assets/crosshair/1.jpg');
		}
	});				
	
	dotButton = $("#dotButton").click(function() {
		$( this ).toggleClass("btn-info btn-success");
		drawDot = !drawDot;
		drawCrosshair();
	});

	animateButton = $("#animateButton").click(function() {
		dynamicize();
	});

	var rS = 255;
	var gS = 0;
	var bS = 255;
	var aS = 255;
	var sS = 4;
	var gapS = 0;
	var thickS = 1;
	var othickS = 0;
	if ("r" in get){
		rS = get["r"];
	}
	if ("g" in get){
		gS = get["g"];
	}
	if ("b" in get){
		bS = get["b"];
	}
	if ("alpha" in get){
		aS = get["alpha"];
	}
	if ("size" in get){
		sS = get["size"];
	}
	if ("gap" in get){
		gapS = get["gap"];
	}
	if ("thick" in get){
		thickS = get["thick"];
	}
	if ("othick" in get){
		othickS = get["othick"];
	}
	if ("dot" in get){
		if (get["dot"] == 1){
			dotButton.click();
		}
	}


	r.setValue(parseInt(rS));
	g.setValue(parseInt(gS));
	b.setValue(parseInt(bS));
	alphaSlider.setValue(parseInt(aS));
	sl1.setValue(parseFloat(sS));
	chgap.setValue(parseFloat(gapS));
	chthickness.setValue(parseFloat(thickS));
	chothickness.setValue(parseFloat(othickS));
	drawCrosshair();
}
/*$( window ).load(function(){
	rdy();
})
*/
function notrdy(){
	if ( $("#chbg").height() < 50){
		setTimeout(function(){notrdy();}, 250);
	} else {
		rdy();
	}

}
$( document ).ready(function() {
	notrdy();
});
function drawHollowRect(x0,y0,w,h,thickness){
	ctx.fillStyle = 'black';
	drawRect(x0-thickness,y0-thickness,w+thickness*2,thickness);//top
	drawRect(x0-thickness,y0-thickness,thickness,h+thickness*2);//left
	drawRect(x0-thickness,y0+h,w+thickness*2,thickness);//bot
	drawRect(x0+w,y0-thickness,thickness,h+thickness*2);//right
	ctx.fillStyle = chcolor;
}
function drawRect(x0,y0,w,h){
	if (w== 0 || h ==0){
		return;
	}
	w = Math.round(w);
	h = Math.round(h);
	ctx.fillRect(x0,y0,w,h)
}


function plotLine(x0,y0,x1,y1)
{
	for (;;){
		ctx.fillRect(x0,y0,1,1);
		x0++;
		if (x0 > x1) break;
	}
}
function setPixel(x, y) {
	ctx.fillRect(x,y,1,1);
}
;
