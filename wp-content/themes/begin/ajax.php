<!DOCTYPE html>
<html>

<style>

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

</style>

   <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<body>


<?php
$dbHost     = "localhost"; 
$dbUsername = "root"; 
$dbPassword = ""; 
$dbName     = "skillbeyondboundaries"; 
 
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName); 
?>


<?php 

if(!empty($_POST["District_ids"])){ 


    $query = "SELECT * FROM states WHERE country_id = ".$_POST['District_ids']." "; 
    $result = $db->query($query); 

    
     
    // Generate HTML of state options list 
    if($result->num_rows > 0){ 
        echo '<option value="">Select States</option>'; 
        while($row = $result->fetch_assoc()){  
            echo '<option value="'.$row['id'].'">'.$row['name'].'</option>'; 
        } 
    }else{ 
        echo '<option value="">States not available</option>'; 
    } 
}elseif(!empty($_POST["Mandal_id"])){ 
    

    $query = "SELECT * FROM city WHERE state_id = ".$_POST['Mandal_id']." "; 
    $result = $db->query($query); 
     
    // Generate HTML of city options list 
    if($result->num_rows > 0){ 
        echo '<option value="">Select City</option>'; 
        while($row = $result->fetch_assoc()){  
            echo '<option value="'.$row['id'].'">'.$row['name'].'</option>'; 
        } 
    }else{ 
        echo '<option value="">City not available</option>'; 
    } 
}




?>
 

</body>
</html>