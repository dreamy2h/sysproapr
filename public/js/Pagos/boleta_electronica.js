var base_url = $("#txt_base_url").val();

function llenar_cmb_sector() {
    $.ajax({
        type: "GET",
        dataType: "json",
        url: base_url + "/Formularios/Ctrl_arranques/llenar_cmb_sector",
    }).done( function(data) {
        $("#cmb_sector").html('');

        var opciones = "<option value=\"\">Seleccione un sector</option>";
        
        for (var i = 0; i < data.length; i++) {
            opciones += "<option value=\"" + data[i].id + "\">" + data[i].sector + "</option>";
        }

        $("#cmb_sector").append(opciones);
    }).fail(function(error){
        respuesta = JSON.parse(error["responseText"]);
        Toast.create("Error", respuesta.message, TOAST_STATUS.DANGER, 5000);
    });
}

function buscar_boletas() {
	var id_socio = $("#txt_id_socio").val();
	var mes_año = $("#dt_mes_año").val();
	var id_sector = $("#cmb_sector").val();

	if (id_socio != "" || mes_año != "" || id_sector != "") {
		var datosBusqueda = [id_socio, mes_año, id_sector];

		$("#grid_boletas").dataTable().fnReloadAjax(base_url + "/Pagos/Ctrl_boleta_electronica/datatable_boleta_electronica/" + datosBusqueda);
	} else {
		Toast.create("Advertencia", "Debe seleccionar un items", TOAST_STATUS.WARNING, 5000);
	}
}

var peso = {
    validaEntero: function  ( value ) {
        var RegExPattern = /[0-9]+$/;
        return RegExPattern.test(value);
    },
    formateaNumero: function (value) {
        if (peso.validaEntero(value))  {  
            var retorno = '';
            value = value.toString().split('').reverse().join('');
            var i = value.length;
            while(i>0) retorno += ((i%3===0&&i!=value.length)?'.':'')+value.substring(i--,i);
            return retorno;
        }
        return 0;
    },
    quitar_formato : function(numero){
        numero = numero.split('.').join('');
        return numero;
    }
}

function emitir_dte() {
   	var data = $("#grid_boletas").DataTable().rows('.selected').data();
  	var arr_boletas = [];
  	$(data).each(function(i,fila) {
    	if (fila.folio_bolect == 0) {
    		arr_boletas.push(fila.id_metros);
    	}
  	});

  	if (arr_boletas.length > 0) {
  		setTimeout(function() {
            $(".div_sample").JQLoader({
                theme: "standard",
                mask: true,
                background: "#fff",
                color: "#fff"
            });
        }, 500);

        setTimeout(function() {
    		$.ajax({
    	        url: base_url + "/Pagos/Ctrl_boleta_electronica/emitir_dte",
    	        type: "POST",
    	        async: false,
    	        data: { arr_boletas: arr_boletas },
    	        success: function(respuesta) {
    	            const OK = 1;
    	            if (respuesta == OK) {
    	            	buscar_boletas();
    	                Toast.create("Éxito", "Boletas generadas con éxito", TOAST_STATUS.SUCCESS, 5000);
    	            } else {
    	                Swal.fire({
    					  	icon: 'error',
    					  	title: 'Errores',
    					  	html: respuesta,
    					  	footer: 'Procedimiento terminado con errores'
    					});
    	            }
    	            $(".div_sample").JQLoader({
    					theme: "standard",
    					mask: true,
    					background: "#fff",
    					color: "#fff",
    					action: "close"
    				});
    	        },
    	        error: function(error) {
    	            $(".div_sample").JQLoader({
    					theme: "standard",
    					mask: true,
    					background: "#fff",
    					color: "#fff",
    					action: "close"
    				});
    	            respuesta = JSON.parse(error["responseText"]);
    	            Toast.create("Error", respuesta.message, TOAST_STATUS.DANGER, 5000);
    	        }
    	    });
        }, 500);
  	} else {
  		Toast.create("Error", "Seleccione al menos una boleta, sin folio SII", TOAST_STATUS.DANGER, 5000);
  	}
}

function imprimir_dte() {
	var data = $("#grid_boletas").DataTable().rows('.selected').data();
  	var arr_boletas = [];
  	$(data).each(function(i,fila) {
    	if (fila.folio_bolect > 0) {
    		arr_boletas.push(fila.id_metros);
    	}
  	});

  	if (arr_boletas.length > 0) {
  		var url = base_url + "/Pagos/Ctrl_boleta_electronica/imprimir_dte/" + arr_boletas;
        window.open(url, "DTE", "width=1200,height=800,location=0,scrollbars=yes");
  	} else {
  		Toast.create("Error", "Seleccione al menos una boleta, con folio SII", TOAST_STATUS.DANGER, 5000);
  	}
}

