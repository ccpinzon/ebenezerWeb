var tabla;
// funcion siempre al inicio

function init() {

    showForm(false);
    listar();

    $("#formulario").on("submit",function (e) {
        guardaryeditar(e);
    })


}
//funcion limpiar

function clean() {
    $("#idcategoria").val("");
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
            url: '../ajax/categoria.php?op=listar',
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
        url: "../ajax/categoria.php?op=guardaryeditar",
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

function mostrar(idcategoria) {
    $.post("../ajax/categoria.php?op=mostrar",{idcategoria : idcategoria}, function (data,status) {
        data = JSON.parse(data);
        showForm(true);

        $("#nombre").val(data.nombre_categoria);
        $("#idcategoria").val(data.id_categoria);
    })
}

function desactivar(idcategoria) {
    // bootbox libreria que sirve para mostrar mesajitos de alerta

    bootbox.confirm("Seguro que desea desactivar la categoria? ", function(result){

        if (result){
            $.post("../ajax/categoria.php?op=desactivar",{idcategoria:idcategoria},function (e) {
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }

    })
}

function activar(idcategoria) {
    // bootbox libreria que sirve para mostrar mesajitos de alerta

    bootbox.confirm("Seguro que desea activar la categoria? ", function(result){

        if (result){
            $.post("../ajax/categoria.php?op=activar",{idcategoria:idcategoria},function (e) {
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }

    })
}

init();