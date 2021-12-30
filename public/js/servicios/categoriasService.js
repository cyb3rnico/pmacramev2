
const getCategorias = async()=>{
    let resp;
    resp = await axios.get("../api/categorias/get");
    return resp.data;
};

const crearCategoria = async(categoria)=>{
    let resp = await axios.post("../api/categorias/post", categoria, {
        headers: {
            'Content-Type': 'application/json'
        }
    });
    return resp.data;
};

const findById = async (id)=>{
    let resp = await axios.get(`../api/categorias/findById?id=${id}`);
    return resp.data;
};

const actualizarCategoria = async(categoria)=>{
    try{
        let resp = await axios.post("../api/categorias/update", categoria,{
            headers:{
                "Content-Type": "application/json"
            }
        });
        return resp.data;
    }catch(e){
        return false;
    }
};

const eliminarCategoria = async(id)=>{
    try{
        let resp = await axios.post("../api/categorias/delete", {id},{
            headers:{
                "Content-Type": "application/json"
            }
        });
        return resp.data == "ok";
    }catch(e){
        return false;
    }
};