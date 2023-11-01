<?php
echo "Welcome";
echo "<br />";
// These are the defined authentication environment in the db service
$host = 'mysql';
$user = 'root';
// Database user password
$pass = 'rootpassword';
// Database name
$mydatabase = 'example';

// Check the MySQL connection status
$conn = new mysqli($host, $user, $pass);
echo '<form action="index.php" method="post">';
echo 'Name: <input type="text" name="name">';
echo 'E-mail: <input type="text" name="email">';
echo '<input type="submit">';
echo '</form>';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = $_REQUEST['email'];
    echo "<br />";
    if ($result = $conn->query("SELECT name from customers WHERE surname = '$data' ")) {
        // Dynamic query
        echo "<br/>";
        while ($row = mysqli_fetch_array($result)) {
            echo "<b>Name:</b> " . $row['name'] . " ";
            echo "<b>Company: </b>" . $row['company'] . "<br />";
            echo "<b>Surname: </b>" . $row['surname'] . "<br />";
        }
        echo "Returned rows are: " . $result->num_rows;
    }
}

$conn->close();
?>
