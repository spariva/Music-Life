let btnsEditarValoracion = document.getElementsByClassName('btnEditarValoracion');
let btnEliminarValoracion = document.getElementsByClassName('btnEliminarValoracion');
let valoracionPreview = document.getElementsByClassName('verValoracion');

document.addEventListener('DOMContentLoaded', ()=>{
    
    for(let btnEdit of btnsEditarValoracion){
        btnEdit.addEventListener('click', (e)=>{
            console.log(e.target);
            if(e.target.matches('button')){
                let valoracionCont = e.target.parentNode.previousElementSibling.querySelector('.verValoracion');
                let score = valoracionCont.firstElementChild.textContent;
                let text = valoracionCont.lastElementChild.textContent;

                let editarValoracionCont = valoracionCont.nextElementSibling;
                let nuevoRating = editarValoracionCont.children[1];
                let inputNuevoRating = nuevoRating.children[3];
                let editarValoracion = editarValoracionCont.children[1];
                let inputEditarValoracion = editarValoracion.children[2].firstElementChild;
                inputNuevoRating.value = score.substring(0, 4);
                inputEditarValoracion.value = text;

                if(editarValoracionCont.classList.contains('ocultar')){
                    editarValoracionCont.classList.remove('ocultar');
                }
                
                inputNuevoRating.nextElementSibling.children[0].name = 'editar';

                valoracionCont.classList.add('ocultar');
                e.target.classList.add('ocultar');
                let btnCerrar = editarValoracionCont.children[0];

                btnCerrar.addEventListener('click', (ev)=>{
                    e.target.classList.remove('ocultar');
                    valoracionCont.classList.remove('ocultar');
                    editarValoracionCont.classList.add('ocultar');
                }); 
            }else if(e.target.matches('i')){
                let valoracionCont = e.target.parentNode.parentNode.previousElementSibling.querySelector('.verValoracion');
                let score = valoracionCont.firstElementChild.textContent;
                let text = valoracionCont.lastElementChild.textContent;

                let editarValoracionCont = valoracionCont.nextElementSibling;
                let nuevoRating = editarValoracionCont.children[1];
                let inputNuevoRating = nuevoRating.children[3];
                let editarValoracion = editarValoracionCont.children[1];
                let inputEditarValoracion = editarValoracion.children[2].firstElementChild;
                inputNuevoRating.value = score.substring(0, 4);
                inputEditarValoracion.value = text;

                if(editarValoracionCont.classList.contains('ocultar')){
                    editarValoracionCont.classList.remove('ocultar');
                }
                
                inputNuevoRating.nextElementSibling.children[0].name = 'editar';

                valoracionCont.classList.add('ocultar');
                e.target.parentNode.classList.add('ocultar');
                let btnCerrar = editarValoracionCont.children[0];

                btnCerrar.addEventListener('click', (ev)=>{
                    e.target.parentNode.classList.remove('ocultar');
                    valoracionCont.classList.remove('ocultar');
                    editarValoracionCont.classList.add('ocultar');
                }); 
            }
            
        });
    }
    for(let btnElim of btnEliminarValoracion){
        btnElim.addEventListener('click', (e)=>{
            if(e.target.matches('button')){
                let valoracionCont = e.target.parentNode.previousElementSibling.querySelector('.ratingBlock');
                let bElim = valoracionCont.querySelector('.submit-button');
                bElim.name = 'eliminar';
                bElim.click();
            }else if(e.target.matches('i')){
                let valoracionCont = e.target.parentNode.parentNode.previousElementSibling.querySelector('.ratingBlock');
                let bElim = valoracionCont.querySelector('.submit-button');
                bElim.name = 'eliminar';
                bElim.click();
            }
            
        });
    }




});

// function starRating(contenedor, indice){
//   let starContainer = contenedor.querySelector('.star');
//   for(let star of starContainer){
//     star.addEventListener('click', ()=>{
//         for(let i; i <= indice.length; i++){
//             starContainer[i].classList.add('')
//         }
//     })
//   }  
// }