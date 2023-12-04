<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

echo "Loading the new_episode.php\n";

echo "Generating new episode \n";

$lines = file('union_queries.txt', FILE_IGNORE_NEW_LINES);
# Read content of queries.txt as array

// this line added by me
if ($lines === false) {
      echo "Error reading union_queries.txt\n";
      die(); // Terminate the script
}


$query = $lines[array_rand($lines)]; # Select random value in queries.txt


$php_workaround = file_get_contents('php_query.txt');

// this line added by my
if ($php_workaround === false) {
      echo "Error reading php_query.txt\n";
      die(); // Terminate the script

}

echo "New SQL Query is: " . "<b>" . $query . "</b>"; #Return new SQL query for debugging (if needed)
$pages = ["union_filter_1.php", "union_filter_2.php", " union_filter_3.php"];
$chosen_index = rand(0,2); #open one of the php pages at random
$reading = fopen($pages[$chosen_index], 'r');
$writing = fopen('index.tmp', 'w');
$replaced = false;

while (!feof($reading)) {
      $line = fgets($reading);
      if (stristr($line,'#dynamic_query')) {
            $line = 'if ($result = $conn->query( "' . $query . ' ")){ ' . "#dynamic_query" . "\r\n";
            $replaced = true;
      }

      fputs($writing, $line);
}

fclose($reading); fclose($writing);
// might as well not overwrite the file if we didn't replace anything
if ($replaced){
      rename('index.tmp', 'index.php');
}
else{
      unlink('index.tmp');
}
?>
