<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservar Hora - Clinica Veterinaria Happy Feet</title>
    <style>
            body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }
        h1, h2 {
            text-align: center;
            color: #333;
        }
        form {
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        label {
            margin: 10px 0 5px;
            display: block;
            color: #666;
        }
        input[type="text"],
        input[type="date"],
        input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 4px;
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
        }
        th, td {
            text-align: left;
            padding: 8px;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        a {
            color: #333;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }

    </style>
</head>
<body>
    <h1>Clinica Veterinaria Happy Feet</h1>
    <form action="r_h.php" method="post">
        <p>Ingrese los datos para actualizar un horario:</p>
        <label for="ID_Horario">ID Horario:</label>
        <input type="number" id="ID_Horario" name="ID_Horario" required><br>
        <label for="ID_Mascota">ID Mascota:</label>
        <input type="number" id="ID_Mascota" name="ID_Mascota" required><br>
        <input type="submit" name="actualizar" value="Actualizar Horario">
    </form>
    <p><b>Volver</b> <a href="m_c.php">inicio</a></p>

    <?php
include 'dbconnect.php'; // Asegúrate de que el path de conexión a la base de datos sea correcto
function bloqueAHora($bloque) {
    $horaInicio = 8 * 60; // 8:00 AM en minutos
    $intervalo = 30; // 30 minutos por bloque

    $inicioBloque = $horaInicio + ($bloque - 1) * $intervalo;
    $finBloque = $inicioBloque + $intervalo;

    return sprintf("%02d:%02d-%02d:%02d", 
                   intdiv($inicioBloque, 60), $inicioBloque % 60,
                   intdiv($finBloque, 60), $finBloque % 60);
}


function mostrarMensaje($mensaje) {
    echo "<script>alert('$mensaje'); window.location.href='r_h.php';</script>";
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['actualizar'])) {
    $id_horario = mysqli_real_escape_string($DBConnect, $_POST['ID_Horario']);
    $id_mascota = mysqli_real_escape_string($DBConnect, $_POST['ID_Mascota']);

    // Verificar si el ID de la mascota existe en la tabla 'ficha'
    $query_verificar_mascota = "SELECT * FROM ficha WHERE idf = '$id_mascota'";
    $resultado_verificar_mascota = mysqli_query($DBConnect, $query_verificar_mascota);

    if(mysqli_num_rows($resultado_verificar_mascota) > 0) {
        // Actualizar el horario con el ID de la mascota
        $query_actualizar = "UPDATE horario SET mascota = '$id_mascota' WHERE idh = '$id_horario'";
        $resultado_actualizar = mysqli_query($DBConnect, $query_actualizar);

        if ($resultado_actualizar) {
            mostrarMensaje("Horario actualizado correctamente.");
        } else {
            mostrarMensaje("Error al actualizar el horario: " . mysqli_error($DBConnect));
        }
    } else {
        mostrarMensaje("El ID de la mascota ingresado no existe. Verifique e intente nuevamente.");
    }
}

// Código para mostrar la tabla de horarios...
// Mostrar horarios disponibles
echo "<h2>Horarios Disponibles:</h2>";
echo "<table>";
echo "<tr>
        <th>ID Horario</th>
        <th>Fecha</th>
        <th>Hora (Bloque)</th>
        <th>Personal (Nombre y Servicio)</th>
        <th>ID Mascota</th>
        <th>Nombre del Cliente</th>
    </tr>";

$query_horarios = "SELECT horario.idh, horario.fecha, horario.bloque, 
                          personal.nombre AS nombre_personal, personal.servicio AS servicio_personal, 
                          ficha.nombre AS nombre_mascota, 
                          cliente.nombre AS nombre_cliente
                   FROM horario
                   LEFT JOIN personal ON horario.personal = personal.idp
                   LEFT JOIN ficha ON horario.mascota = ficha.idf
                   LEFT JOIN cliente ON ficha.idc = cliente.idc";
$resultado_horarios = mysqli_query($DBConnect, $query_horarios);

while ($fila = mysqli_fetch_assoc($resultado_horarios)) {
    $horaBloque = bloqueAHora($fila['bloque']);
    $infoPersonal = $fila['nombre_personal'] ? "{$fila['nombre_personal']} ({$fila['servicio_personal']})" : "N/A";
    $infoMascota = $fila['nombre_mascota'] ?: "N/A";
    $nombreCliente = $fila['nombre_cliente'] ?: "N/A";
    echo "<tr>
            <td>{$fila['idh']}</td>
            <td>{$fila['fecha']}</td>
            <td>$horaBloque</td>
            <td>$infoPersonal</td>
            <td>$infoMascota</td>
            <td>$nombreCliente</td>
          </tr>";
}

echo "</table>";

// ...


// Cierra la conexión a la base de datos
mysqli_close($DBConnect);
?>



</body>
</html>
