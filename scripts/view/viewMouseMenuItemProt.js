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
			var action = this.model.get('action');
			var clickedParrent = Backbone.Config.view.viewAreaObj.getTargetModel();
			if (action === 'add') {
				Backbone.Config.struct.clnTreeObj.mdlIncompleteTreeItemObj = new Backbone.Config.struct.clnTreeObj.model({
					parent_element_id: clickedParrent ? clickedParrent.get('id'): null
				});
				Backbone.Config.view.viewControlsObj.viewElementChoiceObj.render();
				Backbone.Config.view.viewControlsObj.$el.show();
				Backbone.Config.view.viewMouseMenuObj.$el.hide();
			}
			if (action === 'change') {
				Backbone.Config.struct.clnTreeObj.mdlIncompleteTreeItemObj = Backbone.Config.struct.clnTreeObj.get(clickedParrent.get('id'));
				Backbone.Config.view.viewControlsObj.viewAttributeChoiceObj.render();
				Backbone.Config.view.viewControlsObj.$el.show();
				Backbone.Config.view.viewMouseMenuObj.$el.hide();
			}
			if (action === 'remove') {
				Backbone.Config.view.viewMouseMenuObj.$el.hide();
				if (confirm('Are you sure to delete this element and all the elements inside?')) {
					var modelObject = Backbone.Config.struct.clnTreeObj.get(clickedParrent.get('id'));
					Backbone.Config.view.viewAreaObj.removeElementFromTree(modelObject);
				}
			}
			if (action === 'copy') {
				var prototypeElementObj = Backbone.Config.struct.clnTreeObj.get(clickedParrent.get('id'));
				Backbone.Config.struct.clnTreeObj.mdlPrototypeTreeItemObj = prototypeElementObj.clone();
				Backbone.Config.view.viewMouseMenuObj.$el.hide();
			}
			if (action === 'paste') {
				var modelObject = Backbone.Config.struct.clnTreeObj.mdlPrototypeTreeItemObj;
				if (modelObject) {
					modelObject.set('parent_element_id', clickedParrent ? clickedParrent.get('id'): null);
					Backbone.Config.view.viewAreaObj.renderIncompleteElement(modelObject);
				}
			}
			event.preventDefault();
		}
	});
	return Menu;
});