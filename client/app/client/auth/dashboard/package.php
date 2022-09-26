<?php
session_start();
include("config.php");

$packageId=$_GET['packageId'];

//lead delete
if(isset($_GET['delid'])){
    $id=mysqli_real_escape_string($conn,$_GET['delid']);
    $sql=mysqli_query($conn,"delete from lead where id='$id'");
    if($sql=1){
        header("Location: package/".$packageId);
        exit;
    }
    }

    if(isset($_GET['gen'])){
      $id=mysqli_real_escape_string($conn,$_GET['gen']);
      $sql=mysqli_query($conn,"update lead set `deal`='1' where id='$id'");
      if($sql==1){
       header("location:deals.php");
      }
    }
    $id=$_SESSION['id'];
    mysqli_query($conn,"update lead set status=1 where Firm_Name=$id");   
    
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

  $packageId=$_GET['packageId'];
 $qcardpackage=mysqli_query($conn,"select *,package_assign.id as id from lead inner join package_assign on lead.package=package_assign.title inner join package on package_assign.lead_id=package.id where package_assign.firm_id='$id' and package_assign.id='$packageId'");
$fcardpackage=mysqli_fetch_array($qcardpackage);
$title= $fcardpackage['title'];

?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <base href="http://localhost:8000/tectignis_crm/client/app/client/auth/dashboard/">
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
    <link rel="shortcut icon" type="image/x-icon" href="app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600"
        rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/vendors.min.css">
        <!-- DataTables -->
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">

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

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="app-assets/css/core/menu/menu-types/vertical-menu.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <!-- END: Custom CSS-->
    <style>
        .badge-danger {
            background: red !important;
        }

        .badge-info {
            background: #ffff !important;
        }
    </style>
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
                <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">

                    <?php
                $qnotification=mysqli_query($conn,"SELECT * , package, count(package) as count, DATEDIFF(due_date, NOW()) AS date_diff FROM lead inner join package_assign on package_assign.title=lead.package  where package_assign.id='$packageId' and firm_id='$id' group by lead_id HAVING COUNT(lead_id) > 0");
                $fnotification=mysqli_fetch_array($qnotification);
               
                if($fnotification['date_diff']<=5){
                  echo '<span style="font-size:17px;margin:18px;" class="badge badge-danger">Only '.$fnotification['date_diff'].' days left</span>';
                }
                $calculateRemainingLead=$fcardpackage['total_lead']-$fnotification['count'];
                if($calculateRemainingLead<=10){
                  echo '<span style="font-size:17px;margin:18px;" class="badge badge-info">You have only'. $calculateRemainingLead.' leads</span>';
                }
                ?>
                </div>
            </div>
            <div class="content-body">
                <?php 
      date_default_timezone_set('Asia/Kolkata');
