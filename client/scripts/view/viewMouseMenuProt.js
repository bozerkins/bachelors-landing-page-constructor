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
		delimiterItemHtml: 'aaa',
		
		initialize: function(options) {
			this.$el.children().remove();
			this.$el.append(this.template({}));
			var collection = Backbone.Config.struct.clnMouseMenuObj;
			collection.each(function(mdl){
				var view = new viewMouseMenuItemProt({ model: mdl, parent: this});
				this.$el.children('.dropdown-menu').first().append(view.render().el); // calling render method manually..
				parseInt(mdl.get('delimiter'), 10) && this.$el.children('.dropdown-menu').first().append(view.renderDelimiter());
			}, this);
			this.bindMouseEvents();
		},
		
		bindMouseEvents: function() {
			var _this = this;
			libMouseObj.addRightClick(function(event){
				// when controls visible - close the controls first
				if (Backbone.Config.view.viewControlsObj.$el.is(':visible')) {
					Backbone.Config.view.viewControlsObj.$el.hide();
					return false;
				}
				
				var eventTarget = event.target;
				var eventX = event.pageX;
				var eventY = event.pageY;
				var adjustTree = false;
				
				// when clicked on tree element - emulate click on it
				// ..
				if (Backbone.Config.view.viewTreePreviewObj.isTreeElement(eventTarget)) {
					var element = $(eventTarget);
//					var viewTreeElementObj = Backbone.Config.view.viewTreePreviewObj.views[element.data('id')];
					var viewAreaElementObj = Backbone.Config.view.viewAreaObj.views[element.data('id')];
					eventTarget = viewAreaElementObj.el;
					adjustTree = true;
				}
				// when not clicked on conherent element - disable click
				if (!Backbone.Config.view.viewAreaObj.isElementConherent(eventTarget)) {
					return false;
				}
				
				Backbone.Config.view.viewAreaObj.setTarget(eventTarget);
				if (adjustTree) {
					_this.adjust('tree');
				} else {
					Backbone.Config.view.viewAreaObj.isElementInside() ? _this.adjust('usual') : _this.adjust('immortal');
				}
				_this.$el.css({left: eventX, top: eventY});
				_this.$el.children('.dropdown-menu').show();
				_this.$el.show();
				Backbone.Config.view.viewAreaObj.addSelectedHighlight();
				return false;
			});
			libMouseObj.addLeftClick(function(event){
				Backbone.Config.view.viewAreaObj.removeSelectedHighlight();
				if (Backbone.Config.view.viewAreaObj.isElementConherent(event.target)) {
					_this.$el.hide();
					return true;
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
			if (type === 'tree') {
				this.adjustTree();
			}
			return this;
		},
		
		adjustImmortal: function() {
			Backbone.Config.struct.clnMouseMenuObj.each(function(mdl){
				mdl.get('forImmortal') ? mdl.set('display', true) : mdl.set('display', false);
			});
			this.$el.find('.divider').show();
		},
		
		adjustUsual: function() {
			Backbone.Config.struct.clnMouseMenuObj.each(function(mdl){
				mdl.get('forUsual') ? mdl.set('display', true) : mdl.set('display', false);
			});
			this.$el.find('.divider').show();
		},
		
		adjustTree: function() {
			Backbone.Config.struct.clnMouseMenuObj.each(function(mdl){
				mdl.get('forTreeView') ? mdl.set('display', true) : mdl.set('display', false);
			});
			this.$el.find('.divider').last().hide();
		},
		
		render: function() {
			
		}
	});
	return Controls;
});