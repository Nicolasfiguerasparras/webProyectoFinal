<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <!-- Bootstrap CSS -->
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <!-- Bootstrap CSS -->

        <title>Pedidos barra</title>
    </head>
    <body>

        <!-- Set up connection with DB -->
            <?php
                include('connectDB.php');
                $db = connectDb();
            ?>
        <!-- /Set up connection with DB -->

        <!-- Data extract -->
            <?php
                // ---------- Unnatended orders ---------- //
                    $unnatendedOrdersQuery = "SELECT * FROM comanda WHERE entregada = 0";
                    $unnatendedOrders = mysqli_query($db, $unnatendedOrdersQuery);
                // ---------- Unnatended orders ---------- //
                // ---------- Done orders ---------- //
                    $doneOrdersQuery = "SELECT * FROM comanda WHERE entregada = 1";
                    $doneOrders = mysqli_query($db, $doneOrdersQuery);
                // ---------- Done orders ---------- //
            ?>
        <!-- /Data extract -->

        <div class="container">

            <!-- Header -->
                <div clas="row">
                    <div class="col-12" style="text-align:center">
                        <h1>Pedidos barra</h1>
                    </div>
                </div>
            <!-- /Header -->

            <br><br>

            <!-- Main content -->

                    <!-- Search input -->
                        <div class="row">
                            <div class="col-12">
                                <form action="bar.php" method="POST" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="search" name="search" aria-describedby="orderSearch" placeholder="Buscar comanda...">
                                    </div>
                                    <input type="submit" class="btn btn-primary" value="Buscar" name="send">
                                </form>
                            </div>
                        </div>
                    <!-- /Search input -->

                    <br><br>

                    <!-- Search result -->
                        <?php
                            if(isset($_POST['send'])){
                                $searchQuery = "SELECT * FROM comandas WHERE idproducto = '$_POST[search]'";
                                $search = mysqli_query($db, $searchQuery);
                                echo "<div class='row'>";
                                    if($search != 0 && $row = mysqli_fetch_array($search)){
                                        echo "<table class='table table-dark'>";
                                            echo "<thead>";
                                                echo "<tr>";
                                                    echo "<th scope='col'></th>";
                                                    echo "<th scope='col'>Producto</th>";
                                                    echo "<th scope='col'>Unidades</th>";
                                                    echo "<th scope='col'>Entregado</th>";
                                                    echo "<th scope='col'></th>";
                                                echo "</tr>";
                                            echo "</thead>";
                                            echo "<tbody>";
                                            do{
                                                echo "<tr>";
                                                    echo "<td></td>";
                                                    echo "<td>".$row["idproducto"]."</td>";
                                                    echo "<td>".$row["unidades"]."</td>";
                                                    if($row['entregada'] = 1){
                                                        echo "<td><input type='checkbox' checked id='toggle'></td>";
                                                    }elseif($row['entregada'] = 0){
                                                        echo "<td><input type='checkbox' id='toggle'></td>";
                                                    }
                                                echo "</tr>";
                                            }while($row = mysqli_fetch_array($search));
                                            echo "</tbody>";
                                        echo "</table>";
                                    }else{
                                        echo "<table class='table table-dark'>";
                                            echo "<thead>";
                                                echo "<tr>";
                                                    echo "<th scope='col'></th>";
                                                    echo "<th scope='col'>Producto</th>";
                                                    echo "<th scope='col'>Unidades</th>";
                                                    echo "<th scope='col'>Entregado</th>";
                                                    echo "<th scope='col'></th>";
                                                echo "</tr>";
                                            echo "</thead>";
                                            echo "<tbody>";
                                                echo "<tr>";
                                                    echo "<td>No se ha encontrado ningún registro</td>";
                                                echo "</tr>";
                                            echo "</tbody>";
                                        echo "</table>";
                                    }
                                echo "</div>";
                            }
                        ?>
                    <!-- /Search result -->

                    <div class="row">

                        <!-- Unnatended orders -->
                            <div class="col-6">
                                <h2 style="text-align: center;">Pedidos sin atender</h2>

                                <?php
                                    if($row = mysqli_fetch_array($unnatendedOrders)){
                                        echo "<table class='table table-dark'>";
                                            echo "<thead>";
                                                echo "<tr>";
                                                    echo "<th scope='col'></th>";
                                                    echo "<th scope='col'>Producto</th>";
                                                    echo "<th scope='col'>Unidades</th>";
                                                    echo "<th scope='col'>Entregado</th>";
                                                    echo "<th scope='col'></th>";
                                                echo "</tr>";
                                            echo "</thead>";
                                            echo "<tbody>";
                                            do{
                                                $productQuery = "SELECT * FROM producto WHERE id = ".$row['idproducto'];
                                                $productName = mysqli_fetch_array(mysqli_query($db, $productQuery));
                                                echo "<tr>";
                                                    echo "<td></td>";
                                                    echo "<td>".$productName["nombre "]."</td>";
                                                    echo "<td>".$row["unidades"]."</td>";
                                                    if($row['entregada'] = 1){
                                                        echo "<td><input type='checkbox' checked id='toggle'></td>";
                                                    }elseif($row['entregada'] = 0){
                                                        echo "<td><input type='checkbox' id='toggle'></td>";
                                                    }
                                                echo "</tr>";
                                            }while($row = mysqli_fetch_array($unnatendedOrders));
                                            echo "</tbody>";
                                        echo "</table>";
                                    }else{
                                        echo "<table class='table table-dark'>";
                                            echo "<thead>";
                                                echo "<tr>";
                                                    echo "<th scope='col'></th>";
                                                    echo "<th scope='col'>Producto</th>";
                                                    echo "<th scope='col'>Unidades</th>";
                                                    echo "<th scope='col'>Entregado</th>";
                                                    echo "<th scope='col'></th>";
                                                echo "</tr>";
                                            echo "</thead>";
                                            echo "<tbody>";
                                                echo "<tr>";
                                                    echo "<td>No se ha encontrado ningún registro</td>";
                                                echo "</tr>";
                                            echo "</tbody>";
                                        echo "</table>";
                                    }
                                ?>

                            </div>
                        <!-- /Unnatended orders -->

                        <!-- Done orders -->
                            <div class="col-6">
                                <h2 style="text-align: center;">Pedidos atendidos</h2>

                                <?php
                                    if($row = mysqli_fetch_array($doneOrders)){
                                        echo "<table class='table table-dark'>";
                                            echo "<thead>";
                                                echo "<tr>";
                                                    echo "<th scope='col'></th>";
                                                    echo "<th scope='col'>Producto</th>";
                                                    echo "<th scope='col'>Unidades</th>";
                                                    echo "<th scope='col'>Entregado</th>";
                                                    echo "<th scope='col'></th>";
                                                echo "</tr>";
                                            echo "</thead>";
                                            echo "<tbody>";
                                            do{
                                                $productQuery = "SELECT * FROM producto WHERE id = ".$row['idproducto'];
                                                $productName = mysqli_fetch_array(mysqli_query($db, $productQuery));
                                                echo "<tr>";
                                                    echo "<td></td>";
                                                    echo "<td>".$productName["nombre "]."</td>";
                                                    echo "<td>".$row["unidades"]."</td>";
                                                    if($row['entregada'] = 1){
                                                        echo "<td><input type='checkbox' checked id='toggle'></td>";
                                                    }elseif($row['entregada'] = 0){
                                                        echo "<td><input type='checkbox' id='toggle'></td>";
                                                    }
                                                echo "</tr>";
                                            }while($row = mysqli_fetch_array($doneOrders));
                                            echo "</tbody>";
                                        echo "</table>";
                                    }else{
                                        echo "<table class='table table-dark'>";
                                            echo "<thead>";
                                                echo "<tr>";
                                                    echo "<th scope='col'></th>";
                                                    echo "<th scope='col'>Producto</th>";
                                                    echo "<th scope='col'>Unidades</th>";
                                                    echo "<th scope='col'>Entregado</th>";
                                                    echo "<th scope='col'></th>";
                                                echo "</tr>";
                                            echo "</thead>";
                                            echo "<tbody>";
                                                echo "No se ha encontrado ningún registro";
                                            echo "</tbody>";
                                        echo "</table>";
                                    }
                                ?>

                            </div>
                        <!-- /Done orders -->

                </div>
            <!-- /Main content -->

            <!-- Return button -->
                <a href="index.php"><button type="button" class="btn btn-primary btn-lg btn-block">Volver al selector</button></a>
            <!-- /Return button -->

        </div>
        
        <!-- Toggle scripts -->
            <script>
                $(function() {
                    $('#toggle').bootstrapToggle({
                        on: 'Enabled',
                        off: 'Disabled'
                    });
                })
            </script>
        <!-- /Toggle scripts -->

        <!-- Bootstrap JS -->
            <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <!-- /Bootstrap JS -->
    </body>
</html>
