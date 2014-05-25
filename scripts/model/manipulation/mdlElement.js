define([
	'collection/manipulation/clnAttribute',
	'collection/manipulation/clnStyle',
	'core'
], function (clnAttribute, clnStyle) {		

	var Model = Backbone.Model.extend({
		
		idAttribute: 'id',
		
		defaults: {
			design_element_id: null
		},
		
		initialize: function(options) {
			this.clnAttribute = new clnAttribute({parent: this});
			this.clnStyle = new clnStyle({parent: this});
		},
		
		mdlDesign : null,
		
		clnAttribute : null,
		
		clnStyle: null,
		
		applyAttributes: function(attributeList) {
			var _this = this;
			_.each(attributeList, function(item, key){
				_this.clnAttribute.add(item);
			});
			return this;
		},
		
		applyAttributesFromDesignModel: function() {
			var _this = this;
			var designModel = this.getDesignModel();
			var values = [];
			_.each(designModel.clnAttributes.toJSON(), function(item, key){
				values.push({
					design_attribute_id: item.id,
					attribute_value: null
				});
			});
			this.applyAttributes(values);
			return this;
		},
		
		setDesignModel: function(mdl) {
			this.mdlDesign = mdl;
			this.set('design_element_id', mdl.get('id'));
			return this;
		},
		
		getDesignModel: function() {
			return this.mdlDesign;
		}
	});
	return Model;
});