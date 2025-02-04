<?php
include('includes/checklogin.php');
check_login();
// Code for deleting product from cart
if(isset($_GET['delid']))
{
  $rid=intval($_GET['delid']);
  $sql="delete from tbleventtype where ID=:rid";
  $query=$dbh->prepare($sql);
  $query->bindParam(':rid',$rid,PDO::PARAM_STR);
  $query->execute();
  echo "<script>alert('Data deleted');</script>"; 
  echo "<script>window.location.href = 'manage_event.php'</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<?php @include("includes/head.php");?>
<body>

  <div class="container-scroller">
    
    <?php @include("includes/header.php");?>
    
    <div class="container-fluid page-body-wrapper">


    <div class="main-panel">
        <div class="content-wrapper">
         <div class="row">
          <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
             <div class="modal-header">
              <h5 class="modal-title" style="float: left;">Enter Date Period/Duration</h5>
            </div>
            <div class="col-md-12 mt-4">
              <form class="forms-sample" method="post" enctype="multipart/form-data" class="form-horizontal">
                <div class="row ">
                  <div class="form-group col-md-6 ">
                    <label for="exampleInputPassword1">From Date</label>
                    <input type="date" id="fromdate" name="fromdate" value="" class="form-control" required="">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="exampleInputName1">To Date </label>
                    <input type="date" id="todate" name="todate" value="" class="form-control" required="">
                  </div>
                </div>

                <button type="submit" style="float: left;"  name="search" id="submit" class="btn btn-info btn-sm  mb-4">Search</button>
              </form>
            </div>
          </div>
        </div>
      
      
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="modal-header">
                  <h5 class="modal-title" style="float: left;">Event List Report</h5>    
                  
                </div>
                
                <div class="modal fade" id="addsector">
                  <div class="modal-dialog modal-sm ">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Event List Report</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        
                        <?php @include("newevent.php");?>
                      </div>
                      <div class="modal-footer ">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                      </div>
                    </div>
                    
                  </div>
                  
                </div>
                
              <div class="card-body table-responsive p-3">
                <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                  <thead>
                    <tr>
                      <th class="text-center">No.</th>
                      <th class="text-center">Event Name</th>
                      <th class="text-center">Creation Date</th>
                      
                    </tr>
                  </thead>
           
<tbody>
                    <?php
                    $sql="SELECT * from tbleventtype";
                    $query = $dbh -> prepare($sql);
                    $query->execute();
                    $results=$query->fetchAll(PDO::FETCH_OBJ);

                    $cnt=1;
                    if($query->rowCount() > 0)
                    {
                      foreach($results as $row)
                        {               ?>
                          <tr>
                            <td class="text-center"><?php echo htmlentities($cnt); ?></td>
                            <td class="font-w600 text-center"><?php echo htmlentities($row->EventType); ?></td>
                            <td class="d-none d-sm-table-cell text-center"><?php echo htmlentities($row->CreationDate); ?></td>
                        </tr>

                          <?php 
                          $cnt=$cnt+1;
                        }
                      } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        
        <?php @include("includes/footer.php");?>
        
      </div>
      
    </div>
    
  </div>
  
  <?php @include("includes/foot.php");?>

  
</body>

</html>
