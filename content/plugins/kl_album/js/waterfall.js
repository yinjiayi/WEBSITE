var $id=function(o){ return document.getElementById(o) || o};
var warpWidth=100;
var margin=10;
function sort(el,childTagName){
	var h = [];
	var box = el.getElementsByTagName(childTagName);	
	var minH = box[0].offsetHeight,
	boxW = box[0].offsetWidth+margin;
	n = 1080 / boxW | 0;
	//n = document.documentElement.offsetWidth / boxW | 0;
	el.style.width = n * boxW - margin + "px";
	el.style.visibility = "visible";
	for(var i = 0; i < box.length; i++) {
		boxh = box[i].offsetHeight; 
		if(i < n) {
			h[i] = boxh;
			box[i].style.top = 0 + 'px';
			box[i].style.left = (i * boxW) + 'px';
		} 
		else {
			minH = Array.min(h);
			minKey = getarraykey(h, minH);
			h[minKey] += boxh+margin;
			box[i].style.top = minH+margin + 'px';
			box[i].style.left = (minKey * boxW) + 'px';
		}
		maxH = Array.max(h); 
		maxKey = getarraykey(h, maxH);
		el.style.height = h[maxKey] +"px";
	}
	for(var i = 0; i < box.length; i++) {
		box[i].style.visibility = "visible";
		if(i==box.length-1){
			$('#photolist center').hide()
		}
	}
}
Array.min=function(array)
{
    return Math.min.apply(Math,array);
}
Array.max=function(array)
{
    return Math.max.apply(Math,array);
}
function getarraykey(s, v) {
	for(k in s) {
		if(s[k] == v) {
			return k;
		}
	}
}
window.onload = function() {
	sort($id("photolist"),"div");
};
var re;
window.onresize = function() {
	clearTimeout(re);
	re = setTimeout(resize,100);				
};
function resize(){
	sort($id("photolist"),"div");
};
