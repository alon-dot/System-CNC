<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap" rel="stylesheet">
    <title>Bienvenida M-RAM CNC</title>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: white; /* Amarillo claro */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            overflow: hidden;
            color: #333;
        }

        .welcome-container {
            position: relative;
            width: 90%;
            max-width: 800px;
            padding: 40px;
            background: #ffffff; /* Fondo blanco para el recuadro */
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            text-align: center;
            overflow: hidden;
            z-index: 1;
            animation: fadeIn 1.5s ease;
        }

        .circle {
            position: absolute;
            border-radius: 50%;
            background-color: #FFC107;
            opacity: 0.3;
            animation: pulse 6s infinite alternate;
        }

        .circle.large {
            width: 250px;
            height: 250px;
            top: -50px;
            right: -50px;
        }

        .circle.medium {
            width: 250px;
            height: 250px;
            bottom: -50px;
            left: -30px;
        }

        .circle.small {
            width: 120px;
            height: 120px;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            animation-delay: 2s;
        }

        .logo {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
            margin: 0 auto;
        }

        .logo img {
            width: 100%;
            height: 100%;
        }

        h2 {
            margin-top: 15px;
            font-size: 2rem;
            color: #333;
            animation: fadeInDown 1s ease-out;
        }

        .welcome-message {
            margin-top: 10px;
            font-size: 1.1rem;
            color: #555;
            line-height: 1.6;
            animation: fadeInUp 1s ease-out 0.5s;
        }

        .developer-list {
            margin-top: 15px;
            font-size: 0.9rem;
            color: #777;
            line-height: 1.5;
            animation: fadeInUp 1s ease-out 0.8s;
        }

        .button-row {
            margin-top: 20px;
            display: flex;
            justify-content: center;
            gap: 20px;
            animation: fadeInUp 1s ease-out 1s;
        }

        .button-row a {
            text-decoration: none;
            padding: 12px 25px;
            color: #fff;
            background-color: #FFC107;
            border-radius: 30px;
            font-weight: bold;
            font-size: 1rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.8);
            transition: all 0.3s ease;
        }

        .button-row a:hover {
            background-color: #fff;
            color: #FFC107;
            transform: translateY(-3px);
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes fadeInUp {
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
        }

        @keyframes fadeInDown {
            0% { opacity: 0; transform: translateY(-20px); }
            100% { opacity: 1; transform: translateY(0); }
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            100% { transform: scale(1.2); }
        }

        /* Líneas decorativas animadas */
        .line-decorations {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            overflow: hidden;
        }

        .line {
            position: absolute;
            height: 3px;
            background: linear-gradient(90deg, #FFC107, #333);
            animation: lineMove 6s linear infinite;
        }

        .line:nth-child(1) {
            width: 100%;
            top: 10%;
            animation-duration: 6s;
        }

        .line:nth-child(2) {
            width: 80%;
            top: 30%;
            left: -100%;
            animation-duration: 5s;
        }

        .line:nth-child(3) {
            width: 60%;
            top: 50%;
            animation-duration: 4s;
        }

        .line:nth-child(4) {
            width: 70%;
            top: 70%;
            left: -50%;
            animation-duration: 7s;
        }

        @keyframes lineMove {
            0% { transform: translateX(0); }
            100% { transform: translateX(100%); }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .line {
                height: 2px;
            }

            .line:nth-child(1) {
                top: 15%;
                width: 100%;
            }

            .line:nth-child(2) {
                top: 35%;
                width: 90%;
                left: -100%;
                animation-duration: 5s;
            }

            .line:nth-child(3) {
                top: 55%;
                width: 80%;
                animation-duration: 4s;
            }

            .line:nth-child(4) {
                top: 75%;
                width: 85%;
                left: -50%;
                animation-duration: 7s;
            }

            /* Botón Admin y ajustes responsivos */
            .button-admin {
                position: absolute;
                top: -50px; /* Colocar arriba del círculo */
                left: 50%;
                transform: translateX(-50%);
                z-index: 2; /* Asegurarse de que esté por encima de otros elementos */
            }

            .button-row {
                display: flex;
                justify-content: center;
                gap: 20px;
                position: relative;
                margin-top: 70px;
            }

            .button-row a {
                font-size: 0.9rem;
                padding: 10px 20px;
            }
        }

        /* Ajustes para móviles */
        @media (max-width: 480px) {
            h2 {
                font-size: 1.6rem;
            }

            .welcome-message, .developer-list {
                font-size: 1rem;
                padding: 0 10px;
            }

            .button-row a {
                font-size: 0.9rem;
                padding: 10px 20px;
            }

            /* Líneas para móviles */
            .line:nth-child(1) {
                top: 10%;
                width: 100%;
            }

            .line:nth-child(2) {
                top: 25%;
                width: 80%;
                left: -100%;
            }

            .line:nth-child(3) {
                top: 40%;
                width: 60%;
            }

            .line:nth-child(4) {
                top: 60%;
                width: 70%;
                left: -50%;
            }
        }
        
    </style>
</head>
<body>

    <div class="welcome-container">
        <div class="circle large"></div>
        <div class="circle medium"></div>
        
        <div class="logo">
            <a href="https://ibb.co/QXW6YCJ">
                <img src="https://i.ibb.co/M9zRPGg/logo.jpg" alt="logotipo-M-RAM CNC-012024">
            </a>
        </div>
        <h2>Bienvenido a M-RAM CNC</h2>
        <div class="welcome-message">
            Calculadora de acabado y desbaste en centrado de maquinado vertical.
        </div>
        <div class="developer-list">
            Desarrolladores:<br><br>
            Eldin Mauricio Ramírez Márquez<br>
            Danna Paola Lemus Sánchez<br>
            Alondra Olivares Luna<br>
            Alexis Baez López
        </div>
        
        <div class="button-row">
            <a href="login">Admin</a>
            <a href="posts">Sobre nosotros</a>
            <a href="loginas">Alumnos</a>
        </div>
        <br>
       <p class="developer-list"> Versión 14.1</p>
    </div>

    <!-- Líneas decorativas -->
    <div class="line-decorations">
        <div class="line"></div>
        <div class="line"></div>
        <div class="line"></div>
        <div class="line"></div>
    </div>
</body>
</html>
