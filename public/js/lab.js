/**-----------> Botones generos */
let inpGenero = document.getElementById('generos');
let arrGeneros = document.getElementsByClassName('genero-item');
let arrGenCopia = arrGeneros;
const btnEnviar = document.getElementById('btnEnviar');
for(let genero of arrGeneros){
    genero.addEventListener('click', (e)=>{     
        let currentValues = inpGenero.value ? inpGenero.value.split(',') : [];
        let value = e.target.textContent.toLowerCase();

        if(currentValues.length < 2 && !currentValues.includes(value)){
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
    console.log(tempoValue);
});

/**-----------> Boton info */
const btnInfo = document.getElementById('getInfo');
const infoModal = document.getElementById('info');
btnInfo.addEventListener('click', ()=>{
    infoModal.classList.toggle('ocultar');
});

/**-----------> API */
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
    const response = await fetchWebApi('v1/me/top/tracks?time_range=long_term&limit=3', 'GET');
    if (response && response.items) {
        console.log(response.items);
        return response.items;
    } else {
        console.error('Failed to fetch top tracks');
        return [];
    }
}

async function getRecommendations(seedTracksIds, seedGenres, targetEnergy) {
 
    let endpoint = `v1/recommendations?limit=15`;
    
    if (seedGenres && seedGenres.length > 0) {
        endpoint += `&seed_genres=${encodeURIComponent(seedGenres.join(','))}`;
    }
    
    if (Array.isArray(seedTracksIds) && seedTracksIds.length != 0) {
        endpoint += `&seed_tracks=${encodeURIComponent(seedTracksIds.join(','))}`;
    }

    if (targetEnergy) {
        endpoint += `&target_energy=${targetEnergy}`;
    }
    
    const response = await fetchWebApi(endpoint, 'GET');
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
    let playlistName = document.getElementById('playlistName').value;
    console.log('playlistName:', playlistName);
    const userId = userResponse.id;
    const playlistResponse = await fetchWebApi(
        `v1/users/${userId}/playlists`, 'POST', {
            "name": playlistName || "Music-Life Lab",
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
    console.log('generando playlist');
    await getAccessToken(); // Ensure token is obtained
    if (!codeFlowToken) {
        console.error('No valid token found');
        return;
    }
    console.log('token bien');
    
    const topTracks = await getTopTracks();
    if (topTracks.length === 0) {
        console.error('No top tracks available');
        return;
    }
    console.log('topTracks bien');

    const topTracksIds = topTracks.map(track => track.id);
    if (!Array.isArray(topTracksIds) || topTracksIds.length === 0) {
        console.error('No valid top tracks IDs');
        return;
    }
    console.log('topTracksIds:', topTracksIds);

    let seedGenres = inpGenero.value ? inpGenero.value.split(',') : null;
    let targetEnergy = inpTempo.value ? parseFloat(inpTempo.value) : null;

    // const recommendedTracks = await getRecommendations(topTracksIds, seedGenres, targetEnergy);
    // if (recommendedTracks.length === 0) {
    //     console.error('No recommendations available');
    //     return;
    // }
    // console.log('recomendaciones bien');

    const tracksUri = topTracksIds.map(track => track.uri);
    const createdPlaylist = await createPlaylist(tracksUri);
    if (!createdPlaylist) {
        console.error('Playlist creation failed');
        return;
    }
    console.log('playlist creada bien');
    console.log(createdPlaylist.name, createdPlaylist.id);

    document.getElementById('playlistContainer').innerHTML = `
      <iframe
        title="Spotify Embed: Recommendation Playlist"
        src="https://open.spotify.com/embed/playlist/${createdPlaylist.id}?utm_source=generator&theme=1"
        width="100%"
        height="380"
        frameBorder="0"
        allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture"
        loading="lazy"
      ></iframe>`;
}

btnEnviar.addEventListener('click', generatePlaylist);

// https://api.spotify.com/v1/recommendations?seed_artists=4NHQUGzhtTLFvgF5SZesLK&seed_genres=classical%2Ccountry&seed_tracks=0c6xIDDpzE81m2q797ordA

// https://api.spotify.com/v1/recommendations?seed_genres=classical%2Ctechno&seed_tracks=0c6xIDDpzE81m2q797ordA%2CC0nLMjIuOsMjEq4IKuJ2twa%2C57dlsdCfq4XUf2AvIMk1jS&target_tempo=0.85

// https://api.spotify.com/v1/recommendations?limit=15&seed_genres=jazz%2Cindie%2Crock&seed_tracks=5lxZ3KmRdRn6iW5tE1Fwjp%2C5tMLIgw6yxobsAyIVvfHo5%2C0GdiWLQt5VYtMEcero6AOW%2C0nLMjIuOsMjEq4IKuJ2twa%2C57dlsdCfq4XUf2AvIMk1jS&target_energy=0.75


// https://api.spotify.com/v1/recommendations?seed_genres=classical%2Ctechno&seed_tracks=%275lxZ3KmRdRn6iW5tE1Fwjp%27%2C+%275tMLIgw6yxobsAyIVvfHo5%27%2C+%270GdiWLQt5VYtMEcero6AOW%27%2C+%270nLMjIuOsMjEq4IKuJ2twa%27%2C+%2757dlsdCfq4XUf2AvIMk1jS%27&target_tempo=0.85

// https://api.spotify.com/v1/recommendations?seed_genres=classical%2Cindie&seed_tracks=5lxZ3KmRdRn6iW5tE1Fwjp%2C5tMLIgw6yxobsAyIVvfHo5%2C0GdiWLQt5VYtMEcero6AOW%2C0nLMjIuOsMjEq4IKuJ2twa%2C57dlsdCfq4XUf2AvIMk1jS

