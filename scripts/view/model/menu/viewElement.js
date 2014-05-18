// model
define([
	'text!template/menu/elements.html',
	'core'
], function (tpl) {
	var Menu = Backbone.View.extend({
		
	  tagName: "aside",

	  className: "menu-controls-selection-element",
	  
	  template: _.template(tpl),
	  
	  parent: null,
	  
	  initialize: function(options) {
		  this.$el.hide();
		  this.$el.append(this.template({groups : this.collection.toJSON()}));
		  this.parent = options.parent;
	  },

	  render: function() {
		  this.$el.show();
	  }

	});
	return Menu;
});