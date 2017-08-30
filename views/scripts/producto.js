var tabla;
// funcion siempre al inicio

function init() {

    showForm(false);
    listar();

    $("#formulario").on("submit",function (e) {
        guardaryeditar(e);
    })
    // cargar el select de la categoria

    $.post("../ajax/producto.php?op=selectCategoria", function (r) {
        $("#idcategoria").html(r);
        $("#idcategoria").selectpicker('refresh');
    })
    $.post("../ajax/producto.php?op=selectMarca", function (r) {
        $("#idmarca").html(r);
        $("#idmarca").selectpicker('refresh');
    })

    $("#imagenmuestra").hide();

}
//funcion limpiar

function clean() {
    $("#idproducto").val("");
    $("#nombre").val("");
    $("#descripcion").val("");
    $("#cantidad").val("");
    $("#imagenmuestram").attr("src","");
    $("#imagenactual").val("");
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
            url: '../ajax/producto.php?op=listar',
            type: "get",
            dataType : "json",
            error: function (e) {
                console.log(e.responseText);
            }
        },
        "bDestroy":true,
        "iDisplayLength": 8,// paginacion
        "order": [[0,"desc"]]// ordnamiento columna, orden

    }).DataTable();
}

function guardaryeditar(e) {
    e.preventDefault();
    $('#btnGuardar').prop("disabled",true);
    var formData =  new FormData($("#formulario")[0]);


    $.ajax({
        url: "../ajax/producto.php?op=guardaryeditar",
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

function mostrar(idproducto) {
    $.post("../ajax/producto.php?op=mostrar",{idproducto : idproducto}, function (data,status) {
        data = JSON.parse(data);
        showForm(true);

        $("#idproducto").val(data.id_producto);
        $("#idcategoria").val(data.id_categoria);
        $("#idcategoria").selectpicker('refresh');
        $("#idmarca").val(data.id_marca);
        $("#idmarca").selectpicker('refresh');
        $("#nombre").val(data.nombre_producto);
        $("#precio").val(data.precio_producto);
        $("#descripcion").val(data.descripcion_producto);
        $("#imagenmuestra").show();
        $("#imagenmuestra").attr("src","../files/productos/"+data.imagen_producto);
        $("#imagenactual").val(data.imagen_producto);
        $("#cantidad").val(data.cantidad_producto);
        $("#idcategoria").val(data.id_categoria);
        $("#id_marca").val(data.id_marca);
    })
}

function desactivar(idproducto) {
    // bootbox libreria que sirve para mostrar mesajitos de alerta

    bootbox.confirm("Seguro que desea desactivar el producto? ", function(result){

        if (result){
            $.post("../ajax/producto.php?op=desactivar",{idproducto:idproducto},function (e) {
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }

    })
}

function activar(idproducto) {
    // bootbox libreria que sirve para mostrar mesajitos de alerta

    bootbox.confirm("Seguro que desea activar el producto? ", function(result){

        if (result){
            $.post("../ajax/producto.php?op=activar",{idproducto:idproducto},function (e) {
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }

    })
}

init();