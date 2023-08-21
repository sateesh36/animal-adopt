<?php
session_start();

error_reporting(0);

if (!isset($_SESSION['admin_name'])) {
    header("Location: adminlogin.php");
}
include "../globalfiles/config.php";

// INSERT INTO `adoptedpets` (`sno`, `title`, `description`, `tstamp`) VALUES (NULL, 'But Books', 'Please buy books from Store', current_timestamp());
$insert = false;
$update = false;
$delete = false;

//from adopt index.php
$Ani_name = $_POST['Ani_name'];
$Ani_image = $_POST['Ani_image'];


if (isset($_GET['delete'])) {
    $sno = $_GET['delete'];
    $delete = true;
    $sql = "DELETE FROM `adoptedpets` WHERE `sno` = $sno";
    $result = mysqli_query($conn, $sql);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['snoEdit'])) {
        // Update the record
        $sno = $_POST["snoEdit"];
        $title = $_POST["titleEdit"];
        $description = $_POST["descriptionEdit"];

        // Sql query to be executed
        $sql = "UPDATE `adoptedpets` SET `title` = '$title' , `description` = '$description' WHERE `adoptedpets`.`sno` = $sno";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $update = true;
        } else {
            echo "We could not update the record successfully";
        }
    } else {
        $title = $_POST["title"];
        $description = $_POST["description"];

        // Sql query to be executed
        $sql = "INSERT INTO `adoptedpets` (`title`, `description`) VALUES ('$title', '$description')";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $insert = true;
        } else {
            echo "The record was not inserted successfully because of this error ---> " . mysqli_error($conn);
        }
    }
}

?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <link rel="stylesheet" href="Style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">


    <title>Adopted Pets</title>

</head>

<body>

    <div class="wrap">


        <div class="sidebar" style="top:0px;">
            <img src="menu.png" alt="" id="menuicon">
            <a href="index.php">
                <h1>Dashboard</h1>
            </a>
            <ul>
                <li><a href="rescueRequest.php">Rescue Request</a></li>
                <li><a href="adoptedpets.php">Adopted Pets</a></li>
                <li><a href="availablePets.php">Available Pets</a></li>
                <li><a href="userfeedback.php">User's Feedback</a></li>
            </ul>
        </div>
    </div>

    <!-- Edit Modal -->
    <form action="updateupload.php" method="POST" enctype="multipart/form-data">
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit this Note</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="updateupload.php" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="hidden" name="snoEdit" id="snoEdit">
                        <div class="form-group">
                            <label for="title">Pet Name</label>
                            <input type="text" class="form-control" id="titleEdit" name="titleEdit" aria-describedby="emailHelp">
                        </div>
                        <div class="form-group">
                            <label for="desc">Pet Image</label>
                            <input type="file" class="form-control" id="descriptionEdit" name="descriptionEdit" rows="3">
                            <!-- <textarea class="form-control" id="descriptionEdit" name="descriptionEdit" rows="3"></textarea> -->
                        </div>
                    </div>
                    <div class="modal-footer d-block mr-auto">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input type="submit" name="upsubmit" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
    </form>

    <?php
    if ($insert) {
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Your note has been inserted successfully
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
    }
    ?>
    <?php
    if ($delete) {
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Your note has been deleted successfully
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
    }
    ?>
    <?php
    if ($update) {
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Your note has been updated successfully
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
    }
    ?>
    <div class="container my-4">
        <h2>Add adopted pets here</h2>
        
        <form action="upload.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">Pet name</label>
                <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
            </div>

            <div class="form-group">
                <label for="desc">Pet description</label>
                <input type="file" class="form-control" id="description" name="description" rows="3"></input>
            </div>
            <!-- <div class="form-group">
                <input type="file" class="form-control" id="description" name="description" rows="3">
            </div> -->
            <input type="submit" name="submit" value="Submit" class="btn btn-primary" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <!-- <input type="submit" name="submit" class="btn btn-primary" action="upload.php">Add </input> -->
        </form>
    </div>

    <div class="container my-4">


        <table class="table" id="myTable">
            <thead>
                <tr>
                    <th scope="col">S.No</th>
                    <th scope="col">Name</th>
                    <th scope="col">Images</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM `adoptedpets`";
                $result = mysqli_query($conn, $sql);
                $sno = 0;
                while ($row = mysqli_fetch_assoc($result)) {
                    $sno = $sno + 1;
                    echo "<tr>
            <th scope='row'>" . $sno . "</th>
            <td>" . $row['title'] . "</td>
            <td><img src='../uploads/" . $row['description'] . "' height=40px width=40px></img></td>
            <td> <button class='edit btn btn-sm btn-primary' id=" . $row['sno'] . ">Edit</button> <button class='delete btn btn-sm btn-primary' id=d" . $row['sno'] . ">Delete</button>  </td>
          </tr>";
                }
                ?>


            </tbody>
        </table>
    </div>
    <hr>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();

        });
    </script>
    <script>
        edits = document.getElementsByClassName('edit');
        Array.from(edits).forEach((element) => {
            element.addEventListener("click", (e) => {
                console.log("edit ");
                tr = e.target.parentNode.parentNode;
                title = tr.getElementsByTagName("td")[0].innerText;
                description = tr.getElementsByTagName("td")[1].innerText;
                console.log(title, description);
                titleEdit.value = title;
                descriptionEdit.value = description;
                snoEdit.value = e.target.id;
                console.log(e.target.id)
                $('#editModal').modal('toggle');
            })
        })

        deletes = document.getElementsByClassName('delete');
        Array.from(deletes).forEach((element) => {
            element.addEventListener("click", (e) => {
                console.log("edit ");
                sno = e.target.id.substr(1);

                if (confirm("Are you sure you want to delete this note!")) {
                    console.log("yes");
                    window.location = `adoptedpets.php?delete=${sno}`;
                    // TODO: Create a form and use post request to submit a form
                } else {
                    console.log("no");
                }
            })
        })
    </script>
    <script>
        $(document).ready(function() {

            $("#menuicon").click(function() {
                $(".sidebar").toggleClass("opensidebar")
            });

        });
    </script>
</body>

</html>