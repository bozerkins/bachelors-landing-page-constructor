function MouseClick(){
	var LEFT_MOUSE_INDEX = 1;
	var MIDDLE_MOUSE_INDEX = 2;
	var RIGHT_MOUSE_INDEX = 3;
	
	this.addLeftClick = function(callback, element){
		$(this.getElement(element)).mousedown(function(event){
			if (LEFT_MOUSE_INDEX === event.which){
				if (!callback(event)){
					event.preventDefault();
				};
			}
		});
	};
	this.addRightClick = function(callback, element){
		$(this.getElement(element)).contextmenu(function(event){
			if (RIGHT_MOUSE_INDEX === event.which){
				if (!callback(event)){
					event.preventDefault();
				};
			}
		});
	};
	this.addMiddleClick = function(callback, element){
		alert('empty function');
	};
	this.addDefaultClick = function(callback, element){
		alert('empty function');
	};
	this.getElement = function(element){
		return (element ? element : $(document));
	};
}