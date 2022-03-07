window.addEventListener('load', () => {
    let ajax = new AjaxSerialization();

    let esconderFiltros = document.querySelector(".esconder_filtros");
    let filtros = document.querySelector(".filtros");
    let contenido = document.querySelector(".contenido");
    esconderFiltros.addEventListener("click", () => {
        if (filtros.classList.contains("d-none")) {
            filtros.classList.remove("d-none");
            esconderFiltros.innerText = "<";
            esconderFiltros.parentElement.classList.remove("col-1");
            esconderFiltros.parentElement.classList.add("col-3");
            contenido.classList.remove("col-11");
            contenido.classList.add("col-9");
        } else {
            filtros.classList.add("d-none");
            esconderFiltros.innerHTML = ">";
            esconderFiltros.parentElement.classList.remove("col-3");
            esconderFiltros.parentElement.classList.add("col-1");
            contenido.classList.remove("col-9");
            contenido.classList.add("col-11");
        }
    });

    let busqueda = document.querySelector("#busqueda");
    busqueda.addEventListener("keypress", (e) => {
        var code = (e.keyCode ? e.keyCode : e.which);
        if (code == 13) {
            mostrarDatos();
        }
    });

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

    let baresCards = document.querySelector(".bares");

    let barCard = `
        <div class="row g-0">
            <div class="col-md-4">
                <img class="img-fluid rounded-start" alt="Imagen bar" id="imagen">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <p class="d-none" id="id"></p>
                    <h5 class="card-title" id="nombre"></h5>
                    <p class="card-text"><small class="text-muted" id="direccion"></small></p>
                    <button class="btn btn-light btn-outline-secondary float-right">Pinchos</button>
                </div>
            </div>
        </div>
    `;


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
        ajax.loadContent("../index.php/openapi/bares?cantidad=" + cantidad + "&pagina=" + pagina + "&busqueda=" + busqueda.value, "GET", null, () => {
            let bares = eval(ajax.getResponse());

            baresCards.innerHTML = "";
            if (cantidad === 0 || bares === undefined) {
                baresCards.innerHTML = "<p>No se ha encontrado ningún bar.</p>";
                return;
            } else {
                ajax.loadContent("../index.php/openapi/count_bares", "GET", null, () => {
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
                if (bares.length > 0) {
                    for (let i = 0; i < bares.length; i++) {
                        let card = construirCard(bares[i]);
                        baresCards.appendChild(card);
                    }
                }
            }
        });
    }

    function setCookie(cname, cvalue, exdays) {
        const d = new Date();
        d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
        let expires = "expires=" + d.toUTCString();
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    }

    function siguientePag() {
        selection__pagina.value = pagina += 1;
        mostrarDatos();
    }

    function anteriorPag() {
        selection__pagina.value = pagina -= 1;
        mostrarDatos();
    }

    function construirCard(datos) {
        let card = document.createElement('div');
        card.innerHTML = barCard;
        card.className = "col-12 card mb-3 p-0";

        let id = card.querySelector("#id");
        let nombre = card.querySelector('#nombre');
        let direccion = card.querySelector('#direccion');
        let imagen = card.querySelector("#imagen");
        // ajax.loadContent("../index.php/openapi/imgs_bar?id_bar=" + datos.id, "GET", null, () => {
        //     let rutasImagenesBar = eval(ajax.getResponse());
        //     imagen.src = "/" + rutasImagenesBar[0];
        // });
        imagen.src = "img/bares/1/bar1.jpg";

        id.innerText = datos.id;
        nombre.innerHTML = datos.nombre;
        direccion.innerHTML = datos.direccion;

        imagen.onclick = function() {
            setCookie("bar", datos.id, 30);
            location.href = '../index.php/bar';
        };
        imagen.style.cursor = "pointer";

        return card;
    }
    busqueda.value = "";
    mostrarDatos();
});