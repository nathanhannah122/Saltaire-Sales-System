<?php
   // Start the session
   session_start();
   ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Sales System</title>
  <link rel="shortcut icon" type="image/png" href="salefavi.png"/>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <!-- Bootstrap -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
  
  <!-- JavaScript -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>

  <!-- mdb -->
  <link rel="stylesheet" href="mdb.min.css" />
  
  <!-- JQuery -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
  <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" ></script>

</head>
<body>

<style type="text/css">
    #snow {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    pointer-events: none;
    z-index: 1000;
    }


    .box-shadow {
    -webkit-box-shadow: 0px 10px 20px 0px rgba(50, 50, 50, 0.52);
    -moz-box-shadow:    0px 10px 20px 0px rgba(50, 50, 50, 0.52);
    box-shadow:         0px 10px 20px 0px rgba(50, 50, 50, 0.52);
    }

    .today {
        text-align: right;
        color: grey;
        font-size: 20px;
    }

    .container {
        margin-top: 100px;
        border-radius:.25rem!important;
    }

    body {
        background-color: #4723D9;
    }

    #footer {
        color: white;
    }

</style>


<!-- Error Alerts -->
<?php 
    $fullurl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    if (strpos($fullurl, "auth=0") == true) {
        echo "<div id='errortext' class='alert alert-danger alert-dismissible fade show' role='alert'>";
        echo "<strong>Holy guacamole!</strong>";
        echo " Incorrect username/password!";
        echo  "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>";
        echo "<span aria-hidden='true'>&times;</span>";
        echo "</div>";
    } else if (strpos($fullurl, "field=0") == true) {
        echo "<div id='errortext' class='alert alert-danger' role='alert'>";
        echo "<strong>It looks like you're missing something!</strong>";
        echo " Please fill in all fields";
        echo  "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>";
        echo "<span aria-hidden='true'>&times;</span>";
        echo "</div>";
    } 
?>
    

<div class="container align-self-center rounded ">
  <div class="row">
   <div class="col-sm-4">
    </div>
    <div class="col-sm-4 box-shadow " style="text-align: center; background-color: white;">
        <!-- form login -->
        <form class="text-center border border-light p-5" method="post" action="logincheck.php">
            <!-- Send Screen Details -->
            <input type="hidden" id="width" name="width" value="0">
            <input type="hidden" id="height" name="height" value="0">
            <input type="hidden" id="durationspeed" name="durationspeed" value="duration">
            <span class="h4 mb-4 today" title="Today"></span>
            <p class="h4 mb-4">Sales <i> System</i></p>

            <!-- Username -->
            <input type="email" name="userid" class="form-control mb-4" placeholder="Email" id="userid">

            <!-- Password -->
            <input type="password" name="password" class="form-control mb-4" placeholder="Password" id="password">

            <!-- Show Password -->
            <input type="checkbox" id="passcheck" onclick="showPassword()"> Show Password</input>

            <!-- Sign in button -->
            <button class="btn btn-info btn-block my-4" style="background-color: #4723D9;"type="submit">Sign in</button>


        </form>
        <!--form login -->
    </div>
        <div class="col-sm-4">
    </div>
  </div>
</div>



<!-- FOOTER -->
<div id="footer" class="footer-copyright text-center py-3">© 2021 Copyright Nathan Hannah & Harriet Brooke
</div>

<!-- VERSION ID-->
<div id="version" style="text-align: center;">
<a href="https://github.com/nathanhannah122" target="_blank" style="color: grey; text-decoration: none;">Version (2021.12.08.2)</a></p>
</div>





<script type="text/javascript">
    $(document).ready(function() {
    var today = new Date().toDateString();
    $('.today').html(today);
})
</script>


<script>
    function showPassword() {
      var x = document.getElementById("password");
      if (x.type === "password") {
        x.type = "text";
      } else {
        x.type = "password";
      }
    }


</script>
</body>
</html>