<?php
session_start();
$id=$_SESSION['id'];
include("config.php");
if(isset($_POST['fetch'])){
    $fetch=$_POST['fetch'];
    $id=$_POST['leadid'];
    if($fetch == 'Today'){
    echo '
     <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box"  style="background:#ffad08;color:white">
              <div class="inner">';
              $query=mysqli_query($conn,"select * from lead where status_deal='Open' and  date(Created_On)=date(now()) and Firm_Name='$id'");
               $count1=mysqli_num_rows($query);
              echo '<h3>'. $count1 .'</h3>

                <p>New Leads</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
          
            </div>
          </div>
          <!-- ./col -->
         <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box"  style="background:#984c89;color:white">
              <div class="inner"> ';
              $query=mysqli_query($conn,"select * from lead where Firm_Name='$id' and  date(Created_On)=date(now())");
               $count1=mysqli_num_rows($query);
              echo ' <h3>'.$count1.'</h3>

                <p>Total Leads</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
           
            </div>
          </div>
          <!-- ./col -->
         
          
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box"  style="background:#e02b2b;color:white">
              <div class="inner">';
              $query=mysqli_query($conn,"select * from lead where status_deal='Closed'  and  date(Created_On)=date(now()) and Firm_Name='$id'");
               $count1=mysqli_num_rows($query);
               echo '<h3>'. $count1.'</h3>

                <p>Closed Leads</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
             
            </div>
          </div>
          <!-- ./col -->

          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box"  style="background:#6f58ce;color:white">
              <div class="inner">';
               $qBooked=mysqli_query($conn,"select * from lead where status_deal='Booked' and date(Created_On)=date(now()) and Firm_Name='$id'");
               $nBookedFetch=mysqli_num_rows($qBooked);
              echo ' <h3>'. $nBookedFetch.'</h3>

                <p>Total Booked</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
            
            </div>
          </div>
          <!-- ./col -->';
}
else if($fetch == 'Last Week'){
    echo '
     <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box"  style="background:#ffad08;color:white">
              <div class="inner">';
              $query=mysqli_query($conn,"select * from lead where status_deal='Open' and  YEARWEEK(Created_On) = YEARWEEK(NOW() - INTERVAL 1 WEEK) and Firm_Name='$id'");
               $count1=mysqli_num_rows($query);
              echo '<h3>'. $count1 .'</h3>

                <p>New Leads</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
          
            </div>
          </div>
          <!-- ./col -->
         <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box "  style="background:#984c89;color:white">
              <div class="inner"> ';
              $query=mysqli_query($conn,"select * from lead where Firm_Name='$id' and  YEARWEEK(Created_On) = YEARWEEK(NOW() - INTERVAL 1 WEEK)");
               $count1=mysqli_num_rows($query);
              echo ' <h3>'.$count1.'</h3>

                <p>Total Leads</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
             
            </div>
          </div>
          <!-- ./col -->
         
          
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box "  style="background:#e02b2b;color:white">
              <div class="inner">';
              $query=mysqli_query($conn,"select * from lead where status_deal='Closed'  and  YEARWEEK(Created_On) = YEARWEEK(NOW() - INTERVAL 1 WEEK) and Firm_Name='$id'");
               $count1=mysqli_num_rows($query);
               echo '<h3>'. $count1.'</h3>

                <p>Closed Leads</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>

            </div>
          </div>
          <!-- ./col -->

          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box"  style="background:#6f58ce;color:white">
              <div class="inner">';
               $qBooked=mysqli_query($conn,"select * from lead where status_deal='Booked' and YEARWEEK(Created_On) = YEARWEEK(NOW() - INTERVAL 1 WEEK) and Firm_Name='$id'");
               $nBookedFetch=mysqli_num_rows($qBooked);
              echo ' <h3>'. $nBookedFetch.'</h3>

                <p>Total No of Ticket</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
         
            </div>
          </div>
          <!-- ./col -->';
}
else if($fetch == 'Monthly'){
    echo '
    <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box"  style="background:#ffad08;color:white">
              <div class="inner">';
              $query=mysqli_query($conn,"select * from lead where status_deal='Open' and Created_On > DATE_SUB(NOW(), INTERVAL 1 MONTH) and Firm_Name='$id'");
               $count1=mysqli_num_rows($query);
              echo '<h3>'. $count1 .'</h3>

                <p>New Leads</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
           
            </div>
          </div>
          <!-- ./col -->
         <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box"  style="background:#984c89;color:white">
              <div class="inner"> ';
              $query=mysqli_query($conn,"select * from lead where Firm_Name='$id' and  Created_On > DATE_SUB(NOW(), INTERVAL 1 MONTH)");
               $count1=mysqli_num_rows($query);
              echo ' <h3>'.$count1.'</h3>

                <p>Total Leads</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
          
            </div>
          </div>
          <!-- ./col -->
          
          
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box"  style="background:#e02b2b;color:white">
              <div class="inner">';
              $query=mysqli_query($conn,"select * from lead where status_deal='Closed'  and Created_On > DATE_SUB(NOW(), INTERVAL 1 MONTH) and Firm_Name='$id'");
               $count1=mysqli_num_rows($query);
               echo '<h3>'. $count1.'</h3>

                <p>Closed Leads</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
         
            </div>
          </div>
          <!-- ./col -->

          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box"  style="background:#6f58ce;color:white">
              <div class="inner">';
              $qBooked=mysqli_query($conn,"select * from lead where status_deal='Booked' and Created_On > DATE_SUB(NOW(), INTERVAL 1 MONTH) and Firm_Name='$id'");
               $nBookedFetch=mysqli_num_rows($qBooked);
              echo ' <h3>'. $nBookedFetch.'</h3>

                <p>Total No of Ticket</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>

            </div>
          </div>
          <!-- ./col -->';
}
else if($fetch == '3 Month'){
    echo '
        <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box"  style="background:#ffad08;color:white">
              <div class="inner">';
              $query=mysqli_query($conn,"select * from lead where status_deal='Open' and Created_On >= DATE(NOW()) - INTERVAL 3 MONTH and Firm_Name='$id'");
               $count1=mysqli_num_rows($query);
              echo '<h3>'. $count1 .'</h3>

                <p>New Leads</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>

            </div>
          </div>
          <!-- ./col -->
         <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box"  style="background:#984c89;color:white">
              <div class="inner"> ';
              $query=mysqli_query($conn,"select * from lead where Firm_Name='$id' and  Created_On >= DATE(NOW()) - INTERVAL 3 MONTH");
               $count1=mysqli_num_rows($query);
              echo ' <h3>'.$count1.'</h3>

                <p>Total Leads</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>

            </div>
          </div>
          <!-- ./col -->
      
          
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box"  style="background:#e02b2b;color:white">
              <div class="inner">';
              $query=mysqli_query($conn,"select * from lead where status_deal='Closed'  and Created_On >= DATE(NOW()) - INTERVAL 3 MONTH and Firm_Name='$id'");
               $count1=mysqli_num_rows($query);
               echo '<h3>'. $count1.'</h3>

                <p>Closed Leads</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>

            </div>
          </div>
          <!-- ./col -->

          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box"  style="background:#6f58ce;color:white">
              <div class="inner">';
              $qBooked=mysqli_query($conn,"select * from lead where status_deal='Booked' and Created_On >= DATE(NOW()) - INTERVAL 3 MONTH and Firm_Name='$id'");
              $nBookedFetch=mysqli_num_rows($qBooked);
              echo ' <h3>'. $nBookedFetch.'</h3>

                <p>Total No of Ticket</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>

            </div>
          </div>
          <!-- ./col -->';
}
}
?>

