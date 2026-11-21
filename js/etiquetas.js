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

function editaEtiquetaAutomatica(id, nombre, patron, etiqueta) {
 var f = getForm("frmEtiquetaAutomatica");
 f.elements["id"].value = id;
 f.elements["nombre"].value = nombre;
 f.elements["patron"].value = patron;
 f.elements["idetiqueta"].value = etiqueta;
}

function limpiaEtiquetaAutomatica() {
 var f = getForm("frmEtiquetaAutomatica");
 f.elements["id"].value = "";
 f.elements["nombre"].value = "";
 f.elements["patron"].value = "";
 f.elements["idetiqueta"].value = "";
}

document.addEventListener("DOMContentLoaded", function () {
 var botones = document.querySelectorAll("[data-edita-automatico]");
 for (var i = 0; i < botones.length; i++) {
  botones[i].addEventListener("click", function () {
   editaEtiquetaAutomatica(
    this.getAttribute("data-id"),
    this.getAttribute("data-nombre"),
    this.getAttribute("data-patron"),
    this.getAttribute("data-etiqueta")
   );
  });
 }
});