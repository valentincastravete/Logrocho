window.addEventListener('load', () => {
    // ACCEDER A LAS IMAGENES upload.cachedFileArray;
    // https://github.com/johndatserakis/file-upload-with-preview/tree/master

    let ajax = new AjaxSerialization();

    let idUsuario = document.getElementById("id");
    let nombre = document.getElementById("nombre");
    let clave = document.getElementById("clave");
    let correo = document.getElementById("correo");
    let admin = document.getElementById("admin");

    let botonCrear = document.getElementById("boton__crear");
    let botonGuardar = document.getElementById("boton__guardar");
    let botonEliminar = document.getElementById("boton__eliminar");

    botonCrear.onclick = function() { crear(); };
    botonGuardar.onclick = function() { guardar(); };
    botonEliminar.onclick = function() { eliminar(); };

    let id = getCookie("id_usuario");

    function mostrarDatos() {
        id = getCookie("id_usuario");
        ajax.loadContent("http://localhost/logrocho/index.php/api/usuario?id=" + id, "GET", null, () => {
            let usuario = eval(ajax.getResponse())[0];

            idUsuario.value = usuario.id;
            nombre.value = usuario.nombre;
            clave.value = usuario.clave;
            correo.value = usuario.correo;
            admin.checked = usuario.admin;
        });
    }

    function crear() {
        idUsuario.value = null;
        nombre.value = null;
        clave.value = null;
        correo.value = null;
        admin.checked = null;

        validacion();
    }

    function guardar() {
        if (idUsuario.value == id) {
            ajax.loadContent("http://localhost/logrocho/index.php/bd/usuario/modificacion",
                "POST",
                "nombre=" + nombre.value + "&correo=" + correo.value + "&admin=" + (admin.checked ? '1' : '0') + "&id=" + idUsuario.value,
                () => {}
            );
        } else if (camposValidos()) {
            ajax.loadContent("http://localhost/logrocho/index.php/bd/usuario/alta",
                "POST",
                "nombre=" + nombre.value + "&correo=" + correo.value + "&clave=" + clave.value + "&admin=" + (admin.checked ? '1' : '0'),
                () => {
                    idUsuario.value = ajax.getResponse();
                    setCookie("id_usuario", idUsuario.value, 30);
                    limpiarCamposValidos();
                    mostrarDatos();
                }
            );
        }
        // ajax.loadContent("http://localhost/logrocho/index.php/bd/usuario/set-img",
        //     "POST",
        //     "&image_url=" + imagen_url + "&id=" + id,
        //     () => {}
        // );
    }

    function eliminar() {
        ajax.loadContent("http://localhost/logrocho/index.php/bd/usuario/baja",
            "POST",
            "id=" + idUsuario.value,
            () => {
                location.href = 'http://localhost/logrocho/index.php/usuarios';
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