<?php
function msg_query()
{
    if (isset($_SESSION['success'])) {
?>
        <div class="alert alert-success" role="alert">
            <?php echo $_SESSION['success']; ?>
        </div>
    <?php
        unset($_SESSION['success']);
    } elseif (isset($_SESSION['failed'])) {
    ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $_SESSION['failed']; ?>
        </div>
<?php
        unset($_SESSION['failed']);
    }
}
