// Este código cambia el src de la url del iframe en la página de búsqueda de Spotify. Solo eso.
let consulta = document.getElementById('nombrePlaylist');
let iframeBuscador = document.getElementById('iframeBusqueda');
let botonBuscar = document.getElementById('botonBusca');

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
