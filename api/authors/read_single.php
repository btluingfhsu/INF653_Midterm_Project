<?php
// if ID is found, returns true
if (isValid($_GET['id'], $theAuthor)) {
    $author_arr = array(
        'id' => $theAuthor->id,
        'author' => $theAuthor->name
    );
    echo json_encode($author_arr);
} else {
    notFound("author");
}

?>