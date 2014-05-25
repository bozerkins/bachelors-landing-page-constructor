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
	'model/mdlInitProt',
	'view/viewInitProt',
	'core'
], function (mdlInitProt, viewInitProt, mouse, mdlManipElement, viewControl, viewWorkArea, viewMenu, clnControl) {
	
	// global config
	var conf = Backbone.Config = {};
	// initalize
	var mdlInitObj = new mdlInitProt();
	mdlInitObj.fetch({
		success: function() {
			console.log(mdlInitObj);
			conf.struct = mdlInitObj;
			conf.view = new viewInitProt();
			conf.view.render();
		}
	});
});