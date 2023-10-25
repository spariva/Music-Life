let crearCuenta = document.querySelector('#crearCuenta');
let conectarCuenta = document.querySelector('#conectarCuenta');
let body = document.querySelector('body');

crearCuenta.onclick = function(){
    body.classList.add('crearCuenta');
}

conectarCuenta.onclick = function(){
    body.classList.remove('crearCuenta');
}


