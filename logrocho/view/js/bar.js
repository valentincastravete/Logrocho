window.addEventListener('load', () => {
    let ajax = new AjaxSerialization();

    let idBar = document.getElementById("id");
    let nombre = document.getElementById("nombre");
    let direccion = document.getElementById("direccion");
    let terraza = document.getElementById("terraza");
    let latitud = document.getElementById("latitud");
    let longitud = document.getElementById("longitud");
    let imagenes = document.getElementById("galeria");

    let id = getCookie("bar");

    function mostrarDatos() {
        id = getCookie("bar");
        ajax.loadContent("../index.php/openapi/imgs_bar?id_bar=" + id, "GET", null, () => {
            let rutasImagenesBar = eval(ajax.getResponse());
            ajax.loadContent("../index.php/openapi/bar?id=" + id, "GET", null, () => {
                let bar = eval(ajax.getResponse())[0];

                idBar.value = bar.id;
                nombre.value = bar.nombre;
                direccion.value = bar.direccion;
                terraza.checked = bar.terraza;
                latitud.value = bar.latitud;
                longitud.value = bar.longitud;
                imagenes.innerHTML = "";
                rutasImagenesBar.forEach(ruta => {
                    let imagen = document.createElement("img");
                    imagen.src = "../" + ruta;
                    imagen.alt = bar.nombre;
                    imagenes.append(imagen);
                });
            });
        });
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

    mostrarDatos();
});