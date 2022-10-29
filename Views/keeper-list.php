 <?php
  include_once('header.php');
  include_once('nav-bar.php');
?>
<body background="<?php echo FRONT_ROOT . IMG_PATH . "bgPerroBlanco.jpg"?>">
<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center mb-5">
                <h2 class="heading-section">Keepers List</h2>
            </div>
        </div>
        <div class="container">        
        <div class="row justify-content-md-center">
            <div class="col-6 col-md-6">
              <div class="card mb-12">
                <div class="card-body">
                  <div class="row">
                    <div style="text-align: center;">
                      <h6>Search Keepers</h6>
                      <?php 
                        $startDate = new DateTime();
                        $max = new DateTime();
                        $max->modify("365 days");
                            ?>
                    <form action="<?php echo  FRONT_ROOT."Keeper/ShowListViewFiltered"?>" method="post">
                        </div>
                        <hr>
                        <div class="col-sm-2">
                        <h5 class="mb-2" style="text-align: center;">From</h5>
                        </div>
                        <div class="col-sm-3 text-secondary">
                            <input  type="date" value="<?php echo date("Y-m-d");?>" min=<?=$startDate->format("Y-m-d")?> max=<?=$max->format("Y-m-d")?> name="startDate" require>
                        </div>
                        <div class="col-sm-2">
                        <h5 class="mb-4" style="text-align: center;">To</h5>
                        </div>
                        <div class="col-sm-3">
                            <input type="date" value="<?php echo date("Y-m-d");?>" min=<?=$startDate->format("Y-m-d")?> max=<?=$max->format("Y-m-d")?> name="endDate" require>
                        </div>
                        <div class="col-sm-2">
                            <button type="submit" class="btn btn-primary">Search</button>
                        </div>
                        <div>
                    </form>
                    </div>
                  </div>
                </div>               
              </div>
            </form>
            </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-12">
                <div class="table-wrap">
                    <?php if($keeperList){ ?>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Lastname</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                            <th>Age</th>
                            <th>Pet Size</th>
                            <th>Intended remuneration</th>
                            <th>Start Date</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php  $year = date('Y');?>
                        <?php foreach($keeperList as $keeper){
                        if (($keeper->getUser()->getUserType()->getUserTypeId() == 1) || ($keeper->getUser() != $_SESSION["loggedUser"])){ ?>
                        <tr>
                            <?php $birthExplode = explode("-",$keeper->getUser()->getBirthDate());?>
                             
                            <td><?php echo $keeper->getUser()->getName() ?></td>
                            <td><?php echo $keeper->getUser()->getLastname() ?></td>
                            <td><?php echo $keeper->getUser()->getEMail() ?></td>
                            <td><?php echo $keeper->getUser()->getPhoneNumber() ?></td>
                            <td><?php echo $age= $year - $birthExplode[0]; ?></td>
                            <td><?php echo $keeper->getPetSize()->getPetSize() ?></td>
                            <td><?php echo $keeper->getRemuneration() ?></td>
                            <td><?php echo $keeper->getStartDate() ?></td>
                            <td><a class="btn btn-primary" href="<?php echo FRONT_ROOT."Booking/PreReservation/".$keeper->getUser()->getUserId()?>" class="btn">Show Profile</a></td>
                        </tr>
                                <?php }?>
                        <?php }}?>
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

