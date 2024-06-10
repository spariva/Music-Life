/**-----------> Botones generos */
let inpGenero = document.getElementById('generos');
let arrGeneros = document.getElementsByClassName('genero-item');
let arrGenCopia = arrGeneros;
const btnEnviar = document.getElementById('btnEnviar');
for(let genero of arrGeneros){
    genero.addEventListener('click', (e)=>{     
        let currentValues = inpGenero.value ? inpGenero.value.split(',') : [];
        let value = e.target.textContent.toLowerCase();

        if(currentValues.length < 5 && !currentValues.includes(value)){
            currentValues.push(value);
            inpGenero.value = currentValues.join(',');
        }

    });
}

function limpiarCadenaGenero(){
    let quitaComa = inpGenero.value.length - 1;
    let minusculas = inpGenero.value.toLowerCase();
    let cadenaFinal = minusculas.substring(0, quitaComa);
    inpGenero.value = cadenaFinal;
    console.log(cadenaFinal);
    return;
}

/**-----------> Colores aleatorios boton */

document.addEventListener('DOMContentLoaded', ()=>{
    // const buttons = document.querySelectorAll('.genero-item')
    for(let btn of arrGeneros){
        const greenShade = getRandomGreenShade();
        btn.style.backgroundColor = greenShade;
    }
});


function getRandomGreenShade(){
    const r = 200 + Math.floor(Math.random()*55);
    const g = 200 + Math.floor(Math.random()*55);
    const b = 200 + Math.floor(Math.random()*55);
    const color = `rgb(${r}, ${g}, ${b})`

    return color;
}

/**-----------> Slider tempo */

let inpTempo = document.getElementById('tempo');
inpTempo.addEventListener('click', ()=>{
    let tempoValue = inpTempo.value;
    let tempoSpan = document.getElementById('valorTempo');
    tempoSpan.textContent = tempoValue;
    // tempoSpan.innerHTML = tempoValue;
});

/**-----------> Boton info */

const btnInfo = document.getElementById('getInfo');
const infoModal = document.getElementById('info');
btnInfo.addEventListener('click', ()=>{
    infoModal.classList.toggle('ocultar');
});

// let codeFlowToken;
// async function getAccessToken() {
//     codeFlowToken = document.cookie.split('; ').find(row => row.startsWith('labsToken')).split('=')[1];
//     console.log(codeFlowToken);
// }

// getAccessToken();
// console.log(codeFlowToken);

// async function fetchWebApi(endpoint, method, body = null) {
//     console.log(`Fetching data from API: ${endpoint}`);
//     try {
//         const res = await fetch(`https://api.spotify.com/${endpoint}`, {
//             headers: {
//                 Authorization: `Bearer ${codeFlowToken}`,
//             },
//             method,
//             body: body ? JSON.stringify(body) : null,
//         });

//         if (!res.ok) {
//             // Lanza un error si la respuesta no es exitosa
//             throw new Error(`API call failed with status: ${res.statusText}`);
//         }

//         return await res.json();
//     } catch (error) {
//         // Manejo de errores de la red o al llamar a la API
//         console.error("Error fetching data from API:", error);
//         return null;
//     }
// }

// async function getTopTracks() {
//     // Endpoint reference : https://developer.spotify.com/documentation/web-api/reference/get-users-top-artists-and-tracks
//     const response = await fetchWebApi('v1/me/top/tracks?time_range=long_term&limit=6', 'GET');
//     console.log(response.items);
//     return response.items;
// }

// async function getRecommendations(seedTracksIds) {
//     // Endpoint reference : https://developer.spotify.com/documentation/web-api/reference/get-recommendations
//     const response = await fetchWebApi(
//         `v1/recommendations?limit=9&seed_tracks=${seedTracksIds.join(',')}`, 'GET'
//     );
//     console.log(response.tracks);
//     return response.tracks;
// }

// async function createPlaylist(tracksUri) {
//     const { id: user_id } = await fetchWebApi('v1/me', 'GET')

//     const playlist = await fetchWebApi(
//         `v1/users/${user_id}/playlists`, 'POST', {
//         "name": "Music-Life Lab recommendations",
//         "description": "Playlist created in the Music-Life Lab",
//         "public": false
//     });

//     await fetchWebApi(
//         `v1/playlists/${playlist.id}/tracks`, 'POST', {
//         uris: tracksUri
//     });

//     return playlist;
// }

// async function generatePlaylist() {
//     const topTracks = await getTopTracks();
//     console.log(
//       topTracks?.map(
//         ({ name, artists }) =>
//           `${name} by ${artists.map(artist => artist.name).join(', ')}`
//       )
//     );
  
