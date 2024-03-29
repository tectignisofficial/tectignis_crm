<?php
session_start();
include("config.php");

$id=$_SESSION['id'];
$uid = $_SESSION['aname'];
if(!isset($_SESSION['id']))
{
  header("location:log_client.php");
}
//lead delete
if(isset($_GET['delid'])){
    $id=mysqli_real_escape_string($conn,$_GET['delid']);
    $sql=mysqli_query($conn,"delete from lead where id='$id'");
    if($sql=1){
        header("location:lead.php");
    }
    }

    if(isset($_GET['gen'])){
      $id=mysqli_real_escape_string($conn,$_GET['gen']);
      $sql=mysqli_query($conn,"update lead set `deal`='1' where id='$id'");
      if($sql==1){
       header("location:deal.php");
      }
    }
    $uid=$_SESSION['id'];
    mysqli_query($conn,"update lead set status=1 where Firm_Name=$uid");   
    
    if(isset($_POST['update'])){
      $id=$_POST['dnk'];
      $nature=$_POST['nature'];
       $remark=$_POST['remark'];
      $remainder_date=$_POST['remainder_date'];
      $sitevisit_date=$_POST['sitevisit_date'];
      $id=$_POST['id'];
    date_default_timezone_set('Asia/Kolkata');
    $date=date("Y-m-d h:i:s");
  
      $sql=mysqli_query($conn,"UPDATE `lead` SET `nature`='$nature',`remainder_date`='$remainder_date',`sitevisit_date`='$sitevisit_date' WHERE id='$id'");
      $qcheckremark=mysqli_query($conn,"select * from remarks where lead_id='$id'");
      if(mysqli_num_rows($qcheckremark)>0){
          $sql1=mysqli_query($conn,"update remarks set remark='$remark' , date_time='$date' where lead_id='$id'");
      }else{
       $sql1=mysqli_query($conn,"INSERT INTO `remarks`(`remark`,`lead_id`,`date_time`) VALUES ('$remark','$id','$date')");
      }
      if($sql==1){
          echo "Saved!", "data successfully submitted", "success";
          header("location:lead.php");
      }else {
          echo '<script>alert("oops...somthing went wrong");</script>';
      }
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Leads | CRM</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <style>
    .card-header {
      padding: 0px;
      background-color: rgba(0, 0, 0, .03);

    }

    .card-title {
      float: left;
      padding: 25px;
    }

    .toast-header strong {
      margin-right: 40px !important;
    }

    .toast-body {
      cursor: pointer;
    }
    .vl{
      border-left: 3px solid #f1f3f4;
      height: 100%;
      float:left;
    }
  </style>

</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">


    <?php
include("include/header.php");
include("include/sidebar.php");
?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Leads</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">Leads</li>
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
                    <h5 class="card-title">List of Leads</h5>
        
                  </div>
                
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Sr no.</th>

                        <th>Client Name</th>
                        <th>Client Mobile Number</th>
                        <th>Requirement</th>
                        <th>Created On</th>
                        <th>Source</th>
                        <th>Nature</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                   
                    <tbody id="display">
                      <?php
                          $sql=mysqli_query($conn,"select lead.*, client.*, lead.Mobile_Number from lead inner join client on client.Client_Code=lead.Firm_Name where lead.deal=0 and Client_Code='$id'");
                          $count=1;
                        while ($row=mysqli_fetch_array($sql)){ 
                                      ?>            
                      <tr>
                        <td><?php echo $count;?></td>
                        <td><?php echo $row['Client_Name']; ?></td>
                        <td><?php echo $row['Mobile_Number']; ?></td>
                        <td><?php echo $row['Requirement']; ?></td>
                        <td><?php echo $row['Created_On']; ?></td>
                        <td><?php echo $row['social_media']; ?></td>
                        <td><?php echo $row['nature']; ?></td>
                        <td style="text-align:center">

                          <a href="#m<?php echo $row['id'] ?>" class="btn btn-primary btn-rounded btn-icon usereditid"data-toggle="modal" data-id='<?php echo $row['id']; ?>' style="color: aliceblue"> <i
                              class="fas fa-pen"></i>
                          </button>

                          <a href="lead.php?delid=<?php echo $row['id']; ?>"><button type="button"
                              onclick="return confirm('Are you sure you want to delete this item')"
                              class="btn btn-danger btn-rounded btn-icon" style="color: aliceblue"><i
                                class="fas fa-trash"></i> </button></a>
                          <a href="lead.php?gen=<?php echo $row['id'];?>">
                            <button class="btn btn-warning" name="submit">Deals</button>
                          </a>
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
          <!-- /.row -->
        </div>

        <!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>


 <!-- Modal -->

 <div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="modal-box">
                <!-- Modal -->
                <?php 
                 $sql=mysqli_query($conn,"select lead.*, client.*, lead.Mobile_Number from lead inner join client on client.Client_Code=lead.Firm_Name where lead.deal=0 and Client_Code='$id'");
                 while ($row=mysqli_fetch_array($sql)){ 
                ?>
    <div class="modal fade" id="m<?php echo $row['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Update Leads</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form method="post" action="">
            <div class="modal-body body2">
            <div class="row">
    <div class="col-8">
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="inputName">Client Name : </label>
                    <?php echo $row['Client_Name']; ?>
                    <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="inputEmail">Mobile Number : </label>
                    <?php echo $row['Mobile_Number']; ?>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label>Source : </label>
                    <?php echo $row['social_media']; ?>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="inputEmail">Requirement : </label>
                    <?php echo $row['Requirement']; ?>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label>Nature</label>
                    <select class="form-control" name="nature" style="width: 100%;" onclick="drop<?php echo $row['id']; ?>()">
                        <option selected="selected" value="<?php echo $row['nature']; ?>"><?php echo $row['nature']; ?>
                        </option>
                        <option value="Hot">Hot</option>
                        <option value="Cold">Cold</option>
                        <option value="Warm">Warm</option>
                        <option value="Deal Closed">Deal Closed</option>
                        <option value="Site Visit" id="dropdown<?php echo $row['id']; ?>">Site Visit</option>
                    </select>
                </div>
            </div>
            <div class="col-3 " id="textt<?php echo $row['id']; ?>" style="display:none">
                <div class="form-group">
                    <?php
                    if($row['sitevisit_date']=='0000-00-00 00:00:00'){
                    ?>
                    <label>date : </label>
                    <input class="form-control" type="datetime-local" name="sitevisit_date">
                    <?php }else{ ?>
                    <label>date : </label>
                    <input class="form-control" type="text" value="<?php echo $row['sitevisit_date']; ?>" name="sitevisit_date" readonly>
                    <?php } ?>
                </div>
            </div>
            <?php $leadId=$row['id'];
            $qremark=mysqli_query($conn,"select * from remarks where lead_id='$leadId'");
            $fremark=mysqli_fetch_array($qremark);
            ?>
            <div class="col-6">
                <div class="form-group">
                    <label for="inputEmail">Remark : </label></br>
                    <?php  if(mysqli_num_rows($qremark)>0){ ?>
                    <textarea name="remark" class="form-control" style="width: 100%;resize: none;"><?php echo $fremark['remark'];  ?></textarea>
                    <?php }else{ ?>
                     <textarea name="remark" class="form-control" style="width: 100%;resize: none;"></textarea>
                     <?php } ?>
                </div>
            </div>
                <div class="col-6">
                    <div class="form-group">
                        <input type="checkbox" id="myCheck<?php echo $row['id'] ?>" name="" value="remainder"
                            onclick="myFunction<?php echo $row['id'] ?>()">
                        <label for="Remainder">Remainder </label>
                        
                        <div class="col-12 text" id="text<?php echo $row['id'] ?>" style="display:none">
                            <div class="form-group">
                                <?php
                    if($row['remainder_date']=='0000-00-00 00:00:00'){
                    ?>
                                <label>date : </label>
                                <input class="form-control" type="datetime-local" name="remainder_date">
                                <?php }else{ ?>
                                <label>date : </label>
                                <input class="form-control" type="text" value="<?php echo $row['remainder_date']; ?>" name="remainder_date">
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <script>
                      function drop<?php echo $row['id']; ?>() {
                        var select = document.getElementById("dropdown<?php echo $row['id']; ?>");
                        var text = document.getElementById("textt<?php echo $row['id']; ?>");
                        if (select.selected == true) {
                          text.style.display = "block";
                        } else {
                          text.style.display = "none";
                        }
                      }
                    </script>
                    <script>
                      function myFunction<?php echo $row['id'] ?>() {
                        let checkBox = document.getElementById("myCheck<?php echo $row['id'] ?>");
                        let text = document.getElementById("text<?php echo $row['id'] ?>");
                        if (checkBox.checked == true) {
                          text.style.display = "block";
                        } else {
                          text.style.display = "none";
                        }
                      }
                    </script>
            </div>
        </div>
    </div>
   
    <div class="col-4">
<div class="vl"></div>
<ul class="sessions"style="overflow:scroll;height:300px" >
    <?php
    $lead_id=$row['id'];
    $sql1=mysqli_query($conn,"select * from remarks where lead_id='$lead_id' order by id desc; ");
    while ($row=mysqli_fetch_array($sql1)){ 
    
    ?>

  <li>
    <div class="time"><?php echo $row['date_time']; ?></div>
    <p><?php echo $row['remark']; ?></p>
  </li>
  <?php

} ?>
 </div>
            </div>
                 </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" name="update" class="btn btn-primary">Update</button>
            </div>
          </form>
        </div>
      </div>
    </div>
   
<?php } ?>

 </div>
</div>
</div>
</div>
    <!-- /.content-wrapper -->
    <?php include("include/footer.php");?>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

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
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <!-- Page specific script -->
  <script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
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


  <script>
    // $(document).ready(function () {
    //   $('.usereditid').click(function () {
    //     let dnk = $(this).data('id');

    //     $.ajax({
    //       url: 'ac.php',
    //       type: 'post',
    //       data: {
    //         dnk: dnk
    //       },
    //       success: function (response1) {
    //         $('.body2').html(response1);
    //         $('#dnkModal').modal('show');
    //       }
    //     });
    //   });


    // });
  </script>
  
<script>
  function get_fb(){
    var feedback = $.ajax({
        type: "POST",
        url: "actionTableLead.php",
        async: false,
        success :function (feedback){
        $('#display').html(feedback);
        }
    })
}
get_fb(); // This will run on page load
setInterval(function(){
  get_fb(); // this will run after every 5 seconds
}, 10000);
</script>
</body>

</html>