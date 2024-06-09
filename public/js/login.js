document.addEventListener('DOMContentLoaded', function() {

//esto para login cambio ventana

const cuerpo = document.body;

const crearCuenta = document.getElementById('crearCuenta');
const conectarCuenta = document.getElementById('conectarCuenta');

if (crearCuenta) {
    crearCuenta.onclick = changeToCrearCuenta;
    var modoOscuro = getCookie('modoOscuro');
    if (modoOscuro === 'true') {
        videoFondo.src = './img/FondoSpotifyOscuro.mp4';
    } else {
        videoFondo.src = './img/FondoSpotifyClaro.mp4';
    }
}

if (conectarCuenta) {
    conectarCuenta.onclick = changeToConectarCuenta;
    var modoOscuro = getCookie('modoOscuro');
    if (modoOscuro === 'true') {
        videoFondo.src = './img/FondoIndexOscuro.mp4';
    } else {
        videoFondo.src = './img/FondoIndexClaro.mp4';
    }
}

function changeToCrearCuenta() {
    cuerpo.classList.add('crearCuenta');
    //videoFondo.src = './img/FondoSpotifyClaro.mp4';
}

function changeToConectarCuenta() {
    cuerpo.classList.remove('crearCuenta');
    //videoFondo.src = './img/FondoIndexClaro.mp4';
}


const forgotPasswordLink = document.getElementById('forgotPasswordLink');
const closeModalButton = document.getElementById('closeModal');
const loginForm = document.getElementById('inicioSesion');
const recoverForm = document.getElementById('recuperarPSWD');

forgotPasswordLink.addEventListener('click', function (event) {
    event.preventDefault();
    loginForm.style.display = 'none';
    recoverForm.style.display = 'flex';
});

closeModalButton.addEventListener('click', function () {
    recoverForm.style.display = 'none';
    loginForm.style.display = 'flex';
});

window.onload = setModoOnLoad;


});

