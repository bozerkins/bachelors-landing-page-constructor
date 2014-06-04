define([
	'model/mdlMouseMenuProt',
	'core'
], function (mdlMouseMenuProt) {
	var Colection = Backbone.Collection.extend({
		model: mdlMouseMenuProt
	});
	return Colection;
});