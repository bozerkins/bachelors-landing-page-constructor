define([
	'model/manipulation/mdlAttribute',
	'core'
], function (mdl) {
	var Collection = Backbone.Collection.extend({
		model: mdl,
		
		parent: null,
		
		initialize: function(options) {
			this.parent = options.parent;
		},
	  
		toJSON_withDesign: function() {
			var _this = this;
			var controls = _this.parent.parent;
			var values = this.toJSON();
			_.each(values, function(item, key){
				controls.menu.children.elements;
			});
			return this;
		}
	});
	return Collection;
});