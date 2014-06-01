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
		  'click .menu-attributes-form-save' : 'saveAction',
		  'click .menu-attributes-form-next' : 'nextAction',
		  'click .menu-attributes-form-apply' : 'applyAction',
		  'click .menu-controls-tab-styles' : 'switchAction'
	  },
	  
	  initialize: function(options) {
		  this.$el.hide();
	  },

	  render: function() {
			Backbone.Config.view.viewControlsObj.hideChildren();
			var model = Backbone.Config.struct.clnTreeObj.mdlIncompleteTreeItemObj;
			var attrList = model.clnAttributeObj.toJSON();
			this.$el.children().remove();
			this.$el.append(this.template({attrList : attrList}));
			this.renderDetails();
			this.$el.show();
	  },
	  
	  renderDetails: function() {
		var model = Backbone.Config.struct.clnTreeObj.mdlIncompleteTreeItemObj;
		  if (model.isNew()) {
			  Backbone.Config.view.viewControlsObj.setTitle('Attributes: ' + model.mdlElementObj.get('title'));
			  this.$el.find('.menu-attributes-nav').hide();
			  this.$el.find('.menu-attributes-form-apply, .menu-attributes-form-save').hide();
		  } else {
			  Backbone.Config.view.viewControlsObj.setTitle('Element: ' + model.mdlElementObj.get('title'));
			  this.$el.find('.menu-attributes-nav').show();
			  this.$el.find('.menu-attributes-form-apply, .menu-attributes-form-save').show();
		  }
	  },
	  
	  saveAttributes: function(callback) {
		  var items = this.$el.find('.menu-attributes-form-item');
		  var values = [];
		  var collection = Backbone.Config.struct.clnTreeObj.mdlIncompleteTreeItemObj.clnAttributeObj;
		  _.each(items, function(item, key){
			  var $item = $(item);
			  var model = collection.get($item.data('id'));
			  model.set('attribute_value', $item.val());
		  });
		  var _this = this;
		  collection.validateCollection(function(valid){
			  if (valid) {
				  _this.render();
				  return;
			  }
			  callback();
		  });
	  },
	  
	  switchToStyles: function() {
		  this.$el.hide();
		  Backbone.Config.view.viewControlsObj.viewStyleChoiceObj.render();
	  },
	  
	  saveAction: function() {
		  var _this = this;
		  this.saveAttributes(function(){
			_this.$el.hide();
			Backbone.Config.view.viewControlsObj.$el.hide();
			Backbone.Config.view.viewAreaObj.renderIncompleteElement();  
		  });
	  },
	  
	  applyAction: function() {
		  var _this = this;
		  this.saveAttributes(function(){
			Backbone.Config.view.viewAreaObj.updateElementToTree(Backbone.Config.struct.clnTreeObj.mdlIncompleteTreeItemObj);
			_this.render();
		  });
	  },
	  
	  nextAction: function() {
		  var _this = this;
		  this.saveAttributes(function(){
			  _this.switchToStyles();
		  });
	  },
	  
	  switchAction: function() {
		  this.switchToStyles();
	  }

	});
	return Menu;
});