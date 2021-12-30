class RutValidador{
    constructor(rut){
        this.rut = rut;

        this.dv = rut.substring(this.rut.length - 1);

        this.rut = this.rut.substring(0, this.rut.length - 1).replace(/\D/g,'');
        this.esValido = this.validar();
    }

    validar(){
        let numerosArray = this.rut.split('').reverse();
        let acumulador = 0;
        let multiplicador = 2;
        for(let numero of numerosArray){
            acumulador += parseInt(numero) * multiplicador;
            multiplicador++;

            if(multiplicador == 8){
                multiplicador = 2;
            }
        }

        let dv = 11 - (acumulador % 11);

        if(dv == 11){
            dv = '0';
        }
        if(dv == 10){
            dv = 'k';
        }

        return dv == this.dv.toLowerCase();
    }

    formato(){
        if(!this.esValido){
            return '';
        }
        return (this.rut.toString().replace(/\B(?=(\d{3})+(?!\d))/g,'.')) + '-' + this.dv;
    }
}


document.querySelector("#registrar-btn").addEventListener("click", async()=>{
    let rut = document.querySelector("#rut-txt").value.trim();
    let nombre = document.querySelector("#nombre-txt").value.trim();
    let apellidos = document.querySelector("#apellidos-txt").value.trim();
    let direccion = document.querySelector("#direccion-txt").value.trim();
    let email = document.querySelector("#email-txt").value.trim();
    let telefono = document.querySelector("#telefono-txt").value.trim();

    let errores = [];
    
    let rutValidador = new RutValidador(rut);
    

    if(rut === ""){
        errores.push("Debe ingresar un RUT");
    }else{
        let clientes = await getClientes();
        let clienteEncontrado = clientes.find(p=>p.rut.toLowerCase() === rut.toLowerCase());
        if(clienteEncontrado != undefined){
            errores.push("El RUT del cliente ya existe y no puede ser igual.");
        }
    }

    if(!rutValidador.esValido){
        errores.push("El rut es inválido");
    }

    if(rut.length >=13){
        errores.push("El rut no debe ser mayor a 12 carácteres");
    }

    if(nombre === ""){
        errores.push("Debe ingresar un nombre");
    }

    if(nombre.length >= 40){
        errores.push("El nombre del cliente no puede ser mayor a 40 carácteres");
    }

    if(apellidos === ""){
        errores.push("Debe ingresar los apellidos");
    }

    if(apellidos.length >= 40){
        errores.push("Los apellidos del proveedor no pueden ser mayor a 40 carácteres");
    }

    if(direccion === ""){
        errores.push("Debe ingresar una dirección");
    }

    if(direccion.length >= 50){
        errores.push("La dirección no puede ser mayor a 50 carácteres");
    }

    if(email === ""){
        errores.push("Debe ingresar un email");
    }

    if(email.length >= 50){
        errores.push("El email no puede ser mayor a 50 carácteres");
    }

    if(telefono === ""){
        errores.push("Debe ingresar un teléfono de contacto");
    }

    if(telefono.length >= 20){
        errores.push("El teléfono no puede tener más de 20 carácteres");
    }

    if(errores.length == 0){
        let cliente = {};
        cliente.rut = rut;
        cliente.nombre = nombre;
        cliente.apellidos = apellidos;
        cliente.direccion = direccion;
        cliente.email = email;
        cliente.telefono = telefono;
        

        let res = await crearCliente(cliente);

        await Swal.fire("Cliente registrado", "Operación realizada con éxito","success");

        window.location.href = "ver_clientes";
    }else{
        Swal.fire({
            title: "Errores de validación",
            icon: "warning",
            html: errores.join("<br />")
        });
    }
});