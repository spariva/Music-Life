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



