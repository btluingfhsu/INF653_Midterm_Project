<?php
// confirm author is given
if (!property_exists($data, "id")) {
    missingParams();
} else {
    // verify ID is in DB
    if (isValid($data->id, $theAuthor)) {
        if ($theAuthor->delete()) {
            echo json_encode(
                array(
                    'id' => $data->id
                )
            );
        } else {
            fail("Author", "Deleted");
        }
    } else {
        notFound("author");
    }
}
exit();