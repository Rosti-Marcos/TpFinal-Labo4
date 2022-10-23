<?php 
 include('header.php');

?>
    <section class="ftco-section">
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 text-center mb-5">
            <h2 class="heading-section">Personal profile</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="table-wrap">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Customer</th>
                        <th>Start date</th>
                        <th>End date</th>
                        <th>Price</th>
                        <th>Description</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                  <tr>
                    <td><?php echo $user->getName() ?></td>
                    <td><?php echo $user->getLastname() ?></td>
                    <td><?php echo $user->getUserName() ?></td>
                    <td><?php echo $user->getEMail() ?></td>
                    <td><?php echo $user->getPhoneNumber() ?></td>
                    <td><?php echo $user->getBirthDate() ?></td>
                  </tr>
                    </tbody>
                </table>
            </div>
            <a href="<?php echo FRONT_ROOT. "Home\ShowWellcomeView"?>">Back</a>
        </div>
    </div>
    </div>

    </section>

<?php
include('footer.php');
?>

