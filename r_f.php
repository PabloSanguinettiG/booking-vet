<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Ficha - Clínica Veterinaria Happy Feet</title>
    <style>
        body {
            background-color: #E6F5E0; /* Fondo color verdoso claro */
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 0;
            padding: 0;
        }
        h1, p {
            color: #4CAF50; /* Color de título y texto verdoso */
        }
        label {
            color: #333; /* Color de etiqueta gris oscuro */
            display: block;
            margin-top: 10px;
        }
        input[type="text"],
        input[type="date"],
        input[type="number"] {
            display: block;
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #D6D6D6; /* Borde gris claro */
            border-radius: 4px;
            font-size: 16px;
        }
        button {
            display: inline-block;
            padding: 10px 20px;
            margin: 10px 5px;
            background-color: #4CAF50; /* Color de botón verdoso */
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        button[type="reset"] {
            background-color: #333; /* Color de botón Reset gris oscuro */
        }
        button:hover {
            background-color: #45A049; /* Color de botón al pasar el mouse */
        }
        b, a {
            display: block;
            text-align: center;
            color: #333; /* Color de texto gris oscuro */
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
        <h1>Clínica Veterinaria Happy Feet</h1>
        <form name="fichaForm" action="r_f.php" method="post" onsubmit="return validarFormulario()">
            <p>Registre su ficha</p>
            <label>Numero de ficha:</label>
            <input type="text" name="NumeroFicha" maxlength="5">
            <label>Raza:</label>
            <input type="text" name="Raza" maxlength="25">
            <label>Fecha de consulta:</label>
            <input type="date" name="FechaConsulta">
            <label>Tipo de consulta:</label>
            <input type="text" name="TipoConsulta" maxlength="30">
            <label>Detalles:</label>
            <input type="text" name="Detalles" maxlength="255">
            <label>ID Cliente (con el que te registraste):</label>
            <input type="number" name="rut">
            <label>Nombre:</label>
            <input type="text" name="Nombre" maxlength="255">
            <button type="reset">Reset</button>
            <button type="submit" name="enviar">Enviar</button>
        </form>
        <b><a href="r_h.php">¿Ya tenía registro? ¡Pida una hora!</a></b>
        <b><a href="m_c.php">Volver al Menú Cliente</a></b>
    </div>
</body>
</html>

<?php
include('dbconnect.php');

if (isset($_POST['enviar'])) {
    $NumeroFicha = mysqli_real_escape_string($DBConnect, $_POST['NumeroFicha']);
    $Raza = mysqli_real_escape_string($DBConnect, $_POST['Raza']);
    $FechaConsulta = mysqli_real_escape_string($DBConnect, $_POST['FechaConsulta']);
    $TipoConsulta = mysqli_real_escape_string($DBConnect, $_POST['TipoConsulta']);
    $Detalles = mysqli_real_escape_string($DBConnect, $_POST['Detalles']);
    $idc = mysqli_real_escape_string($DBConnect, $_POST['rut']);
    $Nombre = mysqli_real_escape_string($DBConnect, $_POST['Nombre']);

    $errors = array();

    if (empty($NumeroFicha)) {
        $errors[] = "Rellenar Numero de Ficha.";
    }

    if (empty($Raza)) {
        $errors[] = "Rellenar Raza.";
    }

    if (empty($FechaConsulta)) {
        $errors[] = "Rellenar Fecha de Consulta.";
    }

    if (empty($TipoConsulta)) {
        $errors[] = "Rellenar Tipo de Consulta.";
    }

    if (empty($Detalles)) {
        $errors[] = "Rellenar Detalles.";
    }

    if (empty($idc)) {
        $errors[] = "Rellenar ID del cliente.";
    }

    if (empty($Nombre)) {
        $errors[] = "Rellenar Nombre.";
    }

    if (count($errors) == 0) {
        $query = "INSERT INTO ficha (ficha, raza, fecha, servicio, detalle, idc, nombre) VALUES ('$NumeroFicha', '$Raza', '$FechaConsulta', '$TipoConsulta', '$Detalles', '$idc', '$Nombre');";
        $result = mysqli_query($DBConnect, $query) or die("No se pudo realizar la consulta a la tabla." . " Código de error " . mysqli_errno($DBConnect) . ": " . mysqli_error($DBConnect));

        if (mysqli_affected_rows($DBConnect) == 1) {
            echo "¡Gracias! La ficha se registró correctamente.";
        } else {
            echo "Hubo un problema al registrar la ficha en la base de datos. Por favor, inténtelo de nuevo.";
        }

        mysqli_close($DBConnect);
    } else {
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
    }
}
?>
</html>
