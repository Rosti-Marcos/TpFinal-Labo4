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
                            <td>
                                <select id="petTypeId" name="petTypeId">
                                    <option value="3">Big</option>
                                    <option value="2">Medium</option>
                                    <option value="1">Small</option>
                            </td>
                            </select>
                            <td>
                                <input type="text" name="remuneration" size="20" required>
                            </td>
                        </tr>
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
