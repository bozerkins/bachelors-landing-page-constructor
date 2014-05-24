define([
	'model/structure/mdlAttribute',
	'core'
], function (mdl) {
	var Collection = Backbone.Collection.extend({
		model: mdl,
		url: 'server/index.php/ajax/attributes/'
	});
	return Collection;
});