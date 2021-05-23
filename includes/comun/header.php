<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="../../css/estilos.css" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

<body>

<img class="centerBanner" src="images/recursos/banner_logo.png" height="133" width="970" alt=""/>

<div class="navbar">
    <a href="index.php">Inicio</a>
    <a href="cursos.php">Cursos</a>
    <a href="juegos.php">Juegos</a>
    <a href="foros.php">Foros</a>
    <a href="about.php">Acerca de</a>
    <div class="dropdown">
        <button class="dropbtn"><?php
            if (isset($_SESSION["login"]) && $_SESSION["login"]){
                echo "Hola, ";
                echo $_SESSION["given"];
            }else{
                echo '<a href="login.php">Inicia sesión</a>';
            }
            ?>
        </button>
        <div class="dropdown-content">
            <?php
            if (isset($_SESSION["login"]) && $_SESSION["login"]){
                ?>
                <a href="profile.php">Mi perfil</a>
<!--                <a href="#">Notificaciones --><?php
//                    echo "(";
//                    //echo notif_number();
//                    echo ")";
//                    ?><!--</a>-->
<!--                <a href="#">Mensajes</a>-->
                <a href="misCursos.php">Mis cursos</a>
                <a href="logout.php">Cerrar sesión</a>
                <?php
                if ($_SESSION["admin"]){
                    echo '<a href="adminJuegos.php">Administrar juegos</a>';
                    echo '<a href="adminCursos.php">Administrar cursos</a>';
                }
                ?>
            <?php
            }else{
                echo '<a href="register.php">Regístrate</a>';
            }

            ?>

        </div>
    </div>
</div>

</body>
</html>