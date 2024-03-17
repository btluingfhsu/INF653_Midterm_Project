<?php

$result = $theAuthor->read();
$rowCount = $result->rowCount();

if ($rowCount == 0) {
    echo json_encode(
        array('message' => 'No authors found.')
    );
} else {
    $authors_arr = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $author_item = array(
            'id' => $id,
            'author'=> $author
        );

        array_push($authors_arr, $author_item);

    }
    echo json_encode($authors_arr);
}

?>