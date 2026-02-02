<?php include 'includes/cabecera.php'; ?>


<div class="card-form">

    <h2>Registro de cliente</h2>

    <form action="index.php?accion=guardar_registro" method="post">

        <label>Nombre</label>
        <input type="text" name="nombre" value="<?= h($_POST['nombre'] ?? '') ?>">
        <?php if (!empty($errores['nombre'])) echo "<p class='error'>{$errores['nombre']}</p>"; ?>

        <label>Apellido</label>
        <input type="text" name="apellido" value="<?= h($_POST['apellido'] ?? '') ?>">
        <?php if (!empty($errores['apellido'])) echo "<p class='error'>{$errores['apellido']}</p>"; ?>

        <label>Email</label>
        <input type="email" name="correo" value="<?= h($_POST['correo'] ?? '') ?>">
        <?php if (!empty($errores['correo'])) echo "<p class='error'>{$errores['correo']}</p>"; ?>

        <label>Contraseña</label>
        <input type="password" name="clave">
        <?php if (!empty($errores['clave'])) echo "<p class='error'>{$errores['clave']}</p>"; ?>

        <?php if (!empty($errorDB)) echo "<p class='error'>$errorDB</p>"; ?>

        <button type="submit">Registrarse</button>
    </form>

</div>

<?php include 'includes/pie.php'; ?>
