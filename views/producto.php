<?php
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
                        <h1 class="box-title">Producto <button class="btn btn-success" id="btnAgregar" onclick="showForm(true)"><i class="fa fa-plus-circle"></i> Agregar</button></h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="col-lg-12 col-xs-12 col-md-12 col-sm-12 panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                            <thead>
                            <th>Opciones</th>
                            <th>Codigo</th>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Descripcion</th>
                            <th>Stock</th>
                            <th>Marca</th>
                            <th>Categoria</th>
                            <th>Imagen</th>
                            <th>Estado</th>
                            </thead>
                            <tbody>

                            </tbody>
                            <tfoot>
                            <th>Opciones</th>
                            <th>Codigo</th>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Descripcion</th>
                            <th>Stock</th>
                            <th>Marca</th>
                            <th>Categoria</th>
                            <th>Imagen</th>
                            <th>Estado</th>
                            </tfoot>
                        </table>
                    </div>
                    <div class="panel-body table-responsive" style="height: 400px;" id="formularioregistros">
                        <!--                            Formulario de agrgar categorias-->
                        <form action="" id="formulario" name="formulario" method="post">
                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Nombre: </label>
                                <input type="hidden" name="idproducto" id="idproducto">
                                <input class="form-control" type="text" name="nombre" id="nombre" maxlength="100" placeholder="Nombre del producto" required>

                            </div>

                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Categoria: </label>
                                <select id="idcategoria" name="idcategoria" class="form-control selectpicker" data-live-search="true" required>

                                </select>
                            </div>

                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Marca: </label>
                                <select id="idmarca" name="idmarca" class="form-control selectpicker" data-live-search="true" required>

                                </select>
                            </div>


                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Precio: </label>
                                <input class="form-control" type="number" name="precio" id="precio" maxlength="45" placeholder="Precio" required>
                            </div>

                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Stock: </label>
                                <input class="form-control" type="number" name="cantidad" id="cantidad" maxlength="45" placeholder="Stock" required>
                            </div>

                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Descripcion: </label>
                                <input class="form-control" type="text" name="descripcion" id="descripcion" maxlength="300" placeholder="Descripcion del producto">
                            </div>

                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Imagen: </label>
                                <input class="form-control" type="file" name="imagen" id="imagen" >
                                <input type="hidden" name="imagenactual" id="imagenactual">
                                <img src="" width="150px" height="120px" id="imagenmuestra">
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

<script type="text/javascript" src="scripts/producto.js"></script>
