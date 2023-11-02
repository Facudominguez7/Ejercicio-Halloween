<?php
session_start();
include('includes/conexion.php');
conectar();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Concurso de disfraces de Halloween</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>

<body>
    <nav>
        <ul>
            <li><a href="index.php">Inicio</a></li>
            <li><a href="index.php">Ver Disfraces</a></li>
            <li><a href="index.php?modulo=procesar_registro">Registro</a></li>
            <li><a href="index.php?modulo=procesar_login">Iniciar Sesión</a></li>
            <li><a href="index.php?modulo=procesar_disfraz">Panel de Administración</a></li>


        </ul>
    </nav>
    <header>
        <h1>Concurso de disfraces de Halloween</h1>
        <?php
        if (!empty($_SESSION['nombre_usuario'])) {
        ?>
            <p>Bienvenido <?php echo $_SESSION['nombre_usuario']; ?></p>
            <a href="index.php?modulo=procesar_login&salir=ok">Cerrar Sesión</a>
        <?php
        }
        ?>
    </header>
    <main>
        <?php
        if (!empty($_GET['modulo'])) {
            include('modulos/' . $_GET['modulo'] . '.php');
        } else {
            $sql = "SELECT * FROM disfraces ORDER BY votos DESC";
            $sql = mysqli_query($con, $sql);
            if (mysqli_num_rows($sql) != 0) {

                while ($r = mysqli_fetch_array($sql)) {
        ?>
                    <section id="disfraces-list" class="section">
                        <!-- Aquí se mostrarán los disfraces -->
                        <div class="disfraz">
                            <h1><?php echo $r['nombre']; ?></h1>
                            <p>Votos: <?php echo $r['votos']; ?></p>
                            <p><?php echo $r['descripcion']; ?></p>
                            <p><img src="imagenes/<?php echo $r['foto']; ?>" width="100%"></p>
                            <?php
                            if (!empty($_SESSION['nombre_usuario'])) {
                                $sql_votos = "SELECT * FROM votos WHERE id_disfraz=" . $r['id'] . " and
                                id_usuario="  . $_SESSION['id'];
                                $sql_votos = mysqli_query($con, $sql_votos);
                                if (mysqli_num_rows($sql_votos) == 0) {
                            ?>
                                    <button class="votar">Votar</button>
                            <?php
                                }
                            }
                            ?>

                        </div>
                        <!-- Repite la estructura para más disfraces -->
                    </section>
                <?php
                }
            } else {
                ?>
                <section id="disfraces-list" class="section">
                    <!-- Aquí se mostrarán los disfraces -->
                    <div class="disfraz">
                        <h2>No hay datos</h2>
                    </div>
                    <!-- Repite la estructura para más disfraces -->
                </section>
            <?php
            }
            ?>

        <?php
        }
        ?>

    </main>
    <script src="js/script.js"></script>
</body>

</html>