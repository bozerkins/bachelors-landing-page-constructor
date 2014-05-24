define([
	'model/structure/mdlGroup',
	'core'
], function (mdl) {
	var Collection = Backbone.Collection.extend({
		model: mdl,
		url: 'server/index.php/ajax/groups/',
		toJSON_withElements: function() {
			var toJson = this.toJSON();
			_.each(toJson, function(val, key){
				var model = this.get(val.id);
				val.elements = model.elements.toJSON();
			}, this);
			return toJson;
		}
	});
	return Collection;
});