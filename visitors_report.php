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
              <h5 class="modal-title" style="float: left;"></h5>
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
                  <h5 class="modal-title" style="float: left;">Visitors Report</h5>
                </div>
              
              <div id="editData4" class="modal fade">
                <div class="modal-dialog modal-xl">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">View Report Details</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body" id="info_update4">
                     <?php @include("view_visitors_report.php");?>
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
                <th class="text-center">Month</th>
                <th class="d-none d-sm-table-cell text-center">Men</th>
                <th class="d-none d-sm-table-cell text-center">Women</th>
                <th class="d-none d-sm-table-cell text-center">Total</th>
                <th class="text-center" style="width: 15%;">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM VisitorsReport";
            $query = $dbh->prepare($sql);
            $query->execute();
            $results = $query->fetchAll(PDO::FETCH_OBJ);
            $cnt = 1; // Initialize counter
            foreach ($results as $row) {
            ?>
                <tr>
                    <td class="text-center"><?php echo htmlentities($cnt); ?></td>
                    <td class="font-w600 text-center"><?php echo htmlentities($row->month); ?></td>
                    <td class="font-w600 text-center"><?php echo htmlentities($row->male); ?></td>
                    <td class="font-w600 text-center"><?php echo htmlentities($row->female); ?></td>
                    <td class="font-w600 text-center"><?php echo htmlentities($row->total); ?></td>
                    <td class="text-center">
                       <!-- <a href="#" class="edit_data4 btn btn-info rounded" id="<?php echo htmlentities($row->ID); ?>" title="click to edit">
                            <i class="mdi mdi-eye" aria-hidden="true"></i>
                        </a> -->
                        <a href="VR_generating.php?invid=<?php echo htmlentities($row->ID); ?>" class="btn btn-primary rounded">
                            <i class="mdi mdi-printer" aria-hidden="true"></i>
                        </a>
                    </td>
                </tr>
            <?php
                $cnt++;
            }
            ?>
        </tbody>
    </table>
</div>

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
$(document).ready(function() {
    $(document).on('click', '.edit_data4', function(e) {
        e.preventDefault();
        
        var edit_id4 = $(this).attr('id'); // Get the ID from the clicked element
        
        $.ajax({
            url: "view_visitors_report.php",
            type: "POST",
            data: { edit_id4: edit_id4 },
            success: function(data) {
                $("#info_update4").html(data); // Update modal body with fetched data
                $("#editData4").modal('show'); // Show the modal
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText); // Log any errors to console
            }
        });
    });
});
</script>

</body>

</html>