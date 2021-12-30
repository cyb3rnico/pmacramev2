
const getProveedores = async()=>{
    let resp;
        resp = await axios.get("../api/proveedores/get");
    return resp.data;
};

const cargarProveedores = async(select)=>{
    let filtroPvd = select;
    let proveedores = await getProveedores();

    proveedores.forEach(p=>{
        let option = document.createElement("option");
        option.value = p.rut;
        option.innerText = p.nombre + ' ' + p.apellidos;
        filtroPvd.appendChild(option);
    });

};

let materiales = getMateriales();

const actualizar = async function(){
    let idMaterial = this.idMaterial;
    let material = await findById(idMaterial);
    let molde = this.parentNode.parentNode;

    material.nombre = molde.querySelector(".nombre-txt").value.trim();
    material.descripcion = molde.querySelector(".descripcion-txt").value.trim();
    material.rut_proveedor = molde.querySelector(".proveedor-select").value;
    material.unidad_medida = molde.querySelector(".unidad-medida-txt").value.trim();
    material.stock_minimo= molde.querySelector(".stock-minimo-txt").value.trim();
    material.stock_maximo = molde.querySelector(".stock-maximo-txt").value.trim();
    material.precio = molde.querySelector(".precio-txt").value.trim();

    let errores = [];

    if(material.nombre === ""){
        errores.push("Debe ingresar un nombre");
    }
    // else{
    //     let materiales = await getMateriales();
    //     let materialEncontrado = materiales.find(m=>m.nombre.toLowerCase() === material.nombre.toLowerCase());
    //     if(materialEncontrado != undefined){
    //         errores.push("El material ya existe");
    //     }
    // }

    if (material.nombre.length >= 50) {
        errores.push("El nombre no puede tener más de 50 carácteres");
    }

    if(material.descripcion === ""){
        errores.push("Debe ingresar una descripción");
    }

    if (material.descripcion.length >= 100) {
        errores.push("La descripción no puede tener más de 100 carácteres");
    }

    if(material.rut_proveedor == ""){
        errores.push("Debe ingresar un proveedor");
    }

    if(material.unidad_medida === ""){
        errores.push("Debe ingresar una unidad de medida");
    }

    if (material.unidad_medida.length >= 10) {
        errores.push("El nombre no puede tener más de 10 carácteres");
    }

    if(material.stock_minimo === ""){
        errores.push("Debe ingresar un stock mínimo");
    }

    if(material.stock_minimo <= 0){
        errores.push("El stock mínimo no puede ser menor a 1");
    }

    if(material.stock_maximo === ""){
        errores.push("Debe ingresar un stock máximo");
    }

    if(material.stock_minimo <= 0){
        errores.push("El stock máximo no puede ser menor a 1");
    }

    if(material.precio === ""){
        errores.push("Debe ingresar un precio unitario");
    }

    if(material.precio <= 0){
        errores.push("El precio unitario no puede ser menor a 1");
    }


    if(errores.length == 0){
        await actualizarMaterial(material);
        await Swal.close();
        let filtro = document.querySelector("#filtro-pvd").value;
        let materiales = await getMateriales(filtro);
        cargarTabla(materiales);
    }else{
        Swal.fire({
            title: "Errores de validación",
            icon: "warning",
            html: errores.join("<br />")
        });
    }
};

const iniciarActualizacion = async function(){
    let idMaterial = this.idMaterial;
    let material = await findById(idMaterial);
  
    let molde = document.querySelector(".molde-actualizar").cloneNode(true);
    molde.querySelector(".nombre-txt").value = material.nombre;
    molde.querySelector(".descripcion-txt").value = material.descripcion;
    molde.querySelector(".proveedor-select").value = material.rut_proveedor;
    molde.querySelector(".unidad-medida-txt").value = material.unidad_medida;
    molde.querySelector(".stock-minimo-txt").value = material.stock_minimo;
    molde.querySelector(".stock-maximo-txt").value = material.stock_maximo;
    molde.querySelector(".precio-txt").value = material.precio;

    molde.querySelector(".actualizar-btn").idMaterial = idMaterial;
    molde.querySelector(".actualizar-btn").addEventListener("click", actualizar);
    await Swal.fire({
        title:"Actualizar Material",
        html: molde,
        confirmButtonText: "Cerrar"
    });
  
};

