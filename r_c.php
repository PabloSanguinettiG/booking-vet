<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Cliente - Clínica Veterinaria Happy Feet</title>
    <style>
        body {
            background-color: #E5F4E3; /* Fondo crema */
            font-family: Arial, sans-serif;
            color: #4E9A57; /* Color de texto verde oscuro para contraste */
            margin: 0;
            padding: 0;
        }
        h1 {
            text-align: center; /* Centro el título */
            color: #3B7A43; /* Color de título verde */
        }
        p {
            text-align: center; /* Centro el párrafo */
            color: #4E9A57; /* Color del texto verde oscuro */
        }
        .form-container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #F2F4E6; /* Color de fondo crema más claro */
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin-bottom: 5px;
            color: #4E9A57; /* Color de etiqueta verde oscuro */
        }
        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #CCC;
            border-radius: 4px;
            font-size: 16px;
        }
        button[type="reset"],
        button[type="submit"] {
            width: 49%;
            padding: 10px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }
        button[type="reset"] {
            background-color: #FDDF90; /* Color de botón Reset amarillo */
            color: #4E9A57;
            margin-right: 2%;
        }
        button[type="reset"]:hover {
            background-color: #FFA07A; /* Color de botón Reset al pasar el mouse */
        }
        button[type="submit"] {
            background-color: #3B7A43; /* Color de botón Enviar verde */
            color: white;
        }
        b {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #3B7A43; /* Color de texto verde */
        }
        a {
            display: block;
            text-align: center;
            color: #4E9A57; /* Color de texto verde oscuro */
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline; /* Subraya el enlace al pasar el mouse */
            color: #3B7A43; /* Cambia el color del texto al pasar el mouse */
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Clinica Veterinaria Happy Feet</h1>
        <p>Registrar Cliente</p>
        <form action="r_c.php" method="post">
            <label for="Rut">Rut:</label>
            <input type="text" name="Rut" id="Rut" maxlength="9" required>

            <label for="Nombre">Nombre:</label>
            <input type="text" name="Nombre" id="Nombre" required>

            <label for="Correo">Correo:</label>
            <input type="text" name="Correo" id="Correo" required>

            <label for="Telefono">Teléfono:</label>
            <input type="text" name="Telefono" id="Telefono" maxlength="9" required>

            <button type="reset">Reset</button>
            <button type="submit" name="enviar">Enviar</button>
        </form>
        <div class="footer-links">
            <a href="index.php">Volver al Inicio</a>
            <a href="m_c.php">¿Ya estás registrado? Ir al Menú Cliente</a>
        </div>
    </div>
</body>
</html>

<?php
// Conexión a la base de datos
include("dbconnect.php"); // Asegúrate de que el archivo dbconnect.php contenga la configuración de conexión adecuada

if (isset($_POST['enviar'])) {
    $Rut = $_POST['Rut'];
    $Nombre = $_POST['Nombre'];
    $Correo = $_POST['Correo'];
    $Telefono = $_POST['Telefono'];

    // Validar los datos aquí si es necesario

    // Insertar datos en la tabla Cliente
    $query = "INSERT INTO cliente (rut, nombre, correo, telefono) VALUES ('$Rut', '$Nombre', '$Correo', '$Telefono');";
    $result = mysqli_query($DBConnect, $query);

    if ($result) {
        echo "El cliente se registró correctamente.";
    } else {
        echo "Hubo un problema al registrar al cliente en la base de datos. Por favor, inténtelo de nuevo.";
    }
}

// Cerrar la conexión a la base de datos
mysqli_close($DBConnect);
?>

</body>
</html>
