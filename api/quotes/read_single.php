<?php

if (isValid($_GET['id'], $quo)) {
    $quote_arr = array(
        'id' => $quo->id,
        'quote' => $quo->theQuote,
        'author' => $quo->theAuthor,
        'category' => $quo->theCategory
    );
    echo json_encode($quote_arr);
} else {
    echo json_encode(
        array('message' => 'No Quotes Found')
    );
}

?>