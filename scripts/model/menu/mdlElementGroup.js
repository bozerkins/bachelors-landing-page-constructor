define([
	'core'
], function () {
	var Model = Backbone.Model.extend({
		idAttribute: 'id',
		parse: function(response) {
			if (typeof response.elements !== 'undefined') {
				response.elements = new Backbone.Collection(response.elements);
			}
			return response;
		},
		toJSON: function() {
			var clone = _.clone(this.attributes);
			_.each(clone, function(item, key){
				if (item.toJSON) {
					clone[key] = item.toJSON();
				}
			});
			return clone;
		}
	});
	return Model;
});