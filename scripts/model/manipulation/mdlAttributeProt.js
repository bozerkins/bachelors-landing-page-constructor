define([
	'core'
], function () {		

	var Model = Backbone.Model.extend({
		
		url: 'server/index.php/ajax/tree/attributes/',
		
		idAttribute: 'design_attribute_id',
		
		defaults: {
			attribute_value: null
		},
		
		set: function(attributes, options) {
			if (attributes.design_attribute_id) {
				var designModelObj = Backbone.Config.struct.clnAttributeObj.get(attributes.design_attribute_id);
				if (designModelObj) {
					_.each(designModelObj.attributes, function(attribute, key){
						if (key !== designModelObj.idAttribute) {
							attributes[key] = attribute;
						}
					});
				}
			}
			Backbone.Model.prototype.set.apply(this, arguments);
		}
	});
	return Model;
});