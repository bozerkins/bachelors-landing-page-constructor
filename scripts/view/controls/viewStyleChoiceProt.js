// model
define([
	'text!template/menu/styles.html',
	'core'
], function (tpl) {
	var Menu = Backbone.View.extend({
		
	  tagName: "aside",

	  className: "menu-controls-selection-element-style",
	  
	  template: _.template(tpl),
	  
	  events: {
		  'click .menu-attributes-form-save' : 'saveAttributes'
	  },
	  
	  initialize: function(options) {
		  this.$el.hide();
	  },

	  render: function() {
		  var model = Backbone.Config.struct.clnTreeObj.mdlIncompleteTreeItemObj;
		  Backbone.Config.view.viewControlsObj.setTitle('Add styles: ' + model.mdlElementObj.get('title'));
		  var styleList = model.clnStyleObj.toJSON_withTitles();
		  console.log(styleList);
		  this.$el.children().remove();
		  this.$el.append(this.template({styleList : styleList}));
		  this.$el.show();
	  },
	  
	  saveAttributes: function() {
		  console.log('hujaaa');
		  return;
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