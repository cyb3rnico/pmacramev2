const findByIdUsuario = async (id)=>{
    let resp = await axios.get(`../api/usuarios/findById?id=${id}`);
    return resp.data;
};



let ventas;
// const getClientes = async(filtro = "todos")=>{
//     let resp;
//     if(filtro == "todos"){
//         resp = await axios.get("../api/clientes/get");
//     }else{
//         resp = await axios.get(`../api/clientes/filtrar?filtro=${filtro}`);
//     }
//     return resp.data;
// };

// const getProductos = async()=>{
//     let resp;
//     resp = await axios.get("../api/productos/get");
//     return resp.data;
// };



// const cargarProductos = async(select)=>{
//     let filtroProd = select;
//     let productos = await getProductos();
//     productos.forEach(p=>{
//         let option = document.createElement("option");
//         option.value = p.id;
//         option.innerText = p.nombre;
//         filtroProd.appendChild(option);
//     });
// };

const getClientes= async()=>{
    let resp;
    resp = await axios.get("../api/clientes/get");
    return resp.data;
};



const cargarClientes = async(select)=>{
    let filtroCliente = select;
    let clientes = await getClientes();
    clientes.forEach(c=>{
        let option = document.createElement("option");
        option.value = c.rut;
        option.innerText = c.nombre + ' ' + c.apellidos;
        filtroCliente.appendChild(option);
    });
};

const iniciarEliminacion = async function(){
    let id = this.idVenta;
    let resp = await Swal.fire({
        title: "¿Estás seguro que desea eliminar la venta?",
        text: "Esta operación es irreversible",
        icon: "error",
        showCancelButton: true
    });
    if(resp.isConfirmed){
        if(await eliminarVenta(id)){
            ventas = await getVentas();
            cargarTabla(ventas);
            Swal.fire("Venta eliminado", "La venta ha sido eliminada con éxito","info");
        }else{
            Swal.fire("Error", "No se pudo procesador la solicitud de eliminación", "error");
        }
    }else{
        Swal.fire("Cancelado", "Usted ha cancelado la eliminación");
    }
};



const cargarTabla = (ventas)=>{
    let tbody = document.querySelector("#tbody-venta");

    tbody.innerHTML = "";

    for(let i=0; i < ventas.length; ++i){
        let tr = document.createElement("tr");


        let tdId = document.createElement("td");
        tdId.innerText = ventas[i].id;
        
        let tdProducto = document.createElement("td");
        
        let product = "";
        for(let j = 0; j<ventas[i].productos.length; ++j){
            if(j==0){
                product = ventas[i].productos[j].nombre;
            }else{
                product = product + ', ' + ventas[i].productos[j].nombre;
            }
            
        }
        tdProducto.innerText = product;
    

        let tdCliente = document.createElement("td");
        tdCliente.innerText = ventas[i].cliente.nombre + ' ' + ventas[i].cliente.apellidos;

        let tdCantidad = document.createElement("td");
        tdCantidad.innerText = ventas[i].cantidad;

        let tdTotal = document.createElement("td");
        tdTotal.innerText = "$ " + ventas[i].total;

        let fechaFormatear = ventas[i].fecha;
        let fechaFormateada = `${fechaFormatear.split(" ")[0].split("-").reverse().join("-")} a las ${fechaFormatear.split(" ")[1]}`;
        let tdFecha = document.createElement("td");
        tdFecha.innerText = fechaFormateada;


        let tdAccion = document.createElement("td");

        // let botonActualizar = document.createElement("button");
        // botonActualizar.innerText = "Actualizar";
        // botonActualizar.classList.add("btn","btn-warning");
        // botonActualizar.idVenta = ventas[i].id;
        // botonActualizar.addEventListener("click", iniciarActualizacion);
        let rol = document.querySelector("#rol-txt");

        if(rol.value == "Administrador"){
            let botonEliminar = document.createElement("button");
            botonEliminar.innerText = "Eliminar";
            botonEliminar.classList.add("btn","btn-danger","text-center");
            botonEliminar.idVenta = ventas[i].id;
            botonEliminar.addEventListener("click", iniciarEliminacion);
            tdAccion.appendChild(botonEliminar);
        }

        

        tr.appendChild(tdId);
        tr.appendChild(tdProducto);
        tr.appendChild(tdCliente);
        tr.appendChild(tdCantidad);
       
        tr.appendChild(tdTotal);
        tr.appendChild(tdFecha);
        tr.appendChild(tdAccion);

        tbody.appendChild(tr);
    }
};

document.querySelector("#filtro-cliente").addEventListener("change", async()=>{
    let filtro = document.querySelector("#filtro-cliente").value;
    ventas = await getVentas(filtro);
    document.querySelector("#busqueda-txt").value = "";
    cargarTabla(ventas);
});

document.querySelector("#busqueda-btn").addEventListener("click", function() {
    let busqueda = document.querySelector("#busqueda-txt").value.trim();
    let resultado = buscarFecha(busqueda.split(" ")[0].split("-").reverse().join("-"));
    cargarTabla(resultado);
});


document.addEventListener("DOMContentLoaded", async()=>{
    await cargarClientes(document.querySelector("#filtro-cliente"));
    // await cargarTipoVenta(document.querySelector(".tipoventa-select"));
    // await cargarContactos(document.querySelector(".contactoventa-select"));
    // await cargarProductos(document.querySelector(".productoventa-select"));
    ventas = await getVentas();
    cargarTabla(ventas);
});

function buscarFecha(fecha) {
    let buscar;
    buscar = ventas.filter(venta=>venta.fecha.toLowerCase().includes(fecha.toLowerCase()));
    
    return buscar;
}