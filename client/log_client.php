<?php
session_start();
include("config.php");
if(isset($_POST['login'])){
$Email=$_POST['emailid'];
$Password1=$_POST['password'];

$sql=mysqli_query($conn,"select * from client where Email='$Email' AND Status='Activated'");

if(mysqli_num_rows($sql)>0){
  $row=mysqli_fetch_assoc($sql); 
  $verify=password_verify($Password1,$row['Password']);

 if($verify==1){
   $_SESSION['aname']=$row['Authorized_Name'];
     $_SESSION['id']=$row['Client_Code'];
     $_SESSION['fname']=$row['Firm_Name'];
        header("location:index.php");
    }else{
        echo "<script>alert('Password is incorrect');</script>";
    }
}
else{
    echo "<script>alert('Invalid Email Id');</script>";
}
}

if(isset($_POST['raiseticket'])){
  $firm_name=$_POST['Firm_Name'];
  $clientname=$_POST['clientname'];
  $mobile=$_POST['mobile'];
  $Email=$_POST['Email'];
  $Description=$_POST['Description'];
  date_default_timezone_set('Asia/Kolkata');
$date = date('d-m-y h:i:s');
  $status="Open";
      $qraise=mysqli_query($conn,"INSERT INTO `support`(`firm_name`, `client_name`, `mobile`, `email`, `description`,`status`,`date`) VALUES ('$firm_name','$clientname','$mobile','$Email','$Description','$status','$date')");
      if($qraise){
        echo "<script>alert('Ticket Raised Successfully. Please wait Our teams will solve issue');</script>";
      }
      else{
        echo "<script>alert('Ticket Raised Failed');</script>";
      }
  }
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">


  <style>
    .container {
      /* padding: 60px;
      padding-top: 0;
      height: 200px;
      background-color: #0a0a23; */
    }
    .gradient-custom-2 {
background: #fccb90;

background: -webkit-linear-gradient(to right, #ee7724, #d8363a, #dd3675, #b44593);

background: linear-gradient(to right, #ee7724, #d8363a, #dd3675, #b44593);
}

@media (min-width: 768px) {
.gradient-form {
height: 100vh !important;
}
}
@media (min-width: 769px) {
.gradient-custom-2 {
border-top-right-radius: .3rem;
border-bottom-right-radius: .3rem;
}
}
    img {
      margin-left: 105px;
      width: 363px;
      margin-top: 80px;
    }

    .text {
      text-decoration: solid;
      color: #ffffff;
      margin-top: 20px;
    }

    .text1 {
      width: 53%;
      padding: 5px 20px;
      margin: 5px 0;
      display: inline-block;
      border: 1px solid #ccc;
      border-radius: 5px;
      box-sizing: border-box;
    }

    .submit {

      background-color: #6fd943;
      padding: 5px 20px;
      color: white;
      font-size: 14px;
      margin: 04px;
      border-radius: 5px;
      border-style: none;
    }

    .t {



      font-family: 'Inria Sans';
      font-style: normal;
      font-weight: 400;
      font-size: 24px;
      line-height: 43px;

      color: #ffffff;

    }

    .t1 {
      font-family: 'Inria Sans';
      font-style: normal;
      font-weight: 400;
      font-size: 16px;
      line-height: 24px;

      color: #FFFFFF;
    }

    @media screen and (min-width: 480px) {
      img {
        width: 400px;
      }
    }
  </style>
</head>

<body>
 <!--modal-->
 <div class="modal fade" id="myModal" data-easein="whirlIn">
          <div class="modal-dialog">
            <div class="modal-content">

              <!-- Modal Header -->
              <div class="modal-header">
                <h4 class="modal-title w-100 text-center">Raise Ticket</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>

              <!-- Modal body -->
              <div class="modal-body">
                <!-- adding Bootstrap Form here -->

                <form method="post" id="myForm" class="needs-validation" novalidate>
                  <div class="container">

                    <div class="form-group row">
                      <label for="id" class="col-sm-3 col-form-label">Firm Name</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="name_id" name="Firm_Name"
                          placeholder="Enter your Firm Name" required />

                        <div class="invalid-feedback">
                          Please choose a Name.
                        </div>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="validationCustomUsername" class="col-sm-3 col-form-label">Client Name</label>
                      <div class="input-group col-sm-9">

                        <input type="text" class="form-control" id="username_id" name="clientname"
                          placeholder="Enter your Client Name" aria-describedby="inputGroupPrepend" required>
                        <div class="invalid-feedback">
                          Please choose a username.
                        </div>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="id" class="col-sm-3 col-form-label">Mobile Number</label>
                      <div class="col-sm-9">
                        <input type="tel" class="form-control" id="mobile" minlength="10" maxlength="10" name="mobile"
                          placeholder="Enter your Mobile Number" required />
                        <div class="invalid-feedback">
                          Please choose a Password.
                        </div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="id" class="col-sm-3 col-form-label">Email</label>
                      <div class="col-sm-9">
                        <input type="email" class="form-control" id="email_id" name="Email"
                          placeholder="Enter your Email" required />
                        <div class="invalid-feedback">
                          Please choose a Email.
                        </div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="id" class="col-sm-3 col-form-label">Description</label>
                      <div class="col-sm-9">
                        <textarea class="form-control" id="description_id" name="Description"
                          placeholder="Enter your Description" required></textarea>
                        <div class="invalid-feedback">
                          Please choose a Description.
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <div class="text-center">
                      <button class="btn btn-primary btn-block fa-lg gradient-custom-2" name="raiseticket"
                        type="submit">Submit</button>
                    </div>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                  </div>
                </form>

                <script>

                </script>
              </div>

              <!-- Modal footer -->


            </div>
          </div>
        </div>

        <!-- Modal -->
  <div class="main-contaainer">
    <div class="row" style="margin: 20px; height: max-content;">

      <div class="col-6" style="background-color:#ffffff;  height: max-content;border-radius: 10px 0 0 10px;">
        <form style="margin-top:23%;margin-left:23%;" method="post">
          <h3 style="font-family: Arial, Helvetica, sans-serif; font-size:25px;">Login</h3>
          <div class="">
            <div class="d-flex align-items-center justify-content-between">
              <div>
                <label class="form-label">Email</label>
              </div>
            </div>
            <input type="text" class="form-control text1" name="emailid" required autofocus>
          </div>
          <div class="">
            <div class="d-flex align-items-center justify-content-between">
              <div>
                <label class="form-label">Password</label>
              </div>
            </div>
            <input type="password" class="form-control text1" name="password" required>
          </div>
          <div class=" mb-6">
            <div class="mb-">
              <div class="text-left" style="font-size:12px;font-family:serif,Times New Roman"> Forgot your password?
              </div>
            </div>
          </div>
          <div class="">
            <div class="mb-">
              <div class="text-left" style="font-size:12px;font-family:serif,Times New Roman">You Have Any Issue?
                <a href="#myModal" class="text-muted" data-toggle="modal" data-target="#myModal">click here</a>
              </div>
            </div>
          </div>
          <br>
          <div class="d-grid">
            <input type="submit" class="submit" value="Login" name="login" style="width:51%;font-family:Inria Sans;">
          </div>
        </form>
      </div>
      <div class="col-6 container" style="background-color:#6fd943; height: max-content; border-radius:24px;">
        <div style="margin-top:9px;">
          <img src="img-auth-3.svg" alt="FCC Logo" />

        </div>
        <div class="text t">
          <p>
            <b style="    margin-left: 130px;">“Attention is the new currency”</b>
          </p>
        </div>
       
        <div class="t1">
          <p>
            <h6 style="    margin-left: 130px; ">The more effortless the writing looks, the more effort the <br>
              writer actually put into the process.</h6>
          </p>
        </div>

      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js">
  </script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>