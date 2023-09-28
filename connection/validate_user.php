
<?php
 
 include_once('connection.php');
   
 function test_input($data) {
      
     $data = trim($data);
     $data = stripslashes($data);
     $data = htmlspecialchars($data);
     return $data;
 }
   
 if ($_SERVER["REQUEST_METHOD"] == "POST") {
      
     $username1 = test_input($_POST["username1"]);
     $password1= test_input($_POST["password1"]);
     $stmt1 = $conn->prepare("SELECT * FROM userlogin");
     $stmt1->execute();
     $users1 = $stmt1->fetchAll();
     echo $users1;
      
     foreach($users1 as $u){
          
         if(($u['u_username'] == $username1) &&
             ($u['u_password'] == $password1)) {
                 header("location: userdash.php");
         }
         else {
             echo "<script language='javascript'>";
             echo "alert('WRONG INFORMATION')";
             echo "</script>";
             die();
         }
     }
 }
  
 ?>