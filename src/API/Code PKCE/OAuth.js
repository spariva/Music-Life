// Step 1: Redirect the user to the authorization page
const client_id = 'YOUR_CLIENT_ID'; // Replace with your client id
const redirect_uri = 'YOUR_REDIRECT_URI'; // Replace with your redirect uri
const scopes = 'user-read-private user-read-email'; // Replace with your scopes

window.location.href = `https://accounts.spotify.com/authorize?response_type=code&client_id=${client_id}&scope=${encodeURIComponent(scopes)}&redirect_uri=${encodeURIComponent(redirect_uri)}`;

// Step 2: The user is redirected back to your application with the authorization code
// You need to extract this code from the URL

const url = new URL(window.location.href);
const code = url.searchParams.get('code');

// Step 3: Exchange the authorization code for an access token
const body = {
  grant_type: 'authorization_code',
  code: code,
  redirect_uri: redirect_uri
};

const res = await fetch('https://accounts.spotify.com/api/token', {
  method: 'POST',
  headers: {
    'Content-Type': 'application/x-www-form-urlencoded',
    'Authorization': 'Basic ' + btoa(client_id + ':' + client_secret) // client_secret is your client secret
  },
  body: new URLSearchParams(body)
});

const data = await res.json();
const access_token = data.access_token; // This is the access token