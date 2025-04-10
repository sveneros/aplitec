<?php
include("config.php");
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

$response = [
    'success' => false,
    'message' => '',
    'data' => []
];

try {
    $pdo = new PDO("mysql:host=$server;dbname=$dbname;charset=utf8mb4", $usr, $pwd);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Ejecutar todos los algoritmos genéticos
    $response['data'] = [
        'cliente_mas_cotizaciones' => ejecutarAlgoritmoClienteMasCotizaciones($pdo),
        'cliente_menos_cotizaciones' => ejecutarAlgoritmoClienteMenosCotizaciones($pdo),
        'marca_mas_cotizada' => ejecutarAlgoritmoMarcaMasCotizada($pdo),
        'marca_menos_cotizada' => ejecutarAlgoritmoMarcaMenosCotizada($pdo),
        //'productos_mas_solicitados' => ejecutarAlgoritmoGenetico($pdo) // El original
    ];
    
    $response['success'] = true;
    $response['message'] = 'Análisis completado correctamente';
    
} catch (PDOException $e) {
    $response['message'] = "Error de conexión: " . $e->getMessage();
}

echo json_encode($response, JSON_PRETTY_PRINT);

/**
 * Algoritmo genético para encontrar el cliente con más cotizaciones
 */
function ejecutarAlgoritmoClienteMasCotizaciones(PDO $pdo, int $generaciones = 30, int $tamanoPoblacion = 15): array {
    $clientes = obtenerClientesUnicos($pdo);
    
    if (count($clientes) <= 5) {
        return obtenerClienteMasCotizacionesDirectamente($pdo);
    }
    
    $poblacion = inicializarPoblacionClientes($clientes, $tamanoPoblacion);
    
    for ($i = 0; $i < $generaciones; $i++) {
        $poblacion = evolucionarPoblacionClientes($poblacion, $pdo, 'max');
    }
    
    //return ['cliente' => $poblacion[0], 'cotizaciones' => contarCotizacionesCliente($poblacion[0], $pdo)];
    $nombre = devuelve_campo("clientes","nombre","id",$poblacion[0]);
    $apellido1 = devuelve_campo("clientes","apellido1","id",$poblacion[0]);
    $apellido2 = devuelve_campo("clientes","apellido2","id",$poblacion[0]);
    return ['cliente' => $nombre . " ". $apellido1. " ". $apellido2, 'cotizaciones' => contarCotizacionesCliente($poblacion[0], $pdo)];
}

/**
 * Algoritmo genético para encontrar el cliente con menos cotizaciones
 */
function ejecutarAlgoritmoClienteMenosCotizaciones(PDO $pdo, int $generaciones = 30, int $tamanoPoblacion = 15): array {
    $clientes = obtenerClientesUnicos($pdo);
    
    if (count($clientes) <= 5) {
        return obtenerClienteMenosCotizacionesDirectamente($pdo);
    }
    
    $poblacion = inicializarPoblacionClientes($clientes, $tamanoPoblacion);
    
    for ($i = 0; $i < $generaciones; $i++) {
        $poblacion = evolucionarPoblacionClientes($poblacion, $pdo, 'min');
    }
    
    //return ['cliente' => $poblacion[0], 'cotizaciones' => contarCotizacionesCliente($poblacion[0], $pdo)];
    $nombre = devuelve_campo("clientes","nombre","id",$poblacion[0]);
    $apellido1 = devuelve_campo("clientes","apellido1","id",$poblacion[0]);
    $apellido2 = devuelve_campo("clientes","apellido2","id",$poblacion[0]);
    return ['cliente' => $nombre . " ". $apellido1. " ". $apellido2, 'cotizaciones' => contarCotizacionesCliente($poblacion[0], $pdo)];
}

/**
 * Algoritmo genético para encontrar la marca más cotizada
 */
function ejecutarAlgoritmoMarcaMasCotizada(PDO $pdo, int $generaciones = 30, int $tamanoPoblacion = 15): array {
    $marcas = obtenerMarcasUnicas($pdo);
    
    if (count($marcas) <= 5) {
        return obtenerMarcaMasCotizadaDirectamente($pdo);
    }
    
    $poblacion = inicializarPoblacionMarcas($marcas, $tamanoPoblacion);
    
    for ($i = 0; $i < $generaciones; $i++) {
        $poblacion = evolucionarPoblacionMarcas($poblacion, $pdo, 'max');
    }
    
    return ['marca' => $poblacion[0], 'cotizaciones' => contarCotizacionesMarca($poblacion[0], $pdo)];
}

