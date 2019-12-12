<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-lite/1.1.0/material.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.material.min.css">

        <script type="text/javascript" src="https://code.jquery.com/jquery-1.12.3.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>

        <script src='jquery-paginate.min.js'></script>
        <script src='jquery-dataTables.min.js'></script>
        <script type="text/javascript" src='https://cdn.datatables.net/1.10.20/js/dataTables.material.min.js'></script>
        
        <script>
           function filterGlobal () {
                $('#MyTable1').DataTable().search(
                    $('#global_filter1').val()
                ).draw();

                $('#MyTable2').DataTable().search(
                    $('#global_filter2').val()
                ).draw();
            }

            $(document).ready(function() {
                $('#MyTable1').DataTable({
                    columnDefs: [
                        {
                            targets: [ 0, 1, 2 ],
                            className: 'mdl-data-table__cell--non-numeric'
                        }
                    ]
                } );

                $('#MyTable2').DataTable({
                    columnDefs: [
                        {
                            targets: [ 0, 1, 2 ],
                            className: 'mdl-data-table__cell--non-numeric'
                        }
                    ]
                } );
            
                $('input.global_filter1').on( 'keyup click', function () {
                    filterGlobal();
                } );
            
                $('input.column_filter2').on( 'keyup click', function () {
                    filterColumn( $(this).parents('tr').attr('data-column') );
                } );
            } );
        </script>

        <!-- Bootstrap CSS -->
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <!-- /Bootstrap CSS -->

        <title>Pedidos barra</title>
    </head>
    <style>
        #MyTable1_wrapper > div:nth-child(3) > div.mdl-cell.mdl-cell--4-col{
            display:none;
        }

        #MyTable2_wrapper > div:nth-child(3) > div.mdl-cell.mdl-cell--4-col{
            display:none;
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

                // ---------- Unnatended orders ---------- //
                    $unnatendedOrders[] = null;

                    $invoices = mysqli_query($db, "SELECT * FROM factura ORDER BY horainicio DESC");
                    if($invoicesRow = mysqli_fetch_array($invoices)){
                        do{
                            $actualOrder = mysqli_query($db, "SELECT * FROM comanda WHERE idfactura = $invoicesRow[id] AND entregada = 0");
                            if($orderRow = mysqli_fetch_array($actualOrder)){
                                do{
                                    $actualSize = sizeof($unnatendedOrders);
                                    $drinks = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM producto where id = $orderRow[id]"));
                                    if($drinks['categoria'] == "Bebidas"){
                                        $unnatendedOrders[] = $orderRow['id'];
                                    }
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
                                    $drinks = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM producto where id = $orderRow[id]"));
                                    if($drinks['categoria'] == "Bebidas"){
                                        $doneOrders[] = $orderRow['id'];
                                    }
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

                <div class="row">

                    <!-- Unnatended orders -->
                        <div class="col-12 col-xl-6 div1">
                            <h2 style="text-align: center;">Pedidos sin atender</h2>

                            <?php
                                echo "<table id='MyTable1' class='mdl-data-table'>";
                                    echo "<thead>";
                                        echo "<tr>";
                                            echo "<th scope='col'>Producto</th>";
                                            echo "<th scope='col'>Unidades</th>";
                                            echo "<th scope='col'>Mesa</th>";
                                            echo "<th scope='col'>Zona</th>";
                                            echo "<th scope='col'>Entregado</th>";
                                        echo "</tr>";
                                    echo "</thead>";
                                    if(count($unnatendedOrders) > 1){
                                            
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
                                        echo "<tbody>";
                                            echo "<tr>";
                                                echo "<td style='text-align:center'>No se ha obtenido ningún resultado</td>";
                                                echo "<td></td>";
                                                echo "<td></td>";
                                                echo "<td></td>";
                                                echo "<td></td>";
                                            echo "</tr>";
                                        echo "</tbody>";
                                    }
                                echo "</table>";
                            ?>

                        </div>
                    <!-- /Unnatended orders -->

                    <!-- Done orders -->
                        <div class="col-12 col-xl-6 div2">
                            <h2 style="text-align: center;">Pedidos atendidos</h2>

                            <?php
                                echo "<table id='MyTable2' class='mdl-data-table'>";
                                    echo "<thead>";
                                        echo "<tr>";
                                            echo "<th scope='col'>Producto</th>";
                                            echo "<th scope='col'>Unidades</th>";
                                            echo "<th scope='col'>Mesa</th>";
                                            echo "<th scope='col'>Zona</th>";
                                            echo "<th scope='col'>Entregado</th>";
                                        echo "</tr>";
                                    echo "</thead>";
                                    if(count($doneOrders) > 1){
                                        
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
                                        echo "<tbody>";
                                            echo "<tr>";
                                                echo "<td style='text-align:center'>No se ha obtenido ningún resultado</td>";
                                                echo "<td></td>";
                                                echo "<td></td>";
                                                echo "<td></td>";
                                                echo "<td></td>";
                                            echo "</tr>";
                                        echo "</tbody>";
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

        <!-- Bootstrap JS -->
            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <!-- /Bootstrap JS -->
    </body>
</html>