//     const topTracksIds = topTracks.map(track => track.id);
//     const recommendedTracks = await getRecommendations(topTracksIds);
//     console.log(
//       recommendedTracks.map(
//         ({ name, artists }) =>
//           `${name} by ${artists.map(artist => artist.name).join(', ')}`
//       )
//     );
  
//     const tracksUri = recommendedTracks.map(track => track.uri);
//     const createdPlaylist = await createPlaylist(tracksUri);
//     console.log(createdPlaylist.name, createdPlaylist.id);
  
//     document.getElementById('playlistContainer').innerHTML = `
//       <iframe
//         title="Spotify Embed: Recommendation Playlist"
//         src="https://open.spotify.com/embed/playlist/${createdPlaylist.id}?utm_source=generator&theme=0"
//         width="100%"
//         height="380"
//         frameBorder="0"
//         allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture"
//         loading="lazy"
//       ></iframe>`;
//   }
  
let codeFlowToken;

async function getAccessToken() {
    try {
        let token = document.cookie.split('; ').find(row => row.startsWith('labsToken'));
        if (!token) {
            throw new Error('Token not found');
        }
        codeFlowToken = token.split('=')[1];
        console.log('Token:', codeFlowToken);
    } catch (error) {
        console.error('Error getting token:', error);
    }
}

async function fetchWebApi(endpoint, method, body = null) {
    if (!codeFlowToken) {
        console.error('No token provided');
        return null;
    }

    try {
        const res = await fetch(`https://api.spotify.com/${endpoint}`, {
            headers: {
                Authorization: `Bearer ${codeFlowToken}`,
            },
            method,
            body: body ? JSON.stringify(body) : null,
        });
        if (!res.ok) {
            throw new Error(`API call failed with status: ${res.status}`);
        }
        return await res.json();
    } catch (error) {
        console.error("Error fetching data from API:", error);
        return null;
    }
}

async function getTopTracks() {
    const response = await fetchWebApi('v1/me/top/tracks?time_range=long_term&limit=6', 'GET');
    if (response && response.items) {
        console.log(response.items);
        return response.items;
    } else {
        console.error('Failed to fetch top tracks');
        return [];
    }
}

async function getRecommendations(seedTracksIds) {
    const response = await fetchWebApi(
        `v1/recommendations?limit=9&seed_tracks=${seedTracksIds.join(',')}`, 'GET'
    );
    if (response && response.tracks) {
        console.log(response.tracks);
        return response.tracks;
    } else {
        console.error('Failed to fetch recommendations');
        return [];
    }
}

async function createPlaylist(tracksUri) {
    const userResponse = await fetchWebApi('v1/me', 'GET');
    if (!userResponse || !userResponse.id) {
        console.error('Failed to fetch user info');
        return null;
    }

    const userId = userResponse.id;
    const playlistResponse = await fetchWebApi(
        `v1/users/${userId}/playlists`, 'POST', {
            "name": "Music-Life Lab recommendations",
            "description": "Playlist created in the Music-Life Lab",
            "public": false
        }
    );

    if (!playlistResponse || !playlistResponse.id) {
        console.error('Failed to create playlist');
        return null;
    }

    await fetchWebApi(
        `v1/playlists/${playlistResponse.id}/tracks`, 'POST', {
            uris: tracksUri
        }
    );

    return playlistResponse;
}

async function generatePlaylist() {
    await getAccessToken(); // Ensure token is obtained
    if (!codeFlowToken) {
        console.error('No valid token found');
        return;
    }

    const topTracks = await getTopTracks();
    if (topTracks.length === 0) {
        console.error('No top tracks available');
        return;
    }

    const topTracksIds = topTracks.map(track => track.id);
    const recommendedTracks = await getRecommendations(topTracksIds);
    if (recommendedTracks.length === 0) {
        console.error('No recommendations available');
        return;
    }

    const tracksUri = recommendedTracks.map(track => track.uri);
    const createdPlaylist = await createPlaylist(tracksUri);
    if (!createdPlaylist) {
        console.error('Playlist creation failed');
        return;
    }

    console.log(createdPlaylist.name, createdPlaylist.id);
    document.getElementById('playlistContainer').innerHTML = `
      <iframe
        title="Spotify Embed: Recommendation Playlist"
        src="https://open.spotify.com/embed/playlist/${createdPlaylist.id}?utm_source=generator&theme=0"
        width="100%"
        height="380"
        frameBorder="0"
        allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture"
        loading="lazy"
      ></iframe>`;
}


  btnEnviar.addEventListener('click', generatePlaylist);