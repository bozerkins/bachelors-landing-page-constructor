define([
	'view/viewTreeElementProt',
	'core'
], function(viewTreeElementProt){
	var Controls = Backbone.View.extend({
		
		tagName : 'div',
		className: 'main-application-workarea',
		$target: null,
		views: {},
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
		
		getTargetView: function() {
			var model = this.getTargetModel();
			return model ? this.views[model.get('id')] : null;
		},
		
		addSelectedHighlight: function() {
			this.removeSelectedHighlight();
			var view = this.getTargetView();
			if (view) {
				view.$el.addClass('targetElement');
			} else {
				this.$el.addClass('targetElement');
			}
			return this;
		},
		
		removeSelectedHighlight: function() {
			this.$el.find('*').removeClass('targetElement');
			this.$el.removeClass('targetElement');
			return this;
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
		
		renderIncompleteElement: function(model){
			if (!model) {
				model = Backbone.Config.struct.clnTreeObj.mdlIncompleteTreeItemObj;
			}
			var _this = this;
			model.isNew() ? model.create(function(){
				_this.addElementToTree(model);
			}) : model.update(function(){
				_this.updateElementToTree(model);
			});
			return this;
		},
		
		addElementToTree: function(modelObject) {
			var viewObject = new viewTreeElementProt({model: modelObject});
			this.views[parseInt(modelObject.get('id'), 10)] = viewObject;
			viewObject.render();
			var parentId = parseInt(modelObject.get('parent_element_id'), 10);
			var viewParentObject = parentId ? this.views[parentId] : null;
			viewParentObject ? viewParentObject.$el.append(viewObject.$el) : this.$el.append(viewObject.$el);
			return this;
		},
		
		updateElementToTree: function(modelObject) {
			var viewObject = this.views[modelObject.get('id')];
			viewObject.render();
		},
		
		removeElementFromTree: function(modelObject){
			var viewObject = this.views[parseInt(modelObject.get('id'), 10)];
			if (!viewObject) {
				return this;
			}
			// get elements with id
			var childElementList = viewObject.$el.find('*').filter(function(){
				return $(this).attr('id') ? true : false;
			});
			// get id list
			var childElementIdList = [];
			childElementList.each(function(){
				childElementIdList.push(parseInt($(this).attr('id').replace('element_', ''), 10));
			});
			// remove view object list
			_.each(childElementIdList, function(id, key) {
				var viewObject = this.views[id];
				viewObject.remove(); delete viewObject; delete this.views[id];
				Backbone.Config.struct.clnTreeObj.get(id).destroyExtended();
			}, this);
			// remove current view object
			viewObject.remove(); delete viewObject; delete this.views[parseInt(modelObject.get('id'), 10)];
			modelObject.destroyExtended();
			// end
			return this;
		}
	});
	return Controls;
});