<?php
date_default_timezone_set('Asia/Kolkata');
$qleadTimer=mysqli_query($conn,"select Client_Name,Requirement , remainder_date, (DATE_FORMAT(remainder_date,'%H')) AS 'hour', (DATE_FORMAT(remainder_date,'%i')) AS 'min',(date(remainder_date)) AS 'date' from lead where Firm_Name='$id'");
$nreminder=mysqli_num_rows($qleadTimer);
while($freminder=mysqli_fetch_array($qleadTimer)){
$leadhour=$freminder['hour'];
$minusleadhour=$leadhour-1;
$leadmin=$freminder['min'];
$leaddate=$freminder['date'];
$Requirement=$freminder['Requirement'];
    if($leaddate == date('Y-m-d')){
        if($minusleadhour == date('H') && $leadmin == date('i')){
          $time=date("$leaddate $leadhour:$leadmin");
          $timestamp = strtotime($time);
          $timestamp_one_hour_later = $timestamp - 3600; // 3600 sec. = 1 hour
          $cur=date("Y-m-d H:i");
          $timestamp1 = strtotime($cur);
          if ($timestamp1 == $timestamp_one_hour_later) {
              echo "Follow up of lead ".$Client_Name. "for" .$Requirement;
          } else {
              echo "false";
          }
        }
    }
}

?>

