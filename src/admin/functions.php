<?php

function check_query($result) {
    global $connection;
    if(!$result) {
        die("Query Failed: " . mysqli_error($connection));
    }
}

function getById($str, $id) {
    global $connection;
    $query = "SELECT * FROM {$str} WHERE photo_id = {$id}";
    $result = mysqli_query($connection, $query);
    check_query($result);
    return $result;
}
