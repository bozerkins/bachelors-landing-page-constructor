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
		templateDelimiter: _.template('<li role="presentation" class="divider"></li>'),
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
		
		renderDelimiter: function() {
			return $(this.templateDelimiter());
		},
		
		displayChange: function() {
			this.model.get('display') ? this.$el.show() : this.$el.hide();
		},
		
		act: function(event) {
			// perform action
			var action = this.model.get('action');
			var clickedElementModel = Backbone.Config.view.viewAreaObj.getTargetModel();
			if (action === 'add') {
				// hide tree if exists
				Backbone.Config.view.viewTreePreviewObj.$el.is(':visible') && Backbone.Config.view.viewTreePreviewObj.$el.hide();
				// perform add
				Backbone.Config.struct.clnTreeObj.mdlIncompleteTreeItemObj = new Backbone.Config.struct.clnTreeObj.model({
					parent_element_id: clickedElementModel ? clickedElementModel.get('id'): null
				});
				Backbone.Config.view.viewControlsObj.viewElementChoiceObj.render();
				Backbone.Config.view.viewControlsObj.$el.show();
				Backbone.Config.view.viewMouseMenuObj.$el.hide();
			}
			if (action === 'change') {
				// hide tree if exists
				Backbone.Config.view.viewTreePreviewObj.$el.is(':visible') && Backbone.Config.view.viewTreePreviewObj.$el.hide();
				// perform change
				Backbone.Config.struct.clnTreeObj.mdlIncompleteTreeItemObj = Backbone.Config.struct.clnTreeObj.get(clickedElementModel.get('id'));
				Backbone.Config.view.viewControlsObj.viewAttributeChoiceObj.render();
				Backbone.Config.view.viewControlsObj.$el.show();
				Backbone.Config.view.viewMouseMenuObj.$el.hide();
			}
			if (action === 'remove') {
				// redraw tree if exists
				Backbone.Config.view.viewTreePreviewObj.$el.is(':visible') && Backbone.Config.view.viewTreePreviewObj.$el.hide();
				// perform add
				Backbone.Config.view.viewMouseMenuObj.$el.hide();
				if (confirm('Are you sure to delete this element and all the elements inside?')) {
					var modelObject = Backbone.Config.struct.clnTreeObj.get(clickedElementModel.get('id'));
					Backbone.Config.view.viewAreaObj.removeElementFromTree(modelObject);
				}
			}
			if (action === 'copy') {
				var prototypeElementObj = Backbone.Config.struct.clnTreeObj.get(clickedElementModel.get('id'));
				Backbone.Config.struct.clnTreeObj.mdlPrototypeTreeItemObj = prototypeElementObj;
				Backbone.Config.view.viewMouseMenuObj.$el.hide();
			}
			if (action === 'paste') {
				// redraw tree if exists
				Backbone.Config.view.viewTreePreviewObj.$el.is(':visible') && Backbone.Config.view.viewTreePreviewObj.$el.hide();
				// perform paste
				var modelObject = Backbone.Config.struct.clnTreeObj.mdlPrototypeTreeItemObj;
				if (modelObject) {
					modelObject.createClone({
						data: {parent_element_id: clickedElementModel ? clickedElementModel.get('id'): null}
					}, function(models){
							_.each(models, function(mdlRecentlyCloned, key){
								Backbone.Config.view.viewAreaObj.addElementToTree(mdlRecentlyCloned);
							});
						});
				}
				Backbone.Config.view.viewMouseMenuObj.$el.hide();
			}
			
			if (action === 'display_tree') {
				Backbone.Config.view.viewTreePreviewObj.drawTree();
				Backbone.Config.view.viewTreePreviewObj.drawSelection(clickedElementModel ? clickedElementModel : null);
				Backbone.Config.view.viewTreePreviewObj.$el.show();
				Backbone.Config.view.viewMouseMenuObj.$el.hide();
			}
			event.preventDefault();
		}
	});
	return Menu;
});