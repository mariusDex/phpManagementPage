if ("serviceWorker" in navigator) {
    console.log('El navegador admite el serviceWorker');

    if (navigator.serviceWorker.controller) {
        console.log('El serviceWorker ya existe');
    } else {
        // registrar el serviceWorker :
        navigator.serviceWorker.register("pwa_sw.js", {
            scope: "./" 
        }).then(function (reg) {
                console.log("SW registrado");
        }).catch(function (err) {
                console.log("No se ha podido registrar el SW");
        });
    }
}