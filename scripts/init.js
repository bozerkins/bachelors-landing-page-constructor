requirejs.config({
    paths: {
		// libs and extensions
		jqueryLib: './external/jquery-1.10.2',
		backboneLib: './external/backbone-normal',
		backboneSync: './external/backbone-sync',
		backboneAjax: './external/backbone-ajax',
		underscoreLib: './external/underscore-min',
		bootstrapLib: './external/bootstrap-min',
		// plugins
		pleaseWaitPlug: './external/plugins/please-wait'
    },
	shim: {
		'backboneLib' : {
			deps: ['underscoreLib', 'jqueryLib'], // backbone deps
            exports: 'Backbone'
		},
		'bootstrapLib' : {
			deps: ['jqueryLib']
		},
		'pleaseWaitPlug' : {
			deps: ['jqueryLib'],
			exports: 'PleaseWait'
		},
		'backboneSync' : {
			deps: ['backboneLib'] // sync module deps - backbone itself
		},
		'backboneAjax' : {
			deps: ['backboneLib', 'pleaseWaitPlug'] // sync module deps - backbone itself
		},
        'core': {
			deps: ['backboneSync', 'backboneAjax', 'bootstrapLib'] // core to load everything
        }
	},
	urlArgs: "bust=" +  (new Date()).getTime()
});

// Start the main app logic.
requirejs([
	'library/interaction/mouse',
	'view/collection/viewControl',
	'view/viewWorkArea',
	'collection/clnControl',
	'core'
], function (mouse, viewControl, viewWorkArea, clnControl) {
	
	var viewWorkAreaObject = new viewWorkArea();
	viewWorkAreaObject.append();
	
	var clnControlObject = new clnControl;
	var viewControlsObject = null;
	clnControlObject.fetch({
		success: function(){
			viewControlsObject = new viewControl({collection: clnControlObject});
			viewControlsObject.render().append();
			viewControlsObject.toggle();
		}
	});
	
	mouse.addRightClick(function(event){
		viewWorkAreaObject.isElementInside(event.target) ? viewControlsObject.adjust('immortal') : viewControlsObject.adjust('usual');
		
		viewControlsObject.open().position(event.pageX, event.pageY);
		return false;
	});
});