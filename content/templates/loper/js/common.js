/*
Template Name:Loper
Description:因为简约，所以简单。
Version:1.0
Author:麦特佐罗
Author Url:http://www.zorrorun.com
Sidebar Amount:1
ForEmlog:5.21
*/
$(document).ready(function() {
$('#newlog li a,#randlog li a,#hotlog li a,#record li a,#blogsort li a,#link li a,#newcomment li a').hover(function(){
$(this).stop().animate({marginLeft:"4px"},"fast");
},function(){
$(this).stop().animate({marginLeft:"0px"},"fast");
});
});

$('.searchbarswitch').toggle(function(){$(".searchbar").animate({marginTop:"15px"},"slow")
$(".searchfade").fadeIn("slow");},function(){$(".searchbar").animate({marginTop:"0px"},"slow")
$(".searchfade").fadeOut("slow");});

jQuery(function () {
jQuery('img').hover(
function() {jQuery(this).fadeTo("slow", 0.8);},
function() {jQuery(this).fadeTo("slow", 1);
});
});

function grin(tag) {
	var myField;
	tag = ' ' + tag + ' ';
	if (document.getElementById('comment') && document.getElementById('comment').type == 'textarea') {
		myField = document.getElementById('comment');
	} else {
		return false;
	}
	if (document.selection) {
		myField.focus();
		sel = document.selection.createRange();
		sel.text = tag;
		myField.focus();
	}
	else if (myField.selectionStart || myField.selectionStart == '0') {
		var startPos = myField.selectionStart;
		var endPos = myField.selectionEnd;
		var cursorPos = endPos;
		myField.value = myField.value.substring(0, startPos)
					  + tag
					  + myField.value.substring(endPos, myField.value.length);
		cursorPos += tag.length;
		myField.focus();
		myField.selectionStart = cursorPos;
		myField.selectionEnd = cursorPos;
	}
	else {
		myField.value += tag;
		myField.focus();
	}
}