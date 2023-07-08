<?php
    include 'conexion.php';
    try{
        if (isset($_POST["cancel"])){
            header("location:principal.php");
        }
        else if (isset($_POST["id"])){
            $id = $_POST["id"];

            try {
                $statement = $con->prepare("DELETE FROM persona WHERE id=:id");
                if($statement->execute(['id'=>$id])){
                    header("location:principal.php");
                }else{
                    header('location:error.php');
                }
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }
        else if (isset($_GET["ID"]) && !empty($_GET["ID"])){
            $id = $_GET["ID"];
            try {
                $statement = $con->prepare("SELECT * FROM persona WHERE id=:id");
                if ($statement->execute(['id'=>$id])){
                    if ($statement->rowCount() == 1) {
                        $results = $statement->fetch(PDO::FETCH_ASSOC);
                        $id = $results['id'];
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
            header('location:error.php');
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    include 'head.php'; ?>
    <title>Actualizar datos</title>
</head>

<body>
    <div class="main">
        <div class="container">
            <div class="card row-left">
                <p id="title">¿Está seguro de querer eliminar el siguiente registro?</p> 
                <p>Id:</p><p><?php echo $id;?></p>
                <p>Nombre:</p><p><?php echo $n;?></p>
                <p>Contraseña:</p><p><?php echo $p;?></p>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                    <input type="hidden" name="id" value="<?php echo $id;?>">
                    <div class="buttons">
                        <input type="submit" name="eliminar" id="delete" value="Sí">
                        <input type="submit" name="cancel" id="cancel" value="No">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>