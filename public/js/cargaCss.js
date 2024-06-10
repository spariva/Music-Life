/**----------> Carga de css*/
let head = document.head;

/**Se comprueba la url de la página que acabamos de cargar
 * y se va añadiendo al head el css correspondiente
 */
if(window.location.href.includes('spotifyLab')){
    console.log('hola');
    head.innerHTML += `
    <link rel="stylesheet" type="text/css" href="./css/nuevocss.css">
    <link rel="stylesheet" type="text/css" href="./css/spotify-lab.css">
    `;
}else if(window.location.href.includes('index') || window.location.href === 'music-lifes.es'){
    head.innerHTML += `
    <link rel="stylesheet" type="text/css" href="./css/nuevocss.css">
    <link rel="stylesheet" type="text/css" href="./css/star-rating.css">
    `;
}else if(window.location.href.includes('login')){
    head.innerHTML += `
    <link rel="stylesheet" href="./css/login.css">
    `;
}else if(window.location.href.includes('login')){
    head.innerHTML += `
    <link rel="stylesheet" href="./css/login.css">
    `;
}else if(window.location.href.includes('usuario')){
    head.innerHTML += `
    <link rel="stylesheet" href="./css/usuario.css">
    <link rel="stylesheet" type="text/css" href="./css/star-rating.css">
    `;
}else if(window.location.href.includes('contacto')){
    head.innerHTML += `
    <link rel="stylesheet" href="./css/contacto.css">
    `;
}