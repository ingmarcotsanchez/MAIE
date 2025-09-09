var usu_id = $('#usu_idx').val();

function init(){
    $("#remision_form").on("submit",function(e){
        guardaryeditar(e);
    });

}

function guardaryeditar(e){
    //console.log("prueba");
    e.preventDefault();
    var formData = new FormData($("#remision_form")[0]);
    //console.log(formData);
    $.ajax({
        url: "/MAIE/controller/remision.php?opc=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        
        success: function(data){
            console.log(data);
            $('#remisiones_data').DataTable().ajax.reload();
            $('#modalcrearRemision').modal('hide');

            Swal.fire({
                title: 'Correcto!',
                text: 'Se Registro Correctamente',
                icon: 'success',
                confirmButtonText: 'Aceptar'
            })
        }
    });
}

$(document).ready(function(){

    $('#prog_id').select2({
        dropdownParent: $('#modalcrearRemision')
    });
    $('#est_id').select2({
        dropdownParent: $('#modalcrearRemision')
    });
    $('#mod_id').select2({
        dropdownParent: $('#modalcrearRemision')
    });
    $('#jor_id').select2({
        dropdownParent: $('#modalcrearRemision')
    });
    $('#cen_id').select2({
        dropdownParent: $('#modalcrearRemision')
    });
    $('#seme_id').select2({
        dropdownParent: $('#modalcrearRemision')
    });
    $('#tipaco_id').select2({
        dropdownParent: $('#modalcrearRemision')
    });
    $('#asig_id').select2({
        dropdownParent: $('#modalcrearRemision')
    });
    $('#nec_id').select2({
        dropdownParent: $('#modalcrearRemision')
    });
    $('#prof_id').select2({
        dropdownParent: $('#modalcrearRemision')
    });
    //combo_programas();
    //combo_estudiantes();
    combo_modalidades();
    combo_jornadas();
    combo_centros();
    combo_semestres();
    combo_tipoAcompañamiento();
    combo_asignaturas();
    combo_necesidades();
    combo_profesores();

    /* $('input#est_dni').keypress(function (event) {
        if (event.which < 18 || event.which > 57 || this.value.length === 10) {
          return false;
        }
    });

    $("#est_dni").on("keyup", function() {
        var est_dni = $("#est_dni").val(); //CAPTURANDO EL VALOR DE INPUT CON ID CEDULA
        var longitudCedula = $("#est_dni").val().length; //CUENTO LONGITUD
      
      //Valido la longitud 
        if(longitudCedula >= 3){
            var dataString = 'est_dni=' + est_dni;
      
            $.ajax({
                url: '/MAIE/views/js/verificarEstudiante.php',
                type: "GET",
                data: dataString,
                dataType: "JSON",
      
                success: function(datos){
      
                    if( datos.success == 1){
      
                        $("#respuesta").html(datos.message);
      
                        $("input").attr('disabled',true);
                        $("select").attr('disabled',true);
                        $("input#est_dni").attr('disabled',false);
                        $("button").attr('disabled',true);
      
                    }else{
      
                        $("#respuesta").html(datos.message);
      
                        $("input").attr('disabled',false);
                        $("select").attr('disabled',false);
                        $("button").attr('disabled',false);
      
                    }
                }
            });
        }
    }); */


    $('#remisiones_data').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        buttons: [
            'excelHtml5',
            'csvHtml5',
        ],
        "ajax":{
            url:"/MAIE/controller/remision.php?opc=listar",
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
    $('#titulo_modal').html('Nueva Remisión');
    $('#remision_form')[0].reset();
    $('#modalcrearRemision').modal('show');
}

function editar(remision_id){
    $.post("/MAIE/controller/remision.php?opc=mostrar",{remision_id:remision_id},function (data){
        data = JSON.parse(data);
        //console.log(data);
        $('#est_id').val(data.est_id);
        $('#est_telf').val(data.est_telf);
        $('#mod_id').val(data.mod_id);
        $('#jor_id').val(data.jor_id);
        $('#cen_id').val(data.cen_id);
        $('#prog_id').val(data.prog_id);
        $('#seme_id').val(data.seme_id);
        $('#tipaco_id').val(data.tipaco_id);
        $('#asig_id').val(data.asig_id);
        $('#nec_id').val(data.nec_id);
        $('#prof_id').val(data.prof_id);
        $('#rem_mens').val(data.rem_mens);
        
        $('#rem_estado').val(data.rem_estado);
    });
    $('#titulo_modal').html('Editar Remisión');
    $('#modalcrearRemision').modal('show');
}

function eliminar(remision_id){
    Swal.fire({
        title: 'Eliminar!',
        text: 'Desea eleminar el Registro?',
        icon: 'error',
        showCancelButton: true,
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar',
    }).then((result)=>{
        if(result.value){
            $.post("/MAIE/controller/remision.php?opc=eliminar",{remision_id:remision_id},function (data){
                $('#remisiones_data').DataTable().ajax.reload();
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
function test(){
    alert(12);
}

function combo_programas(){
    if($("#cen_id").val() > 0 && $("#cen_id").val() != ''){
        $.post("/MAIE/controller/programas.php?opc=combo2&cen_id="+$("#cen_id").val(), function (data) {
            $('#prog_id').html(data);
        });
    }else{
        alert("debe seleccionar el centro")
    }
}

function combo_estudiantes(){
    if($("#cen_id").val() > 0 && $("#cen_id").val() != '' && $("#prog_id").val() > 0 && $("#prog_id").val() != '' ){
        $.post("/MAIE/controller/estudiante.php?opc=combo&cen_id="+$("#cen_id").val()+"&prog_id="+$("#prog_id").val(), function (data) {
            $('#est_id').html(data);
        });
    }else{
        alert("debe seleccionarl el centro y el programa")
    }
    
}

function combo_modalidades(){
    $.post("/MAIE/controller/modalidad.php?opc=combo", function (data) {
        $('#mod_id').html(data);
    });
}

function combo_jornadas(){
    $.post("/MAIE/controller/jornada.php?opc=combo", function (data) {
        $('#jor_id').html(data);
    });
}

function combo_centros(){
    $.post("/MAIE/controller/centro.php?opc=combo", function (data) {
        $('#cen_id').html(data);
    });
}

function combo_semestres(){
    $.post("/MAIE/controller/semestre.php?opc=combo", function (data) {
        $('#seme_id').html(data);
    });
}

function combo_tipoAcompañamiento(){
    $.post("/MAIE/controller/tipos.php?opc=combo", function (data) {
        $('#tipaco_id').html(data);
    });
}

function combo_asignaturas(){
    $.post("/MAIE/controller/asignatura.php?opc=combo", function (data) {
        $('#asig_id').html(data);
    });
}

function combo_necesidades(){
    $.post("/MAIE/controller/necesidades.php?opc=combo", function (data) {
        $('#nec_id').html(data);
    });
}

function combo_profesores(){
    $.post("/MAIE/controller/profesor.php?opc=combo", function (data) {
        $('#prof_id').html(data);
    });
}

/* $(document).on("click", "#btnplantilla", function () {
    $('#modalEstudiante').modal('show');
}); */

/* var ExcelToJSON = function() {
    this.parseExcel = function(file) {
        var reader = new FileReader();

        reader.onload = function(e) {
            var data = e.target.result;
            var workbook = XLSX.read(data, {
                type: 'binary'
            });
            //TODO: Recorrido a todas las pestañas
            workbook.SheetNames.forEach(function(sheetName) {
                // Here is your object
                var XL_row_object = XLSX.utils.sheet_to_row_object_array(workbook.Sheets[sheetName]);
                var json_object = JSON.stringify(XL_row_object);
                EstudianteList = JSON.parse(json_object);

                console.log(EstudianteList)
                for (i = 0; i < EstudianteList.length; i++) {

                    var columns = Object.values(EstudianteList[i])

                    $.post("/MAIE/controller/estudiante.php?opc=guardar_desde_excel",{
                        est_dni : columns[0],
                        est_tipo : columns[1],
                        est_cedula : columns[2],
                        est_nom : columns[3],
                        est_ape : columns[4],
                        est_fecnac : columns[5],
                        est_correo : columns[6],
                        est_sex : columns[7],
                        est_telf :columns[8],
                        est_estado : columns[9],
                        prog_id : columns[10]
                    }, function (data) {
                        console.log(data);
                    });

                }
                
                document.getElementById("upload").value=null;

                $('#estudiante_data').DataTable().ajax.reload();
                $('#modalEstudiante').modal('hide');
            })
        };
        reader.onerror = function(ex) {
            console.log(ex);
        };

        reader.readAsBinaryString(file);
    };
};

function handleFileSelect(evt) {
    var files = evt.target.files; // FileList object
    var xl2json = new ExcelToJSON();
    xl2json.parseExcel(files[0]);
}

document.getElementById('upload').addEventListener('change', handleFileSelect, false);
 */



init();