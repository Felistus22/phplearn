<?php
session_start(); // Start the session

$servername = "localhost";
$username = "root";
$password = "MySQL2021";
$dbname = "feli";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
//echo "Connected successfully hurray";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
      body{
        text-align: center;
      }
      .field{
        margin-bottom: 20px;
      }
    </style>
</head>
<body>
    <div class="header">please login!!!</div>
    <div>
      <form action="index.php" method='post'>
        <input type="text" class='field' name="Username" placeholder='Username' id="" required><br/>
        <input type="password" class='field' name="Pass" placeholder="Password" required><br/>
        <input type="submit" class='field' name='Login' value="Login">
      </form>
    </div>

    <?php
      if (isset($_POST['Login'])){
        $Username = $_POST['Username'];;
        $Pass = $_POST['Pass'];

        //$select = mysqli_query($conn, "SELECT * FROM userinfo WHERE //Username= '$Username' AND Pass='$Pass'");
        //$row = mysqli_fetch_array($select);

        // Use prepared statements to prevent SQL injection. User inputs are not directly concatenated into the SQL query but are instead bound to placeholders.
        $stmt = $conn->prepare("SELECT * FROM userinfo WHERE Username = ? AND Pass = ?");
        $stmt->bind_param("ss", $Username, $Pass);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if ($row) {
          $_SESSION["Username"] = $row["Username"];
          $_SESSION["Pass"] = $row["Pass"];
          header("Location: login.php"); // Redirect to the correct file
          exit(); // Ensure that the script stops executing after the redirect
        } else {
          echo '<script type ="text/javascript">';
          echo 'alert("Invalid Username or Password!");';
          echo 'window.location.href = "index.php" ';
          echo '</script>';
        }
      }
      //if (isset($_SESSION["Username"])) {
       // header("Location: Login.php");
      //}
    ?>
</body>
</html>