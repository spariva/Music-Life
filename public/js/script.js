
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

// function modoOscuro() {
//     // La idea es que cambie el video a modo oscruo
//     var videoElement = document.getElementById('videoFondo');

//     // Verifica si el video actual contiene 'FondoIndexClaro.mp4' en su ruta
//     if (videoElement.src.includes('FondoIndexClaro.mp4')) {
//         // Cambia el video a FondoIndexOscuro.mp4 si el modo claro está activo
//         videoElement.src = '../img/FondoIndexOscuro.mp4';
//     } else {
//         // Cambia el video a FondoIndexClaro.mp4 si el modo oscuro está activo
//         videoElement.src = '../img/FondoIndexClaro.mp4';
//     }

//     // var textoHTML = document.body;
//     // var textoCabecera = document.getElementById('header');
//     // textoHTML.style.color = 'white';
//     // textoCabecera.style.color = 'white';
// }
