function muestraDatos(o) {
 //event.stopPropagation();
 var f=getForm("frmEtiqueta");
 f.id.value=o.value;
 f.descripcion.value=o.options[o.selectedIndex].getAttribute('texto');
 if (o.options[o.selectedIndex].getAttribute('activo')=='1') {
  getId('Desactivar').style.display='inline';
  getId('Activar').style.display='none';
 } else {
  getId('Desactivar').style.display='none';
  getId('Activar').style.display='inline'; 
 }
  
}