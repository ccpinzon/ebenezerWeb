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
    $("#idusuario").val("");
    $("#nombres").val("");
    $("#email").val("");
    $("#pass").val("");
    $("#tel").val("");
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
            url: '../ajax/usuario.php?op=listarA',
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
        url: "../ajax/usuario.php?op=guardaryeditar",
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

function mostrar(idusuario) {
    $.post("../ajax/usuario.php?op=mostrar",{idusuario : idusuario}, function (data,status) {
        data = JSON.parse(data);
        showForm(true);

        $("#idusuario").val(data.id_usuario);
        $("#nombres").val(data.nombres_usuario);
        $("#email").val(data.email_usuario);
        $("#pass").val(data.hashpass_usuario);
        $("#tel").val(data.telefono_usuario);
    })
}



init();