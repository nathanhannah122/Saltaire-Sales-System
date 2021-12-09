<?php
   // Start the session
   session_start();
   $userid   = $_POST['userid'];
   $password = $_POST['password'];
   // checks if entry is empty, redirects if empty 
   if (empty($userid) || empty($password)) {
   	header("location:login.php?field=0");
   	exit();
   }
   
   ?>
<!--- no time for when press log out, can use == 0 to not print to file --->
<!DOCTYPE html>
<HTML>
   <head>
      <title>Saltaire Finance</title>
      <link rel="stylesheet" type="text/css" href="style.css">
   </head>
   <body>
      <?php
         $file = 'log.txt';
         
         $userid             = $_POST['userid'];
         $password           = $_POST['password'];
         $ip                 = $_SERVER["REMOTE_ADDR"];
         $port 			    = $_SERVER['REMOTE_PORT'];
         $date               = date('d-m-Y H:i:s');
         $dateFormat         = "$date";
         $ipFormat           = " $ip";
         $portFormat         = " $port ";
         $requestedurl       = $_SERVER['HTTP_REFERER'];
         
         $attempt  = False;
         $status   = False;
         $userid   = $_POST['userid'];
         $password = $_POST['password'];


         
         $attemptFormat  = "$attempt login attempt from ";
         $current = file_get_contents($file);
         $newLine= $date .  $ipFormat . $portFormat . $attemptFormat . $userid . "\r\n";
         $current = $current . $newLine;
         file_put_contents($file, $current);


         // Try and login
         $status = checkCreds($userid, $password);
         if ($status == "loggedInAdmin") {
            processGoodLogin($status, $userid, $result);    // process good login
         } else {
            processBadLogin($status, $userid);     // process bad login
         }

         //
         // check if credentials passed are in db
         //
         function checkCreds($userid, $password) {
            $servername = "localhost";
            $username = "user";
            $password2 = "saltairesales";
            $dbname = "user";

            // Create connection
            $conn = new mysqli($servername, $username, $password2, $dbname);
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT region FROM salesmanagers WHERE email='" . $userid . "'AND password='" . $password . "'";
            $result = $conn->query($sql);

            if ($result->num_rows == 1) {
               $status = "loggedInAdmin";

            } else {
                echo "0 results";
                $status = "loggedOut";
            }
            return $status;
            return $result;
            $conn->close(); 
         }

         //
         // Process good login
         //
         function processGoodLogin($status, $userid, $result) {
            $_SESSION["status"] = $status;
            $_SESSION["email"] = $userid;
            $userid = substr($userid, 0, strpos($userid, '@'));
            $_SESSION["username"] = $userid;
            //$name = $_SESSION["username"];
            //$_SESSION['name'] = $str_replace(".", " ", $name);
            $_SESSION["region"] = $result;
            //$test = log($status);
            $_SESSION['login_error_msg'] = "";
            echo "good";
            header("Location: index.php");
            exit();  
         }

         //
         // Process bad login
         //
         function processBadLogin($status, $userid) {
            $_SESSION["status"] = $status;
            //$test = log($status);
            $_SESSION['login_error_msg'] = "Sorry, that user name or password is incorrect. Please try again.";
            header("Location: login.php?auth=0");
            exit();     
         }

         ?>
      
      <?php 
         // gets browser name
         function get_browser_name($user_agent){
             $t = strtolower($user_agent);
             $t = " " . $t;
             if     (strpos($t, 'opera'     ) || strpos($t, 'opr/')     ) return 'Opera'            ;   
             elseif (strpos($t, 'edge'      )                           ) return 'Edge'             ;   
             elseif (strpos($t, 'chrome'    )                           ) return 'Chrome'           ;   
             elseif (strpos($t, 'safari'    )                           ) return 'Safari'           ;   
             elseif (strpos($t, 'firefox'   )                           ) return 'Firefox'          ;   
             elseif (strpos($t, 'msie'      ) || strpos($t, 'trident/7')) return 'Internet Explorer';
             return 'Unknown';
         }
         
         $browser = get_browser_name($_SERVER['HTTP_USER_AGENT']);//Chrome
         
          ?>
</header>

      <<?php echo 'Current status is : ' . $status; ?>
      <form name='form1' id='form1' method="post" style="text-align: center; margin-top: 100px;">
         <?php
            if ($_SESSION["status"] == 'loggedInAdmin') {
            header("location:index.php");
            } else {
            header("location:login.php?login=failed");
            }
            ?>
      </form>


   </body>
</HTML>
