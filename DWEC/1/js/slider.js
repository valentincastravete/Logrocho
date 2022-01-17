window.addEventListener("load", () => {
    let slides = document.querySelectorAll('.slides');
    let slidesMejorValorados = slides[0].querySelectorAll(".slide");
    let slidesPreferidos = slides[1].querySelectorAll(".slide");
    let slideActualMV = 0;
    let slideActualP = 0;
    let activoMV = true;
    let activoP = true;
    let botonPausarMV = document.getElementsByClassName('pausar')[0];
    let botonSiguienteMV = document.getElementsByClassName('siguiente')[0];
    let botonAnteriorMV = document.getElementsByClassName('anterior')[0];
    let botonPausarP = document.getElementsByClassName('pausar')[1];
    let botonSiguienteP = document.getElementsByClassName('siguiente')[1];
    let botonAnteriorP = document.getElementsByClassName('anterior')[1];
    let intervaloMV = setInterval(slideSiguienteMV, 5000);
    let intervaloP = setInterval(slideSiguienteP, 5000);


    botonSiguienteMV.onclick = function() {
        slideSiguienteMV();
    };
    botonAnteriorMV.onclick = function() {
        slideAnteriorMV();
    };
    botonPausarMV.onclick = function() {
        if (activoMV) { pausarMV(); } else { moverMV(); }
    };
    botonSiguienteP.onclick = function() {
        slideSiguienteP();
    };
    botonAnteriorP.onclick = function() {
        slideAnteriorP();
    };
    botonPausarP.onclick = function() {
        if (activoP) { pausarP(); } else { moverP(); }
    };


    function slideSiguienteMV() {
        moverSlideMV(slideActualMV + 1);
    }

    function slideSiguienteP() {
        moverSlideP(slideActualP + 1);
    }

    function slideAnteriorMV() {
        moverSlideMV(slideActualMV - 1);
    }

    function slideAnteriorP() {
        moverSlideP(slideActualP - 1);
    }

    function moverSlideMV(n) {
        if (activoMV) {
            clearInterval(intervaloMV);
            intervaloMV = setInterval(slideSiguienteMV, 5000);
        }
        slidesMejorValorados[slideActualMV].className = 'slide';
        slideActualMV = (n + slidesMejorValorados.length) % slidesMejorValorados.length;
        slidesMejorValorados[slideActualMV].className = 'slide mostrado';
    }

    function moverSlideP(n) {
        if (activoP) {
            clearInterval(intervaloP);
            intervaloP = setInterval(slideSiguienteP, 5000);
        }
        slidesPreferidos[slideActualP].className = 'slide movido';
        slideActualP = (n + slidesPreferidos.length) % slidesPreferidos.length;
        slidesPreferidos[slideActualP].className = 'slide mostrado moviendo';
    }

    function moverMV() {
        botonPausarMV.innerHTML = 'Pausar';
        activoMV = true;
        intervaloMV = setInterval(slideSiguienteMV, 5000);
    }

    function pausarMV() {
        botonPausarMV.innerHTML = 'Mover';
        activoMV = false;
        clearInterval(intervaloMV);
    }

    function moverP() {
        botonPausarP.innerHTML = 'Pausar';
        activoP = true;
        intervaloP = setInterval(slideSiguienteP, 5000);
    }

    function pausarP() {
        botonPausarP.innerHTML = 'Mover';
        activoP = false;
        clearInterval(intervaloP);
    }

})