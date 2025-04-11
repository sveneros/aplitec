<?php 
include("conx.php");
include("funciones.php");

	$data = array(
		'results' => array(),
		'success' => false,
		'error' => '' 
	);
	
	if ( isset($_POST['productos']) && isset($_POST['id_cliente']) && isset($_POST['fecha']) ) {
		$id_cliente=$_POST['id_cliente'];
		$id_almacen_destino=0;		
		$productsArr = json_decode(str_replace('\\', '', $_POST['productos']));
		$numero_documento=devuelveCorrelativoTipoDoc(5);
	    $id_tipo_documento=5;
	    $glosa="Cotizacion:";
		$fecha=date('Y-m-d H:i:s');	
		$total=0;
		$descuento=0;
		$usuario=1;
		foreach($productsArr as $product){
				 $precio_total=$product[4];
				 $total+=$precio_total;
			}
		unset($product);
		$total_con_descuento_global=$total;
		CreaDocumento($numero_documento,$id_tipo_documento,$id_cliente,"0",$fecha,$glosa,$descuento,$usuario,$total,$total,0,'V');
		logs_db("Se agrego el documento: ". $numero_documento." de tipo: ". $id_tipo_documento  , $_SERVER['PHP_SELF']);
		foreach ($productsArr as list($a, $b,$c,$d,$e)) {
			$nombre=devuelve_campo("productos","nombre","id",$a);
			$descripcion=devuelve_campo("productos","descripcion","id",$a);
			$id_marca=devuelve_campo("productos","id_marca","id",$a);
			$marca=devuelve_campo("marcas","descripcion","id",$id_marca);
			CreaKardex($numero_documento,$id_tipo_documento,$nombre,$descripcion,$id_marca, $marca,$c,$d,$e,0);
			logs_db("Se agrego el Kardex para el producto: ". $b." con datos: ". $c .",".$d , $_SERVER['PHP_SELF']);
			}			
		if (!isset($numero_documento)) {
			
			$data['error'] = "Could not query database for search results, MYSQL ERROR: " ;
		} else {
			
			   $data['results'][] = array(
				        
					'documento' => $numero_documento,
				);	
			  $data['success'] = true;
		}		
	}
	
header('Access-Control-Allow-Origin: *'); 
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header("Content-Type: application/json; charset=UTF-8");
header("Expires: 0");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
	
	echo json_encode((object)$data);
	

?>
