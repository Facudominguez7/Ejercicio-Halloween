<?php
if (isset($_POST['nombre']) && isset($_POST['descripcion'])) {
    $sql = "SELECT * FROM disfraces WHERE nombre = '". $_POST['nombre']."'";
    $sql = mysqli_query($con, $sql);
    if (mysqli_num_rows($sql) != 0) {
        echo "<script>alert('Error: Ese nombre ya existe');</script>";
    } else {
        //Procesar la foto
        if(is_uploaded_file($_FILES['foto']['tmp_name']))
        {
            $nombre = explode('.', $_FILES['foto']['name']);
            $foto = time().'.'. end($nombre);
            copy($_FILES['foto']['tmp_name'], 'imagenes/' .$foto);
        }
        echo $sql = "INSERT INTO disfraces (nombre,descripcion,votos,foto) values ('". $_POST['nombre'] ."','". $_POST['descripcion'] ."',0,'".$foto."')";
        $sql = mysqli_query($con, $sql);
        if (mysqli_error($con)) {
            echo "<script>alert('Error no se pudo insertar el registro');</script>";
        } else {
            echo "<script>alert('Registro insertado con exito');</script>";
        }
    }
    echo "<script>window.location='index.php';</script>";
}

?>


<section id="admin" class="section">
    <h2>Panel de Administración</h2>
    <form action="index.php?modulo=procesar_disfraz" method="POST" enctype="multipart/form-data">
        <label for="disfraz-nombre">Nombre del Disfraz:</label>
        <input type="text" id="nombre" name="nombre" required>

        <label for="disfraz-descripcion">Descripción del Disfrazz:</label>
        <textarea id="descripcion" name="descripcion" required></textarea>

        <label for="disfraz-nombre">Foto:</label>
        <input type="file" id="foto" name="foto">

        <button type="submit">Agregar Disfraz</button>
    </form>
</section>