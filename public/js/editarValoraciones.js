let btnsEditarValoracion = document.getElementsByClassName('btnEditarValoracion');
// console.log(document.querySelector('.verValoracion'));
document.addEventListener('DOMContentLoaded', ()=>{
    for(let btnEdit of btnsEditarValoracion){
        btnEdit.addEventListener('click', (e)=>{
            let valoracionCont = e.target.parentNode.previousElementSibling.querySelector('.verValoracion');
            let score = valoracionCont.firstElementChild.textContent;
            let text = valoracionCont.lastElementChild.textContent;
            console.log(valoracionCont, score, text);
            // btnEdit.childNodes
            let editarValoracionCont = valoracionCont.nextElementSibling.firstElementChild;
            let nuevoRating = editarValoracionCont.children[3];
            let editarValoracion = editarValoracionCont.children[2].firstElementChild;
            nuevoRating.value = score.substring(0, 4);
            // nuevoRating.value = score;
            editarValoracion.value = text;
            // querySelector("input[name='nuevoRating']")
            // querySelector("input[name='nuevaValoracion']")
            valoracionCont.classList.toggle('ocultar');
            editarValoracionCont.parentNode.classList.toggle('ocultar');

        });
    }
});
