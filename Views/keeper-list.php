<?php
  include_once('header.php');
  include_once('nav-bar.php');
?>
<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center mb-5">
                <h2 class="heading-section">Keepers List</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table-wrap">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Lastname</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                            <th>Birth Date</th>
                            <th>Type pets </th>
                            <th>Intended remuneration</th>
                            <th>Start Date</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($userList as $user)
                        { ?>
                        <tr>
                            <td><?php echo $user->getName() ?></td>
                            <td><?php echo $user->getLastname() ?></td>
                            <td><?php echo $user->getEMail() ?></td>
                            <td><?php echo $user->getPhoneNumber() ?></td>
                            <td><?php echo $user->getBirthDate() ?></td>
                            <?php
                            foreach($keeperList as $keeper){
                                if($keeper->getUserId() == $user->getUserId()){
                            ?>
                            <td><?php echo $keeper->getPetTypeId() ?></td>
                            <td><?php echo $keeper->getRemuneration() ?></td>
                            <td><?php echo $keeper->getStartDate() ?></td>
                        </tr>
                                <?php }?>
                        <?php }}?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</section>

<?php
include('footer.php');
?>

