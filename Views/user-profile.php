<?php 
    include('header.php');
    include('nav-bar.php')
?>
<body background="<?php echo FRONT_ROOT . IMG_PATH . "mascotas.jpg"?>">
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
                        <th>Name</th>
                        <th>Last name</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Birth Date</th>
                        
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
            <div class="row justify-content-end">
                 <div class="d-flex align-items-center justify-content-center pb-4">
                  <p class="mb-0 me-2"></p>
                    <button type="button" class="btn btn-outline-danger"
                      onclick="location.href='<?php echo FRONT_ROOT . "Home/ShowWellcomeView"?>'">Back</button>
                    </div>
            </div>
        </div>
    </div>
    </div>

    </section>

<?php
include('footer.php');
?>

