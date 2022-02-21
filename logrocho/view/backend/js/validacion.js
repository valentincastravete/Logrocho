let campos = document.getElementsByClassName("campo");
Array.prototype.slice.call(campos)
    .forEach(function(campo) {
        campo.addEventListener('focusout', () => {
            if (campo.classList.contains('nuevo_registro')) {
                if (campo.checkValidity()) {
                    campo.classList.remove("is-invalid");
                    campo.classList.add("is-valid");
                } else {
                    campo.classList.remove("is-valid");
                    campo.classList.add("is-invalid");
                }
            }
        }, false)
    })

function validacion() {
    let campos = document.getElementsByClassName("campo");
    Array.prototype.slice.call(campos)
        .forEach(function(campo) {
            campo.classList.add('nuevo_registro');
        })
}

function quitarValidacion() {
    let campos = document.getElementsByClassName("campo");
    Array.prototype.slice.call(campos)
        .forEach(function(campo) {
            campo.classList.remove('nuevo_registro');
        })
}