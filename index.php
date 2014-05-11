<!DOCTYPE html>
<html>
	<head>
		<title>BOST - dynamic layout tools</title>
		<link type="text/css" rel="stylesheet" href="css/normalize.css">
		<link type="text/css" rel="stylesheet" href="css/jquery-ui.css">
		<link type="text/css" rel="stylesheet" href="css/modules/template.css">
		<link type="text/css" rel="stylesheet" href="css/modules/list-popup.css">
		<link type="text/css" rel="stylesheet" href="css/modules/properties-popup.css">
		<link type="text/css" rel="stylesheet" href="css/index.css">
		<script src="javascript/jquery-1.10.2.js"></script>
		<script src="javascript/jquery-ui.js"></script>
		<!-- elements -->
		<script src="javascript/modules/template.js"></script>
		<script src="javascript/modules/list-popup.js"></script>
		<script src="javascript/modules/properties-popup.js"></script>
		<script src="javascript/modules/mouse-click.js"></script>
	</head>
	<body>
		<!-- templates -->
		<div class="templates">
			<aside class="properties-popup">
				<nav class="properties-side">
					<div class="properties-left" title="pin menu to the left side of the screen"></div>
					<div class="properties-right" title="pin menu to the right side of the screen"></div>
					<div class="properties-close" title="close menu"></div>
				</nav>
				<div class="properties-header-info">Info</div>
				<ul class="properties-header-parent">
					<li>Parent: document</li>
				</ul>
				<div class="properties-header-info">Select Item</div>
				<header class="properties-header properties-header-additem">
					<div class="properties-header-item block">Block</div>
					<div class="properties-header-item paragraph">Paragraph</div>
					<div class="properties-header-item title">Title</div>
					<div class="properties-header-item link">Link</div>
				</header>
				<div class="properties-header-info">Property Groups</div>
				<header class="properties-header properties-header-additem"></header>
				<div class="properties-header-info">Properties</div>
			</aside>
		</div>
			
		<!-- test field, initialization -->
		<script>
			// properties menu
			var propertiesMenu = new PropertiesPopup();
			propertiesMenu.setSide('left');
			propertiesMenu.getHeaderAddItem().selectItem('block');
			propertiesMenu.getHeaderAddItem().show();
//			propertiesMenu.hide();
			$('body').append(propertiesMenu.getContainer());
			// dynamic menu
			var dynamicMenu = new ListPopup();
			dynamicMenu.addElement('Select item', function(){
				console.log('Select clicked');
				dynamicMenu.hide();
			});
			dynamicMenu.addElement('Add item', function(){
				console.log('Add clicked');
				dynamicMenu.hide();
				propertiesMenu.show();
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
					dynamicMenu.show();
				}
			});
		</script>
	</body>
</html>