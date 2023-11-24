<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Usuario Admin - Clínica Veterinaria Happy Feet</title>
    <style>
        body {
            background-color: #F4EAEA;
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 0;
            padding: 0;
        }
        h1, p {
            color: #88C425;
            margin-bottom: 20px;
        }
        label {
            color: #5C5C5C;
            display: block;
            margin-top: 10px;
        }
        input[type="text"] {
            display: block;
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #CCC;
            border-radius: 4px;
            font-size: 16px;
        }
        button {
            display: inline-block;
            padding: 10px 20px;
            margin: 10px 5px;
            background-color: #88C425;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        button[type="reset"] {
            background-color: #5C5C5C;
        }
        button:hover {
            background-color: #68AB00;
        }
        b, a {
            display: block;
            text-align: center;
            color: #5C5C5C;
            text-decoration: none;
            margin-top: 20px;
        }
        a:hover {
            text-decoration: underline;
        }
        .container {
            max-width: 400px;
            margin: 0 auto;
            background-color: #FFF;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Registrar Usuario Admin - Clínica Veterinaria Happy Feet</h1>
        <form action="r_p.php" method="post">
            <p>Rellena información del usuario admin para la tabla Personal para que se te asigne un ID único</p>
            
            <label>Rut:</label>
            <input type="text" name="rut" maxlength="9">
            
            <label>Nombre completo:</label>
            <input type="text" name="nombre" maxlength="255">
            
            <label>Teléfono (9 dígitos):</label>
            <input type="text" name="telefono" maxlength="9">

            <label>Correo electrónico:</label>
            <input type="text" name="correo" maxlength="255">

            <label>Servicio que entregas:</label>
            <input type="text" name="servicio" maxlength="255">
            
            <button type="reset" value="Reset">Reset</button>
            <button type="submit" name="enviar">Enviar</button>
        </form>
        <b>¿Ya estás registrado? <a href="m_p.php">Ve al menú de admin</a></b>
        <b><a href="index.php">Volver al inicio</a></b>
    </div>
</body>
</html>

<?php
// Conectar a la base de datos
include('dbconnect.php');

if (isset($_POST['enviar'])) {
    // Obtener los valores ingresados por el usuario
    $rut = $_POST['rut'];
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $servicio = $_POST['servicio'];

    $count = 0;

    if (empty($rut)) {
        echo "Por favor, complete su rut.<br>";
    } else {
        $nombre = $_POST['rut'];
        ++$count;
    }

    // Validar correo
    if (empty($correo)) {
        echo "Por favor, complete su correo.<br>";
    } else {
        $correo = $_POST['Correo'];
        ++$count;
    }

    
    if (empty($telefono)) {
        echo "Por favor, complete su teléfono.<br>";
    } else {
        $telefono = $_POST['Telefono'];
        ++$count;
    }

    
    if (empty($rut)) {
        echo "Por favor, complete su Rut.<br>";
    } else {
        $rut = $_POST['rut'];
        ++$count;
    }

    
    if (empty($servicio)) {
        echo "Por favor, complete el servicio que entregas.<br>";
    } else {
        $servicio = $_POST['servicio'];
        ++$count;
    }

    // Escribir en la tabla Personal
    if ($count == 5) {
        $query = "INSERT INTO personal (rut, nombre, telefono, correo, servicio) VALUES ('$rut','$nombre','$telefono','$correo','$servicio');";
        $result = @mysqli_query($DBConnect, $query) or die ("<p>No se pudo realizar la consulta.</p><p>Código de error " . mysqli_errno($DBConnect) . ": " . mysqli_error($DBConnect) . "</p>");

        if (mysqli_affected_rows($DBConnect) == 1) {
            echo "¡Gracias! Tu registro se envió correctamente";
        } else {
            echo "Hubo un problema con tu registro. Por favor, inténtalo de nuevo.";
        }

        mysqli_close($DBConnect);
    }
}
?>
</html>
