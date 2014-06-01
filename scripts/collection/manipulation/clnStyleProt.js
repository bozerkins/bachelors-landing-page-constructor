define([
	'model/manipulation/mdlStyleProt',
	'core'
], function (mdlStyleProt) {
	var Collection = Backbone.Collection.extend({
		
		url: 'server/index.php/ajax/tree/styles/',
		
		model: mdlStyleProt,
		
		validateCollection: function(callback) {
			var _this = this;
			var options = {};
			options.data = {};
			options.data.stylesList = this.toJSON();
			options.success = function(errorIds){
				errorIds = errorIds || [];
				_this.each(function(val, key){
					val.set('error', false);
				});
				_.each(errorIds, function(val, key){
					var model = _this.get(val);
					model.set('error', true);
				});
				callback(errorIds.length > 0);
			};
			Backbone.sync('validateCollection', this, options);
		}
	});
	return Collection;
});