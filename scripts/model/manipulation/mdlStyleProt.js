define([
	'core'
], function () {		

	var Model = Backbone.Model.extend({
		
		idAttribute: 'id',
		
		defaults: {
			design_style_id: null,
			style_value: null
		}
	});
	return Model;
});