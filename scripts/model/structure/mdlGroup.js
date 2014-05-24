define([
	'collection/structure/clnElement',
	'core'
], function (colElement) {		

	var Model = Backbone.Model.extend({
		
		idAttribute: 'id',
		
		elements: null,
		
		parse: function(response) {
			if (typeof response.elements !== 'undefined') {
				this.elements = new colElement(response.elements);
				delete response.elements;
			}
			return response;
		}
	});
	return Model;
});