<?php
session_start();
include("config.php");
if(isset($_POST['fetch'])){
    $fetch=$_POST['fetch'];
    $id=$_POST['leadid'];
    if($fetch == 'Today'){
    echo '
         <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
              <div class="inner"> ';
              $query=mysqli_query($conn,"select * from lead where Firm_Name='$id' and  date(Created_On)=date(now())");
               $count1=mysqli_num_rows($query);
              echo ' <h3>'.$count1.'</h3>

                <p>Total Leads</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="lead.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">';
              $query=mysqli_query($conn,"select * from lead where status_deal='Open' and  date(Created_On)=date(now()) and Firm_Name='$id'");
               $count1=mysqli_num_rows($query);
              echo '<h3>'. $count1 .'</h3>

                <p>New Leads</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="lead.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">';
              $query=mysqli_query($conn,"select * from lead where status_deal='Closed'  and  date(Created_On)=date(now()) and Firm_Name='$id'");
               $count1=mysqli_num_rows($query);
               echo '<h3>'. $count1.'</h3>

                <p>Closed Leads</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="lead.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->

          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">';
              $query=mysqli_query($conn,"select * from ticket where client_code='$id' and  date(date)=date(now())");
               $count1=mysqli_num_rows($query);
              echo ' <h3>'. $count1.'</h3>

                <p>Total No of Ticket</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="lead.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->';
}
else if($fetch == 'Last Week'){
    echo '
         <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
              <div class="inner"> ';
              $query=mysqli_query($conn,"select * from lead where Firm_Name='$id' and  YEARWEEK(Created_On) = YEARWEEK(NOW() - INTERVAL 1 WEEK)");
               $count1=mysqli_num_rows($query);
              echo ' <h3>'.$count1.'</h3>

                <p>Total Leads</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="lead.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">';
              $query=mysqli_query($conn,"select * from lead where status_deal='Open' and  YEARWEEK(Created_On) = YEARWEEK(NOW() - INTERVAL 1 WEEK) and Firm_Name='$id'");
               $count1=mysqli_num_rows($query);
              echo '<h3>'. $count1 .'</h3>

                <p>New Leads</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="lead.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">';
              $query=mysqli_query($conn,"select * from lead where status_deal='Closed'  and  YEARWEEK(Created_On) = YEARWEEK(NOW() - INTERVAL 1 WEEK) and Firm_Name='$id'");
               $count1=mysqli_num_rows($query);
               echo '<h3>'. $count1.'</h3>

                <p>Closed Leads</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="lead.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->

          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">';
              $query=mysqli_query($conn,"select * from ticket where client_code='$id' and  YEARWEEK(date) = YEARWEEK(NOW() - INTERVAL 1 WEEK)");
               $count1=mysqli_num_rows($query);
              echo ' <h3>'. $count1.'</h3>

                <p>Total No of Ticket</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="lead.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->';
}
else if($fetch == 'Monthly'){
    echo '
         <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
              <div class="inner"> ';
              $query=mysqli_query($conn,"select * from lead where Firm_Name='$id' and  Created_On > DATE_SUB(NOW(), INTERVAL 1 MONTH)");
               $count1=mysqli_num_rows($query);
              echo ' <h3>'.$count1.'</h3>

                <p>Total Leads</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="lead.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">';
              $query=mysqli_query($conn,"select * from lead where status_deal='Open' and Created_On > DATE_SUB(NOW(), INTERVAL 1 MONTH) and Firm_Name='$id'");
               $count1=mysqli_num_rows($query);
              echo '<h3>'. $count1 .'</h3>

                <p>New Leads</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="lead.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">';
              $query=mysqli_query($conn,"select * from lead where status_deal='Closed'  and Created_On > DATE_SUB(NOW(), INTERVAL 1 MONTH) and Firm_Name='$id'");
               $count1=mysqli_num_rows($query);
               echo '<h3>'. $count1.'</h3>

                <p>Closed Leads</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="lead.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->

          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">';
              $query=mysqli_query($conn,"select * from ticket where client_code='$id' and date > DATE_SUB(NOW(), INTERVAL 1 MONTH)");
               $count1=mysqli_num_rows($query);
              echo ' <h3>'. $count1.'</h3>

                <p>Total No of Ticket</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="lead.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->';
}
else if($fetch == '3 Month'){
    echo '
         <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
              <div class="inner"> ';
              $query=mysqli_query($conn,"select * from lead where Firm_Name='$id' and  Created_On >= DATE(NOW()) - INTERVAL 3 MONTH");
               $count1=mysqli_num_rows($query);
              echo ' <h3>'.$count1.'</h3>

                <p>Total Leads</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="lead.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">';
              $query=mysqli_query($conn,"select * from lead where status_deal='Open' and Created_On >= DATE(NOW()) - INTERVAL 3 MONTH and Firm_Name='$id'");
               $count1=mysqli_num_rows($query);
              echo '<h3>'. $count1 .'</h3>

                <p>New Leads</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="lead.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">';
              $query=mysqli_query($conn,"select * from lead where status_deal='Closed'  and Created_On >= DATE(NOW()) - INTERVAL 3 MONTH and Firm_Name='$id'");
               $count1=mysqli_num_rows($query);
               echo '<h3>'. $count1.'</h3>

                <p>Closed Leads</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="lead.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->

          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">';
              $query=mysqli_query($conn,"select * from ticket where client_code='$id' and date >= DATE(NOW()) - INTERVAL 3 MONTH");
               $count1=mysqli_num_rows($query);
              echo ' <h3>'. $count1.'</h3>

                <p>Total No of Ticket</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="lead.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->';
}
}
?>