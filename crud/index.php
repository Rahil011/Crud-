
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>inotes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  </head>
  <body>
    <nav class="navbar navbar-expand-lg  " style="background-color: #e3f2fd;">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">iNotes</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        <a class="nav-link" href="#">About</a>
        <a class="nav-link" href="#">Contact US</a>
      </div>
    </div>
  </div>
</nav>


<?php


if($_SERVER['REQUEST_METHOD']=='POST'){
    $title = $_POST['title'];
    $description = $_POST['description'];

    

    $conn=mysqli_connect("localhost","root","","notes");
    if(!$conn){
        die("Not Connected to database".mysqli_connect_error($conn));
    }
    
    $sql="INSERT INTO `date` ( `title`, `description`, `date`) VALUES ('$title', '$description', current_timestamp())";
    $result=mysqli_query($conn,$sql);
    if(!$result){
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Success!</strong> You record could not be submitted sucessfully.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
    else{
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!</strong> You record has been submitted sucessfully.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
    }



}

?>

<div class="container my-3" >
    <h2>ADD NOTES</h2>
<form action="index.php" method="POST">
  <div class="mb-3">
    <label for="tile" class="form-label">Title</label>
    <input type="text" class="form-control" id="title"  name ="title" aria-describedby="emailHelp">
    <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
  </div>
  <div class="mb-3">
  <label for="description" class="form-label">DESCRIPTION</label>
  <textarea class="form-control" id="description" name="description" rows="3"></textarea>
</div>
  <button type="addnotes" class="btn btn-primary">Add Notes</button>
</form>
</div>
<div class="container">
<table class="table table-success table-striped-columns">
  <thead>
    <tr>
      <th scope="col">Sr.no</th>
      <th scope="col">Title</th>
      <th scope="col">Description</th>
      <th scope="col">Date/Time</th>
      <th scope="col">Actions</th>
      <!-- <th scope="col">Action</th> -->
    </tr>
  </thead>
  <tbody>
    <?php
     if(isset($_GET['button'])){
        $sno=$_GET['button'];
        echo $sno;
        $sql="SELECT*FROM `date` WHERE `sr.no`=$sno";
        $result=mysqli_query($conn,$sql);
    }
    

    $conn=mysqli_connect("localhost","root","","notes");
    $sql="SELECT*FROM `date`";
    $result=mysqli_query($conn,$sql);
    $srno=0;
    while($rows=mysqli_fetch_assoc($result)){
        $srno=$srno+1;
        echo "<tr>
        <th scope='row'>".$srno."</th>
        <td>".$rows['title']."</td>
        <td>".$rows['description']."</td>
        <td>".$rows['date']."</td>
        <td><a class='btn btn-primary' href='#' role='button' name='delete' id= 'delete' class='delete'>DELETE</a></td>
      </tr>";
    }



    ?>
    
    
  </tbody>
</table>

</div>





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
  </body>
</html>