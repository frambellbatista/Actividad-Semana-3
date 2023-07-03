<?php
// Configuración de la conexión a la base de datos
//$servername = "mariadb-1"; // nombre del contenedor de MariaDB en Docker
//$username = "root";
//$password = "2162377";
//$dbname = "frambel";

// Crear la conexión
// $conn = new mysqli($servername, $username, $password, $dbname);
// http://localhost:52271/
$host = 'localhost';  // If using Docker, you can also use the IP of the container
$port = 52271;
$database = 'frambel';
$username = 'root';
$password = '2162377';

$dsn = "mariadb:host=$host;port=$port;dbname=$database";
$conn = new PDO($dsn, $username, $password);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error al conectar a la base de datos: " . $conn->connect_error);
}


$tableName = 'frambel_2162377';
$id = 1;
$nombre = 'Frambel';
$matricula = '2162377';

$sql = "INSERT INTO $tableName (id, nombre, matricula) VALUES (:id, :nombre, :matricula)";
$statement = $conn->prepare($sql);
$statement->bindParam(':id', $id, PDO::PARAM_INT);
$statement->bindParam(':nombre', $nombre, PDO::PARAM_STR);
$statement->bindParam(':matricula', $matricula, PDO::PARAM_STR);

$statement->execute();

if ($statement->rowCount() > 0) {
    echo "Data inserted successfully.";
} else {
    echo "Failed to insert data.";
}

// Consulta SQL para obtener los datos de la tabla nachely_2190705
$sql = "SELECT * FROM frambel_2162377";
$result = $conn->query($sql);

// Obtener los datos de la tabla como un arreglo asociativo
$data = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

// Convertir los datos a formato JSON y enviar la respuesta
header('Content-Type: application/json');
echo json_encode($data);

// Cerrar la conexión a la base de datos
$conn->close(); 
