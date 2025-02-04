<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php'); // Adjust path as per your file structure

if(isset($_POST['edit_id4'])) {
    $edit_id4 = $_POST['edit_id4']; // Get id from AJAX POST data
    
    // Example SQL query to fetch visitor details based on id
    $sql = "SELECT FirstName, LastName, Gender, Age, Contact
            FROM visitors
            WHERE id = :edit_id4";
    
    $query = $dbh->prepare($sql);
    $query->bindParam(':edit_id4', $edit_id4, PDO::PARAM_INT);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
}
?>

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
            </tr>
        </thead>
        <tbody>
            <?php 
            $cnt = 1; // Initialize counter variable
            if ($results) {
                foreach ($results as $row) { 
            ?>
            <tr>
                <td class="text-center"><?php echo htmlentities($cnt);?></td>
                <td class="text-center"><?php echo htmlentities($row->FirstName);?></td>
                <td class="text-center"><?php echo htmlentities($row->LastName);?></td>
                <td class="text-center"><?php echo htmlentities($row->Gender);?></td>
                <td class="text-center"><?php echo htmlentities($row->Age);?></td>
                <td class="text-center"><?php echo htmlentities($row->Contact);?></td>
            </tr>
            <?php 
                $cnt++;
                }
            }
            ?>
        </tbody>
    </table>
</div>
