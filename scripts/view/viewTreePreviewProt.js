define([
	'view/viewTreePreviewElementProt',
	'text!template/tree/container.html',
	'core'
], function(viewTreePreviewElementProt, tpl){
	var Controls = Backbone.View.extend({
		
		tagName : 'div',
		
		className: 'main-application-tree-preview',
		
		template: _.template(tpl),
		
		views: {},
		
		events: {
			'click .js-menu-button-bind-left' : 'bindLeft',
			'click .js-menu-button-bind-right' : 'bindRight',
			'click .menu-container-close' : 'bindClose',
			 'click .tree-all-elements a' : 'stopPropogation'
		},
		
		initialize: function() {
			// create by template
			this.$el.append(this.template({}));
			// bind
			this.bindRight();
		},
		
		drawSelection: function(modelObject) {
			if (!modelObject) {
				return this;
			}
			var view = this.views[modelObject.get('id')];
			var model = view.model;
			var parentModel = Backbone.Config.struct.clnTreeObj.get(model.get('parent_element_id'));
			var parentView = parentModel ? this.views[parentModel.get('id')] : null;
			// open parent
			// ..
			parentView && parentView.$el.find('.js-tree-element').first().click();
			this.drawSelection(parentModel);
			return this;
		},
		
		cleanTree: function() {
			_.each(this.views, function(view){
				view.remove();
			});
			return this;
		},
		
		drawTree: function() {
			this.cleanTree();
			this.drawTreeRecursively(0);
			
		},
		
		drawTreeRecursively: function(elementId) {
			var _this = this;
			
			elementId = (elementId || 0).toString();
			var models = Backbone.Config.struct.clnTreeObj.filter(function(model){
				return model.get('parent_element_id') === elementId;
			});
			if (models.length === 0) {
				var view = this.views[elementId];
				var toogle = view.$el.find('.js-tree-element').first();
				toogle.removeClass('accordion-toggle');
				toogle.removeAttr('data-toggle');
				return this;
			}
			_.each(models, function(model, key){
				// get element
				var view = new viewTreePreviewElementProt({model: model});
				_this.views[model.get('id')] = view;
				// get parent element
				var parentElementId = model.get('parent_element_id');
				var parentView = parentElementId ? _this.views[parentElementId] : null;
				// append to parent
				if (parentView) {
					parentView.$el.children('.tree-children').append(view.$el);
				} else {
					_this.$el.find('.tree-all-elements').append(view.$el);
				}
				_this.drawTreeRecursively(model.get('id'));
			});
			return this;
		},
		
		isTreeElement: function(element) {
			return this.$el.find(element).hasClass('js-tree-element');
		},
		
		bindLeft: function() {
			this.$el.removeClass('right').addClass('left');
		},
		
		bindRight: function() {
			this.$el.removeClass('left').addClass('right');
		},
		
		bindClose: function() {
			this.$el.hide();
		},
	  
		stopPropogation: function(event) {
			event.preventDefault();
		}
		
	});
	return Controls;
});