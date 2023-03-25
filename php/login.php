<?php 

$servername = 'localhost';
$username = 'root';
$password = '';

//creating connection using php data object - ( PDO )

// if(isset($_POST['insert']))
// {

// }
try {
  $uname = $_POST['uname'];
  $pass = $_POST['pass'];


  //code...
  $conn = new PDO("mysql:host=$servername;dbname=guvi",$username, $password);

$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

try {
  //code...
  $sql = "SELECT * FROM Guvi WHERE username = :username AND pass = :pass";
  $stmt = $conn->prepare($sql);
  $stmt->bindValue(':username', $uname);
  $stmt->bindValue(':pass', $pass);
 
  $stmt->execute();
  $count = $stmt->rowCount();
  if($count > 0) {
    $_SESSION['username'] = $uname;
    echo "$uname";
    
  }
  else {
    echo "Login Not Success";
    echo 'window.location.replace("/");';
  }
} catch (\Throwable $th) {
   echo $th;
}


} catch(PDOException $e) {
echo "Connection failed: " . $e->getMessage();
}
?>
