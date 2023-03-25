<?php 

$servername = 'localhost';
$username = 'root';
$password = '';


//mongo db configs
$mongo_host = "guvi.nf8msyr.mongodb.net";
$dbname = "guvi";
$mongo_uname = "deeps";
$mongo_password = "deepsdeeps";

//creating connection using php data object - ( PDO )

// if(isset($_POST['insert']))
// {

// }
try {
  //code...
  $conn = new PDO("mysql:host=$servername;dbname=guvi",$username, $password);
  $dsn = "mongodb+srv://$username:$password@$host/$dbname";
  $mongo = new MongoDB\Client($dsn);
  $collection = $mongo->selectCollection($dbname, "users");
  $result = $collection->insertOne(["name" => "$uname", "email" => "$email"]);
} catch (\Throwable $th) {
  echo $th;
}
try {
  $uname = $_POST['uname'];
  $pass = $_POST['pass'];
  $email = $_POST['email'];
  $mobile = $_POST['mobile'];
  $dob = $_POST['dob'];

  echo "The tow params are $uname and $pass";
  //code...
  
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
echo "Connected successfully";
try {
  //My SQL Queries
  $sql = "INSERT INTO Guvi (username, pass, email, mobile, dob) VALUES (?,?,?,?,?)";
  $stmt = $conn->prepare($sql);
  $stmt->execute(["$uname","$pass","$email","$mobile","$dob"]);

  //mongo db Quries

} catch (\Throwable $th) {
   echo $th;
}

echo " New record created successfully";
} catch(PDOException $e) {
echo "Connection failed: " . $e->getMessage();
}
?>
