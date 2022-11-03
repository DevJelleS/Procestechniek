<?php
// Include config file
require_once "config.php";

session_start();

  // Check if the user is logged in, if not then redirect him to login page
  if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
      header("location: login.php");
      exit;
  }
 
  if(isset($_GET["uuid"]) && !empty(trim($_GET["uuid"]))){
    $uuid = $_GET["uuid"];
    // echo $uuid;
    } else {
        // Enable to redirect to error.php when no uuid given
        // header('Location: error.php');
        echo "Geen uuid opgegeven.";
    }

?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Docent Aanpassen</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
        .tabcontent {
          display: none;
        }
    </style>
</head>
<body>

<ul class="nav nav-tabs tab">
  <li class="nav-item">
    <a class="nav-link tablinks" onclick="openTab(event, 'Algemeen')">Algemeen</a>
  </li>
  <li class="nav-item tab">
    <a class="nav-link tablinks" onclick="openTab(event, 'Equipments')">Equipments</a>
  </li>
  <li class="nav-item tab">
    <a href="parts.php" class="nav-link tablinks">Annuleren</a>
  </li>
</ul>

<div id="Algemeen" class="tabcontent">
  <h3>Paris</h3>
  <p>Paris is the capital of France.</p>
</div>

<div id="Equipments" class="tabcontent">

<div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Docent Toevoegen</h2>
                    <form action="upload.php" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <input type="file" name="file">
                        </div>
                        <div class="form-group">
                            <label>Type</label>
                            <select name="typeid">
                            <?php

                            $sql = "SELECT * FROM tb_type";
                            if($result = mysqli_query($link, $sql)){
                                if(mysqli_num_rows($result) > 0){

                                  while($row = mysqli_fetch_array($result)){
                                    echo '<option value='. $row['id'] .'>'. $row['name'] .'</option>';
                                  }

                                  mysqli_free_result($result);
                                } else {
                                    echo "Geen types gevonden.";
                                }
                            } else {
                                echo "Oops! Something went wrong. Please try again later.";
                            }

                            ?>
                            </select>
                        </div>
                        <input type="hidden" name="uuid" value="<?php echo $uuid; ?>">
                        <input type="submit" class="btn btn-success" value="Toevoegen">
                        <a href="parts.php" class="btn btn-primary">Annuleren</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>

</div>

<script>
function openTab(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}
</script>

</body>
</html>