<?php
session_start();
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

function getAllBrands() {
    $link = conectarse();
    $result = mysqli_query($link, "SELECT * FROM marcas order by codigo, descripcion");
    $brands = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $brands[] = $row;
    }
    mysqli_close($link);
    logs_db("Obtener todas las marcas | usuario: ". $_SESSION['sml2020_svenerossys_usuario_registrado'], $_SERVER['PHP_SELF']);
    return $brands;
}

function getBrandById($id) {
    $link = conectarse();
    $result = mysqli_query($link, "SELECT * FROM marcas WHERE id = $id");
    $brand = mysqli_fetch_assoc($result);
    mysqli_close($link);
    logs_db("Obtener marca por id: ".$id , $_SERVER['PHP_SELF']);
    return $brand;
}

function createBrand($codigo, $descripcion, $estado) {
    $link = conectarse();
    $codigo = mysqli_real_escape_string($link, $codigo);
    $descripcion = mysqli_real_escape_string($link, $descripcion);
    $estado = mysqli_real_escape_string($link, $estado);
    $result = mysqli_query($link, "INSERT INTO marcas (codigo, descripcion, estado) VALUES ('$codigo','$descripcion', '$estado')");
    $newId = mysqli_insert_id($link);
    mysqli_close($link);
    logs_db("Marca Creada: ".$descripcion , $_SERVER['PHP_SELF']);
    return $newId;
}

function updateBrand($id, $codigo, $descripcion, $estado) {
    $link = conectarse();
    $codigo = mysqli_real_escape_string($link, $codigo);
    $descripcion = mysqli_real_escape_string($link, $descripcion);
    $estado = mysqli_real_escape_string($link, $estado);
    $result = mysqli_query($link, "UPDATE marcas SET codigo = '$codigo',descripcion = '$descripcion', estado = '$estado' WHERE id = $id");
    mysqli_close($link);
    logs_db("Marca Editada: ".$descripcion , $_SERVER['PHP_SELF']);
    return $result;
}

function deleteBrand($id) {
    $link = conectarse();
    $result = mysqli_query($link, "DELETE FROM marcas WHERE id = $id");
    mysqli_close($link);
    logs_db("Marca Eliminada por id: ".$id , $_SERVER['PHP_SELF']);
    return $result;
}

// Handle the request based on the HTTP method
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $brand = getBrandById($id);
            echo json_encode($brand);
        } else {
            $brands = getAllBrands();
            echo json_encode($brands);
        }
        break;
    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);
        $id = createBrand($data['codigo'],$data['descripcion'], $data['estado']);
        $result = json_encode(['id' => $id]);
        echo json_encode(['success' => $result]);
        break;
    case 'PUT':
        $data = json_decode(file_get_contents('php://input'), true);
        $id = $data['id'];
        $result = updateBrand($id,$data['codigo'], $data['descripcion'], $data['estado']);
        echo json_encode(['success' => $result]);
        break;
    case 'DELETE':
        $id = $_GET['id'];
        $result = deleteBrand($id);
        echo json_encode(['success' => $result]);
        break;
    default:
        http_response_code(405);
        echo json_encode(['error' => 'Method Not Allowed']);
}