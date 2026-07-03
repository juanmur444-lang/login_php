function mostrarError(mensaje){

    let contenedor =
    document.getElementById("errores");

    contenedor.innerHTML = mensaje;
    contenedor.style.display = "block";
}

function ocultarError(){

    let contenedor =
    document.getElementById("errores");

    contenedor.innerHTML = "";
    contenedor.style.display = "none";
}

function actualizarRequisitos(){

    let nombre =
    document.getElementById("nombre");

    let correo =
    document.getElementById("correo");

    let password =
    document.getElementById("password");

    let confirmar =
    document.getElementById("confirmarPassword");

    if(nombre){

        if(nombre.value.trim().length >= 3){

            document.getElementById("reqNombre")
            .innerHTML =
            "✅ Nombre mínimo de 3 caracteres";

        }else{

            document.getElementById("reqNombre")
            .innerHTML =
            "❌ Nombre mínimo de 3 caracteres";
        }

        let soloLetras =
        /^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/;

        if(
            nombre.value.trim() !== "" &&
            soloLetras.test(nombre.value)
        ){

            document.getElementById("reqLetras")
            .innerHTML =
            "✅ Nombre solo letras";

        }else{

            document.getElementById("reqLetras")
            .innerHTML =
            "❌ Nombre solo letras";
        }
    }

    if(correo){

        let expresion =
        /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if(expresion.test(correo.value)){

            document.getElementById("reqCorreo")
            .innerHTML =
            "✅ Correo válido";

        }else{

            document.getElementById("reqCorreo")
            .innerHTML =
            "❌ Correo válido";
        }
    }

    if(password){

        if(password.value.length >= 6){

            document.getElementById("reqPassword")
            .innerHTML =
            "✅ Contraseña mínimo 6 caracteres";

        }else{

            document.getElementById("reqPassword")
            .innerHTML =
            "❌ Contraseña mínimo 6 caracteres";
        }
    }

    if(password && confirmar){

        if(
            password.value !== "" &&
            password.value === confirmar.value
        ){

            document.getElementById("reqCoinciden")
            .innerHTML =
            "✅ Las contraseñas deben coincidir";

        }else{

            document.getElementById("reqCoinciden")
            .innerHTML =
            "❌ Las contraseñas deben coincidir";
        }
    }
}

document.addEventListener("input", actualizarRequisitos);

function validarRegistro(){

    ocultarError();

    let errores = [];

    let nombre =
    document.getElementById("nombre").value.trim();

    let correo =
    document.getElementById("correo").value.trim();

    let password =
    document.getElementById("password").value.trim();

    let confirmar =
    document.getElementById("confirmarPassword").value.trim();

    if(nombre === ""){
        errores.push("Ingrese el nombre");
    }

    if(nombre.length > 0 && nombre.length < 3){
        errores.push("El nombre debe tener mínimo 3 caracteres");
    }

    let soloLetras =
    /^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/;

    if(
        nombre !== "" &&
        !soloLetras.test(nombre)
    ){
        errores.push("El nombre solo puede contener letras");
    }

    if(correo === ""){
        errores.push("Ingrese el correo");
    }

    let expresion =
    /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if(
        correo !== "" &&
        !expresion.test(correo)
    ){
        errores.push("Ingrese un correo válido");
    }

    if(password === ""){
        errores.push("Ingrese la contraseña");
    }

    if(
        password !== "" &&
        password.length < 6
    ){
        errores.push("La contraseña debe tener mínimo 6 caracteres");
    }

    if(confirmar === ""){
        errores.push("Confirme la contraseña");
    }

    if(
        password !== "" &&
        confirmar !== "" &&
        password !== confirmar
    ){
        errores.push("Las contraseñas no coinciden");
    }

    if(errores.length > 0){

        mostrarError(
            errores.join("<br>")
        );

        return false;
    }

    return true;
}

function validarLogin(){

    ocultarError();

    let errores = [];

    let correo =
    document.getElementById("correo").value.trim();

    let password =
    document.getElementById("password").value.trim();

    if(correo === ""){
        errores.push("Ingrese el correo");
    }

    let expresion =
    /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if(
        correo !== "" &&
        !expresion.test(correo)
    ){
        errores.push("Correo inválido");
    }

    if(password === ""){
        errores.push("Ingrese la contraseña");
    }

    if(errores.length > 0){

        mostrarError(
            errores.join("<br>")
        );

        return false;
    }

    return true;
}