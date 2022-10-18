<?php
include_once('header.php');
?>

<div id="breadcrumb" class="hoc clear">
<div class="wrapper row3" >
    <main class="container" style="width: 95%;">
        <div class="content" >
            <div id="comments" style="align-items:center;">
                <h2>Login</h2>
                <form action="<?php echo FRONT_ROOT . "Home/Login"?>" method="post" class="login-form bg-dark-alpha p-5 text-white">
                    <div>
                        <label for="user_name">
                            <span>UserName</span>
                            <input type="text" id="user_name" name="userName" required>
                        </label>
                    </div>
                    <div>
                        <label for="user_password">
                            <span>Password</span>
                            <input type="password" id="user_password" name="password" required>
                        </label>
                    </div>
                    <div>
                        <button type="submit" class="enviar">Login</button>

                    </div>
                </form>
                <a href="<?php echo FRONT_ROOT. "User\ShowAddView"?>">Register Form</a>
            </div>
    </main>
    <?php
    include('footer.php');
    ?>
