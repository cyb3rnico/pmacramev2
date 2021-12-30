let proveedores;

// const cargarTipos = async(select)=>{
//     let filtroTipo = select;
//     let tipos = await getTipos();

//     tipos.forEach(t=>{
//         let option = document.createElement("option");
//         option.innerText = t;
//         option.value = t;
//         filtroTipo.appendChild(option);
//     });

// };

const actualizar = async function(){
    let rutProveedor = this.rutProveedor;
    let proveedor = await findByRut(rutProveedor);
    let molde = this.parentNode.parentNode;
    
    proveedor.nombre = molde.querySelector(".nombre-txt").value.trim();
    proveedor.apellidos = molde.querySelector(".apellidos-txt").value.trim();
    proveedor.direccion = molde.querySelector(".direccion-txt").value.trim();
    proveedor.email = molde.querySelector(".email-txt").value.trim();
    proveedor.telefono = molde.querySelector(".telefono-txt").value.trim();
    

    let errores = [];

    if(proveedor.nombre === ""){
        errores.push("Debe ingresar un nombre");
    }

    if(proveedor.nombre.length >= 40){
        errores.push("El nombre del proveedor no puede ser mayor a 40 carácteres");
    }

    if(proveedor.apellidos === ""){
        errores.push("Debe ingresar los apellidos");
    }

    if(proveedor.apellidos.length >= 40){
        errores.push("Los apellidos del proveedor no pueden ser mayor a 40 carácteres");
    }

    if(proveedor.direccion === ""){
        errores.push("Debe ingresar una dirección");
    }

    if(proveedor.direccion.length >= 50){
        errores.push("La dirección no puede ser mayor a 50 carácteres");
    }

    if(proveedor.email === ""){
        errores.push("Debe ingresar un email");
    }

    if(proveedor.email.length >= 50){
        errores.push("El email no puede ser mayor a 50 carácteres");
    }

    if(proveedor.telefono === ""){
        errores.push("Debe ingresar un teléfono de contacto");
    }

    if(proveedor.telefono.length >= 20){
        errores.push("El teléfono no puede tener más de 20 carácteres");
    }


    if(errores.length == 0){
        await actualizarProveedor(proveedor);
        await Swal.close();
        // let filtro = document.querySelector("#filtro-ctg").value;
        proveedores = await getProveedores();
        cargarTabla(proveedores);
    }else{
        Swal.fire({
            title: "Errores de validación",
            icon: "warning",
            html: errores.join("<br />")
        });
    }
};

const iniciarActualizacion = async function(){
    let rutProveedor = this.rutProveedor;
    let proveedor = await findByRut(rutProveedor);
  
    let molde = document.querySelector(".molde-actualizar").cloneNode(true);
    molde.querySelector(".nombre-txt").value = proveedor.nombre;
    molde.querySelector(".apellidos-txt").value = proveedor.apellidos;
    molde.querySelector(".direccion-txt").value = proveedor.direccion;
    molde.querySelector(".email-txt").value = proveedor.email;
    molde.querySelector(".telefono-txt").value = proveedor.telefono;
    

    molde.querySelector(".actualizar-btn").rutProveedor = rutProveedor;
    molde.querySelector(".actualizar-btn").addEventListener("click", actualizar);
    await Swal.fire({
        title:"Actualizar Proveedor",
        html: molde,
        confirmButtonText: "Cerrar"
    });
  
};

const iniciarEliminacion = async function(){
    let rut = this.rutProveedor;
    let resp = await Swal.fire({
        title: "¿Estás seguro que desea eliminar el proveedor?",
        text: "Esta operación es irreversible",
        icon: "error",
        showCancelButton: true
    });
    if(resp.isConfirmed){
        if(await eliminarProveedor(rut)){
            proveedores = await getProveedores();
            cargarTabla(proveedores);
            Swal.fire("Proveedor eliminado", "El proveedor ha sido eliminado con éxito","info");
        }else{
            Swal.fire("Error", "No se pudo eliminar el proveedor, tiene materiales asociados", "error");
        }
    }else{
        Swal.fire("Cancelado", "Usted ha cancelado la eliminación");
    }
};



const cargarTabla = (proveedores)=>{
    let tbody = document.querySelector("#tbody-proveedor");

    tbody.innerHTML = "";

    for(let i=0; i < proveedores.length; ++i){
        let tr = document.createElement("tr");

        let tdRut = document.createElement("td");
        tdRut.innerText = proveedores[i].rut;

        let tdNombre = document.createElement("td");
        tdNombre.innerText = proveedores[i].nombre;

        let tdApellidos = document.createElement("td");
        tdApellidos.innerText = proveedores[i].apellidos;

        let tdDireccion = document.createElement("td");
        tdDireccion.innerText = proveedores[i].direccion;

        let tdEmail = document.createElement("td");
        tdEmail.innerText = proveedores[i].email;

        let tdTelefono = document.createElement("td");
        tdTelefono.innerText = proveedores[i].telefono;

        

        

        let tdAccion = document.createElement("td");

        let botonActualizar = document.createElement("button");
        botonActualizar.innerText = "Actualizar";
        botonActualizar.classList.add("btn","btn-warning","text-center","ms-1","me-3","text-white");
        botonActualizar.rutProveedor = proveedores[i].rut;
        botonActualizar.addEventListener("click", iniciarActualizacion);

        let botonEliminar = document.createElement("button");
        botonEliminar.innerText = "Eliminar";
        botonEliminar.classList.add("btn","btn-danger","text-center");
        botonEliminar.rutProveedor = proveedores[i].rut;
        botonEliminar.addEventListener("click", iniciarEliminacion);

        tdAccion.appendChild(botonActualizar);
        tdAccion.appendChild(botonEliminar);

        tr.appendChild(tdRut);
        tr.appendChild(tdNombre);
        tr.appendChild(tdApellidos);
        tr.appendChild(tdDireccion);
        tr.appendChild(tdEmail);
        tr.appendChild(tdTelefono);
        
        
        tr.appendChild(tdAccion);

        tbody.appendChild(tr);
    }
};

// document.querySelector("#filtro-ctg").addEventListener("change", async()=>{
//     let filtro = document.querySelector("#filtro-ctg").value;
//     proveedores = await getContactos(filtro);
//     cargarTabla(proveedores);
// });


document.addEventListener("DOMContentLoaded", async()=>{
    // await cargarTipos(document.querySelector("#filtro-ctg"));
    // await cargarTipos(document.querySelector(".tipo-select"));
    proveedores = await getProveedores();
    cargarTabla(proveedores);
});

document.querySelector("#busqueda-btn").addEventListener("click", function() {
    let busqueda = document.querySelector("#busqueda-txt").value.trim();
    let resultado = buscarProveedor(busqueda);
    cargarTabla(resultado);
});

function buscarProveedor(apellidos) {
    let buscar;
    buscar = proveedores.filter(proveedor=>proveedor.apellidos.toLowerCase().includes(apellidos.toLowerCase()));
    return buscar;
}