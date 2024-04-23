// Realizar una solicitud fetch para obtener el token de acceso del servidor
fetch('/obtener_token_de_acceso.php')
  .then(response => response.json())
  .then(data => {
    const accessToken = data.access_token;

    // Ahora puedes usar accessToken para realizar llamadas a la API de Spotify
    fetch('https://api.spotify.com/v1/me/playlists', {
      headers: {
        'Authorization': `Bearer ${accessToken}`
      }
    })
    .then(response => response.json())
    .then(data => {
      // Manejar la respuesta de la API de Spotify
    })
    .catch(error => {
      // Manejar errores
    });
  })
  .catch(error => {
    // Manejar errores
  });
