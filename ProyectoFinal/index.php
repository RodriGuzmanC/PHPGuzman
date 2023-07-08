<?php
include 'conexion.php';

$error = "";

if(isset($_POST['ingresar'])) {
    if(isset($_POST['nombre']) && !empty($_POST['nombre']) 
    && isset($_POST['password']) && !empty($_POST['password'])){
        $n=$_POST['nombre'];
        $p=$_POST['password'];

        try {
            $s=$con->prepare("SELECT * from persona WHERE nombre=:n and password=:p");

            $s->execute(['n'=>$n,'p'=>$p]);
            $result = $s->fetch(PDO::FETCH_ASSOC);

            if($result){
                header('location:principal.php');
            } else{
                $error = "Usuario o contraseña incorrectos";
            }

        } catch (PDOException $e) {
            echo "Error".$e->getMessage();
        }
    }
} else if(isset($_POST['registrar'])){
    header('location:registrar.php');
}

include 'head.php';
?>
<body>
    <div class="main">
        <div class="container">
            <div class="card">
                <form action="<?php htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post">
                    <img class="user" src="img/user.svg" width="120px" alt="">
                    <input type="text" name="nombre" placeholder="Ingrese nombre">
                    <input type="text" name="password" placeholder="Ingrese contraseña">
                    <input type="submit" name="ingresar" value="Iniciar sesión">
                    <input type="submit" name="registrar" value="Registrar">
                </form>
                <?php if($error != "") { ?>
                <div class="error"><?php echo $error ?></div>
                <?php } ?>
            </div>
        </div>
    </div>
</body>
</html>
