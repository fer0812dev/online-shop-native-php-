<?php
session_start();
include_once("ValidaSesion.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | DataTables</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="./plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="./plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="./plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="./plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="./dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

<?php

include('header.php');

include('menu.php');

$idmodelo = "";
$nombremod = "";
$destino = "";

if(isset($_REQUEST['idmod'])){
 // echo "<script>alert('" .$_REQUEST["idmod"] ."');</script>";

  
  include('conexion.php');


  $sql = "SELECT id_mod, nom_mod, id_mar FROM modelo WHERE md5(id_mod) = '" .$_REQUEST['idmod']. "'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {  
      $destino = "?idmod=" . md5($row['id_mod']);
      $idmodelo = $row['id_mod']; 
      $nombremod = $row['nom_mod'];
      $idmar = $row["id_mar"];
    }
  } else {
    echo "0 results";
  }
}

?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Modelos</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">DataTables</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Alta de modelos</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <!--AQUI PONER EL CONTENIDO -->

                <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Llene el siguiente</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="modeloAcciones.php<?= $destino ?>" method="post">
                <div class="card-body">

                  <div class="form-group">
                    <label for="idmodelo">ID del Modelo</label>
                    <input type="text" disabled class="form-control" id="idmodelo" name="idmodelo" value="<?= $idmodelo; ?>" placeholder="Nombre del modelo">
                  </div>

                  <div class="form-group">
                    <label for="nombre">Nombre del modelo</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" value="<?= $nombremod; ?>" placeholder="Nombre del modelo" required="required">
                  </div>


                   <div class="form-group">
                    <label for="sucursal">Marca</label>
                    <select name="modelo" class="form-control" required="required">
                      <option value="">Seleccione la marca</option>
                      <?php

                      include('conexion.php');

                      $sql = "SELECT * FROM marca";


                      $result = $conn->query($sql);

                      if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                        $selIdMar = "";
                        if($row["id_mar"] === $idmar){
                          $selIdMar = " selected ";
                        }
                        echo "
                              <option $selIdMar value='". $row["id_mar"] . "'>" . $row["nom_mar"] . "</option>";

                        }
                      } else {
                        echo "0 results";
                      }
                      $conn->close();

                     
                      ?>
                    </select>
                    <div class="invalid-feedback">
                      El campo es requerido.
                    </div>
                  </div>
                </div>

                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
              </form>
            </div>
            <!-- /.card -->


              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.2.0
    </div>
    <strong>Copyright &copy; 2022 <a href="#">Comercializadora de autos online</a>.</strong> Derechos reservados.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="./plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="./plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="./plugins/datatables/jquery.dataTables.min.js"></script>
<script src="./plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="./plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="./plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="./plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="./plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="./plugins/jszip/jszip.min.js"></script>
<script src="./plugins/pdfmake/pdfmake.min.js"></script>
<script src="./plugins/pdfmake/vfs_fonts.js"></script>
<script src="./plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="./plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="./plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="./dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="./dist/js/demo.js"></script>
<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
</body>
</html>
