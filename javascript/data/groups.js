window.groups = [
	{
		title : 'containers',
		name : 'conts',
		elements : [
			{
				title : 'article',
				name : 'article',
				attributes : [
					{
						title : 'title',
						name : 'title',
						type : 'text'
					}
				]
			},
			{
				title : 'aside',
				name : 'aside'
			},
			{
				title : 'nav',
				name : 'nav'
			},
			{
				title : 'div',
				name : 'div'
			},
			{
				title : 'header',
				name : 'header'
			},
			{
				title : 'footer',
				name : 'footer'
			}
		]
	},{
		title : 'elements',
		name : 'els',
		elements : [
			{
				title : 'a',
				name : 'href'
			},{
				title : 'pre',
				name : 'pre'
			},{
				title : 'ul',
				name : 'ul'
			},{
				title : 'ol',
				name : 'ol'
			},{
				title : 'table - th, tr - td',
				name : 'table'
			},{
				title : 'h1-h6',
				name : 'h16'
			},{
				title : 'img',
				name : 'img'
			},{
				title : 'label',
				name : 'label'
			},{
				title : 'paragraph',
				name : 'p'
			},{
				title : 'span',
				name : 'span'
			}
		]
	},{
		title : 'interaction+presets',
		name : 'int_pres',
		elements : [
			{
				title : 'form',
				name : 'form'
			},{
				title : 'input',
				name : 'input'
			},{
				title : 'select',
				name : 'select'
			},{
				title : 'script',
				name : 'script'
			}
		]
	}
];
function groupFind(group, name){
	for(i in window.groups) {
		if (window.groups[i].name === group){
			for(j in window.groups[i].elements) {
				if (window.groups[i].elements[j].name === name){
					return window.groups[i].elements[j];
				}
			}
		}
	}
	return null;
};