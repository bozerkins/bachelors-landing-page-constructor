$(document).ajaxStart(function(){
	PleaseWait.show();
});
$(document).ajaxStop(function(){
	PleaseWait.hide();
});