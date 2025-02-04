<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if(isset($_POST['submit']))
{
  $eid=$_SESSION['edid'];
  $Men=$_POST['Men'];
  $Women=$_POST['Women'];
  $Total=$_POST['Total'];
  $sql="update attendance set Men =:Men, Women =:Women,  Total =:Total,  where attendance.ID=:eid";
  $query=$dbh->prepare($sql);
  $query-> bindParam(':eid', $eid, PDO::PARAM_STR);
  $query->bindParam(':Men',$Men,PDO::PARAM_STR);
  $query->bindParam(':Women',$Women,PDO::PARAM_STR);
  $query->bindParam(':Total',$Total,PDO::PARAM_STR);
  $query->execute();
  if ($query->execute()){
    echo '<script>alert("Attendance Record Info has been updated Successfully")</script>';
  }else{
    echo '<script>alert("update failed! try again later")</script>';
  }
}
?>
<div class="card-body">
  <h4 class="card-title">Update Attendance Record Info Form </h4>
  <form class="forms-sample" method="post" enctype="multipart/form-data" class="form-horizontal">
    <?php
    $eid=$_POST['edit_id'];
    $sql="SELECT * from  attendance where attendance.ID=:eid";
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
      <label for="exampleInputName1">Men</label>
      <input type="text" name="Men" class="form-control" id="Men" value="<?php  echo $row->Men;?>"required>
    </div>
    <div class="form-group">Women</label>
      <input type="text" name="Women" class="form-control" id="Women" value="<?php  echo $row->Women;?>"required>
    </div>
    <div class="form-group">
      <label for="exampleInputName1">Total</label>
      <input type="text" name="Total" class="form-control" id="Total" value="<?php  echo $row->Total;?>"required>
    </div>
        <?php
        $cnt=$cnt+1;
      }
    } ?>
    <button type="submit" name="submit" class="btn btn-primary btn-fw mr-2">Update</button>
    <button type="button" class="btn btn-success" data-dismiss="modal">Cancel</button>
  </form>
</div>