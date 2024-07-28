<?php
function Auth()
{
    if (!isset($_SESSION['username'])) {
        header("Location: ../penilaian/login.php");
        exit();
    }
}
