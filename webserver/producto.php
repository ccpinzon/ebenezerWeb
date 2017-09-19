<?php
/**
 * Created by PhpStorm.
 * User: Cristhian Pinzon
 * Date: 06/09/2017
 * Time: 10:56 AM
 */

require_once "../models/Producto.php";
require_once "../models/Categoria.php";

$producto = new Producto();

$categoria =  new Categoria();


switch ($_GET["op"]){

    case 'listarProductos':

        $rspta = $producto->listProductoActivos();
        $return_arr = Array();

        while ($r = $rspta->fetch_assoc()) {

            $row_array['id_producto'] = $r['id_producto'];
            $row_array['id_categoria'] = $r['id_categoria'];
            $row_array['id_marca'] = $r['id_marca'];
            $row_array['nombre_producto'] = $r['nombre_producto'];
            $row_array['precio_producto'] = $r['precio_producto'];
            $row_array['descripcion_producto'] = $r['descripcion_producto'];
            $row_array ['cantidad_producto'] = $r['cantidad_producto'];
            $row_array['condicion'] = $r['condicion'];
            $row_array['marca'] = $r['marca'];
            $row_array['categoria'] = $r['categoria'];
            if ($r['imagen_producto'] == '') {
                $row_array['imagen_producto'] = 'https://www.jumadidirecto.es/image/jumadidirecto.es/system/not_found.jpg';
            } else {
                $row_array['imagen_producto'] = 'https://ebenezer-market.000webhostapp.com/files/productos/' . $r['imagen_producto'];
            }
            array_push($return_arr, $row_array);

        }
            echo json_encode($return_arr, JSON_UNESCAPED_UNICODE);
        break;

    case 'listarCategorias':

        $rspta = $categoria->listCategoriasActivas();
        $return_arr = Array();

        while ($r = $rspta->fetch_assoc()){
            $row_array['id_categoria'] = $r['id_categoria'];
            $row_array['nombre_categoria'] = $r['nombre_categoria'];
            array_push($return_arr, $row_array);
        }
        echo json_encode($return_arr, JSON_UNESCAPED_UNICODE);
        break;

}


?>