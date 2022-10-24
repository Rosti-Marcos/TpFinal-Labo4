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
                            <th>Age</th>
                            <th>Type pets </th>
                            <th>Intended remuneration</th>
                            <th>Start Date</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php  $year = date('Y');?>
                        <?php foreach($userList as $user){
                        if (($keeperLogged==null) || ($keeperLogged->getUserId()!= $user->getUserId())){ ?>
                        <tr>
                            <?php $birthExplode = explode("-",$user->getBirthDate());?>
                             
                            <td><?php echo $user->getName() ?></td>
                            <td><?php echo $user->getLastname() ?></td>
                            <td><?php echo $user->getEMail() ?></td>
                            <td><?php echo $user->getPhoneNumber() ?></td>
                            <td><?php echo $age= $year - $birthExplode[0]; ?></td>
                            <?php
                            foreach($keeperList as $keeper){
                                if($keeper->getUserId() == $user->getUserId()){
                            ?>
                            <td><?php echo $keeper->getPetTypeId() ?></td>
                            <td><?php echo $keeper->getRemuneration() ?></td>
                            <td><?php echo $keeper->getStartDate() ?></td>
                        </tr>
                                <?php }?>
                        <?php }}}?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row justify-content-end">
        <div class="d-flex align-items-center justify-content-center pb-4">
                  <p class="mb-0 me-2"></p>
                    <button type="button" class="btn btn-outline-danger"
                      onclick="location.href='<?php echo FRONT_ROOT . "Home/ShowWellcomeView"?>'">Back</button>
                    </div>
         </div>
    </div>

</section>

<?php
include('footer.php');
?>

