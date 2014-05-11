function PropertiesPopup(){
	var _this = this;
	var prop = getTemplate('.properties-popup').clone();
	var headerAddItem = new PropertiesHeader(prop.find('.properties-header-additem'));
	var currentSide = null;
	prop.find('.properties-left').click(function(){
		_this.setSide('left');
	});
	prop.find('.properties-right').click(function(){
		_this.setSide('right');
	});
	prop.find('.properties-close').click(function(){
		_this.close();
	});
	/**
	 * @returns {PropertiesPopup.prop}
	 */
	this.getContainer = function(){
		return prop;
	};
	this.show = function(){
		_this.getContainer().show();
	};
	this.hide = function(){
		_this.getContainer().hide();
	};
	this.setSide = function(side){
		if (currentSide){
			prop.removeClass(currentSide);
			prop.find('.properties-'+currentSide).removeClass('selected');
		}
		prop.addClass(side);
		currentSide = side;
		prop.find('.properties-'+currentSide).addClass('selected');
	};
	this.close = function(){
		_this.hide();
	};
	/**
	 * @returns {PropertiesHeader}
	 */
	this.getHeaderAddItem = function(){
		return headerAddItem;
	};
}
function PropertiesHeader(element){
	var _this = this;
	var header = $(element);
	/**
	 * @returns {PropertiesHeader.header}
	 */
	header.find('.properties-header-item').click(function(){
		_this.getContainer().find('.properties-header-item.selected').removeClass('selected');
		$(this).addClass('selected');
	});
	this.getContainer = function(){
		return header;
	};
	this.show = function(){
		_this.getContainer().show();
	};
	this.hide = function(){
		_this.getContainer().hide();
	};
	this.selectItem = function(itemName){
		_this.getContainer().find('.properties-header-item.selected').removeClass('selected');
		_this.getContainer().find('.properties-header-item.'+itemName).addClass('selected');
	};
}
function PropertiesElement(){
	
}