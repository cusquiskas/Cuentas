var header = class {
    constructor (mod, obj) {
        console.log('header.js -> constructor');
        if (!sessionStorage.getItem("user") || sessionStorage.getItem("user") == "") {
            Moduls.getBody().load({ url: 'content/login/login.html', script: true });
        } else {
            $(".opcionesHeaderOcultas").show();
            //$(".opcionesDeMenu").show();
            this.addEventos();
            Moduls.getBody().load({ url: 'content/blanco.html', script: false });
        }
    };

    addEventos () {
        $(".opcionMovimientos").click(function () {
            Moduls.getBody().load({ url: 'content/pantallas/movimiento.html', script: true });
        });

        $(".opcionMaestros").click(function () {
            Moduls.getBody().load({ url: 'content/pantallas/maestro.html', script: true });
        });

        $(".opcionEstadisticas").click(function () {
            Moduls.getBody().load({ url: 'content/pantallas/estadistica.html', script: true });
        });
    };

    salir (s,d,e) {
        sessionStorage.removeItem('user');
        sessionStorage.removeItem('nombre');
        document.location.reload();
    }


}