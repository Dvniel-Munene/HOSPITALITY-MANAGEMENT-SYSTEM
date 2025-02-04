<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
?>
<div class="card-body">
  <?php
  $eid = $_POST['edit_id4'];
  $sql = "SELECT tblevents.Name, tblevents.Date, tblevents.Venue, tblevents.EventType, tblevents.AdditionalInformation, tblevents.Status, tblevents.UpdationDate
          FROM tblevents 
          WHERE tblevents.ID = :eid";
  $query = $dbh->prepare($sql);
  $query->bindParam(':eid', $eid, PDO::PARAM_STR);
  $query->execute();
  $results = $query->fetchAll(PDO::FETCH_OBJ);
  $cnt = 1;
  if ($query->rowCount() > 0) {
    foreach ($results as $row) {
  ?>
      <table border="1" class="table align-items-center table-flush table-bordered">
        <tr>
          <th>Client Name</th>
          <td><?php echo $row->Name; ?></td>
        </tr>
        <tr>
          <th>Event Date</th>
          <td><?php echo $row->Date; ?></td>
          <th>Venue</th>
          <td><?php echo $row->Venue; ?></td>
        </tr>
        <tr>
          <th>Event Type</th>
          <td><?php echo $row->EventType; ?></td>
          <th>Additional Information</th>
          <td><?php echo $row->AdditionalInformation; ?></td>
        </tr>
        <tr>
          <th>Last Update Date</th>
          <td><?php echo $row->UpdationDate; ?></td>
        </tr>
        <tr>
          <th>Order Final Status</th>
          <td>
            <?php
            $status = $row->Status;
            if ($row->Status == "Approved") {
              echo "Your Scheduled Event has been approved";
            } elseif ($row->Status == "Cancelled") {
              echo "Your Scheduled Event has been cancelled";
            } else {
              echo "No Response Yet";
            }
            ?>
          </td>
          <th>Admin Remark</th>
          <td>
            <?php
            if ($row->Status == "") {
              echo "Not Updated Yet";
            } else {
              echo htmlentities($row->Status);
            }
            ?>
          </td>
        </tr>
      </table>
  <?php
      $cnt = $cnt + 1;
    }
  }
  ?>
</div>
