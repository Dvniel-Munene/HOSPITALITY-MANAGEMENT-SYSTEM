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
      
      
      <div class="main-panel"><br>

        <div class="content-wrapper">

          <div class="row" >
            <div class="col-md-6">
              <div class="row">
                <div class="col-md-6 stretch-card grid-margin">
              <div class="card bg-gradient-info card-img-holder text-white"style="height: 130px;">
                <div class="card-body" >
                  <h4 class="font-weight-normal mb-3">Total New Events
                  </h4>
                  <?php 
                  $sql ="SELECT ID from tblevents where Status is null ";
                  $query = $dbh -> prepare($sql);
                  $query->execute();
                  $results=$query->fetchAll(PDO::FETCH_OBJ);
                  $totalnewbooking=$query->rowCount();
                  ?>
                  <h2 class="mb-5"><?php echo htmlentities($totalnewbooking);?></h2>
                </div>
              </div>
            </div>

            <div class="col-md-6 stretch-card grid-margin">
              <div class="card bg-gradient-warning card-img-holder text-white"style="height: 130px;">
                <div class="card-body">
                  <h4 class="font-weight-normal mb-3">Total Approved Events
                  </h4>
                  <?php 
                  $sql ="SELECT ID from tblevents where Status='Approved' ";
                  $query = $dbh -> prepare($sql);
                  $query->execute();
                  $results=$query->fetchAll(PDO::FETCH_OBJ);
                  $totalappbooking=$query->rowCount();
                  ?> 
                  <h2 class="mb-5"><?php echo htmlentities($totalappbooking);?></h2>
                </div>
              </div>
            </div>
            <div class="col-md-6 stretch-card grid-margin">
              <div class="card bg-gradient-primary  card-img-holder text-white"style="height: 130px;">
                <div class="card-body">
                  <h4 class="font-weight-normal mb-3">Total Cancelled Events
                  </h4>
                  <?php 
                  $sql ="SELECT ID from tblevents where Status='Cancelled' ";
                  $query = $dbh -> prepare($sql);
                  $query->execute();
                  $results=$query->fetchAll(PDO::FETCH_OBJ);
                  $totalcanbooking=$query->rowCount();
                  ?>
                  <h2 class="mb-5"><?php echo htmlentities($totalcanbooking);?></h2>
                </div>
              </div>
            </div>
            <div class="col-md-6 stretch-card grid-margin">
              <div class="card bg-gradient-success card-img-holder text-white"style="height: 130px;">
                <div class="card-body">
                  <h4 class="font-weight-normal mb-3">Total Events
                  </h4>
                  <?php 
                  $sql ="SELECT ID from tblevents";
                  $query = $dbh -> prepare($sql);
                  $query->execute();
                  $results=$query->fetchAll(PDO::FETCH_OBJ);
                  $totalserv=$query->rowCount();
                  ?>
                  <h2 class="mb-5"><?php echo htmlentities($totalserv);?></h2>
                </div>
              </div>
            </div>
            </div>
            </div>
            <div class="col-md-6">
               <div id="piechart" style="width:100%; height: 300px;"></div>
            </div>
                     <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="modal-header">
                  <h5 class="modal-title" style="float: left;">Scheduled Events</h5>
                </div>

                
              
              <div id="editData4" class="modal fade">
                <div class="modal-dialog modal-xl">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">View Event details</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body" id="info_update4">
                     <?php @include("view_newevents.php");?>
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

  <script type="text/javascript">
  google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {

    var data = google.visualization.arrayToDataTable([
      ['Task', 'Times carried out a year'],
      ['Birthday Sundays', 12],
      ['Sunday Services', 48],
      ['Sports Day', 1],
      ['Worship Encounters', 4],
      ['Cultural Sunday', 1],
      ['Holiday/Seasonal Events', 5],
      ['Outreach Events', 15]
    ]);

    var options = {
      title: 'Hospitality Team Services:'
    };

    var chart = new google.visualization.PieChart(document.getElementById('piechart'));

    chart.draw(data, options);
  }
</script>

</body>

</html>


