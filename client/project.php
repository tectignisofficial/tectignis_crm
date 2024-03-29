<?php
session_start();
include("config.php");
$id=$_SESSION['id'];

if(!isset($_SESSION['id']))
{
  header("location:log_client.php");
}
if(isset ($_POST['update'])){
  $id=$_POST['id'];
  $name=$_POST['updateName'];
  
  $sql=mysqli_query($conn,"UPDATE `project` SET `project_name`='$name' where id='$id'"); 
  if($sql==1){
    header("location:project.php");
  }
 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>project | CRM</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  
   <style>
     .card-header{
      padding:0px;
      background-color: rgba(0,0,0,.03);
      
    }
    .card-title{
float:left;
padding:20px;
    }
   
  .toast-header strong{
margin-right:40px !important;
}
.toast-body{
  cursor:pointer;
}
.toast{
  width: 250px;
}
   
.select2-container--default .select2-selection--single {
    background-color: #fff;
    border: 1px solid #aaa;
    border-radius: 4px;
    padding-bottom: 27px !important;
}
.select2-container--default.select2-container--focus .select2-selection--multiple, .select2-container--default.select2-container--focus .select2-selection--single {
    border-color: #d3d9df;
}
a{
  text-decoration:none;
}
    </style>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
 
<?php
include("include/header.php");
include("include/sidebar.php");
?>
  <!-- Main Sidebar Container -->
  

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Project</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">project</li>
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
            <!-- /.card -->
              <div class="card">
                <div class="card-header">
                  <h5 class="card-title">List of Project</h5>
                  <button type="button" class="btn btn-primary float-right my-3" data-toggle="modal" data-target="#exampleModal" style="margin-right: 5px;">
                    + Add Project
                  </a>
                </div>
              <!-- /.card-header -->
               <div class="card-body">
                   <table id="example1" class="table table-bordered table-striped">
                        <thead>
                           <tr>
                           <th style="width:10%">Sr no.</th>
                           <th>Project Name</th>
                           <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php
                        $sql=mysqli_query($conn,"select * from project where client_id='$id'");
                        $count=1;
                       while ($row=mysqli_fetch_array($sql)){ 
                        ?>
                       <tr>
                        <td style="width:10%"><?php echo $count;?></td>
                      <td><?php echo $row['project_name']; ?></td>
                      <td>   <button  type="button" class="btn btn-primary btn-rounded btn-icon usereditid" data-toggle="modal" data-id='<?php echo $row['id']; ?>'
                                style="color: aliceblue"> <i class="fas fa-pen"></i>
                                      </button>
                                      <button class="btn btn-danger btn-rounded btn-icon delbtn" type="button" onclick="deleteBtn()" data-id="=<?php echo $row['id']; ?>"><i class="fa fa-trash"></i></button>      


                    
                    
                    </td>
                      </tr>
                        <?php $count++; } ?>
                  
                    </table>
                </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Project</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="api\project_action.php" method="post" >
                        <div class="row">
                            <div class="col-8">
                                <div class="form-group d-flex">
                                    <label style="width:40%;">Project Name</label>
                                    <input type="text" class="form-control"  name="pname" id=pname width="80
                                    %">
                                </div>
                               </div>
                             <div class="modal-footer">
                             <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                             <button type="submit" name="submi" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
               
               
            </div>
          
          <!-- /.modal-content -->
      </div>
      
      <!-- /.modal-dialog -->
    
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

  
  <!-- /.content-wrapper -->
  <?php include"include/footer.php";?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<div class="modal fade" id="dnkModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Project Name</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" >
                <div class="modal-body body2" >
                  

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="update" class="btn btn-primary">Update</button>
                </div>
                </form>
            </div>
        </div>
        </div>
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- DataTables  & Plugins -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="plugins/jszip/jszip.min.js"></script>
<script src="plugins/pdfmake/pdfmake.min.js"></script>
<script src="plugins/pdfmake/vfs_fonts.js"></script>
<script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
   
  });
</script>
<script>
            $(document).ready(function(){
                $('.delbtn').click(function(e){
                    e.preventDefault();
                    let del_id = $(this).data('id');
                    swal({
                        title: "Are you sure?",
                        text: "Once deleted, you will not be able to recover this imaginary file!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            swal("Poof! Your imaginary file has been deleted!", {
                                icon: "success",
                            });
                            window.location.href = "api/project_action.php?del_id"+del_id;
                        } else {
                            swal("Your imaginary file is safe!");
                        }
                    });
                    })
                });
                </script>
<script>
$(document).ready(function(){
$('.usereditid').click(function(){
  let dnk1 = $(this).data('id');

  $.ajax({
   url: 'api/project_action.php',
   type: 'post',
   data: {dnk1: dnk1},
   success: function(response1){ 
     $('.body2').html(response1);
     $('#dnkModal').modal('show'); 
   }
 });
});


});
</script>

</body>
</html>