function imprimir_aviso_cobranza() {
    var data = $("#grid_boletas").DataTable().rows('.selected').data();
    var arr_boletas = [];
    $(data).each(function(i,fila) {
        arr_boletas.push(fila.id_metros);
    });

    if (arr_boletas.length > 0) {
        var url = base_url + "/Pagos/Ctrl_boleta_electronica/imprimir_aviso_cobranza/" + arr_boletas;
        window.open(url, "DTE", "width=1200,height=800,location=0,scrollbars=yes");
    } else {
        Toast.create("Error", "Seleccione al menos una boleta", TOAST_STATUS.DANGER, 5000);
    }
}

$(document).ready(function() {
	$("#txt_id_socio").prop("readonly", true);
    $("#txt_rut_socio").prop("readonly", true);
    $("#txt_rol").prop("readonly", true);
    $("#txt_nombre_socio").prop("readonly", true);

    llenar_cmb_sector();

	$("#btn_buscar_socio").on("click", function() {
        $("#divContenedorBuscarSocio").load(
            base_url + "/Formularios/Ctrl_arranques/v_buscar_socio/Ctrl_boleta_electronica"
        ); 

        $('#dlg_buscar_socio').modal('show');
    });

    $("#dt_mes_año").datetimepicker({
        format: "MM-YYYY",
        useCurrent: false,
        locale: moment.locale("es")
    });

    $("#btn_buscar").on("click", function() {
		buscar_boletas();
        $("#datosBuscarSocios").collapse("hide");
    });

    $("#btn_limpiar").on("click", function() {
    	$("#form_boleta_electronica")[0].reset();
    });

    $("#btn_emitir").on("click", function() {
    	emitir_dte();
    });

    $("#btn_imprimir").on("click", function() {
    	imprimir_dte();
    });

    $("#btn_aviso_cobranza").on("click", function() {
        imprimir_aviso_cobranza();
    });

	var grid_boletas = $("#grid_boletas").DataTable({
		responsive: true,
        paging: true,
        destroy: true,
        select: {
            style: "multi"
        },
        orderClasses: true,
        columns: [
            { "data": "id_metros" },
            { "data": "folio_bolect" },
            { "data": "ruta" },
            { "data": "id_socio" },
            { "data": "rut_socio" },
            { "data": "rol_socio" },
            { "data": "nombre_socio" },
            { "data": "id_arranque" },
            { "data": "subsidio" },
            { 
                "data": "monto_subsidio",
                "render": function(data, type, row) {
                    return peso.formateaNumero(data);
                }
            },
            { "data": "sector" },
            { "data": "id_diametro" },
            { "data": "diametro" },
            { "data": "fecha_ingreso" },
            { "data": "fecha_vencimiento" },
            { "data": "consumo_anterior" },
            { "data": "consumo_actual" },
            { "data": "metros" },
            { 
                "data": "subtotal",
                "render": function(data, type, row) {
                    return peso.formateaNumero(data);
                }
            },
            { 
                "data": "multa",
                "render": function(data, type, row) {
                    return peso.formateaNumero(data);
                }
            },
            { 
                "data": "total_servicios",
                "render": function(data, type, row) {
                    return peso.formateaNumero(data);
                }
            },
            { 
                "data": "total_mes",
                "render": function(data, type, row) {
                    return peso.formateaNumero(data);
                }
            }
        ],
        order: [[ 2, "asc" ]],
        "columnDefs": [
            { "targets": [0, 3, 4, 7, 8, 9, 10, 11, 12, 13, 15, 16, 18, 19, 20], "visible": false, "searchable": false }
        ],
        dom: 'Bfrtip',
        buttons: [
            'selectAll',
            'selectNone',
        ],
        language: {
            "decimal": "",
            "emptyTable": "No hay información",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
            "infoEmpty": "Mostrando 0 a 0 de 0 Entradas",
            "infoFiltered": "(Filtrado de _MAX_ total entradas)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Mostrar _MENU_ Entradas",
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "search": "Buscar:",
            "zeroRecords": "Sin resultados encontrados",
            "select": {
                "rows": "<br/>%d Boletas Seleccionadas"
            },
            "paginate": {
                "first": "Primero",
                "last": "Ultimo",
                "next": "Sig.",
                "previous": "Ant."
            }
        }
	});
});