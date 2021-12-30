let accessTag = document.querySelector("meta[name='success-response']");
let success_token = null;
if(accessTag.length > 0){
    success_token = document.querySelector("meta[name='success-response']").getAttribute('content')
}

const getVentas = async(filtro = "todos")=>{
    let resp;
    if(filtro == "todos"){
        resp = await axios.get("../api/ventas/get");
    }else{
        resp = await axios.get(`../api/ventas/filtrar?filtro=${filtro}`);
    }
    return resp.data;
};


const crearVenta = async(venta)=>{
    let resp = await axios.post("../api/ventas/post", venta, {
        headers: {
            'Content-Type': 'application/json',
            'Authorization': `Barer  ${success_token}`
        }
    });
    return resp.data;
};


const findById = async (id)=>{
    let resp = await axios.get(`../api/ventas/findById?id=${id}`);
    return resp.data;
};

const actualizarVenta = async(venta)=>{
    try{
        let resp = await axios.post("../api/ventas/update", venta,{
            headers:{
                "Content-Type": "application/json"
            }
        });
        return resp.data;
    }catch(e){
        return false;
    }
};

const eliminarVenta = async(id)=>{
    try{
        let resp = await axios.post("../api/ventas/delete", {id},{
            headers:{
                "Content-Type": "application/json"
            }
        });
        return resp.data == "ok";
    }catch(e){
        return false;
    }
};