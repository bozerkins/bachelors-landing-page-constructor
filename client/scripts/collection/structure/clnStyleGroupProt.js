define([
	'model/structure/mdlStyleGroupProt',
	'core'
], function(mdlStyleGroupProt){
	var Collection = Backbone.Collection.extend({
		model: mdlStyleGroupProt
	});
	return Collection;
});