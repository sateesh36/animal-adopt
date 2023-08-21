<?php
session_start();
error_reporting(0);

if (!isset($_SESSION['admin_name'])) {
  header("Location: adminlogin.php");
}

if (isset($_SESSION['sestime']) && (time() - $_SESSION['sestime'] > 600)) {
  session_unset();
  session_destroy();
  header("Location: adminlogin.php");
  exit;
}
// INSERT INTO `notes` (`id`, `fullname`, `message`, `tstamp`) VALUES (NULL, 'But Books', 'Please buy books from Store', current_timestamp());
$insert = false;
$update = false;
$delete = false;
// Connect to the Database 
$servername = "localhost";
$username = "root";
$password = "";
$database = "login_register_pure_coding";

// Create a connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Die if connection was not successful
if (!$conn) {
  die("Sorry we failed to connect: " . mysqli_connect_error());
}

if (isset($_GET['delete'])) {
  $id = $_GET['delete'];
  $delete = true;
  $sql = "DELETE FROM `rescue_form` WHERE `id` = $id";
  $result = mysqli_query($conn, $sql);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (isset($_POST['idEdit'])) {
    // Update the record
    $id = $_POST["idEdit"];
    $fullname = $_POST["fullnameEdit"];
    $message = $_POST["messageEdit"];

    // Sql query to be executed
    $sql = "UPDATE `rescue_form` SET `fullname` = '$fullname' , `message` = '$message' WHERE `rescue_form`.`id` = $id";
    $result = mysqli_query($conn, $sql);
    if ($result) {
      $update = true;
    } else {
      echo "We could not update the record successfully";
    }
  } else {
    $fullname = $_POST["fullname"];
    $message = $_POST["message"];

    // Sql query to be executed
    $sql = "INSERT INTO `rescue_form` (`fullname`, `message`) VALUES ('$fullname', '$message')";
    $result = mysqli_query($conn, $sql);

    if ($result) {
      $insert = true;
    } else {
      echo "The record was not inserted successfully because of this error ---> " . mysqli_error($conn);
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="Style.css">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">

  <script src="jquery-3.5.1.min.js"></script>
</head>

<body>

  <div class="wrap">
    <div class="sidebar">
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

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-fullname" id="editModalLabel">Edit this Note</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <form action="index.php" method="POST">
            <div class="modal-body">
              <input type="hidden" name="idEdit" id="idEdit">
              <div class="form-group">
                <label for="fullname">Note fullname</label>
                <input type="text" class="form-control" id="fullnameEdit" name="fullnameEdit" aria-describedby="emailHelp">
              </div>

              <div class="form-group">
                <label for="desc">Note message</label>
                <textarea class="form-control" id="messageEdit" name="messageEdit" rows="3"></textarea>
              </div>
            </div>
            <div class="modal-footer d-block mr-auto">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <?php
    if ($insert) {
      echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Your note has been inserted successfully.
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
    }

    if ($delete) {
      echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <center><strong>Success!</strong> Item deleted successfully!!!</center>
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
    }

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
      <h2>Rescue Requests</h2>
    </div>

    <div class="container my-4">
      <table class="table" id="myTable">
        <thead>
          <tr style="background-color:grey;">
            <th scope="col">S.No</th>
            <th scope="col">Full name</th>
            <th scope="col">Number</th>
            <th scope="col">Breed</th>
            <th scope="col">Image</th>
            <th scope="col">Quantity</th>
            <th scope="col">Date</th>
            <th scope="col">Address</th>
            <th scope="col">Message</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $sql = "SELECT * FROM `rescue_form`";
          $result = mysqli_query($conn, $sql);
          $id = 0;
          while ($row = mysqli_fetch_assoc($result)) {
            $id = $id + 1;
            echo "<tr>
            <th scope='row'>" . $id . "</th>
            <td>" . $row['fullname'] . "</td>
            <td>" . $row['number'] . "</td>
            <td>" . $row['breed'] . "</td>
            <td><img src='../uploads/" . $row['image'] . "' height=40px width=40px></img></td>
            <td>" . $row['quantity'] . "</td>
            <td>" . $row['date'] . "</td>
            <td>" . $row['address'] . "</td>
            <td>" . $row['message'] . "</td>
            <td><button class='delete btn btn-sm btn-primary' id='d" . $row['id'] . "'>Delete</button></td>
          </tr>";
          }
          ?>
        </tbody>
      </table>
    </div>

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
      deletes = document.getElementsByClassName('delete');
      Array.from(deletes).forEach((element) => {
        element.addEventListener("click", (e) => {
          console.log("edit ");
          id = e.target.id.substr(1);

          if (confirm("Are you sure you want to delete this note!")) {
            console.log("yes");
            window.location = `rescueRequest.php?delete=${id}`;
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

