<?php
echo "Generating new episode \n";
$lines = file(’stack_queries.txt’, FILE_IGNORE_NEW_LINES);
   # Read content of queries.txt as array
$query = $lines[array_rand($lines)]; # Select random value
   in queries.txt
$php_workaround = file_get_contents(’php_query.txt’);
echo "New SQL Query is: " . "<b>" . $query . "</b>"; #
   Return new SQL query for debugging (if needed)
$reading = fopen(’index.php’, ’r’);
$writing = fopen(’index.tmp’, ’w’);
$replaced = false;
while (!feof($reading)) {
 $line = fgets($reading);
 if (stristr($line,’#dynamic_query’)) {
   $line = ’if ($result = $conn->query( "’ . $query . ’ "))
       { ’ . "#dynamic_query" . "\r\n";
   $replaced = true;
 }
 fputs($writing, $line);
}
fclose($reading); fclose($writing);
// might as well not overwrite the file if we didn’t
   replace anything
if ($replaced)
{
    22 rename(’index.tmp’, ’index.php’);
    23 }else{
    24 unlink(’index.tmp’);
    25 }
    26 ?>