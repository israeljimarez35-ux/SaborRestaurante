
const botonDaltonismo = document.getElementById("daltonismo");

// Cargar la preferencia guardada
if (localStorage.getItem("daltonismo") === "activo") {
    document.body.classList.add("daltonismo");
}

botonDaltonismo.addEventListener("click", function () {

    document.body.classList.toggle("daltonismo");

    if (document.body.classList.contains("daltonismo")) {
        localStorage.setItem("daltonismo", "activo");
    } else {
        localStorage.removeItem("daltonismo");
    }

});

window.onload = function(){

    console.log("Bienvenido a Sabor Restaurante.");

};