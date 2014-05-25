define([
	'collection/manipulation/clnAttributeProt',
	'collection/manipulation/clnStyleProt',
	'core'
], function (clnAttributeProt, clnStyleProt) {		

	var Model = Backbone.Model.extend({
		
		idAttribute: 'id',
		defaults: {
			design_element_id: null
		},

		mdlElementObj: null,
		clnAttributeObj: null,
		clnStyleObj: null,
		
		initialize: function(options) {
			this.clnAttributeObj = new clnAttributeProt();
			this.clnStyleObj = new clnStyleProt();
		},
		initializeDesignElement: function(){
			this.mdlElementObj = Backbone.Config.struct.clnElementObj.get(this.get('design_element_id'));
			var modelsToAdd = [];
			this.mdlElementObj.clnAttributeObj.each(function(attr, key){
				var modelFound = this.clnAttributeObj.find(attr.get('id'));
				if (!modelFound) {
					modelsToAdd.push(new this.clnAttributeObj.model({
						design_attribute_id: attr.get('id'),
						title: attr.get('title'),
					}));
					return;
				}
				modelFound.set('title', attr.get('title'));
			}, this);
			this.clnAttributeObj.push(modelsToAdd);
			return this;
		}
	});
	return Model;
});