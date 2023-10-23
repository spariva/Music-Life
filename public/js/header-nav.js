console.log("Scripts ok");

let usuarioMenu = document.getElementById("id-menu-usuario");
let lineaOculta = document.getElementById("user-linea");


function toggleMenu() {
    usuarioMenu.classList.toggle("open-menu-user");
    if(!usuarioMenu.classList.contains("open-menu-user")){
        lineaOculta.style.opacity = "0";
        lineaOculta.style.transition = "0s";
    } else {
        setTimeout(function() {
            lineaOculta.style.opacity = "1";
            lineaOculta.style.transition = "1s";
          }, 750); // (numero) -> milisegundos
    }
}

