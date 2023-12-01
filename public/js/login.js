const crearCuenta = document.getElementById('crearCuenta');
const conectarCuenta = document.getElementById('conectarCuenta');

crearCuenta.onclick = function(){
    body.classList.add('crearCuenta');
    videoFondo.src = './img/FondoSpotifyClaro.mp4';
}

conectarCuenta.onclick = function(){
    body.classList.remove('crearCuenta');
    videoFondo.src = './img/FondoIndexClaro.mp4';
}


const input2 = document.getElementById("miInput2");
const div2 = document.getElementById("miDiv2");


const inputs = document.querySelectorAll("input");

inputs.forEach(input => {
    input.addEventListener("focus", () => {
        input.style.backgroundColor = "lightblue";
    });
    input.addEventListener("blur", () => {
        input.style.backgroundColor = "white";
    });
});