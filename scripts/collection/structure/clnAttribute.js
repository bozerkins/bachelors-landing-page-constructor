define([
	'model/structure/mdlAttribute',
	'core'
], function (mdl) {
	var Collection = Backbone.Collection.extend({
		model: mdl,
		url: 'server/index.php/ajax/attributes/',
		structureElementId: null,
		fetchById: function(callback){
			this.fetch({
				data: {id: this.structureElementId},
				success: callback
			});
		}
	});
	return Collection;
});