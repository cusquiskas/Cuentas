var header = class {
    constructor (mod, obj) {
        console.log('header.js -> constructor');
        if (!sessionStorage.getItem("user") || sessionStorage.getItem("user") == "") {
            Moduls.getBody().load({ url: 'content/login/login.html', script: true });
        } else {
            this.muestra('botonDeSalir');
            //this.addEventos();
            Moduls.getBody().load({ url: 'content/blanco.html', script: false });
        }
    };

    muestra (elem) {
        $(".botonDeSalir").show();
    };

    addEventos () {
        $(".botonDeSalir").click(function () {
            sessionStorage.removeItem('user');
            sessionStorage.removeItem('nombre');
            Moduls.getHeader().load({ url: 'content/header.html', script: true });
        });
    };

    salir (s,d,e) {
        sessionStorage.removeItem('user');
        sessionStorage.removeItem('nombre');
        document.location.reload();
    }


}