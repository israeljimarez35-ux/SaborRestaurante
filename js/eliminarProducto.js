document.addEventListener("DOMContentLoaded", function () {

    document.addEventListener("click", function (e) {

        if (e.target.classList.contains("eliminar")) {

            let idCarrito = e.target.dataset.id;

            if (confirm("¿Deseas eliminar este producto del carrito?")) {

                fetch("../php/eliminarProducto.php", {

                    method: "POST",

                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded"
                    },

                    body: "id_carrito=" + idCarrito

                })

                .then(respuesta => respuesta.text())

                .then(mensaje => {

                    alert(mensaje);

                    location.reload();

                })

                .catch(error => {

                    console.log(error);

                });

            }

        }

    });

});