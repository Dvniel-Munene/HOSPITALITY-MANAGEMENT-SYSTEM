<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if(isset($_POST['submit']))
{
  $eid=$_SESSION['edid'];
  $FirstName=$_POST['FirstName'];
  $LastName=$_POST['LastName'];
  $Gender=$_POST['Gender'];
  $Age=$_POST['Age'];
  $Contact=$_POST['Contact'];
  $sql="update visitors set FirstName =:FirstName, LastName =:LastName, Gender =:Gender, Age =:Age, Contact =:Contact, where visitors.ID=:eid";
  $query=$dbh->prepare($sql);
  $query-> bindParam(':eid', $eid, PDO::PARAM_STR);
  $query->bindParam(':FirstName',$FirstName,PDO::PARAM_STR);
  $query->bindParam(':LastName',$LastName,PDO::PARAM_STR);
  $query->bindParam(':Gender',$Gender,PDO::PARAM_STR);
  $query->bindParam(':Age',$Age,PDO::PARAM_STR);
  $query->bindParam(':Contact',$Contact,PDO::PARAM_STR);
  $query->execute();
  if ($query->execute()){
    echo '<script>alert("Visitor Info has been updated Successfully")</script>';
  }else{
    echo '<script>alert("update failed! try again later")</script>';
  }
}
?>
<div class="card-body">
  <h4 class="card-title">Update Visitor Info Form </h4>
  <form class="forms-sample" method="post" enctype="multipart/form-data" class="form-horizontal">
    <?php
    $eid=$_POST['edit_id'];
    $sql="SELECT * from  visitors where visitors.ID=:eid";
    $query = $dbh -> prepare($sql);
    $query-> bindParam(':eid', $eid, PDO::PARAM_STR);
    $query->execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);
    $cnt=1;
    if($query->rowCount() > 0)
    {
      foreach($results as $row)
      { 
        $_SESSION['edid']=$row->ID;
        ?>        
        <div class="form-group">
      <label for="exampleInputName1">First Name</label>
      <input type="text" name="FirstName" class="form-control" id="FirstName" value="<?php  echo $row->FirstName;?>"required>
    </div>
    <div class="form-group">
      <label for="exampleInputName1">Last Name</label>
      <input type="text" name="LastName" class="form-control" id="LastName" value="<?php  echo $row->LastName;?>"required>
    </div>
    <div class="form-group">
      <label for="exampleInputName1">Gender</label>
      <input type="text" name="Gender" class="form-control" id="Gender" value="<?php  echo $row->Gender;?>"required>
    </div>
    <div class="form-group">
      <label for="exampleInputName1">Age</label>
      <input type="text" name="Age" class="form-control" id="Age" value="<?php  echo $row->Age;?>"required>
    </div>
    <div class="form-group">
      <label for="exampleInputName1">Contact</label>
      <input type="text" name="Contact" class="form-control" id="Contact" value="<?php  echo $row->Contact;?>"required>
    </div>
        <?php
        $cnt=$cnt+1;
      }
    } ?>
    <button type="submit" name="submit" class="btn btn-primary btn-fw mr-2">Update</button>
    <button type="button" class="btn btn-success" data-dismiss="modal">Cancel</button>
  </form>
</div>