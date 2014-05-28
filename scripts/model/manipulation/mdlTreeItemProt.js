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
					// push model to collection if none added
					!Backbone.Config.struct.clnTreeObj.get(model.get('id')) && Backbone.Config.struct.clnTreeObj.push(model);
					callback(model);
				}
			});
		},
		
		createClone: function(options, callback) {
			if (!options.data) {
				options.data = {};
			}
			options.data.element_id = this.get('id');
			options.success = function(modelRecords){
				var modelObjects = [];
				_.each(modelRecords, function(item, key){
					var model = new Backbone.Config.struct.clnTreeObj.model(item);
					modelObjects.push(model);
				});
				Backbone.Config.struct.clnTreeObj.add(modelObjects);
				callback && callback(modelObjects);
			};
			Backbone.sync('createClone', this, options);
		},
		
		clone: function() {
			var clone = Backbone.Model.prototype.clone.apply(this, arguments);
			delete clone.mdlElementObj;
			
			// reset linking elements
			clone.set('id', null);
			clone.set('parent_element_id', null);
			// bind actual element obj
			clone.mdlElementObj = this.mdlElementObj;
			// reset element id link
			clone.clnAttributeObj.each(function(model, key){
				model.set('element_id', null);
			});
			// reset element id link
			clone.clnStyleObj.each(function(model, key){
				model.set('element_id', null);
			});
			return clone;
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
		
		destroyExtended: function() {
			// delete attributes
			_.each(_.clone(this.clnAttributeObj.models), function(model) {
				model.destroy({data: model.toJSON()});
			});
			// delete styles
			_.each(_.clone(this.clnStyleObj.models), function(model) {
				model.destroy({data: model.toJSON()});
			});
			// delete model
			this.destroy({data: this.toJSON()});
			return this;
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