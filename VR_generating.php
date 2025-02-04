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

          <div class="row" id="exampl">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                
              <div class="card-body table-responsive p-3">
                <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                  <thead>
                    <tr>
                      <th class="text-center">No.</th>
                      <th class="text-center">First Name</th>
                      <th class="text-center">Last Name</th>
                      <th class="text-center">Gender</th>
                      <th class="text-center">Age</th>
                      <th class="text-center">Contact</th>
                      <th class="text-center">Date</th>
                    </tr>
                  </thead>
                  
<tbody>
                    <?php
                    $sql="SELECT * from visitors";
                    $query = $dbh -> prepare($sql);
                    $query->execute();
                    $results=$query->fetchAll(PDO::FETCH_OBJ);
                    $cnt=1;
                    if($query->rowCount() > 0)
                    {
                      foreach($results as $row)
                      {    
                        ?>
                        <tr>
                          <td class="text-center"><?php echo htmlentities($cnt);?></td>
                          <td class="text-center"><?php  echo htmlentities($row->FirstName);?></td>
                          <td class="text-center"><?php  echo htmlentities($row->LastName);?></td>
                          <td class="text-center"><?php  echo htmlentities($row->Gender);?></td>
                          <td class="text-center"><?php  echo htmlentities($row->Age);?></td>
                          <td class="text-center"><?php  echo htmlentities($row->Contact);?></td>
                          <td class="text-center">
                              <span class=""><?php echo htmlentities(date("d-m-Y", strtotime($row->CreationDate ?? 'now'))); ?></span>
                          </td>
                        </tr>
                        <?php 
                        $cnt=$cnt+1;
                      }
                    } ?>
                  </tbody>
                </table>
                    <p style="margin-top:1%" align="center">
                      <i class="mdi mdi-printer fa-2x" style="cursor: pointer; font-size: 30px;" onClick="CallPrint(this.value)"></i>
                  </p>
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

  <script>
  function CallPrint() {
    var tableContent = document.getElementById("dataTableHover").outerHTML;
    var WinPrint = window.open('', '', 'left=0,top=0,width=800,height=900,toolbar=0,scrollbars=0,status=0');
    WinPrint.document.write('<html><head><title>VISITORS REPORT</title>');
    WinPrint.document.write('</head><body>');
    WinPrint.document.write(tableContent);
    WinPrint.document.write('</body></html>');
    WinPrint.document.close();
    WinPrint.focus();
    WinPrint.print();
    WinPrint.close();
  }
</script>

</body>

</html>
