// get templates
var sideMenuTemplate = _.template($('#template-controls-menu').html());
var sideMenuGroupTemplate = _.template($('#template-controls-add-element').html());
var sideMenuAttributeTemplate = _.template($('#template-controls-attribute').html());
var sideMenuAttributeControlsTemplate = _.template($('#template-controls-attribute-controls').html());
// side menu
var sideMenuElement = $(sideMenuTemplate()).hide();
sideMenuElement.children('.basic').children('.position').children('.move').click(function(){
	var side = $(this).data('side');
	sideMenuElement.removeClass('left').removeClass('right').addClass(side);
});
sideMenuElement.children('.basic').children('.closing').click(function(){
	sideMenuElement.hide();
});
sideMenuElement.find();
$('body').append(sideMenuElement);
// empty element
var createElement = new element(); // empty element for future use
// 
// dynamic menu
var dynamicMenu = new ListPopup();
dynamicMenu.addElement('Select item', function(){
	console.log('Select clicked');
	console.log("selected element: ");
	console.log(dynamicMenu.getCurrentTarget());
	dynamicMenu.hide();
});
dynamicMenu.addElement('Add item', function(){
	console.log('Add clicked');
	dynamicMenu.hide();
	//empty caller
	sideMenuElement.find('.caller').children().remove();
	// add name
	sideMenuElement.find('.namer').html('Add item');
	// add prop menu
	$.each(window.groups, function(key, val){
		sideMenuElement.find('.caller').append(sideMenuGroupTemplate(val));
	});
	sideMenuElement.find('.caller').children('.caller-el').click(function(){
		oc($(this));
		oc($(this).next('.caller-el-type'));
	});
	sideMenuElement.find('.caller').children('.caller-el-type').children('.caller-el-type-el').click(function(){
		var item = groupFind($(this).data('group'), $(this).data('name'));
		sideMenuElement.find('.namer').html('Edit attributes: ' + item.title);
		sideMenuElement.find('.caller').children().remove();
		$.each(item.attributes, function(key, val){
			sideMenuElement.find('.caller').append(sideMenuAttributeTemplate(val));
		});
		var sideMenuAttrControls = $(sideMenuAttributeControlsTemplate({}));
		sideMenuAttrControls.children('.back').click(function(){
			dynamicMenu.getElement('Add item').click();
		});
		sideMenuElement.find('.caller').append(sideMenuAttrControls);
	});
	// create new element to use
	window.createElement = new element();
	// show prop. menu
	sideMenuElement.show();
});
dynamicMenu.addElement('Change item', function(){
	console.log('Change clicked');
	dynamicMenu.hide();
});
dynamicMenu.addElement('Remove item', function(){
	console.log('Remove clicked');
	dynamicMenu.hide();
});
$('body').append(dynamicMenu.getContainer());
var mouseClick = new MouseClick();
mouseClick.addLeftClick(function(event){
	if (!(dynamicMenu.getContainer().is(event.target)) 
			&& !$(event.target).closest(dynamicMenu.getContainer()).length 
			&& dynamicMenu.visible()){
		dynamicMenu.hide();
	}
	return true;
});
mouseClick.addRightClick(function(event){
	if (dynamicMenu.visible()){
		dynamicMenu.hide();
	}else{
		dynamicMenu.position(event.pageX, event.pageY);
		if (event.currentTarget === document) {
			dynamicMenu.hideElement('Select item');
			dynamicMenu.hideElement('Change item');
			dynamicMenu.hideElement('Remove item');
		}
		dynamicMenu.show(event);
	}
});