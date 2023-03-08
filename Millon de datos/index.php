<?php
$inicio=microtime(true);

// Datos de conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mi_base_de_datos";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Definir arreglos con nombres y apellidos
$nombres = array("María", "Juan", "Carlos", "Ana", "Pedro", "Lucía");
$apellidos = array("García", "Pérez", "López", "González", "Rodríguez", "Martínez");

// Generar 1 millón de registros
for ($i = 1; $i <= 1000; $i++) {
    // Generar datos aleatorios
    $nombre = $nombres[rand(0, count($nombres)-1)] . " " . $apellidos[rand(0, count($apellidos)-1)];
    $edad = rand(18, 70);
    $correo = strtolower(str_replace(" ", ".", $nombre)) . "@ejemplo.com";
    $telefono = rand(1000000000, 9999999999);

    // Insertar registro en la tabla "usuarios"
    $sql = "INSERT INTO usuarios (nombre, edad, correo, telefono)
    VALUES ('$nombre', '$edad', '$correo', '$telefono')";

    if ($conn->query($sql) === TRUE) {
        //echo "Registro insertado correctamente";
    } else {
        echo "Error al insertar registro: " . $conn->error;
    }
}

$final=microtime(true);
echo $final-$inicio;
// Cerrar conexión
$conn->close();

?>
