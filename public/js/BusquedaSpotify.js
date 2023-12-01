console.log("scripts ok");

// Ejemplos
// https://open.spotify.com/embed/playlist/37i9dQZF1DX5Ejj0EkURtP?utm_source=generator
// https://open.spotify.com/embed/playlist/6lHivMtxlldZdqEvpwGRxZ?utm_source=generator

let consulta = document.querySelector('.inputBuscador');
let iframeBuscador = document.querySelector('.iframeBuscador');
let botonBuscar = document.querySelector('.boton__buscar');

// Manejo de Eventos
botonBuscar.addEventListener('click', buscarLista);

function buscarLista() {
    try {
        // Obtener el valor del input
        var iframeCode = consulta.value;

        // Patrón de expresión regular para extraer la URL entre src=" y "
        var pattern = /src="(.*?)"/;
        var matches = iframeCode.match(pattern);

        // Extraer la URL y almacenarla en la variable txt
        if (matches && matches[1]) {
            var txt = matches[1];
            console.log('Texto extraído: ' + txt);

            // Establecer la URL en el segundo iframe
            iframeBuscador.src = txt;
        } else {
            console.log('No se pudo extraer el texto.');
        }
    } catch (error) {
        console.error('Error al buscar la lista:', error.message);
    }
}