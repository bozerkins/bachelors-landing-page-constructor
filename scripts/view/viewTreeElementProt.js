// model
define([
	'core'
], function () {
	var View = Backbone.View.extend({

	elementIdPrefix: 'element_',

	initialize: function(options) {
		this.setElement($('<'+this.model.mdlElementObj.get('tag')+'>'));
		this.$el.attr('id', this.elementIdPrefix + this.model.get('id'));
		this.$el.css('position', 'relative');
	},

	render: function() {
		this.model.clnAttributeObj.each(function(mdlAttributeObj){
			this.$el.attr(mdlAttributeObj.get('name'), mdlAttributeObj.get('attribute_value'));
		}, this);
		// reset style values
		this.model.clnStyleObj.each(function(mdlStyleObj){
			this.$el.css(mdlStyleObj.get('name'), '');
		}, this);
		// add current style values
		this.model.clnStyleObj.each(function(mdlStyleObj){
			var styleValue = mdlStyleObj.get('style_value');
			styleValue && this.$el.css(mdlStyleObj.get('name'), styleValue);
		}, this);
		return this;
	}
	  
	});
	return View;
});