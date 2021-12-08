function validacion(obj) {
  var err=[];
  if (obj.clave.value!=obj.reclave.value) err.push('\nLas contraseñas no coinciden');
  if (obj.nombre.value.length==0) err.push('\nMe tienes que dar tu nombre');
  if (obj.usuario.value.length==0) err.push('\nEl Email, será el identificador de tu cuenta');
  if (obj.clave.value.length<6) err.push('\nLa clave tiene que tener una longitud mínima de 6 caracteres');
  if (err.length>0) { alert(err); }
  return (err.length==0);
} 

function submita(id) {var frm=getForm('frmBorraMovimiento');frm.id.value=id;frm.submit();}
