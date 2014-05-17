define([
	'model/mdlControl',
	'core'
], function (mdl) {
	var Library = Backbone.Collection.extend({
		model: mdl,
		url: 'ajax.php?requirer=collection&type=control&'
	});
	return Library;
});