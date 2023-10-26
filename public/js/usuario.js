//Colores aleatorios RGB
function generarColorAleatorio() {
    const r = Math.floor(Math.random() * 256);
    const g = Math.floor(Math.random() * 256);
    const b = Math.floor(Math.random() * 256);
    return `rgb(${r}, ${g}, ${b})`;
}

//Colores aleatorios para el bloque izquierdo
const bloqueIzq = document.getElementById('menuUsuario__izquierda');
bloqueIzq.style.background = `linear-gradient(45deg, ${generarColorAleatorio()}, ${generarColorAleatorio()})`;

//Colores aleatorios para el bloque derecho
//const bloqueDrch = document.getElementById('menuUsuario__derecha');
//bloqueDrch.style.background = `linear-gradient(45deg, ${generarColorAleatorio()}, ${generarColorAleatorio()})`;