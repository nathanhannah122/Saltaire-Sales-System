<?php
   // Start the session
   session_start();
   ?>

<?php
  if ($_SESSION["status"] != 'loggedInAdmin') {
    header("location:login.php");
    exit();
  }


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Saltaire Sales</title>
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
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
  <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" ></script>

  <!-- Dashboard -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" ></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" ></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" >

  <link rel="stylesheet" href="style.css" >


</head>
<body id="body-pd">
    <header class="header" id="header">
        <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>
        <p style="font-size: 30px; margin-top: 12px;">Saltaire Sales</p>
        <p style="margin-top: 12px;"> <a href="profile.php" style="color: black;"class="link-secondary"><strong>Hello</strong> <?php echo $_SESSION["username"]; ?>!</a></p>
    </header>
    <div class="l-navbar" id="nav-bar">
        <nav class="nav">
            <div> <a href="#" class="nav_logo"> <i class='bx bx-layer nav_logo-icon'></i> <span class="nav_logo-name">Saltaire Sales</span> </a>
                <div class="nav_list"> <a href="#" class="nav_link active"> <i class='bx bx-grid-alt nav_icon'></i> <span class="nav_name">Dashboard</span> </a> <a href="graph.php" class="nav_link"> <i class='bx bx-bar-chart-alt-2 nav_icon'></i> <span class="nav_name">Stats</span> </a> <a href="profile.php" class="nav_link"> <i class='bx  bx-user nav_icon'></i> <span class="nav_name">Profile</span> </a> <a href="log.txt" class="nav_link"> <i class='bx bx-message-square-detail nav_icon'></i> <span class="nav_name">Log</span> </a></div>
            </div> <a href="logout.php" class="nav_link"> <i class='bx bx-log-out nav_icon'></i> <span class="nav_name">SignOut</span> </a>
        </nav>
    </div>
    <!--Container Main start-->
    <?php echo $_SESSION["region"]; ?>
    <div class="height-100 bg-light">
        <?php
        // Server login details
        $host = 'localhost';
        $dbname = 'user';
        $username = 'user';
        $password = 'saltairesales';
          
        $dsn = "mysql:host=$host;dbname=$dbname"; 
        // SQL Get all users
         
        $sql = "SELECT * FROM salesdata";
        
        // try to connect and send SQL query with details
        // if unable return error 
        try{
         $pdo = new PDO($dsn, $username, $password);
         $stmt = $pdo->query($sql);
         if($stmt === false){
          die("Error");
         }
         
        }catch (PDOException $e){
          echo $e->getMessage();
        }
      ?>


      <!-- MAIN CONTENT - TABLE -->
      <div class="container">
        <div class="row">
          <div class="col-sm-0">
          </div>
          <div class="col-sm-12">
          <table id="dtBasicExample" class="table table-striped table-bordered table-sm table-wrapper-scroll-y my-custom-scrollbar" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th class="th-sm">Region
                </th>

                <th class="th-sm">Name
                </th>

                <th class="th-sm">Personnel ID
                </th>
                <th class="th-sm">Email
                </th>
                <th class="th-sm">Number
                </th>
                <th class="th-sm">Sales Target
                </th>
                <th class="th-sm">Sales last 6 months
                </th>
                <th class="th-sm">Bonus
                </th>
                <th class="th-sm">ID Photo

                </th>
              </tr>
            </thead>
            <tbody>
            <?php while($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
            <tr>
               <td><?php echo htmlspecialchars($row['region']); ?></td>
               <td><?php echo htmlspecialchars($row['name']); ?></td>
               <td><?php echo htmlspecialchars($row['personnelnum']); ?></td>
               <td><?php echo htmlspecialchars($row['email']); ?></td>
               <td><?php echo htmlspecialchars($row['number']); ?></td>
               <td><?php echo htmlspecialchars($row['salestarget']); ?></td>

               <td><?php if ($row['saleslast6'] >= $row['salestarget']) { echo '<span style="color:green;"><strong>' . htmlspecialchars($row['saleslast6'])  . '</strong></span>'; } else  { echo '<span style="color:red;"><strong>' . htmlspecialchars($row['saleslast6'])  . '</strong></span>'; } ?></td>


               <td><?php echo htmlspecialchars($row['bonus']); ?></td>

               <td><?php  $image = $row['photo']; $imageData = base64_encode(file_get_contents($image)); echo '<img src="data:image/jpeg;base64,'.$imageData.'">';?></td>
            </tr>
            <?php endwhile; ?>
           </tbody>
          </table>
          </div>
          <div class="col-sm-0">
          </div>
        </div>
      </div>
      <!-- FOOTER -->
      <div class="footer-copyright text-center py-3">© 2021 Copyright Nathan Hannah & Harriet Brooke</a>
        <p style="text-align: right; color:grey; font-size:10px;">(Version 2.0)</p>
      </div>
    </div>


      <!-- Enables datatable -->
      <script type="text/javascript">
      $(document).ready(function () {
        $('#dtBasicExample').DataTable();
        $('.dataTables_length').addClass('bs-select');
      });
      </script>






<!-- Custom Styles -->



<script type="text/javascript">
document.addEventListener("DOMContentLoaded", function(event) {

const showNavbar = (toggleId, navId, bodyId, headerId) =>{
const toggle = document.getElementById(toggleId),
nav = document.getElementById(navId),
bodypd = document.getElementById(bodyId),
headerpd = document.getElementById(headerId)

// Validate that all variables exist
if(toggle && nav && bodypd && headerpd){
toggle.addEventListener('click', ()=>{
// show navbar
nav.classList.toggle('show')
// change icon
toggle.classList.toggle('bx-x')
// add padding to body
bodypd.classList.toggle('body-pd')
// add padding to header
headerpd.classList.toggle('body-pd')
})
}
}

showNavbar('header-toggle','nav-bar','body-pd','header')

/*===== LINK ACTIVE =====*/
const linkColor = document.querySelectorAll('.nav_link')

function colorLink(){
if(linkColor){
linkColor.forEach(l=> l.classList.remove('active'))
this.classList.add('active')
}
}
linkColor.forEach(l=> l.addEventListener('click', colorLink))

// Your code to run since DOM is loaded and ready
});
</script>

</body>
</html>
