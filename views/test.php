<?php 
include_once("../controllers/Security.php");
echo (Security::encrypt("adminAdmin123!"));
?>