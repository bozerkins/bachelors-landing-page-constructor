define([
	'collection/structure/clnAttribute',
	'collection/structure/clnStyle',
	'core'
], function (clnAttribute, clnStyle) {		
	
	var Model = Backbone.Model.extend({
		
		idAttribute: 'id',
		
		clnAttributes: null,
		
		clnStyles: null,
		
		constructor: function() {
			this.clnAttributes = new clnAttribute();
			this.clnStyles = new clnStyle();
			Backbone.Model.apply(this, arguments);
		},
						
		fetchAttributes: function(callback) {
			if (!this.clnAttributes.structureElementId) {
				this.clnAttributes.structureElementId = this.get('id');
			}
			this.clnAttributes.fetchById(callback);
		},
		
		getStyles: function() {
			
		}
		
		
	});
	return Model;
});