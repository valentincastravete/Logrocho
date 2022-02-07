// ACCEDER A LAS IMAGENES upload.cachedFileArray;
// https://github.com/johndatserakis/file-upload-with-preview/tree/master

let ajax = new AjaxSerialization();
let num_filas = 2;
let pagina = 0;
let order_by = 0;
let order_by_asc = 1;
let departamentos;

let cantidad = document.getElementById("basic-datatable_length").selected.value;
let pagina = document.getElementById("alternative-page-datatable_paginate").querySelector(".active").value;

function mostrarDatos() {
    ajax.loadContent("index.php/bares?cantidad=" + cantidad + "&pagina=" + pagina, "GET", () => {
        bares = eval(ajax.getResponse());

        var numFilas = document.getElementById("selectFilas").value;
        if (numFilas == "") {
            document.getElementById("tabla").innerHTML = "";
            return;
        } else {
            numFilas = parseInt(numFilas);
            let indice = document.getElementById("from").value;
            //  Si se cambia la cantidad de registros a mostrar
            if (numFilas !== num_filas) {
                pagina = 0;
                indice = 0;
            }
            num_filas = numFilas;
            document.getElementById("from").value = indice;
            //  Pedimos un registro de mas, si nos devuelve la cantidad pedida, es que todavia hay registros, si no, deshabilitamos el boton de siguiente
            ajax.loadContent("getEmpleados.php?q=" + (numFilas + 1) + "&from=" + indice + "&order_by=" + order_by + "&asc=" + order_by_asc, "GET", () => {
                var resultados = eval(ajax.getResponse());
                let resLength = resultados.length;
                let siguienteDeshabilitado = true;
                if (resLength >= numFilas + 1) {
                    siguienteDeshabilitado = false;
                    --resLength;
                }
                document.getElementsByName("siguiente")[0].disabled = siguienteDeshabilitado;
                document.getElementsByName("anterior")[0].disabled = indice == 0;
                //  Crear tabla
                if (resLength > 0) {
                    var tabla = document.createElement('table');
                    tabla.setAttribute("border", 1);
                    var cabecera = construirCabecera();
                    tabla.id = "tablaEmpleados";
                    tabla.appendChild(cabecera);
                    for (let i = 0; i < resLength; i++) {
                        let fila = construirFila(resultados[i], i);
                        tabla.appendChild(fila);
                    }
                    document.getElementById("tabla").innerHTML = "";
                    document.getElementById("tabla").appendChild(tabla);
                    //  Agregar flecha de ordenacion en campo de cabecera
                    document.getElementsByTagName('th')[order_by].textContent += order_by_asc ? "↓" : "↑";
                }
            });
        }
    });
}


function siguiente() {
    document.getElementById("from").value = num_filas * ++pagina;
    mostrarDatos();
}

function anterior() {
    document.getElementById('from').value = num_filas * --pagina;
    mostrarDatos();
}

function ordenar(indice) {
    if (order_by != indice) {
        order_by_asc = 1;
        order_by = indice;
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
        ajax.loadContent("insertarEmpleado.php?user=" + user, "GET", () => {});
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
        ajax.loadContent("actualizarEmpleado.php?user=" + user, "GET", () => {});
    }
}

