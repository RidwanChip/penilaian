<?php
session_start();
include 'Widgets/badge.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Halaman Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
    <link rel="stylesheet" href="../penilaian/main.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css" />
</head>
<style>
    body {
        background-image: url('img.jpg');
        background-size: cover;
        background-attachment: fixed;
    }
</style>

<body>
    <?php
    msg_query();
    ?>
    <div class="form-login position-absolute top-50 start-50 translate-middle p-3" style="min-width: 300px; max-width: 500px;">

        <h2 class=" text-center mb-3">
            <img src="your_logo.png" alt="" height="30px">
            <br>
            Login
        </h2>
        <form action="page.php?q=loginAct&aksi=login" method="post" class="mx-auto text-left">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group mb-3">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary btn-block">Login</button>
                <button type="reset" class="btn btn-danger btn-block">Reset</button>
            </div>

        </form>
    </div>
</body>

</html>