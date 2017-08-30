/**
 * Created by cristhianpinzon on 23/08/17.
 */
var tabla;

function init() {

    showForm(false);
    listar();

    $("#formulario").on("submit",function (e) {
        guardaryeditar(e);
    })
}

function clean() {
    $("#idmarca").val("");
    $("#nombre").val("");
}

// funcion mostrar formulario recibe true o false
function showForm(flag) {
    clean();
    if (flag){
        $("#listadoregistros").hide();
        $("#formularioregistros").show();
        $("#btnGuardar").prop("disabled",false);
        $("#btnAgregar").hide();
    }else {
        $("#listadoregistros").show();
        $("#formularioregistros").hide();
        $("#btnAgregar").show();
    }
}

// funcion cancelar form

function cancelForm() {
    clean();
    showForm(false);
}
// funcion listar

function listar() {
    tabla=$('#tbllistado').dataTable({
        "aProcessing":true,
        "aServerSide":true,
        dom: 'Bfrtip',
        buttons : [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdf'
        ],

        "ajax": {
            url: '../ajax/marca.php?op=listar',
            type: "get",
            dataType : "json",
            error: function (e) {
                console.log(e.responseText);
            }
        },
        "bDestroy":true,
        "iDisplayLength": 5,// paginacion
        "order": [[0,"desc"]]// ordnamiento columna, orden

    }).DataTable();
}
function guardaryeditar(e) {
    e.preventDefault();
    $('#btnGuardar').prop("disabled",true);
    var formData =  new FormData($("#formulario")[0]);


    $.ajax({
        url: "../ajax/marca.php?op=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,

        success: function (datos) {
            bootbox.alert(datos);
            showForm(false);
            tabla.ajax.reload();
        }
    });

    clean();
}

function mostrar(idmarca) {
    $.post("../ajax/marca.php?op=mostrar",{idmarca : idmarca}, function (data,status) {
        data = JSON.parse(data);
        showForm(true);

        $("#nombre").val(data.nombre_marca);
        $("#idmarca").val(data.id_marca);
    })
}



init();