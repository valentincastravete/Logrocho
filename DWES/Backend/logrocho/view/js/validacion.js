window.addEventListener("load", () => {
    let campos = document.getElementsByClassName("campo");
    let form = document.getElementsByTagName("form")[0];
    Array.prototype.slice.call(campos)
        .forEach(function (campo) {
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
    form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
        }

        form.classList.add('was-validated');
    }, false)
});