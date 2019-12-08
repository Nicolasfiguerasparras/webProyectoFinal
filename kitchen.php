<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <!-- Bootstrap CSS -->
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <!-- Bootstrap CSS -->

        <title>Pedidos cocina</title>
    </head>
    <body>

        <div class="container">

            <!-- Header -->
                <div class="col-12" style="text-align:center">
                    <h1>Pedidos cocina</h1>
                </div>
            <!-- /Header -->

            <br><br>

            <!-- Main content -->
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