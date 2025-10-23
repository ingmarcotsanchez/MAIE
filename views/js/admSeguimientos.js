function init(){
 
}

$(document).ready(function(){

    var remision_id = getUrlParameter('ID');

    listardetalle(remision_id);

    $('#seg_descripcion').summernote({
        height: 300,
        lang: "es-ES",
         callbacks: {
            onImageUpload: function(image) {
                console.log("Image detect...");
                myimagetreat(image[0]);
            },
            onPaste: function (e) {
                console.log("Text detect...");
            }
        }, 
        toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']]
        ]
    });

    $('#remision_mens').summernote({
        height: 200,
        lang: "es-ES"
    });
    $('#remision_mens').summernote('disable');

    tabla=$('#documentos_data').dataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        "searching": true,
        lengthChange: false,
        colReorder: true,
        buttons: [
                'excelHtml5',
                'pdfHtml5'
                ],
        "ajax":{
            url: '/MAIE/controller/documento.php?opc=listar',
            type : "post",
            data : {remision_id:remision_id},
            dataType : "json",
            error: function(e){
                console.log(e.responseText);
            }
        },
        "bDestroy": true,
        "responsive": true,
        "bInfo":true,
        "iDisplayLength": 10,
        "autoWidth": false,
        "language": {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando un total de _TOTAL_ registros",
            "sInfoEmpty":      "Mostrando un total de 0 registros",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar:",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        }
    }).DataTable();
});

var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
};

$(document).on("click","#btnEnviarTicket", function(){
    var remision_id = getUrlParameter('ID');
    var usu_id = $('#usu_idx').val();
    var seg_descripcion = $('#seg_descripcion').val();

    if ($('#seg_descripcion').summernote('isEmpty')){
        Swal.fire({
            title: 'Advertencia!',
            text: 'Falta Descripción',
            icon: 'warning',
            confirmButtonText: 'Aceptar'
        })
    }else{
        $.post("/MAIE/controller/remision.php?opc=insertdetalle", { remision_id:remision_id,usu_id:usu_id,seg_descripcion:seg_descripcion}, function (data) {
            listardetalle(remision_id);
            $('#seg_descripcion').summernote('reset');
            Swal.fire({
                title: 'Correcto!',
                text: 'Se Registro Correctamente',
                icon: 'success',
                confirmButtonText: 'Aceptar'
            })
        }); 
    }
});

$(document).on("click","#btnCerrarTicket", function(){
    Swal.fire({
        title: "Cerrar el Ticket?",
        text: "Esta seguro de cerrar el Ticket!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, cerrar!"
    }).then((result) => {
        if (result.isConfirmed) {
            var remision_id = getUrlParameter('ID');
            var usu_id = $('#usu_idx').val();
            $.post("/MAIE/controller/remision.php?opc=update", { remision_id : remision_id,usu_id : usu_id }, function (data) {

            }); 

             $.post("/MAIE/controller/email.php?opc=ticket_cerrado", {remision_id : remision_id}, function (data) {

            });


            listardetalle(remision_id);

            Swal.fire({
                title: "Cerrado!",
                text: "El ticket se cerro correctamente",
                icon: "success"
            });
        }
    });
    
});

function listardetalle(remision_id){
    $.post("/MAIE/controller/remision.php?opc=listardetalle", { remision_id : remision_id }, function (data) {
        $('#Detalle_ticket').html(data);
    });
     

    $.post("/MAIE/controller/remision.php?opc=mostrarDetalles", { remision_id : remision_id }, function (data) {
        data = JSON.parse(data);
        data = data[0];
        console.log(data);
        if(data.estado == 'Abierto'){
            clase = 'text-success';
        }else{
            clase = 'text-danger';
        }
        $('#remision_id').html(data.remision_id);
        $('#fech_crea').html(data.fech_crea);
        $('#estadospan').html(data.estado);
        $('#estadospan').addClass(clase);
        $('#est_id').val(data.est_nom+' '+data.est_ape);
        $('#mod_id').val(data.mod_nombre);
        $('#jor_id').val(data.jor_nombre);
        $('#cen_id').val(data.cen_nombre);
        $('#prog_id').val(data.descripcion);
        $('#seme_id').val(data.seme_nombre);
        $('#tipaco_id').val(data.tipaco_nombre);
        $('#asig_id').val(data.asig_nom);
        $('#nec_id').val(data.nec_nombre);
        $('#prof_id').val(data.prof_nom+' '+data.prof_ape);
        $('#estado').val(data.estado);
        $('#fech_crea').val(data.fech_crea);
        $('#tick_titulo').val(data.tick_titulo);
        $('#remision_mens').summernote ('code',data.remision_mens);

        if (data.tick_estado_texto == "Cerrado"){
            $('#panel_detalle').hide();
        }
    }); 
}

init();
                        
    
                        
                        