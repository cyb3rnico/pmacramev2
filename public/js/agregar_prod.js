const findByIdMaterial = async (id)=>{
    let resp = await axios.get(`../api/materiales/findById?id=${id}`);
    return resp.data;
};


const getMateriales = async()=>{
    let resp;
    resp = await axios.get("../api/materiales/get");
    return resp.data;
};

const cargarMateriales = async()=>{
    let materiales = await getMateriales();
    let materialSelect = document.querySelector("#materiales-select");

    materiales.forEach(m=>{
        if(m.stock >= 1 ){
            let option = document.createElement("option");
            option.value = m.id;
            option.innerText = m.nombre;
            materialSelect.appendChild(option);
        }
        Swal.fire("Información","Solo se están listando los materiales que tienen stock mayor o igual a 1","info");
    });
};

const getCategorias = async()=>{
    let resp;
    resp = await axios.get("../api/categorias/get");
    return resp.data;
};


const cargarCategorias = async()=>{
    let categorias = await getCategorias();
    let categoriaSelect = document.querySelector("#categoria-select");

    categorias.forEach(c=>{
        let option = document.createElement("option");
        option.value = c.id;
        option.innerText = c.nombreCat;
        categoriaSelect.appendChild(option);
    });
};


tinymce.init({
    selector: '#descripcion-txt',
    height: 200,
    menubar: false,
    plugins: [
        'advlist autolink lists link image charmap print preview anchor',
        'searchreplace visualblocks code fullscreen',
        'insertdatetime media table paste code help wordcount'
    ],
    toolbar: 'undo redo | formatselect | ' +
        'bold italic backcolor | alignleft aligncenter ' +
        'alignright alignjustify | bullist numlist outdent indent | ' +
        'removeformat | help',
    content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
});

//obtenemos las categorías de la otra tabla



document.addEventListener("DOMContentLoaded", ()=>{
    cargarCategorias();
    cargarMateriales();
});

document.querySelector("#registrar-btn").addEventListener("click", async()=>{
    let nombre = document.querySelector("#nombre-txt").value.trim();
    let categoria_id = document.querySelector("#categoria-select").value.trim();
    let materiales = $('#materiales-select').val();
    let cantidad_material = document.querySelector("#cantidad-material-txt").value.trim();
    //let materiales = document.querySelector("#materiales-select").value;
    let descripcion = tinymce.get("descripcion-txt").getContent().trim();
    let cantidad = +document.querySelector("#cantidad-txt").value.trim();
    let precio = +document.querySelector("#precio-txt").value.trim();

    let errores = [];

    for (let i = 0; i < materiales.length; ++i) {
        const element = materiales[i];
        let obtenerId = await findByIdMaterial(element);
        // console.log(obtenerId.cantidad);
        // console.log(cantidad);
        if(obtenerId.stock < cantidad_material){
            errores.push("El material " + obtenerId.nombre + " tiene " + obtenerId.stock +  " en stock, no se puede agregar el producto");
        }

    }

    if(nombre === ""){
        errores.push("Debe ingresar un nombre");
    }else{
        //Si el producto existe
        let productos = await getProductos();
        let productoEncontrado = productos.find(p=>p.nombre.toLowerCase() === nombre.toLowerCase());
        if(productoEncontrado != undefined){
            errores.push("El producto ya existe");
        }
    }
    
    if(nombre.length >= 50){
        errores.push("El nombre del producto no puede superar los 50 carácteres");
    }

    if(categoria_id == ""){
        errores.push("Debe ingresar una categoría");
    }
    if(materiales == ""){
        errores.push("Debe ingresar un material al menos");
    }

    
    if(cantidad_material === ""){
        errores.push("Debe ingresar una cantidad para cada material");
    }


    if (cantidad_material <=0) {
        errores.push("La cantidad de cada material debe ser mayor o igual a 1");
    }

    if(descripcion === ""){
        errores.push("Debe ingresar una descripción/imágen");
    }

    if(descripcion.length > 300 ){
        errores.push("Enlace de imágen demasiado largo");
    }


  
    if(cantidad === ""){
        errores.push("Debe ingresar una cantidad correcta");
    }
    
    if(cantidad <= 0){
        errores.push("Debe ingresar una cantidad mayor a cero");
    }

    if(precio === ""){
        errores.push("Debe ingresar un precio correcto");
    }

    if(precio <= 0){
        errores.push("El precio debe ser mayor o igual a 1");
    }



    if(errores.length == 0){
        let producto = {};
        producto.nombre = nombre;
        producto.categoria_id = categoria_id;
        producto.materiales = materiales;
        producto.cantidad_material = cantidad_material;
        producto.descripcion = descripcion;
        producto.cantidad = cantidad;
        producto.precio = precio;

        let res = await crearProducto(producto);

        await Swal.fire("Producto ingresado", "Operación realizada con éxito","success");

        window.location.href = "../productos/ver_productos";
    }else{
        Swal.fire({
            title: "Errores de validación",
            icon: "warning",
            html: errores.join("<br />")
        });
    }
});