<?php
if (isset($_POST['nombre']) && isset($_POST['clave'])) {
    //Verifico que no existe el usuario 
    $sql = "SELECT * FROM usuarios WHERE nombre = '" . $_POST['nombre'] . "'";
    $sql = mysqli_query($con, $sql);
    if (mysqli_num_rows($sql) != 0) {
        echo "<script>alert('Error: El usuario ya existe');</script>";
    } else {
        //inserto el usuario nuevo
        echo $sql = "INSERT INTO usuarios (nombre, clave) values ('" . $_POST['nombre'] . "', '" . $_POST['clave'] . "')";
        $sql = mysqli_query($con, $sql);
        if (mysqli_error($con)) {
            echo "<script>alert('Error no se pudo insertar el registro');</script>";
        } else {
            echo "<script>alert('Registro insertado con exito');</script>";
        }
    }
    echo "<script>window.location='index.php?modulo=procesar_registro';</script>";
}

?>
<section id="registro" class="section">
    <h2>Registro</h2>
    <form action="index.php?modulo=procesar_registro" method="POST">
        <label for="username">Nombre de Usuario:</label>
        <input type="text" id="nombre" name="nombre" required>

        <label for="password">Contraseña:</label>
        <input type="password" id="clave" name="clave" required>

        <button type="submit">Registrarse</button>
    </form>
</section>
