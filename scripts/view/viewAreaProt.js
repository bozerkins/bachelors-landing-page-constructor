define([
	'view/viewTreeElementProt',
	'core'
], function(viewTreeElementProt){
	var Controls = Backbone.View.extend({
		
		tagName : 'div',
		className: 'main-application-workarea',
		$target: null,
		
		append: function() {
			$(document.body).append(this.el);
			return this;
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
		
		isElementInside: function(target){
			return this._isElementInside(target ? target : this.getTarget());
		},
		
		isElementConherent: function(target){
			return this._isElementConherent(target ? target : this.getTarget());
		},
		
		_isElementInside: function(item) {
			return this.$el.find(item).length > 0 && this.$el.filter(item).length === 0;
		},
		
		_isElementConherent: function(item) {
			return this.$el.find(item).length > 0 || this.$el.filter(item).length !== 0;
		},
		
		renderIncompleteElement: function(){
			var model = Backbone.Config.struct.clnTreeObj.mdlIncompleteTreeItemObj;
			model.create(function(){
				new viewTreeElementProt({model: model});
			});
			console.log(model);
		}
	});
	return Controls;
});