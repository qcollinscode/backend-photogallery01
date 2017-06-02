<?php
    include 'db.php';
    include '../functions.php';
    if(isset($_POST['send_message'])) {
        $message_name = mysqli_real_escape_string($connection, $_POST["message_name"]);
        $message_email = mysqli_real_escape_string($connection, $_POST["message_email"]);
        $message_content = mysqli_real_escape_string($connection, $_POST["message_content"]);
        $message_date = date('d-m-y');

        $query = "INSERT INTO messages(message_name, message_date, message_email, message_content) ";
        $query .= "VALUES('{$message_name}', now(),'{$message_email}','{$message_content}')";
        $insert_message = mysqli_query($connection, $query);

        check_query($insert_message);

        header("Location: ../index.php");
    }

?>
