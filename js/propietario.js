function muestraDatos(o) {
 var f=getForm("frmPropietario");
 f.id.value=o.value;
 f.nombre.value=o.options[o.selectedIndex].getAttribute('texto');
} 