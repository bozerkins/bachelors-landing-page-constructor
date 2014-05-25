/**
 * 
 * in this mode acting is defined
 * everything that is clicked - goes from here to wherever
 * (Add, Select, Change, Delete)
 */
define([
	'core'
], function () {
	var Menu = Backbone.View.extend({		
		
		tagName: 'li',
		
		template: _.template('<a role="menuitem" tabindex="-1" href="#"><%=title%></a>'),
		
		events: {
			'click' : 'act'
		},
		
		parent: null,
		
		initialize: function(options) {
			this.parent = options.parent || null;
			this.listenTo(this.model, 'change:display', this.displayChange);
		},

		render: function() {
			this.$el.append(this.template(this.model.toJSON()));
			return this;
		},
		
		displayChange: function() {
			this.model.get('display') ? this.$el.show() : this.$el.hide();
		},
		
		act: function(event) {
			console.log('acting...');
			var action = this.model.get('action');
			if (action === 'add') {
				console.log('action: add');
				Backbone.Config.view.viewControlsObj.viewElementChoiceObj.render();
				Backbone.Config.view.viewControlsObj.$el.show();
				Backbone.Config.view.viewMouseMenuObj.$el.hide();
			}
			event.preventDefault();
		}
	});
	return Menu;
});