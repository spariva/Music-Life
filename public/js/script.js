
document.addEventListener('mousemove', function (e) {
    const onda = document.createElement('div');
    onda.className = 'efecto-agua';
    document.body.appendChild(onda);

    const rect = e.target.getBoundingClientRect();
    const x = e.clientX - rect.left;
    const y = e.clientY - rect.top;

    onda.style.left = x + 'px';
    onda.style.top = y + 'px';

    onda.addEventListener('animationend', function () {
        onda.remove();
    });
});

function modoOscuro() {
    var textoHTML = document.body;
    var textoCabecera = document.getElementById('header');
    textoHTML.style.color = 'white';
    textoCabecera.style.color = 'white';
}