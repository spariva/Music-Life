//var login
const body = document.querySelector('body');
// var modo oscuro:
const videoFondo = document.getElementById('videoFondo');
const textoEnlaceModoOscuro = document.getElementById('modo-oscuro');
const elementosNavbar = document.getElementsByClassName('textoCabecera');
const textoCabecera = document.getElementById('logo');
const formaSpotify = document.getElementsByClassName('formaSpotify');
var textoContacto = document.getElementsByClassName('textoContacto');
var textoSpotify = document.getElementsByClassName('textoSpotify');
var apartado = document.querySelectorAll('#apartado');

textoEnlaceModoOscuro.addEventListener("click", modoOscuro);

//*¿Sería mejor que fuera una clase que se aplica al body? 
//oscuro_azul, claro_azul, oscuro_verde y claro_verde. Y que el modo oscuro solo fuera un toggle de la clase.
//Modo oscuro universal a todas las páginas: 

function modoOscuro() {
    // Verifica si el video actual contiene 'FondoIndexClaro.mp4' en su ruta
    if (videoFondo.src.includes('FondoIndexClaro.mp4')) {
        // Cambia el video a FondoIndexOscuro.mp4 si el modo claro está activo
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
    } else if (videoFondo.src.includes('FondoSpotifyClaro.mp4')) {
        videoFondo.src = './img/FondoSpotifyOscuro.mp4';
        textoEnlaceModoOscuro.textContent = "Modo Claro";
        for (var i = 0; i < apartado.length; i++) {
            apartado[i].style.color = 'blsck';
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
    } else if (videoFondo.src.includes('FondoIndexOscuro.mp4')) {
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
    } else if (videoFondo.src.includes('FondoSpotifyOscuro.mp4')) {
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
    }
}