
const getProveedores = async(filtro = "todos")=>{
    let resp;
    if(filtro == "todos"){
        resp = await axios.get("../api/proveedores/get");
    }else{
        resp = await axios.get(`../api/proveedores/filtrar?filtro=${filtro}`);
    }
    return resp.data;
};


const crearProveedor = async(proveedor)=>{
    let resp = await axios.post("../api/proveedores/post", proveedor, {
        headers: {
            'Content-Type': 'application/json'
        }
    });
    return resp.data;
};

const findByRut = async (rut)=>{
    let resp = await axios.get(`../api/proveedores/findByRut?rut=${rut}`);
    return resp.data;
};

const actualizarProveedor = async(proveedor)=>{
    try{
        let resp = await axios.post("../api/proveedores/update", proveedor,{
            headers:{
                "Content-Type": "application/json"
            }
        });
        return resp.data;
    }catch(e){
        return false;
    }
};

const eliminarProveedor = async(rut)=>{
    try{
        let resp = await axios.post("../api/proveedores/delete", {rut},{
            headers:{
                "Content-Type": "application/json"
            }
        });
        return resp.data == "ok";
    }catch(e){
        return false;
    }
};