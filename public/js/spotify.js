function modoOscuro() {
    // La idea es que cambie el video y texto a modo oscuro o claro 
    var videoElement = document.getElementById('videoFondo');
    var textoBotonModoOscuro = document.getElementById('modo-oscuro');
    var elementosNavbar = document.getElementsByClassName('textoCabecera');
    var textoCabecera = document.getElementById('logo');
    var textoSpotify = document.getElementsByClassName('textoSpotify');
    var formaSpotify = document.getElementsByClassName('formaSpotify');

    // TODO: esta clase solo se implementa modo oscuro aqui falta en el index y mas abajo se cambia color
    //var textoContenido = document.getElementsById('cabecera');
    // var navbar = document.querySelector('.navbar'); 

    // Verifica si el video actual contiene 'FondoIndexClaro.mp4' en su ruta
    if (videoElement.src.includes('FondoSpotifyClaro.mp4')) {
        // Cambia el video a FondoIndexOscuro.mp4 si el modo claro está activo
        videoElement.src = '../img/FondoSpotifyOscuro.mp4';
        textoBotonModoOscuro.textContent = "Modo Claro";
        //textoContenido.style.color='white';

        // navbar.style.backgroundColor = 'white';

        for (var i = 0; i < textoSpotify.length; i++) {
            textoSpotify[i].style.color = 'white';
        }

        for (var i = 0; i < formaSpotify.length; i++) {
            formaSpotify[i].style.backgroundColor = 'rgba(0, 0, 0, 0.5)';
        }

        for (var i = 0; i < elementosNavbar.length; i++) {
            elementosNavbar[i].style.color = 'white';
        }
        textoCabecera.style.color = 'white';
    } else {
        // Cambia el video a FondoIndexClaro.mp4 si el modo oscuro está activo
        videoElement.src = '../img/FondoSpotifyClaro.mp4';
        textoBotonModoOscuro.textContent = "Modo Oscuro";

        // navbar.style.backgroundColor = 'black';
        //textoContenido.style.color='black';

        for (var i = 0; i < textoSpotify.length; i++) {
            textoSpotify[i].style.color = 'black';
        }

        for (var i = 0; i < formaSpotify.length; i++) {
            formaSpotify[i].style.backgroundColor = 'rgba(255, 255, 255, 0.5)';
        }

        for (var i = 0; i < elementosNavbar.length; i++) {
            elementosNavbar[i].style.color = 'black';
        }
        textoCabecera.style.color = 'black';
    }


}