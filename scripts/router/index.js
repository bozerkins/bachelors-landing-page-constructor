define([
	'core'
], function () {
	var Router = Backbone.Router.extend({
		routes: {
			'' : 'def'
		},
		def: function()
		{
			console.log('yay');
		},
		initialize: function() 
		{
			Backbone.history.start();
		}
	});
	return Router;
});