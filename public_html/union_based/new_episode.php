<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

echo "Loading the new_episode.php\n";

echo "Generating new episode \n";


$lines = file('union_queries.txt', FILE_IGNORE_NEW_LINES);
# Read content of queries.txt as array

// this line added by me
if ($lines === false) {
   echo "Error reading stack_queries.txt\n";
   die(); // Terminate the script
}

// ends here



$query = $lines[array_rand($lines)]; # Select random value in queries.txt


$php_workaround = file_get_contents('php_query.txt');

// this line added by my
if ($php_workaround === false) {
   echo "Error reading php_query.txt\n";
   die(); // Terminate the script

}

// ends here


 echo "New SQL Query is: " . "<b>" . $query . "</b>";
 // Return new SQL query for debugging (if needed)

 $reading = fopen('index.php', 'r');

 // this line added by me
if($reading === false) {
   echo "Error opening index.php for reading\n";
   die();
}

 //ends here

 $writing = fopen('index.tmp', 'w');

 // this line was added by me
if ($writing === false) {
   echo "Error opening index.tmp for writing\n";
   die();
}

 // ends here

 $replaced = false;

while (!feof($reading)) {
   $line = fgets($reading);

   // this line added by me
   if ($line == false){
      fclose($reading);
      fclose($writing);
      die();
   }
   //ends here

   if (stristr($line,'#dynamic_query')) {
      $line = 'if ($result = $conn->query( "' . $query . ' "))
   { ' . "#dynamic_query" . "\r\n";
       $replaced = true;
   }

   // this line was added by me

   if(fwrite($writing, $line) === false) {
      echo "Error writing to index.tmp\n";
      fclose($reading);
      fclose($writing);
      die();
   }

   // ends here

 //  I commented out this line: fputs($writing, $line);
 }


 fclose($reading);
fclose($writing);

 // might as well not overwrite the file if we didn't replace anything
 if ($replaced)
 {
 rename('index.tmp', 'index.php');
 }else{
 unlink('index.tmp');
 }
 ?>
