var base_url = $("#txt_base_url").val();
Toast.setTheme(TOAST_THEME.DARK);

function cargar_page(ruta) {
    $("#contenido").load(base_url + "/index.php/" +ruta);
}

function actualizar_clave() {
    var clave_actual = $("#txt_clave_actual").val();
    var clave_nueva = $("#txt_clave_nueva").val();
    var repetir = $("#txt_repetir").val();
    $.ajax({
        url: base_url + "/index.php/Ctrl_menu/actualizar_clave",
        type: "POST",
        async: false,
        data: {
            clave_actual: clave_actual,
            clave_nueva: clave_nueva,
            repetir: repetir
        },
        success: function(respuesta) {
            const OK = 1;
            if (respuesta == OK) {
                Swal.fire({
                    icon: "success",
                    title: "Clave",
                    text: "La clave se actualizó con éxito",
                    footer: "Actualizar Clave"
                });
                $('#dlg_actualizar_clave').modal('hide');
                $("#form_actualizar_clave")[0].reset();
            } else {
                Toast.create("Error", respuesta, TOAST_STATUS.DANGER, 5000);
            }
        },
        error: function(error) {
            respuesta = JSON.parse(error["responseText"]);
            Toast.create("Error", respuesta.message, TOAST_STATUS.DANGER, 5000);
        }
    });
}
$(document).ready(function() {
    $.ajax({
       type: "POST",
       dataType: "json",
       url: base_url + "/index.php/Ctrl_menu/permisos_usuario",
    }).done( function(data) {
        var menu = '';
        var id_grupo;
        var id_subgrupo;
        var cierre_subgrupo = 0;
        for (var i = 0; i < data.length; i++) {
            if (id_subgrupo != data[i].id_subgrupo && cierre_subgrupo == 1) {
                menu += "</ul></li>";
                cierre_subgrupo = 0;
            }
            
            if (id_grupo != data[i].id_grupo) {
                if (i > 0) {
                    menu += "</ul></li>"
                }
                menu += '<li class="nav-item">\
                            <a href="#" class="nav-link" data-toggle="collapse" data-target="#' + data[i].id_grupo + '" aria-expanded="false" aria-controls="' + data[i].id_grupo + '">\
                                <i class="nav-icon ' + data[i].icono_grupo + '"></i>\
                                <p>\
                                    ' + data[i].grupo + '<i class="right fas fa-angle-left"></i>\
                                </p>\
                            </a>\
                            <ul class="nav nav-treeview collapse" id="' + data[i].id_grupo + '">';
                id_grupo = data[i].id_grupo;
            }
            
            if (data[i].id_subgrupo != null && cierre_subgrupo == 0) {
                menu += '<li class="nav-item ml-3">\
                            <a href="#" class="nav-link" data-toggle="collapse" data-target="#' + data[i].id_subgrupo + '" aria-expanded="false" aria-controls="' + data[i].id_subgrupo + '">\
                                <i class="nav-icon ' + data[i].icono_subgrupo + '"></i>\
                                <p>\
                                    ' + data[i].subgrupo + '<i class="right fas fa-angle-left"></i>\
                                </p>\
                            </a>\
                            <ul class="nav nav-treeview collapse" id="' + data[i].id_subgrupo + '">';
                
                cierre_subgrupo = 1;
            }

            menu += '<li class="nav-item ml-3">\
                        <a class="nav-link" href="#" onclick="cargar_page(\'' + String(data[i].ruta) + '\')">\
                        <i class="' + data[i].icono + '"></i>\
                            <p>' + data[i].permiso + '</p>\
                        </a>\
                    </li>';
            id_subgrupo = data[i].id_subgrupo;
        }
        $("#menu_").append(menu);
        // $(".collapse").collapse();
    });

    $.validator.addMethod("charspecial", function(value, element) {
        return this.optional(element) || /^[^;\"'{}\[\]^<>=]+$/.test(value);
    });
    $("#form_actualizar_clave").validate({
        errorClass: "my-error-class",
        highlight: function (element, required) {
            $(element).css('border', '2px solid #FDADAF');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).css('border', '1px solid #CCC');
        },
        rules:  {
            txt_clave_actual: {
                required: true,
                maxlength: 10,
                charspecial: true
            },
            txt_clave_nueva: {
                required: true,
                maxlength: 10,
                charspecial: true
            },
            txt_repetir: {
                required: true,
                maxlength: 10,
                charspecial: true,
                equalTo: "#txt_clave_nueva"
            }
        },
        messages: {
            txt_clave_actual: {
                required: "Obligatorio",
                maxlength: "Máximo 10 caracteres",
                charspecial: "Caracter no permitido"
            },
            txt_clave_nueva: {
                required: "Obligatorio",
                maxlength: "Máximo 10 caracteres",
                charspecial: "Caracter no permitido"
            },
            txt_repetir: {
                required: "Obligatorio",
                maxlength: "Máximo 10 caracteres",
                charspecial: "Caracter no permitido",
                equalTo: "Las claves tienen que coincidir"
            }
        }
    });

    $("#btn_actualizar_clave").on("click", function() {
        $("#form_actualizar_clave")[0].reset();
        $('#dlg_actualizar_clave').modal('show');
    });

    $("#btn_actualizar").on("click", function() {
        if ($("#form_actualizar_clave").valid()) {
            actualizar_clave();
        }
    });
    
    cargar_page("/ctrl_menu/dashboard");
});