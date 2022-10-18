<?php
include('header.php');
?>

    <section class="ftco-section">

<h2>Your pet data</h2>
<form action="<?php echo FRONT_ROOT . "Pet\Add" ?>" method="post" enctype="multipart/form-data">
    <table>
        <td>
            <tr>
                <th><h3>Your pet Name</h3></th>
                <td>
                    <input type="text" name="petName" size="30" placeholder="name..." required>
                </td>
            </tr>
            <tr>
                <th><h3>Please attach vaccine certificate</h3></th>
                <td>
                    <input accept="image/png,image/jpeg" type="file" name="vaccineCertId" id="vaccineCertId" required>
                </td>
            </tr>
            <tr>
                <th><h3>Your pet Size</h3></th>
                <td>
                    <select id="petTypeId" name="petTypeId">
                        <option value="3">Big</option>
                        <option value="2">Medium</option>
                        <option value="1">Small</option>
                </td>
                </select>
            </tr>
            <tr>
                <th><h3>Please attach youe pet photo</h3></th>
                <td>
                    <input accept="image/png,image/jpeg" type="file" name="petPics" id="petPics" required>
                </td>
            </tr>
            <tr>
                <th><h3>Please attach your pet video (optional)</h3></th>
                <td>
                    <input accept="video/mp4"type="file" name="petVideo" id="petVideo">
                </td>
            </tr>
            <tr>
                <th><h3>Yor pet breed</h3></th>
                <td>
                    <input type="text" name="petBreed" placeholder="Rottweiler" required>
                </td>
            </tr>
            <tr>
                <th><h3>Aditional info</h3></th>
                <td>
                    <textarea cols="50" rows="10" type="text" name="observation" placeholder="Please insert your additional info"></textarea>
                </td>
            </tr>
        </td>
    </table>
    <br>
    <br>
    <input type="submit" class="enviar" value="Add pet">

</form>

        <a href="<?php echo FRONT_ROOT. "Home\ShowWellcomeView"?>">Back</a>

    </section>

<?php
include('footer.php');
?>