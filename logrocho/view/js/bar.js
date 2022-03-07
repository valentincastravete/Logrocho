window.addEventListener('load', () => {
    // ACCEDER A LAS IMAGENES upload.cachedFileArray;
    // https://github.com/johndatserakis/file-upload-with-preview/tree/master

    let ajax = new AjaxSerialization();

    let idBar = document.getElementById("id");
    let nombre = document.getElementById("nombre");
    let direccion = document.getElementById("direccion");
    let terraza = document.getElementById("terraza");
    let latitud = document.getElementById("latitud");
    let longitud = document.getElementById("longitud");

    let botonCrear = document.getElementById("boton__crear");
    let botonGuardar = document.getElementById("boton__guardar");
    let botonEliminar = document.getElementById("boton__eliminar");

    botonCrear.onclick = function() { crear(); };
    botonGuardar.onclick = function() { guardar(); };
    botonEliminar.onclick = function() { eliminar(); };

    let id = getCookie("id_bar");

    function mostrarDatos() {
        id = getCookie("id_bar");
        ajax.loadContent("http://localhost/logrocho/index.php/api/bar?id=" + id, "GET", null, () => {
            let bar = eval(ajax.getResponse())[0];

            idBar.value = bar.id;
            nombre.value = bar.nombre;
            direccion.value = bar.direccion;
            terraza.checked = bar.terraza;
            latitud.value = bar.latitud;
            longitud.value = bar.longitud;
        });
    }

    function crear() {
        idBar.value = null;
        nombre.value = null;
        direccion.value = null;
        terraza.checked = null;
        latitud.value = null;
        longitud.value = null;

        validacion();
    }

    function guardar() {
        if (idBar.value == id) {
            ajax.loadContent("http://localhost/logrocho/index.php/bd/bar/modificacion",
                "POST",
                "nombre=" + nombre.value + "&direccion=" + direccion.value + "&terraza=" + (terraza.checked ? '1' : '0') + "&latitud=" + latitud.value + "&longitud=" + longitud.value + "&id=" + idBar.value,
                () => {}
            );
        } else if (camposValidos()) {
            ajax.loadContent("http://localhost/logrocho/index.php/bd/bar/alta",
                "POST",
                "nombre=" + nombre.value + "&direccion=" + direccion.value + "&terraza=" + (terraza.checked ? '1' : '0') + "&latitud=" + latitud.value + "&longitud=" + longitud.value,
                () => {
                    idBar.value = ajax.getResponse();
                    setCookie("id_bar", idBar.value, 30);
                    limpiarCamposValidos();
                    mostrarDatos();
                }
            );
        }
        // ajax.loadContent("http://localhost/logrocho/index.php/bd/bar/set-img",
        //     "POST",
        //     "&image_url=" + imagen_url + "&id=" + id,
        //     () => {}
        // );
    }

    function eliminar() {
        ajax.loadContent("http://localhost/logrocho/index.php/bd/bar/baja",
            "POST",
            "id=" + idBar.value,
            () => {
                location.href = 'http://localhost/logrocho/index.php/admin/bares';
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
        return document.getElementsByClassName("is-valid").length == 4;
    }

    function limpiarCamposValidos() {
        while (document.getElementsByClassName("is-valid").length > 0) {
            let campos = document.getElementsByClassName("is-valid");

            for (let i = 0; i < campos.length; i++) {
                const campo = campos[i];
                campo.classList.remove("is-valid");
            }
        }
        // quitarValidacion();
    }
    mostrarDatos();
});