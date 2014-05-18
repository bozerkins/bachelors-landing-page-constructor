define([
	'model/menu/mdlElement',
	'core'
], function (mdl) {
	var Collection = Backbone.Collection.extend({
		model: mdl,
	});
	return Collection;
});