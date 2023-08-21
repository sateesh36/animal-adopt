<?php
session_start();

error_reporting(0);

if (!isset($_SESSION['admin_name'])) {
    header("Location: adminlogin.php");
}
include "../globalfiles/config.php";

// INSERT INTO `availablepets` (`sno`, `title`, `description`, `tstamp`) VALUES (NULL, 'But Books', 'Please buy books from Store', current_timestamp());
$insert = false;
$update = false;
$delete = false;

if (isset($_GET['delete'])) {
    $sno = $_GET['delete'];
    $delete = true;
    $sql = "DELETE FROM `availablepets` WHERE `sno` = $sno";
    $result = mysqli_query($conn, $sql);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['snoEdit'])) {
        // Update the record
        $sno = $_POST["snoEdit"];
        $title = $_POST["titleEdit"];
        $description = $_POST["descriptionEdit"];
        $species = $_POST["speciesEdit"];
        $breed = $_POST["breedEdit"];
        $health_condition = $_POST["conditionedit"];
        $age = $_POST["ageEdit"];

        // Sql query to be executed
        $sql = "UPDATE `availablepets` SET `title` = '$title' , `description` = '$description', `species` = '$species', `breed` = '$breed', `health_condition` = '$health_condition', `age` = '$age' WHERE `availablepets`.`sno` = $sno";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $update = true;
        } else {
            echo "We could not update the record successfully";
        }
    } else {
        $title = $_POST["title"];
        $description = $_POST["description"];
        $species = $_POST["species"];
        $breed = $_POST["breed"]; 
        $health_condition = $_POST["health_condition"];   
        $age = $_POST["age"];

        // Sql query to be executed
        $sql = "INSERT INTO `availablepets` (`title`, `description`, `species`, `breed`, `health_condition`, `age`) VALUES ('$title', '$description', '$species', '$breed', '$health_condition', '$age')";
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


    <title>Available Pets</title>

    <script>
        function validateForm() {
            var doctorContact = document.getElementById("doctor_contact").value;
            var ownerContact = document.getElementById("owner_contact").value;

            // Regular expression to match exactly 10 digits
            var phonePattern = /^\d{10}$/;

            if (!phonePattern.test(doctorContact)) {
                alert("Please enter a valid 10-digit number for Doctor's contact.");
                return false;
            }

            if (!phonePattern.test(ownerContact)) {
                alert("Please enter a valid 10-digit number for Owner's contact.");
                return false;
            }
        }
    </script>

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
    <form action="updateupload2.php" method="POST" enctype="multipart/form-data">
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit this Note</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="updateupload2.php" method="POST" enctype="multipart/form-data">
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
                        <div class="form-group">
                            <label for="speciesEdit">Species</label>
                            <input type="text" class="form-control" id="speciesEdit" name="speciesEdit">
                        </div>
                        <div class="form-group">
                            <label for="breedEdit">Breed</label>
                            <input type="text" class="form-control" id="breedEdit" name="breedEdit">
                        </div>
                        <div class="form-group">
                            <label for="conditionedit">Health condition</label>
                            <input type="text" class="form-control" id="conditionedit" name="conditionedit">
                        </div>
                        <div class="form-group">
                            <label for="ageEdit">Age</label>
                            <input type="text" class="form-control" id="ageEdit" name="ageEdit">
                        </div>

                    </div>
                    <div class="modal-footer d-block mr-auto">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input type="submit" name="upsubmit2" class="btn btn-primary">
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
        <h2>Add Available pets here</h2>
        <form action="upload2.php" method="POST" enctype="multipart/form-data" onsubmit="return validateForm();">
            <div class="form-group">
                <label for="title">Pet name</label>
                <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
            </div>

            <div class="form-group">
                <label for="description">Pet description</label>
                <input type="file" class="form-control" id="description" name="description" rows="3"></input>
            </div>
            <div class="collapsible">
             <h3 class="section-title">Additional Details</h3>
              <div class="collapsible-content">
                    <div class="form-group">
                        <label for="species">Species</label>
                        <input type="text" class="form-control" id="species" name="species" required>
                    </div>

                    <div class="form-group">
                        <label for="species">Breed</label>
                        <input type="text" class="form-control" id="breed" name="breed" required>
                    </div>

                    <div class="form-group">
                        <label for="species">Age</label>
                        <input type="text" class="form-control" id="age" name="age" required>
                    </div>
                    <div class="form-group">
                        <label for="species">Gender</label>
                        <input type="text" class="form-control" id="gender" name="gender" required>
                    </div>
                    <div class="form-group">
                        <label for="species">Weight</label>
                        <input type="text" class="form-control" id="weight" name="weight" required>
                    </div>

                    <div class="form-group">
                        <label for="species">Doctor Contact</label>
                        <input type="text" class="form-control" id="doctor_contact" name="doctor_contact" required>
                    </div>

                    <div class="form-group">
                        <label for="species">Health Condition</label>
                        <input type="text" class="form-control" id="health_condition" name="health_condition" required>
                    </div>

                    <div class="form-group">
                        <label for="species">Owner Contact</label>
                        <input type="text" class="form-control" id="owner_contact" name="owner_contact" required>
                    </div>
                </div>
            </div>
            <!-- <div class="form-group">
                <label for="details">Pet Details</label>
                <input type="file" class="form-control" id="details" name="details" rows="3"></input>
            </div> -->
            <!-- <div class="form-group">
                <input type="file" class="form-control" id="description" name="description" rows="3">
            </div> -->
            <input type="submit" name="submit2" value="Submit" class="btn btn-primary" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
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
                    <th scope="col">Species</th>
                    <th scope="col">Breed</th>
                    <th scope="col">Health Condition</th>
                    <th scope="col">Age</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM `availablepets`";
                $result = mysqli_query($conn, $sql);
                $sno = 0;
                while ($row = mysqli_fetch_assoc($result)) {
                    $sno = $sno + 1;
                    echo "<tr>
            <th scope='row'>" . $sno . "</th>
            <td>" . $row['title'] . "</td>
            <td><img src='../uploads/" . $row['description'] . "' height=40px width=40px></img></td>
            <td>" . $row['species'] . "</td>
            <td>" . $row['breed'] . "</td>
            <td>" . $row['health_condition'] . "</td>
            <td>" . $row['age'] . "</td>
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
                species = tr.getElementsByTagName("td")[2].innerText;
                breed = tr.getElementsByTagName("td")[3].innerText;
                health_condition = tr.getElementsByTagName("td")[4].innerText;
                age = tr.getElementsByTagName("td")[5].innerText;
                console.log(title, description, species, breed, health_condition, age);
                titleEdit.value = title;
                descriptionEdit.value = description;
                speciesEdit.value = species;
                breedEdit.value = breed;
                conditionedit.value = health_condition;
                ageEdit.value = age;
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
                    window.location = `availablepets.php?delete=${sno}`;
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
    <script>

        const collapsibles = document.querySelectorAll('.collapsible');
        collapsibles.forEach(collapsible => {
         const title = collapsible.querySelector('.section-title');
         const content = collapsible.querySelector('.collapsible-content');
    
            title.addEventListener('click', () => {
            content.classList.toggle('expanded');
            });
        });
    </script>
</body>

</html>