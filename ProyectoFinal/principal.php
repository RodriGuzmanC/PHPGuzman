<?php
    include 'conexion.php';

    try {
        $s=$con->prepare("SELECT * from persona");

        if($s->execute()){
            if($s->rowCount()>=1){
                $r=$s->fetchAll(PDO::FETCH_OBJ);
            }
        }

    } catch (PDOException $e) {
        echo "Error".$e->getMessage();
    }

    include 'head.php';
?>

</head>
<body>
    <div class="main">
        <div class="container col-right">
            <div class="button">
                <a href="insertar.php">Agregar <img src="img/mas.svg" width="10px" alt=""></a>
            </div>

            <div class="table">
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Nacionalidad</th>
                        <th>Acciones</th>
                    </tr>

                    <?php 
                        foreach($r as $per){
                            echo "
                                <tr>
                                    <td> $per->id</td>
                                    <td> $per->nombre</td>
                                    <td> $per->correo</td>
                                    <td> $per->nacionalidad</td>
                                    <td class='icons'>
                                        <a href='datos.php?ID=".$per->id."'>
                                            <img src='img/vista.svg'>
                                        </a>

                                        <a href='actualizar.php?ID=".$per->id."'>
                                            <img src='img/lapiz.svg'>
                                        </a>

                                        <a href='eliminar.php?ID=".$per->id."'>
                                            <img src='img/tacho.svg'>
                                        </a>
                                    </td>
                                </tr>
                            ";
                        }
                    ?>
                </table>
            </div>
        </div>
    </div>
</body>
</html>