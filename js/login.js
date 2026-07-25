
const password = document.getElementById("password");
const verPassword = document.getElementById("verPassword");

verPassword.addEventListener("click", function () {

    if (password.type === "password") {

        password.type = "text";
        verPassword.textContent = "Ocultar";

    } else {

        password.type = "password";
        verPassword.textContent = "Mostrar";

    }

});

const botonDaltonismo = document.getElementById("daltonismo");

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

const formulario = document.querySelector("form");

formulario.addEventListener("submit", function (e) {

    const correo = document.querySelector("input[name='correo']").value.trim();
    const contraseña = password.value.trim();

    if (correo === "" || contraseña === "") {

        alert("Debes completar todos los campos.");
        e.preventDefault();

    }

});