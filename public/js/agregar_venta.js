
const findByIdProducto = async (id)=>{
    let resp = await axios.get(`../api/productos/findById?id=${id}`);
    return resp.data;
};

const getClientes = async(filtro = "todos")=>{
    let resp;
    if(filtro == "todos"){
        resp = await axios.get("../api/clientes/get");
    }else{
        resp = await axios.get(`../api/clientes/filtrar?filtro=${filtro}`);
    }
    return resp.data;
};

const getProductos = async(filtro = "todos")=>{
    let resp;
    if(filtro == "todos"){
        resp = await axios.get("../api/productos/get");
    }else{
        resp = await axios.get(`../api/productos/filtrar?filtro=${filtro}`);
    }
    return resp.data;
};



const cargarProductos = async()=>{
    let productos = await getProductos();
    let productoSelect = document.querySelector("#productos-select");
    productos.forEach(p=>{
        if(p.cantidad >= 1){
            let option = document.createElement("option");
            option.value = p.id;
            option.innerText = p.nombre + '    - $' + p.precio + ' c/u';
            productoSelect.appendChild(option);
        }
        Swal.fire("Información","Solo se están listando los productos que tienen stock mayor o igual a 1","info");
        
    });
};

const cargarClientes = async()=>{
    let clientes = await getClientes();
    let clienteSelect = document.querySelector("#cliente-select");
    clientes.forEach(c=>{
        let option = document.createElement("option");
        option.value = c.rut;
        option.innerText = c.rut + ' ' + c.nombre + ' ' + c.apellidos;
        clienteSelect.appendChild(option);
    });
};


document.addEventListener("DOMContentLoaded", ()=>{
    cargarProductos();
    cargarClientes();
});


$('#calcular-btn').click(function(){
    let products = $('#productos-select').val();
    let cantidad_productos = document.querySelector("#cantidad-txt").value.trim();
    axios.post('../api/productsTotal', {
        products: products,
        cantidad_productos: cantidad_productos
      })
      .then((response) => {
        console.log(response.data);
        document.querySelector("#total-txt").value = response.data;
      }, (error) => {
        console.log(error);
      });
      
});


document.querySelector("#registrar-btn").addEventListener("click", async()=>{
    let producto_id = $('#productos-select').val();
    let cliente_rut = document.querySelector("#cliente-select").value.trim();
    let cantidad = document.querySelector("#cantidad-txt").value.trim();
    //let total = document.querySelector("#total-txt").value.trim();

    let errores = [];
    let err = [];
    console.log(producto_id);

    for (let i = 0; i < producto_id.length; ++i) {
        const element = producto_id[i];
        let obtenerId = await findByIdProducto(element);
        console.log(obtenerId.cantidad);
        console.log(cantidad);
        if(obtenerId.cantidad < cantidad){
            errores.push("El producto " + obtenerId.nombre + " tiene " + obtenerId.cantidad +  " en stock, no se puede generar la venta");
        }

    }

    if(producto_id == ""){
        errores.push("Debe ingresar al menos un producto");
    }

    if(cliente_rut == ""){
        errores.push("Debe seleccionar un cliente");
    }

    if(cantidad === ""){
        errores.push("Debe ingresar una cantidad de venta");
    }

    if(cantidad <= 0){
        errores.push("La cantidad por cada producto debe ser mayor o igual a 1")
    }

    // if(total === ""){
    //     errores.push("Debe ingresar un total de la venta");
    // }


    if(errores.length == 0){
        let venta = {};
        venta.producto_id = producto_id;
        venta.cliente_rut = cliente_rut;
        venta.cantidad = cantidad;
        //venta.total = total;


        let res = await crearVenta(venta);

        await Swal.fire("Venta registrada", "Operación realizada con éxito","success");

        window.location.href = "ver_ventas";
    }else{
        Swal.fire({
            title: "Errores de validación",
            icon: "warning",
            html: errores.join("<br />")
        });
    }
});