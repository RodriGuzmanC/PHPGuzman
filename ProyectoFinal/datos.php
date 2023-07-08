<?php
    include 'conexion.php';
    if (isset($_POST["accept"])){
        header("location:principal.php");
    }
    else if (isset($_GET["ID"]) && !empty($_GET["ID"])){
        $id = $_GET["ID"];
        try{
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
            $results = $statement->fetch(PDO::FETCH_ASSOC);
        }catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }else{
        header('location:error.php');
    }
    
    include 'head.php'
    
    ?>
    <title>Información</title>
</head>
<body>
    <div class="main">
        <div class="container">
            <div class="card row-left">
                <p id="title">Información</p> 
                <p>Id:</p><p><?php echo $id;?></p>
                <p>Nombre:</p><p><?php echo $n;?></p>
                <p>Contraseña:</p><p><?php echo $p?></p>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST"> 
                    <input type="submit" name="accept" id="submit" value="Aceptar">
                </form>
            </div>
        </div>
    </div>
</body>
</html>
