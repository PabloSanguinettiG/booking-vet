<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú de Admins - Clínica Veterinaria Happy Feet</title>
    <style>
        body {
            background-color: #E5F4E3; /* Fondo crema */
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 0;
            padding: 0;
        }
        h1 {
            color: #4E9A57; /* Verde oscuro */
            margin-bottom: 20px;
        }
        p {
            color: #4E9A57; /* Verde oscuro */
        }
        button {
            display: inline-block;
            padding: 10px 20px;
            margin: 10px 5px;
            background-color: #4E9A57; /* Verde oscuro */
            color: #FFF; /* Texto blanco */
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #3B7A43; /* Verde más oscuro en hover */
        }
        b {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #4E9A57; /* Verde oscuro */
        }
        a {
            display: block;
            text-align: center;
            color: #5C5C5C;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h1>Menú de Admins - Clínica Veterinaria Happy Feet</h1>
    <p>Selecciona una opción:</p>
    <button onclick="window.location.href='ing_h.php'">Ingresar Horarios de la Semana</button>
    <button onclick="window.location.href='edit_h.php'">Editar Horarios</button>
    <b><a href="index.php">Volver al Inicio</a></b>
</body>
</html>
