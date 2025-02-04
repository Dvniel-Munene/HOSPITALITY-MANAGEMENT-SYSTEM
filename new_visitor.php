<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if(isset($_POST['submit2']))
{
  $FirstName=$_POST['FirstName'];
  $LastName=$_POST['LastName'];
  $Gender=$_POST['Gender'];
  $Age=$_POST['Age'];
  $Contact=$_POST['Contact'];
  
  $sql="INSERT INTO visitors (FirstName, LastName, Gender, Age, Contact, CreationDate) 
        VALUES (:FirstName, :LastName, :Gender, :Age, :Contact, NOW())";
  $query=$dbh->prepare($sql);
  $query->bindParam(':FirstName',$FirstName,PDO::PARAM_STR);
  $query->bindParam(':LastName',$LastName,PDO::PARAM_STR);
  $query->bindParam(':Gender',$Gender,PDO::PARAM_STR);
  $query->bindParam(':Age',$Age,PDO::PARAM_INT);
  $query->bindParam(':Contact',$Contact,PDO::PARAM_STR);
 
  $query->execute();
  $LastInsertId=$dbh->lastInsertId();
  if ($LastInsertId>0) {
    echo '<script>alert("Visitor has been added Successfully!")</script>';
  }
  else
  {
   echo '<script>alert("Something Went Wrong. Please try again")</script>';
 }
}
?>
<div class="card-body">
  <h4 class="card-title"></h4>
  <form class="forms-sample" method="post">
    <div class="form-group">
      <label for="FirstName">First Name</label>
      <input type="text" name="FirstName" class="form-control" id="FirstName" placeholder="First Name" required>
    </div>
    <div class="form-group">
      <label for="LastName">Last Name</label>
      <input type="text" name="LastName" class="form-control" id="LastName" placeholder="Last Name" required>
    </div>
    <div class="form-group">
        <label for="Gender">Gender</label>
        <select class="form-control" name="Gender" id="Gender" required>
          <option value="">Choose Gender</option>
          <option value="Male">Male</option>
          <option value="Female">Female</option>
        </select>
    </div>
    <div class="form-group">
      <label for="Age">Age</label>
      <input type="number" name="Age" class="form-control" id="Age" placeholder="Age" required>
    </div>
    <div class="form-group">
      <label for="Contact">Contact</label>
      <input type="text" name="Contact" class="form-control" id="Contact" placeholder="Contact" required>
    </div>
    <button type="submit" name="submit2" class="btn btn-primary btn-fw mr-2">Submit</button>
  </form>
</div>
