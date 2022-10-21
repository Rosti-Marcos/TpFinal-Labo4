<?php
include_once('header.php');

?>

<div id="breadcrumb" class="hoc clear">
    <h5 class="heading">Register form</h5>
</div>
<div class="wrapper row3" >
    <main class="container" style="width: 95%;">
        <!-- main body -->
        <div class="content" >
            <div id="comments" style="align-items:center;">
                <h2>Please insert your data</h2>
                <form action="<?php echo  FRONT_ROOT . "User\Add "?>" method="post"  style="background-color: #EAEDED;padding: 2rem !important;">
                    <table>
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Last Name</th>
                            <th>User Name</th>
                            <th>Password</th>
                            <th>E-Mail</th>
                            <th>Phone Number</th>
                            <th>Birth Date</th>
                        </tr>
                        </thead>
                        <tbody >
                        <tr>
                            <td style="max-width: 100px;">
                                <input type="text" name="name" min="1" max="999" size="30" required>
                            </td>
                            <td>
                                <input type="text" name="lastname" size="20" required>
                            </td>
                            <td>
                                <input type="text" name="userName" size="20" required>
                            </td>
                            <td>
                                <input type="password" name="password" size="10" required>
                            </td>
                            <td>
                                <input type="email" name="eMail" size="10" required>
                            </td>
                            <td>
                                <input type="text" name="phoneNumber" size="10" required>
                            </td>
                            <td>
                                <input type="date" name="birthDate" size="10" min="1900-01-01" max="2022-12-31T00:00" required>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <div>
                        <input type="submit" class="btn" value="Send" style="background-color:#DC8E47;color:white;"/>
                    </div>
                </form>
                <a href="<?php echo FRONT_ROOT. "Home\Index"?>">Back</a>
            </div>
        </div>
    </main>
</div>
<!-- ################################################################################################ -->

<?php
include('footer.php');
?>
