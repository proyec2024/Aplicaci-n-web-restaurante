<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="estilo.css">
    <link rel="icon" type="image/png" sizes="16x16" href="images/G.png">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<body>
    <form method="post">
        <h2>Hola</h2>
        <p>Ingresar sus datos para poder registrarse</p>

        <div class="input-wrapper">
            <input type="text" name="name" placeholder="Nombre">
            <img class="input-icon" src="images/name.svg" alt="">
        </div>

        <div class="input-wrapper">
            <input type="email" name="email" placeholder="Email">
            <img class="input-icon" src="images/email.svg" alt="">
        </div>

        <div class="input-wrapper">
            <input type="text" name="direction" placeholder="Direccion">
            <img class="input-icon" src="images/direction.svg" alt="">
        </div>

        <div class="input-wrapper">
            <input type="tel" name="phone" placeholder="Telefono">
            <img class="input-icon" src="images/phone.svg" alt="">
        </div>

        <div class="input-wrapper">
            <input type="password" name="password" placeholder="Contraseña">
            <img class="input-icon" src="images/password.svg" alt="">
        </div>


        <input class="btn" type="submit" name="registrar" value="Registrarse">
        <br>
        <a href="../index.php" class="btn">Iniciar Sesión</a>
    </form>

    <?php 
        include("registrar.php");
    ?>
</body>
</html>