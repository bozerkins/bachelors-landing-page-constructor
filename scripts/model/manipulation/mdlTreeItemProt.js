define([
	'collection/manipulation/clnAttributeProt',
	'collection/manipulation/clnStyleProt',
	'core'
], function (clnAttributeProt, clnStyleProt) {		

	var Model = Backbone.Model.extend({
		
		url: 'server/index.php/ajax/tree/',
		idAttribute: 'id',
		defaults: {
			design_element_id: null
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
		
		initialize: function(options) {
			this.clnAttributeObj = new clnAttributeProt();
			this.clnStyleObj = new clnStyleProt();
		},
		initializeDesignElement: function(){
			this.mdlElementObj = Backbone.Config.struct.clnElementObj.get(this.get('design_element_id'));
			this.initializeDesignAttributes();
			this.initializeDesignStyles();
			return this;
		},
		initializeDesignAttributes: function(){
			var modelsToAdd = [];
			this.mdlElementObj.clnAttributeObj.each(function(attr, key){
				var modelFound = this.clnAttributeObj.find(attr.get('id'));
				if (!modelFound) {
					modelsToAdd.push(new this.clnAttributeObj.model({
						design_attribute_id: attr.get('id'),
						title: attr.get('title')
					}));
					return;
				}
				modelFound.set('title', attr.get('title'));
			}, this);
			this.clnAttributeObj.push(modelsToAdd);
		},
		initializeDesignStyles: function(model){
			var modelsToAdd = [];
			this.mdlElementObj.clnStyleObj.each(function(stl, key){
				var modelFound = this.clnStyleObj.find(stl.get('id'));
				if (!modelFound) {
					modelsToAdd.push(new this.clnStyleObj.model({
						design_style_id: stl.get('id'),
						title: stl.get('title')
					}));
					return;
				}
				modelFound.set('title', stl.get('title'));
			}, this);
			this.clnStyleObj.push(modelsToAdd);
		}
	});
	return Model;
});