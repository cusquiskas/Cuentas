var header = class {
    constructor (mod, obj) {
        console.log('header.js -> constructor');
        debugger
        if (!sessionStorage.getItem("USER")) {
            Moduls.getBody().load({ url: 'content/login/login.html', script: true });
        } else {
            Moduls.getBody().load({ url: 'content/blanco.html', script: false });
        }
        
    };
}