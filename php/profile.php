<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION["username"])) {
    // Redirect to the login page
    header("Location: login.html");
    exit;
}
<?php
use Predis;

require "../assets/vendor/autoload.php";

$redis_host = 'localhost';
$redis_port = 6379;

$servername = 'localhost';
$username = 'root';
$password = '';

try {
  $uname = $_POST['uname'];
  $redis = new Redis();
  $redis->connect($redis_host, $redis_port);
  if ($redis->exists($uname)) {
    $user_data = json_decode($redis->get($uname), true);
  } else {

    $conn = new PDO("mysql:host=$servername;dbname=divagar",$username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM users WHERE username = :username";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':username', $uname);
    $stmt->execute();
    $user_data = $stmt->fetch(PDO::FETCH_ASSOC);
    $redis->set($uname, json_encode($user_data));
  }

  header("Location: profile.html?uname={$user_data['username']}&pass={$user_data['pass']}&email={$user_data['email']}&mobile={$user_data['mobile']}&dob={$user_data['dob']}");
} catch (Exception $e) {
  echo 'Error: ' . $e->getMessage();
}

// Connect to MySQL database
$mysqli = mysqli_connect("localhost", "root", "", "divagar");

if ($mysqli->connect_errno) {
    die("Failed to connect to MySQL: " . $mysqli->connect_error);
}

// Prepare the SQL query to select the user data
$stmt = $mysqli->prepare("SELECT username, email, age, address, mobile FROM users WHERE username = ?");
$stmt->bind_param("s", $_SESSION["username"]);

// Execute the SQL query
if ($stmt->execute()) {
    // Bind the result variables
    $stmt->bind_result($username, $email, $age, $address, $mobile);

    // Fetch the results
    $stmt->fetch();

    // Close the statement
    $stmt->close();

    // Display the user data
    echo "Welcome, " . $username . "<br>";
    echo "Email: " . $email . "<br>";
    echo "Age: " . $age . "<br>";
    echo "Address: " . $address . "<br>";
    echo "Mobile: " . $mobile . "<br>";
} else {
    die("Failed to retrieve user data: " . $stmt->error);
}

// Close the database connection
$mysqli->close();
?>
