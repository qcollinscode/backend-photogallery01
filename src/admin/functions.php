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

function insert_posts() {
    global $connection;
    $query = "SELECT * FROM posts";
    $all_posts = mysqli_query($connection, $query);

    if(!$all_posts) {
        die("Query Failed" . mysqli_error($connection));
    }

    while($row = mysqli_fetch_assoc($all_posts)) {
        $post_id = $row['post_id'];
        $post_category = $row['post_category_id'];
        $post_title = $row['post_title'];
        $post_author = $row['post_author'];
        $post_date = $row['post_date'];
        $post_image = $row['post_image'];
        $post_content = $row['post_content'];
        $post_comment_count = $row['post_comment_count'];
        $post_tags = $row['post_tags'];
        $post_status = $row['post_status'];
        echo "<tr>";
        echo "<td>{$post_id}</td>";
        echo "<td>{$post_category}</td>";
        echo "<td>{$post_author}</td>";
        echo "<td>{$post_title}</td>";
        echo "<td><img width='100' class='img-responsive' src='../assets/img/{$post_image}'/></td>";
        echo "<td>{$post_tags}</td>";
        echo "<td>{$post_comment_count}</td>";
        echo "<td>{$post_date}</td>";
        echo "<td>{$post_status}</td>";
        echo "</tr>";
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
    $query = "SELECT * FROM {$str} WHERE photo_id = {$id}";
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
