// model
define([
	'view/model/viewMenu',
	'text!template/menu/container.html',
	'core'
], function (MenuItemView, menuContainerTpl) {
	var Menu = Backbone.View.extend({
		
	  tagName: "aside",

	  className: "controls-menu",
	  
	  template: _.template(menuContainerTpl),
	  
	  render: function() {
		this.$el.append(this.template({}));
		this.collection.each(function(menuItemMdl){
			var menuItemView = new MenuItemView({ model: menuItemMdl });
				this.$el.append(menuItemView.render().el); // calling render method manually..
		}, this);
		return this; // returning this for chaining..
	  },
	  
	  append: function() {
		  $(document.body).append(this.el);
		  return this;
	  },
	  
	  setTitle: function(title) {
		  this.$el.find('header.namer').first().text(title);
		  return this;
	  }

	});
	return Menu;
});