define([
	'view/viewTreeElementProt',
	'core'
], function(viewTreeElementProt){
	var Controls = Backbone.View.extend({
		
		tagName : 'div',
		className: 'main-application-workarea',
		$target: null,
		views: [],
		initialize: function(){
			var _this = this;
			Backbone.Config.struct.clnTreeObj.each(function(mdlElementObj){
				_this.addElementToTree(mdlElementObj);
			});
		},
		
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
		
		getTargetModel: function() {
			var idString = this.getTarget().attr('id');
			var id = idString ? idString.replace('element_', '') : null;
			var model = id ? Backbone.Config.struct.clnTreeObj.get(id) : null;
			return model ? model : null;
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
			var _this = this;
			var model = Backbone.Config.struct.clnTreeObj.mdlIncompleteTreeItemObj;
			model.isNew() ? model.create(function(){
				_this.addElementToTree(model);
			}) : model.update(function(){
				_this.updateElementToTree(model);
			});
			return this;
		},
		
		addElementToTree: function(modelObject) {
			var viewObject = new viewTreeElementProt({model: modelObject});
			this.views[modelObject.get('id')] = viewObject;
			viewObject.render();
			var parentId = modelObject.get('parent_element_id');
			var parentElement = parentId ? $('#element_' + parentElement) : [];
			parentElement.length ? parentElement.append(viewObject.$el) : this.$el.append(viewObject.$el);
			return this;
		},
		
		updateElementToTree: function(modelObject) {
			var viewObject = this.views[modelObject.get('id')];
			viewObject.render();
		},
		
		removeElementFromTree: function(modelObject){
			
		}
	});
	return Controls;
});