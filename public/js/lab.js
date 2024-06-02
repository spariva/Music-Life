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

/**-----------> Slider tempo */

let inpTempo = document.getElementById('tempo');
inpTempo.addEventListener('click', ()=>{
    let tempoValue = inpTempo.value;
    let tempoSpan = document.getElementById('valorTempo');
    tempoSpan.innerHTML = tempoValue;
});