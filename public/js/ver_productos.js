const getMateriales = async()=>{
    let resp;
    resp = await axios.get("../api/materiales/get");
    return resp.data;
};

const cargarMateriales = async()=>{
    let materiales = await getMateriales();
    let materialSelect = document.querySelector(".materiales-select");

    materiales.forEach(m=>{
        let option = document.createElement("option");
        option.value = m.id;
        option.innerText = m.nombre;
        materialSelect.appendChild(option);
    });
};


let productos;
//obtenemos las categorías de la otra tabla

const getCategorias = async()=>{
    let resp;
    resp = await axios.get("../api/categorias/get");
    return resp.data;
};

const cargarCategorias = async(select)=>{
    let filtroCtg = select;
    let categorias = await getCategorias();

    categorias.forEach(c=>{
        let option = document.createElement("option");
        option.value = c.id;
        option.innerText = c.nombreCat;
        filtroCtg.appendChild(option);
    });

};

const actualizar = async function(){
    let idProducto = this.idProducto;
    let producto = await findById(idProducto);
    let molde = this.parentNode.parentNode;
    // let materiale_id = $('#materiales-select').val();
    producto.nombre = molde.querySelector(".nombre-txt").value.trim();
    producto.categoria_id = molde.querySelector(".categoria-select").value;
    // producto.materiales = $('.materiales-select').val();
    // producto.cantidad_material = molde.querySelector(".cantidad-material-txt").value;
    producto.descripcion = molde.querySelector(".descripcion-txt").value.trim();
    producto.cantidad = molde.querySelector(".cantidad-txt").value.trim();
    producto.precio = molde.querySelector(".precio-txt").value.trim();

    let errores = [];

    if(producto.nombre === ""){
        errores.push("Debe ingresar un nombre");
    }/*else{
        let productos = await getProductos();
        let productoEncontrado = productos.find(p=>p.nombre.toLowerCase() === producto.nombre.toLowerCase());
        if(productoEncontrado != undefined){
            errores.push("El producto ya existe");
        }
    }*/

    if(producto.nombre.length >= 50){
        errores.push("El nombre del producto no puede superar los 50 carácteres");
    }

    if(producto.categoria_id == ""){
        errores.push("Debe ingresar una categoría");
    }
    // if(producto.materiales === ""){
    //     errores.push("Debe ingresar un material al menos");
    // }

    
    // if(producto.cantidad_material === ""){
    //     errores.push("Debe ingresar una cantidad para cada material");
    // }


    // if (producto.cantidad_material <=0) {
    //     errores.push("La cantidad de cada material debe ser mayor o igual a 1");
    // }

    if(producto.descripcion === ""){
        errores.push("Debe ingresar una descripción/imágen");
    }

    if(producto.descripcion.length > 300 ){
        errores.push("Enlace de imágen demasiado largo");
    }
  
    if(producto.cantidad === ""){
        errores.push("Debe ingresar una cantidad correcta");
    }
    
    if(producto.cantidad <= 0){
        errores.push("Debe ingresar una cantidad mayor a cero");
    }

    if(producto.precio === ""){
        errores.push("Debe ingresar un precio correcto");
    }

    if(producto.precio <= 0){
        errores.push("El precio debe ser mayor o igual a 1");
    }

    if(errores.length == 0){
        await actualizarProducto(producto);
        await Swal.close();
        let filtro = document.querySelector("#filtro-ctg").value;
        productos = await getProductos(filtro);
        cargarTabla(productos);
    }else{
        Swal.fire({
            title: "Errores de validación",
            icon: "warning",
            html: errores.join("<br />")
        });
    }
};

const iniciarActualizacion = async function(){
    let idProducto = this.idProducto;
    let producto = await findById(idProducto);
  
    let molde = document.querySelector(".molde-actualizar").cloneNode(true);
    molde.querySelector(".nombre-txt").value = producto.nombre;
    molde.querySelector(".categoria-select").value = producto.categoria_id;
    // molde.querySelector(".materiales-select").value = producto.materiales;
    // molde.querySelector(".cantidad-material-txt").value = producto.cantidad_material;
    molde.querySelector(".descripcion-txt").value = producto.descripcion;
    molde.querySelector(".cantidad-txt").value = producto.cantidad;
    molde.querySelector(".precio-txt").value = producto.precio;

    molde.querySelector(".actualizar-btn").idProducto = idProducto;
    molde.querySelector(".actualizar-btn").addEventListener("click", actualizar);
    await Swal.fire({
        title:"Actualizar Producto",
        html: molde,
        confirmButtonText: "Cerrar"
    });
  
};



const iniciarEliminacion = async function(){
    let id = this.idProducto;
    let resp = await Swal.fire({
        title: "¿Estás seguro que desea eliminar el producto?",
        text: "Esta operación es irreversible",
        icon: "error",
        showCancelButton: true
    });
    if(resp.isConfirmed){
        if(await eliminarProducto(id)){
            productos = await getProductos();
            cargarTabla(productos);
            Swal.fire("Producto eliminado", "El producto ha sido eliminado con éxito","info");
        }else{
            Swal.fire("Error", "No se pudo eliminar el producto, tiene ventas o materiales asociadas", "error");
        }
    }else{
        Swal.fire("Cancelado", "Usted ha cancelado la eliminación");
    }
};

