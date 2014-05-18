// model
define([
	'text!template/menu/styles.html',
	'core'
], function (tpl) {
	var Menu = Backbone.View.extend({
		
	  tagName: "aside",

	  className: "menu-controls-selection-element-style",
	  
	  template: _.template(tpl),

	  parent: null,

	  initialize: function(options) {
		  this.$el.hide();
		  this.$el.append(this.template({}));
		  this.parent = options.parent;
	  },

	  render: function() {

	  },
	  
	  run: function() {
		  
	  }

	});
	return Menu;
});