<?php
 echo "Welcome";
 echo "<br />";
 //These are the defined authentication environment in the
db service
 $host = ’mysqldb’;
 $user = ’root’;
 //database user password
 $pass = ’password’;
 // database name
 $mydatabase = ’example’;
 // check the mysql connection status
 $conn = new mysqli($host, $user, $pass, $mydatabase);
echo ’<form action="stack_filter_1.php" method="post">’;
echo ’Name: <input type="text" name="name">’;
echo ’E-mail: <input type="text" name="email">’ ;
echo ’<input type="submit">’;
echo ’</form>’;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
 $data = $_REQUEST[’email’];
 echo "<br />";
 //Simple filter that detects illegal words and removes
     them from query
 $illegal_word = " or ";
 #choosing one of the words in the list at random to
filter out
 if (strpos($data, $illegal_word) !== FALSE) {
   echo ’<b>ILLEGAL WORD FOUND: <b/>’;
   $data = str_replace($illegal_word, "", $data);
   echo ’<b>NEW STRING’ . $data . ’<br />’;
 }
if ($result = $conn->query( "SELECT surname FROM users
   WHERE surname = ’$data’ ")) { #dynamic_query
   echo "<br/>";
   while($row = mysqli_fetch_array($result))
   {
   echo "<b>Name:</b> " . $row[’name’] . " ";
   echo "<b>Company: </b>" . $row[’company’] . "<br />";
   echo "<b>Surname: </b>" . $row[’surname’] . "<br />";
   }
   echo "Returned rows are: " . $result -> num_rows;
} }
$conn->close();
?>
