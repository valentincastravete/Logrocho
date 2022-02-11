// ACCEDER A LAS IMAGENES upload.cachedFileArray;
// https://github.com/johndatserakis/file-upload-with-preview/tree/master

let ajax = new AjaxSerialization();
let registros = 5;
let pag = 0;
let order_by = 0;
let order_by_asc = 1;
let departamentos;

let cantidad = document.getElementById("basic-datatable_length").selected.value;
let pagina = document.getElementById("alternative-page-datatable_paginate").querySelector(".active").value;


let ths = `
        <th style="cursor: pointer;" class="w-5" onclick="ordenar(0);">ID ↓</th>
        <th style="cursor: pointer;" onclick="ordenar(1);">Nombre</th>
        <th style="cursor: pointer;" onclick="ordenar(2);">Dirección</th>
        <th style="cursor: pointer;" onclick="ordenar(3);">Terraza</th>
        <th style="cursor: pointer;" onclick="ordenar(4);">Latitud</th>
        <th style="cursor: pointer;" onclick="ordenar(5);">Longitud</th>
        <th class="w-5"></th>`;
let tr = `
        <td><a href="<?= getIndex() ?>bar" class="text-decoration-none btn btn-light btn-outline-secondary">1</a></td>
        <td class="w-10"><input class="w-100 form-control" type="text" name="nombre" id="nombre" value="Edelweiss"></td>
        <td class="w-50"><input class="w-100 form-control" type="text" name="direccion" id="direccion" value="Avenida de la playa, 3 bajo, 26009, Logroño, La Rioja"></td>
        <td><input class="mx-auto mt-2 form-check form-check-input" type="checkbox" name="terraza" id="terraza" checked></td>
        <td><input class="w-100 form-control" type="number" name="latitud" id="latitud" step="0.0001" value="43.2642"></td>
        <td><input class="w-100 form-control" type="number" name="latitud" id="latitud" step="0.0001" value="25.3243"></td>
        <td>
            <button class="btn btn-danger" title="Eliminar">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                </svg>
            </button>
        </td>`;

function mostrarDatos() {
    ajax.loadContent("index.php/bares?cantidad=" + cantidad + "&pag=" + pag, "GET", () => {
        bares = eval(ajax.getResponse());

        if (cantidad == 0) {
            /*
                VACIAR HTML DE TRS
            */
            return;
        } else {
            //  Si se cambia la cantidad de registros a mostrar
            if (cantidad !== registros) {
                pag = 0;
                pagina = 0;
            }
            registros = cantidad;
            /*
                ESTABLECER VALOR EN DESDE (usando pagina) PARA PAGINACION
            */
            let resLength = bares.length;
            let siguienteDeshabilitado = true;
            if (resLength >= cantidad + 1) {
                siguienteDeshabilitado = false;
                --resLength;
            }
            document.getElementsByName(/* ID DE BOTON SIGUIENTE */)[0].disabled = siguienteDeshabilitado;
            document.getElementsByName(/* ID DE BOTON ANTERIOR */)[0].disabled = pagina == 1;
            //  Cambiar contenido de tabla
            if (resLength > 0) {
                let tabla = document.getElementById(/* ID DE TABLA */);
                let thead = tabla.getElementsByTagName("thead")[0];
                let tbody = tabla.getElementsByTagName("tbody")[0];
                construirCabecera(thead);
                for (let i = 0; i < resLength; i++) {
                    let fila = construirFila(bares[i], i);
                    tbody.appendChild(fila);
                }
                //  Agregar flecha de ordenacion en campo de cabecera
                // document.getElementsByTagName('th')[order_by].textContent += order_by_asc ? "↓" : "↑";
            }
        }
    });
}


function siguiente() {
    /* ESTABLECER VALOR DESDE
    document.getElementById("from").value = registros * ++pag;
    */
    mostrarDatos();
}

