<?php
require_once "global.php";

$conexion = new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);

mysqli_query($conexion,'SET NAMES"'.DB_ENCODE.'"');

// posible error en la cadena de conexion

if (mysqli_connect_errno()){
    echo "Fallo la conexion a la BD: %s\n".mysqli_connect_error();
    exit();
}

if (!function_exists('execQuery')){
    function execQuery($sql){
        global $conexion;
        $query = $conexion->query($sql);
        return $query;
    }

    function execQuerySimpleRow($sql){
        global $conexion;
        $query = $conexion->query($sql);
        $row = $query->fetch_assoc();
        return $row;
    }

    function execQuery_returnID($sql){
        global $conexion;
        $query = $conexion->query($sql);
        return $conexion->insert_id;
    }
    function cleanString($str){
        global $conexion;
        $query = mysqli_real_escape_string($conexion,trim($str));
        return htmlspecialchars($str);
    }
}

?>