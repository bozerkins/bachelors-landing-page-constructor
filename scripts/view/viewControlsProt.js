// model
define([
	'view/controls/viewElementChoiceProt',
	'view/controls/viewAttributeChoiceProt',
	'view/controls/viewStyleChoiceProt',
	'text!template/menu/container.html',
	'core'
], function (viewElementChoiceProt, viewAttributeChoiceProt, viewStyleChoiceProt, tpl) {
	var View = Backbone.View.extend({
		
		tagName: "div",

		className: "main-application-menues",
		
		template: _.template(tpl),
		
		events: {
			'click .js-menu-button-bind-left' : 'bindLeft',
			'click .js-menu-button-bind-right' : 'bindRight',
			'click .menu-container-close' : 'bindClose'
		},
		
		viewElementChoiceObj: null,
		viewAttributeChoiceObj: null,
		viewStyleChoiceObj: null,
	
		initialize: function() {
			// create by template
			this.$el.append(this.template({}));
			// create children views
			this.viewElementChoiceObj = new viewElementChoiceProt();
			this.$el.children('.menu-controls-selection').append(this.viewElementChoiceObj.$el);
			this.viewAttributeChoiceObj = new viewAttributeChoiceProt();
			this.$el.children('.menu-controls-selection').append(this.viewAttributeChoiceObj.$el);
			this.viewStyleChoiceObj = new viewStyleChoiceProt();
			this.$el.children('.menu-controls-selection').append(this.viewStyleChoiceObj.$el);
			this.bindLeft();
		},
		
		render: function() {
			return this; // returning this for chaining..	
		},
		
		setTitle: function(title, subText) {
			this.$el.find('.menu-container-title').text(title);
			subText && this.$el.find('.menu-container-title-element').text(title);
			return this;
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
	return View;
});