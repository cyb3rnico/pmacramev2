
// const getProductos = async()=>{
//     let resp;
//     resp = await axios.get("../api/productos/get");
//     return resp.data;
// };

const getProveedores = async()=>{
    let resp;
    resp = await axios.get("../api/proveedores/get");

    return resp.data;
};



// const cargarProductos = async()=>{
//     let productos = await getProductos();
//     let productoSelect = document.querySelector("#producto-select");
//     productos.forEach(p=>{
//         let option = document.createElement("option");
//         option.value = p.id;
//         option.innerText = p.nombre;
//         productoSelect.appendChild(option);
//     });
// };

const cargarProveedores = async()=>{
    let proveedores = await getProveedores();
    let proveedorSelect = document.querySelector("#proveedor-select");
    proveedores.forEach(p=>{
        let option = document.createElement("option");
        option.value = p.rut;
        option.innerText = p.rut + ' ' + p.nombre  + ' ' + p.apellidos;
        proveedorSelect.appendChild(option);
    });
};



document.addEventListener("DOMContentLoaded", ()=>{
    //cargarProductos();
    cargarProveedores();
});

document.querySelector("#registrar-btn").addEventListener("click", async()=>{
    let nombre = document.querySelector("#nombre-txt").value.trim();
    let descripcion = document.querySelector("#descripcion-txt").value.trim();
    let rut_proveedor = document.querySelector("#proveedor-select").value.trim();
    let unidad_medida = document.querySelector("#unidad-medida-txt").value.trim();
    let stock_minimo = document.querySelector("#stock-minimo-txt").value.trim();
    let stock_maximo = document.querySelector("#stock-maximo-txt").value.trim();
    let precio = document.querySelector("#precio-txt").value.trim();


    let errores = [];

    if(nombre === ""){
        errores.push("Debe ingresar un nombre");
    }else{
        let materiales = await getMateriales();
        let materialEncontrado = materiales.find(m=>m.nombre.toLowerCase() == nombre.toLowerCase());
        if(materialEncontrado != undefined){
            errores.push("El material ya existe");
        }
    }

    if (nombre.length >= 50) {
        errores.push("El nombre no puede tener más de 50 carácteres");
    }

    if(descripcion === ""){
        errores.push("Debe ingresar una descripción");
    }

    if (descripcion.length >= 100) {
        errores.push("La descripción no puede tener más de 100 carácteres");
    }

    if(rut_proveedor == ""){
        errores.push("Debe ingresar un proveedor");
    }

    if(unidad_medida === ""){
        errores.push("Debe ingresar una unidad de medida");
    }

    if (unidad_medida.length >= 10) {
        errores.push("El nombre no puede tener más de 10 carácteres");
    }

    if(stock_minimo === ""){
        errores.push("Debe ingresar un stock mínimo");
    }

    if(stock_minimo <= 0){
        errores.push("El stock mínimo no puede ser menor a 1");
    }

    if(stock_maximo === ""){
        errores.push("Debe ingresar un stock máximo");
    }

    if(stock_minimo <= 0){
        errores.push("El stock máximo no puede ser menor a 1");
    }

    if(precio === ""){
        errores.push("Debe ingresar un precio unitario");
    }

    if(precio <= 0){
        errores.push("El precio unitario no puede ser menor a 1");
    }

    if(errores.length == 0){
        let material = {};
        material.nombre = nombre;
        material.descripcion = descripcion;
        material.rut_proveedor = rut_proveedor;
        material.unidad_medida = unidad_medida;
        material.stock_minimo = stock_minimo;
        material.stock_maximo = stock_maximo;
        material.precio = precio;

        let res = await crearMaterial(material);

        await Swal.fire("Material ingresado", "Operación realizada con éxito","success");

        window.location.href = "ver_materiales";
    }else{
        Swal.fire({
            title: "Errores de validación",
            icon: "warning",
            html: errores.join("<br />")
        });
    }
});