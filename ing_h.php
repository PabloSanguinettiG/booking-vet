<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Ingresar Horarios</title>
    <style>
        body {
            background-color: #F5F5F5;
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 0;
            padding: 0;
        }
        h1, p {
            color: #FF6B6B;
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
        input[type="date"],
        input[type="number"],
        input[type="text"],
        button {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #DDD;
            border-radius: 4px;
            font-size: 16px;
        }
        button {
            background-color: #FF6B6B;
            color: white;
            cursor: pointer;
        }
        button:hover {
            background-color: #FF4D4D;
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
            background-color: #FF6B6B;
            color: white;
        }
    </style>
</head>
<body>
    <h1>Ingresar Horarios</h1>
    <form action="ing_h.php" method="post">
        <label for="Fecha">Fecha:</label>
        <input type="date" id="Fecha" name="Fecha" required>
        <label for="Bloque">Bloque:</label>
        <input type="number" id="Bloque" name="Bloque" required>
        <label for="ID_Personal">ID_Personal:</label>
        <input type="number" id="ID_Personal" name="ID_Personal" required>
        <button type="reset" value="Reset">Reset</button>
        <button type="submit" name="enviar">Enviar</button>
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

    if (isset($_POST['enviar'])) {
        $Fecha = $_POST['Fecha'];
        $Bloque = $_POST['Bloque'];
        $ID_Personal = $_POST['ID_Personal'];

        // Insertar datos en la tabla Horario
        $query = "INSERT INTO Horario (fecha, bloque, personal, mascota) VALUES ('$Fecha', '$Bloque', '$ID_Personal', NULL);";
        $result = mysqli_query($DBConnect, $query);

        if ($result) {
            echo "<p>Los horarios se insertaron correctamente.</p>";
        } else {
            echo "<p>Hubo un problema al insertar los horarios en la base de datos. Por favor, inténtelo de nuevo.</p>";
        }
    }

    $query_select = "SELECT Horario.idh, Horario.fecha, Horario.bloque, Personal.nombre AS nombre_personal, Personal.servicio AS servicio_personal
        FROM Horario
        LEFT JOIN Personal ON Horario.personal = Personal.idp";
    $result_select = mysqli_query($DBConnect, $query_select);

    if ($result_select) {
    echo "<h2>Horarios Existentes:</h2>";
    echo "<table>
    <tr>
    <th>IDH</th>
    <th>Fecha</th>
    <th>Hora (Bloque)</th>
    <th>Personal (Nombre y Servicio)</th>
    </tr>";

    while ($row = mysqli_fetch_assoc($result_select)) {
    $horaBloque = bloqueAHora($row['bloque']);
    echo "<tr>
    <td>{$row['idh']}</td>
    <td>{$row['fecha']}</td>
    <td>$horaBloque</td>
    <td>{$row['nombre_personal']} - {$row['servicio_personal']}</td>
    </tr>";
    }

    echo "</table>";
    } else {
        echo "<p>No se pudieron recuperar los horarios existentes. Error: " . mysqli_error($DBConnect) . "</p>";
    }

    mysqli_close($DBConnect);
    ?>
</body>
</html>
