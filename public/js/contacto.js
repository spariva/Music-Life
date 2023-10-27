
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

function modoOscuro() {
    // La idea es que cambie el video y texto a modo oscuro o claro 
    var videoElement = document.getElementById('videoFondo');
    var textoBotonModoOscuro = document.getElementById("modo-oscuro");
    var elementosNavbar = document.getElementsByClassName('textoCabecera');
    var textoCabecera = document.getElementById('logo');
    var textoContacto = document.getElementsByClassName('textoContacto');

    // Verifica si el video actual contiene 'FondoIndexClaro.mp4' en su ruta
    if (videoElement.src.includes('FondoIndexClaro.mp4')) {
        // Cambia el video a FondoIndexOscuro.mp4 si el modo claro está activo
        videoElement.src = '../img/FondoIndexOscuro.mp4';
        textoBotonModoOscuro.textContent = "Modo Claro";

        for (var i = 0; i < textoContacto.length; i++) {
         textoContacto[i].style.color = 'white';
         textoContacto[i].style.backgroundColor = 'rgba(0, 0, 0, 0.5)';

        }

        for (var i = 0; i < elementosNavbar.length; i++) {
            elementosNavbar[i].style.color = 'white';
        }
        textoCabecera.style.color = 'white';
    } else {
        // Cambia el video a FondoIndexClaro.mp4 si el modo oscuro está activo
        videoElement.src = '../img/FondoIndexClaro.mp4';
        textoBotonModoOscuro.textContent = "Modo Oscuro";

        // navbar.style.backgroundColor = 'black';
        //textoContenido.style.color='black';

        for (var i = 0; i < textoContacto.length; i++) {
             textoContacto[i].style.color = 'black';
         textoContacto[i].style.backgroundColor = 'rgba(255, 255, 255, 0.5)';
        }

        for (var i = 0; i < elementosNavbar.length; i++) {
            elementosNavbar[i].style.color = 'black';
        }
        textoCabecera.style.color = 'black';
    }


}