<?php session_start();include_once("Security.php"); include("conx.php");include("funciones.php");

$link=conectarse();$username=htmlspecialchars($_POST['username'],ENT_QUOTES);$pass=$_POST['password'];
logs_db("Intento de login, usuario: ".$username, $_SERVER['PHP_SELF']);
$sql="SELECT `id`, `nombre`, `usr`, `pwd`, `id_rol`, `estado` FROM usuarios WHERE `usr` LIKE '".$username."' and estado='V';";
$result= mysqli_query($link, $sql);$row = mysqli_fetch_array($result,MYSQLI_ASSOC); 
if(mysqli_num_rows($result)>0){
	if(strcmp($row['pwd'],Security::encrypt($pass))==0)
	{echo "yes";
	$_SESSION['sml2020_svenerossys_usuario_registrado']=$username;
	$idusr=devuelve_campo("usuarios","id","usr",$username); 
	$_SESSION['sml2020_svenerossys_id_usuario_registrado']=$idusr;
	$email=devuelve_campo("usuarios","email","usr",$username); 
	$_SESSION['sml2020_svenerossys_email_usuario_registrado']=$email;
	$nombre=devuelve_campo("usuarios","nombre","usr",$username);
	$_SESSION['sml2020_svenerossys_nombre_usuario_registrado']=$nombre;
	$idrol=devuelve_campo("usuarios","id_rol","usr",$username);
	$_SESSION['sml2020_svenerossys_id_rol_usuario_registrado']=$idrol;
	$rol=devuelve_campo("roles","rol","id",$idrol);
	$_SESSION['sml2020_svenerossys_rol_usuario_registrado']=$rol;
	$_SESSION['sml2020_svenerossys_CREATED'] = time();
	logs_db("Usuario: ".$username." | INGRESO AL SISTEMA", $_SERVER['PHP_SELF']);} 
	else{echo "wp";logs("Password incorrecto...", $_SERVER['PHP_SELF']);echo Security::encrypt($pass);} }else {echo "no";logs_db("Usuario no identificado", $_SERVER['PHP_SELF']); }?>