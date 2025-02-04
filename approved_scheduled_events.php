<?php
include('includes/checklogin.php');
check_login();
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
                  <h5 class="modal-title" style="float: left;">Approved Scheduled Events</h5>
                </div>

                
              
              <div id="editData4" class="modal fade">
                <div class="modal-dialog modal-xl">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">View Approved Scheduled Event details</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body" id="info_update4">
                     <?php @include("view_new_scheduled_events.php");?>
                   </div>
                   <div class="modal-footer ">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
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
           
                 
               </tr>
             </thead>

              <tbody>
               <?php
               $sql="SELECT * from tblevents where Status='Approved'";
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
                        <td class="d-none d-sm-table-cell">
                          <span class="badge badge-success"><?php  echo htmlentities($row->Status);?></span>
                        </td>
                        <?php 
                      } ?> 
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
<!--  Author Name:  From India 
 for any PHP, Codeignitor, Laravel OR Python work contact me at +919423979339 OR ndbhalerao91@gmail.com  
 Visit website : www.nikhilbhalerao.com -->

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
</body>

</html>