function construirCabecera() {
    var cabecera = document.createElement('tr');

    var titulo = document.createElement('th');
    var texto = document.createTextNode("Núm. Empleado");
    titulo.appendChild(texto);
    titulo.style.cursor = "pointer";
    var funcion = function() {
        ordenar(0);
    };
    titulo.onclick = funcion;
    cabecera.appendChild(titulo);

    var titulo = document.createElement('th');
    var texto = document.createTextNode("Apellido");
    titulo.style.cursor = "pointer";
    var funcion = function() {
        ordenar(1);
    };
    titulo.onclick = funcion;
    titulo.appendChild(texto);
    cabecera.appendChild(titulo);

    var titulo = document.createElement('th');
    var texto = document.createTextNode("Oficio");
    titulo.style.cursor = "pointer";
    var funcion = function() {
        ordenar(2);
    };
    titulo.onclick = funcion;
    titulo.appendChild(texto);
    cabecera.appendChild(titulo);

    var titulo = document.createElement('th');
    var texto = document.createTextNode("Director");
    titulo.style.cursor = "pointer";
    var funcion = function() {
        ordenar(3);
    };
    titulo.onclick = funcion;
    titulo.appendChild(texto);
    cabecera.appendChild(titulo);

    var titulo = document.createElement('th');
    var texto = document.createTextNode("Fecha Alta");
    titulo.style.cursor = "pointer";
    var funcion = function() {
        ordenar(4);
    };
    titulo.onclick = funcion;
    titulo.appendChild(texto);
    cabecera.appendChild(titulo);

    var titulo = document.createElement('th');
    var texto = document.createTextNode("Salario");
    titulo.style.cursor = "pointer";
    var funcion = function() {
        ordenar(5);
    };
    titulo.onclick = funcion;
    titulo.appendChild(texto);
    cabecera.appendChild(titulo);

    var titulo = document.createElement('th');
    var texto = document.createTextNode("Comisión");
    titulo.style.cursor = "pointer";
    var funcion = function() {
        ordenar(6);
    };
    titulo.onclick = funcion;
    titulo.appendChild(texto);
    cabecera.appendChild(titulo);

    var titulo = document.createElement('th');
    var texto = document.createTextNode("Departamento");
    titulo.style.cursor = "pointer";
    var funcion = function() {
        ordenar(7);
    };
    titulo.onclick = funcion;
    titulo.appendChild(texto);
    cabecera.appendChild(titulo);

    return cabecera;
}

function construirFila(datos, n) {
    linea = document.createElement('tr');

    var titulo = document.createElement('td');
    var campo = document.createElement('input');
    campo.className = "emp_no";
    campo.type = "number";
    campo.value = datos.emp_no;
    campo.setAttribute("readonly", true);
    titulo.appendChild(campo);
    linea.appendChild(titulo);

    var titulo = document.createElement('td');
    var campo = document.createElement('input');
    campo.className = "apellido";
    campo.type = "text";
    campo.value = datos.apellido;
    campo.onblur = function() { actualizarFila(n) };
    titulo.appendChild(campo);
    linea.appendChild(titulo);

    var titulo = document.createElement('td');
    var campo = document.createElement('input');
    campo.className = "oficio";
    campo.type = "text";
    campo.value = datos.oficio;
    campo.onblur = function() { actualizarFila(n) };
    titulo.appendChild(campo);
    linea.appendChild(titulo);

    var titulo = document.createElement('td');
    var campo = document.createElement('input');
    campo.className = "dir";
    campo.type = "number";
    campo.value = datos.dir;
    campo.onblur = function() { actualizarFila(n) };
    titulo.appendChild(campo);
    linea.appendChild(titulo);

    var titulo = document.createElement('td');
    var campo = document.createElement('input');
    campo.className = "fecha_alt";
    campo.type = "text";
    campo.value = datos.fecha_alt;
    campo.onblur = function() { actualizarFila(n) };
    titulo.appendChild(campo);
    linea.appendChild(titulo);

    var titulo = document.createElement('td');
    var campo = document.createElement('input');
    campo.className = "salario";
    campo.type = "number";
    campo.value = datos.salario;
    campo.onblur = function() { actualizarFila(n) };
    titulo.appendChild(campo);
    linea.appendChild(titulo);

    var titulo = document.createElement('td');
    var campo = document.createElement('input');
    campo.className = "comision";
    campo.type = "number";
    campo.value = datos.comision;
    campo.onblur = function() { actualizarFila(n) };
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
    campo.onblur = function() { actualizarFila(n) };
    titulo.appendChild(campo);
    linea.appendChild(titulo);

    return linea;
}