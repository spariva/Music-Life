console.log("scripts ok");

// Ejemplos
// https://open.spotify.com/embed/playlist/37i9dQZF1DX5Ejj0EkURtP?utm_source=generator
// https://open.spotify.com/embed/playlist/6lHivMtxlldZdqEvpwGRxZ?utm_source=generator
let consulta = document.getElementById('nombrePlaylist');
let iframeBuscador = document.getElementById('iframeBusqueda');
const botonBusqueda = document.getElementById('botonBusqueda');

function buscarLista1() {
    let url = consulta.value;
    iframeBuscador.src = url;
}

botonBusqueda.addEventListener('click', buscarLista1);



function buscarLista() {
    try {
        // Obtener el valor del input
        var url = consulta.value;

        // Patrón de expresión regular para extraer la URL entre src=" y "
        var pattern = /src="(.*?)"/;
        var matches = url.match(pattern);

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

// Manejo de Eventos
// botonBuscar.addEventListener('click', buscarLista);