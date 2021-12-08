var importe = 0;
function clonar() { getId('cuerpo_formulario').innerHTML+= '<div class="row"><div class="col-sm-1"><div class="form-group"><label>&nbsp;</label><button type="button" style="display:none" class="glyphicon glyphicon-minus"></button></div></div><div class="col-sm-8"><div class="form-group"><label for="descripcion">Descripción:</label><input type="text" class="form-control" name="descripcion[]" value=""></div></div><div class="col-sm-3"><div class="form-group"><label for="importe">Importe:</label><input class="form-control" name="importe[]" type="number" step="0.01" onChange="recalculaForm()"></div></div></div>'; }
function initImporte(imp) {importe = imp; }
function recalculaForm(form) {
	var p;
	var s=0, f = getForm('frmSplitMovimiento');
	var i, input = f.getElementsByTagName('INPUT');
	for (i=0; i<input.length; i++) {
		if (input[i].name == 'importe[]') {
			if (s==0) {
				s = importe;
				p = i;
			} else {
				s-= (input[i].value*1);
			}
		} 
	}
	input[p].value = s;
}