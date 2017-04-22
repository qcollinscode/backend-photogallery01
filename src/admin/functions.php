<?php

function check_query($result) {
    global $db;
    if(!$result) {
        die("Query Failed: " . mysqli_error($db));
    }
}

function getById($str, $id) {
    global $db;
    $query = "SELECT * FROM {$str} WHERE photo_id = {$id}";
    $result = mysqli_query($db, $query);
    check_query($result);
    return $result;
}
