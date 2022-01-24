document.onload = () => {
    let forms = document.getElementsByTagName("form");
    Array.prototype.slice.call(forms)
        .forEach(function(form) {
            form.addEventListener('submit', function(event) {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                    form.classList.add('was-invalidated')
                }

                form.classList.add('was-validated')
            }, false)
        })
}