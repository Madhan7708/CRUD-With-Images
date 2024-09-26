<?php
include("db.php"); // Including the database connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {  // Checking if the form is submitted using POST
    $target_dir = "uploads/"; // Directory where the uploaded files will be saved
    $target_file = basename($_FILES["fileToUpload"]["name"]); // Get the name of the uploaded file
    echo $target_file; // Display the uploaded file name
    $target_name = pathinfo($_FILES["fileToUpload"]["name"], PATHINFO_FILENAME); // Get the name without the extension
    $reg_no = "11520187"; // Hardcoded registration number (to rename the file)
    $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION)); // Get the file extension (in lowercase)
    
    // Full file path where the file will be saved, e.g., uploads/11520187.jpg
    $target_url = $target_dir . $reg_no . '.' . $fileType; 
    
    // Move the uploaded file from its temporary location to the target directory
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_url)) { 
        // SQL query to insert the file path into the img table
        $sql = "INSERT INTO img (imgurl) VALUES('$target_url')";
        $result = mysqli_query($conn, $sql); // Execute the query
        
        // Check if the query was successful
        if ($result) {
            echo "The file has been uploaded. <br>"; // Success message
            echo "<img src='$target_url' alt='Uploaded Image' width='300'>"; 
        } else {
            echo "Sorry, there was an error uploading your file in db."; // Error if insertion fails
        }
    } else {
        echo "Sorry, there was an error uploading your file."; // Error if the file couldn't be moved
    }
}
?>
