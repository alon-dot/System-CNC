<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sobre Nosotros</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            color: #333;
        }

        header {
            background-color: #ffc107;
            color: white;
            text-align: center;
            padding: 1em 0;
        }

        .container {
            width: 80%;
            margin: auto;
        }

        .about-us {
            background-color: white;
            padding: 40px 0;
            margin-top: 20px;
        }

        .team {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 30px;
            justify-items: center;
        }

        .team-member {
            background-color: #fff;
            text-align: center;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .team-member:hover {
            transform: translateY(-10px);
        }

        .team-member img {
            width: 100%;
            height: 250px;
            object-fit: cover;
        }

        .team-member h3 {
            margin: 20px 0 10px;
            font-size: 1.2em;
        }

        .team-member p {
            padding: 0 15px 20px;
            color: #666;
        }

        .collaborators {
            background-color: white;
            padding: 30px;
            margin-top: 40px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        .collaborators h3 {
            text-align: center;
            margin-bottom: 20px;
        }

        .collaborators ul {
            list-style: none;
            padding: 0;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 30px;
        }

        .collaborators li {
            text-align: center;
            padding: 10px;
            border-radius: 8px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .collaborators li:hover {
            transform: translateY(-10px);
        }

        .collaborator-photo {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 8px;
            opacity: 0;
            transform: translateY(20px);
            animation: fadeInUp 1s forwards;
        }
        .collaborators ul {
    display: flex; /* Flexbox activado */
    justify-content: center; /* Centra los items en el eje horizontal */
    list-style-type: none; /* Elimina los puntos de la lista */
    padding: 0;
}

.collaborators li {
    display: flex; /* Activa Flexbox en cada item */
    flex-direction: column; /* Centra imagen y texto de forma vertical */
    align-items: center; /* Centra los elementos de forma horizontal */
    margin: 10px; /* Espaciado entre los items */
}

.collaborator-photo {
    max-width: 150px; /* Ajusta el tamaño de las imágenes */
    height: auto; /* Mantiene la proporción de la imagen */
}

        .collaborators li:nth-child(1) .collaborator-photo {
            animation-delay: 0.2s;
        }

        .collaborators li:nth-child(2) .collaborator-photo {
            animation-delay: 0.4s;
        }

        .collaborators li:nth-child(3) .collaborator-photo {
            animation-delay: 0.6s;
        }

        .collaborators li:nth-child(4) .collaborator-photo {
            animation-delay: 0.8s;
        }

        .collaborator-name {
            font-size: 1.1em;
            margin-top: 10px;
            color: #333;
        }

        .collaborator-role {
            font-size: 1em;
            color: #777;
        }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        header {
    background-color: #ffc107;
    color: white;
    text-align: center;
    padding: 1em 0;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

header img {
    height: 60px;
    margin-right: 20px;
}
header img {
    height: 60px;
    width: 60px; /* Mantén la proporción circular */
    border-radius: 50%; /* Convierte la imagen en un círculo */
    object-fit: cover; /* Ajusta la imagen al contenedor circular */
    margin-right: 20px;}

    .btn-regresar {
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

        .btn-regresar:hover {
            background-color: #fff;
            color: #FFC107;
            transform: translateY(-3px);
        }
    </style>
</head>
<body>

    <header>
        <div style="display: flex; align-items: center; justify-content: space-between; padding: 0 20px;">
            <img src="/images/logo.jpg" alt="Logo de M-RAM CNC" style="height: 60px;">
            <h1>Sobre Nosotros</h1>
        </div>
        <a href="welcome" class="btn-regresar">Regresar</a>
    </header>

    <div class="container">
        <!-- Sección de Nosotros -->
        <section class="about-us">
            <h2 style="text-align: center;">Nuestro Equipo</h2> <br><br>
            <div class="team">
                <!-- Miembro 1 -->
                <div class="team-member">
                    <img src="/images/eldin.jpg">
                    <h3>Eldin Mauricio Ramírez Márquez</h3>
                    <p>Líder de proyecto</p>
                </div>
                <!-- Miembro 2 -->
                <div class="team-member">
                    <img src="/images/alexis.jpg">
                    <h3>Alexis Baez López</h3>
                    <p>Analista</p>
                </div>
                
                <!-- Miembro 3 -->
                <div class="team-member">
                    <img src="/images/alon.jpeg">
                    <h3>Alondra Olivares Luna</h3>
                    <p>Desarrolladora</p>
                </div>
                <!-- Miembro 4 -->
                <div class="team-member">
                    <img src="/images/danna.jpg">
                    <h3>Danna Paola Lemus Sánchez</h3>
                    <p>Diseñadora </p>
                </div>
        </section>

        <!-- Sección de Colaboradores -->
        <section class="collaborators">
            <h3>Colaboradores</h3>
            <center><ul>
                <li>
                    <img src="/images/roman.jpeg" alt="Colaborador 1" class="collaborator-photo">
                    <div class="collaborator-name">Román Daniel Romero Mitre</div>
                    <div class="collaborator-role">Consultor</div>
                </li>
                
                <li>
                    <img src="/images/sonia.jpeg" alt="Colaborador 3" class="collaborator-photo">
                    <div class="collaborator-name">Sonia López Rodríguez</div>
                    <div class="collaborator-role">Consultora</div>
                </li>
               
            </ul></center>
        </section>
    </div>

</body>
</html>