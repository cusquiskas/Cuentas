var maestro = class {
    constructor (mod, obj) {
        console.log('maestro.js -> constructor');
        this.addEventos();
    };

    addEventos() {
        let temp = Moduls.getFormulariomaestro();
        $(".maestroEtiquetas").click(function() {
            temp.load({ url: 'content/pantallas/maestroEtiqueta.html', script: true });
        });
        $(".maestroTarjetas").click(function() {
            temp.load({ url: 'content/pantallas/maestroTarjeta.html', script: true });
        });
        $(".maestroMovimiento").click(function() {
            temp.load({ url: 'content/pantallas/maestroMovimiento.html', script: true });
        });

    };
}