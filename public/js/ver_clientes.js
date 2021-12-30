let clientes;

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
    let rutCliente = this.rutCliente;
    let cliente = await findByRut(rutCliente);
    let molde = this.parentNode.parentNode;
    
    cliente.nombre = molde.querySelector(".nombre-txt").value.trim();
    cliente.apellidos = molde.querySelector(".apellidos-txt").value.trim();
    cliente.direccion = molde.querySelector(".direccion-txt").value.trim();
    cliente.email = molde.querySelector(".email-txt").value.trim();
    cliente.telefono = molde.querySelector(".telefono-txt").value.trim();
    

    let errores = [];

    if(cliente.nombre === ""){
        errores.push("Debe ingresar un nombre");
    }

    if(cliente.nombre.length >= 40){
        errores.push("El nombre del proveedor no puede ser mayor a 40 carácteres");
    }

    if(cliente.apellidos === ""){
        errores.push("Debe ingresar los apellidos");
    }

    if(cliente.apellidos.length >= 40){
        errores.push("Los apellidos del proveedor no pueden ser mayor a 40 carácteres");
    }

    if(cliente.direccion === ""){
        errores.push("Debe ingresar una dirección");
    }

    if(cliente.direccion.length >= 50){
        errores.push("La dirección no puede ser mayor a 50 carácteres");
    }

    if(cliente.email === ""){
        errores.push("Debe ingresar un email");
    }

    if(cliente.email.length >= 50){
        errores.push("El email no puede ser mayor a 50 carácteres");
    }

    if(cliente.telefono === ""){
        errores.push("Debe ingresar un teléfono de contacto");
    }

    if(cliente.telefono.length >= 20){
        errores.push("El teléfono no puede tener más de 20 carácteres");
    }


    if(errores.length == 0){
        await actualizarCliente(cliente);
        await Swal.close();
        //let filtro = document.querySelector("#filtro-ctg").value;
        clientes = await getClientes();
        cargarTabla(clientes);
    }else{
        Swal.fire({
            title: "Errores de validación",
            icon: "warning",
            html: errores.join("<br />")
        });
    }
};

const iniciarActualizacion = async function(){
    let rutCliente = this.rutCliente;
    let cliente = await findByRut(rutCliente);
  
    let molde = document.querySelector(".molde-actualizar").cloneNode(true);
    molde.querySelector(".nombre-txt").value = cliente.nombre;
    molde.querySelector(".apellidos-txt").value = cliente.apellidos;
    molde.querySelector(".direccion-txt").value = cliente.direccion;
    molde.querySelector(".email-txt").value = cliente.email;
    molde.querySelector(".telefono-txt").value = cliente.telefono;
    

    molde.querySelector(".actualizar-btn").rutCliente = rutCliente;
    molde.querySelector(".actualizar-btn").addEventListener("click", actualizar);
    await Swal.fire({
        title:"Actualizar Cliente",
        html: molde,
        confirmButtonText: "Cerrar"
    });
  
};

const iniciarEliminacion = async function(){
    let rut = this.rutCliente;
    let resp = await Swal.fire({
        title: "¿Estás seguro que desea eliminar el cliente?",
        text: "Esta operación es irreversible",
        icon: "error",
        showCancelButton: true
    });
    if(resp.isConfirmed){
        if(await eliminarCliente(rut)){
            clientes = await getClientes();
            cargarTabla(clientes);
            Swal.fire("Cliente eliminado", "El proveedor ha sido eliminado con éxito","info");
        }else{
            Swal.fire("Error", "No se pudo eliminar el cliente, tiene ventas asociadas", "error");
        }
    }else{
        Swal.fire("Cancelado", "Usted ha cancelado la eliminación");
    }
};



const cargarTabla = (clientes)=>{
    let tbody = document.querySelector("#tbody-cliente");

    tbody.innerHTML = "";

    for(let i=0; i < clientes.length; ++i){
        let tr = document.createElement("tr");

        let tdRut = document.createElement("td");
        tdRut.innerText = clientes[i].rut;

        let tdNombre = document.createElement("td");
        tdNombre.innerText = clientes[i].nombre;

        let tdApellidos = document.createElement("td");
        tdApellidos.innerText = clientes[i].apellidos;

        let tdDireccion = document.createElement("td");
        tdDireccion.innerText = clientes[i].direccion;

        let tdEmail = document.createElement("td");
        tdEmail.innerText = clientes[i].email;

        let tdTelefono = document.createElement("td");
        tdTelefono.innerText = clientes[i].telefono;

        

        

        let tdAccion = document.createElement("td");

        let botonActualizar = document.createElement("button");
        botonActualizar.innerText = "Actualizar";
        botonActualizar.classList.add("btn","btn-warning","text-center","ms-1","me-3","text-white");
        botonActualizar.rutCliente = clientes[i].rut;
        botonActualizar.addEventListener("click", iniciarActualizacion);

        let botonEliminar = document.createElement("button");
        botonEliminar.innerText = "Eliminar";
        botonEliminar.classList.add("btn","btn-danger","text-center");
        botonEliminar.rutCliente = clientes[i].rut;
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
//     clientes = await getContactos(filtro);
//     cargarTabla(clientes);
// });


document.addEventListener("DOMContentLoaded", async()=>{
    // await cargarTipos(document.querySelector("#filtro-ctg"));
    // await cargarTipos(document.querySelector(".tipo-select"));
    clientes = await getClientes();
    cargarTabla(clientes);
});

document.querySelector("#busqueda-btn").addEventListener("click", function() {
    let busqueda = document.querySelector("#busqueda-txt").value.trim();
    let resultado = buscarCliente(busqueda);
    cargarTabla(resultado);
});

function buscarCliente(apellidos) {
    let buscar;
    buscar = clientes.filter(cliente=>cliente.apellidos.toLowerCase().includes(apellidos.toLowerCase()));
    return buscar;
}