console.log("scripts ok");

let consulta = document.querySelector('.inputBuscador');
let iframeBuscador = document.querySelector('.iframeBuscador');

function buscarLista() {
    let url = consulta.value;
    iframeBuscador.src = url;

    // Comentar las dos lineas de arriba si se quiere probar el metodo buscando por album
    // let url = "https://open.spotify.com/embed?uri=spotify:album:"+consulta.value;
    // iframeBuscador.src = url;
}
