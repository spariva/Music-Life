window.onload = function() {
    const body = document.body;
    const videoFondo = document.getElementById('videoFondo');
    const crearCuenta = document.getElementById('crearCuenta');
    const conectarCuenta = document.getElementById('conectarCuenta');
    // si tiene que mostrar errores del SignUp
    // var urlSignUp = new URLSearchParams(window.location.search);

    // // Get the value of the 'errorSignUp' parameter, null si no existe, y el valor que ponga si existe 
    // var signUp = urlSignUp.get('errorSignUp');
    // console.log(signUp);
    // if (signUp != null) {
    //     console.log(' signUp');
    // } else {
    //     console.log('null signUp');
    // }
    
    function changeToCrearCuenta() {
        body.classList.add('crearCuenta');
        videoFondo.src = './img/FondoSpotifyClaro.mp4';
    }
    
    // if (signUp=='yes') {
    //     console.log('entra');
    //     changeToCrearCuenta();
    // }

    crearCuenta.onclick = changeToCrearCuenta;
    
    conectarCuenta.onclick = function(){
        body.classList.remove('crearCuenta');
        videoFondo.src = './img/FondoIndexClaro.mp4';
    }
};

document.addEventListener('DOMContentLoaded', function() {
    const forgotPasswordLink = document.getElementById('forgotPasswordLink');
    const closeModalButton = document.getElementById('closeModal');
    const loginForm = document.getElementById('inicioSesion');
    const recoverForm = document.getElementById('recuperarPSWD');

    forgotPasswordLink.addEventListener('click', function(event) {
        event.preventDefault();
        loginForm.style.display = 'none';
        recoverForm.style.display = 'flex';
    });

    closeModalButton.addEventListener('click', function() {
        recoverForm.style.display = 'none';
        loginForm.style.display = 'flex';
    });
});

