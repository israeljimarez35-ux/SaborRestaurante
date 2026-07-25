
const verPassword = document.getElementById("verPassword");
const verConfirmar = document.getElementById("verConfirmar");

const password = document.getElementById("password");
const confirmar = document.getElementById("confirmar");

verPassword.addEventListener("click", function(){

    if(password.type === "password"){
        password.type = "text";
        verPassword.innerHTML = "Ocultar";
    }else{
        password.type = "password";
        verPassword.innerHTML = "Mostrar";
    }

});

verConfirmar.addEventListener("click", function(){

    if(confirmar.type === "password"){
        confirmar.type = "text";
        verConfirmar.innerHTML = "Ocultar";
    }else{
        confirmar.type = "password";
        verConfirmar.innerHTML = "Mostrar";
    }

});

const formulario = document.querySelector("form");

formulario.addEventListener("submit", function(e){

    if(password.value !== confirmar.value){

        alert("Las contraseñas no coinciden.");

        e.preventDefault();

    }

});

const botonDaltonismo = document.getElementById("daltonismo");

// Cargar preferencia guardada
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