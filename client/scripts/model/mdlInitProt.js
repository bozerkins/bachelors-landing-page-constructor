define([
	'collection/manipulation/clnTreeProt',
	'collection/clnMouseMenuProt',
	'collection/structure/clnGroupProt',
	'collection/structure/clnElementProt',
	'collection/structure/clnAttributeProt',
	'collection/structure/clnStyleProt',
	'collection/structure/clnStyleGroupProt',
	'core'
], function(clnTreeProt, clnMouseMenuProt, clnGroupProt, clnElementProt, clnAttributeProt, clnStyleProt, clnStyleGroupProt){
	var Model = Backbone.Model.extend({
		url: '../server/index.php/ajax/init/',
		idAttribute: 'timestamp',
		
		clnGroupObj: null,
		clnElementObj: null,
		clnAttributeObj: null,
		clnStyleObj: null,
		clnMouseMenuObj: null,
		clnTreeObj: null,
		
		response : null,
		
		parse: function(response) {
			this.response = response;
			return [];
		},
		fillObjects: function(response) {
			// create objects
			this.clnGroupObj = new clnGroupProt(response.groupList);
			this.clnElementObj = new clnElementProt(response.elementList);
			this.clnAttributeObj = new clnAttributeProt(response.attributeList);
			this.clnStyleObj = new clnStyleProt(response.styleList);
			this.clnStyleGroupObj = new clnStyleGroupProt(response.styleGroupList);
			this.clnMouseMenuObj = new clnMouseMenuProt(response.actionList);
			// link groups with elements
			this.clnGroupObj.each(function(group){
				group.clnElementObj = new clnElementProt(this.clnElementObj.filter(function(element){
					return element.get('group_id') === group.get('id');
				}), this);
			}, this);
			// link elements with attributes and styles
			this.clnElementObj.each(function(element){
				element.clnAttributeObj = new clnAttributeProt(this.clnAttributeObj.filter(function(attr){
					return _.contains(element.get('attributeLinkList'), attr.get('id'));
				}, this));
				element.clnStyleObj = new clnStyleProt(this.clnStyleObj.filter(function(stl){
					return _.contains(element.get('styleLinkList'), stl.get('id'));
				}, this));
			}, this);
			
			// create tree object
			this.clnTreeObj = new clnTreeProt(response.treeList);
			this.clnTreeObj.each(function(modelObject){
				modelObject.initializeDesignElement();
			});
			
			return this;
		}
	});
	return Model;
});