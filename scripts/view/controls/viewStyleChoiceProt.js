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
		  'click .menu-controls-tab-attributes' : 'switchAction',
		  'click #accordion a' : 'stopPropogation'
	  },
	  
	  initialize: function(options) {
		  this.$el.hide();
	  },

	  render: function() {
			Backbone.Config.view.viewControlsObj.hideChildren();
			var model = Backbone.Config.struct.clnTreeObj.mdlIncompleteTreeItemObj;
			var styleList = model.clnStyleObj.toJSON();
			var items = Backbone.Config.struct.clnStyleGroupObj.toJSON();
			_.each(items, function(item, key){
				item.styleList = model.clnStyleObj.filter(function(styleItem){
					return styleItem.get('style_group_id') === item.id;
				});
				item.styleList = _.map(item.styleList, function(styleItem, key){
					return styleItem.toJSON();
				});
				item.error = _.filter(item.styleList, function(styleItem, key){
					return styleItem.error;
				}).length > 0;
			});
			items = _.filter(items, function(item){
				return item.styleList.length > 0;
			});
			this.$el.children().remove();
			this.$el.append(this.template({items: items}));
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
	  
	  saveStyles: function(callback) {
		  var items = this.$el.find('.menu-attributes-form-item');
		  var values = [];
		  var collection = Backbone.Config.struct.clnTreeObj.mdlIncompleteTreeItemObj.clnStyleObj;
		  _.each(items, function(item, key){
			  var $item = $(item);
			  var model = collection.get($item.data('id'));
			  model.set('style_value', $item.val());
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
	  
	  switchToAttributes: function() {
		  this.$el.hide();
		  Backbone.Config.view.viewControlsObj.viewAttributeChoiceObj.render();
	  },
	  
	  saveAction: function() {
		  var _this = this;
		   this.saveStyles(function(){
				_this.$el.hide();
				Backbone.Config.view.viewControlsObj.$el.hide();
				Backbone.Config.view.viewAreaObj.renderIncompleteElement();
		  });
	  },
	  
	  applyAction: function() {
		  var _this = this;
		  this.saveStyles(function(){
			  Backbone.Config.view.viewAreaObj.updateElementToTree(Backbone.Config.struct.clnTreeObj.mdlIncompleteTreeItemObj);
			_this.render();
		  });
	  },
	  
	  backAction: function() {
		  var _this = this;
		   this.saveStyles(function(){
			_this.switchToAttributes();
		  });
	  },
	  
	  switchAction: function() {
		  this.switchToAttributes();
	  },
	  
	  stopPropogation: function(event) {
		  event.preventDefault();
	  }

	});
	return Menu;
});