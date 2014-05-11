function ListPopup(){
	var ul = $('<ul class="list-popup"></ul>');
	this.getContainer = function(){
		return ul;
	};
	this.show = function(){
		this.getContainer().show();
	};
	this.hide = function(){
		this.getContainer().hide();
	};
	this.addElement = function(title, callback){
		var li = $('<li>'+title+'</li>');
		li.click(callback);
		ul.append(li);
	};
	this.removeElement = function(index){
		
	};
	this.visible = function(){
		return this.getContainer().is(':visible');
	};
	this.position = function(x,y){
		this.getContainer().css({left: x,top: y});
	};
}