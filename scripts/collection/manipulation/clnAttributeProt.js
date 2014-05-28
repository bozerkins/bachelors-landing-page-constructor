define([
	'model/manipulation/mdlAttributeProt',
	'core'
], function (mdlAttributeProt) {
	
	var Collection = Backbone.Collection.extend({
		
		url: 'server/index.php/ajax/tree/attributes/',
		
		model: mdlAttributeProt,
		
		validateCollection: function(options, callback) {
			options = options || {};
			if (!options.data) {
				options.data = {};
			}
			options.data.attributeList = this.toJSON();
			options.success = function(errorIds){
				console.log(errorIds);
			};
			Backbone.sync('validateCollection', this, options);
		}
	});
	return Collection;
});