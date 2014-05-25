define([
	'view/viewAreaProt',
	'view/viewMouseMenuProt',
	'view/viewControlsProt',
	'core'
], function(viewAreaProt, viewMouseMenuProt, viewControlsProt){
	var View = Backbone.View.extend({
				
		el: document.body,
				
		viewMouseMenuObj: null,
		viewControlsObj: null,
		viewAreaObj: null,
		
		initialize: function() {
			console.log('initializing...');
			// most important object - first to init
			this.viewAreaObj = new viewAreaProt();
			this.$el.append(this.viewAreaObj.$el);
			// depends on area
			this.viewMouseMenuObj = new viewMouseMenuProt();
			this.$el.append(this.viewMouseMenuObj.$el);
			// depends on mouse menu
			this.viewControlsObj = new viewControlsProt();
			this.$el.append(this.viewControlsObj.$el);
		},
		
		render: function(){
			console.log('rendering...');
			console.log(this.$el);
		}
	});
	return View;
});