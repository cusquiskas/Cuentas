var maestroEtiqueta = class {
    constructor (mod, obj) {
        console.log('maestroEtiqueta.js -> constructor');
        this.modulo = mod;
        this.objeto = obj;
        this.tabla  = '<tr><th scope="row">{{id}}</th><td>{{descripcion}}</td><td class="upperSwitch"><label class="switch"><input idE="{{id}}" type="checkbox" {{estado}}><span class="slider round"></span></label></td></tr>';
        this.addEventos();
    };

    listar (s,d,e) {
        if (s) {
            let tb = $('tbody');
            let md = e.form.modul;
            tb.empty();
            for (let i = 0; i< d.root.Detalle.length; i++) {
                d.root.Detalle[i].estado = (d.root.Detalle[i].activo?'checked':'unchecked');
                tb.append($.parseHTML(e.form.modul.script.tabla.reemplazaMostachos(d.root.Detalle[i])));
            }
            $('input[type=checkbox]').change(function () { 
                md.Forms["cambiaEstado"].set({id:this.getAttribute('idE'), activo:(this.checked?1:0)});
                md.Forms["cambiaEstado"].executeForm();
            });
        } else {
            validaErroresCBK(d.root||d);
        }
    }

    cambiaEstado (s,d,e) {
        validaErroresCBK(d.root||d);
        if (!s) {
            $('input[idE='+e.form.parametros.id.value+']')[0].checked = e.form.parametros.activo.value == 0 ? true : false;
        }
    }

    addEventos() {
        let me = this;
        $('select[name=activo]').change(function () {
            me.modulo.Forms['frmEtiqueta'].executeForm();
        });
        
    }   
}