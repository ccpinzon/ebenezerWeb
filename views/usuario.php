<?php
ob_start();
session_start();

if (!isset($_SESSION["nombres"])){
    header("Location: login.html");
}
else {
require "header.php";
?>
<!--Contenido-->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h1 class="box-title">Usuario <button class="btn btn-success" id="btnAgregar" onclick="showForm(true)"><i class="fa fa-plus-circle"></i> Agregar</button></h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="col-lg-6 col-xs-6 col-md-6 col-sm-6 panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                            <thead>
                            <th>Opciones</th>
                            <th>Nombres</th>
                            <th>email</th>
                            <th>Telefono</th>
                            </thead>
                            <tbody>

                            </tbody>
                            <tfoot>
                            <th>Opciones</th>
                            <th>Nombres</th>
                            <th>email</th>
                            <th>Telefono</th>
                            </tfoot>
                        </table>
                    </div>
                    <div class="panel-body table-responsive" style="height: 400px;" id="formularioregistros">
                        <!--                            Formulario de agrgar categorias-->
                        <form action="" id="formulario" name="formulario" method="post">
                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Nombres: </label>
                                <input type="hidden" name="idusuario" id="idusuario">
                                <input class="form-control" type="text" name="nombres" id="nombres" maxlength="80" placeholder="Nombres" required>
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Email: </label>
                                <input class="form-control" type="email" name="email" id="email" maxlength="60" placeholder="Email" required>
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Telefono: </label>
                                <input class="form-control" type="tel" name="tel" id="tel" maxlength="30" placeholder="Telefono">
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Contraseña: </label>
                                <input class="form-control" type="password" name="pass" id="pass" maxlength="60" placeholder="contraseña" required>
                            </div>
                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>
                                <button type="button" class="btn btn-danger" onclick="cancelForm()">
                                    <i class="fa fa-arrow-circle-left"></i> Cancelar
                                </button>
                            </div>
                        </form>
                    </div>
                    <!--Fin centro -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </section><!-- /.content -->

</div><!-- /.content-wrapper -->
<!--Fin-Contenido-->
<?php
require "footer.php";
?>

<script type="text/javascript" src="scripts/usuario.js"></script>
    <?php
}

ob_end_flush();


?>