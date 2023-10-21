//Lo hago en un documento separado de momento por si acaso estalla =)

//curl -X POST "https://accounts.spotify.com/api/token" \
//     -H "Content-Type: application/x-www-form-urlencoded" \
//    -d "grant_type=client_credentials&client_id=your-client-id&client_secret=your-client-secret"


const client_id = '4de4fa87f6bf4fe590898df01899950c'; // Nuestro id para conectar con la API, puede que luego tengamos que hacerlo global.
//El id secret, ni idea: 'ef5034e62f224d1688b16f4cbabcf894




//PKCE flow (recomendado para aplicaciones de escritorio y móviles). Es más seguro que el Authorization Code Flow. Y complicado
//Code verifier:
function generateRandomString(length) {
    let text = '';
    let possible = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
  
    for (let i = 0; i < length; i++) {
      text += possible.charAt(Math.floor(Math.random() * possible.length));
    }
    return text;
  }
  
  //Para transformar el código en base64 y encodearlo:
  const digest = await window.crypto.subtle.digest('SHA-256', data);

  async function generateCodeChallenge(codeVerifier) {
    function base64encode(string) {
      return btoa(String.fromCharCode.apply(null, new Uint8Array(string)))
        .replace(/\+/g, '-')
        .replace(/\//g, '_')
        .replace(/=+$/, '');
    }
  
    const encoder = new TextEncoder();
    const data = encoder.encode(codeVerifier);
    const digest = await window.crypto.subtle.digest('SHA-256', data);
  
    return base64encode(digest);
  }
  