console.log("scripts ok");

// Ejemplos
// https://open.spotify.com/embed/playlist/37i9dQZF1DX5Ejj0EkURtP?utm_source=generator
// https://open.spotify.com/embed/playlist/6lHivMtxlldZdqEvpwGRxZ?utm_source=generator
let consulta = document.getElementById('nombrePlaylist');
let iframeBuscador = document.getElementById('iframeBusqueda');
let botonBuscar = document.getElementById('botonBuscar');

// Manejo de Eventos
botonBuscar.addEventListener('click', buscarLista);

function buscarLista() {
    let contenidoIframe = consulta.value;
    let match = contenidoIframe.match(/src="(.*?)"/);

    if (match && match[1]) {
        let url = match[1];
        iframeBuscador.src = url;
    } else {
        console.error("No se pudo encontrar la URL en el atributo src del iframe.");
    }
}
