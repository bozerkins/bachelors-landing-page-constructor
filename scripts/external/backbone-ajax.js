var ajaxCount = 0;
$(document).ajaxStart(function(){
	if (!ajaxCount) {
		PleaseWait.show();
	}
	ajaxCount++;
});
$(document).ajaxStop(function(){
	ajaxCount--;
	if (!ajaxCount) {
		PleaseWait.hide();
	}
});