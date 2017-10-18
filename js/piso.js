function muestraDatos(o) {
 var f=getForm("frmPiso");
 f.id.value=o.value;
 f.nombre.value=o.options[o.selectedIndex].getAttribute('texto');
 f.propietario.value=o.options[o.selectedIndex].getAttribute('propietario');
 f.porcentaje.value=o.options[o.selectedIndex].getAttribute('porcentaje');
} 