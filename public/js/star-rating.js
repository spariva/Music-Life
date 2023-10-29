function toggleRating() {
    const ratingDropdown = document.getElementById('ratingDropdown');
    if (ratingDropdown.style.display === 'none' || ratingDropdown.style.display === '') {
        ratingDropdown.style.display = 'block';
    } else {
        ratingDropdown.style.display = 'none';
    }
}

const stars = document.querySelectorAll('.star');
const commentInput = document.getElementById('comment');
const submitButton = document.getElementById('submit-button');
const ratingValue = document.getElementById('rating-value');
const botonDesplegable = document.getElementById('botonDesplegable');

var selectedRating = null;

stars.forEach((star, index) => {
    star.addEventListener('mouseover', () => {
        //si el raton se posa en el objeto llamamos a la funcion highlitStar
        highlightStars(index);
    });

    star.addEventListener('mouseout', () => {
        resetStars();
    });

    star.addEventListener('click', () => {
        selectedRating = index + 1;
        updateRating();
    });
});

function highlightStars(index) {
    stars.forEach((star, i) => {
        if (i <= index) {
            //Añade la clase active a los elementos 
            star.classList.add('active');
        } else {
            star.classList.remove('active');
        }
    });
}

function resetStars() {
    stars.forEach(star => {
        //O la elimina
        star.classList.remove('active');
    });
}

function updateRating() {
    // Marcar la estrella marcada y las anteriores
    stars.forEach((star, i) => {
        if (i < selectedRating) {
            star.src = '../img/star/EstrellaLlena.png';
        } else {
            star.src = '../img/star/EstrellaVacia.png';
        }
    });
}

submitButton.addEventListener('click', () => {
    const comment = commentInput.value;
    if (selectedRating !== null && comment.trim() !== '') {
        // Guardamos la puntuacion y el comentario
        ratingValue.textContent = ('¡Gracias por tu puntuación y comentario!');
        botonDesplegable.textContent = selectedRating + "/5 " + '\u2605';

    } else {
        ratingValue.textContent = ('Por favor, selecciona una puntuación y escribe un comentario antes de enviar.');
    }
});

