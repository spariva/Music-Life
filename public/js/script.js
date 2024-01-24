const textoEnlaceModoOscuro = document.getElementById('modo-oscuro');
textoEnlaceModoOscuro.addEventListener("click", toggleModoOscuro);

function getCookie(name) {
    var value = "; " + document.cookie;
    var parts = value.split("; " + name + "=");
    if (parts.length == 2) return parts.pop().split(";").shift();
}

function toggleModoOscuro() {

    var modoOscuro = getCookie('modoOscuro');

    // Comprobar si la cookie existe
    if (modoOscuro === undefined) {
        document.cookie = "modoOscuro=true; path=/";
    } else {
        if (modoOscuro === 'true') {
            document.cookie = "modoOscuro=false; path=/";
        } else {
            document.cookie = "modoOscuro=true; path=/";
        }
    }

    setModoOnLoad();
}


//var login
const body = document.querySelector('body');
// var modo oscuro:
const videoFondo = document.getElementById('videoFondo');
const elementosNavbar = document.getElementsByClassName('textoCabecera');
const textoCabecera = document.getElementById('logo');
const formaSpotify = document.getElementsByClassName('formaSpotify');
var textoContacto = document.getElementsByClassName('textoContacto');
var textoSpotify = document.getElementsByClassName('textoSpotify');
var apartado = document.querySelectorAll('#apartado');


function setModoOnLoad() {

    var modoOscuro = getCookie('modoOscuro');

    // Obtener la ruta de la página actual
    var ruta = window.location.pathname;
    var pagina = ruta.substring(ruta.lastIndexOf('/') + 1);

    if (modoOscuro === 'true') {

        if (pagina === 'spotify.html') {

            videoFondo.src = './img/FondoSpotifyOscuro.mp4';
            textoEnlaceModoOscuro.textContent = "Modo Claro";
            for (var i = 0; i < apartado.length; i++) {
                apartado[i].style.color = 'black';
            }
            for (var i = 0; i < elementosNavbar.length; i++) {
                elementosNavbar[i].style.color = 'white';
            }
            for (var i = 0; i < textoSpotify.length; i++) {
                textoSpotify[i].style.color = 'white';
            }

            for (var i = 0; i < formaSpotify.length; i++) {
                formaSpotify[i].style.backgroundColor = 'rgba(0, 0, 0, 0.5)';
            }

        } else {

            videoFondo.src = './img/FondoIndexOscuro.mp4';
            textoEnlaceModoOscuro.textContent = "Modo Claro";
            for (var i = 0; i < apartado.length; i++) {
                apartado[i].style.color = 'white';
            }
            // navbar.style.background = 'white';
            for (var i = 0; i < elementosNavbar.length; i++) {
                elementosNavbar[i].style.color = 'white';
            }
            for (var i = 0; i < textoContacto.length; i++) {
                textoContacto[i].style.color = 'white';
                textoContacto[i].style.backgroundColor = 'rgba(0, 0, 0, 0.5)';
            }
        }

    } else {
        if (pagina === 'spotify.html') {

            videoFondo.src = './img/FondoSpotifyClaro.mp4';
            textoEnlaceModoOscuro.textContent = "Modo Oscuro";
            for (var i = 0; i < elementosNavbar.length; i++) {
                elementosNavbar[i].style.color = 'black';
            }
            for (var i = 0; i < textoSpotify.length; i++) {
                textoSpotify[i].style.color = 'black';
            }

            for (var i = 0; i < formaSpotify.length; i++) {
                formaSpotify[i].style.backgroundColor = 'rgba(255, 255, 255, 0.5)';
            }

        }else{

            videoFondo.src = './img/FondoIndexClaro.mp4';
            textoEnlaceModoOscuro.textContent = "Modo Oscuro";
            // navbar.style.background = 'black';
            for (var i = 0; i < elementosNavbar.length; i++) {
                elementosNavbar[i].style.color = 'black';
            }
            for (var i = 0; i < textoContacto.length; i++) {
                textoContacto[i].style.color = 'black';
                textoContacto[i].style.backgroundColor = 'rgba(255, 255, 255, 0.5)';
            }

        }

    }

}


window.onload = setModoOnLoad; //Cada vez que se cargue una pagina se comprobara