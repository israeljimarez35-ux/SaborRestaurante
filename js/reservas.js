
const botonDaltonismo = document.getElementById("daltonismo");

if(localStorage.getItem("daltonismo") === "activo"){

    document.body.classList.add("daltonismo");

}

botonDaltonismo.addEventListener("click", function(){

    document.body.classList.toggle("daltonismo");

    if(document.body.classList.contains("daltonismo")){

        localStorage.setItem("daltonismo","activo");

    }else{

        localStorage.removeItem("daltonismo");

    }

});


const fecha = document.querySelector("input[name='fecha']");
const hoy = new Date().toISOString().split("T")[0];

fecha.min = hoy;


const telefono = document.querySelector("input[name='telefono']");

telefono.addEventListener("input", function(){

    this.value = this.value.replace(/[^0-9]/g,"");

});

const personas = document.querySelector("input[name='personas']");

personas.addEventListener("input", function(){

    if(this.value < 1){

        this.value = 1;

    }

    if(this.value > 20){

        this.value = 20;

    }

});

const formulario = document.querySelector("form");

formulario.addEventListener("submit", function(e){

    const confirmar = confirm("¿Deseas confirmar tu reserva?");

    if(!confirmar){

        e.preventDefault();

    }

});


window.onload = function(){

    console.log("Formulario de reservas cargado correctamente.");

}