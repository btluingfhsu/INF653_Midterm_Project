<?php
$conn = pg_connect("host=localhost dbname=quotesdb user=postgres password=P0$tGr3$!sFuck1nC@0l");

if (!$conn) {
    echo "An error occurred.\n";
    exit;
} else {
    echo "Connection to PostgreSQL database successful.\n";
}
?>
