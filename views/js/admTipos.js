var usu_id = $('#usu_idx').val();

function init(){
    $("#tipaco_form").on("submit",function(e){
        guardaryeditar(e);
    });

}

function guardaryeditar(e){
    //console.log("prueba");
    e.preventDefault();
    var formData = new FormData($("#tipaco_form")[0]);
    //console.log(formData);
    $.ajax({
        url: "/Maie/controller/tipos.php?opc=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        
        success: function(data){
            console.log(data);
            $('#tipaco_data').DataTable().ajax.reload();
            $('#modalcrearTipaco').modal('hide');

            Swal.fire({
                title: 'Correcto!',
                text: 'Se Registro de forma correcta el Tipo de Acompañamiento',
                icon: 'success',
                confirmButtonText: 'Aceptar'
            })
        }
    });
}

$(document).ready(function(){
    $('#tipaco_data').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        buttons: [
            'excelHtml5',
            'csvHtml5',
        ],
        "ajax":{
            url:"/Maie/controller/tipos.php?opc=listar",
            type:"post"
        },
        "bDestroy": true,
        "responsive": true,
        "bInfo":true,
        "iDisplayLength": 15,
        "order": [[ 0, "desc" ]],
        "language": {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
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
        },
    });

});

function nuevo(){
    $('#titulo_modal').html('Nuevo Tipo de Acompañamiento');
    $('#tipaco_form')[0].reset();
    $('#modalcrearTipaco').modal('show');
}

function editar(tipaco_id){
    $.post("/Maie/controller/tipos.php?opc=mostrar",{tipaco_id:tipaco_id},function (data){
        data = JSON.parse(data);
        //console.log(data);
        $('#tipaco_id').val(data.tipaco_id);
        $('#tipaco_nombre').val(data.tipaco_nombre);
    });
    $('#titulo_modal').html('Editar Tipo de Acompañamiento');
    $('#modalcrearTipaco').modal('show');
}

function eliminar(tipaco_id){
    Swal.fire({
        title: 'Eliminar!',
        text: 'Desea eleminar Tipo de Acompañamiento?',
        icon: 'error',
        showCancelButton: true,
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar',
    }).then((result)=>{
        if(result.value){
            $.post("/Maie/controller/tipos.php?opc=eliminar",{tipaco_id:tipaco_id},function (data){
                $('#tipaco_data').DataTable().ajax.reload();
                Swal.fire({
                    title: 'Correcto!',
                    text: 'Se Elimino Correctamente',
                    icon: 'success',
                    confirmButtonText: 'Aceptar'
                })
            }); 
        }
    });

}
function est_act(tipaco_id){
    $.post("/Maie/controller/tipos.php?opc=activo",{tipaco_id:tipaco_id},function (data){
        $('#tipaco_data').DataTable().ajax.reload();
       // data = JSON.parse(data);
    });
}

function est_ina(tipaco_id){
    $.post("/Maie/controller/tipos.php?opc=inactivo",{tipaco_id:tipaco_id},function (data){
        $('#tipaco_data').DataTable().ajax.reload();
    });
}

init();