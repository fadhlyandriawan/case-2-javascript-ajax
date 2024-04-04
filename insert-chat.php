<?php
session_start();

date_default_timezone_set('Asia/Jakarta');

if (isset($_SESSION['unique_id'])) {
    include_once "config.php";
    $outgoing_id = mysqli_real_escape_string($conn, $_POST['outgoing_id']);
    $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);
    $time = date('Y-m-d H:i:s');

    if (!empty($message)) {
        $sql = mysqli_query($conn, "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg, waktu)
                            VALUES ({$incoming_id}, {$outgoing_id}, '{$message}', '{$time}')") or die(mysqli_error($conn));
    }

    $sql = "SELECT fname, lname FROM  users
        WHERE unique_id = {$_SESSION['unique_id']}";
    $query = mysqli_query($conn, $sql);
    if (mysqli_num_rows($query) > 0) {
        $row = mysqli_fetch_assoc($query);

        $username = $row['fname'] . " " . $row['lname'];

        $filename = "chat_log.txt";

        $content = "\nWAKTU    : $time\nUSERNAME : $username\nPESAN    : $message";

        $file = fopen($filename, "a");

        fwrite($file, $content . PHP_EOL);

        fclose($file);
    }
} else {
    header("Location: login.php");
    exit();
}