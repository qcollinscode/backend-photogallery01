<?php
    if(isset($_POST['upload_photo'])) {
        $photo_title = mysqli_real_escape_string($db, $_POST["photo_title"]);
        $photo_tags = mysqli_real_escape_string($db, $_POST["photo_tags"]);
        $photo_content = mysqli_real_escape_string($db, $_POST["photo_content"]);
        $photo_thumbnail = mysqli_real_escape_string($db, $_FILES["photo_thumbnail"]["name"]);
        $photo_thumbnail_temp = mysqli_real_escape_string($db, $_FILES["photo_thumbnail"]["tmp_name"]);
        $photo_full = mysqli_real_escape_string($db, $_FILES["photo_full"]["name"]);
        $photo_full_temp = mysqli_real_escape_string($db, $_FILES["photo_full"]["tmp_name"]);

        move_uploaded_file($photo_thumbnail_temp, "../assets/img/thumbnails/$photo_thumbnail" );
        move_uploaded_file($photo_full_temp, "../assets/img/fulls/$photo_full" );

        $query = "INSERT INTO photos(photo_title, photo_content, photo_thumbnail, photo_full, photo_tags) ";
        $query .= "VALUES('{$photo_title}','{$photo_content}','{$photo_thumbnail}','{$photo_full}', '{$photo_tags}')";
        $insert_photo = mysqli_query($db, $query);

        check_query($insert_photo);

        header("Location: photos.php");
    }

?>



<form action="" method="post" enctype="multipart/form-data">


    <div class="form-group">
        <label for="photo-title">Photo Title</label>
        <input type="text" name="photo_title" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="photo_thumbnail">Photo Thumbnail</label>
        <input type="file" name="photo_thumbnail" required>
    </div>

    <div class="form-group">
        <label for="photo_full">Photo Full</label>
        <input type="file" name="photo_full" required>
    </div>

    <div class="form-group">
        <label for="photo_tags">Photo Tags</label>
        <input type="text" name="photo_tags" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="photo_content">Photo Content</label>
        <textarea type="text" name="photo_content" class="form-control post-textarea" id="" cols="30" rows="10" required> </textarea>
    </div>

    <div class="form-group">
        <input type="submit" name="upload_photo" class="btn btn-primary" value="Publish Photo" required>
    </div>

</form>
