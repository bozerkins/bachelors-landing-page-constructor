define([
	'model/manipulation/mdlAttributeProt',
	'core'
], function (mdlAttributeProt) {
	var Collection = Backbone.Collection.extend({
		model: mdlAttributeProt,
		toJSON_withTitles: function(){
			var toJson = this.toJSON();
			_.each(toJson, function(item ,key){
				
			}, this);
			return toJson;
		}
	});
	return Collection;
});