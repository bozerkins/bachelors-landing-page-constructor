define([
	'model/structure/mdlElementProt',
	'core'
], function(mdlElementProt){
	var Collection = Backbone.Collection.extend({
		model: mdlElementProt
	});
	return Collection;
});