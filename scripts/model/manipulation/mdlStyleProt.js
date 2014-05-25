define([
	'core'
], function () {		

	var Model = Backbone.Model.extend({
		
		url: 'server/index.php/ajax/tree/styles/',
		
		idAttribute: 'design_style_id',
		
		defaults: {
			design_style_id: null,
			style_value: null
		}
	});
	return Model;
});