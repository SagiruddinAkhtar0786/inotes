<?php

$insert = false;
$update = false;
$delete = false;
    // connecting to the data base
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "notes";
    
    
    // <!-- create a connection -->
    
    $conne = mysqli_connect($servername,$username,$password,$database);
    
    // die if connection was not successful
    
    if(!$conne){
        die("  <strong>  sorry we failed to connect: </strong>". mysqli_connect_error());
        echo "<br> ";
    }

  

    // exit();

    if(isset($_GET['delete'])){
      $sno = $_GET['delete'];
      $delete = true;
      $sql = "DELETE FROM `notes` WHERE `SR_NO` = $sno";
      $result = mysqli_query($conne, $sql);
    }
    

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

      if(isset($_POST['snoedit'])){
        // update the record
        $sno = $_POST["snoedit"];
        $title = $_POST["titleedit"];
        $description = $_POST["descriptionedit"];
  
        // sql query to be executed
        $sql = "UPDATE `notes` SET `title` = '$title', `description` ='$description' WHERE `notes`.`SR_NO` = $sno";
        $result = mysqli_query($conne , $sql);

        if($result){
          $update = true;
        }
      }
      else{

        $title = $_POST["title"];
      $description = $_POST["description"];

      // sql query to be executed
      $sql = "INSERT INTO `notes` (`title`, `description`) VALUES ( '$title', '$description')";
      $result = mysqli_query($conne , $sql);

      // add a note to the table notes

      if($result){
        // echo "THE RECORD IS SUCCSSFULLY SUBMITTED";
        $insert = true;

    }
    else {
        echo "the record was not inserted success fully due to this error--->".mysqli_errror($conne);
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
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
    integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

  <link rel="stylesheet" href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">



  <title>i-notes PHP CRUD!</title>
</head>

<body>

  <!-- Edit modal -->
  <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editModal">
  Edit modal
</button> -->

  <!-- Edit Modal -->
  <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModallavel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModallabel">Edit this Note</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form Action="/PHP/notes/inotes.php" method="post">
          <div class="modal-body">

            <input type="hidden" name="snoedit" id="snoedit">

            <h2>Add a Note</h2>
            <div class="form-group">
              <label for="Title">Note Title</label>
              <input type="text" class="form-control" id="titleedit" name="titleedit" aria-describedby="emailHelp">
            </div>
            <div class="form-group">
              <label for="desc">Note Description</label>
              <textarea class="form-control" id="descriptionedit" name="descriptionedit" rows="3"></textarea>
            </div>
            <!-- <button type="submit" class="btn btn-primary">update Note</button> -->
          </div>
          <div class="modal-footer d-block mr-auto">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>


  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#"> <img src="php.png" height = "25px" alt=""> </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Contact_Us</a>
        </li>
      </ul>

      <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
      </form>
    </div>
  </nav>



  <?php
      if($insert){
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
        <strong>Success!</strong> You Note have been inserted successfully..
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
          <span aria-hidden='true'>&times;</span>
        </button>
      </div>";
      }
    ?>
  <?php
      if($delete){
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
        <strong>Success!</strong> You Note have been  deleted successfully..
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
          <span aria-hidden='true'>&times;</span>
        </button>
      </div>";
      }
    ?>
  <?php
      if($update){
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
        <strong>Success!</strong> You Note have been updated successfully..
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
          <span aria-hidden='true'>&times;</span>
        </button>
      </div>";
      }
    ?>

  <div class="container my-4">
    <form Action="/PHP/notes/inotes.php" method="post">

      <h2>Add a Note</h2>
      <div class="form-group">
        <label for="Title">Note Title</label>
        <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
      </div>
      <div class="form-group">
        <label for="desc">Note Description</label>
        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
      </div>
      <button type="submit" class="btn btn-primary">Add a Note</button>
    </form>
  </div>

  <div class="container my-4">

    <table class="table my-4" id="myTable">
      <thead>
        <tr>
          <th scope="col">SR_NO.</th>
          <th scope="col">Title</th>
          <th scope="col">Description</th>
          <th scope="col">Actions</th>
        </tr>

      </thead>


      <tbody>
        <?php
           $sql = "SELECT * FROM `notes`";
           $result = mysqli_query($conne, $sql);
           $sno = 0;
           while($row = mysqli_fetch_assoc($result))
           {
            $sno  += 1;
             echo " <tr>
             <th scope='row'>". $sno ."</th>
             <td>" . $row['title'] ."</td>
             <td>". $row['description'] ."</td>
             <td> <button class='edit btn btn-sm btn-primary' id=".$row['SR_NO'].">Edit</button> <button class='delete btn btn-sm btn-primary' id=d".$row['SR_NO'].">Delete</button></td>
             </tr>";
     
            //  echo "<br>";
           }
          ?>
      </tbody>
    </table>
  </div>
  <hr>


  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->



  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
    integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI"
    crossorigin="anonymous"></script>

  <script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

  <script>

    $(document).ready(function () {
      $('#myTable').DataTable();
    });
  </script>

  <script>
    edits = document.getElementsByClassName('edit');

    Array.from(edits).forEach((element) => {
      element.addEventListener("click", (e) => {
        // console.log("edits",);
        tr = e.target.parentNode.parentNode;
        title = tr.getElementsByTagName("td")[0].innerText;
        description = tr.getElementsByTagName("td")[1].innerText;
        console.log(title, description);
        titleedit.value = title;
        descriptionedit.value = description;

        snoedit.value = e.target.id;
        console.log(e.target.id);

        $('#editModal').modal('toggle');
      })
    })


    deletes = document.getElementsByClassName('delete');

    Array.from(deletes).forEach((element) => {
      element.addEventListener("click", (e) => {

        sno = e.target.id.substr(1,);


        if (confirm("Are you sure you want to delete!")) {
          // console.log("yes");
          window.location = `/php/notes/inotes.php?delete=${sno}`;
        } else {
          console.log("no");
        }
      })
    })

  // create a form  and use a post request to submitt note
  </script>

</body>

</html>