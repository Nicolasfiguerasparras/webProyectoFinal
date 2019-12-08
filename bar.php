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
                                        <input type="text" class="form-control" id="search" aria-describedby="orderSearch" placeholder="Buscar comanda...">
                                    </div>
                                    <input type="submit" class="btn btn-primary" value="Buscar" name="send">
                                </form>
                            </div>
                        </div>
                    <!-- /Search input -->

                    <div class="row">
                        <!-- Unnatended orders -->
                            <div class="col-6">
                                <h2 style="text-align: center;">Pedidos sin atender</h2>

                                <table class="table table-dark">
                                    <thead>
                                        <tr>
                                            <th scope="col"></th>
                                            <th scope="col">Producto</th>
                                            <th scope="col">Unidades</th>
                                            <th scope="col">Entregado</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">1</th>
                                            <td>Mark</td>
                                            <td>Otto</td>
                                            <td>@mdo</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">2</th>
                                            <td>Jacob</td>
                                            <td>Thornton</td>
                                            <td>@fat</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">3</th>
                                            <td>Larry</td>
                                            <td>the Bird</td>
                                            <td>@twitter</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        <!-- /Unnatended orders -->

                        <!-- Done orders -->
                            <div class="col-6">
                                <h2 style="text-align: center;">Pedidos atendidos</h2>
                                
                                <table class="table table-dark">
                                    <thead>
                                        <tr>
                                            <th scope="col"></th>
                                            <th scope="col">Producto</th>
                                            <th scope="col">Unidades</th>
                                            <th scope="col">Entregado</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">1</th>
                                            <td>Mark</td>
                                            <td>Otto</td>
                                            <td>@mdo</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">2</th>
                                            <td>Jacob</td>
                                            <td>Thornton</td>
                                            <td>@fat</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">3</th>
                                            <td>Larry</td>
                                            <td>the Bird</td>
                                            <td>@twitter</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        <!-- /Done orders -->

                </div>
            <!-- /Main content -->

            <!-- Return button -->
                <a href="index.php"><button type="button" class="btn btn-primary btn-lg btn-block">Volver al selector</button></a>
            <!-- /Return button -->

        </div>

        <!-- Bootstrap JS -->
            <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <!-- /Bootstrap JS -->
    </body>
</html>



$listQuery = mysqli_query($db, "SELECT * FROM clients");

                                    if($row = mysqli_fetch_array($listQuery)){
                                        echo "<table class='table'>";

                                            echo "<thead>";
                                                echo "<tr>";
                                                    echo "<th scope='col'>Name</th>";
                                                    echo "<th scope='col'>Surname</th>";
                                                    echo "<th scope='col'>Birth Date</th>";
                                                    echo "<th scope='col'>Phone</th>";
                                                    echo "<th scope='col'>Email</th>";
                                                    echo "<th scope='col'>Username</th>";
                                                    echo "<th scope='col'>Password</th>";
                                                    echo "<th scope='col'>Cases</th>";
                                                    echo "<th scope='col'>Bill</th>";
                                                echo "</tr>";
                                            echo "</thead>";

                                            do{
                                                echo "<tr>";
                                                    $listID=$row['client_ID'];
                                                    echo "<td>".$row["name"]."</td>";
                                                    echo "<td>".$row["surname"]."</td>";
                                                    $bDateFormatted = date("l jS F ", strtotime($row["birth_date"]));   
                                                    echo "<td>".$bDateFormatted."</td>";
                                                    echo "<td>".$row["phone"]."</td>";
                                                    echo "<td>".$row["email"]."</td>";
                                                    echo "<td>".$row["username"]."</td>";
                                                    echo "<td>".$row["password"]."</td>";
                                                    $cases = mysqli_query($db, "SELECT * FROM cases WHERE client_ID = '$row[client_ID]'");
                                                    $num = mysqli_num_rows($cases);
                                                    if($row_cases = mysqli_fetch_array($cases)){
                                                        echo "<td>";
                                                            do{
                                                                echo $row_cases['title'];
                                                                $num--;
                                                                if(!$num == 0){
                                                                    echo ", ";
                                                                }
                                                            }while($row_cases = mysqli_fetch_array($cases));
                                                        echo "</td>";
                                                    }else{
                                                        echo "<td>No record</td>";
                                                    }
                                                    echo "<td>".$row["bill"]."$</td>";
                                                    echo "<td style='text-align: center'><a href='addCase.php?client=$listID'><i class='fa fa-plus' aria-hidden='true'></i></a></td>";
                                                    echo "<td style='text-align: center'><a href='payment.php?client=$listID'><i class='fas fa-dollar-sign' style='font-size:20px; color:black'></i></a></td>";
                                                    echo "<td style='text-align: center'><a href='modify.php?client=$listID'><i class='fa fa-edit' style='font-size:20px;color:green'></i></a></td>";
                                                    echo "<td style='text-align: center'><a class='delete_button' href='delete.php?client=$listID'><i class='fa fa-trash' style='font-size:20px;color:red'></i></a></td>";
                                                echo "</tr>";
                                            }while($row = mysqli_fetch_array($listQuery));
                                    }else{
                                        echo "There is no record";
                                    }