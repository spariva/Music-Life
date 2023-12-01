function buscarPlaylist() {
    // Solicitar al usuario que ingrese un nombre para la playlist
    var nombrePlaylist = prompt("Por favor, ingrese un nombre para la playlist:");

    // Verificar si el usuario ingresó un nombre
    if (nombrePlaylist !== null && nombrePlaylist !== "") {
        // Enviar la información al servidor (puedes usar AJAX aquí)
        // Supongamos que estás usando jQuery para AJAX
        $.ajax({
            type: "POST",
            url: "guardar_playlist.php", // Reemplaza con la URL correcta del servidor
            data: {
                nombre: nombrePlaylist,
                enlace: document.getElementById("nombrePlaylist").value
            },
            success: function(response) {
                alert(response); // Muestra la respuesta del servidor (puedes personalizar el mensaje)
            }
        });
    } else {
        alert("Debe ingresar un nombre para la playlist.");
    }
}