<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Title</th>
            <th>Image</th>
            <th>Tags</th>
            <th>Content</th>
        </tr>
    </thead>
    <tbody>

<?php

$query = "SELECT * FROM photos";
$all_photos = mysqli_query($connection, $query);

if(!$all_photos) {
    die("Query Failed" . mysqli_error($connection));
}

if(isset($_GET['delete'])) {
    $get_photo_id = $_GET['delete'];
    $query = "DELETE FROM photos WHERE photo_id = {$get_photo_id}";
    $delete_photo = mysqli_query($connection, $query);

    check_query($delete_photo);
    header("Location: photos.php");
}

while($row = mysqli_fetch_assoc($all_photos)) {
    $photo_id = $row['photo_id'];
    $photo_title = $row['photo_title'];
    $photo_thumbnail = $row['photo_thumbnail'];
    $photo_tags = $row['photo_tags'];
    $photo_content = $row['photo_content'];
    echo "<tr>";
    echo "<td>{$photo_id}</td>";
    echo "<td>{$photo_title}</td>";
    echo "<td><img width='100' class='img-responsive' src='../assets/img/thumbnails/{$photo_thumbnail}'/></td>";
    echo "<td>{$photo_tags}</td>";
    echo "<td>{$photo_content}</td>";
    echo "<td><a href='photos.php?source=update_photo&p_id={$photo_id}'>Update</a></td>";
    echo "<td><a href='photos.php?delete={$photo_id}'>Delete</a></td>";
    echo "</tr>";
}

?>

    </tbody>
</table>
