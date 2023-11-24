<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Horario</title>
    <style>
        body {
            background-color: #F5F5F5;
            font-family: Arial, sans-serif;
            text-align: center;
        }
        h1 {
            color: #333;
        }
        form {
            max-width: 300px;
            margin: 0 auto;
            background-color: #FFF;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
        }
        label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }
        input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #DDD;
            border-radius: 4px;
        }
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 4px;
            background-color: #FFB600;
            color: #FFF;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #FF9F00;
        }
        b {
            display: block;
            margin-top: 20px;
            color: #333;
        }
        a {
            text-decoration: none;
            color: #333;
        }
        a:hover {
            text-decoration: underline;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #DDD;
        }
        th, td {
            padding: 10px;
        }
        th {
            background-color: #FFB600;
            color: #FFF;
        }
    </style>
</head>
<body>
    <h1>Editar Horario</h1>
    <form action="edit_h.php" method="post">
        <label>IDH:</label>
        <input type="number" name="IDH" required>
        <input type="submit" name="eliminar" value="Eliminar">
    </form>
    <b><a href="m_p.php">Volver al inicio</a></b>

    <?php
    include('dbconnect.php');

    function bloqueAHora($bloque) {
        $horaInicio = 8 * 60; // 8:00 AM en minutos
        $intervalo = 30; // 30 minutos por bloque

        $inicioBloque = $horaInicio + ($bloque - 1) * $intervalo;
        $finBloque = $inicioBloque + $intervalo;

        return sprintf("%02d:%02d-%02d:%02d", 
                       intdiv($inicioBloque, 60), $inicioBloque % 60,
                       intdiv($finBloque, 60), $finBloque % 60);
    }

    if (isset($_POST['eliminar'])) {
        $idh = $_POST['IDH'];

        $query_delete = "DELETE FROM horario WHERE idh = $idh";
        $result_delete = mysqli_query($DBConnect, $query_delete);

        if ($result_delete) {
            echo "<br>Registro eliminado correctamente.<br>";
        } else {
            echo "<br>No se pudo eliminar el registro. Error: " . mysqli_error($DBConnect) . "<br>";
        }
    }

    // Modificación de la consulta para incluir el nombre y servicio del personal
    $query_select = "SELECT Horario.idh, Horario.fecha, Horario.bloque, Personal.nombre AS nombre_personal, Personal.servicio AS servicio_personal, Ficha.nombre AS nombre_mascota
                     FROM Horario
                     LEFT JOIN Personal ON Horario.personal = Personal.idp
                     LEFT JOIN Ficha ON Horario.mascota = Ficha.idf";
    $result_select = mysqli_query($DBConnect, $query_select);

    if ($result_select) {
        echo "<h2>Registros Disponibles:</h2>";
        echo "<table>
                <tr>
                    <th>IDH</th>
                    <th>Fecha</th>
                    <th>Hora (Bloque)</th>
                    <th>Personal (Nombre y Servicio)</th>
                    <th>Mascota</th>
                </tr>";

        while ($row = mysqli_fetch_assoc($result_select)) {
            $horaBloque = bloqueAHora($row['bloque']);
            echo "<tr>
                    <td>{$row['idh']}</td>
                    <td>{$row['fecha']}</td>
                    <td>$horaBloque</td>
                    <td>{$row['nombre_personal']} - {$row['servicio_personal']}</td>
                    <td>{$row['nombre_mascota']}</td>
                </tr>";
        }

        echo "</table>";
        
    } else {
        echo "<br>No se pudieron recuperar los registros disponibles. Error: " . mysqli_error($DBConnect);
    }
    
    mysqli_close($DBConnect);
    ?>
</body>
</html>
