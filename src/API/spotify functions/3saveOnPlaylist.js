// Authorization token that must have been created previously. See : https://developer.spotify.com/documentation/web-api/concepts/authorization
const token = '';
async function fetchWebApi(endpoint, method, body) {
  const res = await fetch(`https://api.spotify.com/${endpoint}`, {
    headers: {
      Authorization: `Bearer ${token}`,
    },
    method,
    body:JSON.stringify(body)
  });
  return await res.json();
}

const tracksUri = [
  'spotify:track:0VeFE61iZbxPsdpoxWb4lx','spotify:track:1ZreCbCSHpRcvqYpXlxnYC','spotify:track:1qpGMJi0ippCaMUOs7cz2q','spotify:track:75bgkdHdg7ppBcHdLJkSBM','spotify:track:23GeR1VGo3QHeS5UWQ5riO','spotify:track:2WceANzJsL37I31nEKeRva','spotify:track:0M55V4n7l0ULeYP64IcjX7','spotify:track:5EIkdrmuu2xkoQWOWjoeFY','spotify:track:16IzV3JdxmR3X10ZbWHlfB','spotify:track:3T6d5h1Gl5poxHXPsIb58D'
];

async function createPlaylist(tracksUri){
  const { id: user_id } = await fetchWebApi('v1/me', 'GET')

  const playlist = await fetchWebApi(
    `v1/users/${user_id}/playlists`, 'POST', {
      "name": "My recommendation playlist",
      "description": "Playlist created by the tutorial on developer.spotify.com",
      "public": false
  })

  await fetchWebApi(
    `v1/playlists/${playlist.id}/tracks?uris=${tracksUri.join(',')}`,
    'POST'
  );

  return playlist;
}

const createdPlaylist = await createPlaylist(tracksUri);
console.log(createdPlaylist.name, createdPlaylist.id);