if((date('Y-m-d , h:i:s')) <= ($fcardpackage['due_date'])){
?>
                <section id="dashboard-ecommerce">
                    <div class="row">
                        <div class="col-md-3">
                            <form onclick="getdat(this.value)" style="float:left;padding: 15px 15px 0 15px;">
                                <input type="hidden" id="sessionid" value="<?php echo $id;?>">
                                <input type="hidden" id="packageid" value="<?php echo $title;?>">
                                <select id="demo_overview_minimal_multiselect" class="dropbtn form-control"
                                    style="background-color:#fff;">
                                    <option selected>Last Week</option>
                                    <option>Monthly</option>
                                    <option>3 Month</option>
                                </select>
                            </form>
                        </div>
                    </div>
                    <div class="row" id="status">
                        <div class="col-lg-3 col-sm-6">
                            <div class="card">
                                <div class="card-body d-flex align-items-center justify-content-between">
                                    <div>
                                        <?php $query=mysqli_query($conn,"select * from lead where Firm_Name='$id' and package='$title'");
                                            $count1=mysqli_num_rows($query);
                                            ?>
                                        <h3 class="fw-bolder mb-75"><?php echo $count1; ?></h3>
                                        <span>Total Lead</span>
                                    </div>
                                    <div class="avatar bg-light-primary p-50">
                                        <span class="avatar-content">
                                        <i class="far fa-user" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <div class="card">
                                <div class="card-body d-flex align-items-center justify-content-between">
                                    <div>
                                        <?php
                                              $query=mysqli_query($conn,"select * from lead where nature='Hot' and Firm_Name='$id' and package='$title'");
                                              $count1=mysqli_num_rows($query);
                                              ?>
                                        <h3 class="fw-bolder mb-75"><?php echo $count1; ?></h3>
                                        <span>Hot</span>
                                    </div>
                                    <div class="avatar bg-light-danger p-50">
                                        <span class="avatar-content">
                                        <i class="fas fa-user-plus" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <div class="card">
                                <div class="card-body d-flex align-items-center justify-content-between">
                                    <div>
                                        <?php
                                              $query=mysqli_query($conn,"select * from lead where nature='Cold' and Firm_Name='$id' and package='$title'");
                                              $count1=mysqli_num_rows($query);
                                              ?>
                                        <h3 class="fw-bolder mb-75"><?php echo $count1; ?></h3>
                                        <span>Cold</span>
                                    </div>
                                    <div class="avatar bg-light-success p-50">
                                        <span class="avatar-content">
                                        <i class="fas fa-user-check" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <div class="card">
                                <div class="card-body d-flex align-items-center justify-content-between">
                                    <div>
                                        <?php
                                              $query=mysqli_query($conn,"select * from lead where nature='Warm' and Firm_Name='$id' and package='$title'");
                                              $count1=mysqli_num_rows($query);
                                              ?>
                                        <h3 class="fw-bolder mb-75"><?php echo $count1; ?></h3>
                                        <span>Warm</span>
                                    </div>
                                    <div class="avatar bg-light-warning p-50">
                                        <span class="avatar-content">
                                        <i class="fas fa-user-times" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Basic table -->
                <section id="basic-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
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
                     
                          $qsql=mysqli_query($conn,"select *,lead.id as id, lead.Mobile_Number from lead inner join client on client.Client_Code=lead.Firm_Name inner join package_assign on package_assign.title=lead.package where lead.deal=0 and package_assign.id='$packageId' and client.Client_Code='$id' and lead.package='$title';");
                          $count=1;
                        while ($frow=mysqli_fetch_array($qsql)){ 
                                      ?>
                                            <tr>

                                                <td><?php echo $count;?></td>
                                                <td><?php echo $frow['Client_Name']; ?></td>
                                                <td><?php echo $frow['Mobile_Number']; ?></td>
                                                <td><?php echo $frow['Requirement']; ?></td>
                                                <td><?php echo $frow['Created_On']; ?></td>
                                                <td><?php echo $frow['social_media']; ?></td>
                                                <td><?php echo $frow['nature']; ?></td>
                                                <td style="text-align:center">

                                                    <button
                                                        class="btn btn-primary btn-rounded btn-icon usereditid"
                                                        data-bs-toggle="modal" data-bs-target="#m<?php echo $frow['id'] ?>" data-id='<?php echo $frow['id']; ?>'
                                                        style="color: aliceblue"> <i class="fas fa-pen"></i>
                                                        </button>

                                                        <a href="package?delid=<?php echo $frow['id']; ?>"><button
                                                                type="button"
                                                                onclick="return confirm('Are you sure you want to delete this item')"
                                                                class="btn btn-danger btn-rounded btn-icon"
                                                                style="color: aliceblue"><i class="fas fa-trash"></i>
                                                            </button></a>
                                                        <a href="package?gen=<?php echo $frow['id'];?>">
                                                            <button class="btn btn-warning" name="submit">Deals</button>
                                                        </a>
                                                </td>
                                            </tr>
                                            <?php $count++; } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </section>
                <!--/ Basic table -->

                <?php }
                else if($fcardpackage['total_amt']==$fcardpackage['first_payment']){ ?>
                <section id="dashboard-ecommerce">
                    <div class="row">
                        <div class="col-md-3">
                            <form onclick="getdat(this.value)" style="float:left;padding: 15px 15px 0 15px;">
                                <input type="hidden" id="sessionid" value="<?php echo $id;?>">
                                <input type="hidden" id="packageid" value="<?php echo $title;?>">
                                <select id="demo_overview_minimal_multiselect" class="dropbtn form-control"
                                    style="background-color:#fff;">
                                    <option selected>Last Week</option>
                                    <option>Monthly</option>
                                    <option>3 Month</option>
                                </select>
                            </form>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-sm-6">
                            <div class="card">
                                <div class="card-body d-flex align-items-center justify-content-between">
                                    <div>
                                        <?php $query=mysqli_query($conn,"select * from lead where Firm_Name='$id' and package='$title'");
                                            $count1=mysqli_num_rows($query);
                                            ?>
                                        <h3 class="fw-bolder mb-75"><?php echo $count1; ?></h3>
                                        <span>Total Lead</span>
                                    </div>
                                    <div class="avatar bg-light-primary p-50">
                                        <span class="avatar-content">
                                        <i class="far fa-user" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <div class="card">
                                <div class="card-body d-flex align-items-center justify-content-between">
                                    <div>
                                        <?php
                                              $query=mysqli_query($conn,"select * from lead where nature='Hot' and Firm_Name='$id' and package='$title'");
                                              $count1=mysqli_num_rows($query);
                                              ?>
                                        <h3 class="fw-bolder mb-75"><?php echo $count1; ?></h3>
                                        <span>Hot</span>
                                    </div>
                                    <div class="avatar bg-light-danger p-50">
                                        <span class="avatar-content">
                                        <i class="fas fa-user-plus" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <div class="card">
                                <div class="card-body d-flex align-items-center justify-content-between">
                                    <div>
                                        <?php
                                              $query=mysqli_query($conn,"select * from lead where nature='Cold' and Firm_Name='$id' and package='$title'");
                                              $count1=mysqli_num_rows($query);
                                              ?>
                                        <h3 class="fw-bolder mb-75"><?php echo $count1; ?></h3>
                                        <span>Cold</span>
                                    </div>
                                    <div class="avatar bg-light-success p-50">
                                        <span class="avatar-content">
                                        <i class="fas fa-user-check" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <div class="card">
                                <div class="card-body d-flex align-items-center justify-content-between">
                                    <div>
                                        <?php
                                              $query=mysqli_query($conn,"select * from lead where nature='Warm' and Firm_Name='$id' and package='$title'");
                                              $count1=mysqli_num_rows($query);
                                              ?>
                                        <h3 class="fw-bolder mb-75"><?php echo $count1; ?></h3>
                                        <span>Warm</span>
                                    </div>
                                    <div class="avatar bg-light-warning p-50">
                                        <span class="avatar-content">
                                        <i class="fas fa-user-times" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Basic table -->
                <section id="basic-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
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
                                        $qsql=mysqli_query($conn,"select *,lead.id as id, lead.Mobile_Number from lead inner join client on client.Client_Code=lead.Firm_Name inner join package_assign on package_assign.title=lead.package where lead.deal=0 and package_assign.id='$packageId' and client.Client_Code='$id' and lead.package='$title';");
                                        $count=1;
                                        while ($frow=mysqli_fetch_array($qsql)){ 
                                      ?>
                                            <tr>
                                                <td><?php echo $count;?></td>
                                                <td><?php echo $frow['Client_Name']; ?></td>
                                                <td><?php echo $frow['Mobile_Number']; ?></td>
                                                <td><?php echo $frow['Requirement']; ?></td>
                                                <td><?php echo $frow['Created_On']; ?></td>
                                                <td><?php echo $frow['social_media']; ?></td>
                                                <td><?php echo $frow['nature']; ?></td>
                                                <td style="text-align:center">

                                                    <a href="#m<?php echo $frow['id'] ?>"
                                                        class="btn btn-primary btn-rounded btn-icon usereditid"
                                                        data-toggle="modal" data-target="" data-id='<?php echo $frow['id']; ?>'
                                                        style="color: aliceblue"> <i class="fas fa-pen"></i>
                                                        </button></a>

                                                        <a href="package?delid=<?php echo $frow['id']; ?>"><button
                                                                type="button"
                                                                onclick="return confirm('Are you sure you want to delete this item')"
                                                                class="btn btn-danger btn-rounded btn-icon"
                                                                style="color: aliceblue"><i class="fas fa-trash"></i>
                                                            </button></a>
                                                        <a href="package?gen=<?php echo $frow['id'];?>">
                                                            <button class="btn btn-warning" name="submit">Deals</button>
                                                        </a>
                                                </td>
                                            </tr>
                                            <?php $count++; } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal to add new record -->
                    <div class="modal modal-slide-in fade" id="modals-slide-in">
                        <div class="modal-dialog sidebar-sm">
                            <form class="add-new-record modal-content pt-0">
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close">×</button>
                                <div class="modal-header mb-1">
                                    <h5 class="modal-title" id="exampleModalLabel">New Record</h5>
                                </div>
                                <div class="modal-body flex-grow-1">
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-fullname">Full Name</label>
                                        <input type="text" class="form-control dt-full-name"
                                            id="basic-icon-default-fullname" placeholder="John Doe"
                                            aria-label="John Doe" />
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-post">Post</label>
                                        <input type="text" id="basic-icon-default-post" class="form-control dt-post"
                                            placeholder="Web Developer" aria-label="Web Developer" />
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Email</label>
                                        <input type="text" id="basic-icon-default-email" class="form-control dt-email"
                                            placeholder="john.doe@example.com" aria-label="john.doe@example.com" />
                                        <small class="form-text"> You can use letters, numbers & periods </small>
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-date">Joining Date</label>
                                        <input type="text" class="form-control dt-date" id="basic-icon-default-date"
                                            placeholder="MM/DD/YYYY" aria-label="MM/DD/YYYY" />
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label" for="basic-icon-default-salary">Salary</label>
                                        <input type="text" id="basic-icon-default-salary" class="form-control dt-salary"
                                            placeholder="$12000" aria-label="$12000" />
                                    </div>
                                    <button type="button" class="btn btn-primary data-submit me-1">Submit</button>
                                    <button type="reset" class="btn btn-outline-secondary"
                                        data-bs-dismiss="modal">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </section>
                <?php }
