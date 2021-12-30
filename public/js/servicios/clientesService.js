
const getClientes = async(filtro = "todos")=>{
    let resp;
    if(filtro == "todos"){
        resp = await axios.get("../api/clientes/get");
    }else{
        resp = await axios.get(`../api/clientes/filtrar?filtro=${filtro}`);
    }
    return resp.data;
};


const crearCliente = async(cliente)=>{
    let resp = await axios.post("../api/clientes/post", cliente, {
        headers: {
            'Content-Type': 'application/json'
        }
    });
    return resp.data;
};

const findByRut = async (rut)=>{
    let resp = await axios.get(`../api/clientes/findByRut?rut=${rut}`);
    return resp.data;
};

const actualizarCliente = async(cliente)=>{
    try{
        let resp = await axios.post("../api/clientes/update", cliente,{
            headers:{
                "Content-Type": "application/json"
            }
        });
        return resp.data;
    }catch(e){
        return false;
    }
};

const eliminarCliente = async(rut)=>{
    try{
        let resp = await axios.post("../api/clientes/delete", {rut},{
            headers:{
                "Content-Type": "application/json"
            }
        });
        return resp.data == "ok";
    }catch(e){
        return false;
    }
};