function anterior() {
    /* ESTABLECER VALOR DESDE
    document.getElementById('from').value = registros * --pag;
    */
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

function insertarFila() {
    document.getElementsByName("anadirEmp")[0].disabled = true;
    document.getElementById("selectFilas").disabled = true;
    document.getElementsByName("anterior")[0].disabled = true;
    document.getElementsByName("siguiente")[0].disabled = true;
    let inputs = document.getElementsByTagName("input");
    for (let i = 0; i < inputs.length; i++) {
        const input = inputs[i];
        input.disabled = true;
    }
    let confirmarInsercion = document.getElementById("confirmarInsercion");
    confirmarInsercion.style.display = "initial";
    for (let i = 0; i < confirmarInsercion.children.length; i++) {
        const input = confirmarInsercion.children[i];
        input.disabled = false;
    }
    let tabla = document.getElementById("tablaEmpleados");
    tabla.appendChild(construirFila({ emp_no: 0, apellido: "", oficio: "", dir: "", fecha_alt: "", salario: 0, comision: 0, dept_no: 0 }, null));
}

function insertarEmpleado() {
    let user = {};
    let fields = document.getElementsByTagName("tr")[document.getElementsByTagName("tr").length - 1].children;

    user.apellido = fields[1].children[0].value;
    user.oficio = fields[2].children[0].value;
    user.dir = fields[3].children[0].value;
    user.fecha_alt = fields[4].children[0].value;
    user.salario = fields[5].children[0].value;
    user.comision = fields[6].children[0].value;
    user.dept_no = fields[7].children[0].value;

    if (fields[8] != undefined) {
        fields[8].parentElement.removeChild(fields[8]);
    }
    if (departamentos.findIndex(dep => dep.dept_no == user.dept_no) == -1) {
        let mensajeError = document.createElement("td");
        mensajeError.textContent = "No existe ese departamento";
        fields[7].parentElement.appendChild(mensajeError);
    } else {
        user = JSON.stringify(user);
        ajax.loadContent("insertarEmpleado.php?user=" + user, "GET", () => { });
        limpiarInsertarEmpleado();
    }
}

function limpiarInsertarEmpleado() {
    document.getElementsByName("anadirEmp")[0].disabled = false;
    document.getElementById("selectFilas").disabled = false;
    let inputs = document.getElementsByTagName("input");
    for (let i = 0; i < inputs.length; i++) {
        const input = inputs[i];
        input.disabled = false;
    }
    let confirmarInsercion = document.getElementById("confirmarInsercion");
    confirmarInsercion.style.display = "none";
    let tabla = document.getElementById("tablaEmpleados");
    tabla.removeChild(tabla.children[tabla.childElementCount - 1]);
    mostrarDatos();
}

function actualizarFila(n) {
    let user = {};
    let fields = document.getElementsByTagName("tr")[n + 1].children;

    user.emp_no = fields[0].children[0].value;
    user.apellido = fields[1].children[0].value;
    user.oficio = fields[2].children[0].value;
    user.dir = fields[3].children[0].value;
    user.fecha_alt = fields[4].children[0].value;
    user.salario = fields[5].children[0].value;
    user.comision = fields[6].children[0].value;
    user.dept_no = fields[7].children[0].value;

    if (fields[8] != undefined) {
        fields[8].parentElement.removeChild(fields[8]);
    }
    if (departamentos.findIndex(dep => dep.dept_no == user.dept_no) == -1) {
        let mensajeError = document.createElement("td");
        mensajeError.textContent = "No existe ese departamento";
        fields[7].parentElement.appendChild(mensajeError);
    } else {
        user = JSON.stringify(user);
        ajax.loadContent("actualizarEmpleado.php?user=" + user, "GET", () => { });
    }
}

function construirCabecera() {
    var cabecera = document.createElement('tr');
    cabecera.innerHTML = ths;
    return cabecera;
}

function construirFila(datos, n) {
    let fila = document.createElement('tr');
    fila.innerHTML = tr;
    let columnas = fila.querySelectorAll('td');

    columnas[0].querySelector('a').innerText = datos.id;
    columnas[1].querySelector('a').innerText = datos.id;
    columnas[2].querySelector('a').innerText = datos.id;
    columnas[3].querySelector('a').innerText = datos.id;
    columnas[4].querySelector('a').innerText = datos.id;
    columnas[5].querySelector('a').innerText = datos.id;
    columnas[0].querySelector('a').innerText = datos.id;

    for (let i = 0; i < columnas.length; i++) {
        const columna = columnas[i];
        columna.onblur = function () { actualizarFila(n) };
    }

    var titulo = document.createElement('td');
    var campo = document.createElement('input');
    campo.className = "apellido";
    campo.type = "text";
    campo.value = datos.apellido;
    campo.onblur = function () { actualizarFila(n) };
    titulo.appendChild(campo);
    linea.appendChild(titulo);

    var titulo = document.createElement('td');
    var campo = document.createElement('input');
    campo.className = "oficio";
    campo.type = "text";
    campo.value = datos.oficio;
    campo.onblur = function () { actualizarFila(n) };
    titulo.appendChild(campo);
    linea.appendChild(titulo);

    var titulo = document.createElement('td');
    var campo = document.createElement('input');
    campo.className = "dir";
    campo.type = "number";
    campo.value = datos.dir;
    campo.onblur = function () { actualizarFila(n) };
    titulo.appendChild(campo);
    linea.appendChild(titulo);

    var titulo = document.createElement('td');
    var campo = document.createElement('input');
    campo.className = "fecha_alt";
    campo.type = "text";
    campo.value = datos.fecha_alt;
    campo.onblur = function () { actualizarFila(n) };
    titulo.appendChild(campo);
    linea.appendChild(titulo);

    var titulo = document.createElement('td');
    var campo = document.createElement('input');
    campo.className = "salario";
    campo.type = "number";
    campo.value = datos.salario;
    campo.onblur = function () { actualizarFila(n) };
    titulo.appendChild(campo);
    linea.appendChild(titulo);

    var titulo = document.createElement('td');
    var campo = document.createElement('input');
    campo.className = "comision";
    campo.type = "number";
    campo.value = datos.comision;
    campo.onblur = function () { actualizarFila(n) };
    titulo.appendChild(campo);
    linea.appendChild(titulo);

    var titulo = document.createElement('td');
    var campo = document.createElement('select');
    campo.className = "dept_no";
    campo.name = "departamentos";
    campo.id = "selectDepartamentos";
    departamentos.forEach(departamento => {
        let option = document.createElement("option");
        option.value = departamento["dept_no"];
        option.text = departamento["dnombre"];
        if (departamento["dept_no"] == datos.dept_no) {
            option.selected = true;
        }
        campo.add(option, null);
    });
    campo.onblur = function () { actualizarFila(n) };
    titulo.appendChild(campo);
    linea.appendChild(titulo);

    return linea;
}