else{
    echo "<div style=' text-align: center;
    height: 100%;
    position: relative;
    top: 50%;
    color: mediumvioletred;
    font-size: xxx-large;
    font-weight: bolder;'>Please Pay</div>";
}
?>

            </div>
            <?php 
                 $qclientsql=mysqli_query($conn,"select lead.*, client.*, lead.Mobile_Number from lead inner join client on client.Client_Code=lead.Firm_Name where lead.deal=0 and Client_Code='$id'");
                 while ($arr=mysqli_fetch_array($qclientsql)){ 
                ?>
            <div class="modal fade" id="m<?php echo $arr['id'] ?>">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Update Leads</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close">×</button>
                        </div>
                        <form method="post" action="">
                            <div class="modal-body body2">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group mt-2">
                                                    <label for="inputName">Client Name : </label>
                                                    <?php echo $arr['Client_Name']; ?>
                                                    <input type="hidden" name="id" value="<?php echo $arr['id'] ?>">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group mt-2">
                                                    <label for="inputEmail">Mobile Number : </label>
                                                    <?php echo $arr['Mobile_Number']; ?>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group mt-2">
                                                    <label>Source : </label>
                                                    <?php echo $arr['social_media']; ?>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group mt-2">
                                                    <label for="inputEmail">Requirement : </label>
                                                    <?php echo $arr['Requirement']; ?>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group mt-2">
                                                    <label>Nature</label>
                                                    <select class="form-control" name="nature" style="width: 100%;"
                                                        onclick="drop<?php echo $arr['id']; ?>()">
                                                        <option selected="selected"
                                                            value="<?php echo $arr['nature']; ?>">
                                                            <?php echo $arr['nature']; ?>
                                                        </option>
                                                        <option value="Hot">Hot</option>
                                                        <option value="Cold">Cold</option>
                                                        <option value="Warm">Warm</option>
                                                        <option value="Deal Closed">Deal Closed</option>
                                                        <option value="Site Visit"
                                                            id="dropdown<?php echo $arr['id']; ?>">Site Visit</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-3 " id="textt<?php echo $arr['id']; ?>"
                                                style="display:none">
                                                <div class="form-group mt-2">
                                                    <?php
                                                    if($arr['sitevisit_date']=='0000-00-00 00:00:00'){
                                                    ?>
                                                    <label>date : </label>
                                                    <input class="form-control" type="datetime-local"
                                                        name="sitevisit_date">
                                                    <?php }else{ ?>
                                                    <label>date : </label>
                                                    <input class="form-control" type="text"
                                                        value="<?php echo $arr['sitevisit_date']; ?>"
                                                        name="sitevisit_date" readonly>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                            <?php $leadId=$arr['id'];
                                            $qremark=mysqli_query($conn,"select * from remarks where lead_id='$leadId'");
                                            $fremark=mysqli_fetch_array($qremark);
                                            ?>
                                            <div class="col-6">
                                                <div class="form-group mt-2">
                                                    <label for="inputEmail">Remark : </label></br>
                                                    <?php  if(mysqli_num_rows($qremark)>0){ ?>
                                                    <textarea name="remark" class="form-control"
                                                        style="width: 100%;resize: none;"><?php echo $fremark['remark'];  ?></textarea>
                                                    <?php }else{ ?>
                                                    <textarea name="remark" class="form-control"
                                                        style="width: 100%;resize: none;"></textarea>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group mt-2">
                                                    <input type="checkbox" id="myCheck<?php echo $arr['id'] ?>" name=""
                                                        value="remainder"
                                                        onclick="myFunction<?php echo $arr['id'] ?>()">
                                                    <label for="Remainder">Remainder </label>

                                                    <div class="col-12 text" id="text<?php echo $arr['id'] ?>"
                                                        style="display:none">
                                                        <div class="form-group">
                                                            <?php
                                                            if($arr['remainder_date']=='0000-00-00 00:00:00'){
                                                            ?>
                                                            <label>date : </label>
                                                            <input class="form-control" type="datetime-local"
                                                                name="remainder_date">
                                                            <?php }else{ ?>
                                                            <label>date : </label>
                                                            <input class="form-control" type="text"
                                                                value="<?php echo $arr['remainder_date']; ?>"
                                                                name="remainder_date">
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <script>
                                                    function drop<?= $arr['id']; ?> () {
                                                        var select = document.getElementById(
                                                            "dropdown<?php echo $arr['id']; ?>");
                                                        var text = document.getElementById(
                                                            "textt<?php echo $arr['id']; ?>");
                                                        if (select.selected == true) {
                                                            text.style.display = "block";
                                                        } else {
                                                            text.style.display = "none";
                                                        }
                                                    }
                                                </script>
                                                <script>
                                                    function myFunction<?= $arr['id'] ?> () {
                                                        let checkBox = document.getElementById(
                                                            "myCheck<?php echo $arr['id'] ?>");
                                                        let text = document.getElementById(
                                                            "text<?php echo $arr['id'] ?>");
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
                                        <ul class="sessions" style="overflow:scroll;height:300px">
                                            <?php
                                            $lead_id=$arr['id'];
                                            $sql1=mysqli_query($conn,"select * from remarks where lead_id='$lead_id' order by id desc; ");
                                            while ($arr=mysqli_fetch_array($sql1)){ 
                                            
                                            ?>

                                            <li>
                                                <div class="time"><?php echo $arr['date_time']; ?></div>
                                                <p><?php echo $arr['remark']; ?></p>
                                            </li>
                                            <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                            <button type="reset" class="btn btn-outline-secondary"
                                        data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" name="update" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <?php } ?>

        </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>
    <?php include "include/footer.php"; ?>




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
        function getdat(val) {
            let packageid = $("#packageid").val();
            let sessionid = $("#sessionid").val();
            let dropbtn = $(".dropbtn").val();
            $.ajax({
                url: "actionTableLead.php",
                method: "POST",
                data: {
                    packageid: packageid,
                    sessionid: sessionid,
                    dropbtn: dropbtn
                },
                success: function (data) {
                    $('#status').html(data);
                }
            });
        }
    </script>
    <script>
          function get_fb(){
            let package_id=<?php echo $packageId ?>;
            let leadid= "<?php echo $title ?>";
            let feedback = $.ajax({
                type: "POST",
                data: {package_id:package_id,
                  leadid:leadid
                },
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
<!-- END: Body-->

</html>