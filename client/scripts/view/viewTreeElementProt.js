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
		if (this.model.mdlElementObj.get('title') === 'inline-block') {
			this.$el.css('display', 'inline-block');
		}
	},

	render: function() {
		this.model.clnAttributeObj.each(function(mdlAttributeObj){
			var name = mdlAttributeObj.get('name');
			var value = mdlAttributeObj.get('attribute_value');
			if (name === 'text') {
				this.$el.text(value);
				return;
			}
			if (name === 'label') {
				return;
			}
			this.$el.attr(name, value);
		}, this);
		// reset style values
		this.model.clnStyleObj.each(function(mdlStyleObj){
			this.$el.css(mdlStyleObj.get('name'), '');
		}, this);
		// add current style values
		this.model.clnStyleObj.each(function(mdlStyleObj){
			var name = mdlStyleObj.get('name');
			var value = mdlStyleObj.get('style_value');
			if (name === 'background-repeat-all') {
				if (value === 'yes'){
					this.$el.css('background-repeat', 'repeat');
					return;
				}
				if (value === 'no') {
					this.$el.css('background-repeat', 'no-repeat');
					return;
				}
			}
			if (name === 'background-repeat-x' && value === 'yes') {
				this.$el.css('background-repeat', 'repeat-x');
				return;
			}
			if (name === 'background-repeat-y' && value === 'yes') {
				this.$el.css('background-repeat', 'repeat-y');
				return;
			}
			if (name === 'background-image' && value) {
				value = "url('" + value + "')";
			}
			value && this.$el.css(mdlStyleObj.get('name'), value);
		}, this);
		return this;
	}
	  
	});
	return View;
});