// Authorization token that must have been created previously. See : https://developer.spotify.com/documentation/web-api/concepts/authorization o sea este token es el de mi cuenta, lo que tendría que ser es que el usuario se loguee con su cuenta y se cree un token para esa cuenta. 
const token = 'BQDQIIrWo0NTCe98Ca86e9ndSRirfJps-3z8ownhfy-Bc8W-auCd6nqHd15sQA1SC6xVt2L1oWZUqRc2Os9PLdNMaV4-DnK947zFASGXzvDFMqubnwAOGj_x0i6kmhHMfLhIFwCwuNsx3aCkZI62m1-2TSus_0Kf1fYWtEaMFFPNaz63Cym-xsOu0_SEDRLhJlDUpULR6QVrfaxovZTCoUxty01ki0W9umgpjYXbxAYsfYCOjgM41F3P2AYr-7dxGQ';
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

async function getTopTracks(){
  // Endpoint reference : https://developer.spotify.com/documentation/web-api/reference/get-users-top-artists-and-tracks
  return (await fetchWebApi(
    'v1/me/top/tracks?time_range=long_term&limit=5', 'GET'
  )).items;
}

const topTracks = await getTopTracks();
console.log(
  topTracks?.map(
    ({name, artists}) =>
      `${name} by ${artists.map(artist => artist.name).join(', ')}`
  )
);