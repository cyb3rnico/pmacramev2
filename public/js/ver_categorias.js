let categorias;


// const actualizar = async function(){
//     let idCategoria = this.idCategoria;
//     let categoria = await findById(idCategoria);
//     let molde = this.parentNode.parentNode;

//     categoria.nombreCat = molde.querySelector(".nombre-txt").value;
//     let errores = [];

//     if(categoria.nombreCat === ""){
//         errores.push("Debe ingresar un nombre para la categoría");
//     }/*else{
//         let categorias = await getCategorias();
//         let categoriaEncontrado = categorias.find(c=>c.nombreCat.toLowerCase() === categoria.nombreCat.toLowerCase());
//         if(categoriaEncontrado != undefined){
//             errores.push("La categoría ya existe");
//         }
//     }*/


//     if(errores.length == 0){
//         await actualizarCategoria(categoria);
//         await Swal.close();
//         categorias = await getCategorias();
//         cargarTabla(categorias);
//     }else{
//         Swal.fire({
//             title: "Errores de validación",
//             icon: "warning",
//             html: errores.join("<br />")
//         });
//     }
// };

// const iniciarActualizacion = async function(){
//     let idCategoria = this.idCategoria;
//     let categoria = await findById(idCategoria);
  
//     let molde = document.querySelector(".molde-actualizar").cloneNode(true);
//     molde.querySelector(".nombre-txt").value = categoria.nombreCat;

//     molde.querySelector(".actualizar-btn").idCategoria = idCategoria;
//     molde.querySelector(".actualizar-btn").addEventListener("click", actualizar);
//     await Swal.fire({
//         title:"Actualizar Categoria",
//         html: molde,
//         confirmButtonText: "Cerrar"
//     });
  
// };

const iniciarEliminacion = async function(){
    let id = this.idCategoria;
    let resp = await Swal.fire({
        title: "¿Estás seguro que desea eliminar la categoría?",
        text: "Esta operación es irreversible, como aviso, todos los productos asociados a ésta categoría pasarán a quedar sin categoría",
        icon: "error",
        showCancelButton: true
    });
    if(resp.isConfirmed){
        if(await eliminarCategoria(id)){
            categorias = await getCategorias();
            cargarTabla(categorias);
            Swal.fire("Categoría eliminada", "La categoría ha sido eliminada con éxito","info");
        }else{
            Swal.fire("Error", "No se pudo procesador la solicitud de eliminación", "error");
        }
    }else{
        Swal.fire("Cancelado", "Usted ha cancelado la eliminación");
    }
};



const cargarTabla = (categorias)=>{
    let tbody = document.querySelector("#tbody-categoria");

    tbody.innerHTML = "";

    for(let i=0; i < categorias.length; ++i){
        let tr = document.createElement("tr");

        let tdNombreCat = document.createElement("td");
        tdNombreCat.innerText = categorias[i].nombreCat;

        let fechaFormatear = categorias[i].fecha;
        let fechaFormateada = `${fechaFormatear.split(" ")[0].split("-").reverse().join("-")} a las ${fechaFormatear.split(" ")[1]}`;
        let tdFechaCat = document.createElement("td");
        tdFechaCat.innerText = fechaFormateada;

        let tdAccion = document.createElement("td");

        // let botonActualizar = document.createElement("button");
        // botonActualizar.innerText = "Actualizar";
        // botonActualizar.classList.add("btn","btn-warning","text-center","ms-1","me-3","text-white");
        // botonActualizar.idCategoria = categorias[i].id;
        // botonActualizar.addEventListener("click", iniciarActualizacion);

        let botonEliminar = document.createElement("button");
        botonEliminar.innerText = "Eliminar";
        botonEliminar.classList.add("btn","btn-danger","text-center");
        botonEliminar.idCategoria = categorias[i].id;
        botonEliminar.addEventListener("click", iniciarEliminacion);

        //tdAccion.appendChild(botonActualizar);
        tdAccion.appendChild(botonEliminar);

        tr.appendChild(tdNombreCat);
        tr.appendChild(tdFechaCat);
        tr.appendChild(tdAccion);

        tbody.appendChild(tr);
    }
};


document.addEventListener("DOMContentLoaded", async()=>{
    categorias = await getCategorias();
    cargarTabla(categorias);
});

document.querySelector("#busqueda-btn").addEventListener("click", function() {
    let busqueda = document.querySelector("#busqueda-txt").value.trim();
    let resultado = buscarCategoria(busqueda);
    cargarTabla(resultado);
});

function buscarCategoria(nombre) {
    let buscar;
    buscar = categorias.filter(categoria=>categoria.nombreCat.toLowerCase().includes(nombre.toLowerCase()));
    return buscar;
}