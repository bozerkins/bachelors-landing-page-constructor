var PleaseWait = new function () {
	var containerCalss = 'js-please-wait-container';
	var loadingImageClass = 'js-please-wait-image';
	var loadingImageSrc = 'http://i.stack.imgur.com/FhHRx.gif';
	var loadingTextClass = 'js-please-wait-text';
	
	this.getPleaseWaitContainer = function() {
		var container = $('.' + containerCalss);
		if (container.length > 0) {
			return container;
		}
		container = $('<div style="display: none; width: 100%; height: 100%; position: absolute; top: 0; left: 0;background: rgba(192,192,192,.5);" class="' + containerCalss + '"></div>');
		container.append($('<img style="display: none;position: absolute;top:5px; right: 5px;" class="' + containerCalss + '" src="' + loadingImageSrc + '" alt="Loading...">'));
		container.append($('<div style="display: none;position: absolute; width: 300px; top: 50%; left: 50%;margin-left: -150px;text-align: center;" class="' + loadingTextClass + '"></div>'));
		$('body').append(container);
		return container;
	};
	
	this.show = function(message) {
		this.hide(); // clear everything
		var container = this.getPleaseWaitContainer();
		typeof message !== 'undefined'
				? container.children('.' + loadingTextClass).html(message).show() 
				: container.children('.' + loadingImageClass).show();
		container.show();
	};
	
	this.showErrorMessage = function(message) {
		this.show('<span style="color: red">' + message + '</span>');
	};
	
	this.showSuccessMessage = function(message) {
		this.show('<span style="color: green">' + message + '</span>');
	};
	
	this.hide = function() {
		var container = this.getPleaseWaitContainer();
		container.hide();
		container.children().hide();
	};
		
};