//===============================
// AGREGAR PRODUCTOS AL CARRITO
//===============================

const botonesAgregar = document.querySelectorAll(".agregar");

botonesAgregar.forEach((boton) => {

    boton.addEventListener("click", function(){

        const idProducto = this.dataset.id;

        fetch("php/agregarCarrito.php",{

            method:"POST",

            headers:{
                "Content-Type":"application/x-www-form-urlencoded"
            },

            body:"id_producto="+idProducto

        })

        .then(respuesta => respuesta.text())

        .then(mensaje =>{

            alert(mensaje);

        })

        .catch(error =>{

            console.log(error);

        });

    });

});