// model
define([
	'core'
], function () {
	var View = Backbone.View.extend({
		
	  initialize: function(options) {
			this.setElement($('<'+this.model.mdlElementObj.get('tag')+'>'));
			this.model.clnAttributeObj.each(function(attr){
				this.$el.attr(attr.name, attr.attribute_value);
			}, this);
			this.model.clnAttributeObj.each(function(attr){
				this.$el.attr(attr.name, attr.style_value);
			}, this);
			$(document).append(this.el);
	  }
	  
	});
	return View;
});