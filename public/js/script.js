//Efecto ratón animación onda.
document.addEventListener('mousemove', function (e) {
    const onda = document.createElement('div');
    onda.className = 'efecto-agua';
    document.body.appendChild(onda);

    const rect = e.target.getBoundingClientRect();
    const x = e.clientX - rect.left;
    const y = e.clientY - rect.top;

    onda.style.left = x + 'px';
    onda.style.top = y + 'px';

    onda.addEventListener('animationend', function () {
        onda.remove();
    });
});

//*¿Sería mejor que fuera una clase que se aplica al body? 
//oscuro_azul, claro_azul, oscuro_verde y claro_verde. Y que el modo oscuro solo fuera un toggle de la clase.
//Modo oscuro universal a todas las páginas: 
const videoFondo = document.getElementById('videoFondo');
const textoEnlaceModoOscuro = document.getElementById('modo-oscuro');
const elementosNavbar = document.getElementsByClassName('textoCabecera');
const textoCabecera = document.getElementById('logo');
var textoContacto = document.getElementsByClassName('textoContacto');
function modoOscuro() {
    // Verifica si el video actual contiene 'FondoIndexClaro.mp4' en su ruta
    if (videoFondo.src.includes('FondoIndexClaro.mp4')) {
        // Cambia el video a FondoIndexOscuro.mp4 si el modo claro está activo
        videoFondo.src = '../img/FondoIndexOscuro.mp4';
        textoEnlaceModoOscuro.textContent = "Modo Claro";
        // navbar.style.background = 'white';
        for (var i = 0; i < elementosNavbar.length; i++) {
            elementosNavbar[i].style.color = 'white';
        }
    } else if (videoFondo.src.includes('FondoSpotifyClaro.mp4')) {
        videoFondo.src = '../img/FondoSpotifyOscuro.mp4';
        textoEnlaceModoOscuro.textContent = "Modo Claro";
        for (var i = 0; i < elementosNavbar.length; i++) {
            elementosNavbar[i].style.color = 'white';
        }
    } else if (videoFondo.src.includes('FondoIndexOscuro.mp4')) {
        videoFondo.src = '../img/FondoIndexClaro.mp4';
        textoEnlaceModoOscuro.textContent = "Modo Oscuro";
        // navbar.style.background = 'black';
        for (var i = 0; i < elementosNavbar.length; i++) {
            elementosNavbar[i].style.color = 'black';
        }
    } else if (videoFondo.src.includes('FondoSpotifyOscuro.mp4')) {
        videoFondo.src = '../img/FondoSpotifyClaro.mp4';
        textoEnlaceModoOscuro.textContent = "Modo Oscuro";
        for (var i = 0; i < elementosNavbar.length; i++) {
            elementosNavbar[i].style.color = 'black';
        }
    }

}

