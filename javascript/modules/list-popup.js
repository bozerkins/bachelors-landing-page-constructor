function ListPopup(){
	var ul = $('<ul class="list-popup"></ul>');
	var elementList = {};
	var currentTarget = null;
	this.getContainer = function(){
		return ul;
	};
	this.setCurrentTarget = function(event){
		currentTarget = event;
	};
	this.getCurrentTarget = function(){
		return currentTarget;
	};
	this.show = function(currentTarget){
		this.setCurrentTarget(currentTarget);
		this.getContainer().show();
	};
	this.hide = function(){
		var _this = this;
		_this.getContainer().hide();
		$.each(elementList, function(key, val){
			_this.showElement(key);
		});
	};
	this.addElement = function(title, callback){
		var li = $('<li>'+title+'</li>');
		elementList[title] = li;
		li.click(callback);
		ul.append(li);
	};
	this.hideElement = function(title){
		elementList[title].hide();
	};
	this.showElement = function(title){
		elementList[title].show();
	};
	this.removeElement = function(index){
		
	};
	this.getElement = function(title){
		return elementList[title];
	};
	this.visible = function(){
		return this.getContainer().is(':visible');
	};
	this.position = function(x,y){
		this.getContainer().css({left: x,top: y});
	};
}