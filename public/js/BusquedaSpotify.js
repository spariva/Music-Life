console.log("scripts ok");
//ejemplos
// https://open.spotify.com/embed/playlist/37i9dQZF1DX5Ejj0EkURtP?utm_source=generator
// https://open.spotify.com/embed/playlist/6lHivMtxlldZdqEvpwGRxZ?utm_source=generator
let consulta = document.querySelector('.inputBuscador');
let iframeBuscador = document.querySelector('.iframeBuscador');
//let barraBusqueda = document.getElementById('barraBusqueda');

function buscarLista() {
    let url = consulta.value;
    iframeBuscador.src = url;

    // Comentar las dos lineas de arriba si se quiere probar el metodo buscando por album
    // let url = "https://open.spotify.com/embed?uri=spotify:album:"+consulta.value;
    // iframeBuscador.src = url;
}
