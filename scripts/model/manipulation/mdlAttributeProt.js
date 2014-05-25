define([
	'core'
], function () {		

	var Model = Backbone.Model.extend({
		
		idAttribute: 'design_attribute_id',
		
		defaults: {
			attribute_value: null
		}
	});
	return Model;
});