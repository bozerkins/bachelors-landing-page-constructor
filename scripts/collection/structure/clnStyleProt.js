define([
	'model/structure/mdlStyleProt',
	'core'
], function(mdlStyleProt){
	var Collection = Backbone.Collection.extend({
		model: mdlStyleProt
	});
	return Collection;
});