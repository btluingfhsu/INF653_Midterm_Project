<?php

$data = $_GET;

if (isset($data['authorId'])) {
    $quo->authorId = $data['authorId'];

    if (isset($data['categoryId'])) {
        $quo->categoryId = $data['categoryId'];
        $result = $quo->read_author_and_category();

    } else {
        $result = $quo->read_author();
    }

} else if (isset($data['categoryId'])) {
    $quo->categoryId = $data['categoryId'];
    $result = $quo->read_category();

} else {
    $result = $quo->read();
}

$rowCount = $result->rowCount();

if ($rowCount == 0) {
    echo json_encode(
        array('message' => 'No Quotes Found.')
    );
} else {
    $quotes_arr = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $quote_item = array(
            'id' => $id,
            'quote' => $quote,
            'author' => $author,
            'category' => $category

        );

        array_push($quotes_arr, $quote_item);
    }

    echo json_encode($quotes_arr);
}

?>