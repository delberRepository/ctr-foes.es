<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "BaseUniversidad";

$conn = new mysqli($servername, $username, $password, $dbname);

<?php
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Datos del formulario
$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$telefono = $_POST['telefono'];
$edad = $_POST['edad'];
$numero_matricula = $_POST['numero_matricula'];
$numero_habitacion = $_POST['numero_habitacion'];
$nombre_curso = $_POST['nombre_curso'];

// Generar clave
$clave = bin2hex(random_bytes(2)); // Genera una clave de 16 caracteres

// Insertar datos en la tabla residentes
$sql_residentes = "INSERT INTO residentes (nombre, correo, telefono, numero_habitacion, edad) 
VALUES ('$nombre', '$correo', '$telefono', '$numero_habitacion', '$edad')";

if ($conn->query($sql_residentes) === TRUE) {
    // Insertar datos en la tabla estudiantes
    $sql_estudiantes = "INSERT INTO estudiantes (numero_matricula, nombre_curso, clave) 
    VALUES ('$numero_matricula', '$nombre_curso', '$clave')";

    if ($conn->query($sql_estudiantes) === TRUE) {
        // Enviar correo electrónico al estudiante
        $to = $correo;
        $subject = "Clave de acceso al campus virtual";
        $message = "Hola $nombre,\n\nTu clave de acceso al campus virtual es: $clave.
        \npara acceder introduce tu matricula: $numero_matricula y tu clave\n\nSaludos,\nEquipo de CTR-FOES";
        $headers = "From: admin@residenciauniversidad.com";

        mail($to, $subject, $message, $headers);

        echo "Matriculación completada. La clave de acceso del alumno ha sido enviada por correo electrónico.";
    } else {
        echo "Error: " . $sql_estudiantes . "<br>" . $conn->error;
    }
} else {
    echo "Error: " . $sql_residentes . "<br>" . $conn->error;
}

$conn->close();
?>
