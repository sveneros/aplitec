<?php
session_start();
include("conx.php");
include("funciones.php");
include_once("Security.php");

header("Content-Type: application/json; charset=UTF-8");
header("Expires: 0");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Content-Type: application/json');

function getAllExchangeRates() {
    $link = conectarse();
    $sql = "SELECT id, fecha, tasa, creado_en, actualizado_en FROM tipo_cambio ORDER BY fecha DESC";
    $result = mysqli_query($link, $sql);
    $rates = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rates[] = $row;
    }
    mysqli_close($link);
    logs_db("Obteniendo todos los tipos de cambio", $_SERVER['PHP_SELF']);
    return $rates;
}

function getExchangeRateByDate($fecha) {
    $link = conectarse();
    $sql = "SELECT id, fecha, tasa FROM tipo_cambio WHERE fecha = ?";
    $stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($stmt, "s", $fecha);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $rate = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);
    mysqli_close($link);
    logs_db("Obteniendo tipo de cambio para fecha: ".$fecha, $_SERVER['PHP_SELF']);
    return $rate;
}

function getCurrentExchangeRate() {
    $link = conectarse();
    $sql = "SELECT id, fecha, tasa FROM tipo_cambio ORDER BY fecha DESC LIMIT 1";
    $result = mysqli_query($link, $sql);
    $rate = mysqli_fetch_assoc($result);
    mysqli_close($link);
    logs_db("Obteniendo tipo de cambio actual", $_SERVER['PHP_SELF']);
    return $rate;
}

function createExchangeRate($fecha, $tasa) {
    $link = conectarse();
    $fecha = mysqli_real_escape_string($link, $fecha);
    $tasa = mysqli_real_escape_string($link, $tasa);
    
    $sql = "INSERT INTO tipo_cambio (fecha, tasa) VALUES (?, ?)";
    $stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($stmt, "sd", $fecha, $tasa);
    $result = mysqli_stmt_execute($stmt);
    $newId = mysqli_insert_id($link);
    mysqli_stmt_close($stmt);
    mysqli_close($link);
    logs_db("Creando tipo de cambio para fecha: ".$fecha." con tasa: ".$tasa, $_SERVER['PHP_SELF']);
    return $newId;
}

function updateExchangeRate($id, $fecha, $tasa) {
    $link = conectarse();
    $fecha = mysqli_real_escape_string($link, $fecha);
    $tasa = mysqli_real_escape_string($link, $tasa);
    
    $sql = "UPDATE tipo_cambio SET fecha = ?, tasa = ? WHERE id = ?";
    $stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($stmt, "sdi", $fecha, $tasa, $id);
    $result = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($link);
    logs_db("Actualizando tipo de cambio ID: ".$id." con tasa: ".$tasa, $_SERVER['PHP_SELF']);
    return $result;
}

function deleteExchangeRate($id) {
    $link = conectarse();
    $sql = "DELETE FROM tipo_cambio WHERE id = ?";
    $stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    $result = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($link);
    logs_db("Eliminando tipo de cambio con ID: ".$id, $_SERVER['PHP_SELF']);
    return $result;
}

// Handle the request based on the HTTP method
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        if (isset($_GET['fecha'])) {
            $fecha = $_GET['fecha'];
            $rate = getExchangeRateByDate($fecha);
            echo json_encode($rate);
        } elseif (isset($_GET['current'])) {
            $rate = getCurrentExchangeRate();
            echo json_encode($rate);
        } else {
            $rates = getAllExchangeRates();
            echo json_encode($rates);
        }
        break;
    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);
        $newId = createExchangeRate($data['fecha'], $data['tasa']);
        echo json_encode(['success' => true, 'id' => $newId]);
        break;
    case 'PUT':
        $data = json_decode(file_get_contents('php://input'), true);
        $result = updateExchangeRate($data['id'], $data['fecha'], $data['tasa']);
        echo json_encode(['success' => $result]);
        break;
    case 'DELETE':
        $id = $_GET['id'];
        $result = deleteExchangeRate($id);
        echo json_encode(['success' => $result]);
        break;
    default:
        http_response_code(405);
        echo json_encode(['error' => 'Method Not Allowed']);
}