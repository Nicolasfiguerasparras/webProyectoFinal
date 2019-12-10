<?php
    include('connectDB.php');
    $db = connectDb();

    mysqli_query($db, "UPDATE comanda SET entregada = 0 WHERE id = $_GET[id]");
    header('Location: ' . $_SERVER["HTTP_REFERER"] );
    exit;