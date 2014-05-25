// model
define([
	'text!template/menu/attributes.html',
	'core'
], function (tpl) {
	var Menu = Backbone.View.extend({
		
	  tagName: "aside",

	  className: "menu-controls-selection-attribute",
	  
	  template: _.template(tpl),

	  events: {
		  'click .menu-attributes-form-save' : 'saveAttributes'
	  },

	  parent: null,

	  initialize: function(options) {
		  this.$el.hide();
		  this.parent = options.parent;
	  },

	  render: function() {
		  var _this = this;
		  var controls = this.parent.parent;
		  controls.menu.setTitle('Add attributes: ' + controls.mdlElement.getDesignModel().get('title'));
		  this.$el.show();
		  if (controls.mdlElement.clnAttribute.length === 0) {
				controls.mdlElement.getDesignModel().fetchAttributes(function(){
					controls.mdlElement.applyAttributesFromDesignModel();
					_this.applyAttributesToTemplate();
				});
				return;
		  }
		  this.applyAttributesToTemplate();
		  
	  },
	  
	  applyAttributesToTemplate: function() {
		  var _this = this;
		  var controls = this.parent.parent;
		  var attrList = controls.mdlElement.clnAttribute.toJSON_withDesign();
		  _this.$el.append(_this.template({attrList: attrList}));
		  return this;
	  },
	  
	  saveAttributes: function() {
		  var controls = this.parent.parent;
		  var items = this.$el.find('.menu-attributes-form-item');
		  var values = [];
		  _.each(items, function(item, key){
			  var $item = $(item);
			  values.push({
				  design_attribute_id: $item.data('id'),
				  attribute_value: $item.val()
			  });
		  });
		  controls.mdlElement.applyAttributes(values);
		  console.log(controls.mdlElement);
	  }

	});
	return Menu;
});