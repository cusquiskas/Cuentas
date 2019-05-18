function cambiaEstilo(o){
	// apaño para los navegadores que no propagan el evento //
	o.children[0].children[0].checked = !o.children[0].children[0].checked;
	o.className=(o.children[0].children[0].checked)?'glyphicon glyphicon-ok':'glyphicon glyphicon-remove';
	getId('im_'+o.getAttribute('piso')).disabled = !o.children[0].children[0].checked;
} 
