function addEtiqueta(v){
	var f = document.forms.frmEstadistica;
	if (f.etiqueta1.value == "") f.etiqueta1.value = v;
	else if (f.etiqueta2.value == "") f.etiqueta2.value = v;
	else if (f.etiqueta3.value == "") f.etiqueta3.value = v;
	else f.exceso.value = 'S';
	f.submit();
}

function delEtiqueta(v){
	var f = document.forms.frmEstadistica;
	if (f.etiqueta1.value == v) {
		f.etiqueta1.value = f.etiqueta2.value;
		f.etiqueta2.value = f.etiqueta3.value;
		f.etiqueta3.value = "";
	} else {
		if (f.etiqueta2.value == v) {
			f.etiqueta2.value = f.etiqueta3.value;
			f.etiqueta3.value = "";
		} else {
			if (f.etiqueta3.value == v) f.etiqueta3.value = "";
		}
	}
	f.submit();
}