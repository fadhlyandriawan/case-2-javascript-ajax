<?php
$conn = mysqli_connect("localhost", "root", "rahasia", "chat");
if (!$conn) {
    echo "Database connected" . mysqli_connect_error();
}