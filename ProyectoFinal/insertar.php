<?php 
    include 'conexion.php';
    $n = $p = $c = $nac =$nom_err = $pass_err= $cor_err = $nac_error="" ;

    if(isset($_POST['cancel'])){
        header('location:principal.php');
    }else if(isset($_POST['insert'])){
        $input_nombre=$_POST['nombre'];
        
        if(empty($input_nombre)){
            $nom_err="Por favor, ingrese su nombre";
        }else{
            $n=$input_nombre;
        }

        //Password
        $input_pass = $_POST['password'];
        if(empty($input_pass)){
            $pass_err="Por favor, ingrese su contraseña";
        }else{
            $p=$input_pass;
        }

        //Correo
        $input_correo=$_POST['correo'];
        if(empty($input_correo)){
            $cor_err="Por favor, ingrese su correo";
        }else{
            $c=$input_correo;
        }

        //Nacionalidad
        $input_nac=$_POST['nacionalidad'];
        if(empty($input_nac)){
            $nac_error="Por favor, ingrese su nacionalidad";
        }else{
            $nac=$input_nac;
        }

        if(empty($nom_err) && empty($pass_err) && empty($cor_err) && empty($nac_error)){
            try {
                $s=$con->prepare("INSERT INTO persona VALUES (null,:n,:p,:c,:nac)");
                if($s->execute(['n'=>$n, 'p'=>$p , 'c'=>$c , 'nac'=>$nac])){
                    header('location:principal.php');
                }
            } catch (PDOException $e) {
                echo "Error". $e->getMessage();
            }
        }
    }

    include 'head.php';
?>

</head>
<body>
    <div class="main">
        <div class="container">
            <div class="card">
                <h2>Insertar registros</h2>
                <form action="" method="post">
                    <div class="form-group col-left">
                        <input type="text" name="nombre" id=""
                        placeholder="Ingrese nombre">
                        <span class="help"></span>
                        <br class="help"/>
                    </div>
                    <div class="form-group col-left">
                        <input type="text" name="password" id=""
                        placeholder="Ingrese contraseña">
                        <span class="help"></span>
                        <br class="help"/>
                    </div>

                    <div class="form-group col-left">
                        <input type="text" name="correo" id=""
                        placeholder="Ingrese correo">
                        <span class="help"></span>
                        <br class="help"/>
                    </div>

                    <div class="form-group col-left">
                        <select name="nacionalidad" id="">
                            <option value="Perú">Perú</option>
                            <option value="México">México</option>
                            <option value="Colombia">Colombia </option>
                            <option value="España">España</option>
                            <option value="Italia">Italia</option>
                        </select>
                        <span class="help"></span>
                        <br class="help"/>
                    </div>

                    <div class="buttons">
                        <input type="submit" name="insert" id="accept" value="Insertar">
                        <input type="submit" name="cancel" id="cancel" value="Cancelar">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>