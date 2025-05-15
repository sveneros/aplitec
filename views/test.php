<?php 
//include_once("../controllers/Security.php");


//echo (Security::encrypt("adminAdmin123!"));

include("../controllers/conx.php");
$link = conectarse();
$auditData = [
                'id_documento' => 1022,
                'accion' => 'ACTUALIZAR',
                'estado_anterior' => 'CLI', 
                'estado_nuevo' => 'APRO',
                'detalles' => 'Actualización de cotización. Aprobado por administrador',
                'id_usuario' => 'Testing'
            ];
            
function registrar_auditoria_cotizacion($link, $data) {
    $query = "INSERT INTO auditoria_cotizaciones (
                id_documento, id_tipo_documento, accion, 
                estado_anterior, estado_nuevo, detalles, 
                id_usuario, ip_origen
              ) VALUES (?, 5, ?, ?, ?, ?, ?, ?)";
    
    // Asignar valores por defecto antes de bind_param
    $estado_anterior = $data['estado_anterior'] ?? null;
    $estado_nuevo = $data['estado_nuevo'] ?? null;
    $detalles = $data['detalles'] ?? null;
    $id_usuario = $data['id_usuario'] ?? 0;
    $ip_origen = $_SERVER['REMOTE_ADDR'] ?? '';
    
    $stmt = $link->prepare($query);
    $stmt->bind_param("issssis", 
        $data['id_documento'],
        $data['accion'],
        $estado_anterior,
        $estado_nuevo,
        $detalles,
        $id_usuario,
        $ip_origen
    );
    return $stmt->execute();
}

if (!registrar_auditoria_cotizacion($link, $auditData)) {
        throw new Exception("Error al registrar auditoría");
    }

?>