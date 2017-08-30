<?php
/**
 * Created by PhpStorm.
 * User: cristhianpinzon
 * Date: 23/08/17
 * Time: 9:18 PM
 */

require_once "../models/Producto.php";

//$producto =  new Categoria();
$producto = new Producto();
$idproducto = isset($_POST["idproducto"]) ? cleanString(($_POST["idproducto"]))  : "";
$nombre = isset($_POST["nombre"]) ? cleanString(($_POST["nombre"]))  : "";
$precio = isset($_POST["precio"]) ? cleanString(($_POST["precio"]))  : "";
$descripcion = isset($_POST["descripcion"]) ? cleanString(($_POST["descripcion"]))  : "";
$cantidad = isset($_POST["cantidad"]) ? cleanString(($_POST["cantidad"]))  : "";
$idmarca = isset($_POST["idmarca"]) ? cleanString(($_POST["idmarca"]))  : "";
$idcategoria = isset($_POST["idcategoria"]) ? cleanString(($_POST["idcategoria"]))  : "";
$imagen = isset($_POST["imagen"]) ? cleanString(($_POST["imagen"]))  : "";



switch ($_GET["op"]){
    case 'guardaryeditar':

        if (!file_exists($_FILES['imagen']['tmp_name']) || !is_uploaded_file($_FILES['imagen']['tmp_name'])){

            $imagen = "";

        }else {
            $ext = explode(".", $_FILES["imagen"]["name"]);
            if ($_FILES['imagen']['type'] == "image/jpg" || $_FILES['imagen']['type'] == "image/jpeg" || $_FILES['imagen']['type'] == "image/png" ) {
                    $imagen = round(microtime(true)) . '.' . end($ext);
                    move_uploaded_file($_FILES['imagen']['tmp_name'],"../files/productos/" . $imagen);
                }
        }
        if (empty($idproducto)){
            $rspta = $producto->insert($nombre,$precio,$descripcion,$cantidad,$idmarca,$idcategoria,$imagen);
            echo $rspta ? "Producto Registrado" : "Error al registrar el producto";
        }
        else {
            $rspta = $producto->edit($idproducto,$nombre,$precio,$descripcion,$cantidad,$idmarca,$idcategoria,$imagen);

            echo $rspta ? "Producto Actualizado" : "Error al actualizar el producto";
        }
        break;

    case 'mostrar':
        $rspta = $producto->verProducto($idproducto);
        echo json_encode($rspta);
        break;
    case 'desactivar':
        $rspta=$producto->desactivar($idproducto);
        echo $rspta ? "Producto Actualizado" : "Error no se puede desactivar el producto";
        break;

    case 'activar':
        $rspta=$producto->activar($idproducto);
        echo $rspta ? "Producto Actualizado" : "Error no se puede activar el producto";
        break;

    case 'listar':
        $rspta = $producto->listProducto();
        $data = Array();

        while ($reg=$rspta->fetch_object()){
            $data[] = array(
                "0"=>($reg->condicion) ? '<button class="btn btn-warning" onclick="mostrar('.$reg->id_producto.')"><i class="fa fa-pencil"></i>  Editar</button>'.
                    ' <button class="btn btn-danger" onclick="desactivar('.$reg->id_producto.')"><i class="fa fa-close"></i> Desactivar</button>':
                    '<button class="btn btn-warning" onclick="mostrar('.$reg->id_producto.')"><i class="fa fa-pencil"></i>  Editar</button>'.
                    ' <button class="btn btn-primary" onclick="activar('.$reg->id_producto.')"><i class="fa fa-check"></i> Activar</button>',
                "1"=>$reg->id_producto,
                "2"=>$reg->nombre_producto,
                "3"=>$reg->precio_producto,
                "4"=>$reg->descripcion_producto,
                "5"=>$reg->cantidad_producto,
                "6"=>$reg->marca,
                "7"=>$reg->categoria,
                "8"=>"<img src='../files/productos/".$reg->imagen_producto."' height='50px' width='50px'>",
                "9"=>($reg->condicion) ? '<span class="label bg-green">Activo</span>' : '<span class="label bg-red">Inactivo</span>'
            );
        }
        $results = array(
            "sEcho"=>1,
            "iTotalRecords"=>count($data),
            "iTotalDisplayRecords"=>count($data),
            "aaData"=>$data
        );
        echo json_encode($results);
        break;

    case 'selectCategoria':
        require_once "../models/Categoria.php";

        $categoria = new Categoria();

        $rspta = $categoria->select();
        while ($reg = $rspta->fetch_object()){
            echo '<option value='.$reg->id_categoria.' >' .$reg->nombre_categoria .' </option>';
        }

        break;
    case 'selectMarca':
        require_once "../models/Marca.php";

        $marca = new Marca();

        $rspta = $marca->listMarcas();
        while ($reg = $rspta->fetch_object()){
            echo '<option value='.$reg->id_marca.' >' .$reg->nombre_marca .' </option>';
        }

        break;

}

?>


