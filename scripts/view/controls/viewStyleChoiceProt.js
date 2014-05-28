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
		  'click .menu-styles-form-save' : 'saveAction',
		  'click .menu-styles-form-back' : 'backAction',
		  'click .menu-styles-form-apply' : 'applyAction',
		  'click .menu-controls-tab-attributes' : 'switchAction'
	  },
	  
	  initialize: function(options) {
		  this.$el.hide();
	  },

	  render: function() {
			Backbone.Config.view.viewControlsObj.hideChildren();
			var model = Backbone.Config.struct.clnTreeObj.mdlIncompleteTreeItemObj;
			var styleList = model.clnStyleObj.toJSON();
			this.$el.children().remove();
			this.$el.append(this.template({styleList : styleList}));
			this.renderDetails();
			this.$el.show();
	  },
	  
	  
	  
	  renderDetails: function() {
		var model = Backbone.Config.struct.clnTreeObj.mdlIncompleteTreeItemObj;
		  if (model.isNew()) {
			  Backbone.Config.view.viewControlsObj.setTitle('Styles: ' + model.mdlElementObj.get('title'));
			  this.$el.find('.menu-styles-nav').hide();
			  this.$el.find('.menu-styles-form-apply').hide();
		  } else {
			  Backbone.Config.view.viewControlsObj.setTitle('Element: ' + model.mdlElementObj.get('title'));
			  this.$el.find('.menu-styles-nav').show();
			  this.$el.find('.menu-styles-form-apply').show();
		  }
	  },
	  
	  saveStyles: function() {
		  var items = this.$el.find('.menu-attributes-form-item');
		  var values = [];
		  var collection = Backbone.Config.struct.clnTreeObj.mdlIncompleteTreeItemObj.clnStyleObj;
		  _.each(items, function(item, key){
			  var $item = $(item);
			  var model = collection.get($item.data('id'));
			  model.set('style_value', $item.val());
		  });
	  },
	  
	  switchToAttributes: function() {
		  this.$el.hide();
		  Backbone.Config.view.viewControlsObj.viewAttributeChoiceObj.render();
	  },
	  
	  saveAction: function() {
		  this.saveStyles();
		  this.$el.hide();
		  Backbone.Config.view.viewControlsObj.$el.hide();
		  Backbone.Config.view.viewAreaObj.renderIncompleteElement();
	  },
	  
	  applyAction: function() {
		  this.saveStyles();
		  Backbone.Config.view.viewAreaObj.updateElementToTree(Backbone.Config.struct.clnTreeObj.mdlIncompleteTreeItemObj);
	  },
	  
	  backAction: function() {
		  this.saveStyles();
		  this.switchToAttributes();
	  },
	  
	  switchAction: function() {
		  this.switchToAttributes();
	  }

	});
	return Menu;
});