// model
define([
	'text!template/menu/attributes.html',
	'core'
], function (tpl) {
	var Menu = Backbone.View.extend({
		
	  tagName: "aside",

	  className: "menu-controls-selection-element-attribute",
	  
	  template: _.template(tpl),
	  
	  events: {
		  'click .menu-attributes-form-save' : 'saveAttributes'
	  },
	  
	  initialize: function(options) {
		  this.$el.hide();
	  },

	  render: function() {
		  var model = Backbone.Config.struct.clnTreeObj.mdlIncompleteTreeItemObj;
		  Backbone.Config.view.viewControlsObj.setTitle('Add attributes: ' + model.mdlElementObj.get('title'));
		  var attrList = model.clnAttributeObj.toJSON_withTitles();
		  console.log(attrList);
		  this.$el.children().remove();
		  this.$el.append(this.template({attrList : attrList}));
		  this.$el.show();
	  },
	  
	  saveAttributes: function() {
		  var items = this.$el.find('.menu-attributes-form-item');
		  var values = [];
		  var collection = Backbone.Config.struct.clnTreeObj.mdlIncompleteTreeItemObj.clnAttributeObj;
		  _.each(items, function(item, key){
			  var $item = $(item);
			  var model = collection.get($item.data('id'));
			  model.set('attribute_value', $item.val());
		  });
		  // validation somewhere here
		  // ... 
		  this.$el.hide();
		  Backbone.Config.view.viewControlsObj.viewStyleChoiceObj.render();
	  }

	});
	return Menu;
});