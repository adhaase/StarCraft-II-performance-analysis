<?php
    include_once 'header.php';
?>

    <section class="main-container">
        <div class="main-wrapper">
            <h2>Welcome!</h2>
            <h3>After you sign up/log in, you will be able to record data from your StarCraft II matches.</h3>
            <br>
            <h2>
            <?php
                // if the user has been logged in (login.inc.php)
                if (isset($_SESSION['u_id'])) {
                    echo "Hello ";
                    echo $_SESSION['u_first'];
                    echo ", you are logged in!";
                }
            ?>
            </h2>
        </div>
    </section>

<?php
    include_once 'footer.php';
?>