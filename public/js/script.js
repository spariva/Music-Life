const textoEnlaceModoOscuro = document.getElementById('modo-oscuro');
const logoModoOscuro = document.getElementById('logo-modo-oscuro');
textoEnlaceModoOscuro.addEventListener("click", toggleModoOscuro);
var fondoNavBar = document.getElementById('navbar');

window.onscroll = function () {
    var textoCabecera = document.getElementById('logo');
    if (window.scrollY > 50) {
        textoCabecera.classList.add('hide');
    } else {
        textoCabecera.classList.remove('hide');
    }
};


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
const logoCargar = document.getElementById('logo');
const formaSpotify = document.getElementsByClassName('formaSpotify');
var textoContacto = document.getElementsByClassName('textoContacto');
var inputBusqueda = document.getElementById('inputBusqueda');
var navBar = document.getElementsByClassName('navBar');

var textoSpotify = document.getElementsByClassName('textoSpotify');
var apartado = document.querySelectorAll('#apartado');
var textElements = document.querySelectorAll('p, h1, h2, h3, h4, h5, h6, li, a, span, input, form, div, i');


function setModoOnLoad() {
    var modoOscuro = getCookie('modoOscuro');
    var ruta = window.location.pathname;
    var pagina = ruta.substring(ruta.lastIndexOf('/') + 1);

    if (modoOscuro === 'true') {
        if (pagina === 'spotify.html') {
            videoFondo.src = './img/FondoSpotifyOscuro.mp4';
            logoModoOscuro.classList.remove('fa-moon');
            logoModoOscuro.classList.add('fa-sun');
            //fondoNavBar.style.backgroundColor = 'rgba(0, 0, 0, 1)';
            fondoNavBar.classList.add('bg-negro');
            fondoNavBar.classList.remove('bg-blanco');

            //textoEnlaceModoOscuro.innerHTML = '<li class="nav-item"><a class="nav-link" id="modo-oscuro"><i class="fa-solid fa-sun"></i><span class="nav-text">Modo Oscuro</span></a></li>';
            for (var i = 0; i < apartado.length; i++) {
                apartado[i].style.color = 'white';
            }
            for (var i = 1; i < elementosNavbar.length; i++) {
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
            //logoCargar.style.setProperty('color', 'white', 'important');

            console.log('aaa');
            //console.log(logoCargar);
            //navbar[0].style.color = 'white';


            logoModoOscuro.classList.remove('fa-moon');
            logoModoOscuro.classList.add('fa-sun');
            //textoEnlaceModoOscuro.innerHTML = '<li class="nav-item"><a class="nav-link" id="modo-oscuro"><i class="fa-solid fa-sun"></i><span class="nav-text">Modo Oscuro</span></a></li>';
            //fondoNavBar.style.backgroundColor = 'rgba(0,0,0, 1)';
            fondoNavBar.classList.add('bg-negro');
            fondoNavBar.classList.remove('bg-blanco');

            //textoEnlaceModoOscuro.textContent = "Modo Claro";
            for (var i = 0; i < apartado.length; i++) {
                apartado[i].style.color = 'white';
            }
            for (var i = 1; i < elementosNavbar.length; i++) {
                elementosNavbar[i].style.color = 'white';
            }
            for (var i = 0; i < textoContacto.length; i++) {
                textoContacto[i].style.color = 'white';
                textoContacto[i].style.backgroundColor = 'rgba(80,80,80, 1)';
            }
        }
        if(inputBusqueda){
            inputBusqueda.style.backgroundColor = 'rgb(50,50,50)';
        }


        for (var i = 0; i < textElements.length; i++) {
            textElements[i].style.color = 'white';
        }

    } else {
        if (pagina === 'spotify.html') {
            videoFondo.src = './img/FondoSpotifyClaro.mp4';
            logoModoOscuro.classList.remove('fa-sun');
            logoModoOscuro.classList.add('fa-moon');
            fondoNavBar.classList.add('bg-blanco');
            fondoNavBar.classList.remove('bg-negro');

            //fondoNavBar.style.backgroundColor = 'rgba(255,255,255, 1)';

            //textoEnlaceModoOscuro.innerHTML = '<li class="nav-item"><a class="nav-link" id="modo-oscuro"><i class="fa-solid fa-moon"></i><span class="nav-text">Modo Oscuro</span></a></li>';

            //textoEnlaceModoOscuro.textContent = "Modo Oscuro";
            for (var i = 0; i < elementosNavbar.length; i++) {
                elementosNavbar[i].style.color = 'black';
            }
            for (var i = 0; i < textoSpotify.length; i++) {
                textoSpotify[i].style.color = 'black';
            }
            for (var i = 0; i < formaSpotify.length; i++) {
                formaSpotify[i].style.backgroundColor = 'rgba(255, 255, 255, 0.5)';
            }
        } else {
            videoFondo.src = './img/FondoIndexClaro.mp4';
            logoModoOscuro.classList.remove('fa-sun');
            logoModoOscuro.classList.add('fa-moon');
            fondoNavBar.classList.add('bg-blanco');
            fondoNavBar.classList.remove('bg-negro');

            //fondoNavBar.style.backgroundColor = 'rgba(255,255,255, 1)';

            //textoEnlaceModoOscuro.innerHTML = '<li class="nav-item"><a class="nav-link" id="modo-oscuro"><i class="fa-solid fa-moon"></i><span class="nav-text">Modo Oscuro</span></a></li>';

            //textoEnlaceModoOscuro.textContent = "Modo Oscuro";
            for (var i = 0; i < elementosNavbar.length; i++) {
                elementosNavbar[i].style.color = 'black';
            }
            for (var i = 0; i < textoContacto.length; i++) {
                textoContacto[i].style.color = 'black';
                textoContacto[i].style.backgroundColor = 'rgba(255, 255, 255, 0.5)';
            }
        }
        for (var i = 0; i < textElements.length; i++) {
            textElements[i].style.color = 'black';
        }
        if(inputBusqueda){
        inputBusqueda.style.backgroundColor = 'white';
        }

        //textoCabecera.style.color = 'black';
    }
}

window.onload = setModoOnLoad;

