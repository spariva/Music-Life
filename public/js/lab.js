/**-----------> Botones generos */
let inpGenero = document.getElementById('generos');
let arrGeneros = document.getElementsByClassName('genero-item');
let arrGenCopia = arrGeneros;
for(let genero of arrGeneros){
    genero.addEventListener('click', (e)=>{     
        let currentValues = inpGenero.value ? inpGenero.value.split(',') : [];
        let value = e.target.textContent.toLowerCase();

        if(currentValues.length < 5 && !currentValues.includes(value)){
            currentValues.push(value);
            inpGenero.value = currentValues.join(',');
        }

    });
}

function limpiarCadenaGenero(){
    let quitaComa = inpGenero.value.length - 1;
    let minusculas = inpGenero.value.toLowerCase();
    let cadenaFinal = minusculas.substring(0, quitaComa);
    inpGenero.value = cadenaFinal;
    console.log(cadenaFinal);
    return;
}

/**-----------> Colores aleatorios boton */

document.addEventListener('DOMContentLoaded', ()=>{
    // const buttons = document.querySelectorAll('.genero-item')
    for(let btn of arrGeneros){
        const greenShade = getRandomGreenShade();
        btn.style.backgroundColor = greenShade;
    }
});


function getRandomGreenShade(){
    const r = 200 + Math.floor(Math.random()*55);
    const g = 200 + Math.floor(Math.random()*55);
    const b = 200 + Math.floor(Math.random()*55);
    const color = `rgb(${r}, ${g}, ${b})`

    return color;
}

/**-----------> Slider tempo */

let inpTempo = document.getElementById('tempo');
inpTempo.addEventListener('click', ()=>{
    let tempoValue = inpTempo.value;
    let tempoSpan = document.getElementById('valorTempo');
    tempoSpan.innerHTML = tempoValue;
});

/**-----------> Boton info */

const btnInfo = document.getElementById('getInfo');
const infoModal = document.getElementById('info');
btnInfo.addEventListener('click', ()=>{
    infoModal.classList.toggle('ocultar');
});