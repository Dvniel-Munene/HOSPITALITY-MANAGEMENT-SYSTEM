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
  $Status = "Pending";  // Assuming new events start with a "Pending" status
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

<div class="card-body">
  <h4 class="card-title"></h4>
  <form method="POST" id="AdditionalInformationForm" name="AdditionalInformationForm" class="AdditionalInformationForm">
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label class="label" for="name">Full Name</label>
          <input type="text" class="form-control" name="Name" id="Name" placeholder="Name" required>
        </div>
      </div>
      <div class="col-md-6"> 
        <div class="form-group">
          <label class="label" for="date">Event Date</label>
          <input type="date" class="form-control" name="Date" id="Date" placeholder="" required>
        </div>
      </div>
      <div class="col-md-12">
        <div class="form-group">
          <label class="label" for="venue">Venue</label>
          <textarea name="Venue" class="form-control" id="Venue" cols="30" rows="4" placeholder="" required></textarea>
        </div>
      </div>
      <div class="col-md-12">
        <div class="form-group">
          <label class="label" for="eventtype">Type of Event:</label>
          <select class="form-control" name="EventType" id="EventType" required>
            <option value="">Choose Event Type</option>
            <?php 
            $sql2 = "SELECT * from tbleventtype";
            $query2 = $dbh->prepare($sql2);
            $query2->execute();
            $result2 = $query2->fetchAll(PDO::FETCH_OBJ);
            foreach ($result2 as $row) {
            ?>  
              <option value="<?php echo htmlentities($row->EventType); ?>"><?php echo htmlentities($row->EventType); ?></option>
            <?php } ?>
          </select>
        </div>
      </div>
      <div class="col-md-12">
        <div class="form-group">
          <label class="label" for="additionalinformation">Additional Information</label>
          <textarea name="AdditionalInformation" class="form-control" id="AdditionalInformation" cols="30" rows="4" placeholder=""></textarea>
        </div>
      </div>
      <div class="col-md-12">
        <div class="form-group">
          <input type="submit" value="Schedule" name="submit" class="btn btn-sm btn-info">
          <div class="submitting"></div>
        </div>
      </div>
    </div>
  </form>
</div>
<div class="modal-body" id="info_update4">
  <?php @include("view_new_scheduled_events.php"); ?>
</div>
