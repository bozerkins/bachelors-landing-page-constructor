define([
	'core'
], function () {		

	var Model = Backbone.Model.extend({
		
		url: '../server/index.php/ajax/tree/styles/',
		
		idAttribute: 'design_style_id',
		
		defaults: {
			design_style_id: null,
			style_value: null,
			error: null
		},
		
		set: function(attributes, options) {
			if (attributes.design_style_id) {
				var designModelObj = Backbone.Config.struct.clnStyleObj.get(attributes.design_style_id);
				if (designModelObj) {
					_.each(designModelObj.attributes, function(style, key){
						if (key !== designModelObj.idAttribute) {
							attributes[key] = style;
						}
					});
				}
			}
			Backbone.Model.prototype.set.apply(this, arguments);
		}
	});
	return Model;
});