
<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if(isset($_POST['submit']))
  { 
    $password1=($_POST['newpassword']); 
    $password2=($_POST['confirmpassword']); 
   if($password1 != $password2)
    {
      echo "<script>alert('Password and Confirm Password Field do not match  !!');</script>";
    }else
    {
      $email=$_POST['email'];
      $mobile=$_POST['mobile'];
      $newpassword=md5($_POST['newpassword']);
      $sql ="SELECT Email FROM tbladmin WHERE Email=:email and MobileNumber=:mobile";
      $query= $dbh -> prepare($sql);
      $query-> bindParam(':email', $email, PDO::PARAM_STR);
      $query-> bindParam(':mobile', $mobile, PDO::PARAM_STR);
      $query-> execute();
      $results = $query -> fetchAll(PDO::FETCH_OBJ);
      if($query -> rowCount() > 0)
      {
      $con="update tbladmin set Password=:newpassword where Email=:email and MobileNumber=:mobile";
      $chngpwd1 = $dbh->prepare($con);
      $chngpwd1-> bindParam(':email', $email, PDO::PARAM_STR);
      $chngpwd1-> bindParam(':mobile', $mobile, PDO::PARAM_STR);
      $chngpwd1-> bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
      $chngpwd1->execute();
      echo "<script>alert('Your Password succesfully changed');</script>";
      }
      else {
      echo "<script>alert('Email id or Mobile no is invalid');</script>"; 
      }
    }
  }

?>
<!DOCTYPE html>
<html lang="en">
  <?php @include("includes/head.php");?>
  <head>
    <style>
      @media (max-width: 767px) {
        .auth {
          justify-content: center !important;
        }
      }
    </style>
  </head>
  <body>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth">
          <div class="row flex-grow">
            <div class="col-lg-4 mx-auto">
              <div class="auth-form-light text-left p-5">
                <div class="brand-logo" align="center">
                  <img class="img-avatar mb-3" src="assets/images/Web icon.png" alt="">
                </div>
                <h6 class="font-weight-light">Please Fill In The Details Below:</h6>
                <form class="js-validation-signin px-30" method="post" name="chngpwd" onSubmit="return valid();">
                  <div class="form-group row">
                    <div class="col-12">
                      <div class="form-material floating">
                        <input type="email" class="form-control" required="true" name="email">
                        <label for="login-username">Email Address</label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-12">
                      <div class="form-material floating">
                        <input type="text" class="form-control" name="mobile" required="true" maxlength="10" pattern="[0-9]+">
                        <label for="login-password">Mobile Number</label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-12">
                      <div class="form-material floating">
                        <input class="form-control" type="password" name="newpassword" required="true"/>
                        <label for="login-password">New Password</label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-12">
                      <div class="form-material floating">
                        <input class="form-control" type="password" name="confirmpassword" required="true"/>
                        <label for="login-password">Confirm Password</label>
                      </div>
                    </div>
                  </div>
                  <div class="mt-3">
                    <button name="submit" type="submit" class="btn btn-block btn-info btn-lg font-weight-medium auth-form-btn" style="background-color: #0369A3;">RESET</button>
                  </div>
                  <br>
                  <br>
                  <button onclick="window.location.href='index.php'" class="btn btn-block btn-info btn-lg font-weight-medium auth-form-btn" style="background-color: #0369A3; color: white; text-decoration: none;">
                      BACK TO LOGIN
                  </button>

                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
  </body>
</html>

