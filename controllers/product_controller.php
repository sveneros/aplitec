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
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Content-Type: application/json');

function getAllProducts() {
    $link = conectarse();
    $result = mysqli_query($link, "SELECT p.id, p.nombre as producto_nombre, p.codigo as producto_codigo, p.descripcion as producto_descripcion, p.nombre,id_categoria, p.id_marca as producto_id_marca, m.descripcion as marca, c.descripcion as categoria, puntos, p.estado FROM productos as p inner join marcas as m on p.id_marca=m.id inner join categorias as c on p.id_marca=c.id");
    $products = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $products[] = $row;
    }
    mysqli_close($link);
    logs_db("Obtener todos los productos", $_SERVER['PHP_SELF']);
    return $products;
}

function getProductById($id) {
    $link = conectarse();
    $result = mysqli_query($link, "SELECT p.id, p.nombre as producto_nombre, p.codigo as producto_codigo, p.descripcion as producto_descripcion, p.nombre,id_categoria, p.id_marca as producto_id_marca, m.descripcion as marca, c.descripcion as categoria, puntos, p.estado FROM productos as p inner join marcas as m on p.id_marca=m.id inner join categorias as c on p.id_marca=c.id WHERE id = $id");
    $product = mysqli_fetch_assoc($result);
    mysqli_close($link);
    logs_db("Obtener producto por id: ".$id , $_SERVER['PHP_SELF']);
    return $product;
}

function createProduct($codigo, $nombre, $descripcion, $id_marca, $id_categoria, $puntos, $estado) {
    $link = conectarse();
    $codigo = mysqli_real_escape_string($link, $codigo);
    $descripcion = mysqli_real_escape_string($link, $descripcion);
    $estado = mysqli_real_escape_string($link, $estado);

    $result = mysqli_query($link, "INSERT INTO productos (codigo, nombre, descripcion, id_marca, id_categoria, puntos, estado) VALUES ('$codigo', '$nombre', '$descripcion', '$id_marca', '$id_categoria', '$puntos', '$estado')");
    $newId = mysqli_insert_id($link);
    mysqli_close($link);
    logs_db("Se agrego el producto: cod:".$codigo." descr: ".$nombre , $_SERVER['PHP_SELF']);
    return $newId;
}

function updateProduct($id, $codigo, $nombre, $descripcion, $id_marca, $id_categoria, $puntos, $estado) {
    $link = conectarse();
    $codigo = mysqli_real_escape_string($link, $codigo);
    $nombre = mysqli_real_escape_string($link, $nombre);
    $descripcion = mysqli_real_escape_string($link, $descripcion);
    $estado = mysqli_real_escape_string($link, $estado);
    $result = mysqli_query($link, "UPDATE productos SET codigo = '$codigo', nombre = '$nombre', descripcion = '$descripcion', id_marca = '$id_marca', id_categoria = '$id_categoria', puntos = $puntos, estado = '$estado' WHERE id = $id");
    mysqli_close($link);
    logs_db("Se edito el producto: cod:".$codigo." descr: ".$nombre , $_SERVER['PHP_SELF']);
    return $result;
}

function deleteProduct($id) {
    $link = conectarse();
    $result = mysqli_query($link, "DELETE FROM productos WHERE id = $id");
    mysqli_close($link);
    logs_db("Se Elimino el producto: id:". $id  , $_SERVER['PHP_SELF']);
    return $result;
}

// Handle the request based on the HTTP method
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $product = getProductById($id);
            echo json_encode($product);
        } else {
            $products = getAllProducts();
            echo json_encode($products);
        }
        break;
    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);
        $id = createProduct($data['codigo'],$data['nombre'], $data['descripcion'], $data['id_marca'], $data['id_categoria'], $data['puntos'], $data['estado']);
        $result = json_encode(['id' => $id]);
        echo json_encode(['success' => $result]);
        break;
    case 'PUT':
        $data = json_decode(file_get_contents('php://input'), true);
        $id = $data['id'];
        $result = updateProduct($id, $data['codigo'],$data['nombre'], $data['descripcion'], $data['id_marca'], $data['id_categoria'], $data['puntos'], $data['estado']);
        echo json_encode(['success' => $result]);
        break;
    case 'DELETE':
        $id = $_GET['id'];
        $result = deleteProduct($id);
        echo json_encode(['success' => $result]);
        break;
    default:
        http_response_code(405);
        echo json_encode(['error' => 'Method Not Allowed']);
}
