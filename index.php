<?php
include "db.php";
$sql1 = "SELECT * FROM crud";
$result = mysqli_query($conn, $sql1);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP CRUD OPERATIONS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel="stylesheet" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h2>Php crud operations </h2>

        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#addmodal">Add new user</button>

        <table id="addtable" class="table">
            <thead>
                <tr>
                    <th scope="col">S.No</th>
                    <th scope="col">Name</th>
                    <th scope="col">Roll.No</th>
                    <th scope="col">Images</th>

                    <th scope="col">Age</th>
                    <th scope="col">Dept</th>
                    <th scope="col">Course</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $s = 1;
                while ($row = mysqli_fetch_array($result)) {
                ?>
                    <tr>
                        <td><?php echo $s; ?></td>
                        <td><?php echo $row['Name']; ?></td>
                        <td><?php echo $row['regno'] ?></td>
                        <td><button type="button" class="btn btn-primary btnimage" value="<?php echo $row['id']; ?>" data-bs-toggle="modal" data-bs-target="#imageModal">
                                View
                            </button></td>
                        <td><?php echo $row['age'] ?></td>
                        <td><?php echo $row['dept'] ?></td>
                        <td><?php echo $row['course'] ?></td>
                        <td>
                            <button type="button" class="btn btn-danger btndelete" value="<?php echo $row['id']; ?>">Delete user</button>
                            <button type="button" class="btn btn-warning btnedit" value="<?php echo $row['id']; ?>">Edit user</button>
                        </td>
                    </tr>
                <?php
                    $s++;
                }
                ?>

            </tbody>
        </table>
    </div>
    <div class="modal fade" id="addmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="Adduser">
                    <div class="modal-body">
                        <label for="fname">Name</label><br>
                        <input type="text" id="fname" name="fname" class="form-control" placeholder="Enter your Name"><br>

                        <label for="rollno">Roll No</label><br>
                        <input type="text" id="rollno" name="rollno" class="form-control" placeholder="Enter your Roll No"><br>

                        <label for="age">Age</label><br>
                        <input type="text" id="age" name="age" class="form-control" placeholder="Enter your Age"><br>

                        <label for="dept">Department</label><br>
                        <select class="form-select" name="dept" id="dept">
                            <option value="" selected disabled>Select Department</option>
                            <option value="CSE">CSE</option>
                            <option value="ECE">ECE</option>
                            <option value="MECH">MECH</option>
                            <option value="EEE">EEE</option>
                            <option value="CSBS">CSBS</option>
                            <option value="AI">AI</option>
                        </select>
                        <label for="fav_language">Course</label><br>
                        <input type="radio" id="html" name="fav_language" id="fav_language" value="HTML">
                        <label for="html">HTML</label><br>
                        <input type="radio" id="css" name="fav_language" value="CSS">
                        <label for="css">CSS</label><br>
                        <input type="radio" id="javascript" name="fav_language" value="JavaScript">
                        <label for="javascript">JavaScript</label><br><br>
                        <label for="image">Upload Image</label><br>
                        <input type="file" name="image" id="image" class="form-control" accept="image/*" required><br><br>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="Editusers" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="Editnewuser">
                    <div class="modal-body">
                        <input type="hidden" name="id" id="id" required>
                        <label for="Name">Name</label><br>
                        <input type="text" id="Name" name="fname" class="form-control" placeholder="Enter your Name"><br>

                        <label for="Regno">Roll No</label><br>
                        <input type="text" id="Regno" name="rollno" class="form-control" placeholder="Enter your Roll No"><br>

                        <label for="Age">Age</label><br>
                        <input type="text" id="Age" name="age" class="form-control" placeholder="Enter your Age"><br>

                        <label for="dept">Department</label><br>
                        <select class="form-select" name="dept" id="Dept">
                            <option value="" selected disabled>Select Department</option>
                            <option value="CSE">CSE</option>
                            <option value="ECE">ECE</option>
                            <option value="MECH">MECH</option>
                            <option value="EEE">EEE</option>
                            <option value="CSBS">CSBS</option>
                            <option value="AI">AI</option>
                        </select>
                        <label for="fav_language">Course</label><br>
                        <input type="radio" id="html" name="fav_language" id="fav_language" value="HTML">
                        <label for="html">HTML</label><br>
                        <input type="radio" id="css" name="fav_language" value="CSS">
                        <label for="css">CSS</label><br>
                        <input type="radio" id="javascript" name="fav_language" value="JavaScript">
                        <label for="javascript">JavaScript</label>
                        <label for="image">Upload Image</label><br>
                        <input type="file" name="image" id="image" class="form-control" accept="image/*" required><br><br>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <p id="Id"></p>
                   <img src="" id="Image" alt="" width="450px" height="400px">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    
                </div>
            </div>
        </div>
    </div>





    <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function() {
            //to display data tables
            $('#addtable').DataTable();
        });

        $(document).on('submit', '#Adduser', function(e) {
            e.preventDefault();
            var Formdata = new FormData(this);
            Formdata.append("Add_newuser", true);
            console.log(Formdata)
            $.ajax({
                url: "backend.php",
                method: "POST",
                data: Formdata,
                processData: false,
                contentType: false,
                success: function(response) {
                    var res = jQuery.parseJSON(response);
                    console.log(res);
                    if (res.status == 200) {
                        $('#addmodal').modal('hide'); //modal
                        $('#Adduser')[0].reset(); //form
                        $('#addtable').load(location.href + " #addtable"); // load table
                        alert("added successfully")
                    } else if (res.status == 500) {
                        $('#addmodal').modal('hide'); //modal
                        $('#Adduser')[0].reset(); //form
                        console.error("Error:", res.message);
                        alert("Something Went wrong.! try again")
                    }
                }
            })
        });

        $(document).on('click', '.btndelete', function(e) {
            e.preventDefault();
            if (confirm('Are you sure you want to delete this data?')) {
                var id = $(this).val();
                console.log(id)
                $.ajax({
                    url: "backend.php",
                    method: "POST",
                    data: {
                        'delete_user': true,
                        'userid': id
                    },
                    success: function(response) {
                        var res = jQuery.parseJSON(response);
                        if (res.status == 500) {
                            alert(res.message);
                        } else {
                            $('#addtable').load(location.href + " #addtable");
                        }
                    }
                })
            }
        })

        $(document).on('click', '.btnedit', function(e) {
            e.preventDefault();
            var user_id = $(this).val();
            console.log(user_id)
            $.ajax({
                type: "POST",
                url: "backend.php",
                data: {
                    'edit_user': true,
                    'user_id': user_id
                },
                success: function(response) {

                    var res = jQuery.parseJSON(response);
                    console.log(res)
                    if (res.status == 500) {
                        alert(res.message);
                    } else {
                        //$('#student_id2').val(res.data.uid);

                        $('#id').val(res.data.id);
                        console.log(res.data.id);
                        $('#Name').val(res.data.Name);
                        $('#Regno').val(res.data.regno);
                        $('#Age').val(res.data.age);
                        $('#Dept').val(res.data.dept);
                        $('#Course').val(res.data.course);
                        $('#Editusers').modal('show');
                    }
                }
            });
        });

        $(document).on('submit', '#Editnewuser', function(e) {
            e.preventDefault();
            var formData = new FormData(this);

            formData.append("save_edituser", true);
            console.log(formData);
            $.ajax({
                type: "POST",
                url: "backend.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    var res = jQuery.parseJSON(response);
                    console.log(res);
                    if (res.status == 200) {
                        $('#Editusers').modal('hide');
                        $('#Editnewuser')[0].reset();
                        $('#addtable').load(location.href + " #addtable");
                        alert(res.message)

                    } else if (res.status == 500) {
                        $('#Editusers').modal('hide');
                        $('#Editnewuser')[0].reset();
                        console.error("Error:", res.message);
                        alert("Something Went wrong.! try again")
                    }
                }
            });
        });

        $(document).on('click', '.btnimage', function(e) {
            e.preventDefault();
            var user_id = $(this).val();
            console.log(user_id)
            $.ajax({
                type: "POST",
                url: "backend.php",
                data: {
                    'fetch_image': true,
                    'user_id': user_id
                },
                success: function(response) {
                    var res = jQuery.parseJSON(response);
                    console.log(res)
                    if (res.status == 500) {
                        alert(res.message);
                    } else {
                        console.log(res.data.id);
                        
                        
                        $('#Image').attr('src',res.data.image)
                        
                    }
                }
            });
        });
    </script>
</body>

</html>