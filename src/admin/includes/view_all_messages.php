<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Date</th>
            <th>Email</th>
            <th>Message</th>
        </tr>
    </thead>
    <tbody>

<?php

$query = "SELECT * FROM messages";
$all_messages = mysqli_query($connection, $query);

if(!$all_messages) {
    die("Query Failed" . mysqli_error($connection));
}

if(isset($_GET['delete'])) {
    $get_message_id = $_GET['delete'];
    $query = "DELETE FROM messages WHERE message_id = {$get_message_id}";
    $delete_message = mysqli_query($connection, $query);

    check_query($delete_message);
    header("Location: messages.php");
}

while($row = mysqli_fetch_assoc($all_messages)) {
    $message_id = $row['message_id'];
    $message_name = $row['message_name'];
    $message_date = $row['message_date'];
    $message_email = $row['message_email'];
    $message_content = $row['message_content'];

    echo "<tr>";
    echo "<td>{$message_id}</td>";
    echo "<td>{$message_name}</td>";
    echo "<td>{$message_date}</td>";
    echo "<td>{$message_email}</td>";
    echo "<td>{$message_content}</td>";
    echo "<td><a href='messages.php?delete={$message_id}'>Delete</a></td>";
    echo "</tr>";
}

?>

    </tbody>
</table>
