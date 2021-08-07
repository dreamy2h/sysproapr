var base_url = $("#txt_base_url").val();

function preparar_activacion(data) {
    $("#divClave").addClass("d-none");
    $("#divClaveActivar").removeClass("d-none");
    $("#divClaveRepetir").removeClass("d-none");

    $("#txt_clave_activar").rules("add", { 
        required: true,
        messages: { 
            required: "Escriba su clave"
        }
    });
    
    $("#txt_clave_repetir").rules("add", { 
        required: true,
        equalTo: "#txt_clave_activar",
        messages: { 
            required: "Repita su clave",
            equalTo: "Las claves deben ser idénticas"
        }
    });

    $("#txt_usuario").prop("disabled", true);
    $("#btn_login").text("Activa tu cuenta");

    Toast.create("Advertencia", data, TOAST_STATUS.WARNING, 5000);
}

function activar_cuenta() {
    var clave_activar = $("#txt_clave_activar").val();
    var clave_repetir = $("#txt_clave_repetir").val();
    var usu_cod = $("#txt_usuario").val();

    $.ajax({
        url: base_url + "/Ctrl_login/activar_cuenta",
        data: {
            clave_activar: clave_activar,
            clave_repetir: clave_repetir,
            usu_cod: usu_cod
        },
        type: "POST",
        success: function(data) {
            const OK = 1;

            if (data == OK) {
                $("#txt_clave").val("");
                $("#divClave").removeClass("d-none");
                $("#divClaveActivar").addClass("d-none");
                $("#divClaveRepetir").addClass("d-none");

                $("#btn_login").html("<i class=\"fas fa-sign-in-alt\"></i> Iniciar Sesión");
                Toast.create("Advertencia", "Clave Activada", TOAST_STATUS.WARNING, 5000);
            } 
        }
    });
}

function login() {
    var usuario = $("#txt_usuario").val();
    var clave = $("#txt_clave").val();

    $.ajax({
        url: base_url + "/Ctrl_login/valida",
        data: {
            usuario: usuario,
            password: clave
        },
        type: "POST",
        success: function(data) {
            const OK = 1;
            if (data == OK) {
                location = base_url + "/Home/principal";
            } else if (data == "Active su clave") {
                preparar_activacion(data);
            } else {
                Toast.create("Error", data, TOAST_STATUS.DANGER, 5000);
            }
        },
        error: function(error) {
            respuesta = JSON.parse(error["responseText"]);
            Toast.create("Error", respuesta.message, TOAST_STATUS.DANGER, 5000);
        }
    });
}

$(document).ready(function() {
    $("#form_login").validate({
        debug: true,
        errorClass: "my-error-class",
        highlight: function (element, required) {
            $(element).css('border', '2px solid #FDADAF');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).css('border', '1px solid #CCC');
        },
        rules:  {
            txt_usuario: {
                required: true,
                maxlength: 10
            },
            txt_clave: {
                required: true
            }
        },
        messages: {
            txt_usuario: {
                required: "Ingrese usuario",
                maxlength: "Máximo 10 caracteres"
            },
            txt_clave: {
                required: "Ingrese clave"
            }
        }
    });

    $("#btn_login").click(function() {
        if ($("#form_login").valid()) {
            if ($("#btn_login").text() == "Activa tu cuenta") {
                activar_cuenta();
            } else {
                login();
            }
        }
    });

    $("#txt_clave").keypress(function(event) {
        if(event.keyCode==13){
            if ($("#btn_login").text() == "Activa tu cuenta") {
                activar_cuenta();
            } else {
                login();
            }
        }
    });

    $("#txt_clave_activar").keypress(function(event) {
        if(event.keyCode==13){
            if (this.value =! "") {
                $("#txt_clave_repetir").focus();
            }
        }
    });

    $("#txt_clave_repetir").keypress(function(event) {
        if(event.keyCode==13){
            if (this.value =! "") {
                activar_cuenta();
            }
        }
    });
});