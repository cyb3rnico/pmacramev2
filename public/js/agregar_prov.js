class RutValidador{
    constructor(rut){
        this.rut = rut;
        // obtenemos el ultimo caracter del rut
        this.dv = rut.substring(this.rut.length - 1);
        //limpiar el rut dejando solamente los numeros
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
        //console.log('Digito calculado: ',dv);
        //console.log(numerosArray);

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

//let validador = new RutValidador('30.686.957-4');

// console.log('Numeros: ',validador.rut);
// console.log('Digito verificador',validador.dv);
// //console.log(validador.rut);
// console.log(validador.esValido);
// console.log(validador.formato());

document.querySelector("#registrar-btn").addEventListener("click", async()=>{
    let rut = document.querySelector("#rut-txt").value.trim();
    let nombre = document.querySelector("#nombre-txt").value.trim();
    let apellidos = document.querySelector("#apellidos-txt").value.trim();
    let direccion = document.querySelector("#direccion-txt").value.trim();
    let email = document.querySelector("#email-txt").value.trim();
    let telefono = document.querySelector("#telefono-txt").value.trim();

    let errores = [];
    //Validamos el rut
    let rutValidador = new RutValidador(rut);

    

    if(rut === ""){
        errores.push("Debe ingresar un RUT");
    }else{
        let proveedores = await getProveedores();
        let proveedorEncontrado = proveedores.find(p=>p.rut.toLowerCase() === rut.toLowerCase());
        if(proveedorEncontrado != undefined){
            errores.push("El RUT del proveedor ya existe y no puede ser igual.");
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
        errores.push("El nombre del proveedor no puede ser mayor a 40 carácteres");
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
        let proveedor = {};
        proveedor.rut = rut;
        proveedor.nombre = nombre;
        proveedor.apellidos = apellidos;
        proveedor.direccion = direccion;
        proveedor.email = email;
        proveedor.telefono = telefono;
        

        let res = await crearProveedor(proveedor);

        await Swal.fire("Proveedor ingresado", "Operación realizada con éxito","success");

        window.location.href = "ver_proveedores";
    }else{
        Swal.fire({
            title: "Errores de validación",
            icon: "warning",
            html: errores.join("<br />")
        });
    }
});