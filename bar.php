<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <script language="JavaScript" type="text/javascript" src="jquery.js"></script>

        <script src="sortable.js"></script>
        <script src="paginate.js"></script>

        <!-- Bootstrap CSS -->
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <!-- /Bootstrap CSS -->

        <title>Pedidos barra</title>
    </head>
    <style>
        /* Sortable tables */
        table.sortable thead {
            font-weight: bold;
            cursor: default;
        }
    </style>
    <body>

        <!-- Set up connection with DB -->
            <?php
                include('connectDB.php');
                $db = connectDb();
            ?>
        <!-- /Set up connection with DB -->

        <!-- Data extract -->
            <?php

                // ---------- Me sobras ---------- //
                    // $unnatendedProductQuantity = [];

                    // if($row = mysqli_fetch_array($unnatendedOrders)){
                    //     do{
                    //         $unnatendedProductQuantity[] += $row['idproducto'];
                    //     }while($row = mysqli_fetch_array($unnatendedOrders));
                    // }
                    // print_r(array_count_values($unnatendedProductQuantity));
                    // echo "<br>";

                    // $unnatendedOrdersQuery = "SELECT * FROM comanda WHERE entregada = 0";
                    // $unnatendedOrders = mysqli_query($db, $unnatendedOrdersQuery);

                    // $doneProductQuantity = [];

                    // if($row = mysqli_fetch_array($doneOrders)){
                    //     do{
                    //         $doneProductQuantity[] += $row['idproducto'];
                    //     }while($row = mysqli_fetch_array($doneOrders));
                    // }
                    // $countDone = array_count_values($doneProductQuantity);
                    // print_r($countDone);
                    // echo "<br>";

                    // foreach($countDone as $productId => $productCount){
                    //     echo $productId;
                    //     echo "<br>";
                    //     echo $productCount;
                    //     echo "<br><br>";
                    // }

                    // $doneOrdersQuery = "SELECT * FROM comanda WHERE entregada = 1";
                    // $doneOrders = mysqli_query($db, $doneOrdersQuery);
                // ---------- Me sobras ---------- //


                // ---------- Unnatended orders ---------- //
                    $unnatendedOrders[] = null;

                    $invoices = mysqli_query($db, "SELECT * FROM factura ORDER BY horainicio DESC");
                    if($invoicesRow = mysqli_fetch_array($invoices)){
                        do{
                            $actualOrder = mysqli_query($db, "SELECT * FROM comanda WHERE idfactura = $invoicesRow[id] AND entregada = 0");
                            if($orderRow = mysqli_fetch_array($actualOrder)){
                                do{
                                    $actualSize = sizeof($unnatendedOrders);
                                    $unnatendedOrders[] = $orderRow['id'];
                                }while($orderRow = mysqli_fetch_array($actualOrder));
                            }
                        }while($invoicesRow = mysqli_fetch_array($invoices));
                    }
                // ---------- Unnatended orders ---------- //

                // ---------- Done orders ---------- //
                    $doneOrders[] = null;

                    $invoices = mysqli_query($db, "SELECT * FROM factura ORDER BY horainicio DESC");
                    if($invoicesRow = mysqli_fetch_array($invoices)){
                        do{
                            $actualOrder = mysqli_query($db, "SELECT * FROM comanda WHERE idfactura = $invoicesRow[id] AND entregada = 1");
                            if($orderRow = mysqli_fetch_array($actualOrder)){
                                do{
                                    $actualSize = sizeof($unnatendedOrders);
                                    $doneOrders[] = $orderRow['id'];
                                }while($orderRow = mysqli_fetch_array($actualOrder));
                            }
                        }while($invoicesRow = mysqli_fetch_array($invoices));
                    }
                // ---- Done orders ---------- //

                // ---------- Invoice order ---------- //
                    $invoicesQuery = mysqli_query($db, "SELECT * FROM factura ORDER BY horainicio DESC");
                // ---------- /Invoice order ---------- //
            ?>
        <!-- /Data extract -->

        <!-- Pagination -->
            <?php
                if (isset($_GET['pageno'])) {
                    $pageno = $_GET['pageno'];
                } else {
                    $pageno = 1;
                }

                $no_of_records_per_page = 10;
                $offset = ($pageno-1) * $no_of_records_per_page;
                
                // $total_pages_sql = "SELECT COUNT(*) FROM comandas";
                // $result = mysqli_query($conn,$total_pages_sql);
                // $total_rows = mysqli_fetch_array($result)[0];
                // $total_pages = ceil($total_rows / $no_of_records_per_page);
            ?>
        <!-- /Pagination -->

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

                    <!-- Search result -->
                        <?php
                            if(isset($_POST['send'])){
                                $search = $_POST['search'];
                                // ERROR DE CONSULTA
                                $productNameSearchQuery = mysqli_query($db, "SELECT * FROM producto WHERE nombre LIKE '%an%'");
                                if($row = mysqli_fetch_array($db, $productNameSearchQuery)){
                                    do{
                                        $searchQuery = "SELECT * FROM comanda WHERE idproducto = '$row[id]'";
                                        $search = mysqli_query($db, $searchQuery);
                                        echo "<div class='row'>";
                                            if($row = mysqli_fetch_array($search)){
                                                echo "<table class='table table-dark sortable'>";
                                                    echo "<thead>";
                                                        echo "<tr>";
                                                            echo "<th scope='col'>Producto</th>";
                                                            echo "<th scope='col'>Unidades</th>";
                                                            echo "<th scope='col'>Entregado</th>";
                                                        echo "</tr>";
                                                    echo "</thead>";
                                                    echo "<tbody>";
                                                    do{
                                                        $productQuery = "SELECT * FROM producto WHERE id = '$row[idproducto]'";
                                                        $productName = mysqli_fetch_array(mysqli_query($db, $productQuery));
                                                        echo "<tr>";
                                                            echo "<td>".$productName["nombre"]."</td>";
                                                            echo "<td>".$row["unidades"]."</td>";
                                                            if($row['entregada'] == 1){
                                                                echo "<td><a href='changeStatusUnnatended.php?id=".$row['id']."'><button type='button' class='btn btn-danger'>Marcar sin atender</button></a></td>";
                                                            }elseif($row['entregada'] == 0){
                                                                echo "<td><a href='changeStatusDone.php?id=".$row['id']."'><button type='button' class='btn btn-success'>Marcar atendida</button></a></td>";
                                                            }
                                                        echo "</tr>";
                                                    }while($row = mysqli_fetch_array($search));
                                                    echo "</tbody>";
                                                echo "</table>";
                                            }else{
                                                echo "<table class='table table-dark sortable'>";
                                                    echo "<thead>";
                                                        echo "<tr>";
                                                            echo "<td>No se ha encontrado ningún registro</td>";
                                                        echo "</tr>";
                                                    echo "</thead>";
                                                echo "</table>";
                                            }
                                        echo "</div>";
                                    }while($row = mysqli_fetch_array($db, $productNameSearchQuery));
                                }
                            }
                        ?>
                    <!-- /Search result -->

                    <div class="row">

                        <!-- Unnatended orders -->
                            <div class="col-6">
                                <h2 style="text-align: center;">Pedidos sin atender</h2>

                                <input type="text" id="myInput" class="form-control" aria-describedby="orderSearch" placeholder="Buscar comanda...">

                                <br>

                                <?php

                                    echo "<table class='myTable table table-dark sortable'>";

                                            if(count($unnatendedOrders) > 1){
                                                echo "<thead>";
                                                    echo "<tr>";
                                                        echo "<th scope='col'>Producto</th>";
                                                        echo "<th scope='col'>Unidades</th>";
                                                        echo "<th scope='col'>Mesa</th>";
                                                        echo "<th scope='col'>Zona</th>";
                                                        echo "<th scope='col'>Entregado</th>";
                                                    echo "</tr>";
                                                echo "</thead>";
                                                echo "<tbody>";
                                                for ($i=1; $i < count($unnatendedOrders); $i++) {
                                                    $unnatendedOrdersQuery = "SELECT * FROM comanda WHERE id = '".$unnatendedOrders[$i]."'";
                                                    $unnatendedOrdersFinal = mysqli_fetch_array(mysqli_query($db, $unnatendedOrdersQuery));

                                                    $productQuery = "SELECT * FROM producto WHERE id = '".$unnatendedOrdersFinal['idproducto']."'";
                                                    $productName = mysqli_fetch_array(mysqli_query($db, $productQuery));

                                                    $table = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM mesa WHERE id = (SELECT idmesa FROM factura WHERE id = (SELECT idfactura FROM comanda WHERE id = '".$unnatendedOrdersFinal['id']."'))"));
                                                    $destination = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM mesa WHERE id = (SELECT idmesa FROM factura WHERE id = (SELECT idfactura FROM comanda WHERE id = '".$unnatendedOrdersFinal['id']."'))"));
                                                    echo "<tr>";
                                                        echo "<td>".$productName["nombre"]."</td>";
                                                        echo "<td>".$unnatendedOrdersFinal['unidades']."</td>";
                                                        echo "<td>".$table['numero']."</td>";
                                                        echo "<td>".$destination['zona']."</td>";
                                                        echo "<td><a href='changeStatusDone.php?id=".$unnatendedOrdersFinal['id']."'><button type='button' class='btn btn-success'>Marcar atendida</button></a></td>";
                                                    echo "</tr>";
                                                }
                                                echo "</tbody>";
                                            }else{
                                                echo "<thead>";
                                                    echo "<tr>";
                                                        echo "<td style='text-align:center'>No se ha obtenido ningún resultado</td>";
                                                    echo "</tr>";
                                                echo "</thead>";
                                            }
                                    echo "</table>";
                                ?>

                            </div>
                        <!-- /Unnatended orders -->

                        <!-- Done orders -->
                            <div class="col-6">
                                <h2 style="text-align: center;">Pedidos atendidos</h2>

                                <input type="text" id="myInput2" class="form-control" aria-describedby="orderSearch" placeholder="Buscar comanda...">

                                <br>

                                <?php
                                    echo "<table class='myTable2 table table-dark sortable'>";

                                            if(count($doneOrders) > 1){
                                                echo "<thead>";
                                                    echo "<tr>";
                                                        echo "<th scope='col'>Producto</th>";
                                                        echo "<th scope='col'>Unidades</th>";
                                                        echo "<th scope='col'>Mesa</th>";
                                                        echo "<th scope='col'>Zona</th>";
                                                        echo "<th scope='col'>Entregado</th>";
                                                    echo "</tr>";
                                                echo "</thead>";
                                                echo "<tbody>";
                                                for ($i=1; $i < count($doneOrders); $i++) {
                                                    $doneOrdersQuery = "SELECT * FROM comanda WHERE id = '".$doneOrders[$i]."'";
                                                    $doneOrdersFinal = mysqli_fetch_array(mysqli_query($db, $doneOrdersQuery));

                                                    $productQuery = "SELECT * FROM producto WHERE id = '".$doneOrdersFinal['idproducto']."'";
                                                    $productName = mysqli_fetch_array(mysqli_query($db, $productQuery));

                                                    $table = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM mesa WHERE id = (SELECT idmesa FROM factura WHERE id = (SELECT idfactura FROM comanda WHERE id = '".$doneOrdersFinal['id']."'))"));
                                                    $destination = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM mesa WHERE id = (SELECT idmesa FROM factura WHERE id = (SELECT idfactura FROM comanda WHERE id = '".$doneOrdersFinal['id']."'))"));
                                                    echo "<tr>";
                                                        echo "<td>".$productName["nombre"]."</td>";
                                                        echo "<td>".$doneOrdersFinal['unidades']."</td>";
                                                        echo "<td>".$table['numero']."</td>";
                                                        echo "<td>".$destination['zona']."</td>";
                                                        echo "<td><a href='changeStatusUnnatended.php?id=".$doneOrdersFinal['id']."'><button type='button' class='btn btn-danger'>Marcar no atendida</button></a></td>";
                                                    echo "</tr>";
                                                }
                                                echo "</tbody>";
                                            }else{
                                                echo "<thead>";
                                                    echo "<tr>";
                                                        echo "<td style='text-align:center'>No se ha obtenido ningún resultado</td>";
                                                    echo "</tr>";
                                                echo "</thead>";
                                            }
                                    echo "</table>";
                                ?>

                            </div>
                        <!-- /Done orders -->

                </div>
            <!-- /Main content -->

            <!-- Return button -->
                <a href="index.php"><button type="button" class="btn btn-primary btn-lg btn-block">Volver al selector</button></a>
            <!-- /Return button -->

        </div>

        <!-- Sort JS -->
        <script>
            // function myFunction() {
            //     var input, filter, table, tr, td, i, txtValue;
            //     input = document.getElementById("myInput");
            //     filter = input.value.toUpperCase();
            //     table = document.getElementById("myTable");
            //     tr = table.getElementsByTagName("tr");
            //     for (i = 0; i < tr.length; i++) {
            //         td = tr[i].getElementsByTagName("td")[0];
            //         if (td) {
            //             txtValue = td.textContent || td.innerText;
            //             if (txtValue.toUpperCase().indexOf(filter) > -1) {
            //                 tr[i].style.display = "";
            //             } else {
            //                 tr[i].style.display = "none";
            //             }
            //         }
            //         td = tr[i].getElementsByTagName("td")[1];
            //         if (td) {
            //             txtValue = td.textContent || td.innerText;
            //             if (txtValue.toUpperCase().indexOf(filter) > -1) {
            //                 tr[i].style.display = "";
            //             } else {
            //                 tr[i].style.display = "none";
            //             }
            //         }
            //         td = tr[i].getElementsByTagName("td")[2];
            //         if (td) {
            //             txtValue = td.textContent || td.innerText;
            //             if (txtValue.toUpperCase().indexOf(filter) > -1) {
            //                 tr[i].style.display = "";
            //             } else {
            //                 tr[i].style.display = "none";
            //             }
            //         }
            //         td = tr[i].getElementsByTagName("td")[3];
            //         if (td) {
            //             txtValue = td.textContent || td.innerText;
            //             if (txtValue.toUpperCase().indexOf(filter) > -1) {
            //                 tr[i].style.display = "";
            //             } else {
            //                 tr[i].style.display = "none";
            //             }
            //         }
            //     }
            // }

            // function myFunction2() {
            //     var input, filter, table, tr, td, i, txtValue;
            //     input = document.getElementById("myInput2");
            //     filter = input.value.toUpperCase();
            //     table = document.getElementById("myTable2");
            //     tr = table.getElementsByTagName("tr");
            //     for (i = 0; i < tr.length; i++) {
            //         td = tr[i].getElementsByTagName("td")[0];
            //         if (td) {
            //             txtValue = td.textContent || td.innerText;
            //             if (txtValue.toUpperCase().indexOf(filter) > -1) {
            //                 tr[i].style.display = "";
            //             } else {
            //                 tr[i].style.display = "none";
            //             }
            //         }
            //         td = tr[i].getElementsByTagName("td")[1];
            //         if (td) {
            //             txtValue = td.textContent || td.innerText;
            //             if (txtValue.toUpperCase().indexOf(filter) > -1) {
            //                 tr[i].style.display = "";
            //             } else {
            //                 tr[i].style.display = "none";
            //             }
            //         }
            //         td = tr[i].getElementsByTagName("td")[2];
            //         if (td) {
            //             txtValue = td.textContent || td.innerText;
            //             if (txtValue.toUpperCase().indexOf(filter) > -1) {
            //                 tr[i].style.display = "";
            //             } else {
            //                 tr[i].style.display = "none";
            //             }
            //         }
            //         td = tr[i].getElementsByTagName("td")[3];
            //         if (td) {
            //             txtValue = td.textContent || td.innerText;
            //             if (txtValue.toUpperCase().indexOf(filter) > -1) {
            //                 tr[i].style.display = "";
            //             } else {
            //                 tr[i].style.display = "none";
            //             }
            //         }
            //     }
            // }
        </script>

            <script>

                    let options = {
                        numberPerPage:5, //Cantidad de datos por pagina
                        goBar:true, //Barra donde puedes digitar el numero de la pagina al que quiere ir
                        pageCounter:true, //Contador de paginas, en cual estas, de cuantas paginas
                    };

                    let filterOptions = {
                        el:'#myInput' //Caja de texto para filtrar, puede ser una clase o un ID
                    };

                    paginate.init('.myTable',options,filterOptions);

                    let options2 = {
                        numberPerPage:5, //Cantidad de datos por pagina
                        goBar:true, //Barra donde puedes digitar el numero de la pagina al que quiere ir
                        pageCounter:true, //Contador de paginas, en cual estas, de cuantas paginas
                    };

                    let filterOptions2 = {
                        el:'#myInput2' //Caja de texto para filtrar, puede ser una clase o un ID
                    };

                    paginate.init('.myTable2',options2,filterOptions2);
                

                
            </script>
        <!-- /Sort JS -->

        <!-- Bootstrap JS -->
            <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <!-- /Bootstrap JS -->
    </body>
</html>