const verMateriales = async function(){
    let idProducto = this.idProducto;
    let producto = await findById(idProducto);
    //console.log(producto.materiales);
    console.log(producto);

    let molde = document.querySelector(".molde-ver-materiales").cloneNode(true);
    let verMaterialSelect = molde.querySelector(".ver-materiales-select");
    producto.materiales.forEach(m=>{
        let option = document.createElement("option");
        option.value = m.id;
        option.innerText = m.nombre + ' => ' + producto.cantidad_material + ' unidades';
        // console.log(m,option);
        verMaterialSelect.appendChild(option);
    });
  
    // let molde = document.querySelector(".molde-ver-materiales").cloneNode(true);
    // molde.querySelector(".materiales-select").value = 0;

    // producto.materiales.forEach(p=>{
    //     let option = document.createElement("option");
    //     option.value = p.id;
    //     option.innerText = p.nombreCat;
    //     molde.appendChild(option);
    // });
    
    await Swal.fire({
        title:"Ver Materiales",
        html: molde,
        confirmButtonText: "Cerrar"
    });
};


const cargarTabla = (productos)=>{
    let tbody = document.querySelector("#tbody-producto");

    tbody.innerHTML = "";

    for(let i=0; i < productos.length; ++i){
        let tr = document.createElement("tr");

        let tdNro = document.createElement("td");
        tdNro.innerText = productos[i].id;

        let tdNombre = document.createElement("td");
        tdNombre.innerText = productos[i].nombre;

        let tdCategoria = document.createElement("td");
        tdCategoria.innerText = productos[i].categoria.nombreCat;

        let tdDescripcion = document.createElement("td");
        tdDescripcion.innerHTML = productos[i].descripcion;

        let tdCantidad = document.createElement("td");
        tdCantidad.innerText = productos[i].cantidad;

        let tdPrecio = document.createElement("td");
        tdPrecio.innerText = "$ " + productos[i].precio;

        let fechaFormatear = productos[i].fecha;
        let fechaFormateada = `${fechaFormatear.split(" ")[0].split("-").reverse().join("-")} a las ${fechaFormatear.split(" ")[1]}`;
        let tdFecha = document.createElement("td");
        tdFecha.innerText = fechaFormateada;

        let tdAccion = document.createElement("td");

        let botonActualizar = document.createElement("button");
        botonActualizar.innerText = "Actualizar";
        botonActualizar.classList.add("btn","btn-warning","text-center","ms-1","me-3","text-white");
        botonActualizar.idProducto = productos[i].id;
        botonActualizar.addEventListener("click", iniciarActualizacion);

        let botonEliminar = document.createElement("button");
        botonEliminar.innerText = "Eliminar";
        botonEliminar.classList.add("btn","btn-danger","text-center","ms-1","me-3","text-white");
        botonEliminar.idProducto = productos[i].id;
        botonEliminar.addEventListener("click", iniciarEliminacion);

        let botonVerMateriales = document.createElement("button");
        botonVerMateriales.innerText = "Ver Materiales";
        botonVerMateriales.classList.add("btn","btn-success","text-center","ms-1","me-3","text-white");
        botonVerMateriales.idProducto = productos[i].id;
        botonVerMateriales.addEventListener("click", verMateriales);


        tdAccion.appendChild(botonActualizar);
        tdAccion.appendChild(botonEliminar);
        tdAccion.appendChild(botonVerMateriales);

        tr.appendChild(tdNro);
        tr.appendChild(tdNombre);
        tr.appendChild(tdCategoria);
        tr.appendChild(tdDescripcion);
        tr.appendChild(tdCantidad);
        tr.appendChild(tdPrecio);
        tr.appendChild(tdFecha);
        tr.appendChild(tdAccion);

        tbody.appendChild(tr);
    }
};

document.querySelector("#filtro-ctg").addEventListener("change", async()=>{
    let filtro = document.querySelector("#filtro-ctg").value;
    productos = await getProductos(filtro);
    document.querySelector("#busqueda-txt").value = "";
    cargarTabla(productos);
});

// document.querySelector("#busqueda-btn").addEventListener("click", async()=>{
//     let busqueda = document.querySelector("#busqueda-txt").value.trim();
//     let productos = await getProductos(busqueda);
//     cargarTabla(productos);
// });
document.querySelector("#busqueda-btn").addEventListener("click", function() {
    let busqueda = document.querySelector("#busqueda-txt").value.trim();
    let resultado = buscarProducto(busqueda);
    cargarTabla(resultado);
});


document.addEventListener("DOMContentLoaded", async()=>{
    await cargarCategorias(document.querySelector("#filtro-ctg"));
    await cargarCategorias(document.querySelector(".categoria-select"));
    // await cargarMateriales(document.querySelector(".materiales-select"));
    productos = await getProductos();
    cargarTabla(productos);
});

function buscarProducto(nombre) {
    let buscar;
    buscar = productos.filter(producto=>producto.nombre.toLowerCase().includes(nombre.toLowerCase()));
    return buscar;
}