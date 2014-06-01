define([
	'view/viewAreaProt',
	'view/viewMouseMenuProt',
	'view/viewControlsProt',
	'view/viewTreePreviewProt',
	'core'
], function(viewAreaProt, viewMouseMenuProt, viewControlsProt, viewTreePreviewProt){
	var View = Backbone.View.extend({
				
		el: document.body,
				
		viewMouseMenuObj: null,
		viewControlsObj: null,
		viewAreaObj: null,
		
		initialize: function() {
			// most important object - first to init
			this.viewAreaObj = new viewAreaProt();
			this.$el.append(this.viewAreaObj.$el);
			// depends on area
			this.viewMouseMenuObj = new viewMouseMenuProt();
			this.$el.append(this.viewMouseMenuObj.$el);
			// depends on mouse menu
			this.viewControlsObj = new viewControlsProt();
			this.$el.append(this.viewControlsObj.$el);
			// depends on area
			this.viewTreePreviewObj = new viewTreePreviewProt();
			this.$el.append(this.viewTreePreviewObj.$el);
		},
		
		render: function(){
			
		}
	});
	return View;
});