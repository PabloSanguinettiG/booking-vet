<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clinica Veterinaria Happy Feet - VetDB Main Page</title>
    <style>
            body {
                background-color: #E2FAB5; /* Color verde suave de la paleta */
                font-family: 'Arial', sans-serif;
                color: #000000; /* Texto en negro para mejor contraste */
                margin: 0;
                padding: 0;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
            }

            .container {
                width: 100%;
                max-width: 400px;
                padding: 30px;
                background-color: #FFF9C2; /* Color amarillo pálido de la paleta */
                border-radius: 15px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                text-align: center;
            }

            h1 {
                color: #99EE99; /* Cambiando a un verde más oscuro para el título */
                margin-bottom: 20px;
                font-size: 2.5em; /* Aumenta el tamaño de la fuente */
                font-weight: bold; /* Hace que la fuente sea más gruesa */
                text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.25); /* Sombra para destacar */
            }

            p {
                color: #000000; /* Texto en negro para mantener la coherencia */
                margin-bottom: 30px;
            }

            ul {
                list-style: none;
                padding: 0;
            }

            li {
                margin-bottom: 15px;
            }

            a {
                display: block;
                padding: 10px;
                text-decoration: none;
                background-color: #C7F6B6; /* Color verde pálido de la paleta para los botones */
                color: #000000; /* Texto en negro para mejor contraste */
                border-radius: 4px;
                transition: background-color 0.3s;
            }

            a:hover {
                background-color: #9EE99; /* Color verde claro para el efecto hover */
            }

    </style>
</head>
<body>
    <div class="container">
        <h1>Clinica Veterinaria Happy Feet</h1>
        <p>Selecciona una opción:</p>

        <ul>
            <li><a href="r_c.php">Registrar Cliente</a></li>
            <li><a href="r_p.php">Registrar Personal</a></li>
        </ul>
    </div>
</body>
</html>
