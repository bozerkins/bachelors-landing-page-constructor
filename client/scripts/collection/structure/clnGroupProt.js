define([
	'model/structure/mdlGroupProt',
	'core'
], function(mdlGroupProt){
	var Collection = Backbone.Collection.extend({
		model: mdlGroupProt,
		toJSON_withElements: function(){
			var toJson = this.toJSON();
			_.each(toJson, function(val, key){
				var model = this.get(val.id);
				val.elements = model.clnElementObj.toJSON();
			}, this);
			return toJson;
		}
	});
	return Collection;
});