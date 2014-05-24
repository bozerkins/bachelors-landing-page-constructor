// model
define([
	'collection/structure/clnGroup',
	'text!template/menu/elements.html',
	'core'
], function (clnGroup, tpl) {
	
	var Menu = Backbone.View.extend({
		
	  tagName: "aside",

	  className: "menu-controls-selection-element",
	  
	  template: _.template(tpl),
	  
	  events: {
		  'click .menu-element-group-item':	'selectElement'
	  },
	  
	  parent: null,
	  
	  initialize: function(options) {
		  var _this = this;
		  _this.collection = new clnGroup;
		  _this.collection.fetch({
			  success: function() {
				_this.$el.hide();
				_this.$el.append(_this.template({groups : _this.collection.toJSON_withElements()}));
			  }
		  });
		_this.parent = options.parent;
	  },

	  render: function() {
		  this.parent.setTitle('add element');
		  this.$el.show();
	  },
	  
	  selectElement: function(event) {
		  // get current model
		  var selectedElement = $(event.target);
		  var mdlGroupObject = this.collection.get(selectedElement.data('group_id'));
		  var mdlElementObject = mdlGroupObject.elements.get(selectedElement.data('id'));
		  
		  // proceed to the next step
		  var controls = this.parent.parent;
		  controls.mdlElement.setElementModel(mdlElementObject).setElementParentModel(null);
		  controls.menu.children.attributes.render();
	  }

	});
	return Menu;
});