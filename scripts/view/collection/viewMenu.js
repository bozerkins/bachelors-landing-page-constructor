// model
define([
	'view/model/menu/viewElement',
	'view/model/menu/viewAttribute',
	'view/model/menu/viewStyle',
	'collection/menu/clnElementGroup',
	'text!template/menu/container.html',
	'core'
], function (viewElement, viewAttribute, viewStyle, clnElementGroup, tpl) {
	var Menu = Backbone.View.extend({
		
		tagName: "div",

		className: "main-application-menues",
		
		template: _.template(tpl),
		
		events: {
			'click .js-menu-button-bind-left' : 'bindLeft',
			'click .js-menu-button-bind-right' : 'bindRight',
			'click .menu-container-close' : 'bindClose'
		},
		
		children: {},
		
		initialize: function() {
			var _this = this;
			// create by template
			this.$el.append(this.template({}));
			var clnElementGroupObject = new clnElementGroup();
			clnElementGroupObject.fetch({
				success: function(){
					_this.children.menuElement = new viewElement({collection: clnElementGroupObject, parent: _this});
					_this.getControlsSelection().append(_this.children.menuElement.$el);
				}
			});
			// create children views
			this.children.menuAttribute = new viewAttribute({parent: this});
			this.children.menuStyle = new viewStyle({parent: this});
			// append children views
			this.getControlsSelection().append(this.children.menuAttribute.$el);
			this.getControlsSelection().append(this.children.menuStyle.$el);
		},
		
		render: function() {
//			_.each(this.children, function(item, key){
//				this.$el.append(item.$el);
//			}, this);
			return this; // returning this for chaining..	
		},
	  
		append: function() {
			$(document.body).append(this.el);
			return this;
		},
		
		getControlsSelection: function() {
			return this.$el.find('.menu-controls-selection');
		},
		
		bindLeft: function() {
			this.$el.removeClass('right').addClass('left');
		},
		
		bindRight: function() {
			this.$el.removeClass('left').addClass('right');
		},
		
		bindClose: function() {
			this.$el.hide();
		}
	});
	return Menu;
});