const iniciarEliminacion = async function(){
    let id = this.idMaterial;
    let resp = await Swal.fire({
        title: "¿Estás seguro que desea eliminar el material?",
        text: "Esta operación es irreversible",
        icon: "error",
        showCancelButton: true
    });
    if(resp.isConfirmed){
        if(await eliminarMaterial(id)){
            materiales = await getMateriales();
            cargarTabla(materiales);
            Swal.fire("Material eliminado", "El material ha sido eliminado con éxito","info");
        }else{
            Swal.fire("Error", "El material tiene productos asociados", "error");
        }
    }else{
        Swal.fire("Cancelado", "Usted ha cancelado la eliminación");
    }
};



const cargarTabla = (materiales)=>{
    let tbody = document.querySelector("#tbody-material");

    tbody.innerHTML = "";

    for(let i=0; i < materiales.length; ++i){
        let tr = document.createElement("tr");

        let tdId = document.createElement("td");
        tdId.innerText = materiales[i].id;

        let tdNombre = document.createElement("td");
        tdNombre.innerText = materiales[i].nombre;

        let tdDescripcion = document.createElement("td");
        tdDescripcion.innerText = materiales[i].descripcion;

        let tdRutProveedor = document.createElement("td");
        tdRutProveedor.innerText = materiales[i].proveedor.nombre + ' ' + materiales[i].proveedor.apellidos;

        let tdUnidadMedida = document.createElement("td");
        tdUnidadMedida.innerText = materiales[i].unidad_medida;

        let tdStock = document.createElement("td");
        tdStock.innerText = materiales[i].stock;

        let tdPrecio = document.createElement("td");
        tdPrecio.innerText = materiales[i].precio;

        let tdFecha = document.createElement("td");
        tdFecha.innerText = materiales[i].fecha;

        let tdTotal = document.createElement("td");
        tdTotal.innerText = '$ ' + materiales[i].precio * materiales[i].stock;

        let tdAccion = document.createElement("td");

        let botonActualizar = document.createElement("button");
        botonActualizar.innerText = "Actualizar";
        botonActualizar.classList.add("btn","btn-warning","text-white","me-3");
        botonActualizar.idMaterial = materiales[i].id;
        botonActualizar.addEventListener("click", iniciarActualizacion);

        let botonEliminar = document.createElement("button");
        botonEliminar.innerText = "Eliminar";
        botonEliminar.classList.add("btn","btn-danger","text-center","ms-1","me-3","text-white");
        botonEliminar.idMaterial = materiales[i].id;
        botonEliminar.addEventListener("click", iniciarEliminacion);
        
        tdAccion.appendChild(botonActualizar);
        tdAccion.appendChild(botonEliminar);

        tr.appendChild(tdId);
        tr.appendChild(tdFecha);
        tr.appendChild(tdNombre);
        tr.appendChild(tdDescripcion);
        tr.appendChild(tdRutProveedor);
        tr.appendChild(tdUnidadMedida);
        tr.appendChild(tdStock);
        tr.appendChild(tdPrecio);
        tr.appendChild(tdTotal);
        tr.appendChild(tdAccion);

        tbody.appendChild(tr);
    }
};

document.querySelector("#filtro-pvd").addEventListener("change", async()=>{
    let filtro = document.querySelector("#filtro-pvd").value;
    materiales = await getMateriales(filtro);
    document.querySelector("#busqueda-txt").value = "";
    cargarTabla(materiales);
});

document.querySelector("#busqueda-btn").addEventListener("click", function() {
    let busqueda = document.querySelector("#busqueda-txt").value.trim();
    let resultado = buscarMaterial(busqueda);
    cargarTabla(resultado);
});


document.addEventListener("DOMContentLoaded", async()=>{
    await cargarProveedores(document.querySelector("#filtro-pvd"));
    await cargarProveedores(document.querySelector(".proveedor-select"));
    materiales = await getMateriales();
    cargarTabla(materiales);
});

function buscarMaterial(nombre) {
    let buscar;
    buscar = materiales.filter(material=>material.nombre.toLowerCase().includes(nombre.toLowerCase()));
    return buscar;
}