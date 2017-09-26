function muestraDatos(o) {
 //event.stopPropagation();
 //event.cancelBubble = true;
 var f=getForm("frmTarjeta");
 f.id.value=o.value;
 f.descripcion.value=o.options[o.selectedIndex].getAttribute('texto');
 f.fila.value=o.options[o.selectedIndex].getAttribute('fila');
 f.d_corte.value=o.options[o.selectedIndex].getAttribute('d_corte');
 f.d_recordatorio.value=o.options[o.selectedIndex].getAttribute('d_recordatorio');
 f.c_fecha.value=o.options[o.selectedIndex].getAttribute('c_fecha');
 f.c_descripcion.value=o.options[o.selectedIndex].getAttribute('c_descripcion');
 f.c_importe.value=o.options[o.selectedIndex].getAttribute('c_importe');
 f.c_concepto1.value=o.options[o.selectedIndex].getAttribute('c_concepto1');
 f.c_concepto2.value=o.options[o.selectedIndex].getAttribute('c_concepto2');
 f.c_concepto3.value=o.options[o.selectedIndex].getAttribute('c_concepto3');
 f.c_concepto4.value=o.options[o.selectedIndex].getAttribute('c_concepto4');
 f.c_separador_d.value=o.options[o.selectedIndex].getAttribute('c_separador_d');
 f.c_separador_c.value=o.options[o.selectedIndex].getAttribute('c_separador_c');
 f.mascara.value=o.options[o.selectedIndex].getAttribute('mascara');
} 
