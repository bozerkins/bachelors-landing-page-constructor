// model
define([
	'text!template/menu/attributes.html',
	'core'
], function (tpl) {
	var Menu = Backbone.View.extend({
		
	  tagName: "aside",

	  className: "menu-controls-selection-attribute",
	  
	  template: _.template(tpl),

	  parent: null,

	  initialize: function(options) {
		  this.$el.hide();
		  this.$el.append(this.template({}));
		  this.parent = options.parent;
	  },

	  render: function() {
		  var controls = this.parent.parent;
		  var model = controls.mdlElement.getElementModel();
	  },
	  
	  run: function() {
		  
	  }

	});
	return Menu;
});