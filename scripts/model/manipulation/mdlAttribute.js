define([
	'core'
], function () {		

	var Model = Backbone.Model.extend({
		
		idAttribute: 'id',
		
		defaults: {
			design_attribute_id: null,
			attribute_value: null
		}
	});
	return Model;
});