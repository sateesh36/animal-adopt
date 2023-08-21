<?php  
$insert = false;
$update = false;
$delete = false;

include("../globalfiles/config.php");

if(isset($_GET['delete'])){
  $id = $_GET['delete'];
  $delete = true;
  $sql = "DELETE FROM `rescue_form` WHERE `id` = $id";
  $result = mysqli_query($conn, $sql);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
if (isset( $_POST['idEdit'])){
  // Update the record
    $id = $_POST["idEdit"];
    $title = $_POST["titleEdit"];
    $description = $_POST["descriptionEdit"];

  // Sql query to be executed
  $sql = "UPDATE `rescue_form` SET `title` = '$title' , `description` = '$description' WHERE `rescue_form`.`id` = $id";
  $result = mysqli_query($conn, $sql);
  if($result){
    $update = true;
}
else{
    echo "We could not update the record successfully";
}
}
else{
    $title = $_POST["title"];
    $description = $_POST["description"];

  // Sql query to be executed
  $sql = "INSERT INTO `rescue_form` (`title`, `description`) VALUES ('$title', '$description')";
  $result = mysqli_query($conn, $sql);

   
  if($result){ 
      $insert = true;
  }
  else{
      echo "The record was not inserted successfully because of this error ---> ". mysqli_error($conn);
  } 
}
}
?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">


  <title>admin</title>

</head>

<body>
 
<a href="../globalfiles/logout.php" style="height:20px; margin-left: 50%">logout</a>
  
  <?php
  if($insert){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Your note has been inserted successfully
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
  }
  ?>
  <?php
  if($delete){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Your note has been deleted successfully
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
  }
  ?>
  <?php
  if($update){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Your note has been updated successfully
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
  }
  ?>

  <div class="container my-4">


    <table class="table" id="myTable">
      <thead>
        <tr>
          <th scope="col">S.No</th>
          <th scope="col">Full name</th>
          <th scope="col">Number</th>
          <th scope="col">Breed</th>
          <th scope="col">Image</th>
          <th scope="col">Quantity</th>
          <th scope="col">Address</th>
          <th scope="col">Message</th>
        <!-- id	fullame	number	breed	image	quantity	date	address	message -->
        </tr>
      </thead>
      <tbody>
        <?php 
          $sql = "SELECT * FROM `rescue_form`";
          $result = mysqli_query($conn, $sql);
          $id = 0;
          while($row = mysqli_fetch_assoc($result)){
            $id = $id + 1;
            echo "<tr>
            
            <th scope='row'>". $id . "</th>
            <td>". $row['fullname'] . "</td>
            <td>". $row['number'] . "</td>
            <td>". $row['breed'] . "</td>
            <td><img src='../uploads/".$row['image']."' height=40px width=40px></img></td>
            <td>". $row['quantity'] . "</td>
            <td>". $row['date'] . "</td>
            <td>". $row['address'] . "</td>
            <td>". $row['message'] . "</td>
            <td> <button class='edit btn btn-sm btn-primary' id=".$row['id'].">Edit</button> <button class='delete btn btn-sm btn-primary' id=d".$row['id'].">Delete</button>  </td>
          </tr>";
        } 
        ?>


      </tbody>
    </table>
  </div>
  <hr>
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
 
  <script>
    $(document).ready(function () {
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
        idEdit.value = e.target.id;
        console.log(e.target.id)
        $('#editModal').modal('toggle');
      })
    })

    deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit ");
        id = e.target.id.substr(1);

        if (confirm("Are you sure you want to delete this note!")) {
          console.log("yes");
          window.location = `admin.php?delete=${id}`;
          // TODO: Create a form and use post request to submit a form
        }
        else {
          console.log("no");
        }
      })
    })
  </script>
</body>

</html>
