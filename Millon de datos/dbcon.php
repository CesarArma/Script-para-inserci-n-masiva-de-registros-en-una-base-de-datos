<?php
$conn = new mysqli('localhost','root','','mi_base_de_datos');
if ($conn->connect_error) {
    die('Error : ('. $conn->connect_errno .') '. $conn->connect_error);
}
?>