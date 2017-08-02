<?php
/**
 * Created by PhpStorm.
 * User: cristhianpinzon
 * Date: 2/08/17
 * Time: 5:35 PM
 */

require_once "../models/Categoria.php";

$categoria =  new Categoria();

$idcategoria = isset($_POST["idcategoria"]) ? cleanString(($_POST["idcategoria"]))  : "";
$nombrecategoria = isset($_POST["nombre"]) ? cleanString(($_POST["nombre"])) : "" ;


switch ($_GET["op"]){
    case 'guardaryeditar':

        break;

    case 'mostrar':

        break;

    case 'listar':

        break;
    
}

?>