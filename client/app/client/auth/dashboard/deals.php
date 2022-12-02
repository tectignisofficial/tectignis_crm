<?php
session_start();
include("config.php");
$uid = $_SESSION['aname'];

if(isset($_GET['delid'])){
    $id=mysqli_real_escape_string($conn,$_GET['delid']);
    $sql=mysqli_query($conn,"delete from lead where id='$id'");
    if($sql=1){
        header("location:deals.php");
    }
    }
?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="description"
        content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords"
        content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>DataTables - Vuexy - Bootstrap HTML admin template</title>
    <link rel="apple-touch-icon" href="app-assets/images/ico/apple-icon-120.png">
    
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600"
        rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/vendors.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- END: Page CSS-->
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="app-assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/colors.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/components.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/themes/dark-layout.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/themes/bordered-layout.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/themes/semi-dark-layout.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="app-assets/css/core/menu/menu-types/vertical-menu.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <!-- END: Custom CSS-->
    <?php
    $logosql=mysqli_query($conn,'select * from setting_system');
    $fetchlogo=mysqli_fetch_array($logosql);
    ?>
      <link rel="shortcut icon" type="image/x-icon" href="../../../../../admin/images/favicon/<?php echo $fetchlogo['fav'] ?>">
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern  navbar-floating footer-static  " data-open="click"
    data-menu="vertical-menu-modern" data-col="">

    <?php include "include/header.php"; ?>
    <?php include "include/sidebar.php"; ?>
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">Monika</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Clients</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Client Details</a>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="content-body">


                <div class="row">
                    <div class="col-12">

                        <!-- /.card -->

                        <div class="card">
                            <div class="card-header border-bottom p-1">
                                <div class="head-label">
                                    <h6 class="mb-0">List of Deal</h6>
                                </div>
                                
                            </div>

                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Sr no.</th>

                                            <th>Client Name</th>
                                            <th>Client Mobile Number</th>
                                            <th>Requirement</th>
                                            <th>Created On</th>

                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                     $sql=mysqli_query($conn,"select lead.*, client.* from lead inner join client on client.Client_Code=lead.Firm_Name where lead.deal='1' and Client_Code='$id'");
                     $count=1;
                         while($arr=mysqli_fetch_array($sql)){
          ?>
                                        <tr>
                                            <td><?php echo $count;?></td>

                                            <td><?php echo $arr['Client_Name']; ?></td>
                                            <td><?php echo $arr['Mobile_Number']; ?></td>
                                            <td><?php echo $arr['Requirement']; ?></td>
                                            <td><?php echo $arr['Created_On']; ?></td>

                                            <td><?php 
                
                $status_deal=$arr['status_deal']; 
               if($status_deal=='Open'){
                echo '<span class="badge badge-success">Open</span>';
            }
            else if($status_deal=='In Process'){
                echo '<span class="badge badge-primary">In Process</span>';
            }
            else if($status_deal=='On Hold'){
                echo '<span class="badge badge-warning">On Hold</span>';
            }
            else if($status_deal=='Booked'){
              echo '<span class="badge badge-info">Booked</span>';
          }
            else if($status_deal=='Closed Deal'){
                echo '<span class="badge badge-danger">Closed Deal</span>';
            }
                
                ?>

                                            </td>
                                            <td style="text-align:center">

                                                <button class="btn btn-sm btn-primary dnkediti"
                                                    data-id='<?php echo $arr['id']; ?>'><i
                                                        class="fas fa-eye"></i></button>

                                                <a href="deals.php?delid=<?php echo $arr['id']; ?>"><button type="button"
                                                        onclick="return confirm('Are you sure you want to delete this item')"
                                                        class="btn btn-danger btn-rounded btn-icon"
                                                        style="color: aliceblue"> <i class="fas fa-trash"></i>
                                                    </button></a>
                                            </td>
                                        </tr>
                                        <?php $count++; } ?>

                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
                <!-- Basic table -->

                <!--/ Basic table -->



            </div>
        </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>
    <?php include "include/footer.php"; ?>

    <div class="modal fade" id="dnkModal1">
        <div class="modal-dialog">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Update Leads</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close">×</button>
                        </div>
                    <form method="post" action="dealmodal.php">

                        
                        <div class="modal-body">
                            <div class=" body1">
                            </div>
                        </div>

                        <div class="modal-footer">
                        <button type="reset" class="btn btn-outline-secondary"
                                        data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary" name="save">Save</button>
        </div>
                    </form>
                </div>

                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        </div>

        <!-- BEGIN: Vendor JS-->
        <script src="app-assets/vendors/js/vendors.min.js"></script>
        <!-- BEGIN Vendor JS-->

        <!-- BEGIN: Page Vendor JS-->
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
        <script src="app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js"></script>
        <!-- END: Page Vendor JS-->

        <!-- BEGIN: Theme JS-->
        <script src="app-assets/js/core/app-menu.js"></script>
        <script src="app-assets/js/core/app.js"></script>
        <!-- END: Theme JS-->

        <!-- BEGIN: Page JS-->
        <!-- <script src="app-assets/js/scripts/tables/table-datatables-basic.js"></script> -->
        <!-- END: Page JS-->
        <script>
            $(function () {
                $("#example1").DataTable({
                    "responsive": true,
                    "lengthChange": true,
                    "autoWidth": false,
                    "buttons": ["copy", "csv", "excel", "pdf", "print"]
                }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

            });
        </script>


        <script>
            $(window).on('load', function () {
                if (feather) {
                    feather.replace({
                        width: 14,
                        height: 14
                    });
                }
            })
        </script>
        <script>
            $(document).ready(function () {
                $('.dnkediti').click(function () {
                    let dealsta = $(this).data('id');

                    $.ajax({
                        url: 'actionTableLead.php',
                        type: 'post',
                        data: {
                            dealsta: dealsta
                        },
                        success: function (response1) {
                            $('.body1').html(response1);
                            $('#dnkModal1').modal('show');
                        }
                    });
                });
            });
        </script>
        <script>
            $(document).ready(function () {
                $('.dnkediti1').click(function () {
                    let dnkidno1 = $(this).data('id');

                    $.ajax({
                        url: 'actionTableLead.php',
                        type: 'post',
                        data: {
                            dnkidno1: dnkidno1
                        },
                        success: function (response1) {
                            $('.body2').html(response1);
                            $('#dnkModal2').modal('show');
                        }
                    });
                });
            });
        </script>
</body>
<!-- END: Body-->

</html>