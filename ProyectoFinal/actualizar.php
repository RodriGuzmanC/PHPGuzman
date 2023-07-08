<?php
    include 'conexion.php';
    $n = $p = $nombre_err = $pass_err = "";

    if (isset($_POST['cancel']) && !empty($_POST['cancel'])){
        header("location:principal.php");



    }
    else if (isset($_POST['id']) && !empty($_POST['id'])){
        $id = $_POST['id'];
        
        $input_nombre = trim($_POST['nombre']);
        if (empty($input_nombre)) {
            $nombre_err = "Por favor, ingrese un nombre";
        }
        else{
            $n = $input_nombre;
        }
        $input_pass = trim($_POST['pass']);
        if (empty($input_pass)) {
            $pass_err = "Por favor, ingrese una contraseña";
        }
        else{
            $p = $input_pass;
        }

        
        if (empty($nombre_err) && empty($pass_err)) {
            try {
                $statement = $con->prepare("UPDATE persona SET nombre=:n, password=:p WHERE id=:id");
                if($statement->execute(['n'=>$n, 'p'=>$p, 'id'=>$id])){
                    header("location:principal.php");
                }else{
                    header('location:error.php');
                }
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }



    }
    else if (isset($_GET["ID"]) && !empty($_GET["ID"])){
        $id = $_GET["ID"];
        try {
            $statement = $con->prepare("SELECT * FROM persona WHERE id=:id");
            if ($statement->execute(['id'=>$id])){
                if ($statement->rowCount() == 1) {
                    $results = $statement->fetch(PDO::FETCH_ASSOC);
                    $n = $results['nombre'];
                    $p = $results['password'];
                }else{
                    header('location:error.php');
                }
            }else{
                header('location:error.php');
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    
    }else{
        echo "a";
    }
    include 'head.php'
?>
    <title>Actualizar datos</title>
</head>
<body>
    <div class="main">
        <div class="container">
            <div class="card">
                <h2>Actualizar datos</h2> 
                <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="POST">
                    <input type="hidden" name="id" value="<?php echo $id;?>">
                    <div class="form-group col-left">
                        <input type="text" name="nombre" class="<?php echo (!empty($nombre_err)) ? 'input_has_error' : ''; ?>" id="" placeholder="Ingrese el nuevo nombre" value="<?php echo $n;?>">
                        <span class="help <?php echo (!empty($nombre_err)) ? 'has_error' : ''; ?>"><?php echo $nombre_err; ?></span>
                        <br class="help <?php echo (!empty($nombre_err)) ? 'has_error' : ''; ?>"/>
                    </div>
                    <div class="form-group col-left">
                        <input type="text" name="pass" class="<?php echo (!empty($password_err)) ? 'input_has_error' : ''; ?>" id="" placeholder="Ingrese la nueva contraseña" value="<?php echo $p;?>">
                        <span class="help <?php echo (!empty($password_err)) ? 'has_error' : ''; ?>"><?php echo $password_err; ?></span>
                        <br class="help <?php echo (!empty($password_err)) ? 'has_error' : ''; ?>"/>
                    </div>
            
                    <div class="buttons">
                        <input type="submit" name="update" id="accept" value="Actualizar">
                        <input type="submit" name="cancel" id="cancel" value="Cancelar">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>