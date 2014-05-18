define([
	'collection/menu/clnElement',
	'core'
], function (clnElement) {
	var Collection = Backbone.Collection.extend({
		url: 'ajax.php?requirer=collection&type=elementGroup&',
		parse: function(response) {
			_.each(response, function(item, key){
				item.elements = new clnElement(item.elements, {
					parent: this
				});
			});
			return response;
		},
		toJSON: function() {
			var attributes = _.clone(this.models);
			_.each(attributes, function(mdl, key){
				mdl.set('elements', mdl.get('elements').toJSON());
				attributes[key] = mdl.toJSON();
			});
			return attributes;			
		}
	});
	return Collection;
});