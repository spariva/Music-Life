//Colores aleatorios RGB
function generarColorAleatorio() {
    const RED = Math.floor(Math.random() * 256);
    const GREEN = Math.floor(Math.random() * 256);
    const BLUE = Math.floor(Math.random() * 256);

    return `rgb(${RED}, ${GREEN}, ${BLUE})`;
}

function gradosColorAleatorio(){
    const GRADOS = Math.floor(Math.random() * 361);
    return `${GRADOS}deg`;
}

//Colores aleatorios para el bloque izquierdo
const bloqueIzq = document.getElementById('menuUsuario__izquierda');
bloqueIzq.style.background = `linear-gradient(${gradosColorAleatorio()}, ${generarColorAleatorio()},
                                                     ${generarColorAleatorio()},
                                                     ${generarColorAleatorio()})`;

//Colores aleatorios para el bloque derecho
//const bloqueDrch = document.getElementById('menuUsuario__derecha');
//bloqueDrch.style.background = `linear-gradient(45deg, ${generarColorAleatorio()}, ${generarColorAleatorio()})`;