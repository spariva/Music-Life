function sanitizeInput(input){
    const arrSpecialChars = {
        '<': '&lt;',
        '>': '&gt;',
        '&': '&amp;',
        '"': '&quot;',
        "'": '&#x27;',
        "/": '&#x2F;'
    };
    const reg = /[<>&"'\/]/ig;
    return input.replace(reg, (match) => (arrSpecialChars[match]));
}

function sanitizeFormFields(form){
    const inputs = form.querySelectorAll('input');
    inputs.forEach(input =>{
        input.value = sanitizeInput(input.value);
        console.log(input.value);
    });
    const textarea = form.querySelectorAll('textarea');
    textarea.forEach(ta =>{
        ta.value = sanitizeInput(ta.value);
        console.log(ta.value);
    });
}

// let formularios = document.getElementsByTagName('form');
// for(let formulario of formularios){
//     formulario.addEventListener('submit', ()=>{
//         e.preventDefault();
//         sanitizeFormFields(this);
//         console.log(document.querySelectorAll('input', 'textarea'));
//     });
// }