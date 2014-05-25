define([
	'view/viewMouseMenuItemProt',
	'library/libMouseObj',
	'text!template/controls/container.html',
	'core'
], function(viewMouseMenuItemProt, libMouseObj, tpl){
	var Controls = Backbone.View.extend({
		
		tagName : 'nav',
		className: 'main-application-controls dropdown',
		template: _.template(tpl),
		
		initialize: function(options) {
			this.$el.children().remove();
			this.$el.append(this.template({}));
			var collection = Backbone.Config.struct.clnMouseMenuObj;
			collection.each(function(mdl){
				var view = new viewMouseMenuItemProt({ model: mdl, parent: this});
				this.$el.children('.dropdown-menu').first().append(view.render().el); // calling render method manually..
			}, this);
			this.bindMouseEvents();
		},
		
		bindMouseEvents: function() {
			var _this = this;
			libMouseObj.addRightClick(function(event){
				Backbone.Config.view.viewAreaObj.setTarget(event.target);
				Backbone.Config.view.viewAreaObj.isElementInside() ? _this.adjust('usual') : _this.adjust('immortal');
				_this.$el.css({left: event.pageX, top: event.pageY});
				_this.$el.children('.dropdown-menu').show();
				_this.$el.show();
				return false;
			});
			libMouseObj.addLeftClick(function(event){
				if (Backbone.Config.view.viewAreaObj.isElementConherent(event.target)) {
					_this.$el.hide();
				}
				return true;
			});
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
			console.log('immortal adjust');
			Backbone.Config.struct.clnMouseMenuObj.each(function(mdl){
				mdl.get('forImmortal') ? mdl.set('display', true) : mdl.set('display', false);
			});
		},
		
		adjustUsual: function() {
			console.log('usual adjust');
			Backbone.Config.struct.clnMouseMenuObj.each(function(mdl){
				mdl.get('forUsual') ? mdl.set('display', true) : mdl.set('display', false);
			});
		},
		
		render: function() {
			
		}
	});
	return Controls;
});