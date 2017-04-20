<?php

function insert_categories() {
    global $connection;
    if(isset($_POST['add_category'])) {
        $cat_title = $_POST['cat_title'];

        if($cat_title == "" || empty($cat_title)) {
            echo "This field should not be empty";
        } else {
            $query = "INSERT INTO categories(cat_title) ";
            $query .= "VALUE('{$cat_title}') ";

            $create_category_query = mysqli_query($connection, $query);

            if(!$create_category_query) {
                die("Query Failed" . mysqli_error($connection));
            };
        };
    };

}

function on_update_include_form() {
    if(isset($_GET['update'])) {
        $cat_id = $_GET['update'];

        include "includes/update_categories.php";;
    };
}

function delete_category() {
    global $connection;
    if(isset($_GET['delete'])) {
        $delete_id = $_GET['delete'];

        $query = "DELETE FROM categories WHERE cat_id = {$delete_id} ";
        $delete_category = mysqli_query($connection, $query);
        header("Location: categories.php");


        if(!$delete_category) {
            die("Query Failed" . mysqli_error($connection));
        }
    }
}

function display_categories() {
    global $connection;
    $query = "SELECT * FROM categories";
    $select_categories = mysqli_query($connection, $query);
    if(!$select_categories) {
        die("Query Failed!" . mysqli_error($connection));
    }
    while($row = mysqli_fetch_assoc($select_categories)) {
        $cat_title = $row['cat_title'];
        $cat_id    = $row['cat_id'];
        echo "<tr>";
        echo "<td>{$cat_id}</td>";
        echo "<td>{$cat_title}</td>";
        echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
        echo "<td><a href='categories.php?update={$cat_id}'>Update</a></td>";
        echo "</tr>";
    }
    delete_category();
}

function get_photos() {
    global $connection;
    $query = "SELECT * FROM photos";
    $all_posts = mysqli_query($connection, $query);

    if(!$all_posts) {
        die("Query Failed" . mysqli_error($connection));
    }

    while($row = mysqli_fetch_assoc($all_posts)) {
        $photo_title = $row['photo_title'];
        $photo_content = $row['photo_content'];
        $photo_thumbnail = $row['photo_thumbnail'];
        $photo_full = $row['photo_full'];
        echo "<article class='thumb'>";
        echo "<a href='images/fulls/{$photo_full}' class='image'><img src='images/thumbs/{$photo_thumbnail}' alt='' /></a>";
        echo "<h2>{$photo_title}</h2>";
        echo "<p>{$photo_content}</p>";
        echo "</article>";
    }
}



function check_query($result) {
    global $connection;
    if(!$result) {
        die("Query Failed: " . mysqli_error($connection));
    }
}

function getById($str, $id) {
    global $connection;
    $query = "SELECT * FROM {$str} WHERE post_id = {$id}";
    $result = mysqli_query($connection, $query);
    check_query($result);
    return $result;
}

function getAll($str) {
    global $connection;
    $query = "SELECT * FROM {$str}";
    $result = mysqli_query($connection, $query);
    check_query($result);
    return $result;
}
