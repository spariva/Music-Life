// Este es el ejemplo básico, sin OAuth2.0, de cómo obtener un token de acceso para la API de Spotify. Y usarlo para hacer peticiones a la API de Spotify.

//Para implementar el .env y sustituir el cliente_id y el cliente_secret, se puede hacer de la siguiente manera:
const client_id = process.env.CLIENT_ID;
const client_secret = process.env.CLIENT_SECRET;

async function getToken() {
  const response = await fetch('https://accounts.spotify.com/api/token', {
    method: 'POST',
    body: new URLSearchParams({
      'grant_type': 'client_credentials',
    }),
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded',
      'Authorization': 'Basic ' + (Buffer.from(client_id + ':' + client_secret).toString('base64')),
    },
  });

  return await response.json();
}

//diferencia:
// The code you've selected is similar to the previous code in that it's also used to interact with the Spotify Web API to retrieve an access token. However, there are a few key differences:

// Use of var instead of const: In this code, var is used to declare client_id and client_secret, whereas const was used in the previous code. var is function-scoped and can be redeclared, while const is block-scoped and cannot be redeclared.

// Use of request library: This code uses the request library to make HTTP requests, whereas the previous code uses the fetch API. The request library is a popular, feature-rich HTTP client for Node.js, but it has been deprecated.

// Callback instead of async/await: This code uses a callback function to handle the HTTP response, whereas the previous code uses the async/await syntax. Callbacks are a way of handling asynchronous operations in JavaScript, but they can lead to "callback hell" if not managed properly. async/await is a newer syntax that makes asynchronous code look and behave more like synchronous code, which can make it easier to understand and manage.

// Use of new Buffer.from: This code uses new Buffer.from to create a new Buffer and encode the client credentials in base64 format. The previous code uses Buffer.from without the new keyword. Both are correct, but new Buffer.from is unnecessary because Buffer.from is a static method that creates a new Buffer instance, so it doesn't need to be called as a constructor with new.

// No function encapsulation: The previous code encapsulates the token retrieval logic in an async function called getToken(), but this code does not. This means that the token retrieval process starts as soon as this script is run, whereas in the previous code, the process doesn't start until getToken() is called.

// No use of the token: In the previous code, the token is used to make another API request. In this code, the token is assigned to a variable, but then nothing is done with it.
async function getTrackInfo(access_token) {
  const response = await fetch("https://api.spotify.com/v1/tracks/4cOdK2wGLETKBW3PvgPWqT", {
    method: 'GET',
    headers: { 'Authorization': 'Bearer ' + access_token },
  });

  return await response.json();
}

getToken().then(response => {
  getTrackInfo(response.access_token).then(profile => {
    console.log(profile)
  })
});

var client_id = 'CLIENT_ID';
var client_secret = 'CLIENT_SECRET';

var authOptions = {
  url: 'https://accounts.spotify.com/api/token',
  headers: {
    'Authorization': 'Basic ' + (new Buffer.from(client_id + ':' + client_secret).toString('base64'))
  },
  form: {
    grant_type: 'client_credentials'
  },
  json: true
};

request.post(authOptions, function(error, response, body) {
  if (!error && response.statusCode === 200) {
    var token = body.access_token;
  }
});
