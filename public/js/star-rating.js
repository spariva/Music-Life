// Selecciona todos los bloques de valoración
const valoraciones = document.querySelectorAll('.valoracionesBuscador');

valoraciones.forEach(valoracion => {
    const ratingDropdown = valoracion.querySelector('.ratingDropdown');
    const stars = valoracion.querySelectorAll('.star');
    const commentInput = valoracion.querySelector('.comment');
    const submitButton = valoracion.querySelector('.submit-button');
    const ratingValue = valoracion.querySelector('.rating-value');
    // const botonDesplegable = valoracion.querySelector('.botonDesplegable');
    const sectorComentarios = valoracion.querySelector('.listaComentarios');
    var selectedRating = null;

    if(valoracion.querySelector('.botonDesplegable')){
        const botonDesplegable = valoracion.querySelector('.botonDesplegable');
        botonDesplegable.addEventListener('click', () => {
            if (ratingDropdown.style.display === 'none' || ratingDropdown.style.display === '') {
                ratingDropdown.style.display = 'block';
            } else {
                ratingDropdown.style.display = 'none';
            }
        });
    }

    if(valoracion.querySelector('.btnsValoracion') || valoracion.querySelector('.editarValoracionCont')){
        let btnEdit = valoracion.parentNode.parentNode.querySelector('.btnEditarValoracion');
        if(btnEdit){
            btnEdit.addEventListener('click', (e)=>{
                if(e.target.matches('button') || e.target.matches('i')){
                    let ratingActual = valoracion.querySelector('.valoracionExistente').firstElementChild.textContent;
                    let indice = ratingActual.substring(0, 1);
                    console.log(indice);
                    selectedRating = indice;
                    updateRating();
                }
            });
        }  
    }

    

    stars.forEach((star, index) => {
        star.addEventListener('mouseover', () => {
            highlightStars(index);
        });

        star.addEventListener('mouseout', resetStars);

        star.addEventListener('click', () => {
            selectedRating = index + 1;
            updateRating();
        });
    });

    function highlightStars(index) {
        stars.forEach((star, i) => {
            if (i <= index) {
                star.classList.add('active');
            } else {
                star.classList.remove('active');
            }
        });
    }

    function resetStars() {
        stars.forEach(star => {
            star.classList.remove('active');
        });
    }

    function updateRating() {
        ratingValue.value = selectedRating;
        stars.forEach((star, i) => {
            if (i < selectedRating) {
                star.src = './img/star/EstrellaLlena.png';
            } else {
                star.src = './img/star/EstrellaVacia.png';
            }
        });
    }

    if(valoracion.querySelector('.botonDesplegable')){
        submitButton.addEventListener('click', () => {
            const comment = commentInput.value;
            if (selectedRating !== null && comment.trim() !== '') {
                ratingValue.textContent = ('¡Gracias por tu puntuación y comentario!');
                botonDesplegable.textContent = selectedRating + "/5 " + '\u2605';
                sectorComentarios.textContent = comment;
            } else {
                ratingValue.textContent = ('Por favor, selecciona una puntuación y escribe un comentario antes de enviar.');
            }
        });
    }
    
});
