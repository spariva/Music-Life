//Lo hago en un documento separado de momento por si acaso estalla =)

//curl -X POST "https://accounts.spotify.com/api/token" \
//     -H "Content-Type: application/x-www-form-urlencoded" \
//    -d "grant_type=client_credentials&client_id=your-client-id&client_secret=your-client-secret"








//PKCE flow (recomendado para aplicaciones de escritorio y móviles)
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
  