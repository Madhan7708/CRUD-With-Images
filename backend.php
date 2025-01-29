<?php
include "db.php";
if (isset($_POST['Add_newuser'])) {
    try {

        $name = mysqli_real_escape_string($conn, $_POST['fname']);
        $rollno = mysqli_real_escape_string($conn, $_POST['rollno']);
        $age = mysqli_real_escape_string($conn, $_POST['age']);
        $dept = mysqli_real_escape_string($conn, $_POST['dept']);
        $course = mysqli_real_escape_string($conn, $_POST['fav_language']);
        $imageName = $_FILES['image']['name'];  // Get Image Name


            $imageTmpName = $_FILES['image']['tmp_name'];
            // Get Temp Name
            $uploadDir = "uploads/";  // Set Upload Directory
            $imagePath = $uploadDir . basename($imageName);

            move_uploaded_file($imageTmpName, $imagePath);  // Upload Image

            // ✅ Step 6: Insert Data into Database
            $query = "INSERT INTO crud (Name, regno, age, dept, course, image) VALUES ('$name', '$rollno', '$age', '$dept', '$course', '$imagePath')";
            if (mysqli_query($conn, $query)) {
                $res = [
                    'status' => 200,
                    'message' => 'User Added Successfully'
                ];
                echo json_encode($res);
            } else {
                throw new Exception('Query Failed: ' . mysqli_error($conn));
            }
    } catch (Exception $e) {
        $res = [
            'status' => 500,
            'message' => 'Error: ' . $e->getMessage()
        ];
        echo json_encode($res);
    }
}

if (isset($_POST['delete_user'])) {
    $id = mysqli_real_escape_string($conn, $_POST['userid']);
    $query = "DELETE FROM crud WHERE id='$id'";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => 'Details Deleted Successfully'
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Details Not Deleted'
        ];
        echo json_encode($res);
        return;
    }
}

if (isset($_POST['edit_user'])) {
    $student_id = mysqli_real_escape_string($conn, $_POST['user_id']);

    $query = "SELECT * FROM crud WHERE id='$student_id'";
    $query_run = mysqli_query($conn, $query);

    $User_data = mysqli_fetch_array($query_run);


    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => 'details Fetch Successfully by id',
            'data' => $User_data
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Details Not Deleted'
        ];
        echo json_encode($res);
        return;
    }
}
if (isset($_POST['fetch_image'])) {
    $student_id = mysqli_real_escape_string($conn, $_POST['user_id']);
    $query = "SELECT image,id FROM crud WHERE id='$student_id'";
    $query_run = mysqli_query($conn, $query);
    $User_data = mysqli_fetch_array($query_run);

    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => 'details Fetch Successfully by id',
            'data' => $User_data
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Details Not Deleted'
        ];
        echo json_encode($res);
        return;
    }
}

if (isset($_POST['save_edituser'])) {
    $student_id = mysqli_real_escape_string($conn, $_POST['id']);
    $name = mysqli_real_escape_string($conn, $_POST['fname']);
    $rollno = mysqli_real_escape_string($conn, $_POST['rollno']);
    $age = mysqli_real_escape_string($conn, $_POST['age']);
    $dept = mysqli_real_escape_string($conn, $_POST['dept']);
    $course = mysqli_real_escape_string($conn, $_POST['fav_language']);
    $imageName = $_FILES['image']['name'];  // Get Image Name


    $imageTmpName = $_FILES['image']['tmp_name'];
    // Get Temp Name
    $uploadDir = "uploads/";  // Set Upload Directory
    $imagePath = $uploadDir . basename($imageName);

    move_uploaded_file($imageTmpName, $imagePath);

    $query = "UPDATE crud SET name='$name',regno='$rollno' ,age='$age',dept='$dept',course='$course',image='$imagePath' WHERE id='$student_id'";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => 'details Updated Successfully'
        ];
        echo json_encode($res);
        return;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Details Not Deleted'
        ];
        echo json_encode($res);
        return;
    }
}
