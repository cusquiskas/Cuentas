var maestroTarjeta = class {
    constructor (mod, obj) {
        console.log('maestroTarjeta.js -> constructor');
        this.modulo = mod;
        this.objeto = obj;
        this.tarjetas = [];
        this.addEventos();
    };

    addEventos() {
        let me = this;
        $('select[name=id]').ajaxSuccess(function (eve) {
            me.tarjetas = JSON.parse(eve.target.getAttribute('obj'));
        });
        $('select[name=id]').change     (function (eve) {
            let objeto = JSON.parse(JSON.stringify(me.tarjetas.find( opciones => opciones.id == eve.target.value)));
            delete objeto.id;
            me.modulo.Forms['frmTarjeta'].set(objeto);
        });
    };

}