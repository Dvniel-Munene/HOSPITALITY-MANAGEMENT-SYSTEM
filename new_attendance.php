<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if(isset($_POST['submit2']))
{
  $Men=$_POST['Men'];
  $Women=$_POST['Women'];
  $Total=$_POST['Total'];
  $sql="insert into attendance(Men, Women, Total)values(:Men, :Women, :Total)";
  $query=$dbh->prepare($sql);
  $query->bindParam(':Men',$Men,PDO::PARAM_STR);
  $query->bindParam(':Women',$Women,PDO::PARAM_STR);
  $query->bindParam(':Total',$Total,PDO::PARAM_STR);
 
 
  $query->execute();
  $LastInsertId=$dbh->lastInsertId();
  if ($LastInsertId>0) {
    echo '<script>alert("Attendance Record has been added Successfully!")</script>';
  }
  else
  {
   echo '<script>alert("Something Went Wrong. Please try again")</script>';
 }
}
?>
<div class="card-body">
  <h4 class="card-title">Add Attendance Record Form </h4>
  <form class="forms-sample" method="post">
    <div class="form-group">
      <label for="exampleInputName1">Men</label>
      <input type="text" name="Men" class="form-control" id="Men" placeholder=" No. Of Men" required>
    </div>
    <div class="form-group">
      <label for="exampleInputName1">Women</label>
      <input type="text" name="Women" class="form-control" id="Women" placeholder="No. Of Women" required>
    </div>
    <div class="form-group">
      <label for="exampleInputName1">Total</label>
      <input type="text" name="Total" class="form-control" id="Total" placeholder="Total" required>
    </div>
   
    <button type="submit" name="submit2" class="btn btn-primary btn-fw mr-2">Submit</button>
  </form>
</div>