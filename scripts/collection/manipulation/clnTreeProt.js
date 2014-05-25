define([
	'model/manipulation/mdlTreeItemProt',
	'core'
], function (mdlTreeItem) {
	var Collection = Backbone.Collection.extend({
		model: mdlTreeItem,
		mdlIncompleteTreeItemObj: null
	});
	return Collection;
});