define([
	'core'
], function () {
	var Model = Backbone.Model.extend({
		idAttribute: 'id',
		mdlElementParent: null,
		mdlElementCurrent: null,
		
		setElementModel: function(mdl) {
			this.mdlElementCurrent = mdl;
			return this;
		},
		
		setElementParentModel: function(mdl) {
			this.mdlElementParent = mdl;
			return this;
		},
		
		getElementModel: function() {
			return this.mdlElementCurrent;
		}
		
	});
	return Model;
});