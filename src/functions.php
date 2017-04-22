<?php

function get_photos() {
    global $db;
    $query = "SELECT * FROM photos";
    $all_photos = mysqli_query($db, $query);

    if(!$all_photos) {
        die("Query Failed" . mysqli_error($db));
    }

    while($row = mysqli_fetch_assoc($all_photos)) {
        $photo_title = $row['photo_title'];
        $photo_content = $row['photo_content'];
        $photo_thumbnail = $row['photo_thumbnail'];
        $photo_full = $row['photo_full'];
        echo "<article class='thumb'>";
        echo "<a href='assets/img/fulls/{$photo_full}' class='image'><img src='assets/img/thumbnails/{$photo_thumbnail}' alt='' /></a>";
        echo "<h2>{$photo_title}</h2>";
        echo "<p>{$photo_content}</p>";
        echo "</article>";
    }
}



function check_query($result) {
    global $db;
    if(!$result) {
        die("Query Failed: " . mysqli_error($db));
    }
}
