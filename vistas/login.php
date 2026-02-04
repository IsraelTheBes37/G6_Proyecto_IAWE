<?php include 'includes/cabecera.php'; ?>

<div class="card-form">

    <h2>Iniciar sesión</h2>

    <form action="index.php?accion=validar_login" method="post">

        <label>Email</label>
        <input type="email" name="correo" value="<?= h($_POST['correo'] ?? '') ?>">
        <?php if (!empty($errores['correo'])) echo "<p class='error'>{$errores['correo']}</p>"; ?>

        <label>Contraseña</label>
        <input type="password" name="clave">
        <?php if (!empty($errores['clave'])) echo "<p class='error'>{$errores['clave']}</p>"; ?>

        <?php if (!empty($errores['login'])) echo "<p class='error'>{$errores['login']}</p>"; ?>
        <?php if (!empty($errorDB)) echo "<p class='error'>$errorDB</p>"; ?>

        <div class="form-controls">
            <button type="submit">Entrar</button>
        </div>

    </form>

</div>

<?php include 'includes/pie.php'; ?>