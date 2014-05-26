// model
define([
	'core'
], function () {
	var View = Backbone.View.extend({

	elementIdPrefix: 'element_',

	initialize: function(options) {
		this.setElement($('<'+this.model.mdlElementObj.get('tag')+'>'));
		this.$el.attr('id', this.elementIdPrefix + this.model.get('id'));
	},

	render: function() {
		this.model.clnAttributeObj.each(function(mdlAttributeObj){
			this.$el.attr(mdlAttributeObj.get('name'), mdlAttributeObj.get('attribute_value'));
		}, this);
		this.model.clnStyleObj.each(function(mdlStyleObj){
			this.$el.css(mdlStyleObj.get('name'), mdlStyleObj.get('style_value'));
		}, this);
		return this;
	}
	  
	});
	return View;
});