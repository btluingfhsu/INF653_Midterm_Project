<?php

function isValid($id, $model){ 
    $model->id = $id;
    $model->read_single();
    $className = get_class($model);
    if ($className === "Category" || $className == "Author") {
        return $model->name;
    } else if ($className === "Quote") {
        return ($model->theQuote);
    }
}

?>