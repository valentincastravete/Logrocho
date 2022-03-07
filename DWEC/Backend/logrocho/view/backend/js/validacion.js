function validacion() {
    let campos = document.getElementsByClassName("campo");
    Array.prototype.slice.call(campos)
        .forEach(function(campo) {
            campo.addEventListener('focusout', () => {
                if (campo.checkValidity()) {
                    campo.classList.remove("is-invalid");
                    campo.classList.add("is-valid");
                } else {
                    campo.classList.remove("is-valid");
                    campo.classList.add("is-invalid");
                }
            }, false)
        })
}

// function quitarValidacion() {
//     let campos = document.getElementsByClassName("campo");
//     Array.prototype.slice.call(campos)
//         .forEach(function(campo) {
//             campo.removeEventListener('focusout', () => {
//                 if (campo.checkValidity()) {
//                     campo.classList.remove("is-invalid");
//                     campo.classList.add("is-valid");
//                 } else {
//                     campo.classList.remove("is-valid");
//                     campo.classList.add("is-invalid");
//                 }
//             }, false)
//         })
// }