define([
	'model/structure/mdlElement',
	'core'
], function (mdl) {
	var Collection = Backbone.Collection.extend({
		model: mdl,
		url: 'server/index.php/ajax/elements/'
	});
	return Collection;
});