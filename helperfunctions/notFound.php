<?php

function notFound($modelType) {
    echo json_encode(
        array('message' => $modelType . '_id Not Found')
    );
}

?>