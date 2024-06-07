const searchButton = document.getElementById('botonBuscar')

async function getAccessToken() {
    const authParams = new URLSearchParams({
        grant_type: 'client_credentials',
        client_id: '',
        client_secret: '',
    });

    const response = await fetch('https://accounts.spotify.com/api/token', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: authParams,
    });
    console.log(response);
    const data = await response.json();
    accessToken = data.access_token;
    console.log(accessToken);
}

// Función para buscar artista y obtener sus álbumes
async function search() {
    alert('Buscando...');
    const searchInput = document.getElementById('urlPlaylist').value;
    const artistParams = {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            Authorization: `Bearer ${accessToken}`,
        },
    };

    // Obtener el ID del artista
    const artistResponse = await fetch(
        `https://api.spotify.com/v1/search?q=${searchInput}&type=playlist&limit=3`,
        artistParams
    );
    const artistData = await artistResponse.json();
    const artistID = artistData.artists.items[0].id;

    // Obtener los álbumes del artista
    const albumsResponse = await fetch(
        `https://api.spotify.com/v1/artists/${artistID}/albums?include_groups=album&market=US&limit=5`,
        artistParams
    );
    const albumsData = await albumsResponse.json();

    displayAlbums(albumsData.items);
}

// Función para mostrar los álbumes en el DOM
function displayAlbums(albums) {
    const albumContainer = document.getElementById('album-container');
    albumContainer.innerHTML = ''; // Limpiar contenido previo

    albums.forEach((album) => {
        const albumCard = document.createElement('div');
        albumCard.className = 'card';

        const albumImg = document.createElement('img');
        albumImg.className = 'card-img';
        albumImg.src = album.images[0].url;

        const cardBody = document.createElement('div');
        cardBody.className = 'card-body';

        const cardTitle = document.createElement('h5');
        cardTitle.className = 'card-title';
        cardTitle.textContent = album.name;

        const cardText = document.createElement('p');
        cardText.className = 'card-text';
        cardText.innerHTML = `Release Date: <br> ${album.release_date}`;

        const cardButton = document.createElement('a');
        cardButton.className = 'card-button';
        cardButton.href = album.external_urls.spotify;
        cardButton.textContent = 'Album Link';

        cardBody.appendChild(cardTitle);
        cardBody.appendChild(cardText);
        cardBody.appendChild(cardButton);

        albumCard.appendChild(albumImg);
        albumCard.appendChild(cardBody);

        albumContainer.appendChild(albumCard);
    });
}

// Obtener el token de acceso al cargar la página
getAccessToken();

// Añadir evento de búsqueda al botón
searchButton.addEventListener('click', search);

// Añadir evento de búsqueda al presionar Enter
searchButton.addEventListener('keydown', (event) => {
    if (event.key === 'Enter') {
        search();
    }
});