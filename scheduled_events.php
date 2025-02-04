<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if(isset($_POST['submit'])) {
  $Name = $_POST['Name'];
  $Date = $_POST['Date'];
  $Venue = $_POST['Venue'];
  $EventType = $_POST['EventType'];
  $AdditionalInformation = $_POST['AdditionalInformation'];
  $Status = "Pending";  // new events start with a "Pending" status
  $UpdationDate = date("Y-m-d H:i:s"); // Setting the current date and time

  $sql = "INSERT INTO tblevents (Name, Date, Venue, EventType, AdditionalInformation, Status, UpdationDate) 
          VALUES (:Name, :Date, :Venue, :EventType, :AdditionalInformation, :Status, :UpdationDate)";
  $query = $dbh->prepare($sql);
  $query->bindParam(':Name', $Name, PDO::PARAM_STR);
  $query->bindParam(':Date', $Date, PDO::PARAM_STR);
  $query->bindParam(':Venue', $Venue, PDO::PARAM_STR);
  $query->bindParam(':EventType', $EventType, PDO::PARAM_STR);
  $query->bindParam(':AdditionalInformation', $AdditionalInformation, PDO::PARAM_STR);
  $query->bindParam(':Status', $Status, PDO::PARAM_STR);
  $query->bindParam(':UpdationDate', $UpdationDate, PDO::PARAM_STR);

  $query->execute();
  $LastInsertId = $dbh->lastInsertId();
  if ($LastInsertId > 0) {
    echo '<script>alert("New Scheduled Event has been added Successfully!")</script>';
  } else {
    echo '<script>alert("Something Went Wrong. Please try again")</script>';
  }
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
                  <h5 class="modal-title" style="float: left;">Pending Scheduled Events</h5>
                   <div class="card-tools" style="float: right;">
                    <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#AddData4" ><i class="fas fa-plus" ></i> Schedule Event
                    </button>
                  </div>    
                </div>

                
                
              
              <div id="AddData4" class="modal fade">
                <div class="modal-dialog modal-xl">
                  <div class="modal-content">
                    <div class="modal-header">
                    <h4 class="modal-title">Enter Event Details Below:</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        
                        <?php @include("new_scheduled_event.php");?>
                      </div>
                      <div class="modal-footer ">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                      </div>
                    </div>
                    
                  </div>
                  
                </div>
 
            <div id="newbid_action" class="modal fade">
              <div class="modal-dialog ">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Take Action</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body" id="info_update2">
                   <?php @include("newevents_action.php");?>
                 </div>
                 <div class="modal-footer ">
                  
                </div>
                
              </div>
              
            </div>
            
          </div>
          
          <div class="table-responsive p-3">
            <table class="table align-items-center table-flush table-hover" id="dataTableHover">
              <thead>
                <tr>
                 <th class="text-center">No</th>
                 <th class="text-center">Event Name</th>
                 <th class="d-none d-sm-table-cell text-center">Name</th>
                 <th class="d-none d-sm-table-cell text-center">Event Date</th>
                 <th class="d-none d-sm-table-cell text-center">Venue</th>
                 <th class="d-none d-sm-table-cell text-center">Additional Information</th>
                 <th class="d-none d-sm-table-cell text-center">Status</th>
                 <th class="d-none d-sm-table-cell text-center">Action</th>
                 
               </tr>
             </thead>

             <tbody>
               <?php
               $sql = "SELECT *, COALESCE(Status, 'Pending') as Status FROM tblevents WHERE COALESCE(Status, 'Pending') = 'Pending'";
               $query = $dbh -> prepare($sql);
               $query->execute();
               $results=$query->fetchAll(PDO::FETCH_OBJ);

               $cnt=1;
               if($query->rowCount() > 0)
               {
                foreach($results as $row)
                  {               ?>
                    <tr>
                      <td class="text-center"><?php echo htmlentities($cnt);?></td>
                      <td class="font-w600 text-center"><?php  echo htmlentities($row->EventType);?></td>
                      <td class="font-w600 text-center"><?php  echo htmlentities($row->Name);?></td>
                      <td class="font-w600 text-center">
                        <span class="badge badge-info"><?php  echo htmlentities($row->Date);?></span>
                      </td>
                      <td class="font-w600 text-center"><?php  echo htmlentities($row->Venue);?></td>
                      <td class="font-w600 text-center"><?php  echo htmlentities($row->AdditionalInformation);?></td>
                      <?php if($row->Status=="")
                      { 
                        ?>
                        <td class="font-w600 text-center"><?php echo "Not Updated Yet"; ?></td>
                        <?php 
                      } else { ?>
                        <td class="d-none d-sm-table-cell text-center">
                          <span class="badge badge-warning"><?php  echo htmlentities($row->Status);?></span>
                        </td>
                        <?php 
                      } ?> 
                      <td class=" text-center">
                       
                        <a href="#"  class="edit_data2 btn btn-purple rounded" id="<?php echo  ($row->ID); ?>" ><i class="mdi mdi-pencil-box-outline " aria-hidden="true" title="Take action"></i></a>
                      </td>
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

<script type="text/javascript">
  $(document).ready(function(){
    $(document).on('click','.edit_data4',function(){
      var edit_id4=$(this).attr('id');
      $.ajax({
        url:"view_new_scheduled_events.php",
        type:"post",
        data:{edit_id4:edit_id4},
        success:function(data){
          $("#info_update4").html(data);
          $("#editData4").modal('show');
        }
      });
    });
  });
</script>
<script type="text/javascript">
  $(document).ready(function(){
    $(document).on('click','.edit_data2',function(){
      var edit_id2=$(this).attr('id');
      $.ajax({
        url:"newevents_action.php",
        type:"post",
        data:{edit_id2:edit_id2},
        success:function(data){
          $("#info_update2").html(data);
          $("#newbid_action").modal('show');
        }
      });
    });
  });
</script>
</body>

</html>