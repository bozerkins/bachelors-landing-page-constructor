define([
	'core'
], function () {		

	var Model = Backbone.Model.extend({
		
		url: 'server/index.php/ajax/tree/attributes/',
		
		idAttribute: 'design_attribute_id',
		
		defaults: {
			attribute_value: null
		}
	});
	return Model;
});