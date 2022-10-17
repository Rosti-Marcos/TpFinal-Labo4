<?php
include_once('header.php');
?>

<div id="breadcrumb" class="hoc clear">
    <h6 class="heading">Register</h6>
</div>
</div>
<div class="wrapper row3" >
    <main class="container" style="width: 95%;">
        <!-- main body -->
        <div class="content" >
            <div id="comments" style="align-items:center;">
                <h2>Insert your data</h2>
                <form action="<?php echo  FRONT_ROOT . "Keeper\Add "?>" method="post"  style="background-color: #EAEDED;padding: 2rem !important;">
                    <table>
                        <thead>
                        <tr>
                            <th>Pet type</th>
                            <th>Intended remuneration</th>

                        </tr>
                        </thead>
                        <tbody align="center">
                        <tr>
                            <td style="max-width: 100px;">
                                <input type="text" name="petTypeId" min="1" max="999" size="30" required>
                            </td>
                            <td>
                                <input type="text" name="remuneration" size="20" required>
                            </td>

                        </tbody>
                    </table>
                    <div>
                        <input type="submit" class="btn" value="Send" style="background-color:#DC8E47;color:white;"/>
                    </div>
                </form>
                <a href="<?php echo FRONT_ROOT. "Home\ShowWellcomeView"?>">Back</a>
            </div>
        </div>
    </main>
</div>
<!-- ################################################################################################ -->

<?php
include('footer.php');
?>
