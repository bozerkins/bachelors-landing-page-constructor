// model
define([
	'view/collection/structure/viewGroup',
	'view/collection/structure/viewAttribute',
	'view/collection/structure/viewStyle',
	'text!template/menu/container.html',
	'core'
], function (viewGroup, viewAttribute, viewStyle, tpl) {
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
		
		parent: null,
		
		initialize: function() {
			// create by template
			this.$el.append(this.template({}));
			// create children views
			this.children.elements = new viewGroup({parent: this});
			this.children.attributes = new viewAttribute({parent: this});
			this.children.styles = new viewStyle({parent: this});
			// append children views
			this.getControlsSelection().append(this.children.elements.$el);
			this.getControlsSelection().append(this.children.attributes.$el);
			this.getControlsSelection().append(this.children.styles.$el);
		},
		
		setParent: function(parentObject) {
			this.parent = parentObject;
		},
		
		render: function() {
			return this; // returning this for chaining..	
		},
		
		setTitle: function(title, subText) {
			this.$el.find('.menu-container-title').text(title);
			subText && this.$el.find('.menu-container-title-element').text(title);
			
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