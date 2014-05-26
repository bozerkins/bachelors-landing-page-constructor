define([
	'collection/manipulation/clnAttributeProt',
	'collection/manipulation/clnStyleProt',
	'core'
], function (clnAttributeProt, clnStyleProt) {		

	var Model = Backbone.Model.extend({
		
		url: 'server/index.php/ajax/tree/',
		idAttribute: 'id',
		defaults: {
			design_element_id: null,
			parent_element_id: null
		},

		mdlElementObj: null,
		clnAttributeObj: null,
		clnStyleObj: null,
		
		create: function(callback){
			var _this = this;
			var data = this.toJSON();
			this.save(data, {
				success: function(model,response){
					model.set('id', response);
					_this.clnAttributeObj.each(function(attr){
						attr.set('element_id', response);
						attr.save();
					});
					model.set('id', response);
					_this.clnStyleObj.each(function(attr){
						attr.set('element_id', response);
						attr.save();
					});
					callback(model);
				}
			});
		},
		
		update: function(callback) {
			var _this = this;
			this.clnAttributeObj.each(function(attr){
				attr.set('element_id', _this.get('id'));
				attr.save();
			});
			this.clnStyleObj.each(function(attr){
				attr.set('element_id', _this.get('id'));
				attr.save();
			});
			callback(this);
		},
		
		initialize: function(options) {
			this.clnAttributeObj = new clnAttributeProt(options.attributeList);
			this.clnStyleObj = new clnStyleProt(options.styleList);
		},
		set: function(attributes, options) {
			if (attributes.design_element_id) {
				this.mdlElementObj = Backbone.Config.struct.clnElementObj.get(attributes.design_element_id);
			}
			Backbone.Model.prototype.set.apply(this, arguments);
			return this;
		},
		initializeDesignElement: function(){
			this.initializeDesignAttributes();
			this.initializeDesignStyles();
			return this;
		},
		initializeDesignAttributes: function(){
			var modelsToAdd = [];
			this.mdlElementObj.clnAttributeObj.each(function(attr, key){
				var modelFound = this.clnAttributeObj.get(attr.get('id'));
				if (!modelFound) {
					modelsToAdd.push(new this.clnAttributeObj.model({
						design_attribute_id: attr.get('id')
					}));
					return;
				}
			}, this);
			this.clnAttributeObj.push(modelsToAdd);
		},
		initializeDesignStyles: function(model){
			var modelsToAdd = [];
			this.mdlElementObj.clnStyleObj.each(function(stl, key){
				var modelFound = this.clnStyleObj.get(stl.get('id'));
				if (!modelFound) {
					modelsToAdd.push(new this.clnStyleObj.model({
						design_style_id: stl.get('id')
					}));
					return;
				}
			}, this);
			this.clnStyleObj.push(modelsToAdd);
		}
	});
	return Model;
});