window.addEventListener('load', () => {
    // ACCEDER A LAS IMAGENES upload.cachedFileArray;
    // https://github.com/johndatserakis/file-upload-with-preview/tree/master

    let ajax = new AjaxSerialization();

    let idPincho = document.getElementById("id");
    let nombre = document.getElementById("nombre");
    let barSelect = document.getElementById("bar");
    let descripcion = document.getElementById("descripcion");

    let botonCrear = document.getElementById("boton__crear");
    let botonGuardar = document.getElementById("boton__guardar");
    let botonEliminar = document.getElementById("boton__eliminar");

    botonCrear.onclick = function() { crear(); };
    botonGuardar.onclick = function() { guardar(); };
    botonEliminar.onclick = function() { eliminar(); };

    let id;

    function mostrarDatos() {
        id = getCookie("id_pincho");
        ajax.loadContent("http://localhost/logrocho/index.php/api/all_bares", "GET", null, () => {
            let bares = eval(ajax.getResponse());
            ajax.loadContent("http://localhost/logrocho/index.php/api/pincho?id=" + id, "GET", null, () => {
                let pincho = eval(ajax.getResponse())[0];

                idPincho.value = pincho.id;
                nombre.value = pincho.nombre;
                descripcion.value = pincho.descripcion;
                for (let i = 0; i < bares.length; i++) {
                    const bar = bares[i];
                    let barOption = document.createElement("option");
                    barOption.value = bar.id;
                    barOption.innerText = bar.nombre;
                    if (bar.id == pincho.bar.id) {
                        barOption.selected = true;
                    }
                    barSelect.options.add(barOption);
                }
            });
        });
    }

    function crear() {
        idPincho.value = null;
        nombre.value = null;
        descripcion.value = null;
        barSelect.selectedOptions = [];

        validacion();
        botonCrear.classList.add("d-none");
    }

    function guardar() {
        if (idPincho.value == id) {
            ajax.loadContent("http://localhost/logrocho/index.php/bd/pincho/modificacion",
                "POST",
                "nombre=" + nombre.value + "&descripcion=" + descripcion.value + "&id_bar=" + barSelect.selectedOptions[0].value + "&id=" + idPincho.value,
                () => {}
            );
        } else if (camposValidos()) {
            ajax.loadContent("http://localhost/logrocho/index.php/bd/pincho/alta",
                "POST",
                "nombre=" + nombre.value + "&descripcion=" + descripcion.value + "&id_bar=" + barSelect.selectedOptions[0].value,
                () => {
                    idPincho.value = ajax.getResponse();
                    setCookie("id_pincho", idPincho.value, 30);
                    limpiarCamposValidos();
                    mostrarDatos();
                }
            );
            botonCrear.classList.remove("d-none");
        } else {
            alert("No se han validado todos los campos");
            validarCampos();
            return;
        }
    }

    function validarCampos() {
        let campos = document.getElementsByClassName("campo");

        for (let i = 0; i < campos.length; i++) {
            const campo = campos[i];
            if (!campo.classList.contains("is-valid")) {
                campo.classList.add("is-invalid");
            }
        }
    }

    function eliminar() {
        ajax.loadContent("http://localhost/logrocho/index.php/bd/pincho/baja",
            "POST",
            "id=" + idPincho.value,
            () => {
                location.href = 'http://localhost/logrocho/index.php/admin/pinchos';
            }
        );
    }

    function setCookie(cname, cvalue, exdays) {
        const d = new Date();
        d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
        let expires = "expires=" + d.toUTCString();
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    }

    function getCookie(cname) {
        let name = cname + "=";
        let decodedCookie = decodeURIComponent(document.cookie);
        let ca = decodedCookie.split(';');
        for (let i = 0; i < ca.length; i++) {
            let c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    }

    function camposValidos() {
        return document.getElementsByClassName("is-valid").length == 3;
    }

    function limpiarCamposValidos() {
        while (document.getElementsByClassName("is-valid").length > 0) {
            let campos = document.getElementsByClassName("is-valid");

            for (let i = 0; i < campos.length; i++) {
                const campo = campos[i];
                campo.classList.remove("is-valid");
            }
        }
        quitarValidacion();
    }

    if (getCookie("id_pincho") == "crear") {
        crear();
        ajax.loadContent("http://localhost/logrocho/index.php/api/all_bares", "GET", null, () => {
            let bares = eval(ajax.getResponse());
            for (let i = 0; i < bares.length; i++) {
                const bar = bares[i];
                let barOption = document.createElement("option");
                barOption.value = bar.id;
                barOption.innerText = bar.nombre;
                barSelect.options.add(barOption);
            }
        });
    } else {
        mostrarDatos();
    }
});