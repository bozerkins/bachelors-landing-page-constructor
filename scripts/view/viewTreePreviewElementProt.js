define([
	'text!template/tree/element.html',
	'core'
], function(tpl){
	var Controls = Backbone.View.extend({
		
		tagName : 'div',
		
		className: 'tree-element panel panel-default',
		
		template: _.template(tpl),
		
		events: {
			
		},
		
		initialize: function() {
			var labelAttribute = this.model.clnAttributeObj.findWhere({name: 'label'});
			var label  = labelAttribute ? labelAttribute.get('attribute_value') : null;
			var type = this.model.mdlElementObj.get('tag');
			if (!label) {
				label = 'no label';
			}
			// create by template
			this.$el.append(this.template({id: this.model.get('id'), type: type, label: label}));
		}
		
	});
	return Controls;
});