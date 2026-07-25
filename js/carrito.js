//==============================
// MODO DALTONISMO
//==============================

const botonDaltonismo = document.getElementById("daltonismo");

if (localStorage.getItem("daltonismo") === "activo") {
    document.body.classList.add("daltonismo");
}

if (botonDaltonismo) {

    botonDaltonismo.addEventListener("click", function () {

        document.body.classList.toggle("daltonismo");

        if (document.body.classList.contains("daltonismo")) {

            localStorage.setItem("daltonismo", "activo");

        } else {

            localStorage.removeItem("daltonismo");

        }

    });

}

//==============================
// CARGAR CARRITO
//==============================

const contenedor = document.getElementById("contenedorCarrito");
const total = document.getElementById("total");

fetch("../php/obtenerCarrito.php")

.then(respuesta => respuesta.json())

.then(productos => {

    let html = "";
    let totalPedido = 0;

    productos.forEach(producto => {

        let subtotal = producto.precio * producto.cantidad;

        totalPedido += subtotal;

        html += `

        <div class="producto">

            <img src="../imagenes/${producto.imagen}" width="100">

            <div class="info">

                <h3>${producto.nombre}</h3>

                <p>Precio: $${producto.precio}</p>

                <p>Cantidad: ${producto.cantidad}</p>

                <p>Subtotal: $${subtotal.toFixed(2)}</p>

                <button
                    class="eliminar"
                    data-id="${producto.id_carrito}">
                    Eliminar
                </button>

            </div>

        </div>

        <hr>

        `;

    });

    contenedor.innerHTML = html;

    total.innerHTML = "$" + totalPedido.toFixed(2);

})

.catch(error => {

    console.log(error);

});