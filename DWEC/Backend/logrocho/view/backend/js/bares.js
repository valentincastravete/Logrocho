window.addEventListener('load', () => {
    // ACCEDER A LAS IMAGENES upload.cachedFileArray;
    // https://github.com/johndatserakis/file-upload-with-preview/tree/master

    let ajax = new AjaxSerialization();
    let order_by = 0;
    let order_by_asc = 1;

    let selection__cantidad = document.querySelector("#cantidad");
    selection__cantidad.addEventListener("change", () => {
        cantidad = selection__cantidad.selectedOptions[0].value;
        pagina = selection__pagina.value = 1;
        mostrarDatos();
    });
    let cantidad = selection__cantidad.selectedOptions[0].value;

    let selection__pagina = document.querySelector("#pagina");
    selection__pagina.addEventListener("change", () => {
        if (selection__pagina.value == "" || selection__pagina.value.length > 5) {
            selection__pagina.value = 1;
        }
        pagina = selection__pagina.value;
        mostrarDatos();
    });
    let pagina = parseInt(selection__pagina.value);

    let maxBares = 0;
    let maxPagina = 0;

    let primera = document.querySelector(".first");
    let ultima = document.querySelector(".last");
    let anterior = document.querySelector(".previous");
    let siguiente = document.querySelector(".next");

    primera.addEventListener("click", () => {
        pagina = selection__pagina.value = 1;
        mostrarDatos();
    });
    siguiente.addEventListener("click", function() {
        siguientePag();
    });
    anterior.addEventListener("click", function() {
        anteriorPag();
    });

    let tabla = document.getElementById("bares");
    let thead = tabla.getElementsByTagName("thead")[0];
    let tbody = tabla.getElementsByTagName("tbody")[0];


    let ths = `
    <th style="cursor: pointer;" class="w-5">ID</th>
    <th style="cursor: pointer;">Nombre</th>
    <th style="cursor: pointer;">Dirección</th>
    <th style="cursor: pointer;">Terraza</th>
    <th style="cursor: pointer;">Latitud</th>
    <th style="cursor: pointer;">Longitud</th>
    <th class="w-5">
        <div class="dropdown p-0 m-0">
            <button class="btn btn-light py-0 w-100 dropdown-toggle" type="button" id="camposAMostrar" data-bs-toggle="dropdown" aria-expanded="false"></button>
            <select class="select dropdown-menu camposAMostrar" aria-labelledby="camposAMostrar" multiple>
                <option selected>Nombre</option>
                <option selected>Dirección</option>
                <option selected>Terraza</option>
                <option selected>Latitud</option>
                <option selected>Longitud</option>
            </select>
        </div>
    </th>`;
    let tr = `
    <td><a class="text-decoration-none btn btn-light btn-outline-secondary"></a></td>
    <td class="w-10"><input class="w-100 form-control" type="text" name="nombre" id="nombre"></td>
    <td class="w-50"><input class="w-100 form-control" type="text" name="direccion" id="direccion"></td>
    <td><input class="mx-auto mt-2 form-check form-check-input" type="checkbox" name="terraza" id="terraza"></td>
    <td><input class="w-100 form-control" type="number" name="latitud" id="latitud" min="-90" max="90" step="0.0000001"></td>
    <td><input class="w-100 form-control" type="number" name="latitud" id="latitud" min="-180" max="180" step="0.0000001"></td>
    <td>
        <button class="btn btn-danger" title="Eliminar">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
            </svg>
        </button>
    </td>`;

    let camposAMostrar = null;

    function mostrarDatos() {
        if (pagina != 1) {
            if (maxPagina > 1) {
                if (pagina > maxPagina) {
                    pagina = selection__pagina.value = 1;
                    mostrarDatos();
                    return;
                }
                if (pagina < 1) {
                    pagina = selection__pagina.value = maxPagina;
                    mostrarDatos();
                    return;
                }
            } else {
                pagina = selection__pagina.value = maxPagina;
                return;
            }
        }
        ajax.loadContent("http://localhost/logrocho/index.php/api/bares?cantidad=" + cantidad + "&pagina=" + pagina + "&order_by=" + order_by + "&asc_desc=" + order_by_asc, "GET", null, () => {
            let bares = eval(ajax.getResponse());

            thead.innerHTML = "";
            tbody.innerHTML = "";
            if (cantidad === 0 || bares === undefined) {
                thead.append(construirCabecera());
                return;
            } else {
                ajax.loadContent("http://localhost/logrocho/index.php/api/count_bares", "GET", null, () => {
                    maxBares = ajax.getResponse();
                    maxPagina = Math.ceil(maxBares / cantidad);
                    document.querySelector("#max").innerText = maxBares;
                    ultima.addEventListener("click", () => {
                        pagina = selection__pagina.value = maxPagina;
                        mostrarDatos();
                    });
                });
                document.querySelector("#desde").innerText = (pagina - 1) * cantidad + 1;
                document.querySelector("#hasta").innerText = bares.length < cantidad ? bares.length + cantidad * (pagina - 1) : cantidad * pagina;
                //  Cambiar contenido de tabla
                if (bares.length > 0) {
                    thead.append(construirCabecera());
                    //  Agregar flecha de ordenacion en campo de cabecera
                    document.getElementsByTagName('th')[order_by].innerText += order_by_asc ? "↓" : "↑";
                    for (let i = 0; i < bares.length; i++) {
                        let fila = construirFila(bares[i], i);
                        tbody.appendChild(fila);
                    }
                }
            }
            camposAMostrar = document.querySelector(".camposAMostrar");

            let camposMostrados = getCookie("camposAMostrarBares").split(',');

            let columnasCabecera = thead.querySelectorAll('th');
            let filas = tbody.querySelectorAll('tr');
            for (let i = 0; i < camposMostrados.length; i++) {
                const option = (camposMostrados[i] === 'true' || camposMostrados[i] === '');
                const optionSelect = camposAMostrar[i];
                optionSelect.selected = option;

                const columnaCabecera = columnasCabecera[i + 1];
                if (option) {
                    columnaCabecera.classList.remove("d-none");
                } else {
                    columnaCabecera.classList.add("d-none");
                }

                for (let j = 0; j < filas.length; j++) {
                    const columna = filas[j].querySelectorAll("td")[i + 1];
                    if (option) {
                        columna.classList.remove("d-none");
                    } else {
                        columna.classList.add("d-none");
                    }
                }
            }
            camposAMostrar.addEventListener("change", () => {
                let camposMostrados = [];
                let columnasCabecera = thead.querySelectorAll('th');
                let filas = tbody.querySelectorAll('tr');
                for (let i = 0; i < camposAMostrar.options.length; i++) {
                    const option = camposAMostrar.options[i];

                    const columnaCabecera = columnasCabecera[i + 1];
                    if (option.selected) {
                        columnaCabecera.classList.remove("d-none");
                    } else {
                        columnaCabecera.classList.add("d-none");
                    }

                    for (let j = 0; j < filas.length; j++) {
                        const columna = filas[j].querySelectorAll("td")[i + 1];
                        if (option.selected) {
                            columna.classList.remove("d-none");
                        } else {
                            columna.classList.add("d-none");
                        }
                    }
                    camposMostrados.push(option.selected);
                }
                setCookie("camposAMostrarBares", camposMostrados, 30);
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

    function siguientePag() {
        selection__pagina.value = pagina += 1;
        mostrarDatos();
    }

    function anteriorPag() {
        selection__pagina.value = pagina -= 1;
        mostrarDatos();
    }

    function ordenar(pagina) {
        if (order_by != pagina) {
            order_by_asc = 1;
            order_by = pagina;
        } else {
            order_by_asc = order_by_asc == 1 ? 0 : 1;
        }
        mostrarDatos();
    }

    function actualizarFila(n) {
        let fields = tbody.querySelectorAll("tr")[n].children;

        let id = fields[0].children[0].innerText;
        let nombre = fields[1].children[0].value;
        let direccion = fields[2].children[0].value;
        let terraza = fields[3].children[0].checked ? 1 : 0;
        let latitud = fields[4].children[0].value;
        let longitud = fields[5].children[0].value;
        ajax.loadContent("http://localhost/logrocho/index.php/bd/bar/modificacion",
            "POST",
            "nombre=" + nombre + "&direccion=" + direccion + "&terraza=" + terraza + "&latitud=" + latitud + "&longitud=" + longitud + "&id=" + id,
            () => {}
        );
    }

    function eliminarFila(n) {
        let id = tbody.querySelectorAll("tr")[n].children[0].children[0].innerText;

        ajax.loadContent("http://localhost/logrocho/index.php/bd/bar/baja",
            "POST",
            "id=" + id,
            () => {}
        );
        mostrarDatos();
    }

    function construirCabecera() {
        var cabecera = document.createElement('tr');
        cabecera.innerHTML = ths;
        let columnas = cabecera.querySelectorAll('th');

        for (let i = 0; i < columnas.length - 1; i++) {
            const columna = columnas[i];
            columna.onclick = function() { ordenar(i); };
        }

        return cabecera;
    }

    function construirFila(datos, n) {
        let fila = document.createElement('tr');
        fila.innerHTML = tr;
        let columnas = fila.querySelectorAll('td');

        let id = columnas[0].querySelector('a');
        let nombre = columnas[1].querySelector('input');
        let direccion = columnas[2].querySelector('input');
        let terraza = columnas[3].querySelector('input');
        let latitud = columnas[4].querySelector('input');
        let longitud = columnas[5].querySelector('input');
        let eliminar = columnas[6].querySelector('button');

        let campos = [id, nombre, direccion, terraza, latitud, longitud];

        id.innerText = datos.id;
        nombre.value = datos.nombre;
        direccion.value = datos.direccion;
        terraza.checked = datos.terraza;
        latitud.value = datos.latitud;
        longitud.value = datos.longitud;

        for (let i = 1; i < campos.length; i++) {
            const columna = campos[i];
            columna.onchange = function() { actualizarFila(n); };
        }

        id.onclick = function() {
            setCookie("id_bar", datos.id, 30);
            location.href = 'http://localhost/logrocho/index.php/bar';
        };
        eliminar.onclick = function() { eliminarFila(n); };

        return fila;
    }
    mostrarDatos();
});