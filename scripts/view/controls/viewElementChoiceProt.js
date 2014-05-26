// model
define([
	'text!template/menu/elements.html',
	'core'
], function (tpl) {
	
	var Menu = Backbone.View.extend({
		
	  tagName: "aside",

	  className: "menu-controls-selection-element",
	  
	  template: _.template(tpl),
	  
	  events: {
		  'click .menu-element-group-item':	'selectElement'
	  },
	  
	  initialize: function(options) {
			this.$el.append(this.template({groups : Backbone.Config.struct.clnGroupObj.toJSON_withElements()}));
	  },

		render: function() {
			Backbone.Config.view.viewControlsObj.hideChildren();
			Backbone.Config.view.viewControlsObj.setTitle('add element');
			this.$el.show();
		},
	  
	  selectElement: function(event) {
		  Backbone.Config.struct.clnTreeObj.mdlIncompleteTreeItemObj
				.set({'design_element_id': $(event.target).data('id')})
				.initializeDesignElement();
		  this.$el.hide();
		  Backbone.Config.view.viewControlsObj.viewAttributeChoiceObj.render();
	  }

	});
	return Menu;
});