function o($el){
	$el.addClass('o');
}
function c($el){
	$el.removeClass('o');
}
function oc($el){
	$el.hasClass('o') ? $el.removeClass('o') : $el.addClass('o');
}