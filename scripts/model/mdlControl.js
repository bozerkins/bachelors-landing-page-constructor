define([
	'core'
], function () {
	var Model = Backbone.Model.extend({
		idAttribute: 'id',
		defaults: {
			title : 'unknown',
			forUsual: true,
			forImmortal: false
		}
	});
	return Model;
});