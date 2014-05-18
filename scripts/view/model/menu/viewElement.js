// model
define([
	'text!template/menu/elements.html',
	'core'
], function (tpl) {
	var Menu = Backbone.View.extend({
		
	  tagName: "aside",

	  className: "menu-controls-selection-element",
	  
	  template: _.template(tpl),
	  
	  events: {
		  'click .menu-element-group-item':	'selectElement'
	  },
	  
	  parent: null,
	  
	  initialize: function(options) {
		  this.$el.hide();
		  this.$el.append(this.template({groups : this.collection.toJSON()}));
		  this.parent = options.parent;
	  },

	  render: function() {
		  this.parent.setTitle('add element');
		  this.$el.show();
	  },
	  
	  selectElement: function(event) {
		  var selectedElement = $(event.target);
		  var mdlGroupObject = this.collection.find(function(item){
			  return item.id === selectedElement.data('group_id');
		  });
		  var mdlElementObject = mdlGroupObject.get('elements').find(function(item){
			  return item.id === selectedElement.data('id');
		  });
	  }

	});
	return Menu;
});