/**
 * Algoritmo genético para encontrar la marca menos cotizada
 */
function ejecutarAlgoritmoMarcaMenosCotizada(PDO $pdo, int $generaciones = 30, int $tamanoPoblacion = 15): array {
    $marcas = obtenerMarcasUnicas($pdo);
    
    if (count($marcas) <= 5) {
        return obtenerMarcaMenosCotizadaDirectamente($pdo);
    }
    
    $poblacion = inicializarPoblacionMarcas($marcas, $tamanoPoblacion);
    
    for ($i = 0; $i < $generaciones; $i++) {
        $poblacion = evolucionarPoblacionMarcas($poblacion, $pdo, 'min');
    }
    
    return ['marca' => $poblacion[0], 'cotizaciones' => contarCotizacionesMarca($poblacion[0], $pdo)];
}

/* FUNCIONES AUXILIARES COMUNES */
function obtenerClientesUnicos(PDO $pdo): array {
    $stmt = $pdo->query("SELECT DISTINCT id_cliente FROM documentos");
    return $stmt->fetchAll(PDO::FETCH_COLUMN);
}

function obtenerMarcasUnicas(PDO $pdo): array {
    $stmt = $pdo->query("SELECT DISTINCT 
                         CASE 
                            WHEN producto LIKE '%BW TECHNOLOGIES%' THEN 'BW TECHNOLOGIES'
                            WHEN producto LIKE '%FLUKE%' THEN 'FLUKE'
                            WHEN producto LIKE '%CAMPBELL SCIENTIFIC%' THEN 'CAMPBELL SCIENTIFIC'
                            WHEN producto LIKE '%LIFELOC%' THEN 'LIFELOC'
                            WHEN producto LIKE '%SOLAR%' THEN 'SOLAR'
                            WHEN producto LIKE '%SOLINST%' THEN 'SOLINST'
                            WHEN producto LIKE '%TESTO%' THEN 'TESTO'
                            ELSE NULL
                         END as marca
                         FROM kardex
                         HAVING marca IS NOT NULL");
    return $stmt->fetchAll(PDO::FETCH_COLUMN);
}
function contarCotizacionesCliente(int $idCliente, PDO $pdo): int {
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM documentos WHERE id_cliente = ?");
    $stmt->execute([$idCliente]);
    return (int)$stmt->fetchColumn();
}

function contarCotizacionesMarca(string $marca, PDO $pdo): int {
    $stmt = $pdo->prepare("SELECT COUNT(k.id) 
                          FROM kardex k
                          JOIN documentos d ON k.id_documento = d.id_documento
                          WHERE k.producto LIKE ?");
    $likePattern = ($marca == 'Fluke') ? '%Fluke%' : '%';
    $stmt->execute([$likePattern]);
    return (int)$stmt->fetchColumn();
}

/* FUNCIONES DE INICIALIZACIÓN Y EVOLUCIÓN */
function inicializarPoblacionClientes(array $clientes, int $tamanoPoblacion): array {
    $poblacion = [];
    for ($i = 0; $i < $tamanoPoblacion; $i++) {
        $poblacion[] = $clientes[array_rand($clientes)];
    }
    return $poblacion;
}

function inicializarPoblacionMarcas(array $marcas, int $tamanoPoblacion): array {
    $poblacion = [];
    for ($i = 0; $i < $tamanoPoblacion; $i++) {
        $poblacion[] = $marcas[array_rand($marcas)];
    }
    return $poblacion;
}

function evolucionarPoblacionClientes(array $poblacion, PDO $pdo, string $tipo = 'max'): array {
    // Ordenar por fitness
    usort($poblacion, function($a, $b) use ($pdo, $tipo) {
        $cotizacionesA = contarCotizacionesCliente($a, $pdo);
        $cotizacionesB = contarCotizacionesCliente($b, $pdo);
        return ($tipo == 'max') ? ($cotizacionesB <=> $cotizacionesA) : ($cotizacionesA <=> $cotizacionesB);
    });
    
    // Seleccionar los mejores (50%)
    $mejores = array_slice($poblacion, 0, (int)(count($poblacion) / 2));
    
    // Cruzar y mutar
    $nuevaGeneracion = $mejores;
    $todosClientes = obtenerClientesUnicos($pdo);
    
    while (count($nuevaGeneracion) < count($poblacion)) {
        // 80% de probabilidad de cruce, 20% de nueva solución aleatoria
        if (rand(1, 100) <= 80 && count($mejores) >= 2) {
            $padre1 = $mejores[array_rand($mejores)];
            $padre2 = $mejores[array_rand($mejores)];
            $hijo = (rand(0, 1)) ? $padre1 : $padre2; // "Cruce" simple
        } else {
            $hijo = $todosClientes[array_rand($todosClientes)];
        }
        
        // 10% de probabilidad de mutación
        if (rand(1, 100) <= 10) {
            $hijo = $todosClientes[array_rand($todosClientes)];
        }
        
        $nuevaGeneracion[] = $hijo;
    }
    
    return $nuevaGeneracion;
}

function evolucionarPoblacionMarcas(array $poblacion, PDO $pdo, string $tipo = 'max'): array {
    // 1. Ordenar la población por fitness (cotizaciones)
    usort($poblacion, function($a, $b) use ($pdo, $tipo) {
        $cotizacionesA = contarCotizacionesMarca($a, $pdo);
        $cotizacionesB = contarCotizacionesMarca($b, $pdo);
        return ($tipo == 'max') ? ($cotizacionesB <=> $cotizacionesA) : ($cotizacionesA <=> $cotizacionesB);
    });
    
    // 2. Seleccionar los mejores (50% superior)
    $mejores = array_slice($poblacion, 0, (int)(count($poblacion) / 2));
    
    // 3. Cruzar y mutar para crear nueva generación
    $nuevaGeneracion = $mejores;
    $todasMarcas = obtenerMarcasUnicas($pdo);
    
    while (count($nuevaGeneracion) < count($poblacion)) {
        // 80% de probabilidad de cruce, 20% de nueva solución aleatoria
        if (rand(1, 100) <= 80 && count($mejores) >= 2) {
            $padre1 = $mejores[array_rand($mejores)];
            $padre2 = $mejores[array_rand($mejores)];
            $hijo = (rand(0, 1)) ? $padre1 : $padre2; // "Cruce" simple (selección de un padre)
        } else {
            $hijo = $todasMarcas[array_rand($todasMarcas)]; // Nueva solución aleatoria
        }
        
        // 15% de probabilidad de mutación
        if (rand(1, 100) <= 15) {
            $hijo = $todasMarcas[array_rand($todasMarcas)]; // Mutación: cambiar a marca aleatoria
        }
        
        $nuevaGeneracion[] = $hijo;
    }
    
    // 4. Asegurar diversidad en la nueva generación
    if (count(array_unique($nuevaGeneracion)) < 2 && count($todasMarcas) > 1) {
        $nuevaGeneracion[array_rand($nuevaGeneracion)] = $todasMarcas[array_rand($todasMarcas)];
    }
    
    return $nuevaGeneracion;
}

/* FUNCIONES DIRECTAS PARA CASOS CON POCOS DATOS */

function obtenerClienteMasCotizacionesDirectamente(PDO $pdo): array {
    $stmt = $pdo->query("SELECT id_cliente, COUNT(*) as cotizaciones 
                        FROM documentos 
                        GROUP BY id_cliente 
                        ORDER BY cotizaciones DESC 
                        LIMIT 1");
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function obtenerClienteMenosCotizacionesDirectamente(PDO $pdo): array {
    $stmt = $pdo->query("SELECT id_cliente, COUNT(*) as cotizaciones 
                        FROM documentos 
                        GROUP BY id_cliente 
                        ORDER BY cotizaciones ASC 
                        LIMIT 1");
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function obtenerMarcaMasCotizadaDirectamente(PDO $pdo): array {
    $stmt = $pdo->query("SELECT 
                         CASE 
                            WHEN producto LIKE '%Fluke%' THEN 'Fluke'
                            ELSE 'Otras'
                         END as marca,
                         COUNT(*) as cotizaciones
                         FROM kardex
                         GROUP BY marca
                         ORDER BY cotizaciones DESC
                         LIMIT 1");
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function obtenerMarcaMenosCotizadaDirectamente(PDO $pdo): array {
    $stmt = $pdo->query("SELECT 
                         CASE 
                            WHEN producto LIKE '%Fluke%' THEN 'Fluke'
                            ELSE 'Otras'
                         END as marca,
                         COUNT(*) as cotizaciones
                         FROM kardex
                         GROUP BY marca
                         ORDER BY cotizaciones ASC
                         LIMIT 1");
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
?>
