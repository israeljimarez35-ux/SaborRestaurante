document.addEventListener("DOMContentLoaded", function () {

    const boton = document.getElementById("confirmarPedido");

    if (boton) {

        boton.addEventListener("click", function () {

            if (confirm("¿Deseas confirmar tu pedido?")) {

                fetch("../php/confirmarPedido.php", {
                    method: "POST"
                })
                .then(respuesta => respuesta.text())
                .then(resultado => {

                    document.open();
                    document.write(resultado);
                    document.close();

                })
                .catch(error => {

                    alert("Ocurrió un error al confirmar el pedido.");
                    console.log(error);

                });

            }

        });

    }

});