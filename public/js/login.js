let crearCuenta = document.querySelector('#crearCuenta');
let conectarCuenta = document.querySelector('#conectarCuenta');
let body = document.querySelector('body');
let videoFondo = document.getElementById('videoFondo');

crearCuenta.onclick = function(){
    body.classList.add('crearCuenta');
    videoFondo.src = '../img/FondoSpotifyClaro.mp4';
}

conectarCuenta.onclick = function(){
    body.classList.remove('crearCuenta');
    videoFondo.src = '../img/FondoIndexClaro.mp4';
}


