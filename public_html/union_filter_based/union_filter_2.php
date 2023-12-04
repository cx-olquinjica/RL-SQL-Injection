<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

echo "Welcome";
echo "<br />";
//These are the defined authentication environment in the db service
$host = 'mysql';
$user = 'root';
//database user password
$pass = 'rootpassword';
// database name
$mydatabase = 'dbtest';


// check the mysql connection status
$conn = new mysqli($host, $user, $pass, $mydatabase);
echo '<form action="union_filter_1.php" method="post">';
echo 'Name: <input type="text" name="name">';
echo 'E-mail: <input type="text" name="email">' ;
echo '<input type="submit">';
echo '</form>';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $data = $_REQUEST['email'];
      echo "<br />";
      //Simple filter that detects illegal words and removes  them from query
      $illegal_words = [" union "];
      #choosing one of the words in the list at random to filter out
      $chosen_word = $illegal_words[rand(0, count( $illegal_words)-1 )];
      echo $chosen_word;
      if (strpos($data, $chosen_word) !== FALSE) {
         echo '<b>ILLEGAL WORD FOUND: <b/>';
         $data = str_replace($chosen_word, "", $data);
         echo '<b>NEW STRING' . $data . '<br />';
      }

if ($result = $conn->query( "SELECT name, company FROM customers WHERE surname = '$data' UNION SELECT username,password FROM users WHERE surname = '$data'")) { #dynamic_query
      echo "<br/>";
      while($row = mysqli_fetch_array($result))
      {
      	echo "<b>Name:</b> " . $row['name'] . " ";
      	echo "<b>Company: </b>" . $row['company'] . "<br />";
      	echo "<b>Surname: </b>" . $row['surname'] . "<br />";
      }
      echo "Returned rows are: " . $result -> num_rows;
   }
 }
 $conn->close();
 ?>
