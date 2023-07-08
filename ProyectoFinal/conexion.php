<?php
    try {
        //Conexion a un servidor web
        //$con=new PDO('mysql:host=sql304.byethost10.com;dbname=b10_34016989_registro','b10_34016989','carranza24');
        $con=new PDO('mysql:host=localhost;dbname=registro','root','');
        echo "Conexión Ok";
        
    } catch (PDOException $e) {
        echo "Error".$e->getMessage();
    }
?>