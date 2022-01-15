let ajax = new AjaxSerialization();

window.onload = () => {
    ajax.loadContent("login.php", "GET", null, () => {
        let response = ajax.getResponse();
        if (response) {
            login();
        }
    });
}

function login() {
    let user = document.getElementById("user");
    let password = document.getElementById("password");
    ajax.loadContent("login.php", "POST", `user=${user.value}&password=${password.value}`, () => {
        let response = ajax.getResponse();
        if (response) {
            let loginErrors = document.getElementsByClassName("login_error");
            let loginError = false;
            if (loginErrors.length > 0) {
                loginError = loginErrors[0];
            }
            let login = document.getElementById("login");
            if (loginError) {
                login.removeChild(loginError);
            }
            login.classList.add("hidden");
            document.getElementById("user_email").innerText = response;
            categorias();
        } else {
            let loginErrors = document.getElementsByClassName("login_error");
            let previousloginError = false;
            if (loginErrors.length > 0) {
                previousloginError = loginErrors[0];
            }
            let login = document.getElementById("login");
            if (previousloginError) {
                login.removeChild(previousloginError);
            }
            let loginError = Object.assign(document.createElement("div"), { classList: "login_error" });
            loginError.innerText = 'Error de autenticación. Correo y/o contraseña inválidos.';
            login.insertBefore(loginError, login.children[0]);
            let app = document.getElementById("app");
            app.classList.add("hidden");
        }
    });
    return false;
}

function logout() {

}

function carrito() {

}

function categorias() {
    let app = document.getElementById("app");
    app.classList.remove("hidden");
    let content = document.getElementsByClassName("content")[0];
    content.innerHTML = "";
    content.appendChild(Object.assign(document.createElement("h1"), { innerText: "Categorías" }));
    ajax.loadContent("categorias.php", "GET", null, () => {
        let response = eval(ajax.getResponse());
        if (response) {
            let records = Object.assign(document.createElement("div"), { classList: "records" });
            if (response.length > 0) {
                response.forEach(categoria => {
                    records.appendChild(Object.assign(document.createElement("a"), {
                        innerText: categoria["nombre"], classList: "record", onclick: () => {
                            productos(categoria["cod_cat"])
                        }
                    }));
                });
            } else {
                records.appendChild(Object.assign(document.createElement("span"), { classList: "records_error record", innerText: "No hay registros" }));
            }
            content.appendChild(records);
        } else {
            login();
        }
    });
}

function productos(categoria) {
    console.log(categoria);
}

function anadirProductos() {

}

function eliminarProductos() {

}

function procesarPedido() {

}