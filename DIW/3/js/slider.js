window.addEventListener("load", () => {
    let slides = document.querySelectorAll(".slide");
    let slideActual = 0;
    let activo = true;
    let botonPausar = document.getElementsByClassName('pausar')[0];
    let botonSiguiente = document.getElementsByClassName('siguiente')[0];
    let botonAnterior = document.getElementsByClassName('anterior')[0];
    let botonCambio = document.getElementsByClassName('cambio')[0];
    let intervalo = setInterval(slideSiguiente, 5000);
    let slidesPosibles = { 'mejor_valorados': 0, 'preferidos': 1 };
    let slidesActual = 0;


    botonSiguiente.onclick = function() {
        slideSiguiente();
    };
    botonAnterior.onclick = function() {
        slideAnterior();
    };
    botonPausar.onclick = function() {
        if (activo) { pausar(); } else { mover(); }
    };
    botonCambio.onclick = function() {
        if (++slidesActual == Object.keys(slidesPosibles).length) {
            slidesActual = 0;
        }
        cambioDatos(slidesActual);
    };

    function slideSiguiente() {
        moverSlide(slideActual + 1);
    }

    function slideAnterior() {
        moverSlide(slideActual - 1);
    }

    function moverSlide(n) {
        if (activo) {
            clearInterval(intervalo);
            intervalo = setInterval(slideSiguiente, 5000);
        }
        if (slidesActual == slidesPosibles.preferidos) {
            slides[slideActual].className = 'slide movido';
        } else {
            slides[slideActual].className = 'slide';
        }
        slideActual = (n + slides.length) % slides.length;
        if (slidesActual == slidesPosibles.preferidos) {
            slides[slideActual].className = 'slide mostrado moviendo';
        } else {
            slides[slideActual].className = 'slide mostrado';
        }
    }

    function mover() {
        botonPausar.innerHTML = 'Pausar';
        activo = true;
        intervalo = setInterval(slideSiguiente, 5000);
    }

    function pausar() {
        botonPausar.innerHTML = 'Mover';
        activo = false;
        clearInterval(intervalo);
    }

    let sliderHome = document.getElementsByClassName('slider_home')[0];
    let tituloSlider = sliderHome.getElementsByTagName('h2')[0];

    function cambioDatos(slidesActual) {
        setTextos(slidesActual);
        setImagenes(slidesActual);
    }

    function setTextos(slidesActual) {
        let titulo = "Pinchos";
        let boton = "Pinchos";
        switch (slidesActual) {
            case slidesPosibles.mejor_valorados:
                titulo = "Pinchos mejor valorados";
                boton = "Preferidos";
                break;
            case slidesPosibles.preferidos:
                titulo = "Pinchos preferidos";
                boton = "Mejor valorados";
                break;
        }
        tituloSlider.innerText = titulo;
        botonCambio.innerText = boton;
    }

    function setImagenes(slidesActual) {
        for (let i = 0; i < slides.length; i++) {
            const img = slides[i];
            img.style.backgroundImage = `url("img/pincho${slidesActual * 5 + i + 1}.jpg")`;
            switch (slidesActual) {
                case slidesPosibles.mejor_valorados:
                    img.style.transition = "opacity 1s";
                    img.classList.remove("moviendo");
                    img.classList.remove("movido");
                    break;
                case slidesPosibles.preferidos:
                    img.style.transition = "background-position-x 1s";
                    img.classList.add("movido");
                    break;
            };
        }
    }

    cambioDatos(slidesActual);
})