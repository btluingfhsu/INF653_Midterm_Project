<?php
$conn = pg_connect("host=localhost dbname=quotesdb user=postgres password=postgres");

if (!$conn) {
    echo "An error occurred.\n";
    exit;
} else {
    echo "Connection to PostgreSQL database successful.\n";
}
?>
