define([
	'model/menu/mdlElementGroup',
	'core'
], function (mdl) {
	var Collection = Backbone.Collection.extend({
		model: mdl,
		url: 'ajax.php?requirer=collection&type=elementGroup&'
	});
	return Collection;
});