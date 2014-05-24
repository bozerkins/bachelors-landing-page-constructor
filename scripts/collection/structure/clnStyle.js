define([
	'model/structure/mdlStyle',
	'core'
], function (mdl) {
	var Collection = Backbone.Collection.extend({
		model: mdl,
		url: 'server/index.php/ajax/styles/'
	});
	return Collection;
});