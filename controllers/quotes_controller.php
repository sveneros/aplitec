<?php
include("conx.php");
include("funciones.php");

header("Content-Type: application/json; charset=UTF-8");
header("Expires: 0");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header("Content-Type: application/json; charset=UTF-8");

function getAllQuotes() {
    $link = conectarse();
    $result = mysqli_query($link, "SELECT d.id_documento as numero, d.fecha as fecha, d.total as total, d.estado as estado, c.nombre as nombre, c.apellido1 as apellido1, c.apellido2 as apellido2, c.cel1 as telefono,c.email as email, c.cel2 as celular, c.direccion as direccion  
                              FROM documentos as d 
                              INNER JOIN clientes as c ON d.id_cliente = c.id 
                              WHERE d.id_tipo_documento = 5 
                              ORDER BY d.id_documento DESC;");
    
    $Quotes = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $id_documento = $row['numero'];
        $detalle_result = mysqli_query($link, "SELECT k.producto as producto, k.descripcion as descripcion, k.cantidad as cantidad, k.precio_unitario as precio_unitario, k.precio_total as precio_total 
                                               FROM kardex as k 
                                               WHERE k.id_documento = '$id_documento' order by 1 desc;");
        
        $detalles = array();
        while ($detalle = mysqli_fetch_assoc($detalle_result)) {
            $detalles[] = $detalle;
        }
        
        $row['detalle'] = $detalles;
        $Quotes[] = $row;
    }
    
    mysqli_close($link);
    return $Quotes;
}

function getAllQuotesByClientId($client_id){
    $link = conectarse();
    $result = mysqli_query($link, "SELECT d.id_documento as numero, d.fecha as fecha, d.total as total, d.estado as estado, c.nombre as nombre, c.apellido1 as apellido1, c.apellido2 as apellido2, c.cel1 as telefono,c.email as email, c.cel2 as celular, c.direccion as direccion  
                              FROM documentos as d 
                              INNER JOIN clientes as c ON d.id_cliente = c.id 
                              WHERE d.id_tipo_documento = 5 and d.id_cliente = $client_id
                              ORDER BY d.id_documento DESC;");
    
    $Quotes = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $id_documento = $row['numero'];
        $detalle_result = mysqli_query($link, "SELECT k.producto as producto, k.descripcion as descripcion, k.cantidad as cantidad, k.precio_unitario as precio_unitario, k.precio_total as precio_total 
                                               FROM kardex as k 
                                               WHERE k.id_documento = '$id_documento' order by 1 desc;");
        
        $detalles = array();
        while ($detalle = mysqli_fetch_assoc($detalle_result)) {
            $detalles[] = $detalle;
        }
        
        $row['detalle'] = $detalles;
        $Quotes[] = $row;
    }
    
    mysqli_close($link);
    return $Quotes;
}

function getQuoteById($id) {
    $link = conectarse();
    $result = mysqli_query($link, "SELECT * FROM documentos WHERE id_documento = $id");
    $Log = mysqli_fetch_assoc($result);
    mysqli_close($link);
    return $Log;
}



$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $Log = getLogById($id);
            echo json_encode($Log);
        }
        else if (isset($_GET['client_id'])) {
            $id = $_GET['client_id'];
            $Log = getAllQuotesByClientId($id);
            echo json_encode($Log);
        } else {
            $Logs = getAllQuotes();
            echo json_encode($Logs);
        }
        break;
    
    default:
        http_response_code(405);
        echo json_encode(['error' => 'Method Not Allowed']);
}