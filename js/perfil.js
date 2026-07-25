const botonDaltonismo = document.getElementById("daltonismo");
if(localStorage.getItem("daltonismo") === "activo"){
    document.body.classList.add("daltonismo");
}
botonDaltonismo.addEventListener("click",function(){
    document.body.classList.toggle("daltonismo");
    if(document.body.classList.contains("daltonismo")){
        localStorage.setItem("daltonismo","activo");
    }else{
        localStorage.removeItem("daltonismo");
    }
});
window.onload=function(){
    fetch("php/obtenerPerfil.php")
    .then(respuesta=>respuesta.json())
    .then(datos=>{
        document.getElementById("nombre").value=datos.nombre;
        document.getElementById("correo").value=datos.correo;
        document.getElementById("telefono").value=datos.telefono;
    });
}
const editar=document.getElementById("editar");
const guardar=document.getElementById("guardar");
editar.addEventListener("click",function(){
    document.getElementById("nombre").removeAttribute("readonly");
    document.getElementById("telefono").removeAttribute("readonly");
    editar.style.display="none";
    guardar.style.display="block";
});
guardar.addEventListener("click",function(){
    let nombre=document.getElementById("nombre").value;
    let telefono=document.getElementById("telefono").value;
    fetch("php/actualizarPerfil.php",{
        method:"POST",
        headers:{
            "Content-Type":"application/x-www-form-urlencoded"
        },
        body:
        "nombre="+encodeURIComponent(nombre)+
        "&telefono="+encodeURIComponent(telefono)
    })
    .then(respuesta=>respuesta.text())
    .then(mensaje=>{
        alert(mensaje);
        document.getElementById("nombre").setAttribute("readonly",true);
        document.getElementById("telefono").setAttribute("readonly",true);
        editar.style.display="block";
        guardar.style.display="none";
    });
});
document.getElementById("telefono").addEventListener("input",function(){
    this.value=this.value.replace(/[^0-9]/g,"");
});