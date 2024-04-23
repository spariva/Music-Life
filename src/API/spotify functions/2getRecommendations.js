// Authorization token that must have been created previously. See : https://developer.spotify.com/documentation/web-api/concepts/authorization
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

const topTracksIds = [
  '0VeFE61iZbxPsdpoxWb4lx','1qpGMJi0ippCaMUOs7cz2q','23GeR1VGo3QHeS5UWQ5riO','0M55V4n7l0ULeYP64IcjX7','16IzV3JdxmR3X10ZbWHlfB'
];

async function getRecommendations(){
  // Endpoint reference : https://developer.spotify.com/documentation/web-api/reference/get-recommendations
  return (await fetchWebApi(
    `v1/recommendations?limit=5&seed_tracks=${topTracksIds.join(',')}`, 'GET'
  )).tracks;
}

const recommendedTracks = await getRecommendations();
console.log(
  recommendedTracks.map(
    ({name, artists}) =>
      `${name} by ${artists.map(artist => artist.name).join(', ')}`
  )
);