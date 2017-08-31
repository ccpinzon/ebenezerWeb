$("#frmAcceso").on('submit',function (e) {
    e.preventDefault();
    email=$("#email").val();
    clave=$("#pass").val();

    $.post("../ajax/usuario.php?op=verificar",
        {"email":email,"pass":clave},
        function (data) {
            console.log(data);
           if (data != "null"){

               $(location).attr("href","categoria.php");


            }
            else {
                bootbox.alert("Usuario y/o pass incorrectos");
            }


        });


});