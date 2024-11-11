<?php
include("db.php");

// Add new User
if (isset($_POST['save_newuser'])) {
    $name = mysqli_real_escape_string($conn,$_POST['name']);
    $dept = mysqli_real_escape_string($conn,$_POST['dept']);
    $image = $_FILES['image']['name'];

    // Set upload directory and move uploaded file
    $uploadDir = "uploads/";
    $uploadFile = $uploadDir . basename($image);

    if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
        $sql = "INSERT INTO user (name, dept, image) VALUES ('$name', '$dept', '$image')";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            echo json_encode(['status' => 200, 'message' => 'User added successfully']);
        } else {
            echo json_encode(['status' => 500, 'message' => 'Database error']);
        }
    } else {
        echo json_encode(['status' => 500, 'message' => 'File upload failed']);
    }
}

// Delete User
if (isset($_POST['delete_user'])) {
    $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);

    $query = "DELETE FROM user WHERE id='$user_id'";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        echo json_encode(['status' => 200, 'message' => 'User deleted successfully']);
    } else {
        echo json_encode(['status' => 500, 'message' => 'Failed to delete user']);
    }
}

// Fetch data for editing user
if (isset($_POST['edit_user'])) {
    $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);

    $query = "SELECT * FROM user WHERE id='$user_id'";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        $user_data = mysqli_fetch_array($query_run);
        echo json_encode(['status' => 200, 'data' => $user_data]);
    } else {
        echo json_encode(['status' => 500, 'message' => 'Failed to fetch user data']);
    }
}

// Update user information
if (isset($_POST['save_edituser'])) {
    $id = mysqli_real_escape_string($conn,$_POST['id']);
    $name = mysqli_real_escape_string($conn,$_POST['name']);
    $dept = mysqli_real_escape_string($conn,$_POST['dept']);
    $newImage = $_FILES['image']['name'];

    // Update image if a new one is uploaded
    if ($newImage) {
        $uploadDir = "uploads/";
        $uploadFile = $uploadDir . basename($newImage);

        // Move the uploaded image to the designated directory
        move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile);
        
        $sql = "UPDATE user SET name='$name', dept='$dept', image='$newImage' WHERE id=$id";
    } else {
        $sql = "UPDATE user SET name='$name', dept='$dept' WHERE id=$id";
    }

    if (mysqli_query($conn, $sql)) {
        echo json_encode(['status' => 200, 'message' => 'User updated successfully']);
    } else {
        echo json_encode(['status' => 500, 'message' => 'Failed to update user']);
    }
}
