define([
	'model/mdlControl',
	'core'
], function (mdl) {
	var Library = Backbone.Collection.extend({
		model: mdl,
		url: 'server/index.php/ajax/controls/'
	});
	return Library;
});