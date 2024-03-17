<?php

if (!property_exists($data, 'id') || !property_exists($data, 'category')) {
    missingParams();
} else {

    if (isValid($data->id, $cat)) {
        $cat->name = $data->category;

        if ($cat->update()) {
            echo json_encode(
                array(
                    'id' => $cat->id,
                    'category' => $cat->name,
                )
            );
        } else {
            fail("Category", "Updated");
        }
    } else {
        notFound("category");
    }    
}
exit();
?>