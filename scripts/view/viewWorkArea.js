define([
	'core'
], function(){
	var Controls = Backbone.View.extend({
		
		tagName : 'div',
		className: 'main-application-workarea',
		$target: null,
		parent: null,
		
		append: function() {
			$(document.body).append(this.el);
			return this;
		},
		
		setParent: function(parentObject) {
			this.parent = parentObject;
		},
		
		setTarget: function(item) {
			if (!this._isElementInside(item)) {
				this.$target = this.$el;
				return this;
			}
			this.$target = $(item);
			return this;
		},
		
		getTarget: function() {
			return this.$target;
		},
		
		isElementInside: function(){
			return this._isElementInside(this.getTarget());
		},
		
		_isElementInside: function(item) {
			return this.$el.find(item).length > 0 && this.$el.filter(item).length === 0;
		}
	});
	return Controls;
});