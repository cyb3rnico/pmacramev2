
document.querySelector("#registrar-btn").addEventListener("click", async()=>{
    let nombreCat = document.querySelector("#nombre-txt").value.trim();


    let errores = [];

    if(nombreCat === ""){
        errores.push("Debe ingresar un nombre para la categoría");
    }else{
        //Si la categoria existe
        let categorias = await getCategorias();
        let categoriaEncontrada = categorias.find(c=>c.nombreCat.toLowerCase() === nombreCat.toLowerCase());
        if(categoriaEncontrada != undefined){
            errores.push("La categoría ya existe");
        }
    }

    if(nombreCat.length >= 50){
        errores.push("El nombre de la categoría no puede ser mayor a 50 carácteres")
    }

    if(errores.length == 0){
        let categoria = {};
        categoria.nombreCat = nombreCat;

        let res = await crearCategoria(categoria);

        await Swal.fire("Categoría agregada", "Operación realizada con éxito","success");

        window.location.href = "../categorias/ver_categorias";
    }else{
        Swal.fire({
            title: "Errores de validación",
            icon: "warning",
            html: errores.join("<br />")
        });
    }
});