const crearCuenta = document.getElementById('crearCuenta');
const conectarCuenta = document.getElementById('conectarCuenta');

crearCuenta.onclick = function(){
    body.classList.add('crearCuenta');
    videoFondo.src = './img/FondoSpotifyClaro.mp4';
}

conectarCuenta.onclick = function(){
    body.classList.remove('crearCuenta');
    videoFondo.src = './img/FondoIndexClaro.mp4';
}


