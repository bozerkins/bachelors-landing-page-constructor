define([
	'model/structure/mdlAttributeProt',
	'core'
], function(mdlAttributeProt){
	var Collection = Backbone.Collection.extend({
		model: mdlAttributeProt
	});
	return Collection;
});