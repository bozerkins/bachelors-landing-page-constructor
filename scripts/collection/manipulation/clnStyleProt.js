define([
	'model/manipulation/mdlStyleProt',
	'core'
], function (mdlStyleProt) {
	var Collection = Backbone.Collection.extend({
		model: mdlStyleProt
	});
	return Collection;
});