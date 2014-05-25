define([
	'model/manipulation/mdlStyle',
	'core'
], function (mdl) {
	var Collection = Backbone.Collection.extend({
		model: mdl
	});
	return Collection;
});