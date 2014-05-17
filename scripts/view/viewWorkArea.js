define([
	'core'
], function(){
	var Controls = Backbone.View.extend({
		
		tagName : 'div',
		className: 'main-application-workarea',
		
		append: function() {
			$(document.body).append(this.el);
			return this;
		},
		
		isElementInside: function(item) {
			return this.$el.find(item).length > 0;
		}
	});
	return Controls;
});