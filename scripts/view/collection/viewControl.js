define([
	'view/model/viewControl',
	'text!template/controls/container.html',
	'core'
], function(viewControlItem, tpl){
	var Controls = Backbone.View.extend({
		
		tagName : 'nav',
		className: 'main-application-controls dropdown',
		template: _.template(tpl),
		
		render: function() {
			console.log('yay! render!');
			this.$el.append(this.template({}));
			this.collection.each(function(mdl){
				var view = new viewControlItem({ model: mdl });
				this.getListElement().append(view.render().el); // calling render method manually..
			}, this);
			return this;
		},

		append: function() {
			$(document.body).append(this.el);
			return this;
		},
		
		getToggleElement: function() {
			return this.$el.children('.dropdown-toggle').first();
		},
		
		getListElement: function() {
			return this.$el.children('.dropdown-menu').first();
		},
		
		toggle: function() {
			this.getToggleElement().click();
			return this;
		},
		
		position: function(x, y) {
			this.$el.css({left: x,top: y});
			return this;
		},
		
		visible: function() {
			return this.$el.hasClass('open');
		},
		
		open: function() {
			if (!this.visible()) {
				this.toggle();
			}
			return this;
		},
		
		close: function() {
			if (this.visible()) {
				this.toggle();
			}
			return this;
		},
		
		isInImmortalObjectList: function(item) {
			if (item === $('body')){
				console.log('body');
			}
		},
		
		adjust: function(type) {
			if (type === 'immortal') {
				this.adjustImmortal();
			}
			if (type === 'usual') {
				this.adjustUsual();
			}
			return this;
		},
		
		adjustImmortal: function() {
			
		},
		
		adjustUsual: function() {
			
		}
	});
	return Controls;
});