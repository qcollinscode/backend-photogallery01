<?php

    if(isset($_GET['p_id'])) {
        $photo_id = $_GET['p_id'];
        $photo = getById("photos", $photo_id);
        while ($row = mysqli_fetch_assoc($photo)) {
            $photo_id = $row['photo_id'];
            $photo_title = $row['photo_title'];
            $photo_thumbnail = $row['photo_thumbnail'];
            $photo_full = $row['photo_full'];
            $photo_tags = $row['photo_tags'];
            $photo_content = $row['photo_content'];
        }
    }

    if(isset($_POST['update_photo'])) {
        $photo_title_update = mysqli_real_escape_string($connection, $_POST["photo_title"]);
        $photo_tags_update = mysqli_real_escape_string($connection, $_POST["photo_tags"]);
        $photo_content_update = mysqli_real_escape_string($connection, $_POST["photo_content"]);
        $photo_thumbnail_update = mysqli_real_escape_string($connection, $_FILES["photo_thumbnail"]["name"]);
        $photo_thumbnail_temp_update = mysqli_real_escape_string($connection, $_FILES["photo_thumbnail"]["tmp_name"]);
        $photo_full_update = mysqli_real_escape_string($connection, $_FILES["photo_full"]["name"]);
        $photo_full_temp_update = mysqli_real_escape_string($connection, $_FILES["photo_full"]["tmp_name"]);

        move_uploaded_file($photo_thumbnail_temp_update, "../assets/img/thumbnails/$photo_thumbnail_update" );
        move_uploaded_file($photo_full_temp_update, "../assets/img/fulls/$photo_full_update" );

        if(empty($photo_thumbnail_update)) {
            $query = "SELECT * FROM photos WHERE photo_id = $photo_id";
            $select_image = mysqli_query($connection, $query);
            while($row = mysqli_fetch_assoc($select_image)) {
                $photo_thumbnail_update = $row["photo_thumbnail"];
            }
        }

        if(empty($photo_full_update)) {
            $query = "SELECT * FROM photos WHERE photo_id = $photo_id";
            $select_image = mysqli_query($connection, $query);
            while($row = mysqli_fetch_assoc($select_image)) {
                $photo_full_update = $row["photo_full"];
            }
        }

        $query = "UPDATE photos SET ";
        $query .= "photo_title = '$photo_title_update', ";
        $query .= "photo_tags = '$photo_tags_update', ";
        $query .= "photo_content = '$photo_content_update', ";
        $query .= "photo_thumbnail = '$photo_thumbnail_update', ";
        $query .= "photo_full = '$photo_full_update' ";
        $query .= "WHERE photo_id = $photo_id";

        $update_photo = mysqli_query($connection, $query);

        check_query($update_photo);

        header("Location: photos.php");

    }

?>

<form action="" method="post" enctype="multipart/form-data">


    <div class="form-group">
        <label for="photo_title">Photo Title</label>
        <input type="text" name="photo_title" class="form-control" required value="<?php echo "{$photo_title}"; ?>">
    </div>

    <div class="form-group">
        <label for="current_full_image">Current Full Image</label>
        <img name="current_full_image" src='../assets/img/full/<?php echo "{$photo_full}"; ?>' class="img-responsive" width="100" alt="">
    </div>

    <div class="form-group">
        <label for="photo_full">Photo Full Image</label>
        <input type="file" name="photo_full">
    </div>

    <div class="form-group">
        <label for="current_thumbnail_image">Current Thumbnail Image</label>
        <img name="current_thumbnail_image" src='../assets/img/thumbnails/<?php echo "{$photo_thumbnail}"; ?>' class="img-responsive" width="100" alt="">
    </div>

    <div class="form-group">
        <label for="photo_thumnail">Photo Thumbnail Image</label>
        <input type="file" name="photo_thumbnail">
    </div>

    <div class="form-group">
        <label for="photo_tags">Photo Tags</label>
        <input type="text" name="photo_tags" class="form-control" value="<?php echo "{$photo_tags}"; ?>" required>
    </div>

    <div class="form-group">
        <label for="photo_content">Photo Content</label>
        <textarea type="text" name="photo_content" class="form-control post-textarea" id="" cols="30" rows="10" required> <?php echo "{$photo_content}"; ?></textarea>
    </div>

    <div class="form-group">
        <input type="submit" name="update_photo" class="btn btn-primary" value="Update Photo" required>
    </div>

</form>
