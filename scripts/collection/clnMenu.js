define([
	'model/mdlMenuItem',
	'core'
], function (mdlMenuItem) {
	var Library = Backbone.Collection.extend({
		model: mdlMenuItem,
		url: 'ajax.php?requirer=collection&type=menu&'
	});
	return Library;
});