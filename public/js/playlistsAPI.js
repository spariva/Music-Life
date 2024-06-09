document.addEventListener('DOMContentLoaded', (event) => {
    const searchButton = document.getElementById('botonBuscar')
    const inputBusqueda = document.getElementById('inputBusqueda');
    const iframeBuscador = document.getElementById('iframeBusqueda');
    let accessToken;

    async function getAccessToken() {
        //accede al $_SESSION['access_token'] de PHP o a la cookie de nombre indexToken
        accessToken = document.cookie.split('; ').find(row => row.startsWith('indexToken')).split('=')[1];
        console.log(accessToken);
    }

    // async function getAccessToken() {
    //     const authParams = new URLSearchParams({
    //         grant_type: 'client_credentials',
    //         client_id: '',
    //         client_secret: '',
    //     });

    //     const response = await fetch('https://accounts.spotify.com/api/token', {
    //         method: 'POST',
    //         headers: {
    //             'Content-Type': 'application/x-www-form-urlencoded',
    //         },
    //         body: authParams,
    //     });
    //     const data = await response.json();
    //     accessToken = data.access_token;
    // }

    // Función para buscar artista y obtener sus álbumes
    async function search() {
        const searchInput = inputBusqueda.value;
        const artistParams = {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                Authorization: `Bearer ${accessToken}`,
            },
        };

        // Obtener listado de playlists
        const artistResponse = await fetch(
            `https://api.spotify.com/v1/search?q=${searchInput}&type=playlist&limit=3`,
            artistParams
        );
        const playlistsArray = await artistResponse.json();
        console.log(playlistsArray);

        // Check if playlists and items exist and are not empty
        if (!playlistsArray.playlists || !playlistsArray.playlists.items || playlistsArray.playlists.items.length === 0) {
            alert('No se encontraron playlists');
            return;
        }

        const playlistID = playlistsArray.playlists.items[0].id;
        console.log(playlistID);

        swapIframe(playlistID);
    }

    function swapIframe(playlistID) {
        iframeBuscador.src = `https://open.spotify.com/embed/playlist/${playlistID}`;
    }

    // Obtener el token de acceso al cargar la página
    getAccessToken();

    // Añadir evento de búsqueda al botón
    searchButton.addEventListener('click', async () => {
        await search();
    });

    // Añadir evento de búsqueda al presionar Enter
    inputBusqueda.addEventListener('keydown', async (event) => {
        if (event.key === 'Enter') {
            event.preventDefault();
            await search();
        }
    });
});