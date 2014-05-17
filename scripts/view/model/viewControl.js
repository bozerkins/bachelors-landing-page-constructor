// model
define([
	'core'
], function () {
	var Menu = Backbone.View.extend({		
		
		tagName: 'li',
		
		template: _.template('<a role="menuitem" tabindex="-1" href="#"><%=title%></a>'),
		
		initialize: function() {

		},

		render: function() {
			this.$el.append(this.template(this.model.toJSON()));
			return this;
		}

	});
	return Menu;
});