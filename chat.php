<?php
session_start();
if (!isset($_SESSION['unique_id'])) {
    header("location : login.php");
}
?>

<?php
include_once "header.php";
?>

<body style="
    align-items: left;
    justify-content: left;
    margin-right:140px;">
    <div>
        <button class="button-chat" onclick="myFunction()"><i class="far fa-comment-alt"></i></button>
    </div>
    <div class="wrapper-chat" id="chat">
        <section class="chat-area">
            <header>
                <?php
                include_once "config.php";
                $user_id = mysqli_real_escape_string($conn, $_GET['user_id']);
                $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$user_id}");
                if (mysqli_num_rows($sql) > 0) {
                    $row = mysqli_fetch_assoc($sql);
                }
                ?>
                <a href="users.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
                <img src="images/<?php echo $row['img'] ?>" alt="">
                <div class="details">
                    <span><?php echo $row['fname'] . " " . $row['lname'] ?></span>
                    <p><?php echo $row['status'] ?></p>
                </div>
            </header>
            <div class="chat-box">
            </div>
            <form action="#" class="typing-area" autocomplete="off">
                <input type="text" name="outgoing_id" value="<?php echo $_SESSION['unique_id'] ?>" hidden>
                <input type="text" name="incoming_id" value="<?php echo $user_id ?>" hidden>
                <input type="text" name="message" class="input-field" placeholder="Type a message here...">
                <button><i class="fab fa-telegram-plane"></i></button>
            </form>
        </section>
    </div>
</body>
<script>
    function myFunction() {
        if (document.getElementById("chat").hidden == true)
            document.getElementById("chat").hidden = false;
        else
            document.getElementById("chat").hidden = true;
    }
</script>
<script src="chat.js"></script>

</html>