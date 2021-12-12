var maestroTarjeta = class {
    constructor (mod, obj) {
        console.log('maestroTarjeta.js -> constructor');
        this.modulo = mod;
        this.objeto = obj;
        this.tarjetas = [];
        this.addEventos();
    };

    limpiaFormulario () {
        let select = $('select[name=id]');
        select[0].value = "";
        select.trigger('change');
    };
    
    addEventos() {
        let me = this;
        $('button[name=limpiar]').click(function () {
            me.limpiaFormulario();
        });
        $('select[name=id]').ajaxSuccess(function (eve) {
            let option=document.createElement("option");
            option.value=""
            option.text=".. Selecciona una tarjeta ..";
            me.tarjetas = JSON.parse(eve.target.getAttribute('obj'));
            me.tarjetas[me.tarjetas.length] = {"id":"","descripcion":"","fila":"","c_fecha":"","c_descripcion":"","c_importe":"","c_concepto1":"","c_concepto2":"","c_concepto3":"","c_concepto4":"","d_corte":"","d_recordatorio":"","c_separador_d":"","c_separador_c":"","mascara":"","inv_import":"N"};
            eve.target.removeAttribute('obj');
            eve.target.appendChild(option);
            eve.target.value = "";
        });
        $('select[name=id]').change     (function (eve) {
            let objeto = JSON.parse(JSON.stringify(me.tarjetas.find( opciones => opciones.id == eve.target.value)));
            delete objeto.id;
            me.modulo.Forms['frmTarjeta'].set(objeto);
        });
    };

    guardar (s, d, e) {
        validaErroresCBK(d.root||d);
        if (s) {
            e.form.modul.script.limpiaFormulario();
            let Select = e.form.parametros.id.object;
            Select.options.length = 0;
            e.form.invocaStore(Select);
        }
    };

}